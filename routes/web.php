<?php

use App\Http\Controllers\Admin\ACategoryController;
use App\Http\Controllers\Admin\AController;
use App\Http\Controllers\Admin\AEventController;
use App\Http\Controllers\Admin\AProfilController;
use App\Http\Controllers\Admin\WOrganizerController;
use App\Http\Controllers\Admin\WPhotographerController;
use App\Http\Controllers\SuperAdmin\SAAdminController;
use App\Http\Controllers\SuperAdmin\SAController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WeddingCouple\WCController;
use App\Http\Controllers\WeddingCouple\WCInvitationController;
use App\Http\Controllers\WeddingCouple\WCProfilController;
use App\Http\Controllers\WeddingCouple\WCWeddingController;
use App\Http\Controllers\WeddingCouple\WOBookingController;
use App\Http\Controllers\WeddingCouple\WPBookingController;
use App\Http\Controllers\WeddingOrganizer\WOController;
use App\Http\Controllers\WeddingOrganizer\WOJadwalController;
use App\Http\Controllers\WeddingOrganizer\WOLayananController;
use App\Http\Controllers\WeddingOrganizer\WOPesananController;
use App\Http\Controllers\WeddingOrganizer\WOPortofolioController;
use App\Http\Controllers\WeddingOrganizer\WOProfilController;
use App\Http\Controllers\WeddingPhotographer\WPController;
use App\Http\Controllers\WeddingPhotographer\WPJadwalController;
use App\Http\Controllers\WeddingPhotographer\WPLayananController;
use App\Http\Controllers\WeddingPhotographer\WPPesananController;
use App\Http\Controllers\WeddingPhotographer\WPPortofolioController;
use App\Http\Controllers\WeddingPhotographer\WPProfilController;
use Illuminate\Support\Facades\Route;

