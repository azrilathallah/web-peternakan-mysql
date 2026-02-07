<?php

namespace Database\Seeders;

use App\Models\Mortalitas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class MortalitasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jumlahHari = 250;

        for ($i = 0; $i < $jumlahHari; $i++) {
            foreach ([1, 2] as $kandang) {
                Mortalitas::factory()->create([
                    'tanggal'    => Carbon::today()->addDays($i),
                    'kandang_id' => $kandang,
                ]);
            }
        }
    }
}
