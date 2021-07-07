<?php

namespace App\Models;

use App\Abstraction\Models\TwoImageInterface;
use App\Casts\PageAttributeCasts;
use App\Scopes\SortableScope;
use App\Traits\Models\Image;
use App\Traits\Models\Translatable;
use App\Traits\Models\TwoImage;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Filters\CategoryProductFilter;
use Illuminate\Http\Request;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

class Category extends Model implements Sortable, TwoImageInterface
{
    use SoftDeletes;
    use SortableTrait;
    use TwoImage;
    use Translatable;
    use Image;

    protected $casts = [
        'description_uk' => PageAttributeCasts::class,
        'description_ru' => PageAttributeCasts::class
    ];

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
        'updated_at',
        'is_active',
        'order',
        'name_template'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public $translate = [
        'name',
        'description',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'name_template',
        'description_template',
        'meta_title_template',
        'meta_description_template',
        'meta_keywords_template',
    ];

    public $sortable = [
        'order_column_name'  => 'order',
        'sort_when_creating' => true,
    ];

    public $timestamps = true;

    protected $table = 'categories';

    public function products(): HasMany
    {
        return $this->hasMany('App\Models\Product');
    }
    public function questions(): BelongsToMany
    {
        return $this->belongsToMany(Question::class,'question_category','category_id', 'question_id');
    }

    public function child()
    {
        return $this->hasMany('App\Models\Category', 'parent_id', 'id')
            ->where('is_active', '=',1)
            ->withCount('products');
    }

    public function parent()
    {
        return $this->hasOne('App\Models\Category', 'id', 'parent_id');
    }

    public function getUrlAttribute(): string
    {
        return route('category.show', $this->slug);
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

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new SortableScope());
    }

    public function isActive(): bool
    {
        return $this->is_active;
    }

    public function scopeIsActiveScope(Builder $query)
    {
        $query->where('is_active', 1);
    }

    public function filterProducts(int $category_id, Request $request)
    {
        $items = in_array($request->get('items', null), [20, 50, 70, 100])
            ? $request->items
            : setting('Кількість товарів в категоріях','11');
//            : config('app.items');

        $products = Product::where('category_id', $category_id)
            ->with('characteristics')
            ->with('characteristics.characteristic')
            ->withCount(['reviews' => function (Builder $builder) {
                $builder->where('is_checked', 1);
            }])
            ->orderBy('on_storage', 'desc');

        if (!$request->has('order'))
            $products->orderBy('order', 'asc');

        $products = (new CategoryProductFilter($products, $request))
            ->apply()
            ->paginate($items);

        $products->appends($request->all());

        return $products;
    }
}
