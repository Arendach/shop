<?php

namespace App\Http\Controllers\Catalog;

use App\Models\BannerImage;
use App\Models\Product;
use App\Models\ProductCollection;
use Locale;

class MainController extends CatalogController
{
    public function index()
    {
        $recommended_products = Product::where('is_recommended', 1)
            ->where('on_storage', 1)
            ->get();

        $discount_products = Product::where('discount', '!=', 'NULL')
            ->where('on_storage', 1)
            ->get();

        $new_products = Product::where('is_new', 1)
            ->where('on_storage', 1)
            ->get();

        $data = [
            'images' => BannerImage::all(),
            'new_products' => $new_products,
            'collections' => ProductCollection::where('parent_id', 0)->get(),
            'recommended_products' => $recommended_products,
            'discount_products' => $discount_products,
            'title' => 'My shop',
            'js' => ['slider'],
            'css' => ['slider', 'products']
        ];

        return view('catalog.pages.main', $data);
    }

    public function locale($locale)
    {
        Locale::setUserLocale($locale);

        return redirect(Locale::localizeUrl($locale));
    }
}
