<?php

namespace App\Http\Requests\General;

use App\Http\Requests\CustomFormRequest;

class UpdateProfileRequest extends CustomFormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function rules()
    {
        return [
            'email' => 'string|email|max:100',
            'password'=> 'required_with:password_confirmation|min:6',
            'password_confirmation'=> 'required_with:password|same:password|min:6',
            'birthday' => 'date_format:d/m/Y'
        ];
    }

    public function messages()
    {
        return [
            'email.email' => 'Escriba un correo válido',
            'email.max' => 'Escriba máximo 100 caracteres',
            'password.required_with' => 'La clave es obligatoria si es que desea actualizarla',
            'password.min' => 'Escriba al menos :min caracteres',
            'password_confirmation.required_with' => 'La clave es obligatoria si es que desea actualizarla',
            'password_confirmation.same' => 'Debe ser igual que la clave',
            'password_confirmation.min' => 'Escriba al menos :min caracteres',
            'birthday.date_format' => 'Debe escribir el siguiente formato :format'
        ];
    }
    
    
}
