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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin', 'AdminController@admin')->middleware('role:false')
    ->name('admin');
    
Route::get('/overview', 'AdminController@overview')->middleware('role:true')
    ->name('overview');
    
Route::get('/home', 'HomeController@index')->name('home');


Auth::routes();
Route::get('/user/verify/{token}', 'Auth\RegisterController@verifyUser');
Route::get('auth/{provider}', 'Auth\AuthController@redirectToProvider');
Route::get('auth/{provider}/callback', 'Auth\AuthController@handleProviderCallback');


