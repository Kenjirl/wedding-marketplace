<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProfilRequest;
use App\Http\Requests\UbahPasswordRequest;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AProfilController extends Controller
{
    public function index() {
        return view('user.admin.profil.index');
    }

    public function ke_ubah() {
        $alamatArray = explode(', ', auth()->user()->admin->alamat);
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

        return view('user.admin.profil.ubah',
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

        $data1 = User::where('id', auth()->user()->id)
            ->update([
                'name' => $req->username,
            ]);

        $data2 = Admin::where('id', auth()->user()->admin->id)
            ->update([
                'nama'    => $req->nama,
                'gender'  => $req->gender,
                'no_telp' => $req->no_telp,
                'alamat'  => $req->alamat_detail . ', ' . $req->kelurahan . ', ' . $req->kecamatan . ', ' . $req->kota . ', ' . $req->provinsi,
            ]);

        if ($data1 && $data2) {
            return redirect()->route('admin.profil.index')->with('sukses', 'Mengubah Data Diri');
        }
        return redirect()->route('admin.profil.index')->with('gagal', 'Mengubah Data Diri');
    }

    public function ke_ubah_password() {
        return view('user.admin.profil.ubah-password');
    }

    public function ubah_password(UbahPasswordRequest $req) {
        $req->validated();

        $data = User::where('id', auth()->user()->id)
            ->update([
                'password' => Hash::make($req->password),
            ]);

        if ($data) {
            return redirect()->route('admin.profil.index')->with('sukses', 'Mengubah Password');
        }
        return redirect()->route('admin.profil.index')->with('gagal', 'Mengubah Password');
    }
}
