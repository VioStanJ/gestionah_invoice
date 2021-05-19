<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanySetting extends Model
{
    use HasFactory;

    protected $fillable = ['company_id','nb_location','nb_user','used_user','used_location','nb_provider','nb_product','used_provider','user_product','nb_sales'
    ,'used_sales','used_customers','used_invoices'];
}
