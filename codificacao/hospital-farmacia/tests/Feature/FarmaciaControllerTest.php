<?php

namespace Tests\Feature;

use App\Models\Estoque;
use App\Models\Paciente;
use App\Models\Prescricao;
use App\Models\Remedio;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FarmaciaControllerTest extends TestCase
{
    use RefreshDatabase;
    
    protected function setUp(): void
    {
        parent::setUp();
        $this->actingAs(User::factory()->create());
    }

    
    /** @test */
    public function test_index_returns_view_with_pacientes()
    {
        $paciente = Paciente::factory()->create();

        $response = $this->get(route('farmacia'));

        $response->assertStatus(200);
        $response->assertViewIs('Farmacia.indexFarmacia');
        $response->assertViewHas('pacientes');
    }

    /** @test */
    public function test_buscarGuia_with_valid_id_paciente_returns_prescricao()
    {
        $paciente = Paciente::factory()->create();
        $prescricao = Prescricao::factory()->create([
            'id_paciente' => $paciente->id,
        ]);

        $response = $this->get(route('guia.buscar', ['id_paciente' => $paciente->id]));

        $response->assertStatus(200);
        $response->assertViewHas('prescricao', function ($value) use ($prescricao) {
            return $value->id === $prescricao->id;
        });
    }

    /** @test */
    public function test_storeLote_creates_new_estoque()
    {
        $remedio = Remedio::factory()->create();

        $data = [
            'id_remedio' => $remedio->id,
            'quantidade' => 50,
        ];

        $response = $this->post(route('lote.store'), $data);

        $response->assertRedirect(route('consultar.estoque'));
        $this->assertDatabaseHas('estoques', [
            'id_remedio' => $remedio->id,
            'quantidade' => 50,
        ]);
    }
}