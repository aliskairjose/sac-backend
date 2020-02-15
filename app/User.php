<?php

namespace App;

use App\Notifications\ResetPasswordNotification;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;

class  User extends Authenticatable implements JWTSubject {
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'surname',
        'cedula',
        'phone',
        'email',
        'building_id',
        'floor',
        'apartment',
        'parking_lot',
        'role_id',
        'main',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getJWTIdentifier() {
        return $this->getKey();
    }

    public function getJWTCustomClaims() {
        return [];
    }

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }

    /**
     * Relacion uno a uno con Role
     */
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * Relación uno a uno con Residencia
     */
    public function building()
    {
        return $this->belongsTo(Building::class);
    }

    public static function scopeMainBoard($query, $id)
    {
        if($id){
            return $query->where('building_id','=', $id)->where('main','=', true)->get();
        }
    }
}
