<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\WCGuest;
use Illuminate\Http\Request;

class UGuestController extends Controller
{
    public function tambah(Request $req, $id) {
        $req->validate([
            'nama' => 'required|string|max:255',
            'no_telp' => 'required',
        ], [
            'nama.required' => 'Nama penerima wajib diisi.',
            'nama.string' => 'Nama penerima harus berupa teks.',
            'nama.max' => 'Nama penerima tidak boleh lebih dari 255 karakter.',
            'no_telp.required' => 'Nomor kontak wajib diisi.',
        ]);

        $guest = new WCGuest();
        $guest->w_c_wedding_id = $id;
        $guest->nama = $req->nama;
        $guest->no_telp = $req->no_telp;
        $guest->save();

        $guest->link = $guest->created_at->format('YmdHis') . $guest->id;
        $data = $guest->save();

        if ($data) {
            return back()->with('sukses', 'Menambah Tamu Undangan');
        }
        return back()->with('gagal', 'Menambah Tamu Undangan');
    }

    public function kirim($id) {
        $tamu = WCGuest::find($id);

        if (!$tamu) {
            return back()->with('gagal', 'ID tidak valid');
        }

        $tamu->status = 'Sudah Terkirim';
        $data = $tamu->save();

        if ($data) {
            return back()->with('sukses', 'Mengirim Undangan');
        }
        return back()->with('gagal', 'Mengirim Undangan');
    }

    public function rsvp(Request $req, $id) {
        $req->validate([
            'konfirmasi'  => 'required',
            'jumlah_tamu' => 'required_if:konfirmasi,hadir',
        ],[
            'konfirmasi.required'  => 'Konfirmasi tidak boleh kosong',
            'jumlah_tamu.required' => 'Jumlah tamu tidak boleh kosong',
        ]);

        $tamu = WCGuest::find($id);
        if (!$tamu) {
            return back()->with('gagal', 'ID tidak valid');
        }

        $tamu->status = 'Sudah Terkirim';

        $tamu->respon = $req->konfirmasi;
        if ($req->konfirmasi == 'hadir') {
            $tamu->jumlah = $req->jumlah_tamu;
        }
        $data = $tamu->save();

        if ($data) {
            return back()->with('sukses', 'Mengkonfirmasi Kehadiran');
        }
        return back()->with('gagal', 'Mengkonfirmasi Kehadiran');
    }

    public function wish(Request $req, $id) {
        $req->validate([
            'wish' => 'required',
        ],[
            'wish.required'  => 'Ucapan tidak boleh kosong',
        ]);

        $tamu = WCGuest::find($id);
        if (!$tamu) {
            return back()->with('gagal', 'ID tidak valid');
        }
        $tamu->pesan = $req->wish;
        $data = $tamu->save();

        if ($data) {
            return back()->with('sukses', 'Memberi Ucapan Selamat');
        }
        return back()->with('gagal', 'Memberi Ucapan Selamat');
    }

    public function hapus($id) {
        $tamu = WCGuest::find($id);

        if (!$tamu) {
            return back()->with('gagal', 'ID tidak valid');
        }

        $data = $tamu->delete();

        if ($data) {
            return back()->with('sukses', 'Menghapus Tamu Undangan');
        }
        return back()->with('gagal', 'Menghapus Tamu Undangan');
    }
}
