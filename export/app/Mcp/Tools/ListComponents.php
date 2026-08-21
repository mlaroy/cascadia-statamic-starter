<?php

namespace App\Mcp\Tools;

use App\Components\ComponentInventory;
use Illuminate\Contracts\JsonSchema\JsonSchema;
use Laravel\Mcp\Request;
use Laravel\Mcp\Response;
use Laravel\Mcp\Server\Tool;
use Laravel\Mcp\Server\Tools\Annotations\IsReadOnly;
use Statamic\Facades\Fieldset;

#[IsReadOnly]
class ListComponents extends Tool
{
    protected string $description = 'List the page builder components with their catalog guidance (use_when, avoid_when, content_expectations, pairs_with) and, optionally, their field definitions. Consult this before composing a page plan for assemble_page.';

    public function __construct(protected ComponentInventory $inventory) {}

    public function schema(JsonSchema $schema): array
    {
        return [
            'component' => $schema->string()
                ->description('A single component handle (e.g. content_basic_hero) to get full detail for, including resolved field definitions. Omit to list all components with catalog guidance only.'),
        ];
    }

    public function handle(Request $request): Response
    {
        if ($handle = $request->get('component')) {
            return $this->detail($handle);
        }

        $sets = $this->inventory->builderSets();

        $components = $this->inventory->catalogEntries()->map(fn ($entry, $slug) => [
            'component' => $slug,
            'title' => $entry->get('title'),
            'builder_group' => $entry->get('builder_group'),
            'description' => $entry->get('description'),
            'use_when' => $entry->get('use_when'),
            'avoid_when' => $entry->get('avoid_when'),
            'content_expectations' => $entry->get('content_expectations'),
            'tags' => $entry->get('component_tags', []),
            'pairs_with' => collect($entry->get('pairs_with', []))
                ->map(fn ($id) => \Statamic\Facades\Entry::find($id)?->slug())
                ->filter()
                ->values()
                ->all(),
            'in_builder' => $sets->has($slug),
        ])->values()->all();

        return Response::json($components);
    }

    protected function detail(string $handle): Response
    {
        $fieldset = Fieldset::find($handle);

        if (! $fieldset) {
            return Response::error("Unknown component \"{$handle}\". Available: ".$this->inventory->builderSets()->keys()->sort()->implode(', '));
        }

        $entry = $this->inventory->catalogEntries()->get($handle);

        return Response::json([
            'component' => $handle,
            'catalog' => $entry ? [
                'description' => $entry->get('description'),
                'use_when' => $entry->get('use_when'),
                'avoid_when' => $entry->get('avoid_when'),
                'content_expectations' => $entry->get('content_expectations'),
            ] : null,
            'fields' => $fieldset->fields()->all()->map(fn ($field) => [
                'handle' => $field->handle(),
                'type' => $field->type(),
                'display' => $field->display(),
                'config' => collect($field->config())->only([
                    'options', 'default', 'max_items', 'max_files', 'collections',
                    'container', 'sets', 'fields', 'if', 'instructions',
                ])->filter()->all(),
            ])->values()->all(),
        ]);
    }
}
