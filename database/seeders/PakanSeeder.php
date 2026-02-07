<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Pakan;
use Illuminate\Support\Carbon;

class PakanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jumlahHari = 250;

        for ($i = 0; $i < $jumlahHari; $i++) {
            foreach ([1, 2] as $kandang) {
                Pakan::factory()->create([
                    'tanggal'    => Carbon::today()->addDays($i),
                    'kandang_id' => $kandang,
                ]);
            }
        }
    }
}
