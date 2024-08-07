<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MJenisVendor;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AJenisVendorController extends Controller
{
    public function index() {
        $j_vendors = MJenisVendor::orderBy('nama', 'asc')->get();

        return view('admin.master.jenis-vendor.index', compact('j_vendors'));
    }

    public function ke_tambah() {
        return view('admin.master.jenis-vendor.tambah');
    }

    public function tambah(Request $req) {
        $req->validate([
            'nama' => [
                'required',
                'string',
                'regex:/^[a-zA-Z\s]*$/',
                'max:20',
                Rule::unique('m_jenis_vendors', 'nama')->whereNull('deleted_at'),
            ],
            'icon' => 'required|string|regex:/^[a-zA-Z\s\-]*$/',
        ],
        [
            'nama.required' => 'Jenis vendor tidak boleh kosong',
            'nama.string'   => 'Jenis vendor harus berupa karakter',
            'nama.regex'    => 'Jenis vendor tidak boleh memuat angka dan/atau tanda baca',
            'nama.max'      => 'Jenis vendor tidak boleh lebih dari 20 karakter',
            'nama.unique'   => 'Tidak boleh menggunakan nama jenis vendor lagi',
            'icon.required' => 'Icon tidak boleh kosong',
            'icon.string'   => 'Icon harus berupa karakter',
            'nama.regex'    => 'Icon hanya boleh memuat huruf dan tanda dash (-)',
        ]);

        $m_j_vendor = MJenisVendor::withTrashed()
                        ->where('nama', ucwords($req->nama))
                        ->first();

        $j_vendor = null;
        if ($m_j_vendor) {
            if ($m_j_vendor->trashed()) {
                $m_j_vendor->restore();
            }

            $m_j_vendor->icon = $req->icon;
            $data = $m_j_vendor->save();
        } else {
            $j_vendor = new MJenisVendor();
            $j_vendor->nama = ucwords($req->nama);
            $j_vendor->icon = $req->icon;
            $data = $j_vendor->save();
        }

        if ($data) {
            return redirect()->route('admin.jenis-vendor.ke_ubah', $j_vendor->id)->with('sukses', 'Menambah Jenis Vendor');
        }
        return redirect()->route('admin.jenis-vendor.index')->with('gagal', 'Menambah Jenis Vendor');
    }

    public function ke_ubah($id) {
        $j_vendor = MJenisVendor::find($id);

        if (!$j_vendor) {
            return back()->with('gagal', 'ID Invalid');
        }

        return view('admin.master.jenis-vendor.ubah', compact('j_vendor'));
    }

    public function ubah(Request $req, $id) {
        $req->validate([
            'nama' => 'required|string|regex:/^[a-zA-Z\s]*$/|max:20|unique:m_jenis_vendors,nama,'.$id,
            'icon' => 'required|string|regex:/^[a-zA-Z\s\-]*$/',
        ],
        [
            'nama.required' => 'Jenis vendor tidak boleh kosong',
            'nama.string'   => 'Jenis vendor harus berupa karakter',
            'nama.regex'    => 'Jenis vendor tidak boleh memuat angka dan/atau tanda baca',
            'nama.max'      => 'Jenis vendor tidak boleh lebih dari 20 karakter',
            'nama.unique'   => 'Tidak boleh menggunakan nama jenis vendor lagi',
            'icon.required' => 'Icon tidak boleh kosong',
            'icon.string'   => 'Icon harus berupa karakter',
            'nama.regex'    => 'Icon hanya boleh memuat huruf dan tanda dash (-)',
        ]);

        $data = MJenisVendor::find($id)
            ->update([
                'nama' => ucwords($req->nama),
                'icon' => $req->icon,
            ]);

        if ($data) {
            return back()->with('sukses', 'Mengubah Jenis Vendor');
        }
        return back()->with('gagal', 'Mengubah Jenis Vendor');
    }

    public function hapus($id) {
        $j_vendor = MJenisVendor::find($id);

        if (!$j_vendor) {
            return back()->with('gagal', 'ID Invalid');
        }

        $data = $j_vendor->delete();

        if ($data) {
            return back()->with('sukses', 'Menghapus Jenis Vendor');
        }
        return back()->with('gagal', 'Menghapus Jenis Vendor');
    }
}
