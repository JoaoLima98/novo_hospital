<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Remedio;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
class RemedioTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function nao_deve_permitir_cadastrar_remedio_com_nome_repetido()
    {
        // 1. Cria um usuário (assumindo que precisa estar logado, se não precisar, tire o actingAs)
        $user = User::factory()->create();

        // 2. DADO: Que já existe "Dipirona" no banco
        Remedio::create(['nome' => 'Dipirona', 'qtd_alerta' => 10]);
        
        // 3. QUANDO: Tento cadastrar "Dipirona" de novo
        $response = $this->actingAs($user)
                         ->post(route('remedio.store'), [
                             'nome' => 'Dipirona'
                         ]);

        // 4. ENTÃO: O sistema deve barrar e voltar com erro
        // O seu controller faz: return back()->with('error', 'Remédio já existe !');
        
        $response->assertSessionHas('error', 'Remédio já existe !');
        
        // Garante que continua existindo apenas 1 Dipirona no banco, e não 2
        $this->assertCount(1, Remedio::where('nome', 'Dipirona')->get());
    }
}