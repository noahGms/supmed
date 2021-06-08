<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AddressResource extends JsonResource
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
            'street_number' => $this->street_number,
            'street_name' => $this->street_name,
            'zipcode' => $this->zipcode,
            'city' => $this->city,
            'fulladdress' => $this->fulladdress
        ];
    }
}
