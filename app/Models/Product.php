<?php

namespace App\Models;

use App\Abstraction\Models\SeoMultiLangInterface;
use App\Abstraction\Models\TwoImageInterface;
use App\Casts\ProductDescriptionCast;
use App\Casts\ProductName;
use App\Casts\ProductTranslatableTemplateCast;
use App\Traits\Models\SeoMultiLang;
use App\Traits\Models\Translatable;
use App\Traits\Models\TwoImage;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class Product extends Model implements TwoImageInterface, SeoMultiLangInterface
{
    use SeoMultiLang;
    use TwoImage;

    public $fillable = [
        'article',
        'category_id',
        'price',
        'on_storage',
        'name_uk',
        'description_uk',
        'name_ru',
        'description_ru',
        'is_new',
        'is_recommended',
        'discount',
        'small',
        'big',
        'product_key',
        'meta_title_uk',
        'meta_keywords_uk',
        'meta_description_uk',
        'meta_title_ru',
        'meta_keywords_ru',
        'meta_description_ru',
        'manufacturer_id',
        'slug',
        'old_url',
        'video',
        'model_uk',
        'model_ru',
        'volume',
        'packing'
    ];

    protected $guarded = [];

    protected $dates = ['created_at', 'updated_at'];

    public $timestamps = true;

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


    public function getSearchProducts(string $value): LengthAwarePaginator
    {
        return Product::where('name_uk', 'like', "%$value%")
            ->orWhere('name_ru', 'like', "%$value%")
            ->orWhere('article', 'like', "%$value%")
            ->orderBy('on_storage', 'desc')
            ->paginate(config('app.items'));
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
}
