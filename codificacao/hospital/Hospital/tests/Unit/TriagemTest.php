<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Services\TriagemService;
use App\Models\User;
use App\Models\Paciente;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TriagemTest extends TestCase
{
    use RefreshDatabase;

    protected $service;
    protected $enfermeiro;
    protected $paciente;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = new TriagemService();
        $this->enfermeiro = User::factory()->create();
        $this->paciente = Paciente::factory()->create();
    }

    /** @test */
    public function deve_realizar_triagem_com_sucesso()
    {
        $dados = [
            'paciente_id' => $this->paciente->id,
            'manchester_classificacao' => 'Urgente',
            'pressao_sistolica' => 120,
            'pressao_diastolica' => 80,
            'temperatura' => 36.5,
            'spo2' => '95-100',
            'frequencia_cardiaca' => 80,
            'glicemia' => '70-100',
            'tipo_chegada' => 'Espontanea',
            'glasgow' => 15,
            'escore_dor' => 0,
            'peso' => 70,
            'queixa_principal' => 'Teste Unitário Service',
            'sintomas_gripais' => ['Tosse'] 
        ];

        $resultado = $this->service->registrarTriagem($dados, $this->enfermeiro->id);

        $this->assertDatabaseHas('triagens', [
            'paciente_id' => $this->paciente->id,
            'manchester_classificacao' => 'Urgente',
            'glasgow' => 15
        ]);

        $this->assertInstanceOf(\App\Models\Triagem::class, $resultado);
    }

    /** @test */
    public function nao_deve_permitir_cadastro_sem_manchester()
    {
        $dados = [
            'paciente_id' => $this->paciente->id,
            'glasgow' => 15,
            // 'manchester_classificacao' => '' // Faltando
        ];

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('O campo Classificação de Risco (Manchester) é obrigatório.');

        $this->service->registrarTriagem($dados, $this->enfermeiro->id);
    }

    /** @test */
    public function nao_deve_permitir_cadastro_sem_glasgow()
    {
        $dados = [
            'paciente_id' => $this->paciente->id,
            'manchester_classificacao' => 'Urgente',
            // 'glasgow' => null, // Faltando - melhor remover completamente
        ];

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('O campo Total Glasgow é obrigatório.');

        $this->service->registrarTriagem($dados, $this->enfermeiro->id);
    }

    /** @test */
    public function valida_intervalos_de_glasgow_e_dor()
    {
        // Glasgow abaixo do permitido
        $dadosGlasgowBaixo = [
            'paciente_id' => $this->paciente->id,
            'manchester_classificacao' => 'Urgente',
            'glasgow' => 2, // ERRADO (Min 3)
            'escore_dor' => 0
        ];
        
        try {
            $this->service->registrarTriagem($dadosGlasgowBaixo, $this->enfermeiro->id);
            $this->fail('Deveria ter lançado exceção para Glasgow 2');
        } catch (\Exception $e) {
            $this->assertEquals('O valor de Glasgow deve estar entre 3 e 15.', $e->getMessage());
        }

        // Dor acima do permitido
        $dadosDorAlta = [
            'paciente_id' => $this->paciente->id,
            'manchester_classificacao' => 'Urgente',
            'glasgow' => 15,
            'escore_dor' => 11 // ERRADO (Max 10)
        ];

        try {
            $this->service->registrarTriagem($dadosDorAlta, $this->enfermeiro->id);
            $this->fail('Deveria ter lançado exceção para Dor 11');
        } catch (\Exception $e) {
            $this->assertEquals('O escore de dor deve estar entre 0 e 10.', $e->getMessage());
        }
    }
}