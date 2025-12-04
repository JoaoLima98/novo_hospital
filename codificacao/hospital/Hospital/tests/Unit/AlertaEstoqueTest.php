<?php

namespace Tests\Unit;

use App\Models\Medico;
use App\Models\Paciente;
use App\Models\User;
use App\Services\PrescricaoService;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
class CadastroPosologiaTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    protected $prescricaoService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->prescricaoService = new PrescricaoService();
    }

    /** @test */
    public function nao_deve_criar_prescricao_com_medicamento_com_campos_vazios()
    {
        $service = new \App\Services\PrescricaoService();

        $resultado = $service->criarPrescricao([
            'id_medico' => null,
            'id_paciente' => null,
            'observacao' => 'Teste prescrição',
            'medicamentos' => [
                [
                    'id' => '',
                    'quantidade' => null,
                    'unidade' => '',
                    'intervalo' => null,
                    'duracao' => null,
                    'qtd_tomar' => null,
                ],
            ],
        ]);

        $this->assertEquals('OK', $resultado);
    }
}


