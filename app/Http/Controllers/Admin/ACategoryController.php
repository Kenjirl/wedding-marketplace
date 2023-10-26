<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WeddingCategories;
use Illuminate\Http\Request;

class ACategoryController extends Controller
{
    public function index() {
        $categories = WeddingCategories::all();

        return view('user.admin.kategori.index', compact('categories'));
    }

    public function ke_tambah() {
        return view('user.admin.kategori.tambah');
    }

    public function tambah(Request $req) {
        $req->validate([
            'kategori' => 'required|string|regex:/^[a-zA-Z\s]*$/',
            'keterangan' => 'required|string',
        ],
        [
            'kategori.required' => 'Kategori tidak boleh kosong',
            'kategori.string' => 'Kategori harus berupa karakter',
            'kategori.regex' => 'Kategori tidak boleh memuat angka dan/atau tanda baca',
            'keterangan.required' => 'Keterangan tidak boleh kosong',
            'keterangan.string' => 'Keterangan harus berupa karakter',
        ]);

        $wkg = new WeddingCategories();
        $wkg->admin_id = auth()->user()->admin->id;
        $wkg->kategori = strtolower($req->kategori);
        $wkg->keterangan = $req->keterangan;
        $data = $wkg->save();

        if ($data) {
            return redirect()->route('admin.kategori-pernikahan.index')->with('sukses', 'Data kategori pernikahan berhasil ditambahkan');
        }
        return redirect()->route('admin.kategori-pernikahan.index')->with('gagal', 'Maaf, telah terjadi kesalahan. Data kategori pernikahan belum bisa ditambahkan');
    }

    public function ke_ubah($id) {
        $wkg = WeddingCategories::where('id', $id)->first();

        return view('user.admin.kategori.ubah', compact('wkg'));
    }

    public function ubah(Request $req, $id) {
        $req->validate([
            'kategori' => 'required|string|regex:/^[a-zA-Z\s]*$/',
            'keterangan' => 'required|string',
        ],
        [
            'kategori.required' => 'Kategori tidak boleh kosong',
            'kategori.string' => 'Kategori harus berupa karakter',
            'kategori.regex' => 'Kategori tidak boleh memuat angka dan/atau tanda baca',
            'keterangan.required' => 'Keterangan tidak boleh kosong',
            'keterangan.string' => 'Keterangan harus berupa karakter',
        ]);

        $data = WeddingCategories::where('id', $id)
            ->update([
                'admin_id' => auth()->user()->admin->id,
                'kategori' => strtolower($req->kategori),
                'keterangan' => $req->keterangan,
            ]);

        if ($data) {
            return redirect()->route('admin.kategori-pernikahan.index')->with('sukses', 'Data kategori pernikahan berhasil diubah');
        }
        return redirect()->route('admin.kategori-pernikahan.index')->with('gagal', 'Maaf, telah terjadi kesalahan. Data kategori pernikahan belum bisa diubah');
    }

    public function hapus($id) {
        $kategori = WeddingCategories::where('id', $id)->first();
        $data = $kategori->delete();

        if ($data) {
            return redirect()->route('admin.kategori-pernikahan.index')->with('sukses', 'Data kategori pernikahan berhasil dihapus');
        }
        return redirect()->route('admin.kategori-pernikahan.index')->with('gagal', 'Maaf, telah terjadi kesalahan. Data kategori pernikahan belum bisa dihapus');
    }
}
