<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proposal extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'code',
        'customer_code',
        'issue_date',
        'status',
        'category_code',
        'is_convert',
        'converted_invoice_id',
        'created_by',
    ];

    public static $statues = [
        'Draft',
        //0
        'Open',
        //1
        'Accepted',
        //2
        'Declined',
        //3
        'Close',
        //4
    ];

    public function category()
    {
        return $this->hasOne('App\Models\category','code', 'category_code');
    }

    public function customer()
    {
        return $this->hasOne('App\Models\Customer','code', 'customer_code');
    }

    public function items()
    {
        return $this->hasMany('App\Models\ProposalProduct', 'proposal_code', 'code');
    }

    public function getSubTotal()
    {
        $subTotal = 0;
        foreach($this->items as $product)
        {
            $subTotal += ($product->price * $product->quantity);
        }

        return $subTotal;
    }

    public function getTotal()
    {
        return ($this->getSubTotal() + $this->getTotalTax()) - $this->getTotalDiscount();
    }

    public function getTotalDiscount()
    {
        $totalDiscount = 0;
        foreach($this->items as $product)
        {
            $totalDiscount += $product->discount;
        }

        return $totalDiscount;
    }

    public function getTotalTax()
    {
        $totalTax = 0;
        foreach($this->items as $product)
        {
            $taxes = \App\Utility::totalTaxRate($product->tax);

            $totalTax += ($taxes / 100) * ($product->price * $product->quantity);
        }

        return $totalTax;
    }
}
