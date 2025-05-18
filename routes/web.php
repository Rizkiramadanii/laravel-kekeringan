<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PredictionController;
use App\Http\Controllers\HasilController;
use App\Http\Controllers\AboutController;

// Redirect root URL to login
Route::get('/', function () {
    return view('welcome'); // Sesuai dengan nama file welcome.blade.php
});

// Login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'processLogin'])->name('processLogin');

// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Grup rute yang hanya bisa diakses oleh admin yang login
Route::middleware('auth:admin')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Prediksi
    Route::get('/prediksi', [PredictionController::class, 'index'])->name('prediksi');
    Route::post('/prediksi', [PredictionController::class, 'prediksi'])->name('prediksi.prediksi');
    Route::get('/hasil', [PredictionController::class, 'hasil'])->name('hasil');
    Route::post('/prediksi/import', [PredictionController::class, 'import'])->name('prediksi.import');


    // Menyimpan hasil prediksi ke tabel
    Route::post('/hasil/simpan', [HasilController::class, 'simpan'])->name('hasil.simpan');
    Route::get('/hasil/index', [HasilController::class, 'index'])->name('hasil.index');
    Route::get('/hasil/{id}', [HasilController::class, 'show'])->name('hasil.show');
    Route::delete('/hasil/{id}', [HasilController::class, 'destroy'])->name('hasil.delete');

    // Tentang Aplikasi
    Route::get('/about', [AboutController::class, 'index'])->name('about');
});
