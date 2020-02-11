<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Bank extends Model
{
    use Notifiable;

    protected $fillable = ['name'];

    /**
     * Reación uno a muchos con Accounts
     */
}
