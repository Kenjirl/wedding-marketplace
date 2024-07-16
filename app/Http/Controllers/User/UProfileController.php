<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\UbahPasswordRequest;
use App\Http\Requests\WeddingCouple\ProfilRequest;
use App\Models\User;
use App\Models\WCouple;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UProfileController extends Controller
{
    public function index() {
        return view('user.profil.index');
    }

    public function ke_ubah() {
        return view('user.profil.ubah');
    }

    public function ubah(ProfilRequest $req) {
        $req->validated();

        User::where('id', auth()->user()->id)
            ->update([
                'name' => $req->username,
            ]);

        if (auth()->user()->w_couple) {
            # Update
            $data = WCouple::where('id', auth()->user()->w_couple->id)
                ->update([
                    'nama'    => $req->nama,
                    'no_telp' => $req->no_telp,
                ]);
        } else {
            # Make New
            $couple = new WCouple();
            $couple->user_id = auth()->user()->id;
            $couple->nama    = $req->nama;
            $couple->no_telp = $req->no_telp;
            $data = $couple->save();
        }

        if ($data) {
            return back()->with('sukses', 'Mengubah Data Diri');
        }
        return back()->with('gagal', 'Mengubah Data Diri');
    }

    public function ke_ubah_password() {
        return view('user.profil.ubah-password');
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

    public function ke_ubah_foto() {
        return view('user.profil.ubah-foto');
    }

    public function ubah_foto(Request $req) {
        $req->validate([
            'foto_profil' => 'required|image'
        ]);

        $foto_profil_lama = auth()->user()->w_couple->foto_profil;
        if ($foto_profil_lama) {
            unlink(public_path($foto_profil_lama));
        }

        if ($req->hasFile('foto_profil')) {
            $foto_profil = $req->file('foto_profil');

            $foto_profil = Storage::disk('public')->putFileAs('/',
                $foto_profil,
                'u/profil/'.str()->uuid() . '.' . $foto_profil->extension()
            );

            $data = WCouple::where('user_id', auth()->user()->id)
                ->update([
                    'foto_profil' => $foto_profil,
                ]);

            if ($data) {
                return back()->with('sukses', 'Mengubah Foto Profil');
            }
        }

        return back()->with('gagal', 'Mengubah Foto Profil');
    }
}
