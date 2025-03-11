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

// test route
Route::get('/test', function() {
    return view('test');
});



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
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');
Route::get('/manage-product', [DashboardController::class, 'manageProduct'])->name('manage-product')->middleware('auth');
Route::get('/add-product', [DashboardController::class, 'addProductV'])->name('add-product-v')->middleware('auth');
Route::post('/add-product', [DashboardController::class, 'addProduct'])->name('add-product')->middleware('auth');
Route::get('/edit-product/{id}', [DashboardController::class, 'editProductV'])->name('edit-product-v')->middleware('auth');
Route::post('/edit-product/{id}', [DashboardController::class, 'editProduct'])->name('edit-product')->middleware('auth');
Route::delete('/delete-product/{id}', [DashboardController::class, 'deleteProduct'])->name('delete-product')->middleware('auth');


Route::get('/dashboard/details{id}', [DashboardController::class, 'details'])->name('member-detail')->middleware('auth');
Route::get('/dashboard/request-verification', [DashboardController::class, 'requestVerif'])->name('request-verification')->middleware('auth');
Route::get('/dashboard/request-verification/{id}', [DashboardController::class, 'requestVerifDetails'])->name('request-verification-details')->middleware('auth');
Route::get('/storage/private/photo{photo}', [DashboardController::class, 'showIdPhoto'])->name('photo')->middleware('auth');
Route::get('/storage/private/selfie{selfie}', [DashboardController::class, 'showIdSelfie'])->name('selfie')->middleware('auth');

// Get region
Route::get('/get-regions', [RegionController::class, 'getRegions']);
