<?php

namespace App\Filament\Widgets;

use App\Models\Pakan;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class PakanChart extends ChartWidget
{
    protected ?string $heading = 'Pakan Chart'; 

    protected function getData(): array
    {
        $data = Pakan::select(
                'tanggal',
                DB::raw('SUM(konsumsi_pakan) as total_konsumsi')
            )
            ->groupBy('tanggal')
            ->orderBy('tanggal')
            ->get();

        return [
            'datasets' => [
                [
                    'label' => 'Konsumsi Pakan',
                    'data' => $data->pluck('total_konsumsi'),
                    'borderWidth' => 3,
                    'borderColor' => 'orange',
                    'backgroundColor' => 'rgba(255,165,0,0.25)',
                ]
            ],
            'labels' => $data->pluck('tanggal'),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
