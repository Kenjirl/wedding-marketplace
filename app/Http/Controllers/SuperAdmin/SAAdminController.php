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
        $admins = Admin::orderBy('updated_at', 'desc')->get();
        return view('super-admin.daftar-admin.index', compact('admins'));
    }

    public function ke_tambah() {
        return view('super-admin.daftar-admin.tambah');
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
        $admin->alamat = $req->alamat;
        $data2 = $admin->save();

        if ($data1 && $data2) {
            return back()->with('sukses', 'Menambah Admin');
        }
        return back()->with('gagal', 'Menambah Admin');
    }

    public function ke_ubah($id) {
        $admin = Admin::find($id);

        if (!$admin) {
            return redirect()->route('super-admin.daftar-admin.ke_daftar')->with('gagal', 'ID tidak valid');
        }

        return view('super-admin.daftar-admin.ubah', compact('admin'));
    }

    public function ubah(UbahAdminRequest $req, $id) {
        $req->validated();

        $data = Admin::where('id', $id)
            ->update([
                'nama' => $req->nama,
                'gender' => $req->gender,
                'no_telp' => $req->no_telp,
                'alamat' => $req->alamat,
            ]);

        if ($data) {
            return back()->with('sukses', 'Mengubah Admin');
        }
        return back()->with('gagal', 'Mengubah Admin');
    }

    public function hapus($id) {
        $admin = Admin::where('id', $id)->first();
        $user = User::where('id', $admin->user_id)->first();

        if (!$admin || !$user) {
            return back()->with('gagal', 'ID tidak valid');
        }

        $data1 = $user->delete();
        $data2 = $admin->delete();

        if ($data1 && $data2) {
            return back()->with('sukses', 'Menghapus Admin');
        }
        return back()->with('gagal', 'Menghapus Admin');
    }
}
