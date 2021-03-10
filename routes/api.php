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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('user_registration','Api\AuthController@register');
//Route::post('/login','Api\AuthController@login');

Route::post('login', 'Api\AdminAuthController@login')->name('admin.login');
Route::post('author_login', 'Api\AuthorAuthController@login')->name('author.login');


Route::group(['middleware' => 'auth:api'], function(){


    Route::post('admin/get-details', 'Api\AdminAuthController@getDetails');
});
Route::resource('books', 'AuthorController')->except(['create', 'edit']);

Route::resource('authors', 'AdminController')->except(['create', 'edit']);


