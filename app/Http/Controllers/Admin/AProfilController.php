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
        return view('admin.profil.index');
    }

    public function ke_ubah() {
        $admin = Admin::find(auth()->user()->admin->id);

        return view('admin.profil.ubah',compact('admin'));
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
                'alamat'  => $req->alamat,
            ]);

        if ($data1 && $data2) {
            return back()->with('sukses', 'Mengubah Data Diri');
        }
        return back()->with('gagal', 'Mengubah Data Diri');
    }

    public function ke_ubah_password() {
        return view('admin.profil.ubah-password');
    }

    public function ubah_password(UbahPasswordRequest $req) {
        $req->validated();

        $data = User::where('id', auth()->user()->id)
            ->update([
                'password' => Hash::make($req->password),
            ]);

        if ($data) {
            return back()->with('sukses', 'Mengubah Password');
        }
        return back()->with('gagal', 'Mengubah Password');
    }
}
