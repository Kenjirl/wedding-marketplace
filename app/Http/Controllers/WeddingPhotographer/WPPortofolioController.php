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
        $portofolio->detail = $req->detail;
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
            return redirect()->route('wedding-photographer.portofolio.index')->with('sukses', 'Menambah Portofolio');
        }
        return redirect()->route('wedding-photographer.portofolio.index')->with('gagal', 'Menambah Portofolio');
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

        $count = WPPortofolioPhoto::where('w_p_portofolio_id', $id)->count();

        return view('user.wedding-photographer.portofolio.ubah',
            compact(
                'portofolio',
                'provinsi',
                'kota',
                'kecamatan',
                'kelurahan',
                'alamat_detail',
                'count'
            ));
    }

    public function ubah(PortofolioRequest $req, $id) {
        $req->validated();

        $count = WPPortofolioPhoto::where('w_p_portofolio_id', $id)->count();
        if ($count >= 5) {
            return redirect()->route('wedding-photographer.portofolio.ke_ubah', $id)->with('gagal', 'Maksimal 5 Gambar Saja');
        }

        $data1 = WPPortofolio::where('id', $id)
                    ->update([
                        'judul' => $req->judul,
                        'tanggal' => $req->tanggal,
                        'detail' => $req->detail,
                        'lokasi' => $req->alamat_detail . ', ' . $req->kelurahan . ', ' . $req->kecamatan . ', ' . $req->kota . ', ' . $req->provinsi,
                        'status' => 'menunggu konfirmasi',
                    ]);

        $data2 = false;
        if ($req->hasFile('foto')) {
            $foto = $req->file('foto');

            $url = Storage::disk('public')->putFileAs('/',
                $foto,
                'WP/portofolio/' . str()->uuid() . '.' . $foto->extension()
            );

            $f_portofolio = new WPPortofolioPhoto();
            $f_portofolio->w_p_portofolio_id = $id;
            $f_portofolio->url = $url;
            $data2 = $f_portofolio->save();

            if ($data1 && $data2) {
                return redirect()->route('wedding-photographer.portofolio.ke_ubah', $id)->with('sukses', 'Mengubah Portofolio');
            }
        }

        if ($data1) {
            return redirect()->route('wedding-photographer.portofolio.ke_ubah', $id)->with('sukses', 'Mengubah Portofolio');
        }

        return redirect()->route('wedding-photographer.portofolio.index')->with('gagal', 'Mengubah Portofolio');
    }

    public function hapus($id) {
        $photos = WPPortofolioPhoto::where('w_p_portofolio_id', $id)->get();

        foreach ($photos as $foto) {
            unlink(public_path($foto->url));
            $foto->delete();
        }

        $portofolio = WPPortofolio::where('id', $id)->first();
        $data = $portofolio->delete();

        if ($data) {
            return redirect()->route('wedding-photographer.portofolio.index')->with('sukses', 'Menghapus Portofolio');
        }
        return redirect()->route('wedding-photographer.portofolio.index')->with('gagal', 'Menghapus Portofolio');
    }

    public function hapus_foto($id) {
        $foto = WPPortofolioPhoto::where('id', $id)->first();
        $url = $foto->url;
        $data = $foto->delete();

        if ($data) {
            // Storage::delete(public_path($url));
            unlink(public_path($url));
            return back()->with('sukses', 'Menghapus Foto Portofolio');
        }
        return back()->with('gagal', 'Menghapus Foto Portofolio');
    }
}