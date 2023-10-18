<?php

namespace App\Http\Controllers\WeddingOrganizer;

use App\Http\Controllers\Controller;
use App\Http\Requests\UbahPasswordRequest;
use App\Http\Requests\WeddingOrganizer\ProfilRequest;
use App\Models\User;
use App\Models\WeddingOrganizer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class WOProfilController extends Controller
{
    public function ke_profil() {
        return view('user.wedding-organizer.profil.index');
    }

    public function ke_ubah_profil() {
        $provinsi       = '';
        $kota           = '';
        $kecamatan      = '';
        $kelurahan      = '';
        $alamat_detail  = '';

        if (auth()->user()->w_organizer) {
            if (auth()->user()->w_organizer->alamat) {
                $alamatArray = explode(', ', auth()->user()->w_organizer->alamat);
                list($alamat_detail, $kelurahan, $kecamatan, $kota, $provinsi) = $alamatArray;
            }
        }

        return view('user.wedding-organizer.profil.ubah-profil',
                    compact(
                        'provinsi',
                        'kota',
                        'kecamatan',
                        'kelurahan',
                        'alamat_detail'
                    ));
    }

    public function ubah_profil(ProfilRequest $req) {
        $req->validated();

        $kota_operasi = null;
        $alamat = $req->alamat_detail . ', ' . $req->kelurahan . ', ' . $req->kecamatan . ', ' . $req->kota . ', ' . $req->provinsi;

        if ($req->basis_operasi == 'Hanya di Dalam Kota') {
            # Perlu Data Kota Operasi
            $kota_operasi = $req->kota_operasi;
        }

        User::where('id', auth()->user()->id)
            ->update([
                'name' => $req->username,
            ]);

        if (auth()->user()->w_organizer) {
            # Update
            $data = WeddingOrganizer::where('id', auth()->user()->w_organizer->id)
                ->update([
                    'nama_pemilik'   => $req->nama_pemilik,
                    'nama_perusahaan'=> $req->nama_perusahaan,
                    'no_telp'        => $req->no_telp,
                    'basis_operasi'  => $req->basis_operasi,
                    'kota_operasi'   => $kota_operasi,
                    'alamat'         => $alamat,
                ]);
        } else {
            # Make New
            $organizer = new WeddingOrganizer();
            $organizer->user_id         = auth()->user()->id;
            $organizer->nama_pemilik    = $req->nama_pemilik;
            $organizer->nama_perusahaan = $req->nama_perusahaan;
            $organizer->no_telp         = $req->no_telp;
            $organizer->basis_operasi   = $req->basis_operasi;
            $organizer->kota_operasi    = $kota_operasi;
            $organizer->alamat          = $alamat;
            $data = $organizer->save();
        }

        if ($data) {
            return redirect()->route('wedding-organizer.ke_profil')->with('sukses', 'Data diri anda berhasil diperbarui');
        }

        return redirect()->route('wedding-organizer.ke_profil')->with('gagal', 'Maaf, telah terjadi kesalahan. Data diri anda belum diperbarui');
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
            return redirect()->route('wedding-organizer.ke_profil')->with('sukses', 'Password anda berhasil diubah');
        }

        // Gagal save Password
        return redirect()->route('wedding-organizer.ke_profil')->with('gagal', 'Maaf, telah terjadi kesalahan. Password Anda belum bisa diubah');
    }

    public function ke_ubah_foto() {
        return view('user.wedding-organizer.profil.ubah-foto');
    }

    public function ubah_foto(Request $req) {
        $req->validate([
            'foto_profil' => 'required|image'
        ]);

        if ($req->hasFile('foto_profil')) {
            $foto_profil = $req->file('foto_profil');

            $foto_profil = Storage::disk('public')->putFileAs('/',
                $foto_profil,
                'WO/profil/'.str()->uuid() . '.' . $foto_profil->extension()
            );

            $data = WeddingOrganizer::where('user_id', auth()->user()->id)
                ->update([
                    'foto_profil' => $foto_profil,
                ]);

            if ($data) {
                return redirect()->route('wedding-organizer.ke_profil')->with('sukses', 'Foto profil anda berhasil diubah');
            }
        }

        return redirect()->route('wedding-organizer.ke_profil')->with('gagal', 'Maaf, telah terjadi kesalahan. Foto profil Anda belum bisa diubah');
    }
}
