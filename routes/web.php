<?php

use Illuminate\Support\Facades\Auth;
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

// Route::get('/', function () {
//     return view('home');
// });

Auth::routes();

//halaman utama
Route::get('/', 'HomeController@index')->name('home');
Route::get('/map', 'MapController@index')->name('map');
Route::get('/kos/detail/{id}', 'MapController@show')->name('map.show');
Route::get('/filter', 'FilterController@index')->name('filter.index');
Route::get('/filter/search', 'FilterController@filter')->name('filter.search');
Route::get('/filter/detail/{kos}', 'FilterController@detail')->name('filter.detail');
Route::get('/havers', 'MapController@haver')->name('haver');

//pemilik
Route::middleware(['auth', 'admin'])->prefix('/pemilik')->group(function () {
    Route::get('/dashboard', 'PemilikController@view')->name('pemilik.dashboard');
    Route::resource('/kos', 'KosController');
    Route::get('/profile', 'UserController@edit')->name('profileP.users');
    Route::patch('/profile/{profil}', 'UserController@update')->name('profileP.update');
    Route::patch('/kamar/slot/{ko}', 'KamarController@slot')->name('slot.update');
    Route::resource('/kamar', 'KamarController');
    Route::get('/kos/{kos}/create/', 'KamarController@create')->name('kamar.create');
    Route::get('/kosme', 'KosController@kosMe')->name('pemilik.kosme');
    Route::get('/dashboard/cari', 'SearchController@searchKos')->name('searchKos');

});

//admin
Route::middleware(['auth', 'can:isAdmin'])->prefix('/admin')->group(function () {
    Route::get('/dashboard', 'AdminController@index')->name('admin.dashboard');
    Route::resource('/universitas', 'UniversitasController');
    Route::resource('/fasilitas', 'FasilitasController');
    Route::get('/profile', 'UserController@edit')->name('profile.users');
    Route::patch('/profile/{profil}', 'UserController@update')->name('profile.update');

    Route::get('/kos', 'KosController@index')->name('admin.indexKos');
    Route::get('/kos/{ko}', 'KosController@show')->name('admin.showKos');
    Route::delete('/kos/{ko}', 'KosController@destroy')->name('admin.destroyKos');

    // Route::delete('/kos', 'KosController@destroy')->name('kos.destroy');
    Route::get('/pemilik', 'AdminController@adPemilik')->name('admin.pemilik');
    Route::delete('/pemilik/{id}', 'PemilikController@destroy')->name('pemilik.destroy');

    //cari
    Route::get('/cariFasilitas', 'SearchController@searchFasilitas')->name('searchFasilitas');
    Route::get('/cariPemilik', 'SearchController@searchPemilik')->name('searchPemilik');
    Route::get('/cariTotalKos', 'SearchController@searchKosA')->name('searchKosA');
    Route::get('/cariUniversitas', 'SearchController@searchUniversitas')->name('searchUniversitas');

});

Route::fallback(function () {
    return redirect()->back();
});
