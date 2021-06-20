<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WorkstimeResource extends JsonResource
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
            'start' => optional($this->start_date)->format('Y-m-d H:i'),
            'end' => optional($this->end_date)->format('Y-m-d H:i'),
            'class' => 'sport'
        ];
    }
}
