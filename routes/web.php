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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware('auth')->prefix('admin')->group(function () {

    Route::prefix('klasifikasi')->group(function (){
        Route::get('data','KlasifikasiController@data')->name('klasifikasi.data');
        Route::resource('klasifikasi','KlasifikasiController')->names('klasifikasi');
    });
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
