<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\Attribute
 *
 * @property int $id
 * @property string|null $name_uk
 * @property string|null $name_ru
 * @property-read mixed $name
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ProductAttribute[] $product_attributes
 * @property-read int|null $product_attributes_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Attribute newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Attribute newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Attribute query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Attribute whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Attribute whereNameRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Attribute whereNameUk($value)
 * @mixin \Eloquent
 */
	class Attribute extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\BannerImage
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $path
 * @property string|null $title_uk
 * @property string|null $description_uk
 * @property string|null $alt_uk
 * @property string|null $title_ru
 * @property string|null $description_ru
 * @property string|null $alt_ru
 * @property string|null $url_uk
 * @property string|null $url_ru
 * @property string|null $color
 * @property-read mixed $alt
 * @property-read mixed $description
 * @property-read mixed $image
 * @property-read mixed $title
 * @property-read mixed $url
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BannerImage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BannerImage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BannerImage query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BannerImage whereAltRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BannerImage whereAltUk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BannerImage whereColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BannerImage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BannerImage whereDescriptionRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BannerImage whereDescriptionUk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BannerImage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BannerImage wherePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BannerImage whereTitleRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BannerImage whereTitleUk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BannerImage whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BannerImage whereUrlRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BannerImage whereUrlUk($value)
 * @mixin \Eloquent
 */
	class BannerImage extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Cart
 *
 * @property int $id
 * @property int|null $user_id
 * @property string|null $session
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\CartProduct[] $products
 * @property-read int|null $products_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cart newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cart newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cart query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cart whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cart whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cart whereSession($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cart whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Cart whereUserId($value)
 * @mixin \Eloquent
 */
	class Cart extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\CartProduct
 *
 * @property int $id
 * @property int $cart_id
 * @property int $product_id
 * @property int $amount
 * @property string|null $attributes
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Product $product
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CartProduct newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CartProduct newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CartProduct query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CartProduct whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CartProduct whereAttributes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CartProduct whereCartId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CartProduct whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CartProduct whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CartProduct whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CartProduct whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class CartProduct extends \Eloquent {}
}

namespace App\Models{
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
	class Category extends \Eloquent {}
}

