<?php

use Illuminate\Http\Request;

Route::group(['prefix' => 'auth', 'namespace' => 'Auth'], function () {
	Route::post('login', 'LoginController@make');
	Route::post('register', 'RegisterController@make');
});
