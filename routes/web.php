<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;
use Illuminate\Routing\Route as RoutingRoute;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RegisterMemberController;
use App\Http\Controllers\QrCodeController;
use App\Http\Controllers\KTAController;

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

// test route (test feature purposes)
Route::get('/test', function() {
    return view('test');
});


// auth
Auth::routes();

// landing page
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/home', [HomeController::class, 'index'])->name('home');

// product
Route::get('/product', [ProductController::class, 'index'])->name('product');
Route::get('/product/details{id}', [ProductController::class, 'detail'])->name('product-detail');
Route::post('/search-product', [ProductController::class, 'search'])->name('search-product');

// Register member
Route::get('/member/register', [RegisterMemberController::class, 'index'])->name('register-member');
Route::post('/member/register', [RegisterMemberController::class, 'create'])->name('register[post]');

// Dashboard
Route::middleware(['auth'])->group(function() {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/manage-product', [DashboardController::class, 'manageProduct'])->name('manage-product');
    Route::get('/add-product', [DashboardController::class, 'addProductV'])->name('add-product-v');
    Route::post('/add-product', [DashboardController::class, 'addProduct'])->name('add-product');
    Route::get('/edit-product/{id}', [DashboardController::class, 'editProductV'])->name('edit-product-v');
    Route::post('/edit-product/{id}', [DashboardController::class, 'editProduct'])->name('edit-product');
    Route::delete('/delete-product/{id}', [DashboardController::class, 'deleteProduct'])->name('delete-product');
});

// Get region
Route::get('/get-regions', [RegionController::class, 'getRegions']);

// Di routes/web.php
Route::post('/generate-qrcode/{id}', [QrCodeController::class, 'generate'])->name('generate.qrcode');

// Route::post('/api/midtrans/token', 'App\Http\Controllers\MidtransController@getToken');
// Route::post('/api/midtrans/notification', 'App\Http\Controllers\MidtransController@handleNotification');

