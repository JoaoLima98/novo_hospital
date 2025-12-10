<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use App\Models\Remedio;
use App\Models\Prescricao;
use App\Models\PrescricaoRemedio;
use App\Models\Triagem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class MedicoController extends Controller
{
    // Exibe apenas a lista de espera (Triagem)
    public function index(){
        Gate::authorize('medico');

        $medico = auth()->user()->medico;
        $especialidadesMedico = $medico->especialidades->pluck('id');

        $pacientesRaw = Paciente::whereHas('triagem', function($q) use ($especialidadesMedico) {
            $q->where('atendido', 0)
            ->whereHas('especialidades', function($q2) use ($especialidadesMedico) {
                    $q2->whereIn('especialidade_id', $especialidadesMedico);
            });
        })
        ->with(['triagem' => function($q) use ($especialidadesMedico) {
            $q->where('atendido', 0)
            ->whereHas('especialidades', function($q2) use ($especialidadesMedico) {
                    $q2->whereIn('especialidade_id', $especialidadesMedico);
            })
            ->with('enfermeiro');
        }])
        ->get();

        // tua lógica do Manchester/Glasgow
        $prioridadeManchester = [
            'Emergência' => 1,
            'Muito Urgente' => 2,
            'Urgente' => 3,
            'Pouco Urgente' => 4,
            'Não Urgente' => 5
        ];

        $pacientes = $pacientesRaw->sort(function ($a, $b) use ($prioridadeManchester) {
            $triagemA = $a->triagem;
            $triagemB = $b->triagem;

            $pesoA = $prioridadeManchester[$triagemA->manchester_classificacao] ?? 99;
            $pesoB = $prioridadeManchester[$triagemB->manchester_classificacao] ?? 99;
            if ($pesoA !== $pesoB) return $pesoA <=> $pesoB;

            $glasgowA = $triagemA->glasgow ?? 15;
            $glasgowB = $triagemB->glasgow ?? 15;
            if ($glasgowA !== $glasgowB) return $glasgowA <=> $glasgowB;

            return $triagemA->created_at <=> $triagemB->created_at;
        });

        return view('Medico.index', compact('pacientes'));
    }

    public function minhasTriagens(){
        Gate::authorize('medico');

        $medico = auth()->user()->medico;
        $pacientes = Paciente::whereHas('triagem', function($q) use ($medico) {
            $q->where('medico_id', $medico->id);
        })
        ->with(['triagem' => function($q) {
            $q->with('enfermeiro'); 
        }])
        ->get();

        $pacientes = $pacientes->sortByDesc(function($p) {
            return $p->triagem->created_at ?? 0;
        });

        return view('Medico.minhasTriagens', compact('pacientes'));
    }


    // Carrega a tela de prescrição para um paciente específico
   public function atender($id)
    {
        Gate::authorize('medico');

        $paciente = Paciente::with('triagem')->findOrFail($id);
        // atendido
        $remedios = Remedio::whereHas('estoques', function ($query) {
            $query->where('quantidade', '>', 0);
        })->withSum('estoques', 'quantidade')->get();

        return view('Medico.criarPrescricao', compact('paciente', 'remedios'));
    }

    public function criarPrescricao(Request $request)
    {
        // Sua lógica de salvar permanece idêntica
        $prescricao = Prescricao::create([
            'id_medico' => auth()->user()->medico->id,
            'id_paciente' => $request->id_paciente,
            'data_prescricao' => now(),
            'observacao' => $request->observacao,
        ]);
        $ultimaTriagem = Triagem::where('paciente_id', $request->id_paciente)
            ->orderBy('created_at', 'desc')
            ->first();
        if ($ultimaTriagem) {
            $ultimaTriagem->update(['atendido' => true, "medico_id" => auth()->user()->medico->id]);
        }
        if($request->has('medicamentos')){
            foreach($request->medicamentos as $remedio){
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
        }
        
        // Redireciona de volta para a LISTA (index) após atender
        return redirect()->route('medico.index')->with('success', 'Prescrição criada com sucesso! GUIA: '.$prescricao->id);
    }
}