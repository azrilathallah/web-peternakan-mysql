<?php

namespace App\Filament\Widgets;

use App\Models\Pakan;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PakanChart extends ChartWidget
{
    protected ?string $heading = 'Konsumsi Pakan 30 Hari Terakhir';
    protected ?string $maxHeight = '300px';

    protected function getData(): array
    {
        $startDate = Carbon::now()->subDays(30);
        
        $data = Pakan::select(
                'tanggal',
                DB::raw('SUM(konsumsi_pakan) as total_konsumsi'),
                DB::raw('COUNT(DISTINCT kandang_id) as jumlah_kandang')
            )
            ->where('tanggal', '>=', $startDate)
            ->groupBy('tanggal')
            ->orderBy('tanggal')
            ->get();

        return [
            'datasets' => [
                [
                    'label' => 'Konsumsi Pakan (gr)',
                    'data' => $data->pluck('total_konsumsi'),
                    'borderWidth' => 2,
                    'borderColor' => 'rgb(59, 130, 246)',
                    'backgroundColor' => 'rgba(59, 130, 246, 0.1)',
                    'barPercentage' => 0.6,
                ]
            ],
            'labels' => $data->pluck('tanggal')->map(function ($date) {
                return Carbon::parse($date)->format('d M');
            }),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }

    protected function getOptions(): array
    {
        return [
            'plugins' => [
                'legend' => [
                    'display' => true,
                    'position' => 'top',
                ],
                'tooltip' => [
                    'mode' => 'index',
                    'intersect' => false,
                ],
            ],
            'scales' => [
                'y' => [
                    'beginAtZero' => true,
                    'title' => [
                        'display' => true,
                        'text' => 'Pakan (gr)'
                    ],
                    'grid' => [
                        'drawBorder' => false,
                    ],
                ],
                'x' => [
                    'title' => [
                        'display' => true,
                        'text' => 'Tanggal'
                    ],
                    'grid' => [
                        'display' => false,
                    ],
                ],
            ],
            'maintainAspectRatio' => false,
        ];
    }
}