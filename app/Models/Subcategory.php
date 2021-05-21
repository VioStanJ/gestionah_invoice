<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    use HasFactory;

    protected $fillable = ['company_id','name','category_code','description','status'];

    public function category()
    {
        return $this->hasOne('App\Models\category', 'code', 'category_code');
    }
}
