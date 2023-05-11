<?php

use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\LogViewerController;
use App\Http\Controllers\Admin\PanelController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return to_route('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

Route::middleware('auth')->prefix('/admin')->group(function () {
    // panel
    Route::get('/', [PanelController::class, 'index'])->name('panel');

    // users
    Route::resource('/users', UserController::class);

    // roles
    Route::resource('/roles', RoleController::class);
    Route::get('/create-user-roles/{user}', [UserController::class, 'createUserRoles'])->name('create.user.roles');
    Route::post('/store-user-roles/{user}', [UserController::class, 'storeUserRoles'])->name('store.user.roles');

    // logs
    Route::get('/logs', [LogViewerController::class, 'index'])->name('log-viewer');

    // products
    Route::resource('category', CategoryController::class);
    Route::resource('sliders', SliderController::class);
    Route::resource('brands', BrandController::class);
    Route::resource('colors', ColorController::class);
    Route::resource('products', ProductController::class);
    // Gallery
    Route::controller(GalleryController::class)->group(function () {
        Route::get('create-product-gallery/{product}', 'addGallery')->name('create-product-gallery');
        Route::post('store-product-gallery/{product}', 'storeGallery')->name('store-product-gallery');
    });
});
