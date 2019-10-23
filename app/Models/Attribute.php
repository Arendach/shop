<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Attribute
 *
 * @property int $id
 * @property string|null $name_uk
 * @property string|null $name_ru
 * @property-read mixed $name
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ProductAttribute[] $product_attributes
 * @property-read int|null $product_attributes_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Attribute newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Attribute newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Attribute query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Attribute whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Attribute whereNameRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Attribute whereNameUk($value)
 * @mixin \Eloquent
 */
class Attribute extends Model
{
    protected $fillable = ['id', 'name_uk', 'name_ru'];

    public $timestamps = false;

    public function getNameAttribute()
    {
        return $this->{"name_" . config('app.locale')};
    }

    public function product_attributes(){
        return $this->hasMany('App\Models\ProductAttribute', 'attribute_id', 'id');
    }
}
