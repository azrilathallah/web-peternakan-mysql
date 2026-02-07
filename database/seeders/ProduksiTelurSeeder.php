<?php

namespace Database\Seeders;

use App\Models\ProduksiTelur;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class ProduksiTelurSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jumlahHari = 250;

        for ($i = 0; $i < $jumlahHari; $i++) {
            foreach ([1, 2] as $kandang) {
                ProduksiTelur::factory()->create([
                    'tanggal'    => Carbon::today()->addDays($i),
                    'kandang_id' => $kandang,
                ]);
            }
        }
    }
}
