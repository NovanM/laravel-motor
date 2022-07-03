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
    Route::get('user', [UserController::class, 'fetch']);
    Route::post('user', [UserController::class, 'updateProfile']);
    // Route::get('user', [UserController::class, 'fetch']);
    Route::post('logout', [UserController::class, 'logout']);
    Route::get('transaction',[TransaksiControlller::class, 'all']);
    Route::post('transaction/{id}',[TransaksiControlller::class, 'update']);
    Route::get('rating', [Rating::class], 'all');
    Route::get('status-kerja',[StatusKerja::class, 'all']);    
});

Route::post('login', 'API\UserController@login');
Route::post('register', 'API\UserController@register');

Route::get('layanan',[LayananServiceController::class, 'all']);
Route::get('sparepart',[SparePartControlller::class, 'all']);
