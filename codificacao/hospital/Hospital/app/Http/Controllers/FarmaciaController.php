<?php

namespace App\Http\Controllers;

use App\Models\Estoque;
use App\Models\Paciente;
use App\Models\Prescricao;
use App\Models\PrescricaoRemedio;
use App\Models\Remedio;
use Illuminate\Http\Request;

class FarmaciaController extends Controller
{   
    
    public function index(){
        $pacientes = Paciente::all();
        return view('Farmacia.indexFarmacia',compact('pacientes'));
    }
    public function buscarGuia(Request $request){
        $guia = $request->input('guia');
        $idPaciente = $request->input('id_paciente');

        $prescricao = Prescricao::with(['paciente','medico','remedios'])
            ->when($idPaciente, fn($q) => $q->where('id_paciente', $idPaciente))
            ->when($guia, fn($q) => $q->where('id', $guia))
            ->first();

        return view('Farmacia.indexFarmacia', [
            'pacientes' => Paciente::all(),
            'prescricao' => $prescricao
        ])->with('warning', 'Prescrição ainda não atendida.');
        
    }
    public function painelGuias(Request $request){
        return view('Farmacia.buscarGuiasPaciente', [
            'pacientes' => Paciente::all(),
            'ultimasGuias' => null,
            'pacienteSelecionado' => null
        ]);
    }
    public function consultarGuias(Request $request){
        $id = $request->input('id_paciente');
        $paciente = Paciente::find($id);
        if(!$paciente){
            return back()->with('error', 'Paciente não encontrado.');
        }
        $ultimasGuias = Prescricao::with(['medico','remedios'])
            ->where('id_paciente', $id)
            ->orderBy('data_prescricao', 'desc')
            ->take(5)
            ->get();
        
        return view('Farmacia.buscarGuiasPaciente', [
            'pacientes' => Paciente::all(),
            'ultimasGuias' => $ultimasGuias,
            'pacienteSelecionado' => $paciente
        ]);
    }

    public function consultarEstoque(){
        $estoques = Estoque::with('remedio')->get();
        return view('Farmacia.checarEstoque',compact('estoques'));
    }

    public function criarLote(){
        $remedios = Remedio::all();
        return view('Estoque.criarLote',compact('remedios'));
    }
    public function storeLote(Request $request){
        
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
        $prescricao = Prescricao::find($id);
        if (!$prescricao) {
            return back()->with('error', 'Prescrição não encontrada.');
        }

        $remediosSelecionados = $request->input('remedios', []);
        if (empty($remediosSelecionados)) {
            return back()->with('error', 'Nenhum medicamento selecionado.');
        }

        $itens = PrescricaoRemedio::where('id_prescricao', $id)
            ->whereIn('id_remedio', $remediosSelecionados)
            ->get();

        foreach ($itens as $item) {
            $estoque = Estoque::where('id_remedio', $item->id_remedio)->first();
            $qtd = $item->quantidade ?? 1;

            if (!$estoque || $estoque->quantidade < $qtd) {
                return back()->with('error', 'Estoque insuficiente para '.$item->remedio->nome);
            }
        }

        foreach ($itens as $item) {
            Estoque::where('id_remedio', $item->id_remedio)
                ->decrement('quantidade', $item->quantidade ?? 1);
        }

        $prescricao->update(['prescricao_atendida' => true]);

        return back()->with('success', 'Prescrição atendida com sucesso!');
    }
    
}
