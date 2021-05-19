<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAdress extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','country_id','city','adress'];

    public function country()
    {
        return $this->hasOne('App\Models\Country', 'id', 'country_id');
    }
}
