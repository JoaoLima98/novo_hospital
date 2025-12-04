<?php

namespace App\Services;

use App\Models\Estoque;
use App\Models\Remedio;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class RemedioService
{
    public function create(array $data)
    {
        
        if (Remedio::where('nome', $data['nome'])->exists()) {
            throw new \Exception('Remédio já existe!');
        }

        // Cria e retorna o remédio
        return Remedio::create($data);
    }

    public function criarRemedio(array $data)
    {
        if (Remedio::where('nome', $data['nome'])->exists()) {
            throw new \Exception('Remédio já existe!');
        }

        return Remedio::create($data);
    }

    public function adicionarEstoque(int $remedioId, array $dadosEstoque)
    {
        $dadosEstoque['id_remedio'] = $remedioId;
        return Estoque::create($dadosEstoque);
    }

    public function excluirRemedio(int $remedioId)
    {
        $remedio = Remedio::findOrFail($remedioId);

        // verifica se tem algum estoque
        $temEstoque = Estoque::where('id_remedio', $remedioId)
                              ->where('quantidade', '>', 0)
                              ->exists();

        if ($temEstoque) {
            throw new \Exception('Não é possível excluir remédio com estoque disponível!');
        }

        $remedio->delete();
        return true;
    }
}
