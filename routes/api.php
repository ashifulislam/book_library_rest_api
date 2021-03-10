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


Route::post('register','Api\UserAuthController@user_register');
Route::post('user_login','Api\UserAuthController@login');
Route::post('login', 'Api\AdminAuthController@login')->name('admin.login');
Route::post('author_login', 'Api\AuthorAuthController@login')->name('author.login');
Route::resource('books', 'AuthorController')->except(['create', 'edit']);
Route::resource('authors', 'AdminController')->except(['create', 'edit']);
Route::post('add_book_favourite','Favourite_BooksController@add_favourite_book');
Route::get('show_book_favourite','Favourite_BooksController@show_favourite_book');


