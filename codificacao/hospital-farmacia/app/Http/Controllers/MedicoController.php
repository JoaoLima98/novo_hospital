<?php

namespace App\Http\Controllers;

use App\Models\Estoque;
use App\Models\Paciente;
use App\Models\Prescricao;
use App\Models\PrescricaoRemedio;
use App\Models\Remedio;
use Illuminate\Http\Request;

class MedicoController extends Controller
{

    public function index(){
        $pacientes = Paciente::all();
        $remedios = Remedio::all();

        return view('welcome',compact('pacientes','remedios'));
    }
    public function criarPrescricao(Request $request){
        
        $prescricao = Prescricao::create([
            'id_medico' => 1,
            'id_paciente' => $request->id_paciente,
            'data_prescricao' => now(),
            'observacao' => $request->observacao,
        ]);
        foreach($request->medicamentos as $remedio){
            PrescricaoRemedio::create([
                'id_prescricao' => $prescricao->id,
                'id_remedio' => $remedio['id'],
            ]);
        }
        return back()->with('success', 'Prescrição criada com sucesso ! GUIA: '.$prescricao->id);
        
    }
    public function marcarPrescricaoAtendida(int $id)
    {
        $prescricao = Prescricao::find($id);
        if(!$prescricao){
            return back()->with('error', 'Prescrição não encontrada.');
        }

        $idRemedios = PrescricaoRemedio::where('id_prescricao', $prescricao->id)->get();

        // Checa estoque antes de atualizar prescrição
        foreach ($idRemedios as $remedioPrescrito) {
            $qtd = $remedioPrescrito->quantidade ?? 1;
            $estoque = Estoque::where('id_remedio', $remedioPrescrito->id_remedio)->first();

            if (!$estoque || $estoque->quantidade < $qtd) {
                return back()->with('error', 'Estoque insuficiente para o remédio ID '.$remedioPrescrito->id_remedio);
            }
        }

        // Decrementa o estoque
        foreach ($idRemedios as $remedioPrescrito) {
            $qtd = $remedioPrescrito->quantidade ?? 1;
            Estoque::where('id_remedio', $remedioPrescrito->id_remedio)
                ->decrement('quantidade', $qtd);
        }

        // Marca a prescrição como atendida
        $prescricao->update(['prescricao_atendida' => true]);

        return back()->with('success', 'Prescrição atendida com sucesso!');
    }


    

}
