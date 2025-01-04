<?php

namespace App\Filament\SportFederation\Widgets;

use App\Enums\ContractStateEnum;
use App\Enums\PlayerStateEnum;
use App\Enums\RequestStateEnum;
use App\Models\Club;
use App\Models\Contract;
use App\Models\Player;
use App\Models\Report;
use App\Models\Request;
use Carbon\Carbon;
use Filament\Support\Colors\Color;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\DB;

class SportFederationStatsOverview extends BaseWidget
{
    protected static ?int $sort = 0;
    protected int | string | array $columnSpan = 'full';

    protected function getStats(): array
    {
        $sportFederationId = auth()->user()->sport_federation_id;

        // Basic Stats
        $totalClubs = Club::where('sport_federation_id', $sportFederationId)->count();
        $totalPlayers = Player::where('sport_federation_id', $sportFederationId)->count();
        $totalContracts = Contract::where('sport_federation_id', $sportFederationId)->count();

        // Players Stats by State
        $playersByState = Player::where('sport_federation_id', $sportFederationId)
            ->select('state', DB::raw('count(*) as count'))
            ->groupBy('state')
            ->pluck('count', 'state')
            ->toArray();

        // Monthly New Players
        $monthlyPlayers = Player::where('sport_federation_id', $sportFederationId)
            ->where('created_at', '>=', Carbon::now()->subMonths(6))
            ->select(DB::raw('MONTH(created_at) as month'), DB::raw('count(*) as count'))
            ->groupBy('month')
            ->pluck('count', 'month')
            ->toArray();

        // Contracts Analysis
        $contracts = Contract::where('sport_federation_id', $sportFederationId)->get();
        $activeContracts = $contracts->filter(fn ($contract) => $contract->state === ContractStateEnum::Active)->count();
        $expiredContracts = $contracts->filter(fn ($contract) => $contract->state === ContractStateEnum::Expired)->count();
        $notStartedContracts = $contracts->filter(fn ($contract) => $contract->state === ContractStateEnum::NotStarted)->count();

        // Requests Analysis
        $pendingRequests = Request::where('sport_federation_id', $sportFederationId)
            ->where('state', RequestStateEnum::Pending)
            ->count();

        // Reports Count
        $totalReports = Report::where('sport_federation_id', $sportFederationId)->count();

        return [
            // Clubs and Players Overview
            Stat::make(__('Total Clubs'), $totalClubs)
                ->description(__('Registered clubs in federation'))
                ->descriptionIcon('heroicon-m-building-office-2')
                ->color(Color::Blue)
                ->chart([7, 4, 6, 8, 5, $totalClubs]),

            Stat::make(__('Total Players'), $totalPlayers)
                ->description(__('Active Players: :count', ['count' => $playersByState[PlayerStateEnum::Active->value] ?? 0]))
                ->descriptionIcon('heroicon-m-user-group')
                ->color(Color::Emerald)
                ->chart(array_values($monthlyPlayers)),

            Stat::make(__('Players Distribution'), '')
                ->description(__('By State'))
                ->descriptionIcon('heroicon-m-chart-pie')
                ->chart([
                    $playersByState[PlayerStateEnum::Active->value] ?? 0,
                    $playersByState[PlayerStateEnum::Inactive->value] ?? 0,
                    $playersByState[PlayerStateEnum::Injured->value] ?? 0,
                    $playersByState[PlayerStateEnum::Suspended->value] ?? 0,
                ])
                ->color(Color::Amber),

            // Contracts Overview
            Stat::make(__('Active Contracts'), $activeContracts)
                ->description(__('From :total total contracts', ['total' => $totalContracts]))
                ->descriptionIcon('heroicon-m-document-check')
                ->color(Color::Green)
                ->chart([$notStartedContracts, $activeContracts, $expiredContracts]),

            // Requests and Reports
            Stat::make(__('Pending Requests'), $pendingRequests)
                ->description(__('Require attention'))
                ->descriptionIcon('heroicon-m-clock')
                ->color(Color::Orange)
                ->chart([2, 4, 6, $pendingRequests, 3, 5]),

            Stat::make(__('Total Reports'), $totalReports)
                ->description(__('Submitted reports'))
                ->descriptionIcon('heroicon-m-document-text')
                ->color(Color::Red)
                ->chart([3, 5, $totalReports, 4, 7, 5]),
        ];
    }
} 