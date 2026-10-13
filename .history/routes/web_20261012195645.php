<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PesertaController;
use App\Http\Controllers\SkemaController;

// Halaman Awal (publik)
Route::view('/', 'halamanAwal')->name('halamanAwal');
Route::resource('peserta', PesertaController::class)->parameters(['peserta' => 'peserta']); 
// Area Guest (belum login)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// Area Terproteksi (sudah login)
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::middleware('role:admin')->group(function () {
        Route::resource('peserta', PesertaController::class)->parameters(['peserta' => 'peserta']);
        Route::resource('skema', SkemaController::class);
    });
});