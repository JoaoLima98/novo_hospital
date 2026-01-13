<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use Illuminate\Http\Request;

class PacienteController extends Controller
{
    public function index()
    {
        // Paginação para não pesar a lista
        $pacientes = Paciente::orderBy('nome')->paginate(10);
        return view('pacientes.index', compact('pacientes'));
    }

    public function create()
    {
        // Retorna a view store vazia para criar
        return view('pacientes.store');
    }
    
    public function store(Request $request)
    {
        // Validação
        $data = $request->validate([
            'nome' => 'required|string|max:255',
            'cpf' => 'required|string|max:20|unique:pacientes,cpf',
            'telefone' => 'required|string|max:20',
            'regulado' => 'boolean', // Checkbox retorna 1 ou 0
            // Campos Nullable (Opcionais no banco)
            'rg' => 'nullable|string|max:20',
            'cartao_sus' => 'nullable|string|max:255',
            'data_nascimento' => 'nullable|date',
            'nome_mae' => 'nullable|string|max:255',
            'nome_pai' => 'nullable|string|max:255',
            'naturalidade' => 'nullable|string|max:255',
            'estado_civil' => 'nullable|string',
            'raca_cor' => 'nullable|string',
            'escolaridade' => 'nullable|string',
            'profissao' => 'nullable|string|max:255',
            'cidade_atual' => 'nullable|string|max:255',
            'estado' => 'nullable|string|max:255',
            'rua' => 'nullable|string|max:255',
            'bairro' => 'nullable|string|max:255',
            'numero_casa' => 'nullable|string|max:255',
        ]);

        // Tratamento para checkbox não marcado (se não vier no request, assume 0)
        $data['regulado'] = $request->has('regulado');

        Paciente::create($data);

        return redirect()->route('pacientes.index')->with('success', 'Paciente cadastrado com sucesso!');
    }

    public function edit(Paciente $paciente)
    {
        // Retorna a mesma view store, mas com os dados do paciente
        return view('pacientes.store', compact('paciente'));
    }
    
    public function update(Request $request, Paciente $paciente)
    {
        $data = $request->validate([
            'nome' => 'required|string|max:255',
            // No update, o unique deve ignorar o ID do paciente atual
            'cpf' => 'required|string|max:20|unique:pacientes,cpf,' . $paciente->id,
            'telefone' => 'required|string|max:20',
            'regulado' => 'boolean',
            
            'rg' => 'nullable|string|max:20',
            'cartao_sus' => 'nullable|string|max:255',
            'data_nascimento' => 'nullable|date',
            'nome_mae' => 'nullable|string|max:255',
            'nome_pai' => 'nullable|string|max:255',
            'naturalidade' => 'nullable|string|max:255',
            'estado_civil' => 'nullable|string',
            'raca_cor' => 'nullable|string',
            'escolaridade' => 'nullable|string',
            'profissao' => 'nullable|string|max:255',
            'cidade_atual' => 'nullable|string|max:255',
            'estado' => 'nullable|string|max:255',
            'rua' => 'nullable|string|max:255',
            'bairro' => 'nullable|string|max:255',
            'numero_casa' => 'nullable|string|max:255',
        ]);

        $data['regulado'] = $request->has('regulado');

        $paciente->update($data);

        return redirect()->route('pacientes.index')->with('success', 'Paciente atualizado com sucesso!');
    }

    public function destroy(Paciente $paciente)
    {
        $paciente->delete();
        return redirect()->route('pacientes.index')->with('success', 'Paciente removido!');
    }
}