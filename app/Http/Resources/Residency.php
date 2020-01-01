<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
// use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\Resource;

class Residency extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'state' => $this->state,
            'providence' => $this->providence,
            'address' => $this->address,
            'floors' => $this->floors,
            'apartments' => $this->apartments,
            'rif' => $this->rif,
            'status' => 'New',
        ];
    }
}
