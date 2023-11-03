<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WOPortofolio;
use Illuminate\Http\Request;

class WOrganizerController extends Controller
{
    public function index() {
        $pending  = WOPortofolio::where('status', 'menunggu konfirmasi')->get();
        $accepted = WOPortofolio::where('status', 'diterima')->get();
        $rejected = WOPortofolio::where('status', 'ditolak')->get();

        return view('user.admin.w-organizer.portofolio.index', compact('pending', 'accepted', 'rejected'));
    }

    public function ke_validasi($id) {
        $portofolio = WOPortofolio::find($id);

        return view('user.admin.w-organizer.portofolio.validasi', compact('portofolio'));
    }

    public function validasi(Request $req, $id) {
        $req->validate([
            'status' => 'required'
        ]);

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
