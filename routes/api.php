<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\BootController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AmmartController;
use App\Http\Controllers\HalqaController;
use App\Http\Controllers\StudantController;

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

Route::get('/boot', [BootController::class, 'bootSetting']);

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Protected routes
Route::group(['middleware' => ['auth:sanctum']], function () {

    // Route::group(['middleware' => 'role:1'], function () {
    // });

    Route::group(['middleware' => 'role:1,2'], function () {
        Route::get('/ammart/list', [AmmartController::class, 'index']);
        Route::post('/ammart/create', [AmmartController::class, 'store']);
        Route::post('/ammart/update/{id}', [AmmartController::class, 'update']);
        Route::post('/ammart/delete/{id}', [AmmartController::class, 'destroy']);
    });

    Route::group(['middleware' => 'role:1,2,3'], function () {
        Route::get('/users', [UserController::class, 'list']);
        Route::get('/user/status/{id}', [UserController::class, 'updateStatus']);

        Route::get('/halqa/list', [HalqaController::class, 'index']);
        Route::post('/halqa/create', [HalqaController::class, 'store']);
        Route::post('/halqa/update/{id}', [HalqaController::class, 'update']);
        Route::post('/halqa/delete/{id}', [HalqaController::class, 'destroy']);
    });

    Route::get('/studant/list', [StudantController::class, 'index']);
    Route::post('/studant/create', [StudantController::class, 'store']);
    Route::post('/studant/update/{id}', [StudantController::class, 'update']);
    Route::post('/studant/delete/{id}', [StudantController::class, 'destroy']);

    Route::get('/user/update/{id}', [UserController::class, 'update']);
    Route::post('/logout', [AuthController::class, 'logout']);
});
