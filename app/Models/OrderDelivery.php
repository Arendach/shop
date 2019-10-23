<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\OrderDelivery
 *
 * @property int $id
 * @property string $city
 * @property string $street
 * @property string $address
 * @property int $order_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderDelivery newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderDelivery newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderDelivery query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderDelivery whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderDelivery whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderDelivery whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderDelivery whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderDelivery whereStreet($value)
 * @mixin \Eloquent
 */
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
