<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class User extends JsonResource {
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray( $request ) {
        // Retorna toda la data completa
        // return parent::toArray( $request );

        // Returna la data que se desea en el formato que se desea
        return [
            'id'                => $this->id,
            'email'             => $this->email,
            'role'              => $this->role->name,
        ];
    }
}
