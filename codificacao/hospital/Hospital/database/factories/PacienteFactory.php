<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Paciente>
 */
class PacienteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nome' => $this->faker->name(),
            'cpf' => $this->faker->numerify('###########'), // Gera 11 dígitos
            'rg' => $this->faker->numerify('#########'),
            'telefone' => $this->faker->phoneNumber(),
            'data_nascimento' => $this->faker->date(),
            'regulado' => false,
        ];
    }
}
