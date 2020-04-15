<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes([
    'reset' => false,
    'confirm' => false,
    'verify' => false,
]);

Route::get('reset', 'ResetController@reset')->name('reset');

Route::middleware(['auth'])->group(function () {
    Route::group([
        'namespace' => 'Admin',
        'prefix' => 'admin'
    ], function() {
        Route::group(['middleware' => 'admin'], function () {
            Route::get('/orders', 'OrderController@index')->name('orders');
            Route::get('/orders/{order}', 'OrderController@show')->name('orders.show');
        });
        Route::resource('categories', 'CategoryController');
        Route::resource('products', 'ProductController');
    });

    Route::group([
        'namespace' => 'Person',
        'as' => 'person.',
        'prefix' => 'person'
    ], function () {
        Route::get('/orders', 'OrderController@index')->name('orders.index');
        Route::get('/orders/{order}', 'OrderController@show')->name('orders.show');
    });
});

Route::get('/logout', 'Auth\LoginController@logout')->name('get-logout');

Route::get('/', 'MainController@index')->name('index');
Route::get('/categories', 'MainController@categories')->name('categories');

Route::post('/basket/add/{id}', 'BasketController@basketAdd')->name('basket-add');

Route::group([
   'middleware' => 'basket_not_empty',
], function() {
    Route::get('/basket', 'BasketController@basket')->name('basket');
    Route::get('/order', 'BasketController@order')->name('order');
    Route::post('/order', 'BasketController@orderConfirm')->name('order-confirm');
    Route::post('/basket/remove/{id}', 'BasketController@basketRemove')->name('basket-remove');
});


Route::get('/{category}', 'MainController@category')->name('category');
Route::get('/{category}/{product?}', 'MainController@product')->name('product');






