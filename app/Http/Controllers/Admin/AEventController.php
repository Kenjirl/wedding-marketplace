<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WEvent;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class AEventController extends Controller
{
    public function index() {
        $events = WEvent::orderBy('jenis', 'asc')
                    ->orderBy('nama', 'asc')
                    ->get();

        return view('user.admin.master.event.index', compact('events'));
    }

    public function ke_tambah() {
        return view('user.admin.master.event.tambah');
    }

    public function tambah(Request $req) {
        $req->validate([
            'nama'       => [
                            'required','string','regex:/^[a-zA-Z\s]*$/','max:20',
                            Rule::unique('w_events')->where('id', 1),
                        ],
            'jenis'      => 'required|in:Buddha,Hindu,Islam,Katolik,Khonghucu,Protestan,Umum',
            'keterangan' => 'required|string',
        ],
        [
            'nama.required'       => 'Event tidak boleh kosong',
            'nama.string'         => 'Event harus berupa karakter',
            'nama.regex'          => 'Event tidak boleh memuat angka dan/atau tanda baca',
            'nama.max'            => 'Event tidak boleh lebih dari 20 karakter',
            'nama.unique'         => 'Tidak boleh menggunakan nama pernikahan lagi',
            'jenis.required'      => 'Jenis tidak boleh kosong',
            'jenis.in'            => 'Jenis harus dipilih dari opsi yang tersedia',
            'keterangan.required' => 'Keterangan tidak boleh kosong',
            'keterangan.string'   => 'Keterangan harus berupa karakter',
        ]);

        $event              = new WEvent();
        $event->admin_id    = auth()->user()->admin->id;
        $event->nama        = ucwords($req->nama);
        $event->jenis       = $req->jenis;
        $event->keterangan  = $req->keterangan;
        $data               = $event->save();

        if ($data) {
            return redirect()->route('admin.event-pernikahan.index')->with('sukses', 'Menambah Event Pernikahan');
        }
        return redirect()->route('admin.event-pernikahan.index')->with('gagal', 'Menambah Event Pernikahan');
    }

    public function ke_ubah($id) {
        $event = WEvent::find($id);

        if (!$event) {
            return redirect()->route('admin.event-pernikahan.index')->with('gagal', 'ID Invalid');
        }

        if ($event->id == 1 && $event->nama == 'Pernikahan') {
            return back()->with('gagal', 'Event ini tidak boleh diubah');
        }

        return view('user.admin.master.event.ubah', compact('event'));
    }

    public function ubah(Request $req, $id) {
        $req->validate([
            'nama'       => [
                            'required','string','regex:/^[a-zA-Z\s]*$/','max:20',
                            Rule::unique('w_events')->where('id', 1),
                        ],
            'jenis'      => 'required|in:Buddha,Hindu,Islam,Katolik,Khonghucu,Protestan,Umum',
            'keterangan' => 'required|string',
        ],
        [
            'nama.required'       => 'Event tidak boleh kosong',
            'nama.string'         => 'Event harus berupa karakter',
            'nama.regex'          => 'Event tidak boleh memuat angka dan/atau tanda baca',
            'nama.max'            => 'Event tidak boleh lebih dari 20 karakter',
            'nama.unique'         => 'Tidak boleh menggunakan nama pernikahan lagi',
            'jenis.required'      => 'Jenis tidak boleh kosong',
            'jenis.in'            => 'Jenis harus dipilih dari opsi yang tersedia',
            'keterangan.required' => 'Keterangan tidak boleh kosong',
            'keterangan.string'   => 'Keterangan harus berupa karakter',
        ]);

        if ($id == 1) {
            return back()->with('gagal', 'Event ini tidak boleh diubah');
        }

        $data = WEvent::where('id', $id)
            ->update([
                'admin_id'   => auth()->user()->admin->id,
                'nama'       => ucwords($req->nama),
                'jenis'      => $req->jenis,
                'keterangan' => $req->keterangan,
            ]);

        if ($data) {
            return back()->with('sukses', 'Mengubah Event Pernikahan');
        }
        return back()->with('gagal', 'Mengubah Event Pernikahan');
    }

    public function hapus($id) {
        $event = WEvent::find($id);

        if (!$event) {
            return back()->with('gagal', 'ID Invalid');
        }

        if ($event->id == 1 && $event->nama == 'Pernikahan') {
            return back()->with('gagal', 'Event ini tidak boleh dihapus');
        }

        $data = $event->delete();

        if ($data) {
            return redirect()->route('admin.event-pernikahan.index')->with('sukses', 'Menghapus Event Pernikahan');
        }
        return redirect()->route('admin.event-pernikahan.index')->with('gagal', 'Menghapus Event Pernikahan');
    }
}
