<?php

namespace App\Filament\Admin\Widgets;

use App\Enums\ContractStateEnum;
use App\Enums\PlayerStateEnum;
use App\Enums\RequestStateEnum;
use App\Models\Club;
use App\Models\Contract;
use App\Models\Player;
use App\Models\Report;
use App\Models\Request;
use App\Models\SportFederation;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Database\Eloquent\Collection;

class StatsOverviewWidget extends BaseWidget
{
    protected static ?int $sort = 0;

    protected function getStats(): array
    {
        // Organizations stats
        $totalSportFederations = SportFederation::count();
        $totalClubs = Club::count();
        $totalUsers = User::count();

        // Players stats
        $totalPlayers = Player::count();
        $activePlayers = Player::where('state', PlayerStateEnum::Active)->count();
        $inactivePlayers = Player::where('state', PlayerStateEnum::Inactive)->count();
        $injuredPlayers = Player::where('state', PlayerStateEnum::Injured)->count();
        $suspendedPlayers = Player::where('state', PlayerStateEnum::Suspended)->count();

        // Contracts stats
        $contracts = Contract::all();
        $totalContracts = $contracts->count();
        $activeContracts = $contracts->filter(fn ($contract) => $contract->state === ContractStateEnum::Active)->count();
        $expiredContracts = $contracts->filter(fn ($contract) => $contract->state === ContractStateEnum::Expired)->count();
        $notStartedContracts = $contracts->filter(fn ($contract) => $contract->state === ContractStateEnum::NotStarted)->count();

        // Requests stats
        $totalRequests = Request::count();
        $pendingRequests = Request::where('state', RequestStateEnum::Pending)->count();
        $approvedRequests = Request::where('state', RequestStateEnum::Approved)->count();
        $rejectedRequests = Request::where('state', RequestStateEnum::Rejected)->count();

        // Reports stats
        $totalReports = Report::count();

        return [
            // Organizations Section
            Stat::make(__('Total Sport Federations'), $totalSportFederations)
                ->description(__('Active sport federations'))
                ->chart([7, 2, 10, 3, 15, 4, 17])
                ->color('success'),

            Stat::make(__('Total Clubs'), $totalClubs)
                ->description(__('Registered clubs'))
                ->chart([5, 8, 13, 5, 20, 6, 18])
                ->color('info'),

            Stat::make(__('Total Users'), $totalUsers)
                ->description(__('System users'))
                ->chart([9, 11, 8, 12, 16, 9, 13])
                ->color('warning'),

            // Players Section
            Stat::make(__('Total Players'), $totalPlayers)
                ->description(__('Active: :count', ['count' => $activePlayers]))
                ->chart([4, 6, 11, 2, 10, 3, 12])
                ->color('success'),

            Stat::make(__('Injured Players'), $injuredPlayers)
                ->description(__('Suspended: :count', ['count' => $suspendedPlayers]))
                ->chart([2, 3, 5, 1, 4, 2, 6])
                ->color('danger'),

            Stat::make(__('Inactive Players'), $inactivePlayers)
                ->description(__('Not currently active'))
                ->chart([3, 4, 6, 2, 5, 3, 7])
                ->color('gray'),

            // Contracts Section
            Stat::make(__('Total Contracts'), $totalContracts)
                ->description(__('Active: :count', ['count' => $activeContracts]))
                ->chart([5, 7, 12, 3, 11, 4, 13])
                ->color('success'),

            Stat::make(__('Expired Contracts'), $expiredContracts)
                ->description(__('Not Started: :count', ['count' => $notStartedContracts]))
                ->chart([2, 4, 7, 1, 6, 2, 8])
                ->color('warning'),

            // Requests Section
            Stat::make(__('Total Requests'), $totalRequests)
                ->description(__('Pending: :count', ['count' => $pendingRequests]))
                ->chart([3, 5, 8, 4, 12, 5, 9])
                ->color('primary'),

            Stat::make(__('Approved Requests'), $approvedRequests)
                ->description(__('Rejected: :count', ['count' => $rejectedRequests]))
                ->chart([2, 3, 6, 2, 7, 3, 8])
                ->color('success'),

            // Reports Section
            Stat::make(__('Total Reports'), $totalReports)
                ->description(__('All submitted reports'))
                ->chart([6, 3, 7, 9, 14, 2, 15])
                ->color('danger'),
        ];
    }
}
