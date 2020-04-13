<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDelivery extends Model
{
    protected $table = 'order_delivery';

    protected $fillable = [
        'city',
        'street',
        'address',
        'order_id'
    ];

    public $timestamps = false;
}
