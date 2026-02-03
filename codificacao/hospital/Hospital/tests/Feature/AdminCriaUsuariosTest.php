<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Medico;
use App\Models\Farmaceutico;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Gate;
use PHPUnit\Framework\Attributes\Test;
class AdminCriaUsuariosTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        // Libera o acesso de admin
        Gate::define('adm', fn($user) => $user->perfil === 'admin');
    }

    #[Test]
    public function admin_deve_criar_medico_com_sucesso()
    {
        $admin = User::factory()->create(['perfil' => 'admin']);

        $dados = [
            'name' => 'Dr. Estranho',
            'email' => 'estranho@marvel.com',
            'telefone' => '1199999999',
            'password' => 'senha123',
            'perfil' => 'medico', 
            'crm' => '12345-SP',
            #'especialidade' => "Geral"
        ];

        $this->actingAs($admin)
             ->post(route('store.usuario'), $dados)
             ->assertSessionHas('success');

        $this->assertDatabaseHas('medicos', ['crm' => '12345-SP']);
    }

    #[Test]
    public function admin_nao_deve_criar_medico_com_crm_repetido()
    {
        $admin = User::factory()->create(['perfil' => 'admin']);
        
        // Cria um médico existente
        Medico::factory()->create(['crm' => '12345-SP']);

        $dados = [
            'name' => 'Outro Doutor',
            'email' => 'outro@email.com',
            'password' => '123',
            'perfil' => 'medico',
            'crm' => '12345-SP' // CRM Repetido
        ];

        $this->actingAs($admin)
             ->post(route('store.usuario'), $dados)
             ->assertSessionHas('error', 'CRM já cadastrado !'); // <--- Testa o erro de CRM
    }

    #[Test]
    public function admin_deve_criar_farmaceutico_com_sucesso()
    {
        $admin = User::factory()->create(['perfil' => 'admin']);

        $dados = [
            'name' => 'Seu Farmaceutico',
            'email' => 'farma@tico.com',
            'password' => '123',
            'perfil' => 'farmaceutico', // <--- Testa o ELSEIF do farmaceutico
            'telefone' => '123'
        ];

        $this->actingAs($admin)
             ->post(route('store.usuario'), $dados)
             ->assertSessionHas('success');

        $this->assertDatabaseHas('farmaceuticos', ['user_id' => User::whereEmail('farma@tico.com')->first()->id]);
    }
}