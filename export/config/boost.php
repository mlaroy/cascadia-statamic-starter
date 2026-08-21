<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Guidelines
    |--------------------------------------------------------------------------
    |
    | The statamic-boost package guideline contains unescaped Antlers syntax
    | that breaks Blade rendering (v1.2.1). We exclude it and ship a fixed
    | copy (wrapped in @verbatim) at .ai/guidelines/statamic.blade.php.
    |
    */

    'guidelines' => [
        'exclude' => [
            'chrisvasey/statamic-boost',
        ],
    ],

];
