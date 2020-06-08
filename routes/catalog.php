<?php

// Головна сторінка сайту
Route::get('/', 'MainController@index')->name('index');

// Сторінка перегляду товару
Route::get('product/{slug}', 'ProductController@view')->name('product.view');

// Сторінка перегляду корня колекцій
Route::get('collections', 'CollectionController@index')->name('collections');

// Сторінка перегляду вибраної колекції
Route::get('collection/{slug}', 'CollectionController@view')->name('collection');

// Маршрут для перегляду створених сторінок-матеріалів
Route::get('page/{name}', 'PagesController@index')->name('page');

// Корзина (список товарів)
Route::get('cart', 'CartController@index')->name('cart');

// Оформлення замовлення
Route::get('checkout', 'OrderController@checkout')->middleware('onlyLogged')->name('checkout');

// Success page
Route::get('checkout/success/{id}', 'OrderController@success')->middleware('onlyLogged')->name('checkout.success');

// Оформлення замовлення
Route::post('checkout', 'OrderController@create')->name('checkout.create');

//  Оформлення замовлення в один клік
Route::post('simple_order/create', 'SimpleOrdersController@create')->name('simple_order.create');

// FAQ - часто задаваємі питання
Route::get('faq', 'PagesController@faq')->name('faq');

// Сторінка перегляду категорії
Route::get('category/{slug}', 'CategoryController@show')->name('category.show');

// Сторінка авторизації
Route::get('customer/login', 'CustomerController@login')->name('login');

// Група профіль коруистувача
Route::group(['middleware' => ['onlyLogged'], 'prefix' => 'profile'], function () {
    // Сторінка профілю
    Route::get('/', 'CustomerController@profile')->name('profile');

    // Мої замовлення
    Route::get('orders', 'CustomerController@orders')->name('profile.orders');

    // Переглянуті товари
    Route::get('viewed', 'CustomerController@viewed')->name('profile.viewed');

    // Вибрані товари
    Route::get('desire', 'DesireController@index')->name('profile.desire');

    // Налаштування профілю
    Route::get('config', 'CustomerController@config')->name('profile.config');
});

// Сторінка відгуку товару
Route::get('leave-review/{id}', 'ProductController@leaveReview')->name('product.leave_review');

// Залишення відгуку товару через метод POST
Route::post('product/create-review', 'ProductController@action_create_review')->name('product.create_review');

// Пошук товарів по сайту
Route::get('search', 'SearchController@index')->name('search');

// Пошук товарів в реальному часу
Route::post('search-live', 'SearchController@searchLive')->name('search_live');

// Вихід з профіля(Розлогінення)
Route::get('customer/logout', 'CustomerController@logout')->name('customer.logout');

// Javascript переклади
Route::any('assets/translates.js', 'AssetsController@translates');

// Реєстрація перекладу з фронта через аякс
Route::any('assets/register_translate', 'AssetsController@registerTranslate');

/**
 * Універсальний маршрут для запросів типу POST
 *
 * #catalog.post
 */
Route::post('catalog/{controller}/{action?}', function ($controller, $action = 'main') {
    return simple_routing($controller, $action, 'Catalog', 'action_');
})->name('catalog.post');