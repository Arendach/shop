<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\CartProduct
 *
 * @property int $id
 * @property int $cart_id
 * @property int $product_id
 * @property int $amount
 * @property string|null $attributes
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Product $product
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CartProduct newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CartProduct newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CartProduct query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CartProduct whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CartProduct whereAttributes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CartProduct whereCartId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CartProduct whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CartProduct whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CartProduct whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CartProduct whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class CartProduct extends Model
{
    protected $fillable = [
        'cart_id',
        'product_id',
        'amount',
        'attributes'
    ];

    public $timestamps = true;

    public function product()
    {
        return $this->belongsTo(Product::class)
            ->with('category');
    }
}
