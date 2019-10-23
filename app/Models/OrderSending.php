<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\OrderSending
 *
 * @property int $id
 * @property string $shop
 * @property int $order_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderSending newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderSending newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderSending query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderSending whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderSending whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderSending whereShop($value)
 * @mixin \Eloquent
 * @property-read mixed $city_name
 * @property-read mixed $warehouse_name
 * @property string $city_key
 * @property string $city_name_uk
 * @property string $city_name_ru
 * @property string $warehouse_key
 * @property string $warehouse_name_uk
 * @property string $warehouse_name_ru
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderSending whereCityKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderSending whereCityNameRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderSending whereCityNameUk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderSending whereWarehouseKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderSending whereWarehouseNameRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderSending whereWarehouseNameUk($value)
 */
class OrderSending extends Model
{
    protected $table = 'order_sending';

    protected $fillable = [
        'city_key',
        'city_name_uk',
        'city_name_ru',
        'warehouse_key',
        'warehouse_name_uk',
        'warehouse_name_ru',
        'order_id'
    ];

    public $timestamps = false;

    public function getCityNameAttribute()
    {
        return $this->{"city_name_" . config('locale.current')};
    }
    public function getWarehouseNameAttribute()
    {
        return $this->{"warehouse_name_" . config('locale.current')};
    }
}
