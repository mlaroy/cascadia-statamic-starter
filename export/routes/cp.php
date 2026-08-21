<?php

use App\Http\Controllers\Cp\ComponentCatalogController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| CP: Component Catalog
|--------------------------------------------------------------------------
|
| Registered via Statamic::pushCpRoutes() in ComponentCatalogServiceProvider,
| so this already runs inside Statamic's CP route group (prefix, auth, CP
| middleware). Per-action permissions are enforced in the controller.
|
*/

Route::get('/', [ComponentCatalogController::class, 'page'])->name('index');
Route::post('audit', [ComponentCatalogController::class, 'audit'])->name('audit');
Route::post('sync', [ComponentCatalogController::class, 'sync'])->name('sync');
