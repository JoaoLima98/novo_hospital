<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class UserService
{
    public function cadastrarUser(array $dados)
    {
        // validações básicas
        $validator = Validator::make($dados, [
            'nome'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'perfil' => 'required|string',
            'crm'   => 'nullable|unique:users,crm',
            'password' => 'required|min:6'
        ], [
            'email.unique' => 'Email já está sendo utilizado',
            'email.email'  => 'email deve seguir o padrão joao@email.com',
            'crm.unique'   => 'CRM já está sendo utilizado',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        // cria o user
        return User::create([
            'name' => $dados['nome'],
            'email' => $dados['email'],
            'perfil' => $dados['perfil'],
            'crm' => $dados['crm'] ?? null,
            'password' => bcrypt($dados['password']),
        ]);
    }
}
