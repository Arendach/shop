<?php

/**
 * Str helper
 */

use \Illuminate\Support\Str;

/**
 * @function simple_routing
 */
if (!function_exists('simple_routing')) {
    function simple_routing($controller, $action, $namespace_part, $action_prefix = '')
    {
        $namespace = '\\App\\Http\\Controllers\\' . $namespace_part . '\\' . ucfirst(Str::camel($controller)) . 'Controller';

        Config::set('app.controller', $namespace . '@' . $action_prefix . $action);

        $object = new $namespace;

        abort_if(!method_exists($object, $action_prefix . $action), 404, __('common.errors.post_404'));

        return app()->call([new $namespace, $action_prefix . $action]);
    }
}

/**
 * @function simple_routing_admin
 */
if (!function_exists('simple_routing_admin')) {
    function simple_routing_admin($folder, $controller = null, $action = null, $method = 'post')
    {
        if ($controller == null && $action == null)
            return simple_routing($folder, 'main', 'Admin', $method == 'post' ? 'action_' : 'section_');
        elseif ($action == null)
            return simple_routing($folder, $controller, 'Admin', $method == 'post' ? 'action_' : 'section_');
        else
            return simple_routing(ucfirst(Str::camel($folder)) . '\\' . ucfirst(Str::camel($controller)), $action, 'Admin', $method == 'post' ? 'action_' : 'section_');
    }
}

/**
 * Зміна мови сайту
 */
Route::get('locale/{locale}', 'Catalog\\MainController@locale')->name('locale');

Route::get('sitemap.xml', 'Api\SitemapController@show');

/**
 * START LOAD ROUTES
 */
Route::group([
    'prefix' => Locale::getPrefix(),
    'middleware' => [
        'setUserLocale',
        'cart'
    ]
], function () {
    /**
     * Маршрути адмінки
     *
     * admin.php
     */
    Route::prefix('admin')
        ->namespace('Admin')
        ->middleware('adminAccessDetect')
        ->group(base_path('routes/admin.php'));

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
