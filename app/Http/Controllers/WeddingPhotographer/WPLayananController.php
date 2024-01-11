<?php

namespace App\Http\Controllers\WeddingPhotographer;

use App\Http\Controllers\Controller;
use App\Models\WPPlan;
use Illuminate\Http\Request;

class WPLayananController extends Controller
{
    public function index() {
        $plans = WPPlan::where('w_photographer_id', auth()->user()->w_photographer->id)
                ->where('deleted', 0)
                ->orderBy('harga', 'asc')
                ->get();
        return view('user.wedding-photographer.layanan.index', compact('plans'));
    }

    public function ke_tambah() {
        return view('user.wedding-photographer.layanan.tambah');
    }

    public function tambah(Request $req) {
        $req->validate([
            'nama'        => 'required|max:20',
            'detail'      => 'required',
            'harga'       => 'required|numeric',
        ],[
            'nama.required'        => 'Nama Layanan tidak boleh kosong',
            'nama.max'             => 'Nama tidak boleh lebih dari 20 karakter',
            'detail.required'      => 'Detail Layanan tidak boleh kosong',
            'harga.required'       => 'Harga tidak boleh kosong',
            'harga.numeric'        => 'Harga harus berupa numerik',
        ]);

        $plan = new WPPlan();
        $plan->w_photographer_id = auth()->user()->w_photographer->id;
        $plan->nama = $req->nama;
        $plan->detail = $req->detail;
        $plan->harga = $req->harga;
        $data1 = $plan->save();

        if ($data1) {
            return redirect()->route('wedding-photographer.layanan.index')->with('sukses', 'Menambah Paket Layanan');
        }
        return redirect()->route('wedding-photographer.layanan.index')->with('gagal', 'Menambah Paket Layanan');
    }

    public function ke_ubah($id) {
        $plan = WPPlan::find($id);

        if (!$plan) {
            return redirect()->route('wedding-photographer.layanan.index')->with('gagal', 'ID Invalid');
        }

        return view('user.wedding-photographer.layanan.ubah', compact('plan'));
    }

    public function ubah(Request $req, $id) {
        $req->validate([
            'nama'        => 'required|max:20',
            'detail'      => 'required',
            'harga'       => 'required|numeric',
        ],[
            'nama.required'        => 'Nama Layanan tidak boleh kosong',
            'nama.max'             => 'Nama tidak boleh lebih dari 20 karakter',
            'detail.required'      => 'Detail Layanan tidak boleh kosong',
            'harga.required'       => 'Harga tidak boleh kosong',
            'harga.numeric'        => 'Harga harus berupa numerik',
        ]);

        $data1 = WPPlan::where('id', $id)
                    ->update([
                        'nama' => $req->nama,
                        'detail' => $req->detail,
                        'harga' => $req->harga,
                    ]);

        if ($data1) {
            return redirect()->route('wedding-photographer.layanan.ubah', $id)->with('sukses', 'Mengubah Paket Layanan');
        }
        return redirect()->route('wedding-photographer.layanan.ubah', $id)->with('gagal', 'Mengubah Paket Layanan');
    }

    public function hapus($id) {
        $plan = WPPlan::where('id', $id)->first();
        $plan->deleted = true;
        $data = $plan->save();

        if ($data) {
            return redirect()->route('wedding-photographer.layanan.index')->with('sukses', 'Menghapus Paket Layanan');
        }
        return redirect()->route('wedding-photographer.layanan.index')->with('gagal', 'Menghapus Paket Layanan');
    }
}
