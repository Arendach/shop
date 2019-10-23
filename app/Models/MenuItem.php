<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\MenuItem
 *
 * @property int $id
 * @property int $menu_id
 * @property string $name_uk
 * @property string $name_ru
 * @property string $type
 * @property string|null $url_uk
 * @property string|null $url_ru
 * @property-read mixed $name
 * @property-read mixed $url
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MenuItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MenuItem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MenuItem query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MenuItem whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MenuItem whereMenuId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MenuItem whereNameRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MenuItem whereNameUk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MenuItem whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MenuItem whereUrlRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MenuItem whereUrlUk($value)
 * @mixin \Eloquent
 */
class MenuItem extends Model
{
    protected $table = 'menu_items';

    public $timestamps = false;

    public function getUrlAttribute()
    {
        return $this->{"url_" . config('locale.current')};
    }

    public function getNameAttribute()
    {
        return $this->{"name_" . config('locale.current')};
    }
}
