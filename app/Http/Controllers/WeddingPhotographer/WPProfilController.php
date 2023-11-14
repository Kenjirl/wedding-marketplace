<?php

namespace App\Http\Controllers\WeddingPhotographer;

use App\Http\Controllers\Controller;
use App\Http\Requests\UbahPasswordRequest;
use App\Http\Requests\WeddingPhotographer\ProfilRequest;
use App\Models\User;
use App\Models\WPhotographer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class WPProfilController extends Controller
{
    public function index() {
        return view('user.wedding-photographer.profil.index');
    }

    public function ke_ubah() {
        $provinsi       = '';
        $kota           = '';
        $kecamatan      = '';
        $kelurahan      = '';
        $alamat_detail  = '';

        if (auth()->user()->w_photographer && auth()->user()->w_photographer->alamat) {
            $alamatArray = explode(', ', auth()->user()->w_photographer->alamat);
            list($alamat_detail, $kelurahan, $kecamatan, $kota, $provinsi) = $alamatArray;
        }

        return view('user.wedding-photographer.profil.ubah',
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
            $data = WPhotographer::where('id', auth()->user()->w_photographer->id)
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
            $photographer = new WPhotographer();
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
            return redirect()->route('wedding-photographer.profil.index')->with('sukses', 'Mengubah Data Diri');
        }

        return redirect()->route('wedding-photographer.profil.index')->with('gagal', 'Mengubah Data Diri');
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
            return redirect()->route('wedding-photographer.profil.index')->with('sukses', 'Mengubah Password');
        }
        return redirect()->route('wedding-photographer.profil.index')->with('gagal', 'Mengubah Password');
    }

    public function ke_ubah_foto() {
        return view('user.wedding-photographer.profil.ubah-foto');
    }

    public function ubah_foto(Request $req) {
        $req->validate([
            'foto_profil' => 'required|image'
        ]);

        $foto_profil_lama = auth()->user()->w_photographer->foto_profil;
        if ($foto_profil_lama) {
            unlink(public_path($foto_profil_lama));
        }

        if ($req->hasFile('foto_profil')) {
            $foto_profil = $req->file('foto_profil');

            $foto_profil = Storage::disk('public')->putFileAs('/',
                $foto_profil,
                'WP/profil/'.str()->uuid() . '.' . $foto_profil->extension()
            );

            $data = WPhotographer::where('user_id', auth()->user()->id)
                ->update([
                    'foto_profil' => $foto_profil,
                ]);

            if ($data) {
                return redirect()->route('wedding-photographer.profil.index')->with('sukses', 'Mengubah Foto Profil');
            }
        }
        return redirect()->route('wedding-photographer.profil.index')->with('gagal', 'Mengubah Foto Profil');
    }
}
