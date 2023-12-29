<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AConfiguration;
use App\Models\WPPortofolio;
use App\Models\WPPortofolioPhoto;
use Illuminate\Http\Request;

class WPhotographerController extends Controller
{
    public function index($tab) {
        if ($tab == 'diterima') {
            $tab = 'accept';
        }
        if ($tab == 'ditolak') {
            $tab = 'reject';
        }

        if ($tab != 'pending' && $tab != 'accept' && $tab != 'reject') {
            return redirect()->route('admin.wp.portofolio.index', 'pending');
        }

        $portofolio = [];

        if ($tab == 'accept') {
            $portofolio = WPPortofolio::where('status', 'diterima')
                        ->orderBy('updated_at', 'asc')
                        ->get();
        } else if ($tab == 'reject') {
            $portofolio = WPPortofolio::where('status', 'ditolak')
                        ->orderBy('updated_at', 'asc')
                        ->get();
        } else if ($tab == 'pending') {
            $portofolio = WPPortofolio::where('status', 'menunggu konfirmasi')
                        ->orderBy('updated_at', 'asc')
                        ->get();
        }

        $config = AConfiguration::where('nama', 'portofolio_wp')->first();

        return view('user.admin.portofolio.w-photographer.index', compact(
            'portofolio',
            'config',
            'tab',
        ));
    }

    public function ke_validasi($id) {
        $portofolio = WPPortofolio::find($id);

        if (!$portofolio) {
            return redirect()->route('admin.wp.portofolio.index')->with('gagal', 'ID Invalid');
        }

        return view('user.admin.portofolio.w-photographer.validasi', compact('portofolio'));
    }

    public function validasi(Request $req, $id) {
        $req->validate([
            'status' => 'required'
        ]);

        // SET FOTO JADI FALSE
        $fotos = WPPortofolioPhoto::where('w_p_portofolio_id', $id)->get();
        foreach ($fotos as $foto) {
            WPPortofolioPhoto::where('id', $foto->id)->update([
                'rejected' => false,
            ]);
        }

        if ($req->status == 'ditolak') {
            // SET FOTO DICENTANG JADI TRUE
            $rejectedPhotoIds = $req->input('rejected', []);
            foreach ($rejectedPhotoIds as $photoId) {
                WPPortofolioPhoto::where('id', $photoId)->update([
                    'rejected' => true,
                ]);
            }
        }

        // UPDATE STATUS PORTOFOLIO
        $data = WPPortofolio::where('id', $id)
                ->update([
                    'admin_id' => auth()->user()->admin->id,
                    'status'   => $req->status,
                ]);

        if ($data) {
            return redirect()->route('admin.wp.portofolio.index', $req->status)->with('sukses', 'Mengubah Validasi Portofolio');
        }
        return redirect()->route('admin.wp.portofolio.index', $req->status)->with('gagal', 'Mengubah Validasi Portofolio');
    }

    public function config(Request $req) {
        $config = AConfiguration::where('nama', 'portofolio_wp')->first();

        $data = null;
        if ($req->config == 'on') {
            $config->admin_id   = auth()->user()->admin->id;
            $config->automation = true;
            $data = $config->save();
        } else {
            $config->admin_id   = null;
            $config->automation = false;
            $data = $config->save();
        }

        if ($data) {
            return redirect()->back()->with('sukses', 'Mengubah Konfigurasi Portofolio Photographer');
        }
        return redirect()->back()->with('gagal', 'Mengubah Konfigurasi Portofolio Photographer');
    }
}
