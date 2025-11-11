<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\SiswaController;

Route::get('/', [SiswaController::class, 'index'])->name('home');
Route::resource('kelas', KelasController::class);
Route::resource('siswa', SiswaController::class);
