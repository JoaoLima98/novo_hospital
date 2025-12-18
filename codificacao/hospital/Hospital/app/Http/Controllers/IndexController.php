<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class IndexController extends Controller
{
    public function index(){
        $senha = Hash::make("12312311");
        
        if(!auth()->check()){
            return view('auth.login');
        }
    }
}
