<?php

Route::any('javascript/constants', 'MainController@javascript')
    ->name('admin.javascript');

Route::get('/', 'MainController@index')->name('admin.index');

Route::group(['prefix' => 'banner', 'namespace' => 'Banner'], function () {
    Route::resource('discounts', 'DiscountController');
});

Route::resource('pages', 'PageController');

/**
 * simple get routes
 */
Route::get('{folder}/{controller?}/{method?}', function ($folder, $controller = null, $action = null) {
    return simple_routing_admin($folder, $controller, $action, 'get');
})->name('admin.get');

/**
 * simple post routes
 */
Route::post('{folder}/{controller?}/{method?}', function ($folder, $controller = null, $action = null) {
    return simple_routing_admin($folder, $controller, $action);
})->name('admin.post');

/**
 * simple delete routes
 */
Route::delete('{folder}/{controller?}/{method?}', function ($folder, $controller = null, $action = null) {
    return simple_routing_admin($folder, $controller, $action);
})->name('admin.delete');