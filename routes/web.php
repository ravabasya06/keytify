<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExampleController;
use App\Http\Controllers\AuthenticatedSessionController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductListController;
use App\Http\Controllers\BrandListController;
use App\Http\Controllers\CategoryListController;
use App\Http\Controllers\UserListController;
use App\Http\Controllers\ReviewListController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\UserAddressController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderDetailsController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::inertia('/about', 'About')->name('about');
Route::get('/item/{slug}', [ItemController::class, 'index']);
Route::get('/shop', [ShopController::class, 'index'])->name('search');
Route::get('/shop/{slug}', [ShopController::class, 'filter'])->name('filter');
Route::get('/brand/{slug}', [BrandController::class, 'index']);
Route::get('/cart', [CartController::class, 'index']);
Route::post('/cart/add/{id}', [CartController::class, 'store'])->name('cart.store');
Route::put('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/destroy/{id}', [CartController::class, 'destroy'])->name('cart.destroy');
Route::delete('/cart/purge', [CartController::class, 'purge'])->name('cart.purge');
Route::get('/checkout', [CheckoutController::class, 'index']);
Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
Route::get('/order', [OrderDetailsController::class, 'index'])->name('orderdetails');
Route::get('/order/{id}', [OrderDetailsController::class, 'details'])->name('orderdetails.details');

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);
    // Product List
    Route::get('/product-list', [ProductListController::class, 'index'])->name('productlist.search');
    Route::get('/product-list/{slug}', [ProductListController::class, 'filter'])->name('productlist.filter');
    Route::post('/product-list', [ProductListController::class, 'store'])->name('productlist.store');
    Route::put('/product-list/update/{id}', [ProductListController::class, 'update'])->name('productlist.update');
    Route::delete('/product-list/destroy/{id}', [ProductListController::class, 'destroy'])->name('productlist.destroy');
    // Brand List
    Route::get('/brand-list', [BrandListController::class, 'index'])->name('brandlist.search');
    Route::get('/brand-list/{slug}', [BrandListController::class, 'filter'])->name('brandlist.filter');
    Route::post('/brand-list', [BrandListController::class, 'store'])->name('brandlist.store');
    Route::put('/brand-list/update/{id}', [BrandListController::class, 'update'])->name('brandlist.update');
    Route::delete('/brand-list/destroy/{id}', [BrandListController::class, 'destroy'])->name('brandlist.destroy');
    // Category List
    Route::get('/category-list', [CategoryListController::class, 'index'])->name('categorylist.search');
    Route::get('/category-list/{slug}', [CategoryListController::class, 'filter'])->name('categorylist.filter');
    Route::post('/category-list', [CategoryListController::class, 'store'])->name('categorylist.store');
    Route::put('/category-list/update/{id}', [CategoryListController::class, 'update'])->name('categorylist.update');
    Route::delete('/category-list/destroy/{id}', [CategoryListController::class, 'destroy'])->name('categorylist.destroy');
    // User List
    Route::get('/user-list', [UserListController::class, 'index'])->name('userlist.search');
    Route::get('/user-list/{slug}', [UserListController::class, 'filter'])->name('userlist.filter');
    // Review List
    Route::get('/review-list', [ReviewListController::class, 'index'])->name('reviewlist.search');
    Route::get('/review-list/{slug}', [ReviewListController::class, 'filter'])->name('reviewlist.filter');
    Route::post('/review-list', [ReviewListController::class, 'store'])->name('reviewlist.store');
    Route::put('/review-list/update/{id}', [ReviewListController::class, 'update'])->name('reviewlist.update');
    Route::delete('/review-list/destroy/{id}', [ReviewListController::class, 'destroy'])->name('reviewlist.destroy');

});

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/logout', [ProfileController::class, 'logout'])->name('logout');
    Route::post('/profile/address', [UserAddressController::class, 'store'])->name('address.store');
    Route::put('/profile/address/{id}', [UserAddressController::class, 'update'])->name('address.update');
    Route::delete('/profile/address', [UserAddressController::class, 'destroy'])->name('address.destroy');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthenticatedSessionController::class, 'index'])->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store']);
    Route::get('/register', [RegisteredUserController::class, 'index'])->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store']);
});