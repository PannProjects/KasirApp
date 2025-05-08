<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Hasnayeen\Themes\Themes;
use App\Themes\CustomTheme;

class ThemeServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(Themes::class, function () {
            return new Themes();
        });
    }

    public function boot()
    {
        // Register the custom theme
        $themes = $this->app->make(Themes::class);
        $themes->register([
            'custom' => CustomTheme::class
        ]);
    }
}
