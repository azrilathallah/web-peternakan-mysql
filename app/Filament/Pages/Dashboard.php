<?php

namespace App\Filament\Pages;

use Filament\Pages\Dashboard as BaseDashboard;
use App\Filament\Widgets\StatsOverview;
use App\Filament\Widgets\ProduksiTelurChart;
use App\Filament\Widgets\PakanChart;

class Dashboard extends BaseDashboard
{
    public function getWidgets(): array
    {
        return [
            StatsOverview::class,
            ProduksiTelurChart::class,
            PakanChart::class,
        ];
    }

    public function getWidgetLayout(): array
    {
        return [
            'stats' => [
                StatsOverview::class,
            ],

            'charts' => [
                ['md' => 6, 'widget' => ProduksiTelurChart::class],
                ['md' => 6, 'widget' => PakanChart::class],
            ],
        ];
    }
}