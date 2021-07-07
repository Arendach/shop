<?php

namespace App\Models;


use App\Abstraction\Models\SearchableInterface;
use App\Scopes\SortableScope;
use App\Traits\Models\Image;
use App\Traits\Searchable;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Abstraction\Models\TwoImageInterface;
use App\Casts\ProductTranslatableTemplateCast;
use App\Traits\Models\Editable;
use App\Traits\Models\TwoImage;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Pagination\LengthAwarePaginator;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

class Product extends Model implements Sortable, TwoImageInterface, SearchableInterface
{
    use TwoImage;
    use Editable;
    use SoftDeletes;
    use SortableTrait;
    use Image;
    use Searchable;

    protected $table = 'products';

    protected $guarded = [];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $casts = [
        'description'      => ProductTranslatableTemplateCast::class,
        'name'             => ProductTranslatableTemplateCast::class,
        'meta_title'       => ProductTranslatableTemplateCast::class,
        'meta_description' => ProductTranslatableTemplateCast::class,
        'meta_keywords'    => ProductTranslatableTemplateCast::class
    ];

    public $translate = [
        'description',
        'name',
        'meta_title',
        'meta_description',
        'meta_keywords',
    ];

    public $sortable = [
        'order_column_name'  => 'order',
        'sort_when_creating' => true,
    ];
    public $timestamps = true;

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new SortableScope());
    }

    public function category()
    {
        return $this->belongsTo(Category::class)->withDefault([
            'name_uk' => translate('Без категорії'),
            'name_ru' => translate('Без категорії'),
            'slug'    => 'default'
        ]);
    }

    public function characteristics()
    {
        return $this->hasMany('App\Models\ProductCharacteristic')
            ->with('characteristic');
    }

    public function manufacturer()
    {
        return $this->belongsTo(Manufacturer::class);
    }

    public function images()
    {
        return $this->hasMany('App\Models\ProductImage');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class)->with('customer');
    }

    public function related()
    {
        return $this->belongsToMany(Product::class, 'relation_products', 'product_id', 'related_id');
    }

    public function attributes()
    {
        return $this->hasMany(ProductAttribute::class);
    }

    public function tags(): HasMany
    {
        return $this->hasMany(ProductTag::class);
    }

    public function getNewPriceAttribute()
    {
        if (is_null($this->discount)) return $this->price;

        return $this->discounted_price;
    }

    public function getOldPriceAttribute()
    {
        return $this->price;
    }

    public function getDiscountedPriceAttribute(): float
    {
        if (preg_match('~%~', $this->discount)) {
            $percent = (int)$this->discount;
            return $this->price - ($this->price / 100 * $percent);
        } elseif (is_numeric($this->discount)) {
            return $this->price - $this->discount;
        } else {
            return $this->price;
        }
    }

    public function getDiscountPercentAttribute(): int
    {
        return preg_match('~%~', $this->discount) ? (int)$this->discount : (int)($this->discount / $this->price * 100);
    }

    public function getIsDiscountedAttribute()
    {
        return !is_null($this->discount);
    }

    public function getStarsAttribute()
    {
        $rating = $this->rating;

        $result = '';
        for ($i = 1; $i <= 5; $i++) {
            if ($i <= $rating) {
                $result .= '<i class="icon-star voted"></i>';
            } else {
                $result .= '<i class="icon-star"></i>';
            }
        }

        return $result;
    }

    public function getAvailableAttribute()
    {
        if ($this->on_storage)
            return '<span class="text-success"><i class="fa fa-check"></i> ' . __('products.available_true') . '</span>';
        else
            return '<span class="text-danger"><i class="fa fa-remove"></i> ' . __('products.available_false') . '</span>';
    }

    public function getUrlAttribute(): string
    {
        return route('product.view', $this->slug);
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function toSearchArray(): array
    {
        return [
            'id'                  => $this->id,
            'name_uk'             => $this->name_uk,
            'name_ru'             => $this->name_ru,
            'description_uk'      => $this->description_uk,
            'description_ru'      => $this->description_ru,
            'meta_title_uk'       => $this->meta_title_uk,
            'meta_title_ru'       => $this->meta_title_ru,
            'meta_keywords_uk'    => $this->meta_keywords_uk,
            'meta_keywords_ru'    => $this->meta_keywords_ru,
            'meta_description_uk' => $this->meta_description_uk,
            'meta_description_ru' => $this->meta_description_ru,
            'url'                 => $this->getUrl()
        ];
    }


    public function getSearchProducts(string $value): LengthAwarePaginator
    {
        return Product::where('name_uk', 'like', "%$value%")
            ->orWhere('name_ru', 'like', "%$value%")
            ->orWhere('article', 'like', "%$value%")
            ->orderBy('on_storage', 'desc')
            ->paginate(setting('Кількість товарів в категоріях', '11'));
//            ->paginate(config('app.items'));
    }


    public function scopeOnStorage(Builder $builder, bool $onStorage = true)
    {
        $builder->where('on_storage', $onStorage);
    }

    public function scopeHome(Builder $builder, bool $isHome = true): void
    {
        $builder->where('is_home', $isHome);
    }

    public function scopeRecommended(Builder $builder, bool $isRecommended = true): void
    {
        $builder->where('is_recommended', $isRecommended);
    }

    public function scopeIsActive(Builder $builder, bool $active = true)
    {
        $this->active = $active;
        $builder->whereHas('category', function (Builder $query) {
            $query->where('is_active', $this->active);
        });
    }
}
