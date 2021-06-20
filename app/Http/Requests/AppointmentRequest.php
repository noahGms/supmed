<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class AppointmentRequest extends FormRequest
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
                'start_date' => 'required|date',
                'end_date' => 'required|date',
                'patient_id' => 'required|exists:patients,person_id|int',
                'doctor_id' => 'required|exists:doctors,person_id|int',
                'type_id' => 'exists:appointments_types,id|int'
            ];
        } else {
            $data = [
                'start_date' => 'date',
                'end_date' => 'date',
                'type_id' => 'exists:appointments_types,id|int'
            ];
        }
        return $data;
    }
}
