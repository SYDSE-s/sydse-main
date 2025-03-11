<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;
use Illuminate\Routing\Route as RoutingRoute;
use App\Http\Controllers\ActivationController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RegisterMemberController;
use App\Http\Controllers\QrCodeController;

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

// landing page
// Route::get('/', function () {return redirect('/member/register');});
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/home', [HomeController::class, 'index'])->name('home');
// product
Route::get('/product', [ProductController::class, 'index'])->name('product');
Route::get('/product/details{id}', [ProductController::class, 'detail'])->name('product-detail');
Route::post('/product', [ProductController::class, 'search'])->name('search-product');


// auth
Auth::routes();

// Register member
Route::get('/member/register', [RegisterMemberController::class, 'index'])->name('register-member');
Route::post('/member/register', [RegisterMemberController::class, 'create2'])->name('register[post]');
Route::get('/member/register2', [RegisterMemberController::class, 'index2']);

// Activation
Route::get('/activation', [ActivationController::class, 'index']);
Route::post('/activation', [ActivationController::class, 'update'])->name('activation');

// Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('member-data');
Route::get('/dashboard/details{id}', [DashboardController::class, 'details'])->name('member-detail')->middleware('auth');
Route::get('/dashboard/request-verification', [DashboardController::class, 'requestVerif'])->name('request-verification')->middleware('auth');
Route::get('/dashboard/request-verification/{id}', [DashboardController::class, 'requestVerifDetails'])->name('request-verification-details')->middleware('auth');
Route::get('/storage/private/photo{photo}', [DashboardController::class, 'showIdPhoto'])->name('photo')->middleware('auth');
Route::get('/storage/private/selfie{selfie}', [DashboardController::class, 'showIdSelfie'])->name('selfie')->middleware('auth');

// Get region
Route::get('/get-regions', [RegionController::class, 'getRegions']);

// Di routes/web.php
Route::post('/generate-qrcode/{id}', [QrCodeController::class, 'generate'])->name('generate.qrcode');

// Route::post('/api/midtrans/token', 'App\Http\Controllers\MidtransController@getToken');
// Route::post('/api/midtrans/notification', 'App\Http\Controllers\MidtransController@handleNotification');

