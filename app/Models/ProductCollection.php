<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\ProductCollection
 *
 * @property int $id
 * @property int $parent_id
 * @property string $name_uk
 * @property string $name_ru
 * @property string $slug
 * @property string|null $meta_title_uk
 * @property string|null $meta_title_ru
 * @property string|null $meta_keywords_uk
 * @property string|null $meta_keywords_ru
 * @property string|null $meta_description_uk
 * @property string|null $meta_description_ru
 * @property string|null $image
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ProductCollection[] $child
 * @property-read int|null $child_count
 * @property-read mixed $meta_description
 * @property-read mixed $meta_keywords
 * @property-read mixed $meta_title
 * @property-read mixed $name
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ProductCollectionItems[] $items
 * @property-read int|null $items_count
 * @property-read \App\Models\ProductCollection $parent
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductCollection newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductCollection newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ProductCollection onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductCollection query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductCollection whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductCollection whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductCollection whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductCollection whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductCollection whereMetaDescriptionRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductCollection whereMetaDescriptionUk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductCollection whereMetaKeywordsRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductCollection whereMetaKeywordsUk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductCollection whereMetaTitleRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductCollection whereMetaTitleUk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductCollection whereNameRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductCollection whereNameUk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductCollection whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductCollection whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductCollection whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ProductCollection withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ProductCollection withoutTrashed()
 * @mixin \Eloquent
 */
class ProductCollection extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'parent_id',
        'name_uk',
        'name_ru',
        'slug',
        'meta_title_uk',
        'meta_title_ru',
        'meta_keywords_uk',
        'meta_keywords_ru',
        'meta_description_uk',
        'meta_description_ru',
        'image'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public $timestamps = true;

    protected $table = 'collections';

    public function items()
    {
        return $this->hasMany('App\\Models\\ProductCollectionItems', 'collection_id')
            ->with('product');
    }

    public function child()
    {
        return $this->hasMany('App\\Models\\ProductCollection', 'parent_id', 'id')
            ->with('items');
    }

    public function parent()
    {
        return $this->hasOne('App\\Models\\ProductCollection', 'id', 'parent_id');
    }

    public function getNameAttribute()
    {
        return $this->{"name_" . config('locale.current')};
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

    public function getImageAttribute($value)
    {
        if (is_file(public_path($value))) return asset($value);
        elseif (preg_match('@^http@', $value)) return $value;
        else return asset('catalog/img/not-found-350x150.png');
    }
}
