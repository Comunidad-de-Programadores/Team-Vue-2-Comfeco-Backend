<?php


namespace App\Http\Requests\User;

use App\Http\Controllers\CustomController;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UserRequest extends FormRequest
{
    private $customController;

    public function __construct()
    {
      $this->customController = new CustomController;
    }

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'id' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'id.required' => 'Es obligatorio enviar un id'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            "error" => true,
            "errors" => $validator->errors()
        ], $this->customController->errorStatus));
    }
}
