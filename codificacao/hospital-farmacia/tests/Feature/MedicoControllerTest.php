<?php

namespace Tests\Feature;

use App\Models\Estoque;
use App\Models\Paciente;
use App\Models\Prescricao;
use App\Models\PrescricaoRemedio;
use App\Models\Remedio;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MedicoControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->actingAs(User::factory()->create());
    }

    public function test_index_returns_view_with_pacientes_and_remedios(): void
    {
        Paciente::factory()->count(3)->create();
        Remedio::factory()->count(3)->create();

        $response = $this->get(route('medico'));

        $response->assertStatus(200);
        $response->assertViewIs('welcome');
        $response->assertViewHas('pacientes');
        $response->assertViewHas('remedios');
    }


    public function test_marcarPrescricaoAtendida_with_valid_prescricao_and_stock_updates_estoque(): void
    {
        $paciente = Paciente::factory()->create();
        $remedio1 = Remedio::factory()->create();
        $remedio2 = Remedio::factory()->create();
        
        $estoque1 = Estoque::factory()->create([
            'id_remedio' => $remedio1->id,
            'quantidade' => 10
        ]);
        $estoque2 = Estoque::factory()->create([
            'id_remedio' => $remedio2->id,
            'quantidade' => 10
        ]);

        $prescricao = Prescricao::factory()->create(['id_paciente' => $paciente->id]);
        
        PrescricaoRemedio::create([
            'id_prescricao' => $prescricao->id,
            'id_remedio' => $remedio1->id
        ]);
        PrescricaoRemedio::create([
            'id_prescricao' => $prescricao->id,
            'id_remedio' => $remedio2->id
        ]);

        $response = $this->post(route('marcar.prescricao.atendida', $prescricao->id));

        $response->assertRedirect();
        $response->assertSessionHas('success', 'Prescrição atendida com sucesso!');

        $this->assertDatabaseHas('prescricoes', [
            'id' => $prescricao->id,
            'prescricao_atendida' => true
        ]);

        // Verifica se o estoque foi decrementado (quantidade padrão 1 para cada remédio)
        $this->assertEquals(9, Estoque::find($estoque1->id)->quantidade);
        $this->assertEquals(9, Estoque::find($estoque2->id)->quantidade);
    }

    public function test_marcarPrescricaoAtendida_with_insufficient_stock_returns_error(): void
    {
        $paciente = Paciente::factory()->create();
        $remedio = Remedio::factory()->create();
        
        Estoque::factory()->create([
            'id_remedio' => $remedio->id,
            'quantidade' => 0 // Estoque zerado
        ]);

        $prescricao = Prescricao::factory()->create(['id_paciente' => $paciente->id]);
        
        PrescricaoRemedio::create([
            'id_prescricao' => $prescricao->id,
            'id_remedio' => $remedio->id
        ]);

        $response = $this->post(route('marcar.prescricao.atendida', $prescricao->id));

        $response->assertRedirect();
        $response->assertSessionHas('error', 'Estoque insuficiente para o remédio ID ' . $remedio->id);

        $this->assertDatabaseHas('prescricoes', [
            'id' => $prescricao->id,
            'prescricao_atendida' => false
        ]);
    }

    public function test_marcarPrescricaoAtendida_with_nonexistent_prescricao_returns_error(): void
    {
        $response = $this->post(route('marcar.prescricao.atendida', 999));

        $response->assertRedirect();
        $response->assertSessionHas('error', 'Prescrição não encontrada.');
    }
}