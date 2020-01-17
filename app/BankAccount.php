<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class BankAccount extends Model
{
    use Notifiable;

    protected $fillable = [ 'bank_id', 'residency_id', 'bank_name', 'account_number', 'type' ];
}
