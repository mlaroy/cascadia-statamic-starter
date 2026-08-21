<?php

namespace App\Widgets;

use Statamic\Widgets\Widget;

class EnvironmentInfo extends Widget
{
    public function html()
    {
        $environment = config('app.env', 'production');

        if ($environment === 'production') {
            return null;
        }

        return view('widgets.environment-info', [
            'environment' => $environment,
            'label' => $this->label($environment),
            'url' => config('app.url'),
        ]);
    }

    private function label(string $environment): string
    {
        return match ($environment) {
            'local' => 'Local',
            'staging' => 'Staging',
            default => ucfirst($environment),
        };
    }
}
