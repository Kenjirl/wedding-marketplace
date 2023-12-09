<?php

namespace App\Http\Controllers\WeddingCouple;

use App\Http\Controllers\Controller;
use App\Http\Requests\WeddingCouple\WeddingRequest;
use App\Models\WCWedding;
use App\Models\WCWeddingDetail;
use App\Models\WEvent;
use App\Models\WOBooking;
use App\Models\WPBooking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WCWeddingController extends Controller
{
    public function index() {
        $weddings = WCWedding::where('w_couple_id', auth()->user()->w_couple->id)
                    ->orderBy('created_at', 'asc')
                    ->orderBy('groom', 'asc')
                    ->get();

        return view('user.wedding-couple.wedding.index', compact('weddings'));
    }

    public function ke_tambah() {
        $events = WEvent::where('deleted', 0)
                    ->orderBy('jenis', 'asc')
                    ->orderBy('nama', 'asc')
                    ->get();

        $event_umum = $events->where('jenis', 'Umum');

        $events = $events->reject(function ($event) {
            return $event->jenis === 'Umum';
        });

        return view('user.wedding-couple.wedding.tambah', compact('events', 'event_umum'));
    }

    public function tambah(WeddingRequest $req) {
        $req->validated();

        $wedding = new WCWedding();
        $wedding->w_couple_id = auth()->user()->w_couple->id;
        $wedding->groom = $req->groom;
        $wedding->bride = $req->bride;
        $data1 = $wedding->save();

        $reqData = $req->all();

        foreach ($reqData['w_event_id'] as $key => $eventId) {
            $w_detail = new WCWeddingDetail();
            $w_detail->w_c_wedding_id = $wedding->id;
            $w_detail->w_event_id = $eventId;
            $w_detail->waktu = $reqData['waktu'][$key];
            $w_detail->lokasi = $reqData['alamat'][$key] . ', ' . $reqData['kecamatan'][$key] . ', ' . $reqData['kelurahan'][$key] . ', ' . $reqData['kota'][$key] . ', ' . $reqData['provinsi'][$key];
            $w_detail->save();
        }

        if ($data1) {
            return redirect()->route('wedding-couple.pernikahan.ke_detail', $wedding->id)->with('sukses', 'Membuat Pernikahan');
        }
        return redirect()->route('wedding-couple.pernikahan.ke_detail', $wedding->id)->with('gagal', 'Membuat Pernikahan');
    }

    public function ke_detail($id) {
        $wedding             = WCWedding::find($id);
        $weddingEvents       = WCWeddingDetail::where('w_c_wedding_id', $id)
                                ->orderBy('waktu', 'asc')
                                ->get();
        $bookedOrganizer     = WOBooking::where('w_c_wedding_id', $id)
                                ->where('status', '!=', 'batal')
                                ->first();
        $bookedPhotographers = WPBooking::where('w_p_bookings.w_c_wedding_id', $id)
                                ->join('w_p_plans', 'w_p_bookings.w_p_plan_id', '=', 'w_p_plans.id')
                                ->join('w_photographers', 'w_p_plans.w_photographer_id', '=', 'w_photographers.id')
                                ->orderBy('w_photographers.nama', 'asc')
                                ->select('w_p_bookings.*')
                                ->where('w_p_bookings.status', '!=', 'batal')
                                ->get();

        return view('user.wedding-couple.wedding.detail', compact(
            'wedding',
            'weddingEvents',
            'bookedOrganizer',
            'bookedPhotographers'
        ));
    }

    public function hapus_wo($id) {
        // $data = WOBooking::find($id)
        //         ->update([
        //             'status' => 'batal',
        //         ]);
        $booking = WOBooking::find($id);
        if ($booking->bukti_bayar) {
            unlink(public_path($booking->bukti_bayar));
        }
        $data = $booking->delete();

        if ($data) {
            return redirect()->back()->with('sukses', 'Membatalkan Pesanan Wedding Organizer');
        }
        return redirect()->back()->with('gagal', 'Membatalkan Pesanan Wedding Organizer');
    }

    public function hapus_wp($id) {
        // $data = WPBooking::find($id)
        //         ->update([
        //             'status' => 'batal',
        //         ]);
        $booking = WPBooking::find($id);
        if ($booking->bukti_bayar) {
            unlink(public_path($booking->bukti_bayar));
        }
        $data = $booking->delete();

        if ($data) {
            return redirect()->back()->with('sukses', 'Menghapus Pesanan Wedding Photographer');
        }
        return redirect()->back()->with('gagal', 'Menghapus Pesanan Wedding Photographer');
    }

    public function upload_bukti_bayar_wo(Request $req, $id) {
        $req->validate([
            'bukti_bayar' => 'required|image',
        ],[
            'bukti_bayar.required' => 'Bukti bayar tidak boleh kosong',
            'bukti_bayar.image'    => 'Bukti bayar harus berupa gambar',
        ]);

        $data = false;
        if ($req->hasFile(('bukti_bayar'))) {
            $foto = $req->file('bukti_bayar');

            $url = Storage::disk('public')->putFileAs('/',
                $foto,
                'WC/bukti-bayar/WO/' . str()->uuid() . '.' . $foto->extension()
            );

            $data = WOBooking::find($id)
                    ->update([
                        'bukti_bayar' => $url
                    ]);
        }

        if ($data) {
            return redirect()->back()->with('sukses', 'Mengunggah bukti bayar');
        }
        return redirect()->back()->with('gagal', 'Mengunggah bukti bayar');
    }

    public function upload_bukti_bayar_wp(Request $req, $id) {
        $req->validate([
            'bukti_bayar' => 'required|image',
        ],[
            'bukti_bayar.required' => 'Bukti bayar tidak boleh kosong',
            'bukti_bayar.image'    => 'Bukti bayar harus berupa gambar',
        ]);

        $data = false;
        if ($req->hasFile(('bukti_bayar'))) {
            $foto = $req->file('bukti_bayar');

            $url = Storage::disk('public')->putFileAs('/',
                $foto,
                'WC/bukti-bayar/WP/' . str()->uuid() . '.' . $foto->extension()
            );

            $data = WPBooking::find($id)
                    ->update([
                        'bukti_bayar' => $url
                    ]);
        }

        if ($data) {
            return redirect()->back()->with('sukses', 'Mengunggah bukti bayar');
        }
        return redirect()->back()->with('gagal', 'Mengunggah bukti bayar');
    }
}
