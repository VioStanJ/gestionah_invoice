<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;

    protected $fillable = [
        'name','slug','short_description',
        'description','nb_users','nb_sales',
        'nb_stores','nb_provider','nb_provider',
        'nb_product','nb_customer','nb_invoice',
        'price','active','status','type'
    ];
}
