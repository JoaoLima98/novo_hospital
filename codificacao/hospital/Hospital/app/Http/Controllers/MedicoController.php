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
    public function index()
    {
        Gate::authorize('medico');

        $pacientesRaw = Paciente::whereHas('triagem', function($q) {
            $q->where('atendido', 0);
        })
        ->with(['triagem' => function($q) {
            $q->where('atendido', 0)
            ->with('enfermeiro');
        }])
        ->get();

        $prioridadeManchester = [
            'Emergência' => 1,    // Vermelho
            'Muito Urgente' => 2, // Laranja
            'Urgente' => 3,       // Amarelo
            'Pouco Urgente' => 4, // Verde
            'Não Urgente' => 5    // Azul
        ];

        // Lógica de Ordenação (Manchester -> Glasgow -> Data Chegada)
        $pacientes = $pacientesRaw->sort(function ($a, $b) use ($prioridadeManchester) {
            $triagemA = $a->triagem;
            $triagemB = $b->triagem;

            // 1. Manchester
            $classA = $triagemA->manchester_classificacao ?? 'Não Urgente';
            $classB = $triagemB->manchester_classificacao ?? 'Não Urgente';
            
            $pesoA = $prioridadeManchester[$classA] ?? 99;
            $pesoB = $prioridadeManchester[$classB] ?? 99;

            if ($pesoA !== $pesoB) return $pesoA <=> $pesoB;

            // 2. Glasgow (assumindo que menor é mais grave/empate)
            $glasgowA = $triagemA->glasgow ?? 15;
            $glasgowB = $triagemB->glasgow ?? 15;
            if ($glasgowA !== $glasgowB) return $glasgowA <=> $glasgowB;

            // 3. Data (FIFO)
            return $triagemA->created_at <=> $triagemB->created_at;
        });

        return view('Medico.index', compact('pacientes'));
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
            $ultimaTriagem->update(['atendido' => true]);
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