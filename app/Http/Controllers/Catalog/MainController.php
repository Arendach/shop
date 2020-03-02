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
        $recommended = Product::recommended()->onStorage()->get();
        $productsHome = Product::home()->onStorage()->get();
        $page = Page::where('uri_name', 'index')->first();

        $data = [
            'banners'          => BannerImage::all(),
            'collections'      => ProductCollection::root()->paginate(3),
            'recommended'      => $recommended,
            'productsHome'     => $productsHome,
            'title'            => $page->meta_title ?? 'ENTER TITLE',
            'meta_description' => $page->meta_description ?? '',
            'meta_keywords'    => $page->meta_keywords ?? '',
            'page'             => $page
        ];

        return view('catalog.pages.home', $data);
    }

    public function locale($locale)
    {
        Locales::setUserLocale($locale);

        return redirect(Locales::localizeUrl($locale));
    }
}
