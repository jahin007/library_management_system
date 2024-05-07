<?php

use Illuminate\Support\Facades\Route;

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

Route::group(['middleware' => 'admin'], function () {
//backend admin login route...
    Route::get('/home', 'App\Http\Controllers\AdminController@index')->name('admin.index');


//backend admin borrow book route...
    Route::get('/applied_book_list', 'App\Http\Controllers\AdminController@applied_book_list')->name('applied_book_list');
    Route::get('/approved_book_list', 'App\Http\Controllers\AdminController@approved_book_list')->name('approved_book_list');
    Route::get('/returned_book_list', 'App\Http\Controllers\AdminController@returned_book_list')->name('returned_book_list');
    Route::get('/rejected_book_list', 'App\Http\Controllers\AdminController@rejected_book_list')->name('rejected_book_list');

    Route::get('/approve_book/{id}', 'App\Http\Controllers\AdminController@approve_book')->name('approve_book');
    Route::get('/reject_book/{id}', 'App\Http\Controllers\AdminController@reject_book')->name('reject_book');
    Route::get('/return_book/{id}', 'App\Http\Controllers\AdminController@return_book')->name('return_book');
});
Route::get('/logout', 'App\Http\Controllers\Auth\LoginController@logout')->name('logout');



//backend category route...
Route::group(['prefix'=>'categories'],function (){
    Route::get('/', 'App\Http\Controllers\CategoryController@manage_category')->name('admin.categories');
    Route::get('/edit/{id}', 'App\Http\Controllers\CategoryController@category_edit')->name('admin.category.edit');
    Route::get('/create', 'App\Http\Controllers\CategoryController@category_create')->name('admin.category.create');
    Route::get('/status/{id}', 'App\Http\Controllers\CategoryController@cat_status_change')->name('admin.category.status');

    Route::post('/create', 'App\Http\Controllers\CategoryController@category_store')->name('admin.category.store');
    Route::post('/edit/{id}', 'App\Http\Controllers\CategoryController@category_update')->name('admin.category.update');
    Route::get('/delete/{id}', 'App\Http\Controllers\CategoryController@category_delete')->name('admin.category.delete');
});

//backend author route...
Route::group(['prefix'=>'authors'],function (){
    Route::get('/', 'App\Http\Controllers\AuthorController@manage_author')->name('admin.authors');
    Route::get('/edit/{id}', 'App\Http\Controllers\AuthorController@author_edit')->name('admin.author.edit');
    Route::get('/create', 'App\Http\Controllers\AuthorController@author_create')->name('admin.author.create');

    Route::post('/create', 'App\Http\Controllers\AuthorController@author_store')->name('admin.author.store');
    Route::post('/edit/{id}', 'App\Http\Controllers\AuthorController@author_update')->name('admin.author.update');
    Route::get('/delete/{id}', 'App\Http\Controllers\AuthorController@author_delete')->name('admin.author.delete');
});

//backend book route...
Route::group(['prefix'=>'books'],function (){
    Route::get('/', 'App\Http\Controllers\BookController@manage_book')->name('admin.books');
    Route::get('/edit/{id}', 'App\Http\Controllers\BookController@book_edit')->name('admin.book.edit');
    Route::get('/create', 'App\Http\Controllers\BookController@book_create')->name('admin.book.create');
    Route::get('/status/{id}', 'App\Http\Controllers\BookController@book_status_change')->name('admin.book.status');

    Route::post('/create', 'App\Http\Controllers\BookController@book_store')->name('admin.book.store');
    Route::post('/edit/{id}', 'App\Http\Controllers\BookController@book_update')->name('admin.book.update');
    Route::get('/delete/{id}', 'App\Http\Controllers\BookController@book_delete')->name('admin.book.delete');
});

//frontend user route...
Route::get('/', 'App\Http\Controllers\UserController@index')->name('user.index');
Route::get('/explore', 'App\Http\Controllers\UserController@explore')->name('explore');
Route::get('/view-details/{id}', 'App\Http\Controllers\UserController@view_details')->name('view_details');
Route::get('/book_by_cat/{id}', 'App\Http\Controllers\UserController@book_by_cat')->name('book_by_cat');
Route::get('/book_history', 'App\Http\Controllers\UserController@book_history')->name('book_history');
Route::get('/borrow_book/{id}', 'App\Http\Controllers\UserController@borrow_book')->name('borrow_book');
Route::get('/cancel_request/{id}', 'App\Http\Controllers\UserController@cancel_request')->name('cancel_request');
Route::get('/search', 'App\Http\Controllers\UserController@search')->name('search');




Auth::routes();
Route::get('/dashboard', 'App\Http\Controllers\HomeController@index')->name('home');
