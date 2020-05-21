<?php

/**
 * Головна сторінка сайту
 */
Route::get('/', 'MainController@index')
    ->middleware('loadCategories')
    ->name('index');

/**
 * Сторінка перегляду товару
 */
Route::get('product/{slug}', 'ProductController@view')
    ->middleware('loadCategories')
    ->name('product.view');

/**
 * Сторінка перегляду корня колекцій
 */
Route::get('collections', 'CollectionController@index')
    ->middleware('loadCategories')
    ->name('collections');

/**
 * Сторінка перегляду вибраної колекції
 */
Route::get('collection/{slug}', 'CollectionController@view')
    ->middleware('loadCategories')
    ->name('collection');

/**
 * Маршрут для перегляду створених сторінок-матеріалів
 */
Route::get('page/{name}', 'PagesController@index')
    ->middleware('loadCategories')
    ->name('page');

/**
 * Корзина (список товарів)
 */
Route::get('cart', 'CartController@index')
    ->middleware('loadCategories')
    ->name('cart');

/**
 * Оформлення замовлення
 */
Route::get('checkout', 'OrderController@checkout')
    ->middleware('loadCategories', 'onlyLogged')
    ->name('checkout');

Route::get('checkout/success/{id}', 'OrderController@success')
    ->middleware('loadCategories', 'onlyLogged')
    ->name('checkout.success');

Route::post('checkout', 'OrderController@create')
    ->middleware('loadCategories', 'onlyLogged')
    ->name('checkout.create');

Route::post('simple_order/create', 'SimpleOrderController@create')
    ->name('simple_order.create');

/**
 * Сторінка перегляду категорії
 */
Route::get('category/{slug}', 'CategoryController@show')
    ->middleware('loadCategories')
    ->name('category.show');

/**
 * Сторінка авторизації
 */
Route::get('customer/login', 'CustomerController@login')
    ->middleware('loadCategories')
    ->name('login');

Route::group(['middleware' => ['loadCategories', 'onlyLogged'], 'prefix' => 'profile'], function () {

    /**
     * Сторінка профілю
     */
    Route::get('/', 'CustomerController@profile')->name('profile');

    /**
     * Мої замовлення
     */
    Route::get('orders', 'CustomerController@orders')->name('profile.orders');

    /**
     * Перегляд замовлення
     */
    Route::get('orders/{id}', 'CustomerController@order_view')->name('profile.orders.view');

    /**
     * Переглянуті товари
     */
    Route::get('viewed', 'CustomerController@viewed')->name('profile.viewed');

    /**
     * Вибрані товари
     */
    Route::get('desire', 'DesireController@index')->name('profile.desire');

    /**
     * Налаштування профілю
     */
    Route::get('config', 'CustomerController@config')->name('profile.config');
});

/**
 * Пошук товарів по сайту
 */
Route::get('search', 'SearchController@index')
    ->middleware('loadCategories')
    ->name('search');

/**
 * Вихід з профіля(Розлогінення)
 */
Route::get('customer/logout', 'CustomerController@logout')
    ->middleware('loadCategories')
    ->name('customer.logout');

/**
 * Універсальний маршрут для запросів типу POST
 *
 * #catalog.post
 */
Route::post('catalog/{controller}/{action?}', function ($controller, $action = 'main') {
    return simple_routing($controller, $action, 'Catalog', 'action_');
})->name('catalog.post');