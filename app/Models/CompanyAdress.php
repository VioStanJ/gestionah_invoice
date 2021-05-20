<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyAdress extends Model
{
    use HasFactory;

    protected $fillable = ['company_id','country_id','city','adress'];

    public function company()
    {
        return $this->belongsTo('App\Models\Company', 'company_id');
    }
}
