<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCompany extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','company_id','type_code','active'];

    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }
    public function company()
    {
        return $this->hasOne('App\Models\Company', 'id', 'company_id');
    }

    public function type()
    {
        return $this->hasOne('App\Models\UserType', 'code', 'type_code');
    }
}
