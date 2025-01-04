<?php

namespace App\Filament\SportFederation\Widgets;

use App\Enums\PlayerStateEnum;
use App\Models\Player;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class PlayersDistributionChart extends ChartWidget
{
    protected static ?string $heading = 'توزيع اللاعبين';
    protected static ?int $sort = 2;
    protected static ?string $maxHeight = '300px';

    protected function getData(): array
    {
        $sportFederationId = auth()->user()->sport_federation_id;

        $playersByState = Player::where('sport_federation_id', $sportFederationId)
            ->select('state', DB::raw('count(*) as count'))
            ->groupBy('state')
            ->pluck('count', 'state')
            ->toArray();

        return [
            'datasets' => [
                [
                    'label' => __('Players'),
                    'data' => array_values($playersByState),
                    'backgroundColor' => [
                        'rgb(34, 197, 94)', // Active - Green
                        'rgb(239, 68, 68)', // Inactive - Red
                        'rgb(234, 179, 8)',  // Injured - Yellow
                        'rgb(168, 162, 158)', // Suspended - Gray
                    ],
                ],
            ],
            'labels' => collect(PlayerStateEnum::cases())->map(fn ($state) => __($state->value))->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }
}
