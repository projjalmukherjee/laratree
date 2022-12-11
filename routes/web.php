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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware('auth')->group(function () {

    Route::get('/admin-home', 'AdminController@index')->name('adminhome')->middleware('admin');
    Route::get('/user-home', 'UserController@index')->name('userhome');
    Route::get('/category-list', 'AdminController@catlist')->name('category-list')->middleware('admin');

    Route::get('/add-category','AdminController@addCategory')->name('add-category')->middleware('admin');
    Route::post('/add-category','AdminController@saveCategory')->name('save-category')->middleware('admin');
});
