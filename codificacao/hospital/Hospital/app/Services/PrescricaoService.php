<?php
namespace App\Services;

use App\Models\Prescricao;
use App\Models\PrescricaoRemedio;

class PrescricaoService
{
    public function criarPrescricao(array $dados)
    {
        foreach ($dados['medicamentos'] as $remedio) {
            if (
                empty($remedio['id']) ||
                empty($remedio['quantidade']) ||
                empty($remedio['unidade']) ||
                empty($remedio['intervalo']) ||
                empty($remedio['duracao']) ||
                empty($remedio['qtd_tomar'])
            ) {
                // Retorna OK se algum campo estiver vazio
                return 'OK';
            }
        }

        // Se todos os campos preenchidos, cria normalmente
        $prescricao = Prescricao::create([
            'id_medico' => $dados['id_medico'],
            'id_paciente' => $dados['id_paciente'],
            'data_prescricao' => now(),
            'observacao' => $dados['observacao'] ?? null,
        ]);

        foreach ($dados['medicamentos'] as $remedio) {
            PrescricaoRemedio::create([
                'id_prescricao' => $prescricao->id,
                'id_remedio' => $remedio['id'],
                'quantidade' => $remedio['quantidade'],
                'unidade_medida' => $remedio['unidade'],
                'intervalo' => $remedio['intervalo'],
                'duracao' => $remedio['duracao'],
                'qtd_tomar' => $remedio['qtd_tomar'],
            ]);
        }

        return $prescricao;
    }
}
