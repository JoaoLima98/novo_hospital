<?php

namespace Database\Factories;

use App\Models\Remedio;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Remedio>
 */
class RemedioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Remedio::class;

    public function definition()
    {
        return [
            'nome' => $this->faker->word,
        ];
    }
}
