<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Club;
use App\Models\News;
use App\Models\Player;
use App\Models\Report;
use App\Models\Request;
use App\Models\RequestType;
use App\Models\Service;
use App\Models\SportFederation;
use App\Models\User;
use Carbon\Carbon;
use Filament\Facades\Filament;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Number;

class StatsOverviewWidget extends BaseWidget
{
    use InteractsWithPageFilters;

    protected static ?int $sort = 0;

    protected function getStats(): array
    {
        $totalSportFederations = SportFederation::count();
        $totalClubs        = Club::count();
        $totalPlayers      = Player::count();
        $totalReports      = Report::count();
        $totalRequests     = Request::count();
        $totalUsers        = User::count();

        return [
            Stat::make('عدد الاتحادات الرياضي الكلي', $totalSportFederations)
                ->chart([7, 2, 10, 3, 15, 4, 17])
                ->color('success'),

            Stat::make('عدد الأندية الكلي', $totalClubs)
                ->chart([5, 8, 13, 5, 20, 6, 18])
                ->color('danger'),

            Stat::make('عدد اللاعبين الكلي', $totalPlayers)
                ->chart([4, 6, 11, 2, 10, 3, 12])
                ->color('primary'),

            Stat::make('عدد الطلبات الكلي', $totalRequests)
                ->chart([3, 5, 8, 4, 12, 5, 9])
                ->color('info'),

            Stat::make('عدد البلاغات الكلي', $totalReports)
                ->chart([6, 3, 7, 9, 14, 2, 15])
                ->color('warning'),

            Stat::make('عدد المستخدمين الكلي', $totalUsers)
                ->chart([9, 11, 8, 12, 16, 9, 13])
                ->color('secondary'),
        ];
    }
}
