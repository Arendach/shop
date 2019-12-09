<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Page
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property string $uri_name
 * @property string $name_uk
 * @property string $content_uk
 * @property string $meta_title_uk
 * @property string $meta_keywords_uk
 * @property string $meta_description_uk
 * @property string $name_ru
 * @property string $content_ru
 * @property string $meta_title_ru
 * @property string $meta_keywords_ru
 * @property string $meta_description_ru
 * @property-read mixed $content
 * @property-read mixed $meta_description
 * @property-read mixed $meta_keywords
 * @property-read mixed $meta_title
 * @property-read mixed $name
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Page newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Page newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Page onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Page query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Page whereContentRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Page whereContentUk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Page whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Page whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Page whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Page whereMetaDescriptionRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Page whereMetaDescriptionUk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Page whereMetaKeywordsRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Page whereMetaKeywordsUk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Page whereMetaTitleRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Page whereMetaTitleUk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Page whereNameRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Page whereNameUk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Page whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Page whereUriName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Page withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Page withoutTrashed()
 * @mixin \Eloquent
 * @property int $static
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Page whereStatic($value)
 */
class Page extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at', 'created_at', 'updated_at'];

    public $timestamps = true;

    protected $fillable = [
        'uri_name',
        'name_uk',
        'name_ru',
        'content_uk',
        'content_ru',
        'meta_title_uk',
        'meta_title_ru',
        'meta_keywords_uk',
        'meta_keywords_ru',
        'meta_description_uk',
        'meta_description_ru',
    ];

    public function getNameAttribute()
    {
        return $this->{"name_" . config('locale.current')};
    }

    public function getContentAttribute()
    {
        return $this->{"content_" . config('locale.current')};
    }

    public function getMetaTitleAttribute()
    {
        return $this->{"meta_title_" . config('locale.current')};
    }

    public function getMetaKeywordsAttribute()
    {
        return $this->{"meta_keywords_" . config('locale.current')};
    }

    public function getMetaDescriptionAttribute()
    {
        return $this->{"meta_description_" . config('locale.current')};
    }
}
