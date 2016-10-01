<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    
    // $query = http_build_query([
    //  	'client_id' => '3',
    // 	'redirect_uri' => 'http://localhost:9000/callback',
    //   	'response_type' => 'code',
    //   	'scope' => ''
    // ]);
    
    // return redirect('http://localhost:8000/oauth/authorize?' . $query );
});

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::group([
	'prefix' => 'admin', 
	'as' => 'admin.',
	'middleware' => ['auth.checkrole']
	], function() {
	Route::resource('categories', 'Admin\CategoryController', ['except' => ['destroy']]);
	Route::resource('products', 'Admin\ProductController', ['except' => ['destroy']]);
	Route::resource('orders', 'Admin\OrderController', ['except' => ['destroy, create, store']]);
	Route::resource('coupons', 'Admin\CouponController');
	Route::resource('clients', 'Admin\ClientController');
});

Route::group([
	'prefix' => 'customer', 
	'as' => 'customer.'
	], function() {
	Route::resource('orders', 'CheckoutController', ['except' => ['show']]);
});
