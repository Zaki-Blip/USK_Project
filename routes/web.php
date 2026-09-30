<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PesertaController;
use App\Http\Controllers\SkemaController;

// Halaman awal → redirect ke login
Route::get('/', fn() => redirect('/login'));

// ==== AREA GUEST (belum login) ====
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

// ==== AREA TERPROTEKSI (wajib login) ====
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Peserta: parameter route dipaksa jadi {peserta}
    Route::resource('peserta', PesertaController::class)
        ->parameters(['peserta' => 'peserta']);

    // Skema: parameter dipaksa {skema}, dan hilangkan method show
    Route::resource('skema', SkemaController::class);
});