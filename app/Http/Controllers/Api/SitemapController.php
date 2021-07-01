<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Page;
use App\Models\Product;
use App\Models\ProductCollection;
use App\Models\ProductImage;
use Illuminate\Http\Response;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
use Locales;

class SitemapController extends Controller
{
    private $sitemap;
    public $locale;

    public function __construct()
    {
        $this->locale = config('locale.default');
        $this->sitemap = Sitemap::create();
    }

    public function show(): Response
    {
        $lang = 'ru';
        $this->index($lang);
        $this->products($lang);
        $this->categories($lang);
        $this->collections($lang);
        $this->pages($lang);
        $this->images($lang);

        return response($this->sitemap->render())
            ->header('Content-Type', 'application/xml');
    }

    public function showUk(): Response
    {
        $lang = 'uk';
        $this->index($lang);
        $this->products($lang);
        $this->categories($lang);
        $this->collections($lang);
        $this->pages($lang);
        $this->images($lang);

        return response($this->sitemap->render())
            ->header('Content-Type', 'application/xml');
    }

    private function index($setLocale = null): void
    {
        $index = Page::whereUriName('index')->first();

        $link = Locales::localizeUrl($setLocale ?? $this->locale, route('index'));

        $url = Url::create($link)
            ->setLastModificationDate($index->updated_at ?? now())
            ->setPriority('1.0')
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY);

        $this->sitemap->add($url);
    }

    private function products($setLocale = null): void
    {
        $products = Product::all();

        foreach ($products as $product) {
            $link = route('product.view', $product->slug);
            $link = Locales::localizeUrl($setLocale ?? $this->locale, $link);
            $lastUpdate = !is_null($product->updated_at) ? $product->updated_at : now();


            $url = Url::create($link)
                ->setLastModificationDate($lastUpdate)
                ->setPriority('0.8')
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY);

            $this->sitemap->add($url);
        }
    }

    private function categories($setLocale = null)
    {
        $categories = Category::isActiveScope()->get();
        foreach ($categories as $category) {
            $link = route('category.show', $category->slug);
            $link = Locales::localizeUrl($setLocale ?? $this->locale, $link);
            $lastUpdate = !is_null($category->updated_at) ? $category->updated_at : now();

            $url = Url::create($link)
                ->setLastModificationDate($lastUpdate)
                ->setPriority('0.8')
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY);

            $this->sitemap->add($url);
        }
    }

    private function collections($setLocale = null)
    {
        $collections = ProductCollection::all();

        foreach ($collections as $collection) {
            $link = route('collection', $collection->slug);
            $link = Locales::localizeUrl($setLocale ?? $this->locale, $link);
            $lastUpdate = !is_null($collection->updated_at) ? $collection->updated_at : now();


            $url = Url::create($link)
                ->setLastModificationDate($lastUpdate)
                ->setPriority('0.8')
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY);

            $this->sitemap->add($url);
        }
    }

    private function pages($setLocale = null)
    {
        $pages = Page::where('static', false)->get();
        foreach ($pages as $page) {
            $link = Locales::localizeUrl($setLocale ?? $this->locale, route('page', $page->uri_name));

            $url = Url::create($link)
                ->setLastModificationDate($page->updated_at ?? now())
                ->setPriority('0.8')
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY);

            $this->sitemap->add($url);
        }
    }

    private function images($setLocale = null)
    {
        $images = ProductImage::all();

        foreach ($images as $image) {
            $link = url($image->big);
            $link = Locales::localizeUrl($setLocale ?? $this->locale, $link);

            $url = Url::create($link)
                ->setPriority('0.6')
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY);

            $this->sitemap->add($url);
        }
    }

}