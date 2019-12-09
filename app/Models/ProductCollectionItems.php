<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ProductCollectionItems
 *
 * @property int $id
 * @property int $collection_id
 * @property int $product_id
 * @property string|null $deleted_at
 * @property-read \App\Models\Product $product
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductCollectionItems newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductCollectionItems newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ProductCollectionItems onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductCollectionItems query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductCollectionItems whereCollectionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductCollectionItems whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductCollectionItems whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductCollectionItems whereProductId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ProductCollectionItems withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ProductCollectionItems withoutTrashed()
 * @mixin \Eloquent
 */
class ProductCollectionItems extends Model
{
    protected $fillable = [
        'product_id',
        'collection_id'
    ];

    public $timestamps = false;

    protected $table = 'collection_products';

    /*public function product()
    {
        return $this->belongsTo('App\\Models\\Product')->with('characteristics');
    }*/
}
