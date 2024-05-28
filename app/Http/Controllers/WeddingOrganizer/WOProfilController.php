<?php

namespace App\Http\Controllers\WeddingOrganizer;

use App\Http\Controllers\Controller;
use App\Http\Requests\UbahPasswordRequest;
use App\Http\Requests\WeddingOrganizer\ProfilRequest;
use App\Models\User;
use App\Models\WVendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class WOProfilController extends Controller
{
    public function index() {
        return view('user.wedding-organizer.profil.index');
    }

    public function ke_ubah() {
        $provinsi       = '';
        $kota           = '';
        $kecamatan      = '';
        $kelurahan      = '';
        $alamat_detail  = '';

        if (auth()->user()->w_vendor) {
            if (auth()->user()->w_vendor->alamat) {
                $alamatArray = explode(', ', auth()->user()->w_vendor->alamat);
                list($alamat_detail, $kelurahan, $kecamatan, $kota, $provinsi) = $alamatArray;
            }
        }

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

        return view('user.wedding-organizer.profil.ubah',
            compact(
                'provinsi',
                'kota',
                'kecamatan',
                'kelurahan',
                'alamat_detail',
                'provinsiData',
                'filteredKotaData',
                'filteredKecamatanData',
                'filteredKelurahanData',
            ));
    }

    public function ubah(ProfilRequest $req) {
        $req->validated();

        $kota_operasi = null;
        $alamat = $req->alamat_detail . ', ' . $req->kelurahan . ', ' . $req->kecamatan . ', ' . $req->kota . ', ' . $req->provinsi;

        if ($req->basis_operasi == 'Hanya di Dalam Kota') {
            $kota_operasi = $req->kota;
        }

        $filteredRekening = array_filter($req->rekening, function ($value) {
            return !is_null($value);
        });

        $arrRekening = [];
        foreach ($filteredRekening as $bank => $nomorRekening) {
            $arrRekening[] = [
                'jenis' => $bank,
                'nomor' => $nomorRekening
            ];
        }

        User::where('id', auth()->user()->id)
            ->update([
                'name' => $req->username,
            ]);

        if (auth()->user()->w_vendor) {
            # Update
            $data = WVendor::where('id', auth()->user()->w_vendor->id)
                ->update([
                    'nama'          => $req->nama,
                    'no_telp'       => $req->no_telp,
                    'basis_operasi' => $req->basis_operasi,
                    'kota_operasi'  => $kota_operasi,
                    'alamat'        => $alamat,
                    'rekening'      => $arrRekening,
                ]);
        } else {
            # Make New
            $organizer = new WVendor();
            $organizer->user_id         = auth()->user()->id;
            $organizer->nama            = $req->nama;
            $organizer->no_telp         = $req->no_telp;
            $organizer->basis_operasi   = $req->basis_operasi;
            $organizer->kota_operasi    = $kota_operasi;
            $organizer->alamat          = $alamat;
            $organizer->jenis           = auth()->user()->role;
            $organizer->rekening        = $arrRekening;
            $data = $organizer->save();
        }

        if ($data) {
            return redirect()->route('wedding-organizer.profil.index')->with('sukses', 'Mengubah Data Diri');
        }

        return redirect()->route('wedding-organizer.profil.index')->with('gagal', 'Mengubah Data Diri');
    }

    public function ke_ubah_password() {
        return view('user.wedding-organizer.profil.ubah-password');
    }

    public function ubah_password(UbahPasswordRequest $req) {
        $req->validated();

        $data = User::where('id', auth()->user()->id)
            ->update([
                'password' => Hash::make($req->password),
            ]);

        if ($data) {
            return redirect()->route('wedding-organizer.profil.index')->with('sukses', 'Mengubah Password');
        }

        // Gagal save Password
        return redirect()->route('wedding-organizer.profil.index')->with('gagal', 'Mengubah Password');
    }

    public function ke_ubah_foto() {
        return view('user.wedding-organizer.profil.ubah-foto');
    }

    public function ubah_foto(Request $req) {
        $req->validate([
            'foto_profil' => 'required|image'
        ]);

        $foto_profil_lama = auth()->user()->w_vendor->foto_profil;
        if ($foto_profil_lama) {
            unlink(public_path($foto_profil_lama));
        }

        if ($req->hasFile('foto_profil')) {
            $foto_profil = $req->file('foto_profil');

            $foto_profil = Storage::disk('public')->putFileAs('/',
                $foto_profil,
                'WO/profil/'.str()->uuid() . '.' . $foto_profil->extension()
            );

            $data = WVendor::where('user_id', auth()->user()->id)
                ->update([
                    'foto_profil' => $foto_profil,
                ]);

            if ($data) {
                return redirect()->route('wedding-organizer.profil.index')->with('sukses', 'Mengubah Foto Profil');
            }
        }

        return redirect()->route('wedding-organizer.profil.index')->with('gagal', 'Mengubah Foto Profil');
    }
}
