<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ProductImage
 *
 * @property int $id
 * @property string $big
 * @property string $small
 * @property string|null $alt_uk
 * @property string|null $alt_ru
 * @property int $priority
 * @property int $product_id
 * @property-read mixed $alt
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductImage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductImage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductImage query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductImage whereAltRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductImage whereAltUk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductImage whereBig($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductImage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductImage wherePriority($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductImage whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductImage whereSmall($value)
 * @mixin \Eloquent
 */
class ProductImage extends Model
{
    protected $table = 'product_images';

    public $timestamps = false;

    protected $fillable = [
        'big',
        'small',
        'alt_uk',
        'alt_ru',
        'priority',
        'product_id'
    ];

    public function getAltAttribute()
    {
        return $this->{"alt_" . config('locale.current')};
    }

    public function getSmallAttribute($value): string
    {
        if (is_file(public_path($value))) return asset($value);
        elseif (preg_match('@^http@', $value)) return $value;
        else return asset(config('default.image.product_small'));
    }

    public function getBigAttribute($value): string
    {
        if (is_file(public_path($value))) return asset($value);
        elseif (preg_match('@^http@', $value)) return $value;
        else return asset(config('default.image.product_big'));
    }

}
