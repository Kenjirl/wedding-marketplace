<?php

namespace App\Http\Controllers\WeddingPhotographer;

use App\Http\Controllers\Controller;
use App\Http\Requests\PortofolioRequest;
use App\Models\WPPortofolio;
use App\Models\WPPortofolioPhoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WPPortofolioController extends Controller
{
    public function index() {
        $latest_portofolio = WPPortofolio::orderBy('created_at', 'desc')->take(4)->get();
        $portofolio = WPPortofolio::orderBy('judul', 'asc')->get();

        return view('user.wedding-photographer.portofolio.index', compact('latest_portofolio', 'portofolio'));
    }

    public function ke_tambah() {
        return view('user.wedding-photographer.portofolio.tambah');
    }

    public function tambah(PortofolioRequest $req) {
        $req->validated();

        $lokasi = $req->alamat_detail . ', ' . $req->kelurahan . ', ' . $req->kecamatan . ', ' . $req->kota . ', ' . $req->provinsi;

        $portofolio = new WPPortofolio();
        $portofolio->wedding_photographer_id = auth()->user()->w_photographer->id;
        $portofolio->judul = $req->judul;
        $portofolio->tanggal = $req->tanggal;
        $portofolio->lokasi = $lokasi;
        $data1 = $portofolio->save();

        $data2 = false;
        if ($req->hasFile('foto')) {
            $foto = $req->file('foto');

            $url = Storage::disk('public')->putFileAs('/',
                $foto,
                'WP/portofolio/' . str()->uuid() . '.' . $foto->extension()
            );

            $f_portofolio = new WPPortofolioPhoto();
            $f_portofolio->w_p_portofolio_id = $portofolio->id;
            $f_portofolio->url = $url;
            $data2 = $f_portofolio->save();
        }

        if ($data1 && $data2) {
            return redirect()->route('wedding-photographer.portofolio.index')->with('sukses', 'Portofolio anda berhasil ditambahkan');
        }
        return redirect()->route('wedding-photographer.portofolio.index')->with('gagal', 'Maaf, terjadi kesalahan. Portofolio anda tidak berhasil ditambahkan');
    }

    public function ke_ubah($id) {
        $portofolio = WPPortofolio::find($id);

        if (!$portofolio) {
            return redirect()->route('wedding-photographer.ke_portofolio')->with('gagal', 'Portofolio tidak ditemukan');
        }

        $provinsi       = '';
        $kota           = '';
        $kecamatan      = '';
        $kelurahan      = '';
        $alamat_detail  = '';

        $alamatArray = explode(', ', $portofolio->lokasi);
        list($alamat_detail, $kelurahan, $kecamatan, $kota, $provinsi) = $alamatArray;

        return view('user.wedding-photographer.portofolio.ubah',
            compact(
                'portofolio',
                'provinsi',
                'kota',
                'kecamatan',
                'kelurahan',
                'alamat_detail'
            ));
    }

    // public function ubah(PortofolioRequest $req, $id) {
    // public function ubah($id) {
    //     // $req->validated();
    //     dd('Ubah Portofolio id : ' . $id);

    //     $jumlahFoto = count($req->file('foto'));
    //     if ($jumlahFoto > 5) {
    //         return redirect()->route('wedding-photographer.ke_tambah')->with('gagal_foto', 'Anda hanya dapat mengunggah maksimal 5 gambar.');
    //     }
    // }

    // public function hapus($id) {
    //     dd('Hapus Portofolio id : ' . $id);
    // }

    // public function hapus_foto($id) {
    //     dd('Hapus Foto Portofolio id : ' . $id);
    // }
}
