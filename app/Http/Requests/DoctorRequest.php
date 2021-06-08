<?php

namespace App\Http\Requests;

use App\Models\Person;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class DoctorRequest extends FormRequest
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
                'email' => 'required|email|unique:persons,email',
                'password' => 'required|string|confirmed',
            ];
        } else {
            $data = [];
        }

        return array_merge($data, array_merge(Person::$rules, [
            'specialities' => 'nullable',
            'specialities.*' => 'nullable|int|exists:specialities,id'
        ]));
    }
}
