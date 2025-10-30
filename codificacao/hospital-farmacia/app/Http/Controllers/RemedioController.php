<?php

namespace App\Http\Controllers;

use App\Models\Remedio;
use Illuminate\Http\Request;

class RemedioController extends Controller
{
    public function create(){
        return view('Remedio.createRemedio');
    }
    public function store(Request $request){
        $nome = $request->nome;
        Remedio::create($nome);
        return back()->with('success', 'Remedio cadastrado com sucesso ! Agora poderá ser feito pedidos em lotes !');
    }
}
