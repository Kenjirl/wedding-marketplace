<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\WeddingCoupleController;
use App\Http\Controllers\WeddingOrganizerController;
use App\Http\Controllers\WeddingPhotographerController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/masuk');
});

Route::controller(UserController::class)->group(function() {

    Route::middleware(['guest'])->group(function() {
        Route::get ('/masuk',                    'ke_masuk')            ->name('ke_masuk');
        Route::post('/masuk',                    'masuk')               ->name('masuk');

        Route::get ('/daftar',                   'ke_daftar')           ->name('ke_daftar');
        Route::post('/daftar',                   'daftar')              ->name('daftar');
        Route::get ('/verifikasi',               'verifikasi')          ->name('verifikasi');

        Route::get ('/lupa-password',            'ke_lupa_password')    ->name('ke_lupa_password');
        Route::post('/lupa-password',            'lupa_password')       ->name('lupa_password');
        Route::get ('/verifikasi-ubah-password', 'ke_ubah_password')    ->name('ke_ubah_password');
        Route::post('/ubah-password',            'ubah_password')       ->name('ubah_password');

        Route::get('/auth/google',               'redirectToGoogle')    ->name('google_login');
        Route::get('/auth/google/callback',      'handleGoogleCallback')->name('google_callback');
    });

    Route::middleware(['auth'])->group(function() {
        Route::get ('/pilih-peran', 'ke_pilih_peran')->name('ke_pilih_peran');
        Route::post('/pilih-peran', 'pilih_peran')   ->name('pilih_peran');
        Route::post('/keluar',      'keluar')        ->name('keluar');
    });

});

Route::name('wedding-couple.')
    ->prefix('wedding-couple')
    ->middleware('wedding-couple')
    ->controller(WeddingCoupleController::class)->group(function() {

    Route::get('/', 'index')->name('index');
});

Route::name('wedding-organizer.')
    ->prefix('wedding-organizer')
    ->middleware('wedding-organizer')
    ->controller(WeddingOrganizerController::class)->group(function() {

    Route::get('/', 'index')->name('index');
});

Route::name('wedding-photographer.')
    ->prefix('wedding-photographer')
    ->middleware('wedding-photographer')
    ->controller(WeddingPhotographerController::class)->group(function() {

    Route::get('/', 'index')->name('index');
});
