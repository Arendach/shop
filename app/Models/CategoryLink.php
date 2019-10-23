<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\CategoryLink
 *
 * @property int $id
 * @property int $category_id
 * @property string $name_uk
 * @property string $name_ru
 * @property string $url_uk
 * @property string $url_ru
 * @property-read mixed $name
 * @property-read mixed $url
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CategoryLink newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CategoryLink newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CategoryLink query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CategoryLink whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CategoryLink whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CategoryLink whereNameRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CategoryLink whereNameUk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CategoryLink whereUrlRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CategoryLink whereUrlUk($value)
 * @mixin \Eloquent
 */
class CategoryLink extends Model
{
    protected $table = 'category_links';

    protected $fillable = ['name_uk', 'name_ru', 'url_uk', 'url_ru'];

    public $timestamps = false;

    public function getNameAttribute()
    {
        $locale = config('app.locale');
        return $this->{"name_$locale"};
    }

    public function getUrlAttribute()
    {
        $locale = config('app.locale');
        return $this->{"url_$locale"};
    }
}
