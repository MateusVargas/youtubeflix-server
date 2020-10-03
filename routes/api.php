<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::post('auth/login', 'AuthController@login');
Route::post('auth/refresh', 'AuthController@refresh');

Route::post('user/create', 'UserController@store');

Route::group(['middleware' => ['apiJwt']],function(){
	Route::prefix('categorias')->group(function(){
		Route::get('/', 'CategoriaController@index');
		Route::post('/', 'CategoriaController@store');
		Route::get('/videos', 'CategoriaController@show');
	});

	Route::prefix('videos')->group(function(){
		Route::post('/', 'VideoController@store');
	});

	Route::post('auth/logout', 'AuthController@logout');
	Route::get('auth/me', 'AuthController@me');
});