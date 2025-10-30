<?php

namespace Database\Factories;

use App\Models\Medico;
use App\Models\Paciente;
use App\Models\Prescricao;
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
    protected $model = Prescricao::class;

    public function definition()
    {
        return [
            'id_medico' => Medico::factory(),
            'id_paciente' => Paciente::factory(),
            'data_prescricao' => $this->faker->dateTime(),
            'observacao' => $this->faker->sentence,
            'prescricao_atendida' => false,
        ];
    }
}
