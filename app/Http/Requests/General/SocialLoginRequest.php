<?php

namespace App\Http\Requests\General;

use App\Http\Requests\CustomFormRequest;

class SocialLoginRequest extends CustomFormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'email' => 'required|string|email',
            'id'=> 'required',
            'provider'=> 'required',
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'El correo es obligatorio',
            'email.email' => 'Escriba un correo válido',
            'provider.required' => 'La red social es obligatoria',
            'id.required' => 'La red social es obligatoria',
        ];
    }
}
