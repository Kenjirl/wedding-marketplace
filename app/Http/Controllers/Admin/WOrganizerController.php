<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AConfiguration;
use App\Models\WOPortofolio;
use App\Models\WOPortofolioPhoto;
use Illuminate\Http\Request;

class WOrganizerController extends Controller
{
    public function index($tab) {
        if ($tab == 'diterima') {
            $tab = 'accept';
        }
        if ($tab == 'ditolak') {
            $tab = 'reject';
        }

        if ($tab != 'pending' && $tab != 'accept' && $tab != 'reject') {
            return redirect()->route('admin.wo.portofolio.index', 'pending');
        }

        $portofolio = [];

        if ($tab == 'accept') {
            $portofolio = WOPortofolio::where('status', 'diterima')
                        ->orderBy('updated_at', 'asc')
                        ->get();
        } else if ($tab == 'reject') {
            $portofolio = WOPortofolio::where('status', 'ditolak')
                        ->orderBy('updated_at', 'asc')
                        ->get();
        } else if ($tab == 'pending') {
            $portofolio = WOPortofolio::where('status', 'menunggu konfirmasi')
                        ->orderBy('updated_at', 'asc')
                        ->get();
        }

        $config = AConfiguration::where('nama', 'portofolio_wo')->first();

        return view('user.admin.portofolio.w-organizer.index', compact(
            'portofolio',
            'config',
            'tab',
        ));
    }

    public function ke_validasi($id) {
        $portofolio = WOPortofolio::find($id);

        if (!$portofolio) {
            return redirect()->route('admin.wo.portofolio.index')->with('gagal', 'ID Invalid');
        }

        return view('user.admin.portofolio.w-organizer.validasi', compact('portofolio'));
    }

    public function validasi(Request $req, $id) {
        $req->validate([
            'status' => 'required'
        ]);

        // SET FOTO JADI FALSE
        $fotos = WOPortofolioPhoto::where('w_o_portofolio_id', $id)->get();
        foreach ($fotos as $foto) {
            WOPortofolioPhoto::where('id', $foto->id)->update([
                'rejected' => false,
            ]);
        }

        if ($req->status == 'ditolak') {
            // SET FOTO DICENTANG JADI TRUE
            $rejectedPhotoIds = $req->input('rejected', []);
            foreach ($rejectedPhotoIds as $photoId) {
                WOPortofolioPhoto::where('id', $photoId)->update([
                    'rejected' => true,
                ]);
            }
        }

        $data = WOPortofolio::where('id', $id)
                ->update([
                    'admin_id' => auth()->user()->admin->id,
                    'status'   => $req->status,
                ]);

        if ($data) {
            return redirect()->route('admin.wo.portofolio.index', $req->status)->with('sukses', 'Mengubah Validasi Portofolio Organizer');
        }
        return redirect()->route('admin.wo.portofolio.index', $req->status)->with('gagal', 'Mengubah Validasi Portofolio Organizer');
    }

    public function config(Request $req) {
        $config = AConfiguration::where('nama', 'portofolio_wo')->first();

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
            return redirect()->back()->with('sukses', 'Mengubah Konfigurasi Portofolio Organizer');
        }
        return redirect()->back()->with('gagal', 'Mengubah Konfigurasi Portofolio Organizer');
    }
}
