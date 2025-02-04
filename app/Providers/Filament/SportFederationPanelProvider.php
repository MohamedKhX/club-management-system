<?php

namespace App\Providers\Filament;

use App\Filament\SportFederation\Widgets\StatsOverviewWidget;
use App\Filament\SportFederation\Widgets\SportFederationStatsOverview;
use App\Filament\SportFederation\Widgets\PlayersDistributionChart;
use App\Filament\SportFederation\Widgets\ContractsOverTimeChart;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\View\PanelsRenderHook;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class SportFederationPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('sportFederation')
            ->font('Rubik')
            ->login()
            ->passwordReset()
            ->renderHook(PanelsRenderHook::AUTH_LOGIN_FORM_BEFORE, function () {
                return '<div class="text-center font-bold text-purple-600 text-sm">الاتحاد الرياضي</div>';
            })
            ->path('sportFederation')
            ->colors([
                'primary' => Color::Cyan,
                'gray' => Color::Gray,
                'green' => Color::Green,
                'red' => Color::Red,
                'yellow' => Color::Yellow,
                'blue' => Color::Blue,
                'orange' => Color::Orange,
                'darkgreen' => '#28a745',
                'purple' => Color::Purple,
                'teal' => Color::Teal,
            ])
            ->discoverResources(in: app_path('Filament/SportFederation/Resources'), for: 'App\\Filament\\SportFederation\\Resources')
            ->discoverPages(in: app_path('Filament/SportFederation/Pages'), for: 'App\\Filament\\SportFederation\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/SportFederation/Widgets'), for: 'App\\Filament\\SportFederation\\Widgets')
            ->widgets([
                SportFederationStatsOverview::class,
                PlayersDistributionChart::class,
                ContractsOverTimeChart::class,
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
            ])
            ->databaseNotifications();
    }
}
