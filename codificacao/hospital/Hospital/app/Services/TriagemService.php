<?php

namespace App\Services;

use App\Models\Triagem;
use Illuminate\Support\Facades\DB;

class TriagemService
{
    /**
     * Responsável por validar as regras de negócio e salvar a triagem
     */
    public function registrarTriagem(array $dados, int $enfermeiroId)
    {
        // 1. Validação de Manchester Obrigatório
        if (empty($dados['manchester_classificacao'])) {
            throw new \Exception('O campo Classificação de Risco (Manchester) é obrigatório.');
        }

        // 2. Validação de Glasgow Obrigatório
        if (!isset($dados['glasgow']) || $dados['glasgow'] === '') { // isset checa se existe, null ou vazio
            throw new \Exception('O campo Total Glasgow é obrigatório.');
        }

        // 3. Validação de Intervalo Glasgow (Range 3-15)
        $glasgow = (int) $dados['glasgow'];
        if ($glasgow < 3 || $glasgow > 15) {
            throw new \Exception('O valor de Glasgow deve estar entre 3 e 15.');
        }

        // 4. Validação de Intervalo Escore de Dor (Range 0-10)
        // Dor pode ser nula/vazia (se o paciente não responde), mas SE vier, tem que ser 0-10
        if (isset($dados['escore_dor']) && $dados['escore_dor'] !== null) {
            $dor = (int) $dados['escore_dor'];
            if ($dor < 0 || $dor > 10) {
                throw new \Exception('O escore de dor deve estar entre 0 e 10.');
            }
        }

        // 5. Preparação dos dados extras
        $dados['enfermeiro_id'] = $enfermeiroId;

        // Formata sintomas gripais (array para string)
        if (isset($dados['sintomas_gripais']) && is_array($dados['sintomas_gripais'])) {
            $dados['sintomas_gripais'] = implode(', ', $dados['sintomas_gripais']);
        } else {
            $dados['sintomas_gripais'] = null;
        }

        $dados['acidente_trabalho'] = isset($dados['acidente_trabalho']) ? 1 : 0;
        $dados['acidente_veiculo']  = isset($dados['acidente_veiculo']) ? 1 : 0;

        if (!$dados['acidente_veiculo']) {
            $dados['tipo_envolvimento_veiculo'] = null;
        }

        // 6. Persistência no Banco
        return Triagem::create($dados);
    }
}