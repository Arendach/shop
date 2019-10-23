<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Category
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property string $name_uk
 * @property string|null $description_uk
 * @property string|null $meta_title_uk
 * @property string|null $meta_description_uk
 * @property string|null $meta_keywords_uk
 * @property string $name_ru
 * @property string|null $description_ru
 * @property string|null $meta_title_ru
 * @property string|null $meta_description_ru
 * @property string|null $meta_keywords_ru
 * @property int $parent_id
 * @property string|null $small
 * @property string|null $big
 * @property string $slug
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Category[] $child
 * @property-read int|null $child_count
 * @property-read mixed $big_image
 * @property-read mixed $description
 * @property-read mixed $meta_description
 * @property-read mixed $meta_keywords
 * @property-read mixed $meta_title
 * @property-read mixed $name
 * @property-read mixed $small_image
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\CategoryLink[] $links
 * @property-read int|null $links_count
 * @property-read \App\Models\Category $parent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Product[] $products
 * @property-read int|null $products_count
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Category onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereBig($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereDescriptionRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereDescriptionUk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereMetaDescriptionRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereMetaDescriptionUk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereMetaKeywordsRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereMetaKeywordsUk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereMetaTitleRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereMetaTitleUk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereNameRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereNameUk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereSmall($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Category withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Category withoutTrashed()
 * @mixin \Eloquent
 */
class Category extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name_uk',
        'name_ru',
        'description_uk',
        'description_ru',
        'meta_title_uk',
        'meta_title_ru',
        'meta_description_uk',
        'meta_description_ru',
        'meta_keywords_uk',
        'meta_keywords_ru',
        'parent_id',
        'small',
        'big',
        'slug',
        'created_at',
        'updated_at'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public $timestamps = true;

    protected $table = 'categories';

    public function products()
    {
        return $this->belongsToMany('App\Models\Product');
    }

    public function child()
    {
        return $this->hasMany('App\Models\Category', 'parent_id', 'id')
            ->with('links');
    }

    public function parent()
    {
        return $this->hasOne('App\Models\Category', 'id', 'parent_id');
    }

    public function getNameAttribute()
    {
        return $this->{"name_" . config('locale.current')};
    }

    public function getDescriptionAttribute()
    {
        return $this->{"description_" . config('locale.current')};
    }

    public function getMetaTitleAttribute()
    {
        return $this->{"meta_title_" . config('locale.current')};
    }

    public function getMetaDescriptionAttribute()
    {
        return $this->{"meta_description_" . config('locale.current')};
    }

    public function getMetaKeywordsAttribute()
    {
        return $this->{"meta_keywords_" . config('locale.current')};
    }

    public function getSmallImageAttribute()
    {
        if (is_file(public_path($this->small))) return asset($this->small);
        elseif (preg_match('@^http@', $this->small)) return $this->small;
        else return asset(config('default.image.category_small'));
    }

    public function getBigImageAttribute()
    {
        if (is_file(public_path($this->big))) return asset($this->big);
        elseif (preg_match('@^http@', $this->big)) return $this->big;
        else return asset(config('default.image.category_big'));
    }

    public function links()
    {
        return $this->hasMany('App\Models\CategoryLink', 'category_id', 'id')
            ->orderBy('id', 'desc');
    }

    public function delete()
    {
        $this->links()->delete();
        $this->child()->delete();

        return parent::delete();
    }
}