Route::controller(UserController::class)->group(function() {

    Route::middleware(['guest'])->group(function() {
        Route::get('/', function () {
            return view('user.wedding-couple.index');
        });
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

    Route::name('event-pernikahan.')->prefix('/event-pernikahan')
        ->controller(AEventController::class)->group(function() {
        Route::get ('/',          'index')    ->name('index');
        Route::get ('/tambah',    'ke_tambah')->name('ke_tambah');
        Route::post('/tambah',    'tambah')   ->name('tambah');
        Route::get ('/ubah/{id}', 'ke_ubah')  ->name('ke_ubah');
        Route::post('/ubah{id}',  'ubah')     ->name('ubah');
        Route::post('/hapus{id}', 'hapus')    ->name('hapus');
    });

    Route::name('wo.portofolio.')->prefix('/wedding-organizer/portofolio')
        ->controller(WOrganizerController::class)->group(function() {
        Route::get ('/{tab}',         'index')      ->name('index');
        Route::get ('/validasi/{id}', 'ke_validasi')->name('ke_validasi');
        Route::post('/validasi{id}',  'validasi')   ->name('validasi');
        Route::post('/config',        'config')     ->name('config');
    });

    Route::name('wp.portofolio.')->prefix('/wedding-photographer/portofolio')
        ->controller(WPhotographerController::class)->group(function() {
        Route::get ('/{tab}',         'index')      ->name('index');
        Route::get ('/validasi/{id}', 'ke_validasi')->name('ke_validasi');
        Route::post('/validasi{id}',  'validasi')   ->name('validasi');
        Route::post('/config',        'config')     ->name('config');
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

        Route::prefix('/pernikahan')
            ->controller(WCWeddingController::class)->group(function() {
            Route::get ('/',                           'index')                 ->name('pernikahan.index');
            Route::get ('/tambah',                     'ke_tambah')             ->name('pernikahan.ke_tambah');
            Route::post('/tambah',                     'tambah')                ->name('pernikahan.tambah');
            Route::get ('/ubah/{id}',                  'ke_ubah')               ->name('pernikahan.ke_ubah');
            Route::post('/ubah/{id}',                  'ubah')                  ->name('pernikahan.ubah');
            Route::get ('/detail/{id}',                'ke_detail')             ->name('pernikahan.ke_detail');
            Route::post('/hapus/{id}',                 'hapus')                 ->name('pernikahan.hapus');
            Route::post('/hapus-wo/{id}',              'hapus_wo')              ->name('pernikahan.hapus_wo');
            Route::post('/hapus-wp/{id}',              'hapus_wp')              ->name('pernikahan.hapus_wp');
            Route::post('/upload-bukti-bayar-wo/{id}', 'upload_bukti_bayar_wo') ->name('pernikahan.upload_bukti_bayar_wo');
            Route::post('/upload-bukti-bayar-wp/{id}', 'upload_bukti_bayar_wp') ->name('pernikahan.upload_bukti_bayar_wp');

            Route::name('undangan.')->prefix('/undangan')
                ->controller(WCInvitationController::class)->group(function() {
                Route::get ('/tambah',     'ke_tambah')->name('ke_tambah');
                Route::post('/tambah',     'tambah')   ->name('tambah');
                Route::get ('/ubah/{id}',  'ke_ubah')  ->name('ke_ubah');
                Route::post('/ubah/{id}',  'ubah')     ->name('ubah');
                Route::post('/hapus/{id}', 'hapus')    ->name('hapus');
            });

            Route::name('tamu.')->prefix('/tamu')
                ->controller(WCInvitationController::class)->group(function() {
                Route::get ('/',           'index')    ->name('index');
                Route::post('/tambah',     'tambah')   ->name('tambah');
                Route::post('/hapus/{id}', 'hapus')    ->name('hapus');
            });

            Route::name('grup.')->prefix('/grup')
                ->controller(WCInvitationController::class)->group(function() {
                Route::get ('/',           'index')    ->name('index');
                Route::post('/tambah',     'tambah')   ->name('tambah');
                Route::post('/hapus/{id}', 'hapus')    ->name('hapus');
            });
        });

        Route::name('search.')->prefix('/search')->group(function() {

            // Route Search Wedding Organizer
            Route::name('wo.')->prefix('/wedding-organizer')
                ->controller(WOBookingController::class)->group(function() {
                Route::get ('/',            'index')    ->name('index');
                Route::get ('/{id}/detail', 'ke_detail')->name('ke_detail');
                Route::post('/pesan',       'pesan')    ->name('pesan');
            });

            // Route Search Wedding Photographer
            Route::name('wp.')->prefix('/wedding-photographer')
                ->controller(WPBookingController::class)->group(function() {
                Route::get ('/',            'index')    ->name('index');
                Route::get ('/{id}/detail', 'ke_detail')->name('ke_detail');
                Route::post('/pesan',       'pesan')    ->name('pesan');
            });

        });

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
        Route::get ('/',                    'index')           ->name('index');
        Route::get ('/ubah',                'ke_ubah')         ->name('ke_ubah');
        Route::post('/ubah',                'ubah')            ->name('ubah');
        Route::get ('/ubah-password',       'ke_ubah_password')->name('ke_ubah_password');
        Route::post('/ubah-password',       'ubah_password')   ->name('ubah_password');
        Route::get ('/ubah-foto',           'ke_ubah_foto')    ->name('ke_ubah_foto');
        Route::post('/ubah-foto',           'ubah_foto')       ->name('ubah_foto');
        Route::get ('/ubah-kategori',       'ke_ubah_kategori')->name('ke_ubah_kategori');
        Route::post('/tambah-kategori',     'tambah_kategori') ->name('tambah_kategori');
        Route::post('/hapus-kategori/{id}', 'hapus_kategori')  ->name('hapus_kategori');
    });

    // Hanya bisa diakses jika sudah melengkapi profil wedding organizer
    Route::middleware('wo-profil')->group(function() {

        Route::name('portofolio.')->prefix('/portofolio')
            ->controller(WOPortofolioController::class)->group(function() {
            Route::get ('/',                'index')     ->name('index');
            Route::get ('/tambah',          'ke_tambah') ->name('ke_tambah');
            Route::post('/tambah',          'tambah')    ->name('tambah');
            Route::get ('/ubah/{id}',       'ke_ubah')   ->name('ke_ubah');
            Route::post('/ubah/{id}',       'ubah')      ->name('ubah');
            Route::post('/hapus/{id}',      'hapus')     ->name('hapus');
            Route::post('/hapus-foto/{id}', 'hapus_foto')->name('hapus-foto');
        });

        Route::name('layanan.')->prefix('/layanan')
            ->controller(WOLayananController::class)->group(function() {
            Route::get ('/',           'index')      ->name('index');
            Route::get ('/tambah',     'ke_tambah')  ->name('ke_tambah');
            Route::post('/tambah',     'tambah')     ->name('tambah');
            Route::get ('/ubah/{id}',  'ke_ubah')    ->name('ke_ubah');
            Route::post('/ubah/{id}',  'ubah')       ->name('ubah');
            Route::post('/hapus/{id}', 'hapus')      ->name('hapus');
        });

        Route::name('pesanan.')->prefix('/pesanan')
            ->controller(WOPesananController::class)->group(function() {
            Route::get ('/',            'index')    ->name('index');
            Route::get ('/detail/{id}', 'ke_detail')->name('ke_detail');
            Route::post('/respon/{id}', 'respon')   ->name('respon');
        });

        Route::name('jadwal.')->prefix('/jadwal')
            ->controller(WOJadwalController::class)->group(function() {
            Route::get ('/',            'index')    ->name('index');
            Route::get ('/detail/{id}', 'ke_detail')->name('ke_detail');
            Route::post('/batal/{id}',  'batal')    ->name('batal');
        });

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
            Route::get ('/',                'index')     ->name('index');
            Route::get ('/tambah',          'ke_tambah') ->name('ke_tambah');
            Route::post('/tambah',          'tambah')    ->name('tambah');
            Route::get ('/ubah/{id}',       'ke_ubah')   ->name('ke_ubah');
            Route::post('/ubah/{id}',       'ubah')      ->name('ubah');
            Route::post('/hapus/{id}',      'hapus')     ->name('hapus');
            Route::post('/hapus-foto/{id}', 'hapus_foto')->name('hapus-foto');
        });

        Route::name('layanan.')->prefix('/layanan')
            ->controller(WPLayananController::class)->group(function() {
            Route::get ('/',           'index')      ->name('index');
            Route::get ('/tambah',     'ke_tambah')  ->name('ke_tambah');
            Route::post('/tambah',     'tambah')     ->name('tambah');
            Route::get ('/ubah/{id}',  'ke_ubah')    ->name('ke_ubah');
            Route::post('/ubah/{id}',  'ubah')       ->name('ubah');
            Route::post('/hapus/{id}', 'hapus')      ->name('hapus');
        });

        Route::name('pesanan.')->prefix('/pesanan')
            ->controller(WPPesananController::class)->group(function() {
            Route::get ('/',            'index')    ->name('index');
            Route::get ('/detail/{id}', 'ke_detail')->name('ke_detail');
            Route::post('/respon/{id}', 'respon')   ->name('respon');
        });

        Route::name('jadwal.')->prefix('/jadwal')
            ->controller(WPJadwalController::class)->group(function() {
            Route::get ('/',            'index')    ->name('index');
            Route::get ('/detail/{id}', 'ke_detail')->name('ke_detail');
            Route::post('/batal/{id}',  'batal')    ->name('batal');
        });

    });

});
