<?php

namespace Database\Factories;

use App\Models\Estoque;
use App\Models\Remedio;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Estoque>
 */
class EstoqueFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Estoque::class;

    public function definition()
    {
        return [
            'id_remedio' => Remedio::factory(),
            'quantidade' => $this->faker->numberBetween(1, 100),
            'lote' => 'L' . $this->faker->numerify('###'),
        ];
    }
}
