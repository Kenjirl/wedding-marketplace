<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\WeddingCoupleController;
use App\Http\Controllers\WeddingOrganizerController;
use App\Http\Controllers\WeddingPhotographerController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/masuk');
});

Route::middleware(['guest'])->group(function() {
    Route::get ('/masuk',                    [UserController::class, 'ke_masuk'])            ->name('ke_masuk');
    Route::post('/masuk',                    [UserController::class, 'masuk'])               ->name('masuk');

    Route::get ('/daftar',                   [UserController::class, 'ke_daftar'])           ->name('ke_daftar');
    Route::post('/daftar',                   [UserController::class, 'daftar'])              ->name('daftar');
    Route::get ('/verifikasi',               [UserController::class, 'verifikasi'])          ->name('verifikasi');

    Route::get ('/lupa-password',            [UserController::class, 'ke_lupa_password'])    ->name('ke_lupa_password');
    Route::post('/lupa-password',            [UserController::class, 'lupa_password'])       ->name('lupa_password');
    Route::get ('/verifikasi-ubah-password', [UserController::class, 'ke_ubah_password'])    ->name('ke_ubah_password');
    Route::post('/ubah-password',            [UserController::class, 'ubah_password'])       ->name('ubah_password');

    Route::get('/auth/google',               [UserController::class, 'redirectToGoogle'])    ->name('google_login');
    Route::get('/auth/google/callback',      [UserController::class, 'handleGoogleCallback'])->name('google_callback');
});

Route::middleware(['auth'])->group(function() {
    Route::get ('/pilih-peran', [UserController::class, 'ke_pilih_peran'])->name('ke_pilih_peran');
    Route::post('/pilih-peran', [UserController::class, 'pilih_peran'])   ->name('pilih_peran');
    Route::post('/keluar',      [UserController::class, 'keluar'])        ->name('keluar');
});

Route::prefix('wedding-couple')->name('wedding-couple.')->middleware('wedding-couple')->group(function() {
    Route::get('/', [WeddingCoupleController::class, 'index'])->name('index');
});

Route::prefix('wedding-organizer')->name('wedding-organizer.')->middleware('wedding-organizer')->group(function() {
    Route::get('/', [WeddingOrganizerController::class, 'index'])->name('index');
});

Route::prefix('wedding-photographer')->name('wedding-photographer.')->middleware('wedding-photographer')->group(function() {
    Route::get('/', [WeddingPhotographerController::class, 'index'])->name('index');
});
