<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FavCoinsController;
use App\Http\Controllers\CoinsController;

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
    Route::post('favourites', [FavCoinsController::class, 'store']);
    Route::delete('favourites/{coin}', [FavCoinsController::class, 'delete']);
    //unused
    Route::get('/fav', [FavCoinsController::class, 'index']);
});

Route::get('/coins', [CoinsController::class, 'index']);
