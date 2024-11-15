<?php

use App\Http\Controllers\Backend\VendorController;
use App\Http\Controllers\Backend\VendorProfileController;
use Illuminate\Support\Facades\Route;


/* Vendor Routes */
Route::middleware(['auth', 'role:vendor'])->group(function () {
    Route::get('dashboard', [VendorController::class, 'dashboard'])->name('dashboard');
    Route::get('login', [VendorController::class, 'login'])->name('login');
    Route::get('profile', [VendorProfileController::class, ('index')])->name('profile');
});