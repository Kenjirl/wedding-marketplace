<?php

namespace App\Http\Controllers\Venue;

use App\Http\Controllers\Controller;
use App\Models\WVPlan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VLayananController extends Controller
{
    public function index() {
        $plans = WVPlan::where('w_vendor_id', auth()->user()->w_vendor->id)
                ->orderBy('harga', 'asc')
                ->with(['ratings'])
                ->get();

        foreach ($plans as $plan) {
            $totalRating = $plan->ratings->sum('rating');
            $ratingCount = $plan->ratings->count();
            $plan->rate = $ratingCount > 0 ? $totalRating / $ratingCount : null;
        }

        return view('user.venue.layanan.index', compact('plans'));
    }

    public function ke_tambah() {
        return view('user.venue.layanan.tambah');
    }

    public function tambah(Request $req) {
        $req->validate([
            'nama'      => 'required|max:20',
            'detail'    => 'required',
            'harga'     => 'required|numeric',
            'satuan'    => 'required',
            'form-info' => 'required|in:add,edit',
            'foto'      => 'required_if:form-info,add|array|min:1|max:5',
            'foto.*'    => 'image',
        ],[
            'nama.required'    => 'Nama Layanan tidak boleh kosong',
            'nama.max'         => 'Nama tidak boleh lebih dari 20 karakter',
            'detail.required'  => 'Detail Layanan tidak boleh kosong',
            'harga.required'   => 'Harga tidak boleh kosong',
            'harga.numeric'    => 'Harga harus berupa numerik',
            'satuan.required'  => 'Satuan tidak boleh kosong',
            'foto.required_if' => 'Minimal satu gambar harus diunggah.',
            'foto.array'       => 'Foto harus berupa array.',
            'foto.min'         => 'Minimal satu gambar harus diunggah asdasd.',
            'foto.max'         => 'Maksimal lima gambar yang boleh diunggah.',
            'foto.*.image'     => 'Setiap file harus berupa gambar.',
        ]);

        $plan = new WVPlan();
        $plan->w_vendor_id = auth()->user()->w_vendor->id;
        $plan->nama        = $req->nama;
        $plan->detail      = $req->detail;
        $plan->harga       = $req->harga;
        $plan->satuan      = $req->satuan;
        if ($req->hasFile('foto')) {
            $fotos = $req->file('foto');
            $arrFoto = $plan->foto ?? [];

            foreach ($fotos as $foto) {
                $filename = 'Ct/plan/' . str()->uuid() . '.' . $foto->extension();
                $url = Storage::disk('public')->putFileAs('/', $foto, $filename);

                $arrFoto[] = [
                    'url' => $url,
                ];
            }
            $plan->foto = $arrFoto;
        }
        $data = $plan->save();

        if ($data) {
            return redirect()->route('venue.layanan.index')->with('sukses', 'Menambah Paket Layanan');
        }
        return redirect()->route('venue.layanan.index')->with('gagal', 'Menambah Paket Layanan');
    }

    public function ke_ubah($id) {
        $plan = WVPlan::find($id);

        if (!$plan) {
            return redirect()->route('venue.layanan.index')->with('gagal', 'ID Invalid');
        }

        $currentPhotos = $plan->foto ?? [];
        $count = count($currentPhotos);

        return view('user.venue.layanan.ubah', compact('plan', 'count'));
    }

    public function ubah(Request $req, $id) {
        $req->validate([
            'nama'      => 'required|max:20',
            'detail'    => 'required',
            'harga'     => 'required|numeric',
            'satuan'    => 'required',
            'form-info' => 'required|in:add,edit',
            'foto'      => 'required_if:form-info,add|array|min:1|max:5',
            'foto.*'    => 'image',
        ],[
            'nama.required'    => 'Nama Layanan tidak boleh kosong',
            'nama.max'         => 'Nama tidak boleh lebih dari 20 karakter',
            'detail.required'  => 'Detail Layanan tidak boleh kosong',
            'harga.required'   => 'Harga tidak boleh kosong',
            'harga.numeric'    => 'Harga harus berupa numerik',
            'satuan.required'  => 'Satuan tidak boleh kosong',
            'foto.required_if' => 'Minimal satu gambar harus diunggah.',
            'foto.array'       => 'Foto harus berupa array.',
            'foto.min'         => 'Minimal satu gambar harus diunggah asdasd.',
            'foto.max'         => 'Maksimal lima gambar yang boleh diunggah.',
            'foto.*.image'     => 'Setiap file harus berupa gambar.',
        ]);

        $plan = WVPlan::find($id);

        $currentPhotos = $plan->foto ?? [];
        $count = count($currentPhotos);
        if ($count >= 5) {
            return back()->with('gagal', 'Maksimal 5 Gambar Saja');
        }

        $plan->nama = $req->nama;
        $plan->detail = $req->detail;
        $plan->harga = $req->harga;
        $plan->satuan = $req->satuan;

        if ($req->hasFile('foto')) {
            $fotos = $req->file('foto');
            $arrFoto = $plan->foto ?? [];

            foreach ($fotos as $foto) {
                $filename = 'Ct/plan/' . str()->uuid() . '.' . $foto->extension();
                $url = Storage::disk('public')->putFileAs('/', $foto, $filename);

                $arrFoto[] = [
                    'url' => $url,
                ];
            }
            $plan->foto = $arrFoto;
        }
        $data = $plan->save();

        if ($data) {
            return redirect()->route('venue.layanan.ubah', $id)->with('sukses', 'Mengubah Paket Layanan');
        }
        return redirect()->route('venue.layanan.ubah', $id)->with('gagal', 'Mengubah Paket Layanan');
    }

    public function hapus($id) {
        $plan = WVPlan::find($id);
        $photos = $plan->foto;
        foreach ($photos as $photo) {
            unlink(public_path($photo['url']));
        }
        $data = $plan->delete();

        if ($data) {
            return redirect()->route('venue.layanan.index')->with('sukses', 'Menghapus Paket Layanan');
        }
        return redirect()->route('venue.layanan.index')->with('gagal', 'Menghapus Paket Layanan');
    }

    public function hapus_foto($id, $index) {
        $plan = WVPlan::findOrFail($id);

        if (isset($plan->foto[$index])) {
            $photo = $plan->foto[$index];
            $url = $photo['url'];

            $currentFoto = $plan->foto;
            unset($currentFoto[$index]);
            $currentFoto = array_values($currentFoto);

            $plan->foto = $currentFoto;
            $plan->save();

            unlink(public_path($url));
            return back()->with('sukses', 'Menghapus Foto Plan');
        }
        return back()->with('gagal', 'Menghapus Foto Plan');
    }
}
