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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::namespace('Auth')->group(function () {
    Route::post('register', 'RegisterController')->name('auth.register');
    Route::post('login', 'LoginController')->name('auth.login');
    Route::post('logout', 'LogoutController')->name('auth.logout');
});

Route::get('user', 'UserController');

Route::get('article', 'ArticleController@index');
Route::get('article/{article:slug}', 'ArticleController@show');
Route::group([
    'prefix' => 'article', 'middleware' => 'auth:api'
], function () {
    Route::post('/', 'ArticleController@store');
    Route::put('{article}', 'ArticleController@update');
    Route::delete('{article}', 'ArticleController@destroy');
});
