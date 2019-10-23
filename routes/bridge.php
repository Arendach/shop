<?php

Route::get('/', 'Bridge\\MainController@section_main')->name('bridge');

Route::post('{controller}/{action?}', function ($controller, $action = 'main') {
    return simple_routing($controller, $action, 'Bridge', 'action_');
})->name('bridge.post');

Route::get('{controller}/{action?}', function ($controller, $action = 'main') {
    return simple_routing($controller, $action, 'Bridge', 'section_');
})->name('bridge.get');