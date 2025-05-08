<?php

namespace App\Providers\Filament;

use Filament\Pages;
use Filament\Panel;
use Filament\Widgets;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Http\Middleware\Authenticate;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Filament\Http\Middleware\AuthenticateSession;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Joaopaulolndev\FilamentEditProfile\FilamentEditProfilePlugin;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
            ->colors([
                'primary' => [
                    50 => '238, 240, 235',
                    100 => '222, 224, 215',
                    200 => '190, 194, 175',
                    300 => '158, 164, 135',
                    400 => '126, 134, 95',
                    500 => '99, 109, 74',  // #636D4A
                    600 => '79, 86, 59',
                    700 => '59, 64, 44',
                    800 => '39, 43, 29',
                    900 => '20, 22, 15',
                    950 => '10, 11, 7',
                ],
                'secondary' => [
                    50 => '245, 245, 242',
                    100 => '235, 235, 229',
                    200 => '215, 215, 203',
                    300 => '195, 195, 177',
                    400 => '175, 175, 151',
                    500 => '165, 171, 133',  // #A5AB85
                    600 => '110, 114, 89',
                    700 => '82, 86, 63',
                    800 => '55, 58, 37',
                    900 => '27, 29, 11',
                    950 => '14, 15, 6',
                ],
                'accent' => [
                    50 => '245, 242, 239',
                    100 => '235, 229, 223',
                    200 => '215, 203, 191',
                    300 => '195, 177, 159',
                    400 => '175, 151, 127',
                    500 => '167, 137, 99',  // #A78963
                    600 => '110, 90, 66',
                    700 => '82, 67, 49',
                    800 => '55, 44, 32',
                    900 => '27, 22, 15',
                    950 => '14, 11, 8',
                ],
                'brown' => [
                    50 => '245, 240, 237',
                    100 => '235, 225, 219',
                    200 => '215, 195, 183',
                    300 => '195, 165, 147',
                    400 => '175, 135, 111',
                    500 => '145, 102, 57',  // #916639
                    600 => '97, 66, 38',
                    700 => '72, 49, 28',
                    800 => '48, 33, 18',
                    900 => '24, 16, 9',
                    950 => '12, 8, 4',
                ],
                'dark' => [
                    50 => '245, 242, 240',
                    100 => '235, 229, 225',
                    200 => '215, 203, 195',
                    300 => '195, 177, 165',
                    400 => '175, 151, 135',
                    500 => '90, 47, 13',  // #5A2F0D
                    600 => '60, 31, 9',
                    700 => '45, 23, 6',
                    800 => '30, 15, 4',
                    900 => '15, 8, 2',
                    950 => '8, 4, 1',
                ],
            ])
            ->plugin(
                \Hasnayeen\Themes\ThemesPlugin::make()
            )
            ->plugin(
                FilamentEditProfilePlugin::make()
                ->setIcon('heroicon-o-user')
                ->shouldShowAvatarForm(
                    value: true,
                    directory: 'avatars',
                ),
            )
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
                Widgets\FilamentInfoWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
                \Hasnayeen\Themes\Http\Middleware\SetTheme::class
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
