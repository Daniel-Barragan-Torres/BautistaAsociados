<?php

namespace App\Providers\Filament;
use App\Filament\Widgets\CalendarioCitas;
use Filament\Pages\Dashboard;

use Illuminate\Support\Facades\View;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use App\Filament\Resources\ClienteResource;

class DashboardPanelProvider extends PanelProvider
{
    public function widgets(): array
    {
        return [
            CalendarioCitas::class,
            \Filament\Widgets\AccountWidget::class,
            \Filament\Widgets\FilamentInfoWidget::class,
        ];
    }
    public function panel(Panel $panel): Panel
    {
        return $panel

            ->default()
            ->id('dashboard')
            ->path('dashboard')
            ->brandLogo(asset('img/BA PNG.svg'))
            ->brandLogoHeight('4rem')


            ->darkMode(false)
            ->login()


            ->colors([
                'primary' => '#B8CD42',
            ])


            //->resources([ClienteResource::class])

            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
                \Filament\Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
                //  Widgets\FilamentInfoWidget::class,
                //Widgets\CalendarioCitas::class,
            ])
            ->discoverWidgets(in: app_path('Filament/PWidgets'), for: 'App\\Filament\\PWidgets')
            ->widgets([
                
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
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
