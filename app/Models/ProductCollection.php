<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
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
 * @property string|null $description_uk
 * @property string|null $description_ru
 * @property-read mixed $description
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductCollection whereDescriptionRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductCollection whereDescriptionUk($value)
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

    public static function getTableName()
    {
        return with(new static)->table;
    }

    public function items()
    {
        return $this->belongsToMany(Product::class, ProductCollectionItems::class, 'collection_id')
            ->orderBy('products.on_storage', 'desc');
    }

    public function root()
    {
        return ProductCollection::where('parent_id', 0)->get();
    }

    public function child()
    {
        return $this->hasMany(ProductCollection::class, 'parent_id', 'id');
    }

    public function parent()
    {
        return $this->hasOne(ProductCollection::class, 'id', 'parent_id');
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

    public function getDescriptionAttribute()
    {
        return $this->{"description_" . config('locale.current')};
    }

    public function getImageAttribute($value)
    {
        if (is_file(public_path($value))) return asset($value);
        elseif (preg_match('@^http@', $value)) return $value;
        else return asset('catalog/img/not-found-350x150.png');
    }

    /**
     * @param $request
     * @return Product[]|Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Query\Builder[]|\Illuminate\Support\Collection
     */
    public function getSearchedProducts($request)
    {
        $collection = ProductCollection::findOrFail($request->collection_id)
            ->items()
            ->pluck('product_id')
            ->toArray();

        $products = Product::whereNotIn('id', $collection)
            ->where(function (Builder $query) use ($request) {
                $query->where('name_uk', 'like', "%$request->field%")
                    ->orWhere('name_ru', 'like', "%$request->field%")
                    ->orWhere('article', 'like', "%$request->field%");
            })
            ->limit(20)
            ->get();

        return $products;
    }

}
