<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Customer;
use App\Models\Index;
use App\Models\Page;
use App\Models\Product;
use App\Models\ProductCollection;
use App\Models\Redirect;
use App\Models\Review;
use App\Models\Translate;
use App\Observers\CategoryObserver;
use App\Observers\CustomerObserver;
use App\Observers\IndexObserver;
use App\Observers\PageObserver;
use App\Observers\ProductCollectionObserver;
use App\Observers\ProductObserver;
use App\Observers\RedirectsObserver;
use App\Observers\ReviewObserver;
use App\Observers\TranslateObserver;
use Illuminate\Support\ServiceProvider;

class EloquentServiceProvider extends ServiceProvider
{
    public function register()
    {
    }

    public function boot()
    {
        Customer::observe(CustomerObserver::class);
        Page::observe(PageObserver::class);
        Index::observe(IndexObserver::class);
        Product::observe(ProductObserver::class);
        Category::observe(CategoryObserver::class);
        ProductCollection::observe(ProductCollectionObserver::class);
        Translate::observe(TranslateObserver::class);
        Review::observe(ReviewObserver::class);
        Redirect::observe(RedirectsObserver::class);
    }
}
