<?php

namespace App\Console\Commands;

use App\Components\ComponentInventory;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Statamic\Facades\YAML;

class ComponentsMake extends Command
{
    protected $signature = 'components:make
        {handle : The component handle, including prefix (e.g. content_pricing_table)}
        {--group= : Page builder set group (hero, content, callouts, media, complex). Defaults by prefix.}
        {--icon=layout-grid-dots : Icon for the builder set}';

    protected $description = 'Scaffold all four artifacts of a new component: fieldset, builder set, partial, and catalog entry';

    public function handle(ComponentInventory $inventory): int
    {
        $handle = $this->argument('handle');

        if (! str($handle)->startsWith(ComponentInventory::BLOCK_PREFIXES)) {
            $this->components->error('Handle must start with content_ or callout_ (e.g. content_pricing_table).');

            return self::FAILURE;
        }

        if ($inventory->fieldsets()->has($handle)) {
            $this->components->error("Fieldset {$handle} already exists.");

            return self::FAILURE;
        }

        $group = $this->option('group') ?: (str_starts_with($handle, 'callout_') ? 'callouts' : 'content');
        $display = str($handle)->after('_')->replace('_', ' ')->title()->toString();
        $titlePrefix = ComponentInventory::TITLE_PREFIXES[str_starts_with($handle, 'callout_') ? 'callout_' : 'content_'];

        if (! $this->registerBuilderSet($handle, $group, $display)) {
            return self::FAILURE;
        }

        $this->writeFieldset($handle, $titlePrefix.$display);
        $this->writePartial($handle);

        $this->call('components:sync');

        $this->newLine();
        $this->components->info("Component {$handle} scaffolded. Next steps:");
        $this->components->bulletList([
            "add block-specific fields to resources/fieldsets/{$handle}.yaml (import groups, don't redefine)",
            "build the markup in resources/views/page_blocks/_{$handle}.antlers.html",
            "fill in the TODOs in content/collections/components/{$handle}.md",
            'run: php artisan components:audit',
        ]);

        return self::SUCCESS;
    }

    protected function registerBuilderSet(string $handle, string $group, string $display): bool
    {
        $path = resource_path('fieldsets/page_blocks.yaml');
        $builder = YAML::file($path)->parse();

        if (! isset($builder['fields'][0]['field']['sets'][$group])) {
            $groups = implode(', ', array_keys($builder['fields'][0]['field']['sets']));
            $this->components->error("Unknown builder group \"{$group}\". Available: {$groups}");

            return false;
        }

        $builder['fields'][0]['field']['sets'][$group]['sets'][$handle] = [
            'display' => $display,
            'icon' => $this->option('icon'),
            'fields' => [
                ['import' => $handle],
            ],
        ];

        File::put($path, YAML::dump($builder));
        $this->components->task("registered builder set under \"{$group}\"");

        return true;
    }

    protected function writeFieldset(string $handle, string $title): void
    {
        $contents = [
            'title' => $title,
            'fields' => [
                ['import' => 'group_theme'],
                ['import' => 'group_content'],
            ],
        ];

        File::put(resource_path("fieldsets/{$handle}.yaml"), YAML::dump($contents));
        $this->components->task("created resources/fieldsets/{$handle}.yaml");
    }

    protected function writePartial(string $handle): void
    {
        $kebab = str($handle)->after('_')->replace('_', '-')->toString();

        $stub = <<<ANTLERS
        {{ partial:partials.section }}
            <div class="{$kebab}-container py-16 lg:py-24 bg-surface">
                <div class="container">
                    {{ partial:partials.content_group
                        :eyebrow_text="eyebrow_text"
                        :heading="heading"
                        :content="description"
                    }}

                    {{# TODO: block-specific markup. Use partials/ atoms (_button via partials.link, _media, _carousel). #}}
                </div>
            </div>
        {{ /partial:partials.section }}

        ANTLERS;

        File::put(resource_path("views/page_blocks/_{$handle}.antlers.html"), $stub);
        $this->components->task("created resources/views/page_blocks/_{$handle}.antlers.html");
    }
}
