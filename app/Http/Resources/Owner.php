<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Owner extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'email' => $this->email,
            'name' => $this->name,
            'surname' => $this->surname,
            'cedula' => $this->cedula,
            'phone' => $this->phone,
            'floor' => $this->floor,
            'apartment' => $this->apartment,
            'parking_lot' => $this->parking_lot,
            'main' => $this->main,
            'photo' => $this->photo,
            'building_id' => $this->building_id,
            'user_id' => $this->user_id
        ];
    }
}
