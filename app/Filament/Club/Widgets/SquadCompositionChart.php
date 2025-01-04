<?php

namespace App\Filament\Club\Widgets;

use App\Models\Player;
use Carbon\Carbon;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class SquadCompositionChart extends ChartWidget
{
    protected static ?string $heading = 'تكوين الفرقة';
    protected static ?int $sort = 2;
    protected static ?string $maxHeight = '300px';

    protected function getData(): array
    {
        $clubId = auth()->user()->club_id;

        $playersByPosition = Player::whereHas('contracts', function ($query) use ($clubId) {
            $query->where('club_id', $clubId)
                ->where('end_date', '>=', now());
        })
            ->select('position', DB::raw('count(*) as count'))
            ->groupBy('position')
            ->pluck('count', 'position')
            ->toArray();

        return [
            'datasets' => [
                [
                    'label' => __('Players'),
                    'data' => array_values($playersByPosition),
                    'backgroundColor' => [
                        'rgb(34, 197, 94)',  // Goalkeepers
                        'rgb(59, 130, 246)', // Defenders
                        'rgb(234, 179, 8)',  // Midfielders
                        'rgb(239, 68, 68)',  // Forwards
                    ],
                ],
            ],
            'labels' => array_map(fn($position) => __($position), array_keys($playersByPosition)),
        ];
    }

    protected function getType(): string
    {
        return 'pie';
    }
}
