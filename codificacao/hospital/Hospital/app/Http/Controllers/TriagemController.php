<?php

namespace App\Http\Controllers;

use App\Models\Especialidade;
use App\Models\Paciente;
use App\Models\Triagem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TriagemController extends Controller
{
    public function create()
    {
        $pacientes = Paciente::all();
        $especialidades = Especialidade::all();
        return view('Triagem.createTriagem',compact('pacientes', 'especialidades'));
    }

    public function store(Request $request)
    {
        

        try {
            DB::beginTransaction();

            $triagem = new Triagem();

            $data = $request->all();
            $data['enfermeiro_id'] = auth()->id();
            if ($request->has('sintomas_gripais') && is_array($request->sintomas_gripais)) {
                $data['sintomas_gripais'] = implode(', ', $request->sintomas_gripais);
            } else {
                $data['sintomas_gripais'] = null;
            }


            $triagem->fill($data);


            $triagem->enfermeiro_id = auth()->id();

            $triagem->acidente_trabalho = $request->has('acidente_trabalho') ? 1 : 0;
            $triagem->acidente_veiculo  = $request->has('acidente_veiculo') ? 1 : 0;


            if (!$triagem->acidente_veiculo) {
                $triagem->tipo_envolvimento_veiculo = null;
            }

            $triagem->save();

            if ($request->has('especialidades')) {
                $triagem->especialidades()->sync($request->especialidades);
            }
            DB::commit();

            return redirect()
                ->route('dashboard') 
                ->with('success', 'Triagem realizada com sucesso!');

        } catch (\Exception $e) {
            DB::rollBack();


            return redirect()->back()
                ->withInput()
                ->with('swal_error', 'Erro no sistema: ' . $e->getMessage());
        }
    }
}
