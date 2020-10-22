<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/','BooksController@index');


Route::get('/books', 'BooksController@index');
Route::get('/books/create', 'BooksController@create');
Route::post('/books/create', 'BooksController@getBookInfo');
Route::post('/books', 'BooksController@store');
Route::get('/books/{book}/edit', 'BooksController@edit');
Route::patch('/books/{book}', 'BooksController@update')
  ->middleware('can:update,book');
Route::delete('/books/{book}', 'BooksController@destroy')->where('book', '[0-9]+'); //正規表現規約がないと、usersが404になってしまう。
Route::get('/books/users', 'BooksController@users');
Route::get('/books/{book}/users', 'BooksController@showOtherUsers')->where('book', '[0-9]+');
Route::get('/books/otherUser/{user}', 'BooksController@showOtherUserBooks');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
