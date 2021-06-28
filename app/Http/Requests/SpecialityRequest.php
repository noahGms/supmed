<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class SpecialityRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if ($this->getMethod() === Request::METHOD_POST) {
            $data = [
                'name' => 'required|string|max:45',
            ];
        } else {
            $data = [
                'name' => 'string|max:45'
            ];
        }
        return array_merge($data, [
            'description' => 'string|max:255',
            'keywords' => 'sometimes|required|array',
            'keywords.*' => 'string|max:45'
        ]);
    }
}
