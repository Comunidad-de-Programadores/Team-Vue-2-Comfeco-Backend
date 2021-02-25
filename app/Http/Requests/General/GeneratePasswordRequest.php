<?php

namespace App\Http\Requests\General;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class GeneratePasswordRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'email' => 'required|string',
            'password'=> 'required|required_with:password_confirmation|same:password_confirmation|min:6',
            'password_confirmation' => 'required|min:6',
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'El correo es obligatorio',
            'password.required' => 'La clave es obligatoria',
            'password.required_with' => 'Se debe escribir también la confirmación de clave',
            'password.same' => 'Ambas claves deben ser iguales',
            'password.min' => 'Escriba al menos :min caracteres',
            'password_confirmation.required' => 'La confirmación de clave es obligatoria',
            'password_confirmation.min' => 'Escriba al menos :min caracteres',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            "error" => true,
            "errors" =>$validator->errors()
        ], 200));
    }
}
