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
    return str_singular('anggota');
    return view('welcome');
});

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware('auth')->prefix('admin')->group(function () {

    Route::get('klasifikasi/data','KlasifikasiController@data')->name('klasifikasi.data');
    Route::resource('klasifikasi','KlasifikasiController');

    Route::get('penerbit/data','PenerbitController@data')->name('penerbit.data');
    Route::resource('penerbit','PenerbitController');

    Route::get('pengarang/data','Pengarangcontroller@data')->name('pengarang.data');
    Route::resource('pengarang','Pengarangcontroller');

    Route::get('buku/data','BukuController@data')->name('buku.data');
    Route::resource('buku','BukuController');

    Route::get('anggota/data','AnggotaController@data')->name('anggota.data');
    Route::resource('anggota','AnggotaController',['parameters' => [
        'anggota' => 'anggota'
    ]]);
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
