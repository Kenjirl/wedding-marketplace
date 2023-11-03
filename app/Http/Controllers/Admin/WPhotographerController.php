<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WPPortofolio;
use Illuminate\Http\Request;

class WPhotographerController extends Controller
{
    public function index() {
        $pending  = WPPortofolio::where('status', 'menunggu konfirmasi')->get();
        $accepted = WPPortofolio::where('status', 'diterima')->get();
        $rejected = WPPortofolio::where('status', 'ditolak')->get();

        return view('user.admin.w-photographer.portofolio.index', compact('pending', 'accepted', 'rejected'));
    }

    public function ke_validasi($id) {
        $portofolio = WPPortofolio::find($id);

        return view('user.admin.w-photographer.portofolio.validasi', compact('portofolio'));
    }

    public function validasi(Request $req, $id) {
        $req->validate([
            'status' => 'required'
        ]);

        $data = WPPortofolio::where('id', $id)
                ->update([
                    'admin_id' => auth()->user()->admin->id,
                    'status'   => $req->status,
                ]);

        if ($data) {
            return redirect()->route('admin.wp.portofolio.index')->with('sukses', 'Mengubah Validasi Portofolio');
        }
        return redirect()->route('admin.wp.portofolio.index')->with('gagal', 'Mengubah Validasi Portofolio');
    }
}
