<?php

use App\Http\Controllers\API\LayananServiceController;
use App\Http\Controllers\API\SparePartControlller;
use App\Http\Controllers\API\TransaksiControlller;
use App\Http\Controllers\API\UserController;
use App\Rating;
use App\StatusKerja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::middleware('auth:sanctum')->group(function(){
    Route::get('user', 'API\UserController@fetchUser');
    Route::post('user', 'API\UserController@updateProfile');
    // Route::get('user', 'UserController@, 'fetch');
    Route::post('logout', 'API\UserController@logout');
    Route::get('transaction/{pelanggan}','API\TransaksiControlller@all');
    Route::post('transaction','API\TransaksiControlller@checkout');
    Route::post('transaction/{id}','API\TransaksiControlller@update');
    Route::get('rating/{id}', 'API\RatingControlller@all');
    Route::post('rating', 'API\RatingControlller@create');
    Route::get('status-kerja/{id}','API\StatusKerjaControlller@all');    
    Route::post('status-kerja/{id}','API\StatusKerjaControlller@update');    
});

Route::post('login', 'API\UserController@login');
Route::post('register', 'API\UserController@register');

Route::get('layanan','API\LayananServiceController@all');
Route::get('sparepart','API\SparePartControlller@all');


Route::post('midtrans/callback', 'API\TransaksiControlller@callback');
