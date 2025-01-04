<?php

namespace App\Filament\SportFederation\Widgets;

use App\Models\Club;
use App\Models\Player;
use App\Models\Report;
use App\Models\Request;
use App\Models\SportFederation;
use App\Models\User;
use Filament\Facades\Filament;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverviewWidget extends BaseWidget
{
    use InteractsWithPageFilters;

    protected static ?int $sort = 0;

    protected function getStats(): array
    {
        //cleanup the code
        $totalSportFederations = SportFederation::count();
        $totalClubs        = Club::where('sport_federation_id', Filament::auth()->user()->sport_federation_id)->count();
        $totalPlayers      = Player::where('sport_federation_id', Filament::auth()->user()->sport_federation_id)->count();
        $totalReports      = Report::where('sport_federation_id', Filament::auth()->user()->sport_federation_id)->count();
        $totalRequests     = Request::where('sport_federation_id', Filament::auth()->user()->sport_federation_id)->count();
        $totalUsers        = User::where('sport_federation_id', Filament::auth()->user()->sport_federation_id)->count();

        return [
            Stat::make('عدد الاتحادات الرياضي الكلي', $totalSportFederations)
                ->chart([7, 2, 10, 3, 15, 4, 17])
                ->color('success'),

            Stat::make('عدد الأندية التابعة للاتحاد الرياضي', $totalClubs)
                ->chart([5, 8, 13, 5, 20, 6, 18])
                ->color('danger'),

            Stat::make('عدد اللاعبين  التابعة للاتحاد الرياضي', $totalPlayers)
                ->chart([4, 6, 11, 2, 10, 3, 12])
                ->color('primary'),

            Stat::make('عدد الطلبات  التابعة للاتحاد الرياضي', $totalRequests)
                ->chart([3, 5, 8, 4, 12, 5, 9])
                ->color('info'),

            Stat::make('عدد البلاغات  التابعة للاتحاد الرياضي', $totalReports)
                ->chart([6, 3, 7, 9, 14, 2, 15])
                ->color('warning'),

            Stat::make('عدد المستخدمين  التابعة للاتحاد الرياضي', $totalUsers)
                ->chart([9, 11, 8, 12, 16, 9, 13])
                ->color('secondary'),
        ];
    }
}
