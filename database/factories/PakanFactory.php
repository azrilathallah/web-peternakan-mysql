<?php

namespace Database\Factories;

use App\Models\Pakan;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pakan>
 */
class PakanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Pakan::class;
    public function definition(): array
    {
        return [
            'tanggal' => now()->toDateString(),
            'kandang_id' => $this->faker->randomElement([1, 2]),
            'pemberian_pakan' => 1000,
            'sisa_pakan' => $this->faker->numberBetween(200, 600),
        ];
    }
}
