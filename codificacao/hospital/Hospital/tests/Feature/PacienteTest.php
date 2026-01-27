<?php

namespace Tests\Feature;

use App\Models\Paciente;
use App\Models\User; // Importante: Importar o model User
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PacienteTest extends TestCase
{
    use RefreshDatabase;

    /**
     * CENÁRIO 1: Inserir CPF já existente no sistema
     */
    public function test_nao_deve_criar_paciente_com_cpf_duplicado()
    {
        // 1. Cria um usuário e autentica (CORREÇÃO)
        $user = User::factory()->create();
        $this->actingAs($user);

        // DADO: Que já existe um paciente com este CPF
        Paciente::factory()->create([
            'cpf' => '12345678900'
        ]);

        // QUANDO: Tento criar outro com o mesmo CPF
        $dadosNovoPaciente = Paciente::factory()->raw([
            'cpf' => '12345678900'
        ]);

        $response = $this->post(route('pacientes.store'), $dadosNovoPaciente);

        // ENTÃO: Deve haver erro de validação
        $response->assertSessionHasErrors(['cpf']);
    }

    /**
     * CENÁRIO 2: Campos obrigatórios vazios
     */
    public function test_nao_deve_criar_paciente_com_campos_obrigatorios_vazios()
    {
        // 1. Autentica
        $user = User::factory()->create();
        $this->actingAs($user);

        // DADO: Envio vazio
        $dadosVazios = [];

        // QUANDO: Envio para store
        $response = $this->post(route('pacientes.store'), $dadosVazios);

        // ENTÃO: Erros de validação
        $response->assertSessionHasErrors([
            'nome', 
            'cpf', 
            'telefone', 
            // Se 'data_nascimento' for nullable no banco mas required no controller, mantenha aqui.
            // Se no controller estiver 'nullable', remova daqui.
            // Pelo seu código anterior, estava 'nullable|date', então remova se for o caso.
            // Vou manter baseado na sua tabela de requisitos inicial que pedia obrigatoriedade.
        ]);
    }

    /**
     * CENÁRIO 3: Caminho Feliz
     */
    public function test_deve_criar_paciente_corretamente_e_redirecionar()
    {
        // 1. Autentica
        $user = User::factory()->create();
        $this->actingAs($user);

        // DADO: Dados válidos
        $dadosValidos = [
            'nome' => 'João da Silva',
            'cpf' => '99988877700',
            'telefone' => '(11) 99999-9999',
            'data_nascimento' => '1990-01-01',
            'regulado' => '1',
            'cidade_atual' => 'São Paulo',
            'estado' => 'SP'
        ];

        // QUANDO: Envio o POST
        $response = $this->post(route('pacientes.store'), $dadosValidos);

        // ENTÃO: Redireciona para index (não para login!)
        $response->assertRedirect(route('pacientes.index'));
        
        $this->assertDatabaseHas('pacientes', [
            'cpf' => '99988877700'
        ]);
    }

    /**
     * CENÁRIO 4: Integridade / Falha no Update
     */
    public function test_garantir_integridade_dos_dados_originais_se_update_falhar()
    {
        // 1. Autentica
        $user = User::factory()->create();
        $this->actingAs($user);

        // DADO: Paciente existente
        $pacienteOriginal = Paciente::factory()->create([
            'nome' => 'Nome Original',
            'cpf' => '11111111111'
        ]);

        // QUANDO: Tento atualizar com nome vazio (inválido)
        $response = $this->put(route('pacientes.update', $pacienteOriginal->id), [
            'nome' => '', 
            'cpf' => '11111111111',
            'telefone' => '123',
            'data_nascimento' => '2000-01-01'
        ]);

        // ENTÃO: Erro de validação e dado original mantido
        $response->assertSessionHasErrors('nome');

        $this->assertDatabaseHas('pacientes', [
            'id' => $pacienteOriginal->id,
            'nome' => 'Nome Original'
        ]);
    }
}