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

        return view('user.admin.profil.ubah',
            compact(
                'provinsi',
                'kota',
                'kecamatan',
                'kelurahan',
                'alamat_detail'
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
                'nama' => $req->nama,
                'gender' => $req->gender,
                'no_telp' => $req->no_telp,
                'alamat' => $req->alamat_detail . ', ' . $req->kelurahan . ', ' . $req->kecamatan . ', ' . $req->kota . ', ' . $req->provinsi,
            ]);

        if ($data1 && $data2) {
            return redirect()->route('admin.profil.index')->with('sukses', 'Data diri anda berhasil diperbarui');
        }
        return redirect()->route('admin.profil.index')->with('gagal', 'Maaf, telah terjadi kesalahan. Data diri anda belum diperbarui');
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
            return redirect()->route('admin.profil.index')->with('sukses', 'Password anda berhasil diubah');
        }
        return redirect()->route('admin.profil.index')->with('gagal', 'Maaf, telah terjadi kesalahan. Password Anda belum bisa diubah');
    }
}
