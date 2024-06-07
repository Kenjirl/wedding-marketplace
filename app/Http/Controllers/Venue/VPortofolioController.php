<?php

namespace App\Http\Controllers\Venue;

use App\Http\Controllers\Controller;
use App\Http\Requests\PortofolioRequest;
use App\Models\AConfiguration;
use App\Models\WVPortofolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VPortofolioController extends Controller
{
    public function index() {
        $latest_portofolio = WVPortofolio::where('w_vendor_id', auth()->user()->w_vendor->id)
                        ->orderBy('updated_at', 'desc')
                        ->take(4)
                        ->get();
        $portofolio = WVPortofolio::where('w_vendor_id', auth()->user()->w_vendor->id)
                        ->orderBy('judul', 'asc')
                        ->get();

        return view('user.venue.portofolio.index', compact('latest_portofolio', 'portofolio'));
    }

    public function ke_tambah() {
        return view('user.venue.portofolio.tambah');
    }

    public function tambah(PortofolioRequest $req) {
        $req->validated();

        $config = AConfiguration::where('nama', 'portofolio-automation')->first();

        $lokasi = $req->alamat_detail . ', ' . $req->kelurahan . ', ' . $req->kecamatan . ', ' . $req->kota . ', ' . $req->provinsi;

        $portofolio = new WVPortofolio();
        $portofolio->w_vendor_id = auth()->user()->w_vendor->id;
        $portofolio->judul = $req->judul;
        $portofolio->tanggal = $req->tanggal;
        $portofolio->detail = $req->detail;
        $portofolio->lokasi = $lokasi;

        if ($config->value) {
            $wpConfig = null;
            foreach ($config->value as $item) {
                if (isset($item['vendor']) && $item['vendor'] === 'venue') {
                    $wpConfig = $item;
                    break;
                }
            }

            if ($wpConfig) {
                $portofolio->admin_id = $wpConfig['admin_id'];
                $portofolio->status = 'diterima';
            }
        }

        if ($req->hasFile('foto')) {
            $fotos = $req->file('foto');
            $arrFoto = $portofolio->foto ?? [];

            foreach ($fotos as $foto) {
                $filename = 'Ct/portofolio/' . str()->uuid() . '.' . $foto->extension();
                $url = Storage::disk('public')->putFileAs('/', $foto, $filename);

                $arrFoto[] = [
                    'url' => $url,
                    'rejected' => false,
                ];
            }
            $portofolio->foto = $arrFoto;
        }

        $data = $portofolio->save();

        if ($data) {
            return redirect()->route('venue.portofolio.ke_ubah', $portofolio->id)->with('sukses', 'Menambah Portofolio');
        }
        return redirect()->route('venue.portofolio.index')->with('gagal', 'Menambah Portofolio');
    }

    public function ke_ubah($id) {
        $portofolio = WVPortofolio::find($id);

        if (!$portofolio) {
            return redirect()->route('venue.portofolio.index')->with('gagal', 'Portofolio tidak ditemukan');
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

        $currentPhotos = $portofolio->foto ?? [];
        $count = count($currentPhotos);

        return view('user.venue.portofolio.ubah',
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

        $portofolio = WVPortofolio::find($id);

        $config = AConfiguration::where('nama', 'portofolio-automation')->first();

        $currentPhotos = $portofolio->foto ?? [];
        $count = count($currentPhotos);
        if ($count >= 5) {
            return redirect()->route('wedding-organizer.portofolio.ke_ubah', $id)->with('gagal', 'Maksimal 5 Gambar Saja');
        }

        $lokasi = $req->alamat_detail . ', ' . $req->kelurahan . ', ' . $req->kecamatan . ', ' . $req->kota . ', ' . $req->provinsi;

        $portofolio->judul = $req->judul;
        $portofolio->detail = $req->detail;
        $portofolio->lokasi = $lokasi;

        if ($config->value) {
            $woConfig = null;
            foreach ($config->value as $item) {
                if (isset($item['vendor']) && $item['vendor'] === 'wedding-organizer') {
                    $woConfig = $item;
                    break;
                }
            }
            if ($woConfig) {
                $portofolio->admin_id = $woConfig['admin_id'];
                $portofolio->status = 'diterima';
            } else {
                $portofolio->admin_id = null;
                $portofolio->status = 'menunggu konfirmasi';
            }
        } else {
            $portofolio->admin_id = null;
            $portofolio->status = 'menunggu konfirmasi';
        }

        if ($req->hasFile('foto')) {
            $fotos = $req->file('foto');
            $arrFoto = $portofolio->foto ?? [];

            foreach ($fotos as $foto) {
                $filename = 'Ct/portofolio/' . str()->uuid() . '.' . $foto->extension();
                $url = Storage::disk('public')->putFileAs('/', $foto, $filename);

                $arrFoto[] = [
                    'url' => $url,
                    'rejected' => false,
                ];
            }
            $portofolio->foto = $arrFoto;
        }
        $data = $portofolio->save();

        if ($data) {
            return redirect()->route('venue.portofolio.ke_ubah', $id)->with('sukses', 'Mengubah Portofolio');
        }

        return redirect()->route('venue.portofolio.index')->with('gagal', 'Mengubah Portofolio');
    }

    public function hapus($id) {
        $portofolio = WVPortofolio::findOrFail($id);
        $photos = $portofolio->foto;
        foreach ($photos as $photo) {
            unlink(public_path($photo['url']));
        }
        $data = $portofolio->delete();
        if ($data) {
            return redirect()->route('venue.portofolio.index')->with('sukses', 'Menghapus Portofolio');
        }
        return redirect()->route('venue.portofolio.index')->with('gagal', 'Menghapus Portofolio');
    }

    public function hapus_foto($id, $index) {
        $portofolio = WVPortofolio::findOrFail($id);

        if (isset($portofolio->foto[$index])) {
            $photo = $portofolio->foto[$index];
            $url = $photo['url'];

            $currentFoto = $portofolio->foto;
            unset($currentFoto[$index]);
            $currentFoto = array_values($currentFoto);

            $rejectedPhotosExist = false;
            foreach ($currentFoto as $foto) {
                if ($foto['rejected']) {
                    $rejectedPhotosExist = true;
                    break;
                }
            }

            if (!$rejectedPhotosExist) {
                $config = AConfiguration::where('nama', 'portofolio-automation')->first();
                if ($config && $config->value) {
                    $wpConfig = null;
                    foreach ($config->value as $item) {
                        if (isset($item['vendor']) && $item['vendor'] === 'venue') {
                            $wpConfig = $item;
                            break;
                        }
                    }
                    if ($wpConfig) {
                        $portofolio->admin_id = $wpConfig['admin_id'];
                        $portofolio->status = 'diterima';
                    } else {
                        $portofolio->admin_id = null;
                        $portofolio->status = 'menunggu konfirmasi';
                    }
                } else {
                    $portofolio->admin_id = null;
                    $portofolio->status = 'menunggu konfirmasi';
                }
            }

            $portofolio->foto = $currentFoto;
            $portofolio->save();

            unlink(public_path($url));
            return back()->with('sukses', 'Menghapus Foto Portofolio');
        }
        return back()->with('gagal', 'Menghapus Foto Portofolio');
    }
}
