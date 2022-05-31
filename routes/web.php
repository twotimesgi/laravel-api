<?php

use App\Http\Controllers\Admin\HomeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
    return view('guests.home');
})->name('homepage');

Auth::routes();

Route::middleware('auth')
    ->namespace('Admin')
    ->name('admin.')
    ->prefix('admin')
    ->group(function () {
        Route::get('/', 'HomeController@index')->name('home');
        Route::post('/slugger', 'HomeController@slugger')->name('slugger');
        Route::get('/posts/my-posts', 'PostController@myindex')->name('posts.myindex');
        Route::resource('/posts', 'PostController');
        Route::resource('/categories', 'CategoryController');
        Route::get('account', 'UserController@edit')->name('account.edit');
        Route::post('account', 'UserController@update')->name('account.update');
        Route::delete('account', 'UserController@destroy')->name('account.destroy');
    });


Route::get("{any?}", function () {
    return view('guests.home');
})->where('any', '.*');
