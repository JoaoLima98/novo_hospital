<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User; // <--- Importante: Importar a Model User
use App\Models\Remedio;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
class EstoqueTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function deve_criar_um_novo_lote_de_estoque_com_sucesso()
    {
        
        // cria um usuário fake para "logar" no sistema
        $user = User::factory()->create();
        
        $remedio = Remedio::factory()->create();

        $dados = [
            'id_remedio' => $remedio->id,
            'quantidade' => 50,
        ];

        //AÇÃO
        // O método actingAs($user) simula que o usuário está logado
        $response = $this->actingAs($user) 
                         ->post(route('store.lote'), $dados);

        // VERIFICAÇÃO
        // verifica se foi para a rota certa (consultar.estoque)
        //Se redirecionar p login significa que a autenticação falhou viss
        $response->assertRedirect(route('consultar.estoque'));
        
        //vErifica se gravou no banco 
        $this->assertDatabaseHas('estoques', [
            'id_remedio' => $remedio->id,
            'quantidade' => 50,
        ]);
    }
}