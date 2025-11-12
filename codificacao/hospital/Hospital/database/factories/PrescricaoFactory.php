<?php

namespace Database\Factories;

use App\Models\Medico;
use App\Models\Paciente;
use App\Models\Remedio;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Prescricao>
 */
class PrescricaoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_paciente' => Paciente::factory(), 
            'id_medico' => Medico::factory(), 
            'data_prescricao' => $this->faker->date(),
        ];
    }
}
