<?php

use \Illuminate\Support\Str;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

if (!function_exists('simple_routing')) {
    function simple_routing($controller, $action, $namespace_part, $action_prefix = '')
    {
        $namespace = '\\App\\Http\\Controllers\\' . $namespace_part . '\\' . ucfirst(Str::camel($controller)) . 'Controller';

        Config::set('app.controller', $namespace . '@' . $action_prefix . $action);

        $object = new $namespace;

        $methodCamel = Str::camel($action_prefix . trim($action, '_'));

        if (method_exists($object, $methodCamel)) {
            return app()->call([new $namespace, $methodCamel], request()->all());
        }

        abort_if(!method_exists($object, $action_prefix . $action), 404, translate('404! Сторінка не знайдена!'));

        return app()->call([new $namespace, $action_prefix . $action], request()->all());
    }
}

Route::get('sms', 'StreamTele\MainController@Test');

Route::get('/redirect/{service}', 'SocialAuthController@redirect');
Route::get('/callback/{service}', 'SocialAuthController@callback');
/**
 * Зміна мови сайту
 */
Route::get('locale/{locale}', 'Catalog\\MainController@locale')->name('locale');

Route::get('sitemap.xml', 'Api\SitemapController@show');

/**
 * Динамічне редагування контенту
 */
Route::post('assets/content-editable', 'Catalog\\AssetsController@contentEditable');

/**
 * START LOAD ROUTES
 */
Route::group([
    'prefix'     => LaravelLocalization::setLocale(),
    'middleware' => [
        'localeSessionRedirect',
        'localizationRedirect',
        'localeViewPath',
        'setUserLocale',
        'cart'
    ]
], function () {
    /**
     * Маршрути моста
     *
     * #bridge.php
     */
    Route::prefix('bridge')->group(base_path('routes/bridge.php'));

    /**
     * Маршрути каталога
     *
     * #catalog.php
     */
    Route::namespace('Catalog')->group(base_path('routes/catalog.php'));
});
Route::get('/clear_cache', function() {
    Artisan::call('cache:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    return redirect()->back();
});
