<?php

namespace App\Http\Requests\General;

use App\Http\Requests\CustomFormRequest;

class RegisterRequest extends CustomFormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|min:6|max:100',
            'email' => 'required|string|unique:users,email,'. null .',id,deleted_at,NULL',
            'password'=> 'required|required_with:password_confirmation|same:password_confirmation|min:6',
            'password_confirmation' => 'required|min:6',
            'term_conditions' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El nombre completo es obligatorio',
            'name.string' => 'Escriba un nombre válido',
            'name.min' => 'Escriba su nombre completo',
            'name.max' => 'Escriba máximo :max caracteres',
            'email.required' => 'El correo es obligatorio',
            'email.unique' => 'Este correo ya está siendo usado',
            'email.email' => 'Escriba un correo válido',
            'email.max' => 'Escriba máximo :max caracteres',
            'password.required' => 'La clave es obligatoria',
            'password.required_with' => 'Se debe escribir también la confirmación de clave',
            'password.same' => 'Ambas claves deben ser iguales',
            'password.min' => 'Escriba al menos :min caracteres',
            'password_confirmation.required' => 'La confirmación de clave es obligatoria',
            'password_confirmation.min' => 'Escriba al menos :min caracteres',
            'term_conditions' => 'Es obligatorio seleccionar los terminos y condiciones'
        ];
    }
}
