<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

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
