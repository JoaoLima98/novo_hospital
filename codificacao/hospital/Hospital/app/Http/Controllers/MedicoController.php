<?php

namespace App\Http\Controllers;

use App\Models\Estoque;
use App\Models\Paciente;
use App\Models\Prescricao;
use App\Models\PrescricaoRemedio;
use App\Models\Remedio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class MedicoController extends Controller
{

    public function index(){
        Gate::authorize('medico');
        $pacientes = Paciente::all();
        $remedios = Remedio::selectRaw('remedios.id, remedios.nome')
        ->join('estoques', 'estoques.id_remedio', '=', 'remedios.id')
        ->groupBy('remedios.id', 'remedios.nome')
        ->havingRaw('SUM(estoques.quantidade) > 1')
        ->get();
        
        return view('Medico.criarPrescricao',compact('pacientes','remedios'));
    }
    public function criarPrescricao(Request $request){
        
        $prescricao = Prescricao::create([
            'id_medico' => auth()->user()->medico->id,
            'id_paciente' => $request->id_paciente,
            'data_prescricao' => now(),
            'observacao' => $request->observacao,
        ]);
        foreach($request->medicamentos as $remedio){
            PrescricaoRemedio::create([
                'id_prescricao' => $prescricao->id,
                'id_remedio' => $remedio['id'],
                
                'quantidade' => $remedio['quantidade'],
                'unidade_medida' => $remedio['unidade'],
                'intervalo' => $remedio['intervalo'],
                'duracao' => $remedio['duracao'],

            ]);
        }
        return back()->with('success', 'Prescrição criada com sucesso ! GUIA: '.$prescricao->id);
        
    }
    


    

}
