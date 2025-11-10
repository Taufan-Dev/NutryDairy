<?php

use App\Http\Controllers\AuthController;
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

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
