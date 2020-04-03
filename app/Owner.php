<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Owner extends Model
{
    use Notifiable;

    protected $fillable = [
        'email',
        'name',
        'surname',
        'cedula',
        'phone',
        'floor',
        'apartment',
        'parking_lot',
        'main',
        'photo',
        'building_id',
        'user_id'
    ];

    public function scopeGetByUser($query, $id)
    {
        return $query->where('user_id', '=', $id)->get();
    }
}
