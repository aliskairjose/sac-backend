<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class BankAccount extends Model
{
    use Notifiable;

    protected $fillable = [ 'bank_id', 'residency_id', 'account_number', 'type' ];


    /**
     * Relación uno a uno con banco
     */
    public function bank(){
        return $this->belongsTo(Bank::class);
    }
}
