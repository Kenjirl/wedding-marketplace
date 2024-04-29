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
            return back()->with('gagal', 'ID Invalid');
        }

        return view('user.admin.portofolio.w-photographer.validasi', compact('portofolio'));
    }

    public function validasi(Request $req, $id) {
        $req->validate([
            'status' => 'required'
        ]);

        $portofolio = WPPortofolio::findOrFail($id);

        // Set all 'rejected' statuses to false by default
        $currentFoto = $portofolio->foto;
        foreach ($currentFoto as &$photo) {
            $photo['rejected'] = false;
        }
        unset($photo);

        // If 'status' is 'ditolak', update 'rejected' statuses based on input
        if ($req->status === 'ditolak') {
            $rejectedPhotoIds = $req->input('rejected', []);
            foreach ($rejectedPhotoIds as $index) {
                if (isset($currentFoto[$index])) {
                    $currentFoto[$index]['rejected'] = true;
                }
            }
        }
        $portofolio->admin_id = auth()->user()->admin->id;
        $portofolio->status = $req->status;
        $portofolio->foto = $currentFoto;
        $data = $portofolio->save();

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
