<?php

namespace App\Mcp\Tools;

use Illuminate\Contracts\JsonSchema\JsonSchema;
use Illuminate\Support\Facades\Artisan;
use Laravel\Mcp\Request;
use Laravel\Mcp\Response;
use Laravel\Mcp\Server\Tool;
use Laravel\Mcp\Server\Tools\Annotations\IsReadOnly;

#[IsReadOnly]
class AuditComponents extends Tool
{
    protected string $description = 'Run the component system conventions audit (name chain, builder purity, catalog integrity, theme keys vs CSS classes). Run this after any change to fieldsets, builder sets, partials, or the component catalog.';

    public function schema(JsonSchema $schema): array
    {
        return [];
    }

    public function handle(Request $request): Response
    {
        $exitCode = Artisan::call('components:audit');

        return Response::json([
            'passed' => $exitCode === 0,
            'output' => trim(Artisan::output()),
        ]);
    }
}
