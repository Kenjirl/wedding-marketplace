<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WCategories;
use Illuminate\Http\Request;

class ACategoryController extends Controller
{
    public function index() {
        $categories = WCategories::orderBy('nama', 'asc')->get();

        return view('user.admin.master.kategori.index', compact('categories'));
    }

    public function ke_tambah() {
        return view('user.admin.master.kategori.tambah');
    }

    public function tambah(Request $req) {
        $req->validate([
            'nama'       => 'required|string|regex:/^[a-zA-Z\s]*$/|max:20',
            'keterangan' => 'required|string',
        ],
        [
            'nama.required'       => 'Kategori tidak boleh kosong',
            'nama.string'         => 'Kategori harus berupa karakter',
            'nama.regex'          => 'Kategori tidak boleh memuat angka dan/atau tanda baca',
            'nama.max'            => 'Kategori tidak boleh lebih dari 20 karakter',
            'keterangan.required' => 'Keterangan tidak boleh kosong',
            'keterangan.string'   => 'Keterangan harus berupa karakter',
        ]);

        $wkg              = new WCategories();
        $wkg->admin_id    = auth()->user()->admin->id;
        $wkg->nama        = strtolower($req->nama);
        $wkg->keterangan  = $req->keterangan;
        $data             = $wkg->save();

        if ($data) {
            return redirect()->route('admin.kategori-pernikahan.index')->with('sukses', 'Menambah Kategori Pernikahan');
        }
        return redirect()->route('admin.kategori-pernikahan.index')->with('gagal', 'Menambah Kategori Pernikahan');
    }

    public function ke_ubah($id) {
        $wkg = WCategories::find($id);

        return view('user.admin.master.kategori.ubah', compact('wkg'));
    }

    public function ubah(Request $req, $id) {
        $req->validate([
            'nama'       => 'required|string|regex:/^[a-zA-Z\s]*$/|max:20',
            'keterangan' => 'required|string',
        ],
        [
            'nama.required'       => 'Kategori tidak boleh kosong',
            'nama.string'         => 'Kategori harus berupa karakter',
            'nama.regex'          => 'Kategori tidak boleh memuat angka dan/atau tanda baca',
            'nama.max'            => 'Kategori tidak boleh lebih dari 20 karakter',
            'keterangan.required' => 'Keterangan tidak boleh kosong',
            'keterangan.string'   => 'Keterangan harus berupa karakter',
        ]);

        $data = WCategories::where('id', $id)
            ->update([
                'admin_id'   => auth()->user()->admin->id,
                'nama'       => strtolower($req->nama),
                'keterangan' => $req->keterangan,
            ]);

        if ($data) {
            return redirect()->route('admin.kategori-pernikahan.index')->with('sukses', 'Mengubah Kategori Pernikahan');
        }
        return redirect()->route('admin.kategori-pernikahan.index')->with('gagal', 'Mengubah Kategori Pernikahan');
    }

    public function hapus($id) {
        $kategori = WCategories::where('id', $id)->first();
        $data = $kategori->delete();

        if ($data) {
            return redirect()->route('admin.kategori-pernikahan.index')->with('sukses', 'Menghapus Kategori Pernikahan');
        }
        return redirect()->route('admin.kategori-pernikahan.index')->with('gagal', 'Menghapus Kategori Pernikahan');
    }
}
