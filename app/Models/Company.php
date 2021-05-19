<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Company extends Model
{
    use HasFactory,HasSlug;

    protected $fillable = ['name','email','image','phone','website','description','slug','active','created_by','status'];

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug')
            ->doNotGenerateSlugsOnUpdate();
    }

    public function users()
    {
        return $this->hasMany('App\Models\UserCompany', 'company_id', 'id')->where('active','=',1);
    }

    public function adress()
    {
        return $this->hasOne('App\Models\CompanyAdress', 'company_id');
    }

    public function setting()
    {
        return $this->hasOne('App\Models\CompanySetting', 'company_id');
    }
}
