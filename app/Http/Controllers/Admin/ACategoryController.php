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
            'nama' => 'required|string|regex:/^[a-zA-Z\s]*$/',
            'keterangan' => 'required|string',
        ],
        [
            'nama.required' => 'Kategori tidak boleh kosong',
            'nama.string' => 'Kategori harus berupa karakter',
            'nama.regex' => 'Kategori tidak boleh memuat angka dan/atau tanda baca',
            'keterangan.required' => 'Keterangan tidak boleh kosong',
            'keterangan.string' => 'Keterangan harus berupa karakter',
        ]);

        $wkg = new WeddingCategories();
        $wkg->admin_id = auth()->user()->admin->id;
        $wkg->nama = strtolower($req->nama);
        $wkg->keterangan = $req->keterangan;
        $data = $wkg->save();

        if ($data) {
            return redirect()->route('admin.kategori-pernikahan.index')->with('sukses', 'Menambah Kategori Pernikahan');
        }
        return redirect()->route('admin.kategori-pernikahan.index')->with('gagal', 'Menambah Kategori Pernikahan');
    }

    public function ke_ubah($id) {
        $wkg = WeddingCategories::where('id', $id)->first();

        return view('user.admin.kategori.ubah', compact('wkg'));
    }

    public function ubah(Request $req, $id) {
        $req->validate([
            'nama' => 'required|string|regex:/^[a-zA-Z\s]*$/',
            'keterangan' => 'required|string',
        ],
        [
            'nama.required' => 'Kategori tidak boleh kosong',
            'nama.string' => 'Kategori harus berupa karakter',
            'nama.regex' => 'Kategori tidak boleh memuat angka dan/atau tanda baca',
            'keterangan.required' => 'Keterangan tidak boleh kosong',
            'keterangan.string' => 'Keterangan harus berupa karakter',
        ]);

        $data = WeddingCategories::where('id', $id)
            ->update([
                'admin_id' => auth()->user()->admin->id,
                'nama' => strtolower($req->nama),
                'keterangan' => $req->keterangan,
            ]);

        if ($data) {
            return redirect()->route('admin.kategori-pernikahan.index')->with('sukses', 'Mengubah Kategori Pernikahan');
        }
        return redirect()->route('admin.kategori-pernikahan.index')->with('gagal', 'Mengubah Kategori Pernikahan');
    }

    public function hapus($id) {
        $kategori = WeddingCategories::where('id', $id)->first();
        $data = $kategori->delete();

        if ($data) {
            return redirect()->route('admin.kategori-pernikahan.index')->with('sukses', 'Menghapus Kategori Pernikahan');
        }
        return redirect()->route('admin.kategori-pernikahan.index')->with('gagal', 'Menghapus Kategori Pernikahan');
    }
}
