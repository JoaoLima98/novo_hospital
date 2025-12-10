<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Gate;

class CriarEnfermeiroTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        // Define a gate de admin para o teste passar
        Gate::define('adm', function ($user) {
            return $user->perfil === 'admin';
        });
    }

    /** @test */
    public function admin_deve_criar_usuario_enfermeiro_com_sucesso()
    {
        // 1. PREPARAÇÃO (Cenário)
        // Cria um admin para realizar a ação
        $admin = User::factory()->create(['perfil' => 'admin']);

        $dados = [
            'name' => 'Enfermeira Joy',
            'email' => 'joy@hospital.com',
            'telefone' => '11988887777',
            'password' => 'senha123',
            'perfil' => 'enfermeiro',       // Entra no elseif($perfil === 'enfermeiro')
            'coren' => 'SP-123.456',        // Campo obrigatório da tabela enfermeiros
        ];

        // 2. AÇÃO
        $response = $this->actingAs($admin)
                         ->post(route('store.usuario'), $dados);

        // 3. VERIFICAÇÃO
        
        // Verifica se deu sucesso na sessão
        $response->assertSessionHas('success');

        // Verifica se criou o usuário básico
        $this->assertDatabaseHas('users', [
            'email' => 'joy@hospital.com',
            'perfil' => 'enfermeiro',
        ]);

        // Verifica se criou o registro na tabela ENFERMEIROS
        // Precisamos pegar o ID do user criado para conferir a chave estrangeira
        $userCriado = User::where('email', 'joy@hospital.com')->first();

        $this->assertDatabaseHas('enfermeiros', [
            'user_id' => $userCriado->id,
            'coren' => 'SP-123.456',
        ]);
    }
}