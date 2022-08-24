<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'card_id',
        'product_id',
        'quantity',
        'price',
        'color',
        'size',
        'summation'
    ];

    public function product(){
        return $this->hasOne(\App\Models\product::class,'id','product_id');
    }
    
}
