<?php

namespace Database\Factories;

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
    public function definition(): array
    {
        return [
            'id_remedio' => Remedio::factory(), // Cria um remédio automaticamente
            'quantidade' => $this->faker->numberBetween(1, 100),
        ];
    }
}
