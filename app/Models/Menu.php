<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Menu
 *
 * @property int $id
 * @property int|null $sort
 * @property string $type
 * @property string $name_uk
 * @property string $name_ru
 * @property string|null $url_uk
 * @property string|null $url_ru
 * @property-read mixed $name
 * @property-read mixed $url
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\MenuItem[] $items
 * @property-read int|null $items_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Menu newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Menu newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Menu query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Menu whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Menu whereNameRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Menu whereNameUk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Menu whereSort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Menu whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Menu whereUrlRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Menu whereUrlUk($value)
 * @mixin \Eloquent
 */
class Menu extends Model
{
    protected $table = 'menu';

    public $timestamps = false;

    public function items()
    {
        return $this->hasMany('App\\Models\\MenuItem');
    }

    public function getUrlAttribute()
    {
        return $this->{"url_" . config('locale.current')};
    }

    public function getNameAttribute()
    {
        return $this->{"name_" . config('locale.current')};
    }
}
