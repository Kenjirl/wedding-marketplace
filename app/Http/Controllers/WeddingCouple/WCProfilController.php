<?php

namespace App\Http\Controllers\WeddingCouple;

use App\Http\Controllers\Controller;
use App\Http\Requests\UbahPasswordRequest;
use App\Http\Requests\WeddingCouple\ProfilRequest;
use App\Models\User;
use App\Models\WeddingCouple;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class WCProfilController extends Controller
{
    public function index() {
        return view('user.wedding-couple.profil.index');
    }

    public function ke_ubah() {
        $provinsi       = '';
        $kota           = '';
        $kecamatan      = '';
        $kelurahan      = '';
        $alamat_detail  = '';

        if (auth()->user()->w_couple) {
            if (auth()->user()->w_couple->alamat) {
                $alamatArray = explode(', ', auth()->user()->w_couple->alamat);
                list($alamat_detail, $kelurahan, $kecamatan, $kota, $provinsi) = $alamatArray;
            }
        }

        return view('user.wedding-couple.profil.ubah',
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

        User::where('id', auth()->user()->id)
            ->update([
                'name' => $req->username,
            ]);

        if (auth()->user()->w_couple) {
            # Update
            $data = WeddingCouple::where('id', auth()->user()->w_couple->id)
                ->update([
                    'nama'    => $req->nama,
                    'no_telp' => $req->no_telp,
                    'gender'  => $req->gender,
                ]);
        } else {
            # Make New
            $couple = new WeddingCouple();
            $couple->user_id = auth()->user()->id;
            $couple->nama    = $req->nama;
            $couple->no_telp = $req->no_telp;
            $couple->gender  = $req->gender;
            $data = $couple->save();
        }

        if ($data) {
            return redirect()->route('wedding-couple.profil.index')->with('sukses', 'Data diri anda berhasil diperbarui');
        }
        return redirect()->route('wedding-couple.profil.index')->with('gagal', 'Maaf, telah terjadi kesalahan. Data diri anda belum diperbarui');
    }

    public function ke_ubah_password() {
        return view('user.wedding-couple.profil.ubah-password');
    }

    public function ubah_password(UbahPasswordRequest $req) {
        $req->validated();

        $data = User::where('id', auth()->user()->id)
            ->update([
                'password' => Hash::make($req->password),
            ]);

        if ($data) {
            return redirect()->route('wedding-couple.profil.index')->with('sukses', 'Password anda berhasil diubah');
        }

        // Gagal save Password
        return redirect()->route('wedding-couple.profil.index')->with('gagal', 'Maaf, telah terjadi kesalahan. Password Anda belum bisa diubah');
    }

    public function ke_ubah_foto() {
        return view('user.wedding-couple.profil.ubah-foto');
    }

    public function ubah_foto(Request $req) {
        $req->validate([
            'foto_profil' => 'required|image'
        ]);

        if ($req->hasFile('foto_profil')) {
            $foto_profil = $req->file('foto_profil');

            $foto_profil = Storage::disk('public')->putFileAs('/',
                $foto_profil,
                'WC/profil/'.str()->uuid() . '.' . $foto_profil->extension()
            );

            $data = WeddingCouple::where('user_id', auth()->user()->id)
                ->update([
                    'foto_profil' => $foto_profil,
                ]);

            if ($data) {
                return redirect()->route('wedding-couple.profil.index')->with('sukses', 'Foto profil anda berhasil diubah');
            }
        }

        return redirect()->route('wedding-couple.profil.index')->with('gagal', 'Maaf, telah terjadi kesalahan. Foto profil Anda belum bisa diubah');
    }
}
