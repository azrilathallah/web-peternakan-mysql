<?php

namespace Database\Factories;

use App\Models\ProduksiTelur;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProduksiTelur>
 */
class ProduksiTelurFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = ProduksiTelur::class;
    public function definition(): array
    {
        return [
            'tanggal' => now()->toDateString(),
            'kandang_id' => $this->faker->randomElement([1, 2]),
            'telur_ok' => $this->faker->numberBetween(2000, 4000),
            'telur_bs' => $this->faker->numberBetween(50, 250),
            'berat' => $this->faker->randomFloat(2, 20, 70),
        ];
    }
}
