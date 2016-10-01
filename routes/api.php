<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::group([
	'prefix' => 'client', 
	'as' => 'client.',
	'middleware' => ['auth:api', 'api.checkrole:client']
	], function() {
	Route::resource('orders', 'Api\Client\ClientCheckoutController', [
			'except' => ['create', 'edit', 'destroy']
		]);
});

Route::group([
	'prefix' => 'deliveryman', 
	'as' => 'deliveryman.',
	'middleware' => ['auth:api', 'api.checkrole:deliveryman']
	], function() {
	Route::resource('orders', 'Api\Deliveryman\DeliverymanCheckoutController', [
			'except' => ['create', 'edit', 'destroy', 'store']
		]);
	Route::patch('orders/{id}/update-status', [
		'uses' => 'Api\Deliveryman\DeliverymanCheckoutController@updateStatus',
		'as' => 'orders.update.status'
		]);
});