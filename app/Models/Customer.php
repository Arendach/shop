<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customers';

    protected $fillable = [
        'phone',
        'email',
        'password',
        'first_name',
        'last_name',
        'locale'
    ];

    public function desire_products()
    {
        return $this->belongsToMany(Product::class, 'desire_products');
    }

    public function getNameAttribute(): string
    {
        return "$this->first_name $this->last_name";
    }

    public function hasDesire(int $product_id): bool
    {
        return $this->desire_products->where('id', $product_id)->count();
    }
}
