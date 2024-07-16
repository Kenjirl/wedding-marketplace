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
        $provinsi       = '';
        $kota           = '';
        $kecamatan      = '';
        $kelurahan      = '';
        $alamat_detail  = '';

        if (auth()->user()->w_vendor) {
            if (auth()->user()->w_vendor->alamat) {
                $alamatArray = explode(', ', auth()->user()->w_vendor->alamat);
                list($alamat_detail, $kelurahan, $kecamatan, $kota, $provinsi) = $alamatArray;
            }
        }

        // Load data JSON untuk dropdown
        $provinsiData = collect(json_decode(file_get_contents(public_path('json/provinsi.json'))))->sortBy('name');
        $kotaData = collect(json_decode(file_get_contents(public_path('json/kabupaten.json'))));
        $kecamatanData = collect(json_decode(file_get_contents(public_path('json/kecamatan.json'))));
        $kelurahanData = collect(json_decode(file_get_contents(public_path('json/kelurahan.json'))));

        // Cari ID Provinsi berdasarkan nama Provinsi
        $selectedProvinsi = $provinsiData->firstWhere('name', $provinsi);
        $provinsiId = $selectedProvinsi ? $selectedProvinsi->id : null;

        // Filter data Kabupaten berdasarkan ID Provinsi
        $filteredKotaData = $kotaData->where('provinsi_id', $provinsiId)->sortBy('name');

        // Cari ID Kabupaten berdasarkan nama Kabupaten
        $selectedKota = $filteredKotaData->firstWhere('name', $kota);
        $kotaId = $selectedKota ? $selectedKota->id : null;

        // Filter data Kecamatan berdasarkan ID Kabupaten
        $filteredKecamatanData = $kecamatanData->where('kabupaten_id', $kotaId)->sortBy('name');

        // Cari ID Kecamatan berdasarkan nama Kecamatan
        $selectedKecamatan = $filteredKecamatanData->firstWhere('name', $kecamatan);
        $kecamatanId = $selectedKecamatan ? $selectedKecamatan->id : null;

        // Filter data Kelurahan berdasarkan ID Kecamatan
        $filteredKelurahanData = $kelurahanData->where('kecamatan_id', $kecamatanId)->sortBy('name');

        return view('vendor.profil.ubah',
            compact(
                'provinsi',
                'kota',
                'kecamatan',
                'kelurahan',
                'alamat_detail',
                'provinsiData',
                'filteredKotaData',
                'filteredKecamatanData',
                'filteredKelurahanData',
            ));
    }

    public function ubah(ProfilRequest $req) {
        $req->validated();

        $kota_operasi = null;
        $alamat = $req->alamat_detail . ', ' . $req->kelurahan . ', ' . $req->kecamatan . ', ' . $req->kota . ', ' . $req->provinsi;

        if ($req->basis_operasi == 'Hanya di Dalam Kota') {
            $kota_operasi = $req->kota;
        }

        $filteredRekening = array_filter($req->rekening, function ($value) {
            return !is_null($value);
        });

        $arrRekening = [];
        foreach ($filteredRekening as $bank => $nomorRekening) {
            $arrRekening[] = [
                'jenis' => $bank,
                'nomor' => $nomorRekening
            ];
        }

        User::where('id', auth()->user()->id)
            ->update([
                'name' => $req->username,
            ]);

        if (auth()->user()->w_vendor) {
            # Update
            $data = WVendor::where('id', auth()->user()->w_vendor->id)
                ->update([
                    'nama'          => $req->nama,
                    'no_telp'       => $req->no_telp,
                    'basis_operasi' => $req->basis_operasi,
                    'kota_operasi'  => $kota_operasi,
                    'alamat'        => $alamat,
                    'rekening'      => $arrRekening,
                ]);
        } else {
            # Make New
            $organizer = new WVendor();
            $organizer->user_id         = auth()->user()->id;
            $organizer->nama            = $req->nama;
            $organizer->no_telp         = $req->no_telp;
            $organizer->basis_operasi   = $req->basis_operasi;
            $organizer->kota_operasi    = $kota_operasi;
            $organizer->alamat          = $alamat;
            $organizer->rekening        = $arrRekening;
            $data = $organizer->save();
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

        $data = auth()->user()->w_vendor->jenis()->create([
            'm_jenis_vendor_id' => $req->j_vendor,
        ]);

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
