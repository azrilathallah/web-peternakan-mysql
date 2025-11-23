<?php

namespace App\Filament\Widgets;

use App\Models\Kandang;
use App\Models\Mortalitas;
use App\Models\Pakan;
use App\Models\ProduksiTelur;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Carbon;

class StatsOverview extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $today = Carbon::today();
        $weekStart = Carbon::now()->startOfWeek();     
        $monthStart = Carbon::now()->startOfMonth();   

        $totalPuyuh = Kandang::sum('jumlah_puyuh');

        $produksiHari = ProduksiTelur::whereDate('tanggal', $today)->sum('total_telur');
        $produksiMinggu = ProduksiTelur::whereDate('tanggal', '>=', $weekStart)->sum('total_telur');
        $produksiBulan = ProduksiTelur::whereDate('tanggal', '>=', $monthStart)->sum('total_telur');

        $matiHari = Mortalitas::whereDate('tanggal', $today)->sum('jumlah_mati');
        $matiMinggu = Mortalitas::whereDate('tanggal', '>=', $weekStart)->sum('jumlah_mati');
        $matiBulan = Mortalitas::whereDate('tanggal', '>=', $monthStart)->sum('jumlah_mati');

        $pakanHari = Pakan::whereDate('tanggal', $today)->sum('konsumsi_pakan');
        $pakanMinggu = Pakan::whereDate('tanggal', '>=', $weekStart)->sum('konsumsi_pakan');
        $pakanBulan = Pakan::whereDate('tanggal', '>=', $monthStart)->sum('konsumsi_pakan');

        $fmt = fn ($value) => number_format($value, 2, '.', ',');

        return [

            Stat::make('Total Puyuh', $totalPuyuh)
                ->description('Total populasi seluruh kandang')
                ->color('warning'),

            Stat::make('Produksi Hari Ini', $produksiHari)
                ->description('Produksi telur hari ini')
                ->color('success'),

            Stat::make('Produksi Minggu Ini', $produksiMinggu)
                ->description('Produksi telur minggu ini')
                ->color('success'),

            Stat::make('Produksi Bulan Ini', $produksiBulan)
                ->description('Produksi telur bulan ini')
                ->color('success'),

            Stat::make('Mortalitas Hari Ini', $matiHari)
                ->description('Jumlah kematian hari ini')
                ->color('danger'),

            Stat::make('Mortalitas Minggu Ini', $matiMinggu)
                ->description('Kematian minggu ini')
                ->color('danger'),

            Stat::make('Mortalitas Bulan Ini', $matiBulan)
                ->description('Kematian bulan ini')
                ->color('danger'),

            Stat::make('Konsumsi Pakan Hari Ini', $fmt($pakanHari))
                ->description('Konsumsi pakan hari ini')
                ->color('info'),

            Stat::make('Konsumsi Pakan Minggu Ini', $fmt($pakanMinggu))
                ->description('Konsumsi pakan minggu ini')
                ->color('info'),

            Stat::make('Konsumsi Pakan Bulan Ini', $fmt($pakanBulan))
                ->description('Konsumsi pakan bulan ini')
                ->color('info'),
        ];
    }
}
