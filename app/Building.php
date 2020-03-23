<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Building extends Model
{
    use Notifiable;

    /**
     *  The attributes thar are mass assignable
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'state', 'city', 'address', 'floors', 'apartments', 'rif'
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
    public function owners()
    {
        return $this->hasMany(Owner::class);
    }

    /**
     * Relacion uno a muchos con Accounts
     */
    public function accounts()
    {
        return $this->hasMany(BankAccount::class);
    }


}
