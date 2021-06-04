<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProposalProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'proposal_id',
        'quantity',
        'tax',
        'discount',
        'total',
        'decription'
    ];

    public function product()
    {
        return $this->hasOne('App\Models\Article', 'code', 'product_code');
    }
}
