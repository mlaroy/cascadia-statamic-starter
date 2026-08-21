<?php

namespace App\Console\Commands;

use App\Components\ComponentInventory;
use Illuminate\Console\Command;
use Statamic\Facades\Entry;

class ComponentsSync extends Command
{
    protected $signature = 'components:sync {--prune : Delete catalog entries whose slug matches no fieldset}';

    protected $description = 'Stub component catalog entries for block fieldsets that lack one, and report or prune orphans';

    public function handle(ComponentInventory $inventory): int
    {
        $blocks = $inventory->blockFieldsets();
        $sets = $inventory->builderSets();
        $catalog = $inventory->catalogEntries();

        $created = 0;

        foreach ($blocks as $handle => $fieldset) {
            if ($catalog->has($handle)) {
                continue;
            }

            Entry::make()
                ->collection(ComponentInventory::CATALOG_COLLECTION)
                ->blueprint('component')
                ->slug($handle)
                ->data([
                    'title' => str($fieldset['title'])->after(' - ')->toString() ?: $handle,
                    'description' => 'TODO: describe this component.',
                    'use_when' => 'TODO: when should this component be chosen?',
                    'builder_group' => $sets->get($handle)['group'] ?? null,
                ])
                ->save();

            $this->components->task("created catalog entry: {$handle}");
            $created++;
        }

        $orphans = $catalog->keys()->reject(fn ($slug) => $blocks->has($slug));

        foreach ($orphans as $slug) {
            if ($this->option('prune')) {
                $catalog->get($slug)->delete();
                $this->components->task("pruned orphan entry: {$slug}");
            } else {
                $this->components->warn("orphan entry (no matching fieldset): {$slug} — use --prune to delete");
            }
        }

        $this->components->info(sprintf(
            '%d entr%s created, %d orphan%s %s.',
            $created,
            $created === 1 ? 'y' : 'ies',
            $orphans->count(),
            $orphans->count() === 1 ? '' : 's',
            $this->option('prune') ? 'pruned' : 'found',
        ));

        return self::SUCCESS;
    }
}
