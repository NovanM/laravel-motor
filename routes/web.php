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
        Route::patch('mekanik/{id}', 'MekanikController@deactivate')->name('mekanik-deactivate');
        Route::resource('mekanik', 'MekanikController');
        Route::resource('supplier', 'SupplierController');
        Route::resource('sparepart', 'SparepartController');
        Route::resource('layanan', 'LayananServiceController');
        Route::resource('rating', 'RatingController');
        Route::resource('status', 'StatusKerjaController');
        Route::resource('surattugas', 'SuratTugasController');
        Route::get('transaksi', 'TransaksiController@index');
        Route::get('transaksi/pesanan', 'TransaksiController@periodic')->name('periode');
        Route::get('transaksi/download', 'TransaksiController@exportExcel')->name('download-transaksi');
        Route::get('transaksi/layanan', 'TransaksiController@byLayanan')->name('transaksi-layanan');
        Route::get('transaksi/sparepart', 'TransaksiController@bySparepart')->name('transaksi-sparepart');
    });

// Route::get('/home', 'HomeController@index')->name('home');
Route::get('midtrans/success/', 'TransaksiController@success');
Route::get('midtrans/unfinish/', 'TransaksiController@unfinish');
Route::get('midtrans/error/', 'TransaksiController@error');
