<?php

namespace App\Filament\SportFederation\Widgets;

use App\Models\Contract;
use Carbon\Carbon;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class ContractsOverTimeChart extends ChartWidget
{
    protected static ?string $heading = 'العقود على مر الزمن';
    protected static ?int $sort = 3;

    protected function getData(): array
    {
        $sportFederationId = auth()->user()->sport_federation_id;

        $databaseDriver = DB::getDriverName();

        $contracts = Contract::where('sport_federation_id', $sportFederationId)
            ->where('created_at', '>=', Carbon::now()->subMonths(6))
            ->selectRaw(
                $databaseDriver === 'sqlite'
                    ? 'strftime("%Y-%m", created_at) as month'
                    : 'DATE_FORMAT(created_at, "%Y-%m") as month'
            )
            ->selectRaw('count(*) as count')
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('count', 'month')
            ->toArray();

        return [
            'datasets' => [
                [
                    'label' => __('New Contracts'),
                    'data' => array_values($contracts),
                    'borderColor' => 'rgb(59, 130, 246)',
                    'fill' => 'start',
                    'backgroundColor' => 'rgba(59, 130, 246, 0.1)',
                ],
            ],
            'labels' => array_map(function ($month) {
                return Carbon::createFromFormat('Y-m', $month)->format('M Y');
            }, array_keys($contracts)),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
