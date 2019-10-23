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
    ->middleware('loadCategories')
    ->name('checkout');

/**
 * Сторінка перегляду категорії
 */
Route::get('category/{slug}', 'CategoryController@show')
    ->middleware('loadCategories')
    ->name('category.show');

/**
 * Сторінка авторизації
 */
Route::get('login', 'UserController@login')
    ->middleware('loadCategories')
    ->name('login');

/**
 * Сторінка реєстрації
 */
Route::get('register', 'UserController@register')
    ->middleware('loadCategories')
    ->name('register');

Route::group(['middleware' => ['loadCategories', 'onlyLogged'], 'prefix' => 'profile'], function () {

    /**
     * Сторінка профілю
     */
    Route::get('/', 'UserController@profile')->name('profile');

    /**
     * Мої замовлення
     */
    Route::get('orders', 'UserController@orders')->name('profile.orders');

    /**
     * Перегляд замовлення
     */
    Route::get('orders/{id}', 'UserController@order_view')->name('profile.orders.view');

    /**
     * Переглянуті товари
     */
    Route::get('viewed', 'UserController@viewed')->name('profile.viewed');

    /**
     * Вибрані товари
     */
    Route::get('liked', 'UserController@liked')->name('profile.liked');
});


/**
 * Вихід з профіля(Розлогінення)
 */
Route::get('exit', 'UserController@exit')
    ->middleware('loadCategories')
    ->name('exit');

/**
 * Універсальний маршрут для запросів типу POST
 *
 * #catalog.post
 */
Route::post('catalog/{controller}/{action?}', function ($controller, $action = 'main') {
    return simple_routing($controller, $action, 'Catalog', 'action_');
})->name('catalog.post');