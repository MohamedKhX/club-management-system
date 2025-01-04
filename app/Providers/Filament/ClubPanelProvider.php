<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
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
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use App\Filament\Club\Widgets\ClubStatsOverview;
use App\Filament\Club\Widgets\SquadCompositionChart;
use App\Filament\Club\Widgets\ContractValuesChart;

class ClubPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('club')
            ->font('Rubik')
            ->path('club')
            ->colors([
                'primary' => Color::Red,
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
            ->discoverResources(in: app_path('Filament/Club/Resources'), for: 'App\\Filament\\Club\\Resources')
            ->discoverPages(in: app_path('Filament/Club/Pages'), for: 'App\\Filament\\Club\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Club/Widgets'), for: 'App\\Filament\\Club\\Widgets')
            ->widgets([

                ClubStatsOverview::class,
                SquadCompositionChart::class,
                ContractValuesChart::class,
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
