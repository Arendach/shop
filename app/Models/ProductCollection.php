<?php

namespace App\Models;

use App\Traits\Models\Translatable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductCollection extends Model
{
    use SoftDeletes;
    use Translatable;

    public $translate = [
        'name',
        'description',
        'meta_title',
        'meta_keywords',
        'meta_description',
    ];

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
        return (new static)->table;
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'collection_products', 'collection_id');
    }

    public function scopeRoot(Builder $builder): void
    {
        $builder->where('parent_id', 0);
    }

    public function child()
    {
        return $this->hasMany(ProductCollection::class, 'parent_id', 'id');
    }

    public function parent()
    {
        return $this->hasOne(ProductCollection::class, 'id', 'parent_id');
    }

    public function getImageAttribute($value)
    {
        if (is_file(public_path($value))) return asset($value);
        elseif (preg_match('@^http@', $value)) return $value;
        else return asset('catalog/img/collection-default.jpg');
    }

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
