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

    public function __construct()
    {
        $this->sitemap = Sitemap::create();
    }

    public function show(): Response
    {
        $this->index();
        $this->products();
        $this->categories();
        $this->collections();
        $this->pages();
        $this->images();

        return response($this->sitemap->render())
            ->header('Content-Type', 'application/xml');
    }

    private function index(): void
    {
        $index = Page::whereUriName('index')->first();

        foreach (config('locale.support') as $locale) {
            $link = Locales::localizeUrl($locale, route('index'));

            $url = Url::create($link)
                ->setLastModificationDate($index->updated_at ?? now())
                ->setPriority('1.0')
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY);

            $this->sitemap->add($url);
        }
    }

    private function products(): void
    {
        $products = Product::all();

        foreach ($products as $product) {
            foreach (config('locale.support') as $locale) {
                $link = route('product.view', $product->slug);
                $link = Locales::localizeUrl($locale, $link);
                $lastUpdate = !is_null($product->updated_at) ? $product->updated_at : now();


                $url = Url::create($link)
                    ->setLastModificationDate($lastUpdate)
                    ->setPriority('0.8')
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY);

                $this->sitemap->add($url);
            }
        }
    }

    private function categories()
    {
        $categories = Category::all();

        foreach ($categories as $category) {
            foreach (config('locale.support') as $locale) {
                $link = route('category.show', $category->slug);
                $link = Locales::localizeUrl($locale, $link);
                $lastUpdate = !is_null($category->updated_at) ? $category->updated_at : now();

                $url = Url::create($link)
                    ->setLastModificationDate($lastUpdate)
                    ->setPriority('0.8')
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY);

                $this->sitemap->add($url);
            }
        }
    }

    private function collections()
    {
        $collections = ProductCollection::all();

        foreach ($collections as $collection) {
            foreach (config('locale.support') as $locale) {
                $link = route('collection', $collection->slug);
                $link = Locales::localizeUrl($locale, $link);
                $lastUpdate = !is_null($collection->updated_at) ? $collection->updated_at : now();


                $url = Url::create($link)
                    ->setLastModificationDate($lastUpdate)
                    ->setPriority('0.8')
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY);

                $this->sitemap->add($url);
            }
        }
    }

    private function pages()
    {
        $pages = Page::where('static', false)->get();
        foreach ($pages as $page) {
            foreach (config('locale.support') as $locale) {
                $link = Locales::localizeUrl($locale, route('page', $page->uri_name));

                $url = Url::create($link)
                    ->setLastModificationDate($page->updated_at ?? now())
                    ->setPriority('0.8')
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY);

                $this->sitemap->add($url);
            }
        }
    }
    private function images()
    {
        $images = ProductImage::all();

        foreach ($images as $image) {
            foreach (config('locale.support') as $locale) {
                $link = url($image->big);
                $link = Locales::localizeUrl($locale, $link);

                $url = Url::create($link)
                    ->setPriority('0.6')
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY);

                $this->sitemap->add($url);
            }
        }
    }

}