<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\DesireProduct
 *
 * @property int $id
 * @property int $user_id
 * @property int $product_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DesireProduct newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DesireProduct newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DesireProduct query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DesireProduct whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DesireProduct whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DesireProduct whereUserId($value)
 * @mixin \Eloquent
 */
class DesireProduct extends Model
{
    protected $table = 'desire_products';

    protected $fillable = [
        'user_id',
        'product_id'
    ];

    public $timestamps = true;
}
