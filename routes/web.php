<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EducationContentController;
use App\Http\Controllers\Admin\QuizController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MeasurementController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.landing');
});

Route::get('/detailArtikel', function () {
    return view('pages.detailArtikel');
});
Route::get('/kalkulatorGizi', function () {
    return view('pages.gizi');
});
Route::get('/artikel', [ArticleController::class, 'home'])
    ->name('article.home');
Route::get('/artikel/{category}', [ArticleController::class, 'list'])
    ->name('article.category');

Route::get('/artikel/detail/{slug}', [ArticleController::class, 'detail'])
    ->name('article.detail');

Route::post('/artikel/{id}/pretest', [ArticleController::class, 'submitPretest'])
    ->name('article.pretest.submit');

Route::post('/artikel/{id}/posttest', [ArticleController::class, 'submitPosttest'])
    ->name('article.posttest.submit');



Route::group(['middleware' => 'auth'], function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/measurements', [MeasurementController::class, 'store'])->name('measurements.store');

    Route::group(['middleware' => 'role:admin'], function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/dashboard-data', [DashboardController::class, 'data'])->name('dashboard.data');

        Route::resource('education_contents', EducationContentController::class)->names('education_contents');

        Route::resource('quizzes', QuizController::class)->names('quizzes');
    });
});

Route::middleware('auth')->group(function () {});

require __DIR__ . '/auth.php';
