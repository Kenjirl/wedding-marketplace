<?php

use App\Http\Controllers\Admin\ACategoryController;
use App\Http\Controllers\Admin\AController;
use App\Http\Controllers\Admin\AProfilController;
use App\Http\Controllers\SuperAdmin\SAAdminController;
use App\Http\Controllers\SuperAdmin\SAController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WeddingCouple\WCController;
use App\Http\Controllers\WeddingCouple\WCProfilController;
use App\Http\Controllers\WeddingOrganizer\WOController;
use App\Http\Controllers\WeddingOrganizer\WOProfilController;
use App\Http\Controllers\WeddingPhotographer\WPController;
use App\Http\Controllers\WeddingPhotographer\WPPortofolioController;
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

Route::name('super-admin.')
    ->prefix('super-admin')
    ->middleware('super-admin')->group(function() {

    Route::controller(SAController::class)->group(function() {
        Route::get('/', 'index')->name('index');
    });

    Route::name('daftar-admin.')->prefix('/daftar-admin')
        ->controller(SAAdminController::class)->group(function() {
        Route::get ('/',           'ke_daftar')->name('ke_daftar');
        Route::get ('/tambah',     'ke_tambah')->name('ke_tambah');
        Route::post('/tambah',     'tambah')   ->name('tambah');
        Route::get ('/ubah/{id}',  'ke_ubah')  ->name('ke_ubah');
        Route::post('/ubah/{id}',  'ubah')     ->name('ubah');
        Route::post('/hapus/{id}', 'hapus')    ->name('hapus');
    });

});

Route::name('admin.')
    ->prefix('admin')
    ->middleware('admin')->group(function() {

    Route::controller(AController::class)->group(function() {
        Route::get('/', 'index')->name('index');
    });

    Route::name('profil.')->prefix('/profil')
        ->controller(AProfilController::class)->group(function() {
        Route::get ('/',              'index')           ->name('index');
        Route::get ('/ubah',          'ke_ubah')         ->name('ke_ubah');
        Route::post('/ubah',          'ubah')            ->name('ubah');
        Route::get ('/ubah-password', 'ke_ubah_password')->name('ke_ubah_password');
        Route::post('/ubah-password', 'ubah_password')   ->name('ubah_password');
    });

    Route::name('kategori-pernikahan.')->prefix('/kategori-pernikahan')
        ->controller(ACategoryController::class)->group(function() {
        Route::get ('/',          'index')    ->name('index');
        Route::get ('/tambah',    'ke_tambah')->name('ke_tambah');
        Route::post('/tambah',    'tambah')   ->name('tambah');
        Route::get ('/ubah/{id}', 'ke_ubah')  ->name('ke_ubah');
        Route::post('/ubah{id}',  'ubah')     ->name('ubah');
        Route::post('/hapus{id}', 'hapus')    ->name('hapus');
    });

});

Route::name('wedding-couple.')
    ->prefix('wedding-couple')
    ->middleware('wedding-couple')->group(function() {

    Route::controller(WCController::class)->group(function() {
        Route::get('/', 'index')->name('index');
    });

    Route::name('profil.')->prefix('/profil')
        ->controller(WCProfilController::class)->group(function() {
        Route::get ('/',              'index')           ->name('index');
        Route::get ('/ubah',          'ke_ubah')         ->name('ke_ubah');
        Route::post('/ubah',          'ubah')            ->name('ubah');
        Route::get ('/ubah-password', 'ke_ubah_password')->name('ke_ubah_password');
        Route::post('/ubah-password', 'ubah_password')   ->name('ubah_password');
        Route::get ('/ubah-foto',     'ke_ubah_foto')    ->name('ke_ubah_foto');
        Route::post('/ubah-foto',     'ubah_foto')       ->name('ubah_foto');
    });

    // Hanya bisa diakses jika sudah melengkapi profil wedding couple
    Route::middleware('wc-profil')->group(function() {

    });

});

Route::name('wedding-organizer.')
    ->prefix('wedding-organizer')
    ->middleware('wedding-organizer')->group(function() {

    Route::controller(WOController::class)->group(function() {
        Route::get('/', 'index')->name('index');
    });

    Route::name('profil.')->prefix('/profil')
        ->controller(WOProfilController::class)->group(function() {
        Route::get ('/',              'index')           ->name('index');
        Route::get ('/ubah',          'ke_ubah')         ->name('ke_ubah');
        Route::post('/ubah',          'ubah')            ->name('ubah');
        Route::get ('/ubah-password', 'ke_ubah_password')->name('ke_ubah_password');
        Route::post('/ubah-password', 'ubah_password')   ->name('ubah_password');
        Route::get ('/ubah-foto',     'ke_ubah_foto')    ->name('ke_ubah_foto');
        Route::post('/ubah-foto',     'ubah_foto')       ->name('ubah_foto');
    });

    // Hanya bisa diakses jika sudah melengkapi profil wedding organizer
    Route::middleware('wo-profil')->group(function() {

    });

});

Route::name('wedding-photographer.')
    ->prefix('wedding-photographer')
    ->middleware('wedding-photographer')->group(function() {

    Route::controller(WPController::class)->group(function() {
        Route::get('/', 'index')->name('index');
    });

    Route::name('profil.')->prefix('/profil')
        ->controller(WPProfilController::class)->group(function() {
        Route::get ('/',              'index')           ->name('index');
        Route::get ('/ubah',          'ke_ubah')         ->name('ke_ubah');
        Route::post('/ubah',          'ubah')            ->name('ubah');
        Route::get ('/ubah-password', 'ke_ubah_password')->name('ke_ubah_password');
        Route::post('/ubah-password', 'ubah_password')   ->name('ubah_password');
        Route::get ('/ubah-foto',     'ke_ubah_foto')    ->name('ke_ubah_foto');
        Route::post('/ubah-foto',     'ubah_foto')       ->name('ubah_foto');
    });

    // Hanya bisa diakses jika sudah melengkapi profil wedding photographer
    Route::middleware('wp-profil')->group(function() {

        Route::name('portofolio.')->prefix('/portofolio')
            ->controller(WPPortofolioController::class)->group(function() {
            Route::get ('/',           'index')    ->name('index');
            Route::get ('/tambah',     'ke_tambah')->name('ke_tambah');
            Route::post('/tambah',     'tambah')   ->name('tambah');
            Route::get ('/ubah/{id}',  'ke_ubah')  ->name('ke_ubah');
            Route::post('/ubah/{id}',  'ubah')     ->name('ubah');
            Route::post('/hapus/{id}', 'hapus')    ->name('hapus');
        });

    });

});
