<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\OrderProducts
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderProduct newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderProduct newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderProduct query()
 * @mixin \Eloquent
 * @property int $id
 * @property int $order_id
 * @property int $product_id
 * @property int $amount
 * @property float|null $discount
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderProduct whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderProduct whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderProduct whereDiscount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderProduct whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderProduct whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderProduct whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderProduct whereUpdatedAt($value)
 * @property-read \App\Models\Product $product
 * @property float $price
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderProduct wherePrice($value)
 * @property int $storage
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderProduct whereStorage($value)
 */
class OrderProduct extends Model
{
    protected $table = 'order_products';

    protected $fillable = [
        'order_id',
        'product_id',
        'amount',
        'discount'
    ];

    public $timestamps = true;

    protected $dates = ['created_at', 'updated_at'];

}
