<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/me', [AuthController::class, 'me']);
});

Route::post('favourites', [\App\Http\Controllers\FavCoinsController::class, 'store']);
Route::get('/fav', [App\Http\Controllers\FavCoinsController::class, 'index']);

Route::get('/coins', [\App\Http\Controllers\CoinsController::class, 'index']);
