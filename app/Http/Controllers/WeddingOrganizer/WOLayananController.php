<?php

namespace App\Http\Controllers\WeddingOrganizer;

use App\Http\Controllers\Controller;
use App\Models\WVPlan;
use Illuminate\Http\Request;

class WOLayananController extends Controller
{
    public function index() {
        $plans = WVPlan::where('w_vendor_id', auth()->user()->w_vendor->id)
                ->orderBy('harga', 'asc')
                ->get();
        return view('user.wedding-organizer.layanan.index', compact('plans'));
    }

    public function ke_tambah() {
        return view('user.wedding-organizer.layanan.tambah');
    }

    public function tambah(Request $req) {
        $req->validate([
            'nama'   => 'required|max:20',
            'detail' => 'required',
            'harga'  => 'required|numeric',
            'satuan' => 'required',
        ],[
            'nama.required'   => 'Nama Layanan tidak boleh kosong',
            'nama.max'        => 'Nama tidak boleh lebih dari 20 karakter',
            'detail.required' => 'Detail Layanan tidak boleh kosong',
            'harga.required'  => 'Harga tidak boleh kosong',
            'harga.numeric'   => 'Harga harus berupa numerik',
            'satuan.required' => 'Satuan tidak boleh kosong',
        ]);

        $plan = new WVPlan();
        $plan->w_vendor_id = auth()->user()->w_vendor->id;
        $plan->nama        = $req->nama;
        $plan->detail      = $req->detail;
        $plan->harga       = $req->harga;
        $plan->satuan      = $req->satuan;
        $data1             = $plan->save();

        if ($data1) {
            return redirect()->route('wedding-organizer.layanan.index')->with('sukses', 'Menambah Paket Layanan');
        }
        return redirect()->route('wedding-organizer.layanan.index')->with('gagal', 'Menambah Paket Layanan');
    }

    public function ke_ubah($id) {
        $plan = WVPlan::find($id);

        if (!$plan) {
            return redirect()->route('wedding-organizer.layanan.index')->with('gagal', 'ID Invalid');
        }

        return view('user.wedding-organizer.layanan.ubah', compact('plan'));
    }

    public function ubah(Request $req, $id) {
        $req->validate([
            'nama'   => 'required|max:20',
            'detail' => 'required',
            'harga'  => 'required|numeric',
            'satuan' => 'required',
        ],[
            'nama.required'   => 'Nama Layanan tidak boleh kosong',
            'nama.max'        => 'Nama tidak boleh lebih dari 20 karakter',
            'detail.required' => 'Detail Layanan tidak boleh kosong',
            'harga.required'  => 'Harga tidak boleh kosong',
            'harga.numeric'   => 'Harga harus berupa numerik',
            'satuan.required' => 'Satuan tidak boleh kosong',
        ]);

        $data1 = WVPlan::where('id', $id)
                    ->update([
                        'nama'   => $req->nama,
                        'detail' => $req->detail,
                        'harga'  => $req->harga,
                        'satuan' => $req->satuan,
                    ]);

        if ($data1) {
            return redirect()->route('wedding-organizer.layanan.ubah', $id)->with('sukses', 'Mengubah Paket Layanan');
        }
        return redirect()->route('wedding-organizer.layanan.ubah', $id)->with('gagal', 'Mengubah Paket Layanan');
    }

    public function hapus($id) {
        $plan = WVPlan::where('id', $id)->first();
        $data = $plan->delete();

        if ($data) {
            return redirect()->route('wedding-organizer.layanan.index')->with('sukses', 'Menghapus Paket Layanan');
        }
        return redirect()->route('wedding-organizer.layanan.index')->with('gagal', 'Menghapus Paket Layanan');
    }
}
