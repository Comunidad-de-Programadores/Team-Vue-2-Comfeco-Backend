<?php

namespace App\Http\Requests\General;

use App\Http\Requests\CustomFormRequest;

class LoginRequest extends CustomFormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'email' => 'required|string|email|max:100',
            'password'=> 'required'
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'El correo es obligatorio',
            'email.email' => 'Escriba un correo válido',
            'email.max' => 'Escriba máximo 100 caracteres',
            'password.required' => 'La clave es obligatoria',
        ];
    }
}
