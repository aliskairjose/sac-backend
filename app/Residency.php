<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Residency extends Model
{
    use Notifiable;

    /**
     *  The attributes thar are mass assignable
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'state', 'providence', 'address', 'floors', 'apartments', 'rif', 'id_contact'
    ];

    /**
     * The attributes that should be hidden for arrays
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [];

    /**
     * Relacion uno a muchos con Usuario
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }

    /**
     * Relacion uno a muchos con Usuario
     */
    public function accounts()
    {
        return $this->hasMany(BankAccount::class);
    }


}
