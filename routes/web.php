<?php

use App\Http\Controllers\Admin\AController;
use App\Http\Controllers\Admin\AEventController;
use App\Http\Controllers\Admin\AJenisVendorController;
use App\Http\Controllers\Admin\APortofolioController;
use App\Http\Controllers\Admin\AProfilController;
use App\Http\Controllers\SuperAdmin\SAAdminController;
use App\Http\Controllers\SuperAdmin\SAController;
use App\Http\Controllers\User\TemplateController;
use App\Http\Controllers\User\UBookingController;
use App\Http\Controllers\User\UController;
use App\Http\Controllers\User\UGuestController;
use App\Http\Controllers\User\UInvitationController;
use App\Http\Controllers\User\UProfileController;
use App\Http\Controllers\User\UTransactionController;
use App\Http\Controllers\User\UWeddingController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Vendor\VBookingController;
use App\Http\Controllers\Vendor\VController;
use App\Http\Controllers\Vendor\VPortfolioController;
use App\Http\Controllers\Vendor\VProfileController;
use App\Http\Controllers\Vendor\VRevenueController;
use App\Http\Controllers\Vendor\VReviewController;
use App\Http\Controllers\Vendor\VScheduleController;
use App\Http\Controllers\Vendor\VServiceController;
use Illuminate\Support\Facades\Route;

