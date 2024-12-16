<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\WeddingCouple\WeddingRequest;
use App\Models\MEvent;
use App\Models\MJenisVendor;
use App\Models\WCGuest;
use App\Models\WCWedding;
use App\Models\WCWeddingDetail;
use App\Models\WVBooking;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UWeddingController extends Controller
{
    public function index() {
        $weddings = WCWedding::where('w_couple_id', auth()->user()->w_couple->id)
                    ->orderBy('created_at', 'desc')
                    ->orderBy('p_sapaan', 'asc')
                    ->with(['w_detail' => function ($query) {
                        $query->orderBy('waktu', 'asc');
                    }])
                    ->get();

        foreach ($weddings as $wedding) {
            if ($wedding->w_detail->isNotEmpty()) {
                $wedding->limit = Carbon::parse($wedding->w_detail->first()->waktu)->startOfDay() ?? null;

                if ($wedding->w_detail->isNotEmpty()) {
                    $waktuTerkecil = Carbon::parse($wedding->w_detail->first()->waktu);
                    $waktuTerbesar = Carbon::parse($wedding->w_detail->last()->waktu);
                    if ($waktuTerkecil->isSameDay($waktuTerbesar)) {
                        $wedding->duration = $waktuTerkecil->format('d/m/Y');
                    } else {
                        $wedding->duration = $waktuTerkecil->format('d/m/Y') . ' - ' . $waktuTerbesar->format('d/m/Y');
                    }
                } else {
                    $wedding->duration = null;
                }
            }
        }

        return view('user.wedding.index', compact('weddings'));
    }

    public function ke_tambah() {
        return view('user.wedding.tambah.pengantin');
    }

    public function tambah(Request $req) {
        $req->validate(
            [
                'p_lengkap' =>'required|string|regex:/^[a-zA-Z\s]*$/',
                'p_sapaan'  =>'required|string|regex:/^[a-zA-Z\s]*$/',
                'p_ayah'    =>'required|string|regex:/^[a-zA-Z\s]*$/',
                'p_ibu'     =>'required|string|regex:/^[a-zA-Z\s]*$/',
                'w_lengkap' =>'required|string|regex:/^[a-zA-Z\s]*$/',
                'w_sapaan'  =>'required|string|regex:/^[a-zA-Z\s]*$/',
                'w_ayah'    =>'required|string|regex:/^[a-zA-Z\s]*$/',
                'w_ibu'     =>'required|string|regex:/^[a-zA-Z\s]*$/',
            ],
            [
                'p_lengkap.required' => 'Nama lengkap pengantin pria tidak boleh kosong',
                'p_lengkap.string'   => 'Nama lengkap pengantin pria harus berupa karakter',
                'p_lengkap.regex'    => 'Nama lengkap pengantin pria tidak boleh memuat angka dan/atau tanda baca',
                'p_sapaan.required'  => 'Nama sapaan pengantin pria tidak boleh kosong',
                'p_sapaan.string'    => 'Nama sapaan pengantin pria harus berupa karakter',
                'p_sapaan.regex'     => 'Nama sapaan pengantin pria tidak boleh memuat angka dan/atau tanda baca',
                'p_ayah.required'    => 'Nama ayah pengantin pria tidak boleh kosong',
                'p_ayah.string'      => 'Nama ayah pengantin pria harus berupa karakter',
                'p_ayah.regex'       => 'Nama ayah pengantin pria tidak boleh memuat angka dan/atau tanda baca',
                'p_ibu.required'     => 'Nama ibu pengantin pria tidak boleh kosong',
                'p_ibu.string'       => 'Nama ibu pengantin pria harus berupa karakter',
                'p_ibu.regex'        => 'Nama ibu pengantin pria tidak boleh memuat angka dan/atau tanda baca',

                'w_lengkap.required' => 'Nama lengkap pengantin wanita tidak boleh kosong',
                'w_lengkap.string'   => 'Nama lengkap pengantin wanita harus berupa karakter',
                'w_lengkap.regex'    => 'Nama lengkap pengantin wanita tidak boleh memuat angka dan/atau tanda baca',
                'w_sapaan.required'  => 'Nama sapaan pengantin wanita tidak boleh kosong',
                'w_sapaan.string'    => 'Nama sapaan pengantin wanita harus berupa karakter',
                'w_sapaan.regex'     => 'Nama sapaan pengantin wanita tidak boleh memuat angka dan/atau tanda baca',
                'w_ayah.required'    => 'Nama ayah pengantin wanita tidak boleh kosong',
                'w_ayah.string'      => 'Nama ayah pengantin wanita harus berupa karakter',
                'w_ayah.regex'       => 'Nama ayah pengantin wanita tidak boleh memuat angka dan/atau tanda baca',
                'w_ibu.required'     => 'Nama ibu pengantin wanita tidak boleh kosong',
                'w_ibu.string'       => 'Nama ibu pengantin wanita harus berupa karakter',
            ]
        );

        $wedding = new WCWedding();
        $wedding->w_couple_id = auth()->user()->w_couple->id;
        $wedding->p_lengkap = ucwords(strtolower($req->p_lengkap));
        $wedding->p_sapaan  = ucwords(strtolower($req->p_sapaan));
        $wedding->p_ayah    = ucwords(strtolower($req->p_ayah));
        $wedding->p_ibu     = ucwords(strtolower($req->p_ibu));
        $wedding->w_lengkap = ucwords(strtolower($req->w_lengkap));
        $wedding->w_sapaan  = ucwords(strtolower($req->w_sapaan));
        $wedding->w_ayah    = ucwords(strtolower($req->w_ayah));
        $wedding->w_ibu     = ucwords(strtolower($req->w_ibu));
        $data = $wedding->save();

        if ($data) {
            return redirect()->route('user.pernikahan.acara', $wedding->id)->with('sukses', 'Membuat Pernikahan');
        }
        return back()->with('gagal', 'Membuat Pernikahan');
    }

    public function ke_acara($id) {
        $wedding = WCWedding::find($id);

        if (!$wedding) {
            return back()->with('gagal', 'ID tidak valid');
        }

        if ($wedding->w_detail->isNotEmpty()) {
            return redirect()->route('user.pernikahan.ke_detail', $wedding->id)->with('gagal', 'Pernikahan sudah memiliki acara');
        }

        $events = MEvent::orderBy('jenis', 'asc')
                    ->orderBy('nama', 'asc')
                    ->get();

        $event_umum = $events->where('jenis', 'Umum')->first();

        $events = $events->reject(function ($event) {
            return $event->jenis === 'Umum';
        });

        return view('user.wedding.tambah.acara', compact('wedding', 'events', 'event_umum'));
    }

    public function acara(Request $req, $id) {
        $req->validate(
            [
                'w_event_id' => 'required|exists:m_events,id',
                'waktu.*'    => 'required|after:' . date('Y-m-d'),
                'lokasi.*'   => 'nullable|string',
                'lat.*'      => 'nullable|string',
                'lng.*'      => 'nullable|string',
            ],
            [
                'w_event_id.*.required' => 'ID Event tidak boleh kosong',
                'w_event_id.*.exists'   => 'ID Event harus valid',
                'waktu.*.required'      => 'Waktu acara tidak boleh kosong',
                'waktu.*.after'         => 'Waktu acara tidak boleh tanggal sebelum hari ini',
                'lokasi.*.string'       => 'Lokasi acara harus berupa karakter',
                'lat.*.string'          => 'Koordinat latitude harus berupa karakter',
                'lng.*.string'          => 'Koordinat longitude harus berupa karakter',
            ]
        );

        $status = 'selesai';

        $wedding = WCWedding::find($id);

        if (!$wedding) {
            return back()->with('gagal', 'ID tidak valid');
        }

        $reqData = $req->all();

        $data = false;
        foreach ($reqData['w_event_id'] as $key => $eventId) {
            $w_detail = new WCWeddingDetail();
            $w_detail->w_c_wedding_id = $wedding->id;
            $w_detail->m_event_id = $eventId;
            $w_detail->waktu = $reqData['waktu'][$key];
            $w_detail->lokasi = $reqData['lokasi'][$key];
            $w_detail->koordinat = [
                'lat' => $reqData['lat'][$key],
                'lng' => $reqData['lng'][$key],
            ];
            $data = $w_detail->save();

            if ($reqData['lokasi'][$key] == null || $reqData['lat'][$key] == null || $reqData['lng'][$key] == null) {
                $status = 'belum selesai';
            }
        }

        $wedding->status = $status;
        $data1 = $wedding->save();

        if ($data && $data1) {
            return redirect()->route('user.pernikahan.ke_detail', $wedding->id)->with('sukses', 'Membuat Pernikahan');
        }
        return back()->with('gagal', 'Membuat Pernikahan');
    }

    public function ke_ubah($id) {
        $wedding = WCWedding::find($id);

        if (!$wedding) {
            return redirect()->route('user.pernikahan.index')->with('gagal', 'ID Invalid');
        }

        if ($wedding->w_detail->isEmpty()) {
            return redirect()->route('user.pernikahan.ke_acara', $wedding->id)->with('gagal', 'Pernikahan belum memiliki acara');
        }

        $events = $wedding->w_detail;

        return view('user.wedding.ubah', compact('wedding', 'events'));
    }

    public function ubah(Request $req, $id) {
        $req->validate(
            [
                'w_event_id' => 'required|exists:m_events,id',
                'lokasi.*'   => 'nullable|string',
                'lat.*'      => 'nullable|string',
                'lng.*'      => 'nullable|string',
            ],
            [
                'w_event_id.*.required' => 'ID Event tidak boleh kosong',
                'w_event_id.*.exists'   => 'ID Event harus valid',
                'waktu.*.required'      => 'Waktu acara tidak boleh kosong',
                'waktu.*.after'         => 'Waktu acara tidak boleh tanggal sebelum hari ini',
                'lat.*.string'          => 'Koordinat latitude harus berupa karakter',
                'lng.*.string'          => 'Koordinat longitude harus berupa karakter',
            ]
        );

        $status = 'selesai';

        $wedding = WCWedding::find($id);

        if (!$wedding) {
            return back()->with('gagal', 'ID tidak valid');
        }

        $reqData = $req->all();

        $data = false;

        foreach ($reqData['w_event_id'] as $key => $eventId) {
            $w_detail = WCWeddingDetail::where([
                'w_c_wedding_id' => $wedding->id,
                'm_event_id' => $req->w_event_id
            ])->first();

            $w_detail->lokasi = $reqData['lokasi'][$key];
            $w_detail->koordinat = [
                'lat' => $reqData['lat'][$key],
                'lng' => $reqData['lng'][$key],
            ];
            $data = $w_detail->save();

            if ($reqData['lokasi'][$key] == null || $reqData['lat'][$key] == null || $reqData['lng'][$key] == null) {
                $status = 'belum selesai';
            }
        }

        $wedding->status = $status;
        $data1 = $wedding->save();

        if ($data && $data1) {
            return redirect()->route('user.pernikahan.ke_detail', $wedding->id)->with('sukses', 'Memperbarui Pernikahan');
        }
        return back()->with('gagal', 'Memperbarui Pernikahan');
    }

    public function ke_detail(Request $req, $id) {
        $w_couple = auth()->user()->w_couple;
        $wedding = WCWedding::where('id', $id)
            ->where('w_couple_id', $w_couple->id)
            ->first();

        if (!$wedding) {
            return redirect()->route('user.pernikahan.index')->with('gagal', 'ID Invalid');
        }

        if ($wedding->w_detail->isEmpty()) {
            return redirect()->route('user.pernikahan.ke_acara', $wedding->id)->with('gagal', 'Pernikahan belum memiliki acara');
        }

        $infoId = $req->id_info ?: null;
        $tab = $req->query('tab', 'detail');
        $allowedTabs = ['detail', 'tamu-undangan'];
        if (!in_array($tab, $allowedTabs)) {
            $tab = 'detail';
        }

        $weddingEvents = WCWeddingDetail::where('w_c_wedding_id', $id)
                                ->with(['event' => function ($query) {
                                    $query->withTrashed();
                                }])
                                ->orderBy('waktu', 'asc')
                                ->get();

        if ($tab == 'detail') {
            $bookedVendor = WVBooking::with(['plan' => function ($query) {
                                $query->withTrashed()->with(['jenis' => function ($query) {
                                    $query->withTrashed();
                                }]);
                            }])
                            ->where('w_c_wedding_id', $id)
                            ->where('status', '!=', 'batal')
                            ->get();

            $m_j_vendors = MJenisVendor::orderBy('nama')->get();

            return view('user.wedding.detail', compact(
                'infoId',
                'tab',
                'wedding',
                'weddingEvents',
                'bookedVendor',
                'm_j_vendors',
            ));
        } else {
            $guests = WCGuest::where('w_c_wedding_id', $id)->orderBy('nama')->get();
            $counts = WCGuest::where('w_c_wedding_id', $id)
                ->selectRaw('
                    COUNT(*) as total,
                    SUM(status = "Belum Terkirim") as belum_terkirim,
                    SUM(status = "Sudah Terkirim") as terkirim,
                    SUM(respon = "Belum Menjawab") as belum_menjawab,
                    SUM(respon = "Hadir") as hadir,
                    SUM(respon = "Tidak Hadir") as tidak_hadir,
                    SUM(jumlah) as perkiraan_tamu
                ')
                ->first();

            return view('user.wedding.detail', compact(
                'tab',
                'wedding',
                'weddingEvents',
                'guests',
                'counts',
            ));
        }
    }

    public function hapus($id) {
        $wedding = WCWedding::find($id);

        $data = $wedding->delete();

        if ($data) {
            return redirect()->route('user.pernikahan.index')->with('sukses', 'Menghapus Pernikahan');
        }
        return redirect()->route('user.pernikahan.index')->with('gagal', 'Menghapus Pernikahan');
    }

    public function hapus_vendor($id) {
        $booking = WVBooking::find($id);

        $booking->status = 'batal';
        $data = $booking->save();

        // $data = $booking->delete();

        if ($data) {
            return back()->with('sukses', 'Membatalkan Pesanan Wedding Organizer');
        }
        return back()->with('gagal', 'Membatalkan Pesanan Wedding Organizer');
    }

    public function selesai(Request $req) {
        $booking = WVBooking::find($req->id_booking);
        $booking->status = 'selesai';
        $data = $booking->save();

        if ($data) {
            return back()->with('sukses', 'Menyelesaikan Pesanan Wedding Organizer');
        }
        return back()->with('gagal', 'Menyelesaikan Pesanan Wedding Organizer');
    }

    public function ulasan(Request $req, $id) {
        $req->validate([
            'rating' => 'required|min:1|max:5',
            'komentar' => 'required',
        ],[
            'rating.required'   => 'Rating tidak boleh kosong',
            'rating.min'        => 'Rating minimal bernilai 1 (satu)',
            'rating.max'        => 'Rating maksimal bernilai 5 (lima)',
            'komentar.required' => 'Komentar tidak boleh kosong',
        ]);

        $booking = WVBooking::find($id);

        if (!$booking) {
            return back()->with('gagal', 'ID Pemesanan tidak valid');
        }

        $data = null;
        if (!$booking->rating) {
            $data = $booking->rating()->create([
                'w_vendor_id' => $booking->w_vendor_id,
                'w_v_plan_id' => $booking->w_v_plan_id,
                'rating' => $req->rating,
                'komentar' => $req->komentar,
            ]);
        } else {
            $data = $booking->rating()->update([
                'w_vendor_id' => $booking->w_vendor_id,
                'w_v_plan_id' => $booking->w_v_plan_id,
                'rating' => $req->rating,
                'komentar' => $req->komentar,
            ]);
        }

        if ($data) {
            return back()->with('sukses', 'Memberikan Ulasan pada Wedding Organizer');
        }
        return back()->with('gagal', 'Memberikan Ulasan pada Wedding Organizer');
    }
}
