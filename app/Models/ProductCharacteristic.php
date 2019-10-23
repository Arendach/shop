<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ProductCharacteristic
 *
 * @property int $id
 * @property int $characteristic_id
 * @property int $product_id
 * @property string $value_uk
 * @property string $value_ru
 * @property-read \App\Models\Characteristic $characteristic
 * @property-read mixed $value
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductCharacteristic newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductCharacteristic newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductCharacteristic query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductCharacteristic whereCharacteristicId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductCharacteristic whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductCharacteristic whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductCharacteristic whereValueRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductCharacteristic whereValueUk($value)
 * @mixin \Eloquent
 */
class ProductCharacteristic extends Model
{
    protected $table = 'product_characteristics';

    protected $fillable = [
        'product_id',
        'characteristic_id',
        'value_uk',
        'value_ru'
    ];

    public $timestamps = false;

    public function getValueAttribute()
    {
        return $this->{"value_" . config('app.locale')};
    }

    public function characteristic()
    {
        return $this->belongsTo('App\Models\Characteristic');
    }
}
