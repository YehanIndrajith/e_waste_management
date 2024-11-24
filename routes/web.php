<?php

use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\VendorController;
use App\Http\Controllers\frontend\HomeController;
use App\Http\Controllers\frontend\UserDashboardController;
use App\Http\Controllers\frontend\UserProfileController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\CollectionPointController;

// Public Route
Route::get('/', [HomeController::class, 'index'])->name('home');



// Profile Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// Authentication Routes
require __DIR__.'/auth.php';

//Route::get('admin/login', [AdminController::class, 'showLoginForm'])->name('admin.login');
Route::post('admin/login', [AdminController::class, 'login']);

// User Dashboard (General)
// Route::get('/dashboard', function () {
  
// })->middleware(['auth', 'verified'])->name('dashboard');


Route::group(['middleware' => ['auth', 'verified'], 'prefix' => 'user', 'as' => 'user.'], function () {
    Route::get('dashboard', [UserDashboardController::class, 'index'])->name('dashboard');
    Route::get('profile', [UserProfileController::class, 'index'])->name('profile');

     // Quiz Routes
     Route::get('quiz', [QuizController::class, 'index'])->name('quiz.index');
     Route::post('quiz/submit', [QuizController::class, 'checkAnswers'])->name('quiz.checkAnswers');

      // Collection Point Routes
    Route::get('collection-points', [CollectionPointController::class, 'index'])->name('collectionPoints.index');
   // Route::post('collection-points/nearest', [CollectionPointController::class, 'findNearest'])->name('collectionPoints.nearest');
   Route::match(['get', 'post'], 'collection-points/nearest', [CollectionPointController::class, 'findNearest'])->name('collectionPoints.nearest');
 //  Route::post('collection-points/nearest', [CollectionPointController::class, 'findNearest'])->name('collectionPoints.nearest');
});

//Route::match(['get', 'post'], 'user/collection-points/nearest', [CollectionPointController::class, 'findNearest'])->name('user.collectionPoints.nearest');