namespace App\Models{
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
	class CategoryLink extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Characteristic
 *
 * @property int $id
 * @property string $name_uk
 * @property string|null $prefix_uk
 * @property string|null $postfix_uk
 * @property string $name_ru
 * @property string|null $prefix_ru
 * @property string|null $postfix_ru
 * @property string $type
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read mixed $name
 * @property-read mixed $postfix
 * @property-read mixed $prefix
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Characteristic newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Characteristic newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Characteristic onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Characteristic query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Characteristic whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Characteristic whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Characteristic whereNameRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Characteristic whereNameUk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Characteristic wherePostfixRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Characteristic wherePostfixUk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Characteristic wherePrefixRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Characteristic wherePrefixUk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Characteristic whereType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Characteristic withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Characteristic withoutTrashed()
 * @mixin \Eloquent
 */
	class Characteristic extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\DesireProduct
 *
 * @property int $id
 * @property int $user_id
 * @property int $product_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DesireProduct newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DesireProduct newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DesireProduct query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DesireProduct whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DesireProduct whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\DesireProduct whereUserId($value)
 * @mixin \Eloquent
 */
	class DesireProduct extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Discount
 *
 * @property int $id
 * @property string|null $start
 * @property string|null $finish
 * @property string|null $name_uk
 * @property string|null $name_ru
 * @property string|null $image_min_uk
 * @property string|null $image_second_uk
 * @property string|null $image_max_uk
 * @property string|null $image_min_ru
 * @property string|null $image_second_ru
 * @property string|null $image_max_ru
 * @property string|null $page
 * @property string $published
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property-read mixed $finish_f
 * @property-read mixed $image_max
 * @property-read mixed $image_min
 * @property-read mixed $image_second
 * @property-read mixed $name
 * @property-read mixed $start_f
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Discount newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Discount newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Discount onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Discount query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Discount whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Discount whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Discount whereFinish($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Discount whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Discount whereImageMaxRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Discount whereImageMaxUk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Discount whereImageMinRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Discount whereImageMinUk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Discount whereImageSecondRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Discount whereImageSecondUk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Discount whereNameRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Discount whereNameUk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Discount wherePage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Discount wherePublished($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Discount whereStart($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Discount whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Discount withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Discount withoutTrashed()
 * @mixin \Eloquent
 */
	class Discount extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Manufacturer
 *
 * @property int $id
 * @property string $name_uk
 * @property string $name_ru
 * @property string $photo_uk
 * @property string $photo_ru
 * @property-read mixed $name
 * @property-read mixed $photo
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Manufacturer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Manufacturer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Manufacturer query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Manufacturer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Manufacturer whereNameRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Manufacturer whereNameUk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Manufacturer wherePhotoRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Manufacturer wherePhotoUk($value)
 * @mixin \Eloquent
 */
	class Manufacturer extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Menu
 *
 * @property int $id
 * @property int|null $sort
 * @property string $type
 * @property string $name_uk
 * @property string $name_ru
 * @property string|null $url_uk
 * @property string|null $url_ru
 * @property-read mixed $name
 * @property-read mixed $url
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\MenuItem[] $items
 * @property-read int|null $items_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Menu newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Menu newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Menu query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Menu whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Menu whereNameRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Menu whereNameUk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Menu whereSort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Menu whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Menu whereUrlRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Menu whereUrlUk($value)
 * @mixin \Eloquent
 */
	class Menu extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\MenuItem
 *
 * @property int $id
 * @property int $menu_id
 * @property string $name_uk
 * @property string $name_ru
 * @property string $type
 * @property string|null $url_uk
 * @property string|null $url_ru
 * @property-read mixed $name
 * @property-read mixed $url
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MenuItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MenuItem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MenuItem query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MenuItem whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MenuItem whereMenuId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MenuItem whereNameRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MenuItem whereNameUk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MenuItem whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MenuItem whereUrlRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MenuItem whereUrlUk($value)
 * @mixin \Eloquent
 */
	class MenuItem extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Order
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $phone
 * @property string|null $email
 * @property \App\Models\OrderDelivery $delivery
 * @property string|null $comment
 * @property string|null $pay_method
 * @property int|null $user_id
 * @property string|null $status
 * @property string|null $date_delivery
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $base_id
 * @property-read \App\Models\OrderSelf $self
 * @property-read \App\Models\OrderSending $sending
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereBaseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereDateDelivery($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereDelivery($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order wherePayMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereUserId($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\OrderProduct[] $products
 * @property-read int|null $products_count
 * @property-read mixed $sum
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order desc()
 * @property int|null $admin
 * @property float $delivery_costs
 * @property float $discount
 * @property-read \App\Models\OrderDelivery $_delivery
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereAdmin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereDeliveryCosts($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereDiscount($value)
 */
	class Order extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\OrderDelivery
 *
 * @property int $id
 * @property string $city
 * @property string $street
 * @property string $address
 * @property int $order_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderDelivery newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderDelivery newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderDelivery query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderDelivery whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderDelivery whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderDelivery whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderDelivery whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderDelivery whereStreet($value)
 * @mixin \Eloquent
 */
	class OrderDelivery extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\OrderProducts
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderProduct newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderProduct newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderProduct query()
 * @mixin \Eloquent
 * @property int $id
 * @property int $order_id
 * @property int $product_id
 * @property int $amount
 * @property float|null $discount
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderProduct whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderProduct whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderProduct whereDiscount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderProduct whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderProduct whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderProduct whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderProduct whereUpdatedAt($value)
 * @property-read \App\Models\Product $product
 * @property float $price
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderProduct wherePrice($value)
 * @property int $storage
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderProduct whereStorage($value)
 */
	class OrderProduct extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\OrderSelf
 *
 * @property int $id
 * @property string $shop
 * @property int $order_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderSelf newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderSelf newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderSelf query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderSelf whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderSelf whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderSelf whereShop($value)
 * @mixin \Eloquent
 * @property-read mixed $address
 * @property-read mixed $name
 */
	class OrderSelf extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\OrderSending
 *
 * @property int $id
 * @property string $shop
 * @property int $order_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderSending newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderSending newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderSending query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderSending whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderSending whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderSending whereShop($value)
 * @mixin \Eloquent
 * @property-read mixed $city_name
 * @property-read mixed $warehouse_name
 * @property string $city_key
 * @property string $city_name_uk
 * @property string $city_name_ru
 * @property string $warehouse_key
 * @property string $warehouse_name_uk
 * @property string $warehouse_name_ru
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderSending whereCityKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderSending whereCityNameRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderSending whereCityNameUk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderSending whereWarehouseKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderSending whereWarehouseNameRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\OrderSending whereWarehouseNameUk($value)
 */
	class OrderSending extends \Eloquent {}
}

namespace App\Models{
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
	class Page extends \Eloquent {}
}

namespace App\Models{
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
	class Product extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ProductAttribute
 *
 * @property int $id
 * @property int $product_id
 * @property int $attribute_id
 * @property string $variants
 * @property-read \App\Models\Attribute $attribute
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductAttribute newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductAttribute newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductAttribute query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductAttribute whereAttributeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductAttribute whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductAttribute whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductAttribute whereVariants($value)
 * @mixin \Eloquent
 */
	class ProductAttribute extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ProductCharacteristic
 *
 * @property int $id
 * @property int $characteristic_id
 * @property int $product_id
 * @property string $value_uk
 * @property string $value_ru
 * @property-read \App\Models\Characteristic $characteristic
 * @property-read mixed $value
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductCharacteristic newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductCharacteristic newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductCharacteristic query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductCharacteristic whereCharacteristicId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductCharacteristic whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductCharacteristic whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductCharacteristic whereValueRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductCharacteristic whereValueUk($value)
 * @mixin \Eloquent
 */
	class ProductCharacteristic extends \Eloquent {}
}

namespace App\Models{
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
	class ProductCollection extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ProductCollectionItems
 *
 * @property int $id
 * @property int $collection_id
 * @property int $product_id
 * @property string|null $deleted_at
 * @property-read \App\Models\Product $product
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductCollectionItems newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductCollectionItems newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ProductCollectionItems onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductCollectionItems query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductCollectionItems whereCollectionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductCollectionItems whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductCollectionItems whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductCollectionItems whereProductId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ProductCollectionItems withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ProductCollectionItems withoutTrashed()
 * @mixin \Eloquent
 */
	class ProductCollectionItems extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ProductImage
 *
 * @property int $id
 * @property string $big
 * @property string $small
 * @property string|null $alt_uk
 * @property string|null $alt_ru
 * @property int $priority
 * @property int $product_id
 * @property-read mixed $alt
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductImage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductImage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductImage query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductImage whereAltRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductImage whereAltUk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductImage whereBig($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductImage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductImage wherePriority($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductImage whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ProductImage whereSmall($value)
 * @mixin \Eloquent
 */
	class ProductImage extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\RelationProduct
 *
 * @property int $id
 * @property int $product_id
 * @property int $related_id
 * @property-read \App\Models\Product $product
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RelationProduct newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RelationProduct newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RelationProduct query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RelationProduct whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RelationProduct whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RelationProduct whereRelatedId($value)
 * @mixin \Eloquent
 */
	class RelationProduct extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Review
 *
 * @property int $id
 * @property int $product_id
 * @property int $user_id
 * @property string $comment
 * @property string|null $plus
 * @property string|null $minus
 * @property int|null $rating
 * @property int|null $thumb_up
 * @property int|null $thumb_down
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ReviewComment[] $comments
 * @property-read int|null $comments_count
 * @property-read \App\Models\ReviewThumb $thumb
 * @property-read \App\Models\User $user
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Review newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Review newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Review onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Review query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Review whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Review whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Review whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Review whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Review whereMinus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Review wherePlus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Review whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Review whereRating($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Review whereThumbDown($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Review whereThumbUp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Review whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Review whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Review withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Review withoutTrashed()
 * @mixin \Eloquent
 */
	class Review extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ReviewComment
 *
 * @property int $id
 * @property int $review_id
 * @property int $user_id
 * @property string $comment
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ReviewComment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ReviewComment newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ReviewComment onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ReviewComment query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ReviewComment whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ReviewComment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ReviewComment whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ReviewComment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ReviewComment whereReviewId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ReviewComment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ReviewComment whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ReviewComment withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ReviewComment withoutTrashed()
 * @mixin \Eloquent
 */
	class ReviewComment extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ReviewThumb
 *
 * @property int $id
 * @property int $user_id
 * @property int $review_id
 * @property int $quality
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ReviewThumb newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ReviewThumb newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ReviewThumb query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ReviewThumb whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ReviewThumb whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ReviewThumb whereQuality($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ReviewThumb whereReviewId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ReviewThumb whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ReviewThumb whereUserId($value)
 * @mixin \Eloquent
 */
	class ReviewThumb extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Settings
 *
 * @property int $id
 * @property string $key
 * @property string $value_uk
 * @property string $value_ru
 * @property string $description_uk
 * @property string $description_ru
 * @property-read mixed $description
 * @property-read mixed $value
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Settings newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Settings newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Settings query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Settings whereDescriptionRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Settings whereDescriptionUk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Settings whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Settings whereKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Settings whereValueRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Settings whereValueUk($value)
 * @mixin \Eloquent
 */
	class Settings extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\SimpleOrder
 *
 * @property int $id
 * @property string|null $name
 * @property string $phone
 * @property string|null $ip
 * @property string|null $user_agent
 * @property int $product_id
 * @property int $accepted
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Product $product
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SimpleOrder newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SimpleOrder newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SimpleOrder query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SimpleOrder whereAccepted($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SimpleOrder whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SimpleOrder whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SimpleOrder whereIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SimpleOrder whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SimpleOrder wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SimpleOrder whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SimpleOrder whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SimpleOrder whereUserAgent($value)
 * @mixin \Eloquent
 */
	class SimpleOrder extends \Eloquent {}
}

namespace App\Models{
/**
 * Class User
 *
 * @package App\Models
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $phone
 * @property int $access
 * @property string $locale
 * @property string $role
 * @property int $base_id
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\UserSession[] $sessions
 * @property-read int|null $sessions_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereAccess($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereBaseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereLocale($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Order[] $orders
 * @property-read int|null $orders_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Product[] $desire_products
 * @property-read int|null $desire_products_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User desc()
 */
	class User extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\UserAccess
 *
 * @property int $id
 * @property string $access_keys
 * @property string $name
 * @property string $description
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserAccess newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserAccess newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserAccess query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserAccess whereAccessKeys($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserAccess whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserAccess whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserAccess whereName($value)
 * @mixin \Eloquent
 */
	class UserAccess extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\UserSession
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $user_id
 * @property string $ssid
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserSession newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserSession newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserSession query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserSession whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserSession whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserSession whereSsid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserSession whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserSession whereUserId($value)
 * @mixin \Eloquent
 */
	class UserSession extends \Eloquent {}
}

