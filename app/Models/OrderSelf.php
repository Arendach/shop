<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Delivery;

/**
 * App\Models\OrderSelf
 *
 * @property int $id
 * @property string $shop
 * @property int $order_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderSelf newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderSelf newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderSelf query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderSelf whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderSelf whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderSelf whereShop($value)
 * @mixin \Eloquent
 * @property-read mixed $address
 * @property-read mixed $name
 */
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
