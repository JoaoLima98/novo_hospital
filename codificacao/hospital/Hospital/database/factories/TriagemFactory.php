<?php

namespace Database\Factories;

use App\Models\Paciente;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Triagem>
 */
class TriagemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'paciente_id' => Paciente::factory(),
            'enfermeiro_id' => User::factory(),
            'pressao_sistolica' => 120,
            'pressao_diastolica' => 80,
            'temperatura' => 36.5,
            'frequencia_cardiaca' => 80,
            'spo2' => '98%',
            'glicemia' => '90mg/dL',
            'manchester_classificacao' => 'Urgente',
            'glasgow' => 15,
            'tipo_chegada' => 'Caminhando',
            'acidente_trabalho' => false,
            'acidente_veiculo' => false,
            
            'atendido' => false,
            'medico_id' => null,
            'created_at' => now(),
        ];
    }
}
