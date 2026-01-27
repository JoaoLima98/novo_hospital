<?php

namespace App\Services;

use App\Models\Estoque;
use App\Models\Prescricao;
use App\Models\Paciente;
use Exception;

class FarmaciaService
{
    public function criarLote($idRemedio, $quantidade)
    {
        if ($quantidade <= 0 || $quantidade === null) {
            throw new Exception('O número deve ser maior que zero.');
        }

        return Estoque::create([
            'id_remedio' => $idRemedio,
            'quantidade' => $quantidade,
        ]);
    }

    public function buscarGuia($idPaciente)
    {
        $paciente = Paciente::find($idPaciente);

        if (!$paciente) {
            throw new Exception('Paciente não encontrado.');
        }

        return Prescricao::where('id_paciente', $idPaciente)->first();
    }

    public function marcarPrescricaoAtendida($idPrescricao, array $remedios)
    {
        foreach ($remedios as $idRemedio) {
            $estoque = Estoque::where('id_remedio', $idRemedio)->first();
            if ($estoque) {
                $estoque->update(['quantidade' => max(0, $estoque->quantidade - 1)]);
            }
        }

        return true;
    }

    public function retornarAlertaEstoque(){
        
    }
}
