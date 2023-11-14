<?php

namespace App\Http\Controllers\WeddingPhotographer;

use App\Http\Controllers\Controller;
use App\Models\WPPlan;
use App\Models\WPPlanDetail;
use Illuminate\Http\Request;

class WPLayananController extends Controller
{
    public function index() {
        $plans = WPPlan::where('w_photographer_id', auth()->user()->w_photographer->id)
                ->orderBy('harga', 'asc')
                ->get();
        return view('user.wedding-photographer.layanan.index', compact('plans'));
    }

    public function ke_tambah() {
        return view('user.wedding-photographer.layanan.tambah');
    }

    public function tambah(Request $req) {
        $req->validate([
            'nama' => 'required',
            'fitur_utama' => 'required',
            'harga' => 'required|numeric',
        ],[
            'nama.required' => 'Nama Layanan tidak boleh kosong',
            'fitur_utama.required' => 'Harap masukkan minimal 1 fitur',
            'harga.required' => 'Harga tidak boleh kosong',
            'harga.numeric' => 'Harga harus berupa numerik',
        ]);

        $plan = new WPPlan();
        $plan->w_photographer_id = auth()->user()->w_photographer->id;
        $plan->nama = $req->nama;
        $plan->harga = $req->harga;
        $data1 = $plan->save();

        $plan_detail = new WPPlanDetail();
        $plan_detail->w_p_plan_id = $plan->id;
        $plan_detail->isi = $req->fitur_utama;
        $data2 = $plan_detail->save();

        $fitur_tambahans = $req->input('fitur_tambahan', []);

        foreach ($fitur_tambahans as $fitur) {
            if ($fitur !== '' && $fitur !== NULL) {
                $plan_detail = new WPPlanDetail();
                $plan_detail->w_p_plan_id = $plan->id;
                $plan_detail->isi = $fitur;
                $plan_detail->save();
            }
        }

        if ($data1 && $data2) {
            return redirect()->route('wedding-photographer.layanan.index')->with('sukses', 'Menambah Paket Layanan');
        }
        return redirect()->route('wedding-photographer.layanan.index')->with('gagal', 'Menambah Paket Layanan');
    }

    public function ke_ubah($id) {
        $plan = WPPlan::where('id', $id)->first();
        $fitur_tambahan = WPPlanDetail::where('w_p_plan_id', $id)->get();
        $fitur_tambahan->shift();

        return view('user.wedding-photographer.layanan.ubah', compact('plan','fitur_tambahan'));
    }

    public function ubah(Request $req, $id) {
        $req->validate([
            'nama' => 'required',
            'fitur_utama' => 'required',
            'harga' => 'required|numeric',
        ],[
            'nama.required' => 'Nama Layanan tidak boleh kosong',
            'fitur_utama.required' => 'Harap masukkan minimal 1 fitur',
            'harga.required' => 'Harga tidak boleh kosong',
            'harga.numeric' => 'Harga harus berupa numerik',
        ]);

        $data1 = WPPlan::where('id', $id)
                    ->update([
                        'nama' => $req->nama,
                        'harga' => $req->harga,
                    ]);

        $fitur_utama = WPPlanDetail::where('w_p_plan_id', $id)->first();
        $fitur_utama->isi = $req->fitur_utama;
        $data2 = $fitur_utama->save();

        $fitur_tambahan = WPPlanDetail::where('w_p_plan_id', $id)->get();
        $fitur_tambahan->shift();
        foreach ($fitur_tambahan as $fitur) {
            $fitur->delete();
        }

        $fitur_tambahans = $req->input('fitur_tambahan', []);

        foreach ($fitur_tambahans as $fitur) {
            if ($fitur !== '' && $fitur !== NULL) {
                $plan_detail = new WPPlanDetail();
                $plan_detail->w_p_plan_id = $id;
                $plan_detail->isi = $fitur;
                $plan_detail->save();
            }
        }

        if ($data1 && $data2) {
            return redirect()->route('wedding-photographer.layanan.ubah', $id)->with('sukses', 'Mengubah Paket Layanan');
        }
        return redirect()->route('wedding-photographer.layanan.ubah', $id)->with('gagal', 'Mengubah Paket Layanan');
    }

    public function hapus($id) {
        $plan = WPPlan::where('id', $id)->first();
        $data = $plan->delete();

        if ($data) {
            return redirect()->route('wedding-photographer.layanan.index')->with('sukses', 'Menghapus Paket Layanan');
        }
        return redirect()->route('wedding-photographer.layanan.index')->with('gagal', 'Menghapus Paket Layanan');
    }

    public function ubah_status(Request $req, $id) {
        $data = WPPlan::where('id', $id)
                ->update([
                    'status' => $req->status,
                ]);

        if ($data) {
            return redirect()->route('wedding-photographer.layanan.ubah', $id)->with('sukses', 'Mengubah Status Layanan');
        }
        return redirect()->route('wedding-photographer.layanan.ubah', $id)->with('gagal', 'Mengubah Status Layanan');
    }
}
