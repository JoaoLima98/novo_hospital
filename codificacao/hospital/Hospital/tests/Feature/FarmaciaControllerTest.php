<?php

namespace Tests\Feature;

use App\Models\Estoque;
use App\Models\Paciente;
use App\Models\Prescricao;
use App\Models\PrescricaoRemedio;
use App\Models\Remedio;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FarmaciaControllerTest extends TestCase
{
    // Adiciona o RefreshDatabase para garantir que o banco seja limpo a cada teste
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_nao_permite_lote_com_quantidade_negativa()
    {
        
        $remedio = Remedio::factory()->create();

        $response = $this->post(route('store.lote'), [
            'id_remedio' => $remedio->id,
            'quantidade' => -5,
        ]);

        
        $response->assertSessionHasErrors(['quantidade' => 'O número deve ser maior que zero.']);
    }

    public function test_buscar_guia_com_paciente_valido()
    {
        $paciente = Paciente::factory()->create();
        $prescricao = Prescricao::factory()->create([
            'id_paciente' => $paciente->id,
        ]);

        $response = $this->get(route('guia.buscar', ['id_paciente' => $paciente->id]));

        $response->assertViewHas('prescricao', function ($p) use ($prescricao) {
            return $p->id === $prescricao->id;
        });
    }

    public function test_buscar_guia_com_paciente_inexistente()
    {
        
        $response = $this->get(route('guia.buscar', ['id_paciente' => 9999]));

   
        $response->assertSessionHas('error', 'Paciente não encontrado.');
    }

    public function test_marcar_prescricao_atendida_com_estoque()
    {
        $remedio = Remedio::factory()->create();
        $estoque = Estoque::factory()->create([
            'id_remedio' => $remedio->id,
            'quantidade' => 1,
        ]);
        $paciente = Paciente::factory()->create();
        $prescricao = Prescricao::factory()->create([
            'id_paciente' => $paciente->id,
        ]);
        $item = PrescricaoRemedio::factory()->create([
            'id_prescricao' => $prescricao->id,
            'id_remedio' => $remedio->id,
        ]);

        $response = $this->post(route('marcar.prescricao.atendida', $prescricao->id), [
            'remedios' => [$remedio->id],
        ]);

        $this->assertDatabaseHas('estoques', [
            'id_remedio' => $remedio->id,
            'quantidade' => 0, 
        ]);

        $response->assertSessionHas('success', 'Prescrição atendida com sucesso!');
    }
}