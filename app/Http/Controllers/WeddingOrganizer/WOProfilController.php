<?php

namespace App\Http\Controllers\WeddingOrganizer;

use App\Http\Controllers\Controller;
use App\Http\Requests\UbahPasswordRequest;
use App\Http\Requests\WeddingOrganizer\ProfilRequest;
use App\Models\User;
use App\Models\WCategories;
use App\Models\WOCategories;
use App\Models\WOrganizer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class WOProfilController extends Controller
{
    public function index() {
        return view('user.wedding-organizer.profil.index');
    }

    public function ke_ubah() {
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

        return view('user.wedding-organizer.profil.ubah',
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
            $data = WOrganizer::where('id', auth()->user()->w_organizer->id)
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
            $organizer = new WOrganizer();
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
            return redirect()->route('wedding-organizer.profil.index')->with('sukses', 'Mengubah Data Diri');
        }

        return redirect()->route('wedding-organizer.profil.index')->with('gagal', 'Mengubah Data Diri');
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
            return redirect()->route('wedding-organizer.profil.index')->with('sukses', 'Mengubah Password');
        }

        // Gagal save Password
        return redirect()->route('wedding-organizer.profil.index')->with('gagal', 'Mengubah Password');
    }

    public function ke_ubah_foto() {
        return view('user.wedding-organizer.profil.ubah-foto');
    }

    public function ubah_foto(Request $req) {
        $req->validate([
            'foto_profil' => 'required|image'
        ]);

        $foto_profil_lama = auth()->user()->w_organizer->foto_profil;
        if ($foto_profil_lama) {
            unlink(public_path($foto_profil_lama));
        }

        if ($req->hasFile('foto_profil')) {
            $foto_profil = $req->file('foto_profil');

            $foto_profil = Storage::disk('public')->putFileAs('/',
                $foto_profil,
                'WO/profil/'.str()->uuid() . '.' . $foto_profil->extension()
            );

            $data = WOrganizer::where('user_id', auth()->user()->id)
                ->update([
                    'foto_profil' => $foto_profil,
                ]);

            if ($data) {
                return redirect()->route('wedding-organizer.profil.index')->with('sukses', 'Mengubah Foto Profil');
            }
        }

        return redirect()->route('wedding-organizer.profil.index')->with('gagal', 'Mengubah Foto Profil');
    }

    public function ke_ubah_kategori() {
        $categories = WCategories::all();

        $woCategories = WOCategories::where('w_organizer_id', auth()->user()->w_organizer->id)->get();
        $woCategoriesIds = $woCategories->pluck('w_categories_id')->all();

        $categories = $categories->reject(function ($category) use ($woCategoriesIds) {
            return in_array($category->id, $woCategoriesIds);
        })->sortBy('nama');

        // dd($categories);

        return view('user.wedding-organizer.profil.kategori', compact('categories', 'woCategories'));
    }

    public function tambah_kategori(Request $req) {
        $req->validate([
            'kategori' => 'required',
        ],[
            'kategori.required' => 'Kategori tidak boleh kosong',
        ]);

        // dd($req->kategori);

        $kategori = new WOCategories();
        $kategori->w_organizer_id = auth()->user()->w_organizer->id;
        $kategori->w_categories_id = $req->kategori;
        $data = $kategori->save();

        if ($data) {
            return redirect()->route('wedding-organizer.profil.ke_ubah_kategori')->with('sukses', 'Menambah Kategori');
        }
        return redirect()->route('wedding-organizer.profil.ke_ubah_kategori')->with('gagal', 'Menambah Kategori');
    }

    public function hapus_kategori($id) {
        $kategori = WOCategories::find($id);
        $data = $kategori->delete();

        if ($data) {
            return redirect()->route('wedding-organizer.profil.ke_ubah_kategori')->with('sukses', 'Menghapus Kategori');
        }
        return redirect()->route('wedding-organizer.profil.ke_ubah_kategori')->with('gagal', 'Menghapus Kategori');
    }
}
