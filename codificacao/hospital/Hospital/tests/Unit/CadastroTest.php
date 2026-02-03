<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Services\UserService;
use App\Services\MedicoService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
class CadastroTest extends TestCase
{
    use RefreshDatabase;

    protected $userService;
    protected $medicoService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->userService = new UserService();
        $this->medicoService = new MedicoService();
    }

    #[Test]
    public function nao_deve_permitir_email_repetido()
    {
        \App\Models\User::factory()->create(['email' => 'joao@email.com']);

        $this->expectExceptionMessage('Email já está sendo utilizado');

        $this->userService->cadastrarUser([
            'nome' => 'João 2',
            'email' => 'joao@email.com',
            'perfil' => 'admin',
            'password' => '123456'
        ]);
    }

    #[Test]
    public function deve_aceitar_email_valido()
    {
        $this->userService->cadastrarUser([
            'nome' => 'João',
            'email' => 'joao@email.com',
            'perfil' => 'admin',
            'password' => '123456'
        ]);

        $this->assertDatabaseHas('users', ['email' => 'joao@email.com']);
    }

    #[Test]
    public function nao_deve_aceitar_email_invalido()
    {
        $this->expectExceptionMessage('email deve seguir o padrão joao@email.com');

        $this->userService->cadastrarUser([
            'nome' => 'João',
            'email' => 'joaoemailcom',
            'perfil' => 'admin',
            'password' => '123456'
        ]);
    }

    #[Test]
    public function nao_deve_permitir_crm_repetido()
    {
        \App\Models\Medico::factory()->create(['crm' => '12345']);

        $this->expectExceptionMessage('CRM já está sendo utilizado');

        $this->medicoService->cadastrarMedico([
            'nome' => 'Dr. João',
            'crm' => '12345',
            'especialidade' => 'Cardiologia'
        ]);
    }
}
