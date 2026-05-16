<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SepatuController;
use App\Http\Controllers\KategoriController;

Route::get('/', function () {
    return redirect()->route('sepatu.index');
});

Route::resource('sepatu', SepatuController::class);
Route::resource('kategori', KategoriController::class);