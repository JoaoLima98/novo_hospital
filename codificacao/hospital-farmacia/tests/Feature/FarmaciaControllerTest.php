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

    public function test_index_returns_view_with_pacientes(): void
    {
        Paciente::factory()->count(3)->create();

        $response = $this->get(route('farmacia'));

        $response->assertStatus(200);
        $response->assertViewIs('Farmacia.indexFarmacia');
        $response->assertViewHas('pacientes');
    }

    public function test_entregar_medicamentos_returns_view_with_pacientes(): void
    {
        Paciente::factory()->count(3)->create();

        $response = $this->get(route('entregar.medicamentos'));

        $response->assertStatus(200);
        $response->assertViewIs('Farmacia.indexFarmacia');
        $response->assertViewHas('pacientes');
    }

    public function test_buscarGuia_with_valid_id_paciente_returns_prescricao(): void
    {
        $paciente = Paciente::factory()->create();
        $prescricao = Prescricao::factory()->create(['id_paciente' => $paciente->id]);

        $response = $this->get(route('guia.buscar', [
            'id_paciente' => $paciente->id
        ]));

        $response->assertStatus(200);
        $response->assertViewHas('prescricao');
    }

    public function test_buscarGuia_with_valid_guia_returns_prescricao(): void
    {
        $prescricao = Prescricao::factory()->create();

        $response = $this->get(route('guia.buscar', [
            'guia' => $prescricao->id
        ]));

        $response->assertStatus(200);
        $response->assertViewHas('prescricao');
    }

    public function test_buscarGuia_with_invalid_data_returns_warning(): void
    {
        $response = $this->get(route('guia.buscar', [
            'guia' => 999,
            'id_paciente' => 999
        ]));

        $response->assertStatus(200);
        $response->assertViewHas('prescricao', null);
    }

    public function test_painelGuias_returns_initial_view(): void
    {
        $response = $this->get(route('painel.guias'));

        $response->assertStatus(200);
        $response->assertViewIs('Farmacia.buscarGuiasPaciente');
        $response->assertViewHas('ultimasGuias', null);
        $response->assertViewHas('pacienteSelecionado', null);
    }

    public function test_consultarGuias_with_valid_patient_returns_ultimas_guias(): void
    {
        $paciente = Paciente::factory()->create();
        Prescricao::factory()->count(5)->create(['id_paciente' => $paciente->id]);

        $response = $this->get(route('consultar.guias', [
            'id_paciente' => $paciente->id
        ]));

        $response->assertStatus(200);
        $response->assertViewHas('ultimasGuias');
        $response->assertViewHas('pacienteSelecionado');
    }

    public function test_consultarGuias_with_invalid_patient_returns_error(): void
    {
        $response = $this->get(route('consultar.guias', [
            'id_paciente' => 999
        ]));

        $response->assertRedirect();
        $response->assertSessionHas('error', 'Paciente não encontrado.');
    }

    public function test_consultarEstoque_returns_estoque_data(): void
    {
        Estoque::factory()->count(3)->create();

        $response = $this->get(route('consultar.estoque'));

        $response->assertStatus(200);
        $response->assertViewIs('Farmacia.checarEstoque');
        $response->assertViewHas('estoques');
    }

    public function test_criarLote_returns_remedios(): void
    {
        Remedio::factory()->count(3)->create();

        $response = $this->get(route('criar.lote'));

        $response->assertStatus(200);
        $response->assertViewIs('Estoque.criarLote');
        $response->assertViewHas('remedios');
    }

    public function test_storeLote_creates_new_estoque(): void
    {
        $remedio = Remedio::factory()->create();

        $response = $this->post(route('lote.store'), [
            'id_remedio' => $remedio->id,
            'quantidade' => 100
        ]);

        $response->assertRedirect(route('consultar.estoque'));
        $response->assertSessionHas('success', 'Lote criado com sucesso.');

        $this->assertDatabaseHas('estoques', [
            'id_remedio' => $remedio->id,
            'quantidade' => 100
        ]);
    }
}