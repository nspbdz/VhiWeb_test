<?php

use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\PhotoController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'create']);
    Route::get('/photos', [PhotoController::class, 'getAll']);
    Route::get('/photos/{id}', [PhotoController::class, 'detail']);

    Route::group(['middleware' => 'auth:sanctum'], function () {
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::get('/profile', [AuthController::class, 'profile']);
        Route::post('/photos', [PhotoController::class, 'create']);
        Route::put('/photos/{id}', [PhotoController::class, 'update']);
        Route::delete('/photos/{id}', [PhotoController::class, 'delete']);
        Route::post('/photos/{id}/like', [PhotoController::class, 'like']);
        Route::post('/photos/{id}/unlike', [PhotoController::class, 'unlike']);



    });
});
