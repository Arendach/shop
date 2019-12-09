<?php

namespace App\Models;

use App\Abstraction\Models\SeoMultiLangInterface;
use App\Abstraction\Models\TwoImageInterface;
use App\Traits\Models\SeoMultiLang;
use App\Traits\Models\TwoImage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * App\Models\Product
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $article
 * @property float $price
 * @property int $on_storage
 * @property string|null $name_uk
 * @property string|null $description_uk
 * @property string|null $name_ru
 * @property string|null $description_ru
 * @property int $category_id
 * @property int $is_new
 * @property int $is_recommended
 * @property float|null $discount
 * @property string|null $small
 * @property string|null $big
 * @property string $product_key
 * @property string|null $meta_title_uk
 * @property string|null $meta_keywords_uk
 * @property string|null $meta_description_uk
 * @property string|null $meta_title_ru
 * @property string|null $meta_keywords_ru
 * @property string|null $meta_description_ru
 * @property int|null $manufacturer_id
 * @property string $slug
 * @property float $rating
 * @property-read \App\Models\Category $category
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ProductCharacteristic[] $characteristics
 * @property-read int|null $characteristics_count
 * @property-read mixed $available
 * @property-read mixed $big_image
 * @property-read mixed $description
 * @property-read mixed $meta_description
 * @property-read mixed $meta_keywords
 * @property-read mixed $meta_title
 * @property-read mixed $name
 * @property-read mixed $small_image
 * @property-read mixed $stars
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ProductImage[] $images
 * @property-read int|null $images_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\RelationProduct[] $relation
 * @property-read int|null $relation_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Review[] $reviews
 * @property-read int|null $reviews_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereArticle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereBig($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereDescriptionRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereDescriptionUk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereDiscount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereIsNew($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereIsRecommended($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereManufacturerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereMetaDescriptionRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereMetaDescriptionUk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereMetaKeywordsRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereMetaKeywordsUk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereMetaTitleRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereMetaTitleUk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereNameRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereNameUk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereOnStorage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereProductKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereRating($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereSmall($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property float|null $weight
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereWeight($value)
 * @property-read float $now_price
 * @property-read \App\Models\Manufacturer|null $manufacturer
 */
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
        'slug'
    ];

    protected $dates = ['created_at', 'updated_at'];

    public $timestamps = true;

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
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

    public function getNameAttribute()
    {
        $name = $this->{"name_" . config('locale.current')};
        return !is_null($name) ? $name : $this->{"name_" . config('locale.default')};
    }

    public function getDescriptionAttribute()
    {
        return $this->{"description_" . config('app.locale')};
    }

    /**
     * Форматована звичайна ціна
     *
     * @param $value
     * @return string
     */
    public function getPriceAttribute($value): string
    {
        return number_format(round($value));
    }

    /**
     * Форматована знижена ціна
     *
     * @param $value
     * @return string|null
     */
    public function getDiscountAttribute($value)
    {
        if (is_null($value)) return '';

        return number_format(round($value));
    }

    /**
     * Актуальна ціна да даний час
     *
     * @return float
     */
    public function getNowPriceAttribute(): float
    {
        if (is_null($this->getOriginal('discount'))) return (float)$this->getOriginal('price');
        else return (float)$this->getOriginal('discount');
    }

    public function images()
    {
        return $this->hasMany('App\Models\ProductImage');
    }

    public function reviews()
    {
        return $this->hasMany('App\\Models\\Review')
            ->orderByDesc('id')
            ->with('comments')
            ->with('thumb')
            ->with('user');
    }

    public function relation()
    {
        return $this->hasMany('App\\Models\\RelationProduct')
            ->limit(4)
            ->with('product');
    }

    public function getStarsAttribute()
    {
        $rating = $this->rating;

        $title = !$rating ? __('products.no_rating') : "$rating/5 (" . __('products.user_quality') . ")";

        $result = "<span data-toggle='tooltip' title='$title'>";
        for ($i = 1; $i <= 5; $i++) {
            $result .= '<span>';
            if ($i <= round($rating)) {
                $result .= '<img src="' . asset(config('default.image.star_active')) . '">';
            } else {
                $result .= '<img src="' . asset(config('default.image.star_no_active')) . '">';
            }
            $result .= '</span>';
        }
        $result .= '</span>';

        return $result;
    }

    public function getAvailableAttribute()
    {
        if ($this->on_storage)
            return '<span class="text-success"><i class="fa fa-check"></i> ' . __('products.available_true') . '</span>';
        else
            return '<span class="text-danger"><i class="fa fa-remove"></i> ' . __('products.available_false') . '</span>';
    }

    /**
     * @param string $value
     * @return LengthAwarePaginator
     */
    public function getSearchProducts(string $value): LengthAwarePaginator
    {
        return Product::where('name_uk', 'like', "%$value%")
            ->orWhere('name_ru', 'like', "%$value%")
            ->orWhere('article', 'like', "%$value%")
            ->orderBy('on_storage', 'desc')
            ->paginate(config('app.items'));
    }
}
