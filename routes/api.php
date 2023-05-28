<?php

use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\HomeApiController;
use App\Http\Controllers\Api\V1\UserApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::prefix('/v1')->group(function () {
    // without auth
    Route::controller(AuthController::class)->group(function () {
        Route::post('send_sms', 'sendSms');
        Route::post('verify_sms_code', 'verifySmsCode');
    });

    Route::get('home', [HomeApiController::class, 'home'])->name('home');

    // with auth
    Route::middleware('auth:sanctum')->group(function () {
        Route::controller(UserApiController::class)->group(function () {
            Route::post('register', 'register');
        });
    });
});
