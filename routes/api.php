<?php

use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\HomeApiController;
use App\Http\Controllers\Api\V1\PaymentApiController;
use App\Http\Controllers\Api\V1\ProductApiController;
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

    Route::controller(ProductApiController::class)->group(function () {
        Route::get('most_sold_products', 'most_sold_products');
        Route::get('most_viewed_products', 'most_viewed_products');
        Route::get('newest_products', 'newest_products');
        Route::get('cheapest_products', 'cheapest_products');
        Route::get('most_expensive_products', 'most_expensive_products');
        Route::get('products_by_category/{category}', 'products_by_category');
        Route::get('products_by_brand/{brand}', 'products_by_brand');
        Route::get('product_details/{product}', 'product_detail');
        Route::post('search_product', 'search_product');
    });

    Route::get('payment/callback', [PaymentApiController::class, 'callback']);

    // with auth
    Route::middleware('auth:sanctum')->group(function () {
        Route::controller(UserApiController::class)->group(function () {
            Route::post('register', 'register');
            Route::post('profile', 'profile');
        });

        Route::controller(ProductApiController::class)->group(function () {
            Route::post('save_product_comment/{product}', 'saveComment');
        });

        Route::controller(PaymentApiController::class)->group(function () {
            Route::post('payment', 'payment')->name('payment');
        });

    });
});
