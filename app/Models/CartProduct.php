<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartProduct extends Model
{
    protected $fillable = [
        'cart_id',
        'product_id',
        'amount',
        'attributes',
        'created_at'
    ];

    public $timestamps = true;

    public function product()
    {
        return $this->belongsTo(Product::class)
            ->with('category');
    }
}
