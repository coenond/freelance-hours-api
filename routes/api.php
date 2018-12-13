<?php

use Illuminate\Http\Request;

Route::group(['prefix' => 'auth', 'namespace' => 'Auth'], function () {
	Route::post('login', 'LoginController@make');
	Route::post('register', 'RegisterController@make');
});

/**
 * User Routes
 */
Route::group(['prefix' => 'users'], function() {
	Route::get('/', [
		'as'     => 'users.index',
		'uses'   => 'UserController@index'
	]);

	Route::get('{id}/edit', [
		'as'     => 'users.edit',
		'uses'   => 'UserController@edit'
	])->where('id', '[0-9]+');

	Route::post('{id}', [
		'as'     => 'users.update',
		'before' => 'csrf',
		'uses'   => 'UserController@update'
	])->where('id', '[0-9]+');

	Route::get('{id}/destroy', [
		'as'     => 'users.destroy',
		'uses'   => 'UserController@destroy'
	])->where('id', '[0-9]+');
});

/**
 * Project Routes
 */
Route::group(['prefix' => 'projects'], function() {
	Route::get('/', [
		'as'     => 'projects.index',
		'uses'   => 'ProjectController@index'
	]);

	Route::get('create', [
		'as'     => 'projects.create',
		'uses'   => 'ProjectController@create'
	]);

	Route::post('/', [
		'as'     => 'projects.store',
		'before' => 'csrf',
		'uses'   => 'ProjectController@store'
	]);

	Route::get('{id}/edit', [
		'as'     => 'projects.edit',
		'uses'   => 'ProjectController@edit'
	])->where('id', '[0-9]+');

	Route::post('{id}', [
		'as'     => 'projects.update',
		'before' => 'csrf',
		'uses'   => 'ProjectController@update'
	])->where('id', '[0-9]+');

	Route::get('{id}/destroy', [
		'as'     => 'projects.destroy',
		'uses'   => 'ProjectController@destroy'
	])->where('id', '[0-9]+');
});

/**
 * Taxes Routes
 */
Route::group(['prefix' => 'taxes'], function() {
	Route::get('/', [
		'as'     => 'taxes.index',
		'uses'   => 'TaxController@index'
	]);

	Route::get('create', [
		'as'     => 'taxes.create',
		'uses'   => 'TaxController@create'
	]);

	Route::post('/', [
		'as'     => 'taxes.store',
		'before' => 'csrf',
		'uses'   => 'TaxController@store'
	]);

	Route::get('{id}/edit', [
		'as'     => 'taxes.edit',
		'uses'   => 'TaxController@edit'
	])->where('id', '[0-9]+');

	Route::post('{id}', [
		'as'     => 'taxes.update',
		'before' => 'csrf',
		'uses'   => 'TaxController@update'
	])->where('id', '[0-9]+');

	Route::get('{id}/destroy', [
		'as'     => 'taxes.destroy',
		'uses'   => 'TaxController@destroy'
	])->where('id', '[0-9]+');
});

/**
 * Activity Routes
 */
Route::group(['prefix' => 'activities'], function() {
	Route::get('/', [
		'as'     => 'activities.index',
		'uses'   => 'ActivityController@index'
	]);

	Route::get('create', [
		'as'     => 'activities.create',
		'uses'   => 'ActivityController@create'
	]);

	Route::post('/', [
		'as'     => 'activities.store',
		'before' => 'csrf',
		'uses'   => 'ActivityController@store'
	]);

	Route::get('{id}/edit', [
		'as'     => 'activities.edit',
		'uses'   => 'ActivityController@edit'
	])->where('id', '[0-9]+');

	Route::post('{id}', [
		'as'     => 'activities.update',
		'before' => 'csrf',
		'uses'   => 'ActivityController@update'
	])->where('id', '[0-9]+');

	Route::get('{id}/destroy', [
		'as'     => 'activities.destroy',
		'uses'   => 'ActivityController@destroy'
	])->where('id', '[0-9]+');
});