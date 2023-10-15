<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\WeddingCouple\WCController;
use App\Http\Controllers\WeddingOrganizer\WOController;
use App\Http\Controllers\WeddingPhotographer\WPController;
use App\Http\Controllers\WeddingPhotographer\WPProfilController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/masuk');
});

Route::controller(UserController::class)->group(function() {

    Route::middleware(['guest'])->group(function() {
        Route::get ('/masuk', 'ke_masuk')->name('ke_masuk');
        Route::post('/masuk', 'masuk')   ->name('masuk');

        Route::get ('/daftar',     'ke_daftar') ->name('ke_daftar');
        Route::post('/daftar',     'daftar')    ->name('daftar');
        Route::get ('/verifikasi', 'verifikasi')->name('verifikasi');

        Route::get ('/lupa-password',            'ke_lupa_password')->name('ke_lupa_password');
        Route::post('/lupa-password',            'lupa_password')   ->name('lupa_password');
        Route::get ('/verifikasi-ubah-password', 'ke_ubah_password')->name('ke_ubah_password');
        Route::post('/ubah-password',            'ubah_password')   ->name('ubah_password');

        Route::get('/auth/google',          'redirectToGoogle')    ->name('google_login');
        Route::get('/auth/google/callback', 'handleGoogleCallback')->name('google_callback');
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
    ->controller(WCController::class)->group(function() {

    Route::get('/', 'index')->name('index');

});

Route::name('wedding-organizer.')
    ->prefix('wedding-organizer')
    ->middleware('wedding-organizer')
    ->controller(WOController::class)->group(function() {

    Route::get('/', 'index')->name('index');

});

Route::name('wedding-photographer.')
    ->prefix('wedding-photographer')
    ->middleware('wedding-photographer')->group(function() {

    Route::controller(WPController::class)->group(function() {
        Route::get('/', 'index')->name('index');
    });

    Route::prefix('/profil')
        ->controller(WPProfilController::class)->group(function() {
        Route::get ('/',              'ke_profil')       ->name('ke_profil');
        Route::get ('/ubah-profil',   'ke_ubah_profil')  ->name('ke_ubah_profil');
        Route::post('/ubah-profil',   'ubah_profil')     ->name('ubah_profil');
        Route::get ('/ubah-password', 'ke_ubah_password')->name('ke_ubah_password');
        Route::post('/ubah-password', 'ubah_password')   ->name('ubah_password');
    });

});
