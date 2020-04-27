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

Route::get('locale/{locale}', 'MainController@changeLocale')->name('locale');
Route::get('currency/{currencyCode}', 'MainController@changeCurrency')->name('currency');
Route::get('/logout', 'Auth\LoginController@logout')->name('get-logout');

Route::middleware(['set_locale'])->group(function () {
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
            Route::resource('products/{product}/skus', 'SkuController');
            Route::resource('properties', 'PropertyController');
            Route::resource('properties/{property}/property-options', 'PropertyOptionController');

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

    Route::get('/', 'MainController@index')->name('index');
    Route::get('/categories', 'MainController@categories')->name('categories');
    Route::post('subscription/{skus}', 'MainController@subscribe')->name('subscription');

    Route::post('/basket/add/{skus}', 'BasketController@basketAdd')->name('basket-add');

    Route::group([
        'middleware' => 'basket_not_empty',
    ], function() {
        Route::get('/basket', 'BasketController@basket')->name('basket');
        Route::get('/order', 'BasketController@order')->name('order');
        Route::post('/order', 'BasketController@orderConfirm')->name('order-confirm');
        Route::post('/basket/remove/{skus}', 'BasketController@basketRemove')->name('basket-remove');
    });

    Route::get('/{category}', 'MainController@category')->name('category');
    Route::get('/{category}/{product}/{skus}', 'MainController@sku')->name('sku');
});






