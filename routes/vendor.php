<?php

use App\Http\Controllers\Backend\VendorController;
use App\Http\Controllers\Backend\VendorProductController;
use App\Http\Controllers\Backend\VendorProfileController;
use App\Http\Controllers\Backend\VendorShopProfileController;
use Illuminate\Support\Facades\Route;


/* Vendor Routes */
Route::middleware(['auth', 'role:vendor'])->group(function () {
    Route::get('dashboard', [VendorController::class, 'dashboard'])->name('dashboard');
    Route::get('login', [VendorController::class, 'login'])->name('login');
    Route::get('profile', [VendorProfileController::class, ('index')])->name('profile');


//vendor shop profile Route
Route::resource('shop-profile', VendorShopProfileController::class);



//Child Category Route
Route::get('get-subcategories', [VendorProductController::class, 'getSubCategories'])->name('get-subcategories');
Route::resource('child-category', VendorProductController::class);

Route::resource('sub-category', VendorProductController::class);

//vendor products Route
Route::get('product/get-subcategories', [VendorProductController::class, 'getSubCategories'])->name('product.get-subcategories');
Route::get('product/get-child-categories', [VendorProductController::class, 'getChildCategories'])->name('product.get-child-categories');
Route::post('/vendor/product/calculate-eco-rating', [VendorProductController::class, 'calculateEcoRating'])->name('product.calculate-eco-rating');
Route::resource('products', VendorProductController::class);

});