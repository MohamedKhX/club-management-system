<?php

namespace App\Filament\Club\Widgets;

use App\Models\Contract;
use Carbon\Carbon;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class ContractValuesChart extends ChartWidget
{
    protected static ?string $heading = 'قيم العقد مع مرور الوقت';
    protected static ?int $sort = 3;

    protected function getData(): array
    {
        $clubId = auth()->user()->club_id;

        $contractValues = Contract::where('club_id', $clubId)
            ->where('created_at', '>=', Carbon::now()->subMonths(12))
            ->select(
                DB::raw('DATE_FORMAT(created_at, "%Y-%m") as month'),
                DB::raw('SUM(amount) as total_value'),
                DB::raw('COUNT(*) as count')
            )
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        return [
            'datasets' => [
                [
                    'label' => __('Contract Values (د.ل)'),
                    'data' => $contractValues->pluck('total_value')->toArray(),
                    'borderColor' => 'rgb(59, 130, 246)',
                    'fill' => 'start',
                    'backgroundColor' => 'rgba(59, 130, 246, 0.1)',
                ],
                [
                    'label' => __('Number of Contracts'),
                    'data' => $contractValues->pluck('count')->toArray(),
                    'borderColor' => 'rgb(234, 179, 8)',
                    'fill' => 'start',
                    'backgroundColor' => 'rgba(234, 179, 8, 0.1)',
                    'yAxisID' => 'count',
                ],
            ],
            'labels' => $contractValues->map(function ($value) {
                return Carbon::createFromFormat('Y-m', $value->month)->format('M Y');
            })->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }

    protected function getOptions(): array
    {
        return [
            'scales' => [
                'y' => [
                    'beginAtZero' => true,
                    'position' => 'left',
                    'title' => [
                        'display' => true,
                        'text' => __('Contract Value (د.ل)'),
                    ],
                ],
                'count' => [
                    'beginAtZero' => true,
                    'position' => 'right',
                    'title' => [
                        'display' => true,
                        'text' => __('Number of Contracts'),
                    ],
                    'grid' => [
                        'drawOnChartArea' => false,
                    ],
                ],
            ],
        ];
    }
}
