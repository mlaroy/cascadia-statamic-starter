<?php

namespace App\Http\Controllers\Cp;

use App\Components\ComponentInventory;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;
use Inertia\Inertia;
use Inertia\Response;
use Statamic\Facades\User;

/**
 * The kit's component-catalog CP surface: the catalog entries themselves,
 * the last audit/sync result, and the actions to run them (also reachable
 * from the command palette). Entirely independent of Scout — no addon
 * required. Separate from Statamic's own "Components" collection nav
 * entry (which is for browsing/editing individual catalog entries as
 * content) — this page is the kit's tooling surface.
 */
class ComponentCatalogController extends Controller
{
    protected const CACHE_KEY = 'cascadia.components.last_run';

    public function page(ComponentInventory $inventory): Response
    {
        abort_unless(User::current()->can('audit components'), 403);

        return Inertia::render('ComponentCatalogPage', [
            'title' => 'Components',
            'canSync' => User::current()->can('sync component catalog'),
            'lastAudit' => Cache::get(self::CACHE_KEY.'.audit'),
            'lastSync' => Cache::get(self::CACHE_KEY.'.sync'),
            'entries' => $inventory->catalogEntries()->values()->map(fn ($entry) => [
                'title' => $entry->get('title'),
                'slug' => $entry->slug(),
                'builder_group' => $entry->get('builder_group'),
                'edit_url' => $entry->editUrl(),
            ])->sortBy('title')->values(),
        ]);
    }

    public function audit(): JsonResponse
    {
        abort_unless(User::current()->can('audit components'), 403);

        return response()->json($this->run('audit', 'components:audit'));
    }

    public function sync(Request $request): JsonResponse
    {
        abort_unless(User::current()->can('sync component catalog'), 403);

        return response()->json($this->run('sync', 'components:sync', $request->boolean('prune') ? ['--prune' => true] : []));
    }

    /**
     * @param  array<string, mixed>  $arguments
     * @return array{passed: bool, output: string, ran_at: string}
     */
    protected function run(string $key, string $command, array $arguments = []): array
    {
        $exitCode = Artisan::call($command, $arguments);

        $result = [
            'passed' => $exitCode === 0,
            'output' => trim(Artisan::output()),
            'ran_at' => now()->toIso8601String(),
        ];

        Cache::put(self::CACHE_KEY.'.'.$key, $result);

        return $result;
    }
}
