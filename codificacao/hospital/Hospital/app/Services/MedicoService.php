<?php

namespace App\Services;

use App\Models\Medico;

class MedicoService
{
    public function cadastrarMedico(array $dados)
    {
        // Verifica se CRM já existe
        $existe = Medico::where('crm', $dados['crm'])->first();
        if ($existe) {
            throw new \Exception('CRM já está sendo utilizado');
        }

        // Cria o médico
        return Medico::create([
            'nome' => $dados['nome'],
            'crm' => $dados['crm'],
            'especialidade' => $dados['especialidade'] ?? null,
            'telefone' => $dados['telefone'] ?? null,
        ]);
    }
}
