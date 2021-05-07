<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Models\User;

class UsersController extends Controller
{
    public function store(CreateUserRequest $request) {

        $validated = $request->validated();

        $usuario = new User;
        $usuario->name = request('name');
        $usuario->email = request('email');
        $usuario->password = bcrypt(request('password'));
        $usuario->telefone = request('telefone');
        $usuario->cep = request('cep');
        $usuario->rua = request('rua');
        $usuario->bairro = request('bairro');
        $usuario->cidade = request('cidade');
        $usuario->uf = request('uf');
        $usuario->numero = request('numero');
        $usuario->save();

        return back()->with('success', 'Usuário criado com sucesso');

    }
}
