<?php

namespace App\Http\Requests\General;

use App\Http\Requests\CustomFormRequest;

class WorkshopRequest extends CustomFormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'area' => 'string'
        ];
    }

    public function messages()
    {
        return [
            'area.string' => 'Escriba un nombre válido',
        ];
    }
}
