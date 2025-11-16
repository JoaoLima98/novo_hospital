<?php

namespace App\Http\Controllers;

use App\Models\Estoque;
use App\Models\Paciente;
use App\Models\Prescricao;
use App\Models\PrescricaoRemedio;
use App\Models\Remedio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB; // Importar DB para transações

class FarmaciaController extends Controller
{

    public function index()
    {
        Gate::authorize('farmaceutico');
        return redirect()->route('painel.guias');
    }

    
    public function buscarGuia(Request $request)
    {
        // Redireciona para o painel principal
        return redirect()->route('painel.guias');
    }

    
    public function painelGuias(Request $request)
    {
        Gate::authorize('farmaceutico');

        $todasGuias = Prescricao::with([
            'medico',
            'paciente', 
            'remedios.estoques' 
        ])
            ->orderBy('id', 'desc')
            ->get();

        return view('Farmacia.buscarGuiasPaciente', [
            'pacientes' => Paciente::all(),
            'ultimasGuias' => $todasGuias,
            'pacienteSelecionado' => null
        ]);
    }

    public function consultarGuias(Request $request)
    {
        Gate::authorize('farmaceutico');
        $id = $request->input('id_paciente');
        $paciente = Paciente::find($id);

        if (!$paciente) {
            return back()->with('error', 'Paciente não encontrado.');
        }

        $ultimasGuias = Prescricao::with([
            'medico',
            'paciente', 
            'remedios.estoques' 
        ])
            ->where('id_paciente', $id)
            ->orderBy('id', 'desc') 
            ->get(); 

        return view('Farmacia.buscarGuiasPaciente', [
            'pacientes' => Paciente::all(),
            'ultimasGuias' => $ultimasGuias,
            'pacienteSelecionado' => $paciente
        ]);
    }

    public function consultarEstoque()
    {
        $estoques = Estoque::with('remedio')->get();
        return view('Farmacia.checarEstoque', compact('estoques'));
    }

    public function criarLote()
    {
        $remedios = Remedio::all();
        return view('Estoque.criarLote', compact('remedios'));
    }

    public function storeLote(Request $request)
    {
        if ($request->input('quantidade') <= 0) {
            throw ValidationException::withMessages([
                'quantidade' => 'O número deve ser maior que zero.'
            ]);
        }
        $codigos = [];
        for ($i = 0; $i < 4; $i++) {
            $numero = str_pad(rand(1, 999), 3, '0', STR_PAD_LEFT);
            $codigos[] = 'L' . $numero;
        }
        Estoque::create([
            'id_remedio' => $request->input('id_remedio'),
            'quantidade' => $request->input('quantidade'),
            'lote'       => $codigos[0],
        ]);
        return redirect()->route('consultar.estoque')->with('success', 'Lote criado com sucesso.');
    }

    public function marcarPrescricaoAtendida(Request $request, int $id)
    {
        $prescricao = Prescricao::with('remedios')->find($id);
        if (!$prescricao) {
            return back()->with('error', 'Prescrição não encontrada.');
        }

        $remediosSelecionadosIds = $request->input('remedios', []);
        if (empty($remediosSelecionadosIds)) {
            return back()->with('error', 'Nenhum medicamento selecionado para entrega.');
        }

        DB::beginTransaction();
        try {
            
            $itensParaAtender = $prescricao->remedios()
                ->whereIn('remedios.id', $remediosSelecionadosIds)
                ->get();

            foreach ($itensParaAtender as $remedio) {

                $quantidadeNecessaria = $remedio->pivot->quantidade; 
                
                $estoqueTotal = $remedio->estoques->sum('quantidade');
                if ($estoqueTotal < $quantidadeNecessaria) {
                    throw new \Exception('Estoque insuficiente para ' . $remedio->nome . '. Necessário: ' . $quantidadeNecessaria . ', Disponível: ' . $estoqueTotal);
                }

                $lote = $remedio->estoques()->where('quantidade', '>=', $quantidadeNecessaria)->first();
                if (!$lote) {

                    $lote = $remedio->estoques()->where('quantidade', '>', 0)->first();
                }
                
                if (!$lote) {
                     throw new \Exception('Nenhum lote com estoque encontrado para ' . $remedio->nome . ', embora o total agregado exista.');
                }
                
                $lote->decrement('quantidade', $quantidadeNecessaria);

                $prescricao->remedios()->updateExistingPivot($remedio->id, ['atendido' => true]);
            }

            
            $totalRemediosNaGuia = $prescricao->remedios()->count();
            
            $prescricao->load('remedios'); 
            
            $totalRemediosAtendidos = $prescricao->remedios->where('pivot.atendido', true)->count();

            $novoStatus = 'nao_atendido';
            if ($totalRemediosAtendidos == $totalRemediosNaGuia) {
                $novoStatus = 'atendido';
            } elseif ($totalRemediosAtendidos > 0) {
                $novoStatus = 'atendido_parcialmente';
            }

            $prescricao->update(['prescricao_atendida' => $novoStatus]);
            DB::commit();

            return back()->with('success', 'Prescrição atendida com sucesso! Status: ' . $novoStatus);

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Erro ao atender prescrição: ' . $e->getMessage());
        }
    }
}