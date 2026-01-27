<?php

namespace Tests\Unit;

use App\Models\Medico;
use App\Models\Paciente;
use App\Models\Remedio;
use App\Models\User;
use App\Services\PrescricaoService;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
class ExcluirRemedioComEstoqueTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function nao_deve_excluir_remedio_com_estoque_disponivel()
    {
        $service = new \App\Services\RemedioService();

        // cria remédio
        $remedio = $service->criarRemedio(['nome' => 'Paracetamol']);

        // adiciona estoque
        $service->adicionarEstoque($remedio->id, [
            'quantidade' => 10,
            'lote' => 'L001'
        ]);

        // tenta excluir e espera exceção
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Não é possível excluir remédio com estoque disponível!');

        $service->excluirRemedio($remedio->id);
    }
}


