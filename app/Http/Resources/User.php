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
            'name'              => $this->name,
            'surname'           => $this->surname,
            'cedula'            => $this->cedula,
            'phone'             => $this->phone,
            'email'             => $this->email,
            // 'role'              => new \App\Http\Resources\Role($this->role),
            'role'              => $this->role->name,
            'residency_id'      => $this->building_id,
            'residency'         => $this->building ? $this->building->name : 'Administrador',
            'floor'             => $this->floor,
            'apartment'         => $this->apartment,
            'parking_lot'       => $this->parking_lot,
            'main'              => $this->main,
            'photo'             => $this->photo,
            'persistanceState'  => 'Unchanged',
        ];
    }
}
