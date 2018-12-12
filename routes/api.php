<?php

use Illuminate\Http\Request;

Route::group(['prefix' => 'auth', 'namespace' => 'Auth'], function () {
	Route::post('login', 'LoginController@make');
	Route::post('register', 'RegisterController@make');
});

Route::group(['prefix' => 'users'], function() {

	Route::get('/', [
		'as'     => 'users.index',
		'uses'   => 'UserController@index'
	]);

	Route::get('create', [
		'as'     => 'cms.product.create',
		'uses'   => 'ProductController@create'
	]);

	Route::post('/', [
		'as'     => 'cms.product.store',
		'before' => 'csrf',
		'uses'   => 'ProductController@store'
	]);

	Route::get('{id}/edit', [
		'as'     => 'cms.product.edit',
		'uses'   => 'ProductController@edit'
	])->where('id', '[0-9]+');

	Route::post('{id}', [
		'as'     => 'cms.product.update',
		'before' => 'csrf',
		'uses'   => 'ProductController@update'
	])->where('id', '[0-9]+');

	Route::get('{id}/destroy', [
		'as'     => 'cms.product.destroy',
		'uses'   => 'ProductController@destroy'
	])->where('id', '[0-9]+');

});
