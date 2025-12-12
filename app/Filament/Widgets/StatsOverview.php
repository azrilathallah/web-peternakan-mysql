<?php

namespace App\Filament\Widgets;

use App\Models\Kandang;
use App\Models\Mortalitas;
use App\Models\Pakan;
use App\Models\ProduksiTelur;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Number;

class StatsOverview extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $today = Carbon::today();
        $yesterday = Carbon::yesterday();
        $weekStart = Carbon::now()->startOfWeek();
        $monthStart = Carbon::now()->startOfMonth();

        // Data Kandang
        $totalPuyuh = Kandang::sum('jumlah_puyuh');
        $totalKandang = Kandang::count();

        // Data Produksi Telur
        $produksiHari = ProduksiTelur::whereDate('tanggal', $today)->sum('total_telur');
        $produksiKemarin = ProduksiTelur::whereDate('tanggal', $yesterday)->sum('total_telur');
        $produksiMinggu = ProduksiTelur::whereDate('tanggal', '>=', $weekStart)->sum('total_telur');
        $produksiBulan = ProduksiTelur::whereDate('tanggal', '>=', $monthStart)->sum('total_telur');

        // Persentase perubahan produksi harian
        $persentaseProduksi = $produksiKemarin > 0
            ? (($produksiHari - $produksiKemarin) / $produksiKemarin) * 100
            : 0;

        // Data Mortalitas
        $matiHari = Mortalitas::whereDate('tanggal', $today)->sum('jumlah_mati');
        $matiKemarin = Mortalitas::whereDate('tanggal', $yesterday)->sum('jumlah_mati');
        $matiMinggu = Mortalitas::whereDate('tanggal', '>=', $weekStart)->sum('jumlah_mati');
        $matiBulan = Mortalitas::whereDate('tanggal', '>=', $monthStart)->sum('jumlah_mati');

        // Rasio mortalitas harian
        $rasioMortalitasHari = $totalPuyuh > 0 ? ($matiHari / $totalPuyuh) * 100 : 0;

        // Data Pakan
        $pakanHari = Pakan::whereDate('tanggal', $today)->sum('konsumsi_pakan');
        $pakanKemarin = Pakan::whereDate('tanggal', $yesterday)->sum('konsumsi_pakan');
        $pakanMinggu = Pakan::whereDate('tanggal', '>=', $weekStart)->sum('konsumsi_pakan');
        $pakanBulan = Pakan::whereDate('tanggal', '>=', $monthStart)->sum('konsumsi_pakan');

        // Konsumsi pakan per ekor
        $pakanPerEkor = $totalPuyuh > 0 ? $pakanHari / $totalPuyuh : 0;

        return [
            Stat::make('Total Populasi', Number::format($totalPuyuh))
                ->description("{$totalKandang} kandang aktif")
                ->descriptionIcon('heroicon-o-users')
                ->color('warning')
                ->chart([7, 2, 10, 3, 15, 4, 17])
                ->extraAttributes([
                    'class' => 'cursor-pointer',
                ]),

            Stat::make('Produksi Telur Hari Ini', Number::format($produksiHari))
                ->description(
                    $persentaseProduksi >= 0
                        ? "↑ " . Number::format($persentaseProduksi, 1) . "% dari kemarin"
                        : "↓ " . Number::format(abs($persentaseProduksi), 1) . "% dari kemarin"
                )
                ->descriptionIcon($persentaseProduksi >= 0 ? 'heroicon-m-arrow-trending-up' : 'heroicon-m-arrow-trending-down')
                ->color($persentaseProduksi >= 0 ? 'success' : 'danger')
                ->chart($this->getWeeklyProduksiTelurData())
                ->extraAttributes([
                    'class' => 'cursor-pointer',
                ]),

            Stat::make('Mortalitas Hari Ini', Number::format($matiHari))
                ->description(Number::format($rasioMortalitasHari, 3) . "% dari total populasi")
                ->descriptionIcon($rasioMortalitasHari > 0.1 ? 'heroicon-m-exclamation-triangle' : 'heroicon-m-shield-check')
                ->color($rasioMortalitasHari > 0.1 ? 'danger' : 'gray')
                ->chart($this->getWeeklyMortalitasData())
                ->extraAttributes([
                    'class' => 'cursor-pointer',
                ]),

            Stat::make('Konsumsi Pakan Hari Ini', Number::format($pakanHari, 3) . ' gr')
                ->description(Number::format($pakanPerEkor, 4) . ' gr/ekor ')
                ->descriptionIcon('heroicon-o-cube')
                ->color('info')
                ->chart($this->getWeeklyPakanData())
                ->extraAttributes([
                    'class' => 'cursor-pointer',
                ]),
        ];
    }

    private function getWeeklyProduksiTelurData(): array
    {
        return ProduksiTelur::where('tanggal', '>=', Carbon::now()->subDays(7))
            ->groupBy('tanggal')
            ->orderBy('tanggal')
            ->pluck(DB::raw('SUM(total_telur)'))
            ->toArray();
    }

    private function getWeeklyMortalitasData(): array
    {
        return Mortalitas::where('tanggal', '>=', Carbon::now()->subDays(7))
            ->groupBy('tanggal')
            ->orderBy('tanggal')
            ->pluck(DB::raw('SUM(jumlah_mati)'))
            ->toArray();
    }

    private function getWeeklyPakanData(): array
    {
        return Pakan::where('tanggal', '>=', Carbon::now()->subDays(7))
            ->groupBy('tanggal')
            ->orderBy('tanggal')
            ->pluck(DB::raw('SUM(konsumsi_pakan)'))
            ->toArray();
    }
}
