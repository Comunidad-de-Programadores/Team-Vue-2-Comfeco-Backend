<?php

namespace App\Http\Requests\General;

use App\Http\Requests\CustomFormRequest;

class BadgeRequest extends CustomFormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string',
            'description' => 'required|string',
            'image_url' => 'required|string'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Es necesario un nombre',
            'description.required' => 'Es necesaria una descripcion para obtener dicha medalla',
            'image_url.required' => 'Es necesaria una imagen que identifique la insignia'
        ];
    }
}
