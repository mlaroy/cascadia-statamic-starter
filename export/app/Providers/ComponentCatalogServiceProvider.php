<?php

namespace App\Providers;

use App\Mcp\Tools\AuditComponents;
use App\Mcp\Tools\ListComponents;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Laravel\Mcp\Server\Tool;
use Statamic\Facades\CP\Nav;
use Statamic\Facades\Permission;
use Statamic\Statamic;

/**
 * Owns the kit's component-catalog system end to end: the conventions
 * audit, the catalog sync, and everything that exposes them (MCP tools,
 * CP permissions, CP routes, CP nav). Kept separate from AppServiceProvider
 * so the whole system is one self-contained unit to port into other kit
 * installs. Deliberately has no dependency on Scout or any other addon —
 * its own permission group, its own nav entry, its own page.
 */
class ComponentCatalogServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->registerMcpTools();
        $this->registerPermissions();
        $this->registerNav();
        $this->registerCpRoutes();
    }

    /**
     * Merge the component system's tools into Laravel Boost's MCP server,
     * the same way statamic-boost registers its own.
     */
    protected function registerMcpTools(): void
    {
        if (! class_exists(Tool::class)) {
            return;
        }

        config(['boost.mcp.tools.include' => array_merge(config('boost.mcp.tools.include', []), [
            ListComponents::class,
            AuditComponents::class,
        ])]);
    }

    protected function registerPermissions(): void
    {
        Permission::extend(function () {
            Permission::group('components', 'Components', function () {
                Permission::register('audit components')
                    ->label('Run the component conventions audit');

                Permission::register('sync component catalog')
                    ->label('Run component catalog sync');
            });
        });
    }

    protected function registerNav(): void
    {
        Nav::extend(function ($nav) {
            $nav->create('Components')
                ->section('System')
                ->url('cascadia/components')
                ->icon('puzzle-piece')
                ->can('audit components');
        });
    }

    protected function registerCpRoutes(): void
    {
        Statamic::pushCpRoutes(function () {
            Route::prefix('cascadia/components')
                ->name('cascadia.components.')
                ->group(base_path('routes/cp.php'));
        });
    }
}
