<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Kandang;

class KandangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (Kandang::count() == 0) {
            Kandang::create([
                'lokasi' => 'Kandang Atas',
                'kapasitas' => 0,
                'populasi' => 0,
            ]);

            Kandang::create([
                'lokasi' => 'Kandang Bawah',
                'kapasitas' => 0,
                'populasi' => 0,
            ]);
        }
    }
}
