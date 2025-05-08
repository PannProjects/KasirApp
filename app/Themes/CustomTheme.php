<?php

namespace App\Themes;

use Hasnayeen\Themes\Contracts\Theme;

class CustomTheme implements Theme
{
    public static function getName(): string
    {
        return 'custom';
    }

    public static function getPath(): string
    {
        return 'hasnayeen/themes/custom.css';
    }

    public function getThemeColor(): array
    {
        return [
            'primary' => '#636D4A',
            'secondary' => '#A5AB85',
            'accent' => '#A78963',
            'brown' => '#916639',
            'dark' => '#5A2F0D',
        ];
    }
}
