<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Customer extends Authenticatable
{
    use Notifiable;

    protected $guard = 'customer';

    protected $fillable = [
        'code',
        'email',
        'password',
        'lang',
        'avatar'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
