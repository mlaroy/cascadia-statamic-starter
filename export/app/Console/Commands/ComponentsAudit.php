<?php

namespace App\Console\Commands;

use App\Components\ComponentInventory;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class ComponentsAudit extends Command
{
    protected $signature = 'components:audit';

    protected $description = 'Check the component system against the kit conventions (name chain, builder purity, catalog, themes)';

    /** @var array<int, string> */
    protected array $failures = [];

    public function handle(ComponentInventory $inventory): int
    {
        $blocks = $inventory->blockFieldsets();
        $sets = $inventory->builderSets();
        $partials = $inventory->partialHandles();
        $catalog = $inventory->catalogEntries();

        $this->auditNameChain($blocks, $sets, $partials, $catalog);
        $this->auditBuilderPurity($sets, $blocks);
        $this->auditOrphans($blocks, $sets, $partials, $catalog);
        $this->auditTitles($inventory);
        $this->auditThemes($inventory);
        $this->auditSetGroupWrappers($inventory);

        if ($this->failures) {
            $this->newLine();
            $this->components->error(count($this->failures).' convention failure(s)');

            foreach ($this->failures as $failure) {
                $this->components->bulletList([$failure]);
            }

            return self::FAILURE;
        }

        $this->components->info(sprintf(
            'All checks passed: %d blocks, %d builder sets, %d partials, %d catalog entries.',
            $blocks->count(),
            $sets->count(),
            $partials->count(),
            $catalog->count(),
        ));

        return self::SUCCESS;
    }

    protected function auditNameChain($blocks, $sets, $partials, $catalog): void
    {
        foreach ($blocks->keys() as $handle) {
            if (! $sets->has($handle)) {
                $this->addFailure("{$handle}: no set in page_blocks.yaml");
            }

            if (! $partials->contains($handle)) {
                $this->addFailure("{$handle}: missing partial views/page_blocks/_{$handle}.antlers.html");
            }

            if (! $catalog->has($handle)) {
                $this->addFailure("{$handle}: missing catalog entry (run components:sync)");
            }
        }
    }

    protected function auditBuilderPurity($sets, $blocks): void
    {
        foreach ($sets as $handle => $set) {
            if ($set['field_count'] !== 1 || $set['imports'] !== [$handle]) {
                $this->addFailure("page_blocks set {$handle}: must contain exactly one import matching the set handle (found: ".json_encode($set['imports']).', '.$set['field_count'].' field(s))');
            }

            if (! $set['icon']) {
                $this->addFailure("page_blocks set {$handle}: missing icon");
            }

            if (! $blocks->has($handle)) {
                $this->addFailure("page_blocks set {$handle}: fieldset resources/fieldsets/{$handle}.yaml does not exist");
            }
        }
    }

    protected function auditOrphans($blocks, $sets, $partials, $catalog): void
    {
        foreach ($catalog->keys() as $slug) {
            if (! $blocks->has($slug)) {
                $this->addFailure("catalog entry {$slug}: no matching fieldset (orphan)");
            }
        }

        foreach ($partials as $handle) {
            if (! $sets->has($handle)) {
                $this->addFailure("partial page_blocks/_{$handle}: no matching builder set (orphan)");
            }
        }
    }

    protected function auditTitles(ComponentInventory $inventory): void
    {
        foreach ($inventory->fieldsets() as $handle => $fieldset) {
            if ($handle === 'page_blocks') {
                if ($fieldset['title'] !== 'Page Blocks') {
                    $this->addFailure("page_blocks: title should be \"Page Blocks\", got \"{$fieldset['title']}\"");
                }

                continue;
            }

            foreach (ComponentInventory::TITLE_PREFIXES as $prefix => $titlePrefix) {
                if (str_starts_with($handle, $prefix) && ! str_starts_with($fieldset['title'], $titlePrefix)) {
                    $this->addFailure("{$handle}: title should start with \"{$titlePrefix}\", got \"{$fieldset['title']}\"");
                }
            }

            if (! str($handle)->startsWith(array_keys(ComponentInventory::TITLE_PREFIXES))) {
                $this->addFailure("{$handle}: handle has no taxonomy prefix (content_/callout_/set_/group_)");
            }
        }
    }

    protected function auditThemes(ComponentInventory $inventory): void
    {
        $keys = $inventory->themeOptionKeys()->reject(fn ($key) => $key === 'default');
        $classes = $inventory->themeCssClasses();

        foreach ($keys->diff($classes) as $key) {
            $this->addFailure("theme option \"{$key}\": no .theme-{$key} class in resources/css/theme/theme.css");
        }

        foreach ($classes->diff($keys) as $class) {
            $this->addFailure("CSS class .theme-{$class}: not an option key in group_theme");
        }
    }

    protected function auditSetGroupWrappers(ComponentInventory $inventory): void
    {
        foreach ($inventory->fieldsets() as $handle => $fieldset) {
            if (str_contains(File::get($fieldset['path']), 'new_set_group')) {
                $this->addFailure("{$handle}: contains a new_set_group replicator wrapper — name it meaningfully");
            }
        }
    }

    protected function addFailure(string $message): void
    {
        $this->failures[] = $message;
    }
}
