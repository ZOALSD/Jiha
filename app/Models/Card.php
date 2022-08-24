<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Card extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'user_id',
        'total',
        'number_notification',
        'image_notification',
        'status',
        'delivery'
    ];

    public function order()
    {
       return $this->hasMany(\App\Models\Order::class);
    }
    
    public function product()
    {
    //    return $this->hasOne(\App\Models\product::class,'product_id','id');
    return product::find($this->order->product_id)->get() ;
    }
}
