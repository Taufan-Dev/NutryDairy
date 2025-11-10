<?php

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
