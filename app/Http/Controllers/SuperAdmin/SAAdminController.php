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
        $admin = Admin::where('id', $id)->first();

        $alamatArray = explode(', ', $admin->alamat);
        list($alamat_detail, $kelurahan, $kecamatan, $kota, $provinsi) = $alamatArray;

        return view('user.super-admin.daftar-admin.ubah',
            compact(
                'admin',
                'kelurahan',
                'kecamatan',
                'kota',
                'provinsi',
                'alamat_detail'
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

        $data1 = $user->delete();
        $data2 = $admin->delete();

        if ($data1 && $data2) {
            return redirect()->route('super-admin.daftar-admin.ke_daftar')->with('sukses', 'Menghapus Admin');
        }
        return redirect()->route('super-admin.daftar-admin.ke_daftar')->with('gagal', 'Menghapus Admin');
    }
}
