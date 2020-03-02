<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table = 'carts';

    protected $fillable = [
        'user_id',
        'session'
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'cart_products')
            ->withPivot('amount', 'attributes');
    }

    public function delete()
    {
        $this->products()->delete();

        return parent::delete();
    }
}
