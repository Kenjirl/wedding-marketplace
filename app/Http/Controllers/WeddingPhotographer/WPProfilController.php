<?php

namespace App\Http\Controllers\WeddingPhotographer;

use App\Http\Controllers\Controller;
use App\Http\Requests\UbahPasswordRequest;
use App\Http\Requests\WeddingPhotographer\ProfilRequest;
use App\Models\User;
use App\Models\WeddingPhotographer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class WPProfilController extends Controller
{
    public function ke_profil() {
        return view('user.wedding-photographer.profil.index');
    }

    public function ke_ubah_profil() {
        $provinsi       = '';
        $kota           = '';
        $kecamatan      = '';
        $kelurahan      = '';
        $alamat_detail  = '';

        if (auth()->user()->w_photographer) {
            if (auth()->user()->w_photographer->alamat) {
                $alamatArray = explode(', ', auth()->user()->w_photographer->alamat);
                list($alamat_detail, $kelurahan, $kecamatan, $kota, $provinsi) = $alamatArray;
            }
        }

        return view('user.wedding-photographer.profil.ubah-profil',
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

        $gender = null;
        $kota_operasi = null;
        $alamat = null;

        if ($req->basis_operasi == 'Hanya di Dalam Kota') {
            # Perlu Data Kota Operasi
            $kota_operasi = $req->kota_operasi;
        }

        if ($req->status == 'Organisasi') {
            # Perlu Data Alamat Detail
            $alamat = $req->alamat_detail . ', ' . $req->kelurahan . ', ' . $req->kecamatan . ', ' . $req->kota . ', ' . $req->provinsi;
        } else {
            $gender = $req->gender;
        }

        User::where('id', auth()->user()->id)
            ->update([
                'name' => $req->username,
            ]);

        if (auth()->user()->w_photographer) {
            # Update
            $data = WeddingPhotographer::where('id', auth()->user()->w_photographer->id)
                ->update([
                    'nama'          => $req->nama,
                    'no_telp'       => $req->no_telp,
                    'gender'        => $gender,
                    'basis_operasi' => $req->basis_operasi,
                    'status'        => $req->status,
                    'kota_operasi'  => $kota_operasi,
                    'alamat'        => $alamat,
                ]);
        } else {
            # Make New
            $photographer = new WeddingPhotographer();
            $photographer->user_id       = auth()->user()->id;
            $photographer->nama          = $req->nama;
            $photographer->no_telp       = $req->no_telp;
            $photographer->gender        = $gender;
            $photographer->basis_operasi = $req->basis_operasi;
            $photographer->status        = $req->status;
            $photographer->kota_operasi  = $kota_operasi;
            $photographer->alamat        = $alamat;
            $data = $photographer->save();
        }

        if ($data) {
            return redirect()->route('wedding-photographer.ke_profil')->with('sukses', 'Data diri anda berhasil diperbarui');
        }

        return redirect()->route('wedding-photographer.ke_profil')->with('gagal', 'Maaf, telah terjadi kesalahan. Data diri anda belum diperbarui');
    }

    public function ke_ubah_password() {
        return view('user.wedding-photographer.profil.ubah-password');
    }

    public function ubah_password(UbahPasswordRequest $req) {
        $req->validated();

        $data = User::where('id', auth()->user()->id)
            ->update([
                'password' => Hash::make($req->password),
            ]);

        if ($data) {
            return redirect()->route('wedding-photographer.ke_profil')->with('sukses', 'Password anda berhasil diubah');
        }

        // Gagal save Password
        return redirect()->route('wedding-photographer.ke_profil')->with('gagal', 'Maaf, telah terjadi kesalahan. Password Anda belum bisa diubah');
    }
}
