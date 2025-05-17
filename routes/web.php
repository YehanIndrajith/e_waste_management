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
use App\Http\Controllers\BeginnerQuizController;
use App\Http\Controllers\EwasteController;
use App\Http\Controllers\Frontend\FrontendCollectionPointController;
use App\Http\Controllers\Frontend\FrontendProductController;
use App\Http\Controllers\ImageMatchingController;
use App\Http\Controllers\IntermediateImageMatchingQuizController;
use App\Http\Controllers\IntermediateQuizController;
use App\Http\Controllers\ProImageMatchingController;
use App\Http\Controllers\ProTriviaQuizController;
use App\Http\Controllers\PuzzleGameController;
use App\Http\Controllers\RepairShopController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\SecondPhaseQuizController;
use App\Models\IntermediateQuiz;

// Public Route
Route::get('/', [HomeController::class, 'index'])->name('home');



// Profile Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/reviews/{collectionPointId}', [ReviewController::class, 'index'])->name('reviews.index');
    Route::post('/reviews/{collectionPointId}', [ReviewController::class, 'store'])->name('reviews.store');
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

    Route::prefix('quiz/second-phase')->name('quiz.second-phase.')->group(function () {
        Route::any('/', [SecondPhaseQuizController::class, 'showQuiz'])->name('show');
        Route::post('/submit', [SecondPhaseQuizController::class, 'submitQuiz'])->name('submit');
        Route::get('/result', function () {
            return view('frontend.activities.quiz-results');
        })->name('result');
    });


    Route::prefix('activities')->name('activities.')->group(function () {
        Route::prefix('beginner')->name('beginner.')->group(function () {
            // Quiz Routes
            Route::get('quiz', [BeginnerQuizController::class, 'index'])->name('quiz.index');
            Route::post('quiz/submit', [BeginnerQuizController::class, 'checkAnswers'])->name('quiz.checkAnswers');

            // Image Matching Routes
            Route::get('image-matching', [ImageMatchingController::class, 'showImageMatchingForm'])->name('image-matching');
            Route::post('image-matching/checkAnswers', [ImageMatchingController::class, 'checkAnswers'])->name('image-matching.checkAnswers');

        });
    });
    
  
    
         // Quiz Routes
         Route::get('quiz', [QuizController::class, 'index'])->name('quiz.index');
         Route::post('quiz/submit', [QuizController::class, 'checkAnswers'])->name('quiz.checkAnswers');
    
         // Beginner Level Activities (Quiz)
         Route::prefix('activities')->name('activities.')->group(function () {
          Route::prefix('beginner')->name('beginner.')->group(function () {
              Route::get('quiz', [BeginnerQuizController::class, 'index'])->name('quiz');
              Route::post('quiz/submit', [BeginnerQuizController::class, 'checkAnswers'])->name('quiz.checkAnswers');

              Route::get('puzzle', [PuzzleGameController::class, 'showBeginnerPuzzle'])->name('puzzle');
            //   Route::get('second-phase-quiz', [SecondPhaseQuizController::class, 'showBeginnerQuiz'])->name('second-phase.quiz');
            // // Route::post('second-phase-quiz/submit', [SecondPhaseQuizController::class, 'submitBeginnerQuiz'])->name('second-phase.quiz.results');
            
          });
      });
    
     // Intermediate Level Activities (Quiz)
     Route::prefix('activities')->name('activities.')->group(function () {
        Route::prefix('intermediate')->name('intermediate.')->group(function () {
            Route::get('quiz', [IntermediateQuizController::class, 'index'])->name('quiz');
            Route::post('quiz/submit', [IntermediateQuizController::class, 'checkAnswers'])->name('quiz.checkAnswers');

            // Image Matching Routes
            Route::get('image-matching', [IntermediateImageMatchingQuizController::class, 'showImageMatchingForm'])->name('image-matching');

            Route::get('puzzle', [PuzzleGameController::class, 'showIntermediatePuzzle'])->name('puzzle');

            // Route::get('second-phase-quiz', [SecondPhaseQuizController::class, 'showIntermediateQuiz'])->name('second-phase.quiz');
            // Route::post('second-phase-quiz/submit', [SecondPhaseQuizController::class, 'submitIntermediateQuiz'])->name('second-phase.quiz.results');
        });

        Route::middleware(['auth', 'verified'])->prefix('user/activities')->name('user.activities.')->group(function () {
            Route::prefix('intermediate')->name('intermediate.')->group(function () {
                Route::get('puzzle', [PuzzleGameController::class, 'showIntermediatePuzzle'])->name('puzzle');
            });
        });

        //pro
        Route::prefix('pro')->name('pro.')->group(function () {
            Route::get('trivia', [ProTriviaQuizController::class, 'index'])->name('trivia.index');
            Route::post('trivia/submit', [ProTriviaQuizController::class, 'checkAnswers'])->name('trivia.submit');

            Route::get('image-matching', [ProImageMatchingController::class, 'showImageMatchingForm'])->name('image-matching');

            Route::get('puzzle', [PuzzleGameController::class, 'showProPuzzle'])->name('puzzle');

            // Route::get('second-phase-quiz', [SecondPhaseQuizController::class, 'showProQuiz'])->name('second-phase.quiz');
            // Route::post('second-phase-quiz/submit', [SecondPhaseQuizController::class, 'submitProQuiz'])->name('second-phase.quiz.submit');
        });
        
    
        
    });

    // Route::get('quiz/results/{level}/{score}', [SecondPhaseQuizController::class, 'showResults'])->name('quiz.results');
    

      // Collection Point Routes
    Route::get('collection-points', [CollectionPointController::class, 'index'])->name('collectionPoints.index');
   // Route::post('collection-points/nearest', [CollectionPointController::class, 'findNearest'])->name('collectionPoints.nearest');
   Route::match(['get', 'post'], 'collection-points/nearest', [CollectionPointController::class, 'findNearest'])->name('collectionPoints.nearest');
 //  Route::post('collection-points/nearest', [CollectionPointController::class, 'findNearest'])->name('collectionPoints.nearest');
});






//Route::match(['get', 'post'], 'user/collection-points/nearest', [CollectionPointController::class, 'findNearest'])->name('user.collectionPoints.nearest');

//product details Routes
// Route::get('/search',[FrontendProductController::class, 'search'])->name('products.search');

Route::get('product-detail/{slug}', [FrontendProductController::class, 'showProduct'])->name('product-detail');

Route::get('/show-collection-points', [FrontendCollectionPointController::class, 'index'])->name('frontend.show-collection-points.index');

Route::match(['get', 'post'], 'show-collection-points/nearest', [FrontendCollectionPointController::class, 'findNearest'])->name('frontend.show-collection-points.nearest');

Route::get('/repair-shops', [RepairShopController::class, 'show'])->name('repair.shops');
// Route::get('/detect', function () {
//     return view('frontend.home.detect');
// })->name('detect.view');

Route::post('/detect-image', [EwasteController::class, 'detectEwaste'])
    ->name('detect.image');