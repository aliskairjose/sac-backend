<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BankAccount extends JsonResource
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
          'id'             => $this->id,
          'bank_id'        => $this->bank_id,
          'building_id'    => $this->building_id,
          'bank_name'      => $this->bank->name,
          'account_number' => $this->account_number,
          'type'           => $this->type
        ];
    }
}
