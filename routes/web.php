<?php

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

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/measurements', [App\Http\Controllers\MeasurementController::class, 'store'])->name('measurements.store');
});

require __DIR__.'/auth.php';
