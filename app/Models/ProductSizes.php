<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSizes extends Model
{
    use HasFactory;

    protected $table    = 'product_sizes';
    protected $fillable = [
        'id',
        'size_id',
        'products_id'
    ];

    /**
     * Get the user associated with the ProductSizes
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne(User::class, 'foreign_key', 'local_key');
    }
}