Route::controller(UserController::class)->group(function() {

    Route::middleware(['guest'])->group(function() {
        Route::get ('/',      'index')   ->name('index');
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

    Route::name('event-pernikahan.')->prefix('/master/event-pernikahan')
        ->controller(AEventController::class)->group(function() {
        Route::get ('/',          'index')    ->name('index');
        Route::get ('/tambah',    'ke_tambah')->name('ke_tambah');
        Route::post('/tambah',    'tambah')   ->name('tambah');
        Route::get ('/ubah/{id}', 'ke_ubah')  ->name('ke_ubah');
        Route::post('/ubah{id}',  'ubah')     ->name('ubah');
        Route::post('/hapus{id}', 'hapus')    ->name('hapus');
    });

    Route::name('jenis-vendor.')->prefix('/master/jenis-vendor')
        ->controller(AJenisVendorController::class)->group(function() {
        Route::get ('/',          'index')    ->name('index');
        Route::get ('/tambah',    'ke_tambah')->name('ke_tambah');
        Route::post('/tambah',    'tambah')   ->name('tambah');
        Route::get ('/ubah/{id}', 'ke_ubah')  ->name('ke_ubah');
        Route::post('/ubah{id}',  'ubah')     ->name('ubah');
        Route::post('/hapus{id}', 'hapus')    ->name('hapus');
    });

    Route::name('portofolio.')->prefix('/portofolio')
        ->controller(APortofolioController::class)->group(function() {
        Route::get ('/{tab}',         'index')      ->name('index');
        Route::get ('/validasi/{id}', 'ke_validasi')->name('ke_validasi');
        Route::post('/validasi/{id}', 'validasi')   ->name('validasi');
        Route::post('/config',        'config')     ->name('config');
    });

});

Route::name('user.')
    ->prefix('user')
    ->middleware('user')->group(function() {

    Route::controller(UController::class)->group(function() {
        Route::get('/', 'index')->name('index');
    });

    Route::name('profil.')->prefix('/profil')
        ->controller(UProfileController::class)->group(function() {
        Route::get ('/',              'index')           ->name('index');
        Route::get ('/ubah',          'ke_ubah')         ->name('ke_ubah');
        Route::post('/ubah',          'ubah')            ->name('ubah');
        Route::get ('/ubah-password', 'ke_ubah_password')->name('ke_ubah_password');
        Route::post('/ubah-password', 'ubah_password')   ->name('ubah_password');
        Route::get ('/ubah-foto',     'ke_ubah_foto')    ->name('ke_ubah_foto');
        Route::post('/ubah-foto',     'ubah_foto')       ->name('ubah_foto');
    });

    // Hanya bisa diakses jika sudah melengkapi profil wedding couple
    Route::middleware('hasUserProfile')->group(function() {

        Route::prefix('/pernikahan')->group(function() {
            Route::name('pernikahan.')->controller(UWeddingController::class)->group(function() {
                Route::get ('/',                  'index')       ->name('index');
                Route::get ('/tambah',            'ke_tambah')   ->name('ke_tambah');
                Route::post('/tambah',            'tambah')      ->name('tambah');
                Route::get ('/acara/{id}',        'ke_acara')    ->name('ke_acara');
                Route::post('/acara/{id}',        'acara')       ->name('acara');
                Route::get ('/ubah/{id}',         'ke_ubah')     ->name('ke_ubah');
                Route::post('/ubah/{id}',         'ubah')        ->name('ubah');
                Route::get ('/detail/{id}',       'ke_detail')   ->name('ke_detail');
                Route::post('/hapus/{id}',        'hapus')       ->name('hapus');
                Route::post('/hapus-vendor/{id}', 'hapus_vendor')->name('hapus-vendor');
                Route::post('/selesai',           'selesai')     ->name('selesai');
                Route::post('/ulasan/{id}',       'ulasan')      ->name('ulasan');
            });

            Route::prefix('/transaksi')->name('transaksi.')
                ->controller(UTransactionController::class)->group(function() {
                Route::get('/',                'transaksi') ->name('index');
                Route::get('/notifikasi',      'notifikasi')->name('notifikasi');
                Route::get('/cek-status/{id}', 'cek_status')->name('cek_status');
                Route::get('/batal/{id}',      'batal')     ->name('batal');
            });

            Route::name('undangan.')->prefix('/undangan')
                ->controller(UInvitationController::class)->group(function() {
                Route::get ('/ke-tambah',  'ke_tambah')->name('ke_tambah');
                Route::post('/tambah',     'tambah')   ->name('tambah');
                Route::get ('/cek/{id}',   'cek')      ->name('cek');
            });

            Route::name('tamu.')->prefix('/tamu')
                ->controller(UGuestController::class)->group(function() {
                Route::post('/tambah/{id}', 'tambah')->name('tambah');
                Route::post('/kirim/{id}',  'kirim') ->name('kirim');
                Route::post('/rsvp/{id}',   'rsvp')  ->name('rsvp');
                Route::post('/wish/{id}',   'wish')  ->name('wish');
                Route::post('/hapus/{id}',  'hapus') ->name('hapus');
            });
        });

        Route::name('search.')->prefix('/search')
            ->controller(UBookingController::class)->group(function() {
            Route::get ('/paket-layanan', 'paket_layanan')->name('paket-layanan');
            Route::get ('/vendor',        'vendor')       ->name('vendor');
            Route::get ('/portofolio',    'portofolio')   ->name('portofolio');
            Route::get ('/{id}/detail',   'ke_detail')    ->name('ke_detail');
            Route::post('/pesan',         'pesan')        ->name('pesan');

        });

    });

});

Route::get('/fetch-template/{type}/{value}', [TemplateController::class, 'fetchTemplate'])->name('ambil-template');
Route::get('undangan/{pengantin}/{link}', [UInvitationController::class, 'undangan'])->name('undangan.tamu');

Route::name('vendor.')->prefix('/vendor')
    ->middleware('vendor')->group(function() {

    Route::controller(VController::class)->group(function() {
        Route::get('/', 'index')->name('index');
    });

    Route::name('profil.')->prefix('/profil')
        ->controller(VProfileController::class)->group(function() {
        Route::get ('/',                 'index')           ->name('index');
        Route::get ('/ubah',             'ke_ubah')         ->name('ke_ubah');
        Route::post('/ubah',             'ubah')            ->name('ubah');
        Route::get ('/ubah-password',    'ke_ubah_password')->name('ke_ubah_password');
        Route::post('/ubah-password',    'ubah_password')   ->name('ubah_password');
        Route::get ('/ubah-foto',        'ke_ubah_foto')    ->name('ke_ubah_foto');
        Route::post('/ubah-foto',        'ubah_foto')       ->name('ubah_foto');
        Route::post('/tambah-jenis',     'tambah_jenis')    ->name('tambah-jenis');
        Route::post('/hapus-jenis/{id}', 'hapus_jenis')     ->name('hapus-jenis');
    });

    Route::middleware('hasVendorProfile')->group(function() {

        Route::name('portofolio.')->prefix('/portofolio')
            ->controller(VPortfolioController::class)->group(function() {
            Route::get ('/',                        'index')     ->name('index');
            Route::get ('/tambah',                  'ke_tambah') ->name('ke_tambah');
            Route::post('/tambah',                  'tambah')    ->name('tambah');
            Route::get ('/ubah/{id}',               'ke_ubah')   ->name('ke_ubah');
            Route::post('/ubah/{id}',               'ubah')      ->name('ubah');
            Route::post('/hapus/{id}',              'hapus')     ->name('hapus');
            Route::post('/hapus-foto/{id}/{index}', 'hapus_foto')->name('hapus-foto');
        });

        Route::name('layanan.')->prefix('/layanan')
            ->controller(VServiceController::class)->group(function() {
            Route::get ('/',                        'index')     ->name('index');
            Route::get ('/tambah',                  'ke_tambah') ->name('ke_tambah');
            Route::post('/tambah',                  'tambah')    ->name('tambah');
            Route::get ('/ubah/{id}',               'ke_ubah')   ->name('ke_ubah');
            Route::post('/ubah/{id}',               'ubah')      ->name('ubah');
            Route::post('/hapus/{id}',              'hapus')     ->name('hapus');
            Route::post('/hapus-foto/{id}/{index}', 'hapus_foto')->name('hapus-foto');
        });

        Route::name('pesanan.')->prefix('/pesanan')
            ->controller(VBookingController::class)->group(function() {
            Route::get ('/',            'index')    ->name('index');
            Route::get ('/detail/{id}', 'ke_detail')->name('ke_detail');
            Route::post('/respon/{id}', 'respon')   ->name('respon');
        });

        Route::name('pendapatan.')->prefix('/pendapatan')
            ->controller(VRevenueController::class)->group(function() {
            Route::get ('/', 'index')    ->name('index');
        });

        Route::name('jadwal.')->prefix('/jadwal')
            ->controller(VScheduleController::class)->group(function() {
            Route::get ('/',            'index')    ->name('index');
            Route::get ('/detail/{id}', 'ke_detail')->name('ke_detail');
        });

        Route::name('ulasan.')->prefix('/ulasan')
            ->controller(VReviewController::class)->group(function() {
            Route::get('/', 'index')->name('index');
        });

    });

});

