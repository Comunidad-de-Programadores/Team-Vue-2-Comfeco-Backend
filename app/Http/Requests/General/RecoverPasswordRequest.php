<?php

namespace App\Http\Requests\General;

use App\Http\Requests\CustomFormRequest;

class RecoverPasswordRequest extends CustomFormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'email' => 'required|string|email',
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'El correo es obligatorio',
            'email.email' => 'Escriba un correo válido',
        ];
    }
}
