<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class CreateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [

            'name' => 'required',
            'email' => ['required', 'email', 'unique:App\Models\User'],
            'password' => 'min:6|required',
            'senha-repetida' => 'same:password|required',
            'telefone' => 'required',
            'cep' => 'required',
            'rua' => 'required',
            'numero' => 'required',
            'bairro' => 'required',
            'cidade' => 'required',
            'uf' => 'required',
        ];
    }

    public function messages(){
        return [
            'email.email' => 'O formato do email está invalido',
            'email.unique' => 'Já existe um usuário cadastrado com este email',
            'password.min' => 'A senha deve ter no mínimo 6 caracteres',
            'senha-repetida.same' => 'Repita a senha corretamente',
        ];
    }
}
