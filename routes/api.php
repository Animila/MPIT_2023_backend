<?php

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

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {return $request->user();});
    Route::prefix('/culture')->group(function () {
        Route::get('/get', [\App\Http\Resources\CultureBaseController::class, 'index']);
        Route::get('/get/{id}', [\App\Http\Resources\CultureBaseController::class, 'show']);
        Route::middleware(['admin'])->group(function () {
            Route::post('/create', [\App\Http\Resources\CultureBaseController::class, 'store']);
            Route::put('/update/{id}', [\App\Http\Resources\CultureBaseController::class, 'update']);
            Route::delete('/delete/{id}', [\App\Http\Resources\CultureBaseController::class, 'destroy']);
        });
    });

    Route::prefix('/rating')->group(function () {
        Route::get('/get', [\App\Http\Resources\RatingController::class, 'index']);
        Route::get('/get/{id}', [\App\Http\Resources\RatingController::class, 'show']);
        Route::middleware(['admin'])->group(function () {
            Route::post('/create', [\App\Http\Resources\RatingController::class, 'store']);
            Route::put('/update/{id}', [\App\Http\Resources\RatingController::class, 'update']);
            Route::delete('/delete/{id}', [\App\Http\Resources\RatingController::class, 'destroy']);
        });
    });

    Route::prefix('/bonus')->group(function () {
        Route::get('/get', [\App\Http\Controllers\BonusController::class, 'index']);
        Route::get('/get/{id}', [\App\Http\Controllers\BonusController::class, 'show']);
        Route::middleware(['admin'])->group(function () {
            Route::post('/create', [\App\Http\Controllers\BonusController::class, 'store']);
            Route::put('/update/{id}', [\App\Http\Controllers\BonusController::class, 'update']);
            Route::delete('/delete/{id}', [\App\Http\Controllers\BonusController::class, 'destroy']);
        });
    });

});

Route::post('/register', 'AuthController@register');
Route::post('/login', 'AuthController@login');



