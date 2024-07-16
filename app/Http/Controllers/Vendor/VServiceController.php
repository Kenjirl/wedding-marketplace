<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\WVJenis;
use App\Models\WVPlan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VServiceController extends Controller
{
    protected $satuan;

    public function __construct()
    {
        $this->satuan = [
            'Makanan' => ['box', 'paket', 'pan', 'porsi', 'tray', 'tumpeng'],
            'Minuman' => ['galon', 'liter'],
            'Lain-lain' => ['item', 'set'],
            'Waktu' => ['hari', 'jam', 'minggu'],
            'Paket' => ['paket meeting', 'paket pernikahan', 'paket ulang tahun', 'paket'],
            'Fasilitas' => ['dekorasi', 'gedung', 'kursi', 'meja', 'sound system'],
            'Layanan' => ['acara', 'jam', 'sesi'],
            'Dekorasi dan Peralatan' => ['item'],
            'Hasil Akhir' => ['album', 'foto'],
        ];
    }

    public function index() {
        $plans = WVPlan::where('w_vendor_id', auth()->user()->w_vendor->id)
                ->with(['ratings'])
                ->get();

        foreach ($plans as $plan) {
            $totalRating = $plan->ratings->sum('rating');
            $ratingCount = $plan->ratings->count();
            $plan->rate = $ratingCount > 0 ? $totalRating / $ratingCount : null;
        }

        return view('vendor.layanan.index', compact('plans'));
    }

    public function ke_tambah() {
        $satuans = $this->satuan;
        $j_vendors = WVJenis::where('w_vendor_id', auth()->user()->w_vendor->id)->get();

        return view('vendor.layanan.tambah', compact('satuans', 'j_vendors'));
    }

    public function tambah(Request $req) {
        $req->validate([
            'nama'          => 'required|max:20',
            'j_vendor'      => 'required',
            'detail'        => 'required',
            'harga'         => 'required',
            'satuan'        => 'required',
            'jenis_layanan' => 'required',
            'foto'          => 'required_if:jenis_layanan,produk|array|min:1|max:5',
            'foto.*'        => 'required_if:jenis_layanan,produk|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ],[
            'nama.required'          => 'Nama Layanan tidak boleh kosong',
            'j_vendor.required'      => 'Jenis Vendor tidak boleh kosong',
            'nama.max'               => 'Nama tidak boleh lebih dari 20 karakter',
            'detail.required'        => 'Detail Layanan tidak boleh kosong',
            'harga.required'         => 'Harga tidak boleh kosong',
            'harga.numeric'          => 'Harga harus berupa numerik',
            'satuan.required'        => 'Satuan tidak boleh kosong',
            'jenis_layanan.required' => 'Jenis Layanan tidak boleh kosong',
            'foto.required_if'       => 'Foto tidak boleh kosong.',
            'foto.array'             => 'Foto harus berupa array.',
            'foto.min'               => 'Minimal satu gambar harus diunggah asdasd.',
            'foto.max'               => 'Maksimal lima gambar yang boleh diunggah.',
            'foto.*.image'           => 'File harus berupa gambar',
            'foto.*.required_if'     => 'Foto tidak boleh kosong.',
            'foto.*.mimes'           => 'Format gambar harus jpeg, png, jpg, gif, atau svg',
            'foto.*.max'             => 'Ukuran gambar tidak boleh lebih dari 2MB',
        ]);

        $plan = new WVPlan();
        $plan->w_vendor_id       = auth()->user()->w_vendor->id;
        $plan->m_jenis_vendor_id = $req->j_vendor;
        $plan->nama              = $req->nama;
        $plan->detail            = $req->detail;
        $plan->harga             = $req->harga;
        $plan->satuan            = $req->satuan;
        $plan->jenis_layanan     = $req->jenis_layanan;

        if ($req->jenis_layanan == 'produk' && $req->hasFile('foto')) {
            $fotos = $req->file('foto');
            $arrFoto = $plan->foto ?? [];

            foreach ($fotos as $foto) {
                $filename = 'v/plan/' . str()->uuid() . '.' . $foto->extension();
                $url = Storage::disk('public')->putFileAs('/', $foto, $filename);

                $arrFoto[] = [
                    'url' => $url,
                ];
            }
            $plan->foto = $arrFoto;
        }
        $data = $plan->save();

        if ($data) {
            return redirect()->route('vendor.layanan.ke_ubah', $plan->id)->with('sukses', 'Menambah Paket Layanan');
        }
        return redirect()->route('vendor.layanan.index')->with('gagal', 'Menambah Paket Layanan');
    }

    public function ke_ubah($id) {
        $plan = WVPlan::find($id);

        if (!$plan) {
            return back()->with('gagal', 'ID Invalid');
        }

        $satuans = $this->satuan;

        $currentPhotos = $plan->foto ?? [];
        $count = count($currentPhotos);

        return view('vendor.layanan.ubah', compact('plan', 'satuans', 'count'));
    }

    public function ubah(Request $req, $id) {
        $req->validate([
            'nama'          => 'required|max:20',
            'detail'        => 'required',
            'harga'         => 'required',
            'satuan'        => 'required',
            'foto'          => 'nullable|array|min:1|max:5',
            'foto.*'        => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ],[
            'nama.required'          => 'Nama Layanan tidak boleh kosong',
            'nama.max'               => 'Nama tidak boleh lebih dari 20 karakter',
            'detail.required'        => 'Detail Layanan tidak boleh kosong',
            'harga.required'         => 'Harga tidak boleh kosong',
            'harga.numeric'          => 'Harga harus berupa numerik',
            'satuan.required'        => 'Satuan tidak boleh kosong',
            'foto.array'             => 'Foto harus berupa array.',
            'foto.min'               => 'Minimal satu gambar harus diunggah asdasd.',
            'foto.max'               => 'Maksimal lima gambar yang boleh diunggah.',
            'foto.*.image'           => 'File harus berupa gambar',
            'foto.*.mimes'           => 'Format gambar harus jpeg, png, jpg, gif, atau svg',
            'foto.*.max'             => 'Ukuran gambar tidak boleh lebih dari 2MB',
        ]);

        $plan = WVPlan::find($id);

        $currentPhotos = $plan->foto ?? [];
        $count = count($currentPhotos);
        if ($count > 5) {
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
            return back()->with('sukses', 'Mengubah Paket Layanan');
        }
        return back()->with('gagal', 'Mengubah Paket Layanan');
    }

    public function hapus($id) {
        $plan = WVPlan::where('id', $id)->first();

        $photos = $plan->foto;
        foreach ($photos as $photo) {
            unlink(public_path($photo['url']));
        }

        $data = $plan->delete();

        if ($data) {
            return redirect()->route('vendor.layanan.index')->with('sukses', 'Menghapus Paket Layanan');
        }
        return redirect()->route('vendor.layanan.index')->with('gagal', 'Menghapus Paket Layanan');
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
            return back()->with('sukses', 'Menghapus Foto Paket Layanan');
        }
        return back()->with('gagal', 'Menghapus Foto Paket Layanan');
    }
}
