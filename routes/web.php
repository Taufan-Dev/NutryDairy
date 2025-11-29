<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\MeasurementController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.landing');
});

Route::get('/artikel', function () {
    return view('pages.artikel');
});
Route::get('/detailArtikel', function () {
    return view('pages.detailArtikel');
});
Route::get('/kalkulatorGizi', function () {
    return view('pages.gizi');
});


Route::group(['middleware' => 'auth'], function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/measurements', [MeasurementController::class, 'store'])->name('measurements.store');
    
    Route::group(['middleware' => 'role:admin'], function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/dashboard-data', [DashboardController::class, 'data'])->name('dashboard.data');
    });
});

Route::middleware('auth')->group(function () {});

require __DIR__ . '/auth.php';
