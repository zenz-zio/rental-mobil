<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MobilController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserMobilController;
use App\Http\Controllers\RentalController;
use App\Http\Controllers\PembayaranController;

Route::get('/', fn () => view('layouts.landing'))->name('home');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('store.login');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('store.register');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->prefix('user')->name('user.')->group(function () {
    Route::get('/', [UserController::class, 'dashboard'])->name('dashboard');
    Route::get('/mobil', [UserMobilController::class, 'index'])->name('mobil.index');
    Route::get('/mobil/{mobil}/rental', [UserMobilController::class, 'createRental'])->name('mobil.rental');
    Route::post('/rental', [UserMobilController::class, 'storeRental'])->name('rental.store');
    Route::get('/rental', [UserMobilController::class, 'rentalSaya'])->name('rental.index');

    Route::get('/profil', [UserController::class, 'profil'])->name('profil');
    Route::put('/profil', [UserController::class, 'updateProfil'])->name('profil.update'); // ← baris baru

    Route::get('/pembayaran/{rental}', [PembayaranController::class, 'show'])
        ->name('pembayaran.show');

    Route::post('/pembayaran/{rental}/success', [PembayaranController::class, 'success'])
        ->name('pembayaran.success');

    Route::post('/pembayaran/{rental}/check-status', [PembayaranController::class, 'checkStatus'])
        ->name('pembayaran.checkStatus');
});

// Webhook Midtrans tetap dipertahankan untuk server online.
Route::post('/midtrans/notification', [PembayaranController::class, 'notification'])
    ->name('midtrans.notification');

Route::middleware(['auth', 'role'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::resource('mobil', MobilController::class);
    Route::resource('pelanggan', PelangganController::class);
    Route::resource('rental', RentalController::class);
});