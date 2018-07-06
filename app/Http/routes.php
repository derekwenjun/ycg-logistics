<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//Route::get('/', function () { return view('welcome'); });

Route::auth();

Route::group(['middleware' => 'auth'], function () {
	Route::get('/', 'HomeController@index');

	// clients
	Route::get('/client', ['uses'=>'ClientController@index', 'as'=>'client.index']);
	Route::get('/client/{id}', ['uses'=>'ClientController@show', 'as'=>'client.show']);
	Route::post('/client', ['uses'=>'ClientController@store', 'as'=>'client.store']);
	Route::get('/client/{id}/edit', ['uses'=>'ClientController@edit', 'as'=>'client.edit']);
	Route::put('/client/{id}', ['uses'=>'ClientController@update', 'as'=>'client.update']);
	
	Route::get('/client/{id}/charge', ['uses'=>'ClientController@charge', 'as'=>'client.charge']);
	Route::post('/client/store_charge', ['uses'=>'ClientController@store_charge', 'as'=>'client.store_charge']);

	// Order Route
	Route::get('order', ['uses'=>'OrderController@index', 'as'=>'order.index']);
	Route::get('order/trash', ['uses'=>'OrderController@trash', 'as'=>'order.trash']);

	Route::get('order/{id}/create', ['uses'=>'OrderController@create', 'as'=>'order.create']);
	Route::delete('order/{id}', ['uses'=>'OrderController@destroy', 'as'=>'order.destroy']);
	// 
	Route::post('order/store', ['uses'=>'OrderController@store', 'as'=>'order.store']);
	Route::get('order/{id}/waybill', ['uses'=>'OrderController@waybill', 'as'=>'order.waybill']);
	// 
	Route::post('order/store_waybill', ['uses'=>'OrderController@storeWaybill', 'as'=>'order.store_waybill']);
	Route::get('order/{id}/products', ['uses'=>'OrderController@products', 'as'=>'order.products']);

	Route::post('order/store_products', ['uses'=>'OrderController@storeProducts', 'as'=>'order.store_products']);
	Route::get('order/{id}/payment', ['uses'=>'OrderController@payment', 'as'=>'order.payment']);

	Route::post('order/store_payment', ['uses'=>'OrderController@storePayment', 'as'=>'order.store_payment']);
	Route::get('order/{id}/done', ['uses'=>'OrderController@done', 'as'=>'order.done']);

	Route::get('order/{id}/show', ['uses'=>'OrderController@show', 'as'=>'order.show']);
	Route::get('order/{id}/tracking', ['uses'=>'OrderController@tracking', 'as'=>'order.tracking']);


	// Product Route
	Route::get('product', ['uses'=>'ProductController@index', 'as'=>'product.index']);
	Route::post('product/search', ['uses'=>'ProductController@search', 'as'=>'product.search']);

	Route::resource('address', 'AddressController');
	Route::post('/address/store_shipping', ['uses'=>'AddressController@store_shipping', 'as'=>'address.store_shipping']);

	// Finance Route
	Route::get('transcation', ['uses'=>'TranscationController@index', 'as'=>'transcation.index']);
});

Route::get('order/{id}/qr', ['uses'=>'OrderController@qr', 'as'=>'order.qr']);
Route::post('order/tracking', ['uses'=>'OrderController@tracking', 'as'=>'order.tracking']);
