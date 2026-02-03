<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Remedio;
use App\Models\Estoque;
use App\Models\Prescricao;
use App\Models\Paciente;
use App\Models\Medico;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Gate;

class FarmaciaEstoqueTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        // Libera acesso de farmacêutico
        Gate::define('farmaceutico', fn($user) => $user->perfil === 'farmaceutico');
    }

    /** @test */
    public function nao_deve_atender_prescricao_se_estoque_for_insuficiente()
    {
        // 1. DADO: Um farmacêutico logado
        $farmaceutico = User::factory()->create(['perfil' => 'farmaceutico']);

        // 2. DADO: Um remédio com APENAS 2 unidades no estoque
        $remedio = Remedio::factory()->create(['nome' => 'Dipirona']);
        Estoque::create([
            'id_remedio' => $remedio->id,
            'quantidade' => 2,
            'lote' => 'LOTE-001'
        ]);

        // 3. DADO: Uma prescrição pedindo 10 unidades (Muito mais que o estoque)
        $paciente = Paciente::factory()->create();
        $medico = Medico::factory()->create(['user_id' => User::factory()->create()->id]);
        
        $prescricao = Prescricao::create([
            'id_medico' => $medico->id,
            'id_paciente' => $paciente->id,
            'data_prescricao' => now(),
            'observacao' => 'Teste de falha'
        ]);

        // Vincula o remédio à prescrição pedindo 10
        $prescricao->remedios()->attach($remedio->id, [
            'quantidade' => 10,
            'unidade_medida' => 'cp',
            'intervalo' => '8/8h',
            'duracao' => '5 dias',
            'qtd_tomar' => '1',
            'atendido' => false
        ]);

        // 4. QUANDO: Tenta marcar como atendida
        $response = $this->actingAs($farmaceutico)
             ->post(route('marcar.prescricao.atendida', $prescricao->id), [
                 'remedios' => [$remedio->id] // Seleciona o remédio para baixar
             ]);

        // 5. ENTÃO: Deve dar erro e NÃO baixar o estoque
        $response->assertSessionHas('error'); // Espera mensagem de erro
        
        // O estoque deve continuar sendo 2 (não pode ter ficado negativo)
        $this->assertDatabaseHas('estoques', [
            'id_remedio' => $remedio->id,
            'quantidade' => 2
        ]);
    }
}