<?php

namespace App\Http\Requests\General;

use App\Http\Requests\CustomFormRequest;

class CancelRecoverPasswordRequest extends CustomFormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'email' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'El correo es obligatorio',
        ];
    }
}
