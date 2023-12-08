<?php

namespace App\Http\Controllers\WeddingOrganizer;

use App\Http\Controllers\Controller;
use App\Http\Requests\PortofolioRequest;
use App\Models\AConfiguration;
use App\Models\WOPortofolio;
use App\Models\WOPortofolioPhoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WOPortofolioController extends Controller
{
    public function index() {
        $latest_portofolio = WOPortofolio::where('w_organizer_id', auth()->user()->w_organizer->id)
                        ->orderBy('updated_at', 'desc')
                        ->take(4)
                        ->get();
        $portofolio = WOPortofolio::where('w_organizer_id', auth()->user()->w_organizer->id)
                        ->orderBy('judul', 'asc')
                        ->get();

        return view('user.wedding-organizer.portofolio.index', compact('latest_portofolio', 'portofolio'));
    }

    public function ke_tambah() {
        return view('user.wedding-organizer.portofolio.tambah');
    }

    public function tambah(PortofolioRequest $req) {
        $req->validated();

        $config = AConfiguration::where('nama', 'portofolio_wo')->first();

        $lokasi = $req->alamat_detail . ', ' . $req->kelurahan . ', ' . $req->kecamatan . ', ' . $req->kota . ', ' . $req->provinsi;

        $portofolio = new WOPortofolio();
        $portofolio->w_organizer_id = auth()->user()->w_organizer->id;
        $portofolio->judul = $req->judul;
        $portofolio->tanggal = $req->tanggal;
        $portofolio->detail = $req->detail;
        $portofolio->lokasi = $lokasi;

        if ($config->automation == 1) {
            $portofolio->admin_id = $config->admin_id;
            $portofolio->status = 'diterima';
        }

        $data1 = $portofolio->save();

        $data2 = false;
        if ($req->hasFile('foto')) {
            $foto = $req->file('foto');

            $url = Storage::disk('public')->putFileAs('/',
                $foto,
                'WO/portofolio/' . str()->uuid() . '.' . $foto->extension()
            );

            $f_portofolio = new WOPortofolioPhoto();
            $f_portofolio->w_o_portofolio_id = $portofolio->id;
            $f_portofolio->url = $url;
            $data2 = $f_portofolio->save();
        }

        if ($data1 && $data2) {
            return redirect()->route('wedding-organizer.portofolio.ke_ubah', $portofolio->id)->with('sukses', 'Menambah Portofolio');
        }
        return redirect()->route('wedding-organizer.portofolio.index')->with('gagal', 'Menambah Portofolio');
    }

    public function ke_ubah($id) {
        $portofolio = WOPortofolio::find($id);

        if (!$portofolio) {
            return redirect()->route('wedding-organizer.portofolio.index')->with('gagal', 'Portofolio tidak ditemukan');
        }

        $provinsi       = '';
        $kota           = '';
        $kecamatan      = '';
        $kelurahan      = '';
        $alamat_detail  = '';

        $alamatArray = explode(', ', $portofolio->lokasi);
        list($alamat_detail, $kelurahan, $kecamatan, $kota, $provinsi) = $alamatArray;

        // Load data JSON untuk dropdown
        $provinsiData = collect(json_decode(file_get_contents(public_path('json/provinsi.json'))))->sortBy('name');
        $kotaData = collect(json_decode(file_get_contents(public_path('json/kabupaten.json'))));
        $kecamatanData = collect(json_decode(file_get_contents(public_path('json/kecamatan.json'))));
        $kelurahanData = collect(json_decode(file_get_contents(public_path('json/kelurahan.json'))));

        // Cari ID Provinsi berdasarkan nama Provinsi
        $selectedProvinsi = $provinsiData->firstWhere('name', $provinsi);
        $provinsiId = $selectedProvinsi ? $selectedProvinsi->id : null;

        // Filter data Kabupaten berdasarkan ID Provinsi
        $filteredKotaData = $kotaData->where('provinsi_id', $provinsiId)->sortBy('name');

        // Cari ID Kabupaten berdasarkan nama Kabupaten
        $selectedKota = $filteredKotaData->firstWhere('name', $kota);
        $kotaId = $selectedKota ? $selectedKota->id : null;

        // Filter data Kecamatan berdasarkan ID Kabupaten
        $filteredKecamatanData = $kecamatanData->where('kabupaten_id', $kotaId)->sortBy('name');

        // Cari ID Kecamatan berdasarkan nama Kecamatan
        $selectedKecamatan = $filteredKecamatanData->firstWhere('name', $kecamatan);
        $kecamatanId = $selectedKecamatan ? $selectedKecamatan->id : null;

        // Filter data Kelurahan berdasarkan ID Kecamatan
        $filteredKelurahanData = $kelurahanData->where('kecamatan_id', $kecamatanId)->sortBy('name');

        $count = WOPortofolioPhoto::where('w_o_portofolio_id', $id)->count();

        return view('user.wedding-organizer.portofolio.ubah',
            compact(
                'portofolio',
                'provinsi',
                'kota',
                'kecamatan',
                'kelurahan',
                'alamat_detail',
                'provinsiData',
                'filteredKotaData',
                'filteredKecamatanData',
                'filteredKelurahanData',
                'count'
            ));
    }

    public function ubah(PortofolioRequest $req, $id) {
        $req->validated();

        $config = AConfiguration::where('nama', 'portofolio_wo')->first();

        $count = WOPortofolioPhoto::where('w_o_portofolio_id', $id)->count();
        if ($count >= 5) {
            return redirect()->route('wedding-organizer.portofolio.ke_ubah', $id)->with('gagal', 'Maksimal 5 Gambar Saja');
        }

        $lokasi = $req->alamat_detail . ', ' . $req->kelurahan . ', ' . $req->kecamatan . ', ' . $req->kota . ', ' . $req->provinsi;

        $portofolio = WOPortofolio::find($id);
        $portofolio->judul = $req->judul;
        $portofolio->detail = $req->detail;
        $portofolio->lokasi = $lokasi;
        if ($config->automation) {
            $portofolio->admin_id = $config->admin_id;
            $portofolio->status = 'diterima';
        } else {
            $portofolio->admin_id = null;
            $portofolio->status = 'menunggu konfirmasi';
        }
        $data1 = $portofolio->save();

        $data2 = false;
        if ($req->hasFile('foto')) {
            $foto = $req->file('foto');

            $url = Storage::disk('public')->putFileAs('/',
                $foto,
                'WO/portofolio/' . str()->uuid() . '.' . $foto->extension()
            );

            $f_portofolio = new WOPortofolioPhoto();
            $f_portofolio->w_o_portofolio_id = $id;
            $f_portofolio->url = $url;
            $data2 = $f_portofolio->save();

            if ($data1 && $data2) {
                return redirect()->route('wedding-organizer.portofolio.ke_ubah', $id)->with('sukses', 'Mengubah Portofolio');
            }
        }

        if ($data1) {
            return redirect()->route('wedding-organizer.portofolio.ke_ubah', $id)->with('sukses', 'Mengubah Portofolio');
        }

        return redirect()->route('wedding-organizer.portofolio.index')->with('gagal', 'Mengubah Portofolio');
    }

    public function hapus($id) {
        $photos = WOPortofolioPhoto::where('w_o_portofolio_id', $id)->get();

        foreach ($photos as $foto) {
            unlink(public_path($foto->url));
            $foto->delete();
        }

        $portofolio = WOPortofolio::where('id', $id)->first();
        $data = $portofolio->delete();

        if ($data) {
            return redirect()->route('wedding-organizer.portofolio.index')->with('sukses', 'Menghapus Portofolio');
        }
        return redirect()->route('wedding-organizer.portofolio.index')->with('gagal', 'Menghapus Portofolio');
    }

    public function hapus_foto($id) {
        $foto = WOPortofolioPhoto::where('id', $id)->first();
        $url = $foto->url;
        $data = $foto->delete();

        if ($data) {
            unlink(public_path($url));
            return back()->with('sukses', 'Menghapus Foto Portofolio');
        }
        return back()->with('gagal', 'Menghapus Foto Portofolio');
    }
}
