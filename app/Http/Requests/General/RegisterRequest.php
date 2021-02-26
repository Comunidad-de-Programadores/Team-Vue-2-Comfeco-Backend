<?php

namespace App\Http\Requests\General;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;

class RegisterRequest extends FormRequest
{
    public function authorize()
    {
        $user = User::where(
            'email', $this->input('email')
        )
            ->first();

        if($user) {
            throw new HttpResponseException(response()->json([
                "error" => true,
                "errors" => [
                    'Email already exists'
                ]
            ], 200));
        }
    }

    public function rules()
    {
        return [
            'name' => 'required|string|min:6|max:100',
            'email' => 'required|string|email|max:100',
            'password'=> 'required|required_with:password_confirmation|same:password_confirmation|min:6',
            'password_confirmation' => 'required|min:6',
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
            'email.email' => 'Escriba un correo válido',
            'email.max' => 'Escriba máximo :max caracteres',
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
            "errors" => $validator->errors()
        ], 200));
    }
}
