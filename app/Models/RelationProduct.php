<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\RelationProduct
 *
 * @property int $id
 * @property int $product_id
 * @property int $related_id
 * @property-read \App\Models\Product $product
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RelationProduct newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RelationProduct newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RelationProduct query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RelationProduct whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RelationProduct whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RelationProduct whereRelatedId($value)
 * @mixin \Eloquent
 */
class RelationProduct extends Model
{
    protected $fillable = [
        'product_id',
        'related_id'
    ];

    public $timestamps = false;

    public function product()
    {
        return $this->belongsTo('App\\Models\\Product', 'related_id');
    }
}
