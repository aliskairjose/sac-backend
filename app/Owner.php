<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Owner extends Model
{
    use Notifiable;

    protected $filliable = [
        'email',
        'name',
        'surname',
        'cedula',
        'phone',
        'floor',
        'apatment',
        'parking_lot',
        'main',
        'photo',
        'building_id',
        'user_id'
    ];
}
