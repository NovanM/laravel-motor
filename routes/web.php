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

Route::get('/', function () {
    return redirect()->route('dashboard');
});
Route::get('/home', function () {
    return redirect()->route('dashboard');
});

Auth::routes();

Route::prefix('dashboard')
    ->middleware(['auth:sanctum', 'admin'])
    ->group(function(){
        Route::get('/', 'DashboardController@index')->name('dashboard');
        Route::resource('users', 'UserController');
        Route::resource('mekanik', 'MekanikController');
        Route::resource('supplier', 'SupplierController');
        Route::resource('sparepart', 'SparepartController');
        Route::resource('layanan', 'LayananServiceController');
        Route::resource('rating', 'RatingController');
        Route::get('transaksi', 'TransaksiController@index');
    });

// Route::get('/home', 'HomeController@index')->name('home');
