<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Http\Requests\UbahPasswordRequest;
use App\Http\Requests\WeddingOrganizer\ProfilRequest;
use App\Models\MJenisVendor;
use App\Models\User;
use App\Models\WVendor;
use App\Models\WVJenis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class VProfileController extends Controller
{
    public function index() {
        $m_j_vendors = [];
        $j_vendors = [];
        if (auth()->user()->w_vendor) {
            $j_vendors = auth()->user()->w_vendor->jenis;
            $m_j_vendors = MJenisVendor::orderBy('nama', 'asc')->get();
            $m_j_vendors = $m_j_vendors->reject(function ($m_j_vendor) use ($j_vendors) {
                return $j_vendors->contains('m_jenis_vendor_id', $m_j_vendor->id);
            });
        }

        return view('vendor.profil.index', compact('m_j_vendors', 'j_vendors'));
    }

    public function ke_ubah() {
        return view('vendor.profil.ubah');
    }

    public function ubah(ProfilRequest $req) {
        $req->validated();

        User::where('id', auth()->user()->id)
            ->update([
                'name' => $req->username,
            ]);

        $koordinat = [
            'lat' => $req->lat,
            'lng' => $req->lng,
        ];

        if (auth()->user()->w_vendor) {
            # Update
            $data = WVendor::where('id', auth()->user()->w_vendor->id)
                ->update([
                    'nama'          => $req->nama,
                    'no_telp'       => $req->no_telp,
                    'alamat'        => $req->alamat,
                    'koordinat'     => $koordinat,
                    'basis_operasi' => $req->basis_operasi,
                    'kota_operasi'  => $req->kota_operasi,
                ]);
        } else {
            # Make New
            $vendor = new WVendor();
            $vendor->user_id         = auth()->user()->id;
            $vendor->nama            = $req->nama;
            $vendor->no_telp         = $req->no_telp;
            $vendor->alamat          = $req->alamat;
            $vendor->koordinat       = $koordinat;
            $vendor->basis_operasi   = $req->basis_operasi;
            $vendor->kota_operasi    = $req->kota_operasi;
            $data = $vendor->save();
        }

        if ($data) {
            return back()->with('sukses', 'Mengubah Data Diri');
        }
        return back()->with('gagal', 'Mengubah Data Diri');
    }

    public function ke_ubah_password() {
        return view('vendor.profil.ubah-password');
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
        return view('vendor.profil.ubah-foto');
    }

    public function ubah_foto(Request $req) {
        $req->validate([
            'foto_profil' => 'required|image'
        ]);

        $foto_profil_lama = auth()->user()->w_vendor->foto_profil;
        if ($foto_profil_lama) {
            unlink(public_path($foto_profil_lama));
        }

        if ($req->hasFile('foto_profil')) {
            $foto_profil = $req->file('foto_profil');

            $foto_profil = Storage::disk('public')->putFileAs('/',
                $foto_profil,
                'v/profil/'.str()->uuid() . '.' . $foto_profil->extension()
            );

            $data = WVendor::where('user_id', auth()->user()->id)
                ->update([
                    'foto_profil' => $foto_profil,
                ]);

            if ($data) {
                return redirect()->route('vendor.profil.index')->with('sukses', 'Mengubah Foto Profil');
            }
        }
        return redirect()->route('vendor.profil.index')->with('gagal', 'Mengubah Foto Profil');
    }

    public function tambah_jenis(Request $req) {
        $req->validate([
            'j_vendor' => 'required',
        ]);

        $vendor = auth()->user()->w_vendor;

        $jenis = WVJenis::where('w_vendor_id', $vendor->id)
            ->where('m_jenis_vendor_id', $req->j_vendor)
            ->withTrashed()
            ->first();

        if ($jenis) {
            $data = $jenis->restore();
        } else {
            $data = auth()->user()->w_vendor->jenis()->create([
                'm_jenis_vendor_id' => $req->j_vendor,
            ]);
        }
        if ($data) {
            return back()->with('sukses', 'Menambah Jenis Vendor')->withFragment('jenisVendor');
        }
        return back()->with('gagal', 'Menambah Jenis Vendor')->withFragment('jenisVendor');
    }

    public function hapus_jenis($id) {
        $data = WVJenis::find($id)->delete();

        if ($data) {
            return back()->with('sukses', 'Menghapus Jenis Vendor')->withFragment('jenisVendor');
        }
        return back()->with('gagal', 'Menghapus Jenis Vendor')->withFragment('jenisVendor');
    }
}
