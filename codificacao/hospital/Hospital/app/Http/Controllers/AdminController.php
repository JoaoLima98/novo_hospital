<?php

namespace App\Http\Controllers;

use App\Models\Farmaceutico;
use App\Models\Medico;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function criarUsuario(){
        return view('admin.criarUser');
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
            Medico::create([
                'user_id' => $user->id,
                'nome'    => $request->name,
                'especialidade' => $request->especialidade,
                'telefone' => $request->telefone,
                'crm' => $request->crm,
            ]);


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
        }else{
            //
        }
        return back()->with('success','Usuário criado com sucesso!');
    }
}
