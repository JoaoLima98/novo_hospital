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
    

}
