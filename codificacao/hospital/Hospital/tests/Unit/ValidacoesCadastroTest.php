<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Remedio;
use App\Models\Estoque;
use App\Models\Paciente;
use App\Models\Prescricao;
use App\Models\PrescricaoRemedio;
use App\Services\FarmaciaService; 
use Illuminate\Foundation\Testing\RefreshDatabase;

class ValidacoesCadastroTest extends TestCase
{
    use RefreshDatabase;

    protected FarmaciaService $service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = new FarmaciaService();
    }

    /** @test */
    public function nao_deve_permitir_quantidade_negativa()
    {
        $this->expectExceptionMessage('O número deve ser maior que zero.');

        $remedio = Remedio::factory()->create();

        $this->service->criarLote($remedio->id, -5);
    }

    /** @test */
    public function deve_buscar_prescricao_com_paciente_valido()
    {
        $paciente = Paciente::factory()->create();
        $prescricao = Prescricao::factory()->create(['id_paciente' => $paciente->id]);

        $resultado = $this->service->buscarGuia($paciente->id);

        $this->assertEquals($prescricao->id, $resultado->id);
    }

    /** @test */
    public function deve_retornar_erro_para_paciente_inexistente()
    {
        $this->expectExceptionMessage('Paciente não encontrado.');

        $this->service->buscarGuia(9999);
    }

    /** @test */
    public function deve_marcar_prescricao_atendida_e_atualizar_estoque()
    {
        $remedio = Remedio::factory()->create();
        Estoque::factory()->create([
            'id_remedio' => $remedio->id,
            'quantidade' => 1,
        ]);

        $paciente = Paciente::factory()->create();
        $prescricao = Prescricao::factory()->create(['id_paciente' => $paciente->id]);
        PrescricaoRemedio::factory()->create([
            'id_prescricao' => $prescricao->id,
            'id_remedio' => $remedio->id,
        ]);

        $this->service->marcarPrescricaoAtendida($prescricao->id, [$remedio->id]);

        $this->assertDatabaseHas('estoques', [
            'id_remedio' => $remedio->id,
            'quantidade' => 0,
        ]);
    }
}
