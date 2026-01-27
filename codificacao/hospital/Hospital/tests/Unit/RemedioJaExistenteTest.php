<?php

namespace Tests\Unit;

use App\Models\Medico;
use App\Models\Paciente;
use App\Models\Remedio;
use App\Models\User;
use App\Services\PrescricaoService;
use App\Services\RemedioService;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Request;

class RemedioJaExistenteTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function nao_deve_cadastrar_remedio_com_nome_duplicado()
    {
        $service = new RemedioService();

        // cria o remédio "existente" direto no service ou mock
        $service->create(['nome' => 'Paracetamol']);

        // tenta criar de novo
        $this->expectException(\Exception::class); // ou sua exceção custom
        $service->create(['nome' => 'Paracetamol']);
    }
}


