<?php

/**
 * statamic-boost v1.2.1 ships a Boost guideline containing raw Antlers
 * examples ({{ ... }}), which Blade tries to compile and fatals on.
 * Laravel Boost renders third-party guidelines before applying the
 * config('boost.guidelines.exclude') filter, so excluding it is not
 * enough — the file itself must be Blade-safe. This wraps it in
 * @verbatim until it is fixed upstream.
 */
$file = __DIR__.'/../vendor/chrisvasey/statamic-boost/resources/boost/guidelines/core.blade.php';

if (! file_exists($file)) {
    return;
}

$contents = file_get_contents($file);

if (str_starts_with($contents, '@verbatim')) {
    return;
}

file_put_contents($file, "@verbatim\n".$contents."\n@endverbatim\n");

echo "Patched statamic-boost guideline for Blade safety.\n";
