<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DoctorResource extends JsonResource
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
            'id' => $this->person_id,
            'email' => $this->person->email,
            'fullname' => $this->person->fullname,
            'firstname' => $this->person->firstname,
            'lastname' => $this->person->lastname,
            'phone' => $this->person->phone,
            'role' => $this->person->role,
            'specialities' => SpecialityResource::collection(optional($this->specialities)),
            'address' => AddressResource::make(optional($this->person->address))
        ];
    }
}
