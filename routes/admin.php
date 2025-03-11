<?php

use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\AdminVendorProfileController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ChildCategoryController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\SellerProductController;
use App\Http\Controllers\Backend\SettingController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\HomePageSettingController;
use Illuminate\Support\Facades\Route;

// In routes/admin.php

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('login', [AdminController::class, 'login'])->name('login');
});

//profile route
Route::get('profile', [ProfileController::class, 'index'])->name('profile');
Route::post('profile/update', [ProfileController::class, 'updateProfile'])->name('profile.update');
Route::post('profile/update/password', [ProfileController::class, 'updatePassword'])->name('password.update');

//Slider Route
Route::resource('slider', SliderController::class);

//Category Route
Route::resource('category', CategoryController::class);

//Sub Category Route
Route::resource('sub-category', SubCategoryController::class);

//Child Category Route
Route::get('get-subcategories', [ChildCategoryController::class, 'getSubCategories'])->name('get-subcategories');
Route::resource('child-category', ChildCategoryController::class);

//vendor profile Route
Route::resource('vendor-profile', AdminVendorProfileController::class);

//Product Routes
Route::get('product/get-subcategories', [ProductController::class, 'getSubCategories'])->name('product.get-subcategories');
Route::get('product/get-child-categories', [ProductController::class, 'getChildCategories'])->name('product.get-child-categories');
Route::post('/admin/product/calculate-eco-rating', [ProductController::class, 'calculateEcoRating'])->name('product.calculate-eco-rating');
Route::resource('products', ProductController::class);

//seller product routes
Route::get('seller-products', [SellerProductController::class, 'index'])->name('seller-products.index');
Route::get('seller-pending-products', [SellerProductController::class, 'pendingProducts'])->name('seller-pending-products.index');
Route::put('change-approve-status', [SellerProductController::class, 'changeApproveStatus'])->name('change-approve-status');

//Setting Routes
Route::get('settings', [SettingController::class,'index'])->name('settings.index');
Route::put('general-setting-update', [SettingController::class,'generalSettingUpdate'])->name('general-setting-update');

//Home Page Setting Routes
Route::get('home-page-setting', [HomePageSettingController::class,'index'])->name('home-page-setting');
Route::put('selling-category-section', [HomePageSettingController::class,'updateSellingCategorySection'])->name('selling-category-section');
Route::put('product-slider-section-one', [HomePageSettingController::class,'updateProductSliderSectionOne'])->name('product-slider-section-one');
