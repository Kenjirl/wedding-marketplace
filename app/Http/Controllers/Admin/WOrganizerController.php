<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WOPortofolio;
use App\Models\WOPortofolioPhoto;
use Illuminate\Http\Request;

class WOrganizerController extends Controller
{
    public function index() {
        $pending  = WOPortofolio::where('status', 'menunggu konfirmasi')->get();
        $accepted = WOPortofolio::where('status', 'diterima')->get();
        $rejected = WOPortofolio::where('status', 'ditolak')->get();

        return view('user.admin.portofolio.w-organizer.index', compact('pending', 'accepted', 'rejected'));
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
            return redirect()->route('admin.wo.portofolio.index')->with('sukses', 'Mengubah Validasi Portofolio');
        }
        return redirect()->route('admin.wo.portofolio.index')->with('gagal', 'Mengubah Validasi Portofolio');
    }
}
