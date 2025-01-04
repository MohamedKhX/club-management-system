<?php

namespace App\Filament\Club\Widgets;

use App\Enums\ContractStateEnum;
use App\Enums\PlayerStateEnum;
use App\Enums\RequestStateEnum;
use App\Models\Contract;
use App\Models\Player;
use App\Models\Report;
use App\Models\Request;
use Carbon\Carbon;
use Filament\Support\Colors\Color;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\DB;

class ClubStatsOverview extends BaseWidget
{
    protected static ?int $sort = 0;
    protected int | string | array $columnSpan = 'full';

    protected function getStats(): array
    {
        $clubId = auth()->user()->club_id;

        // Squad Analysis
        $totalPlayers = Player::whereHas('contracts', function ($query) use ($clubId) {
            $query->where('club_id', $clubId)
                ->where('end_date', '>=', now());
        })->count();

        $playersByState = Player::whereHas('contracts', function ($query) use ($clubId) {
            $query->where('club_id', $clubId)
                ->where('end_date', '>=', now());
        })
            ->select('state', DB::raw('count(*) as count'))
            ->groupBy('state')
            ->pluck('count', 'state')
            ->toArray();

        // Contract Analysis
        $contracts = Contract::where('club_id', $clubId)->get();
        $activeContracts = $contracts->filter(fn ($contract) => $contract->state === ContractStateEnum::Active)->count();
        $expiringContracts = Contract::where('club_id', $clubId)
            ->whereBetween('end_date', [now(), now()->addMonths(3)])
            ->count();

        // Financial Overview
        $activeContractsCollection = Contract::where('club_id', $clubId)->get()
            ->filter(fn ($contract) => $contract->state === ContractStateEnum::Active);
        $totalContractValue = $activeContractsCollection->sum('amount');

        // Requests Overview
        $pendingRequests = Request::where('club_id', $clubId)
            ->where('state', RequestStateEnum::Pending)
            ->count();

        $approvedRequests = Request::where('club_id', $clubId)
            ->where('state', RequestStateEnum::Approved)
            ->count();

        // Reports Count
        $totalReports = Report::where('club_id', $clubId)->count();

        return [
            // Squad Overview
            Stat::make(__('Squad Size'), $totalPlayers)
                ->description(__('Active squad members'))
                ->descriptionIcon('heroicon-m-user-group')
                ->color(Color::Blue)
                ->chart([
                    $playersByState[PlayerStateEnum::Active->value] ?? 0,
                    $playersByState[PlayerStateEnum::Injured->value] ?? 0,
                    $playersByState[PlayerStateEnum::Suspended->value] ?? 0,
                ]),

            Stat::make(__('Injured Players'), $playersByState[PlayerStateEnum::Injured->value] ?? 0)
                ->description(__('Players unavailable'))
                ->descriptionIcon('heroicon-m-heart')
                ->color(Color::Red)
                ->chart([2, 3, 5, 4, 6, $playersByState[PlayerStateEnum::Injured->value] ?? 0]),

            // Contract Stats
            Stat::make(__('Active Contracts'), $activeContracts)
                ->description(__('Expiring soon: :count', ['count' => $expiringContracts]))
                ->descriptionIcon('heroicon-m-document-check')
                ->color(Color::Green)
                ->chart([$expiringContracts, $activeContracts]),

            // Financial Overview
            Stat::make(__('Contract Value'), number_format($totalContractValue, 2) . ' د.ل')
                ->description(__('Total active contracts value'))
                ->descriptionIcon('heroicon-m-banknotes')
                ->color(Color::Yellow)
                ->chart([
                    $totalContractValue * 0.2,
                    $totalContractValue * 0.4,
                    $totalContractValue * 0.6,
                    $totalContractValue * 0.8,
                    $totalContractValue,
                ]),

            // Requests Overview
            Stat::make(__('Pending Requests'), $pendingRequests)
                ->description(__('Approved: :count', ['count' => $approvedRequests]))
                ->descriptionIcon('heroicon-m-clock')
                ->color(Color::Orange)
                ->chart([$pendingRequests, $approvedRequests]),

            // Reports Overview
            Stat::make(__('Reports'), $totalReports)
                ->description(__('Total submitted reports'))
                ->descriptionIcon('heroicon-m-document-text')
                ->color(Color::Purple)
                ->chart([2, 4, $totalReports, 3, 5, 4]),
        ];
    }
} 