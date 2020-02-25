<?php

namespace App\Http\Controllers\Catalog;

use App\Models\BannerImage;
use App\Models\Page;
use App\Models\Product;
use App\Models\ProductCollection;
use Locales;

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

        $page = Page::where('uri_name', 'index')->first();

        $data = [
            'banners'              => BannerImage::all(),
            'new_products'         => $new_products,
            'collections'          => ProductCollection::where('parent_id', 0)->paginate(3),
            'recommendedProducts' => $recommended_products,
            'discount_products'    => $discount_products,
            'title'                => $page->meta_title ?? 'ENTER TITLE',
            'js'                   => ['slider'],
            'css'                  => ['slider', 'products'],
            'meta_description'     => $page->meta_description ?? '',
            'meta_keywords'        => $page->meta_keywords ?? '',
            'page'                 => $page
        ];

        return view('catalog.pages.home', $data);
    }

    public function locale($locale)
    {
        Locales::setUserLocale($locale);

        return redirect(Locales::localizeUrl($locale));
    }
}
