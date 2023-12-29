<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SuperAdmin\TambahAdminRequest;
use App\Http\Requests\SuperAdmin\UbahAdminRequest;
use App\Models\Admin;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Collection;

class SAAdminController extends Controller
{
    public function ke_daftar() {
        $admins = Admin::all();
        return view('user.super-admin.daftar-admin.index', compact('admins'));
    }

    public function ke_tambah() {
        return view('user.super-admin.daftar-admin.tambah');
    }

    public function tambah(TambahAdminRequest $req) {
        $req->validated();

        $user = new User();
        $user->name = $req->username;
        $user->email = $req->email;
        $user->email_verified_at = Carbon::now();
        $user->password = Hash::make('password123');
        $user->role = 'admin';
        $user->verification_code = sha1(time());
        $data1 = $user->save();

        $admin = new Admin();
        $admin->user_id = $user->id;
        $admin->nama = $req->nama;
        $admin->gender = $req->gender;
        $admin->no_telp = $req->no_telp;
        $admin->alamat = $req->alamat_detail . ', ' . $req->kelurahan . ', ' . $req->kecamatan . ', ' . $req->kota . ', ' . $req->provinsi;
        $data2 = $admin->save();

        if ($data1 && $data2) {
            return redirect()->route('super-admin.daftar-admin.ke_daftar')->with('sukses', 'Menambah Admin');
        }
        return redirect()->route('super-admin.daftar-admin.ke_daftar')->with('gagal', 'Menambah Admin');
    }

    public function ke_ubah($id) {
        $admin = Admin::find($id);

        if (!$admin) {
            return redirect()->route('super-admin.daftar-admin.ke_daftar')->with('gagal', 'ID Invalid');
        }

        $alamatArray = explode(', ', $admin->alamat);
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

        return view('user.super-admin.daftar-admin.ubah',
            compact(
                'admin',
                'provinsi',
                'kota',
                'kelurahan',
                'kecamatan',
                'alamat_detail',
                'provinsiData',
                'filteredKotaData',
                'filteredKecamatanData',
                'filteredKelurahanData',
            ));
    }

    public function ubah(UbahAdminRequest $req, $id) {
        $req->validated();

        $data = Admin::where('id', $id)
            ->update([
                'nama' => $req->nama,
                'gender' => $req->gender,
                'no_telp' => $req->no_telp,
                'alamat' => $req->alamat_detail . ', ' . $req->kelurahan . ', ' . $req->kecamatan . ', ' . $req->kota . ', ' . $req->provinsi,
            ]);

        if ($data) {
            return redirect()->route('super-admin.daftar-admin.ke_daftar')->with('sukses', 'Mengubah Admin');
        }
        return redirect()->route('super-admin.daftar-admin.ke_daftar')->with('gagal', 'Mengubah Admin');
    }

    public function hapus($id) {
        $admin = Admin::where('id', $id)->first();
        $user = User::where('id', $admin->user_id)->first();

        if (!$admin || !$user) {
            return redirect()->route('super-admin.daftar-admin.ke_daftar')->with('gagal', 'ID Invalid');
        }

        $data1 = $user->delete();
        $data2 = $admin->delete();

        if ($data1 && $data2) {
            return redirect()->route('super-admin.daftar-admin.ke_daftar')->with('sukses', 'Menghapus Admin');
        }
        return redirect()->route('super-admin.daftar-admin.ke_daftar')->with('gagal', 'Menghapus Admin');
    }
}
