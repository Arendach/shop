<?php

namespace App\Providers;

use App\Services\BaseConnectionService;
use App\Services\CategoryFilterService;
use App\Services\CheckoutService;
use App\Services\DeliveryService;
use App\Services\NewPostService;
use App\Services\OrderStatusService;
use App\Services\SettingsService;
use App\Services\StaticPageService;
use App\Services\UserService;
use App\Services\CartService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public $singletons = [
        // CartInterface::class => CartService::class
    ];

    public $bindings = [
       //  CartInterface::class => CartService::class
    ];

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('Banner', 'App\\Services\\BannerService');
        $this->app->bind('Pay', 'App\\Services\\PayService');

        $this->app->bind(BaseConnectionService::class, BaseConnectionService::class);

        $this->app->singleton(CartService::class, CartService::class);
        $this->app->singleton(DeliveryService::class, DeliveryService::class);
        $this->app->singleton(CheckoutService::class, CheckoutService::class);
        $this->app->singleton(NewPostService::class, NewPostService::class);
        $this->app->singleton(UserService::class, UserService::class);
        $this->app->singleton(OrderStatusService::class, OrderStatusService::class);
        $this->app->singleton(StaticPageService::class, StaticPageService::class);
        $this->app->singleton(CategoryFilterService::class, CategoryFilterService::class);
        $this->app->singleton(SettingsService::class, SettingsService::class);
    }
}
