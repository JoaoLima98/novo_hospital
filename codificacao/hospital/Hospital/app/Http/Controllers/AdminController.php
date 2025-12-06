<?php

namespace App\Http\Controllers;

use App\Models\Enfermeiro;
use App\Models\Especialidade;
use App\Models\Farmaceutico;
use App\Models\Medico;
use App\Models\User;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class AdminController extends Controller
{
    public function criarUsuario(){
        Gate::authorize('adm');
        $especialidades = Especialidade::all();
        return view('admin.criarUser', compact('especialidades'));
    }

    public function storeUsuario(Request $request){
        if($request->perfil === 'medico'){
            
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'telefone' => $request->telefone,
                'perfil' => 'medico',
                'password' => bcrypt($request->password),
            ]);
            $medicoExiste = Medico::where('crm', $request->crm)->first();
            if($medicoExiste){
                return back()->with('error', 'CRM já cadastrado !');
            }
            $medico = Medico::create([
                'user_id' => $user->id,
                'nome'    => $request->name,
                'telefone' => $request->telefone,
                'crm' => $request->crm,
            ]);

            if ($request->has('especialidade')) {
                $medico->especialidades()->sync($request->especialidade);
            }
        }elseif($request->perfil === 'farmaceutico'){
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'telefone' => $request->telefone,
                'perfil' => 'farmaceutico',
                'password' => bcrypt($request->password),
            ]);
            Farmaceutico::create([
                'user_id' => $user->id,
            ]);
            
        }elseif($request->perfil === 'admin'){
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'telefone' => $request->telefone,
                'perfil' => 'admin',
                'password' => bcrypt($request->password),
            ]);
            //lógica para criar admin
        }else if($request->perfil === 'enfermeiro'){
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'telefone' => $request->telefone,
                'perfil' => 'enfermeiro',
                'password' => bcrypt($request->password),
            ]);
            Enfermeiro::create([
                'user_id' => $user->id,
                'coren'    => $request->coren,  
            ]);
        }
        return back()->with('success','Usuário criado com sucesso!');
    }
}
