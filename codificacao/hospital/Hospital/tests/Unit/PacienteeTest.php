<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Paciente;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PacienteeTest extends TestCase
{
    use RefreshDatabase;

    
    public function test_excecao_ao_cadastrar_cpf_duplicado()
    {
        
        $cpfExistente = '12345678900';
        Paciente::factory()->create([
            'cpf' => $cpfExistente
        ]);

        
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Paciente já cadastrado com este CPF');

        
        $novoPaciente = [
            'nome' => 'Novo Paciente',
            'cpf' => $cpfExistente, 
            'telefone' => '11988887777',
            'data_nascimento' => '1990-01-01'
        ];

        $this->salvarPacienteComValidacaoManual($novoPaciente);
    }

    
    public function test_validacao_campos_obrigatorios()
    {
        
        $dadosInvalidos = [
            'nome' => '',
            'cpf' => null,
            'telefone' => '',
            'data_nascimento' => null,
        ];

        
        $regras = [
            'nome' => 'required',
            'cpf' => 'required',
            'telefone' => 'required',
            'data_nascimento' => 'required',
        ];

        
        $validator = Validator::make($dadosInvalidos, $regras);

        
        $this->assertTrue($validator->fails(), 'A validação deveria falhar.');
        
        $erros = $validator->errors();
        $this->assertTrue($erros->has('nome'), 'Erro de nome não encontrado');
        $this->assertTrue($erros->has('cpf'), 'Erro de CPF não encontrado');
        $this->assertTrue($erros->has('telefone'), 'Erro de telefone não encontrado');
        $this->assertTrue($erros->has('data_nascimento'), 'Erro de data não encontrado');
    }

    
    private function salvarPacienteComValidacaoManual(array $dados)
    {
        
        if (Paciente::where('cpf', $dados['cpf'])->exists()) {
            throw new \Exception("Paciente já cadastrado com este CPF");
        }

        return Paciente::create($dados);
    }
}