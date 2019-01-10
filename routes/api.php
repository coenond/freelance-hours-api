<?php

use Illuminate\Http\Request;

Route::get('/', function () {
    return 'API Running.';
});

Route::group(['prefix' => 'auth', 'namespace' => 'Auth'], function () {
	Route::post('login', 'LoginController@make');
	Route::post('register', 'RegisterController@make');
});

/**
 * Dashboard Routes
 */
Route::group(['prefix' => 'dashboard'], function() {
	Route::get('/', [
		'as'     => 'dashboard.index',
		'uses'   => 'DashboardController@index'
	]);
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
	Route::get('/all', [
		'as'     => 'projects.all',
		'uses'   => 'ProjectController@all'
	]);

	Route::get('get/{id}', [
		'as'     => 'projects.get',
		'uses'   => 'ProjectController@get'
	]);

	Route::post('/store', [
		'as'     => 'projects.store',
		'before' => 'csrf',
		'uses'   => 'ProjectController@store'
	]);

	Route::post('{id}/edit', [
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
 * Activity Routes
 */
Route::group(['prefix' => 'activities'], function() {
	Route::get('/all', [
		'as'     => 'activities.all',
		'uses'   => 'ActivityController@all'
	]);

	Route::get('get/{id}', [
		'as'     => 'activities.get',
		'uses'   => 'ActivityController@get'
	]);

	Route::get('create', [
		'as'     => 'activities.create',
		'uses'   => 'ActivityController@create'
	]);

	Route::post('/store', [
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
		'uses'   => 'ActivityController@update'
	])->where('id', '[0-9]+');

	Route::get('{id}/destroy', [
		'as'     => 'activities.destroy',
		'uses'   => 'ActivityController@destroy'
	])->where('id', '[0-9]+');
});

/**
 * Taxes Routes
 */
Route::group(['prefix' => 'taxes'], function() {
	Route::get('/all', [
		'as'     => 'taxes.all',
		'uses'   => 'TaxController@all'
	]);

	Route::get('get/{id}', [
		'as'     => 'taxes.get',
		'uses'   => 'TaxController@get'
	]);

	Route::get('create', [
		'as'     => 'taxes.create',
		'uses'   => 'TaxController@create'
	]);

	Route::post('/store', [
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