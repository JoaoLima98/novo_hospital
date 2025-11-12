<?php

namespace Database\Factories;

use App\Models\Paciente;
use App\Models\Prescricao;
use App\Models\Remedio;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PrescricaoRemedio>
 */
class PrescricaoRemedioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_prescricao' => Prescricao::factory(), // Cria uma prescrição
            'id_remedio' => Remedio::factory(), // Cria um remédio
        ];
    }
}
