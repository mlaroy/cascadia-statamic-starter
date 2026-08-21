<?php

namespace App\Components;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;
use Statamic\Facades\Entry;
use Statamic\Facades\YAML;

/**
 * Reads the four artifacts of the component "name chain" so commands can
 * cross-check them: block fieldsets, page builder sets, view partials,
 * and component catalog entries.
 */
class ComponentInventory
{
    public const CATALOG_COLLECTION = 'components';

    public const BLOCK_PREFIXES = ['content_', 'callout_'];

    public const TITLE_PREFIXES = [
        'content_' => 'Content - ',
        'callout_' => 'Callout - ',
        'set_' => 'Set - ',
        'group_' => 'Group - ',
    ];

    /**
     * All fieldsets in resources/fieldsets, keyed by handle.
     *
     * @return Collection<string, array{title: string, path: string, contents: array}>
     */
    public function fieldsets(): Collection
    {
        return collect(File::files(resource_path('fieldsets')))
            ->filter(fn ($file) => $file->getExtension() === 'yaml')
            ->mapWithKeys(function ($file) {
                $contents = YAML::file($file->getPathname())->parse();

                return [$file->getFilenameWithoutExtension() => [
                    'title' => $contents['title'] ?? '',
                    'path' => $file->getPathname(),
                    'contents' => $contents,
                ]];
            });
    }

    /**
     * Fieldsets that are page builder blocks (content_* / callout_*).
     *
     * @return Collection<string, array{title: string, path: string, contents: array}>
     */
    public function blockFieldsets(): Collection
    {
        return $this->fieldsets()->filter(
            fn ($fieldset, $handle) => str($handle)->startsWith(self::BLOCK_PREFIXES)
        );
    }

    /**
     * Sets defined in page_blocks.yaml, keyed by set handle.
     *
     * @return Collection<string, array{group: string, icon: ?string, imports: array<string>, field_count: int}>
     */
    public function builderSets(): Collection
    {
        $fieldset = $this->fieldsets()->get('page_blocks');

        $groups = data_get($fieldset, 'contents.fields.0.field.sets', []);

        return collect($groups)->flatMap(
            fn ($group, $groupHandle) => collect($group['sets'] ?? [])->map(fn ($set, $setHandle) => [
                'group' => $groupHandle,
                'icon' => $set['icon'] ?? null,
                'imports' => collect($set['fields'] ?? [])->pluck('import')->filter()->values()->all(),
                'field_count' => count($set['fields'] ?? []),
            ])
        );
    }

    /**
     * Block partial handles found in views/page_blocks (without underscore).
     *
     * @return Collection<int, string>
     */
    public function partialHandles(): Collection
    {
        return collect(File::files(resource_path('views/page_blocks')))
            ->map(fn ($file) => str($file->getFilename())->before('.antlers.html')->ltrim('_')->toString())
            ->values();
    }

    /**
     * Component catalog entries, keyed by slug.
     *
     * @return Collection<string, \Statamic\Entries\Entry>
     */
    public function catalogEntries(): Collection
    {
        return Entry::query()
            ->where('collection', self::CATALOG_COLLECTION)
            ->get()
            ->keyBy(fn ($entry) => $entry->slug());
    }

    /**
     * Option keys of the group_theme select field.
     *
     * @return Collection<int, string>
     */
    public function themeOptionKeys(): Collection
    {
        $fieldset = $this->fieldsets()->get('group_theme');

        return collect(data_get($fieldset, 'contents.fields.0.field.options', []))
            ->pluck('key')
            ->filter()
            ->values();
    }

    /**
     * Theme classes defined in the theme stylesheet (.theme-<key>).
     *
     * @return Collection<int, string>
     */
    public function themeCssClasses(): Collection
    {
        $css = File::get(resource_path('css/theme/theme.css'));

        preg_match_all('/\.theme-([a-z][a-z0-9-]*)\s*\{/', $css, $matches);

        return collect($matches[1])->unique()->values();
    }
}
