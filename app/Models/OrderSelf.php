<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Delivery;

class OrderSelf extends Model
{
    protected $table = 'order_self';

    protected $fillable = [
        'shop',
        'order_id'
    ];

    public $timestamps = false;

    public function getNameAttribute(): string
    {
        return Delivery::getSelfShopName($this->shop);
    }

    public function getAddressAttribute(): string
    {
        return Delivery::getSelfShopAddress($this->shop);
    }
}
