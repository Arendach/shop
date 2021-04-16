<?php

namespace App\Providers;

use App\Services\AuthService;
use App\Services\BaseConnectionService;
use App\Services\CartService;
use App\Services\CategoryFilterService;
use App\Services\CheckoutService;
use App\Services\CustomerService;
use App\Services\DeliveryService;
use App\Services\NewPostService;
use App\Services\OrderStatusService;
use App\Services\StaticPageService;
use Illuminate\Database\Schema\Builder;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Builder::defaultStringLength(191);
    }

    public function register()
    {
        $this->app->bind('Banner', 'App\\Services\\BannerService');
        $this->app->bind('Pay', 'App\\Services\\PayService');

        $this->app->bind(BaseConnectionService::class, BaseConnectionService::class);

        $this->app->singleton(AuthService::class, AuthService::class);
        $this->app->singleton(CartService::class, CartService::class);
        $this->app->singleton(DeliveryService::class, DeliveryService::class);
        $this->app->singleton(CheckoutService::class, CheckoutService::class);
        $this->app->singleton(NewPostService::class, NewPostService::class);
        $this->app->singleton(CustomerService::class, CustomerService::class);
        $this->app->singleton(OrderStatusService::class, OrderStatusService::class);
        $this->app->singleton(StaticPageService::class, StaticPageService::class);
        $this->app->singleton(CategoryFilterService::class, CategoryFilterService::class);
    }
}
