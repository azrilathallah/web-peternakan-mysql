<?php

namespace App\Filament\Widgets;

use App\Models\ProduksiTelur;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class ProduksiTelurChart extends ChartWidget
{
    protected ?string $heading = 'Produksi Telur Chart';

    protected function getData(): array
    {
        $data = ProduksiTelur::select(
                'tanggal',
                DB::raw('SUM(total_telur) as total_telur_harian')
            )
            ->groupBy('tanggal')
            ->orderBy('tanggal')
            ->get();

        return [
            'datasets' => [
                [
                    'label' => 'Total Telur',
                    'data' => $data->pluck('total_telur_harian'),
                    'borderWidth' => 3,
                    'borderColor' => 'orange',
                    'backgroundColor' => 'rgba(255,165,0,0.25)',
                ],
            ],
            'labels' => $data->pluck('tanggal'),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
