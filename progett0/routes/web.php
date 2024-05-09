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

Route::get('/', 'App\Http\Controllers\HomeController@index')->name("home.index");

Route::get('/about','App\Http\Controllers\HomeController@about')->name("home.about");

Route::get('/products','App\Http\Controllers\ProductController@index')->name("product.index");

Route::get('/products/{id}','App\Http\Controllers\ProductController@show')->name("product.show");

Route::middleware('admin')->group(function()
{
    Route::get('/admin','App\Http\Controllers\AdminController@index')->name("admin.home.index");

    Route::get('/admin/products','App\Http\Controllers\AdminProductController@index')->name("admin.products.indexProduct");

    Route::get('/admin/newsletter','App\Http\Controllers\AdminController@newsletter')->name("admin.newsletter.index");

    Route::post('/admin/products/store','App\Http\Controllers\AdminProductController@store')->name("admin.products.store");

    Route::delete('admin/products/{id}/delete','App\Http\Controllers\AdminProductController@delete')->name("admin.products.delete");

    Route::get('admin/products/{id}/edit','App\Http\Controllers\AdminProductController@edit')->name("admin.products.edit");

    Route::put('admin/products/{id}/update', 'App\Http\Controllers\AdminProductController@update')->name("admin.products.update");

    Route::post('newsletter/send', 'App\Http\Controllers\NewsletterController@sendMail')->name('newsletter.mail.send');
});


Auth::routes();
//va tolta perchè non abbiamo il la chiamata /home
//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');




Route::middleware('auth')->group(function(){

    Route::get('/cart','App\Http\Controllers\CartController@index')->name("cart.index");
    Route::post('/cart/add/{id}','App\Http\Controllers\CartController@add')->name('cart.add');
    Route::delete('/cart/delete','App\Http\Controllers\CartController@delete')->name("cart.delete");
    Route::delete('/cart/deleteProduct/{id}','App\Http\Controllers\CartController@deleteProduct')->name("cart.deleteProduct");
    Route::post('/cart/purchase', 'App\Http\Controllers\CartController@purchase')->name("cart.purchase");
    Route::get('orders','App\Http\Controllers\MyAccountController@orders')->name("myaccount.orders");
    Route::get('balance','App\Http\Controllers\MyAccountController@balance')->name("myaccount.balance");
    Route::post('/updateBalance', 'App\Http\Controllers\MyAccountController@updateBalance')->name("myaccount.updateBalance");
    Route::get('newsletter/unsubscribe', 'App\Http\Controllers\NewsletterController@unsubscribe')->name('newsletter.unsubscribe');
});

