<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = ['code','codebar','name','image','category_code','sub_category_code','description','tva','created_by','deleted_by','status','taxe','price','ttc','is_service','qty'];

    public function category()
    {
        return $this->hasOne('App\Models\category','code', 'category_code');
    }

    public function subcategory()
    {
        return $this->hasOne('App\Models\Subcategory','code', 'sub_category_code');
    }

    public function unit()
    {
        return $this->hasOne('App\Models\ProductUnit', 'code', 'unit_code')->first();
    }
}
