<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    use HasFactory;

    protected $fillable = ['code','company_id','name','color','description','status'];

    public function articles(){
        return $this->hasMany('App\Models\article');
    }

    public function subcategories(){
        return $this->hasMany('App\Models\Subcategory','category_code','code');
    }
}
