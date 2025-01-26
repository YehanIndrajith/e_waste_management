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


//vendor products Route
Route::resource('products', VendorProductController::class);

});