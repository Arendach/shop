<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\SimpleOrder
 *
 * @property int $id
 * @property string|null $name
 * @property string $phone
 * @property string|null $ip
 * @property string|null $user_agent
 * @property int $product_id
 * @property int $accepted
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Product $product
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SimpleOrder newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SimpleOrder newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SimpleOrder query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SimpleOrder whereAccepted($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SimpleOrder whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SimpleOrder whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SimpleOrder whereIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SimpleOrder whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SimpleOrder wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SimpleOrder whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SimpleOrder whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SimpleOrder whereUserAgent($value)
 * @mixin \Eloquent
 */
class SimpleOrder extends Model
{
    protected $fillable = [
        'name',
        'phone',
        'ip',
        'user_agent',
        'product_id',
        'accepted'
    ];

    public $timestamps = true;

    protected $dates = ['created_at', 'updated_at'];

    public function product()
    {
        return $this->belongsTo('App\\Models\\Product');
    }
}
