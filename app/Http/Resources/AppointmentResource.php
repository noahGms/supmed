<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AppointmentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'start_date' => optional($this->start_date)->format('Y-m-d H:i'),
            'end_date' => optional($this->end_date)->format('Y-m-d H:i'),
            'patient' => PersonResource::make(optional($this->patient->person)),
            'doctor' => DoctorResource::make(optional($this->doctor)),
            'type' => AppointmentsTypeResource::make(optional($this->type))
        ];
    }
}
