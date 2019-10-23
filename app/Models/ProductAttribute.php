<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ProductAttribute
 *
 * @property int $id
 * @property int $product_id
 * @property int $attribute_id
 * @property string $variants
 * @property-read \App\Models\Attribute $attribute
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductAttribute newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductAttribute newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductAttribute query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductAttribute whereAttributeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductAttribute whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductAttribute whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductAttribute whereVariants($value)
 * @mixin \Eloquent
 */
class ProductAttribute extends Model
{
    public $timestamps = false;

    protected $table = 'product_attributes';

    protected $fillable = ['product_id', 'attribute_id', 'variants'];

    public function getVariantsAttribute($variants)
    {
        /**
         * [
         *     [value_uk => 1, value_ru => 1],
         *     [value_uk => test, value_ru => test],
         * ]
         */
        $variants = json_decode($variants);

        $result = [];
        foreach ($variants as $variant) {
            $result[] = $variant->{"value_" . config('app.locale')};
        }

        /**
         * [1, test]
         */
        return $result;
    }

    public function attribute()
    {
        return $this->belongsTo('App\Models\Attribute', 'attribute_id', 'id');
    }
}
