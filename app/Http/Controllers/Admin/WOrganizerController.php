<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AConfiguration;
use App\Models\WOPortofolio;
use App\Models\WOPortofolioPhoto;
use Illuminate\Http\Request;

class WOrganizerController extends Controller
{
    public function index() {
        $pending  = WOPortofolio::where('status', 'menunggu konfirmasi')->get();
        $accepted = WOPortofolio::where('status', 'diterima')->get();
        $rejected = WOPortofolio::where('status', 'ditolak')->get();

        $config = AConfiguration::where('nama', 'portofolio_wo')->first();

        return view('user.admin.portofolio.w-organizer.index', compact(
            'pending',
            'accepted',
            'rejected',
            'config',
        ));
    }

    public function ke_validasi($id) {
        $portofolio = WOPortofolio::find($id);

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
            return redirect()->route('admin.wo.portofolio.index')->with('sukses', 'Mengubah Validasi Portofolio Organizer');
        }
        return redirect()->route('admin.wo.portofolio.index')->with('gagal', 'Mengubah Validasi Portofolio Organizer');
    }

    public function config(Request $req) {
        $config = AConfiguration::where('nama', 'portofolio_wo')->first();

        $data = null;
        if ($req->config == 'on') {
            $config->admin_id = auth()->user()->admin->id;
            $config->automation = true;
            $data = $config->save();
        } else {
            $config->admin_id = null;
            $config->automation = false;
            $data = $config->save();
        }

        if ($data) {
            return redirect()->route('admin.wo.portofolio.index')->with('sukses', 'Mengubah Konfigurasi Portofolio Organizer');
        }
        return redirect()->route('admin.wo.portofolio.index')->with('gagal', 'Mengubah Konfigurasi Portofolio Organizer');
    }
}
