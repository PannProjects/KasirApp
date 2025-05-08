<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Theme mode
    |--------------------------------------------------------------------------
    |
    | This option determines how the theme will be set for the application.
    | By default global mode is set to use one theme for all users. If you
    | want to set a theme for each user separately, then set to 'user'.
    |
    */

    'mode' => 'global',

    /*
    |--------------------------------------------------------------------------
    | Theme Icon
    |--------------------------------------------------------------------------
    */

    'icon' => 'heroicon-o-swatch',

    /*
    |--------------------------------------------------------------------------
    | Default Theme
    |--------------------------------------------------------------------------
    */

    'default' => [
        'theme' => 'custom',
        'theme_color' => 'primary',
    ],

    'themes' => [
        'custom' => [
            'name' => 'Custom Theme',
            'colors' => [
                'primary' => '#636D4A',
                'secondary' => '#A5AB85',
                'accent' => '#A78963',
                'brown' => '#916639',
                'dark' => '#5A2F0D',
            ],
            'css' => 'hasnayeen/themes/custom.css',
        ],
    ],
];
