<?php

namespace App\Http\Controllers\WeddingCouple;

use App\Http\Controllers\Controller;
use App\Http\Requests\WeddingCouple\WeddingRequest;
use App\Models\WCGuest;
use App\Models\WCWedding;
use App\Models\WCWeddingDetail;
use App\Models\WEvent;
use App\Models\WVBooking;
use Carbon\Carbon;
use Illuminate\Http\Request;

class WCWeddingController extends Controller
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

        return view('user.wedding-couple.wedding.index', compact('weddings'));
    }

    public function ke_tambah() {
        $events = WEvent::orderBy('jenis', 'asc')
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
        $wedding->p_lengkap = $req->p_lengkap;
        $wedding->p_sapaan  = $req->p_sapaan;
        $wedding->p_ayah    = $req->p_ayah;
        $wedding->p_ibu     = $req->p_ibu;
        $wedding->w_lengkap = $req->w_lengkap;
        $wedding->w_sapaan  = $req->w_sapaan;
        $wedding->w_ayah    = $req->w_ayah;
        $wedding->w_ibu     = $req->w_ibu;
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

    public function ke_detail(Request $req, $id) {
        $wedding = WCWedding::find($id);

        if (!$wedding) {
            return redirect()->route('wedding-couple.pernikahan.index')->with('gagal', 'ID Invalid');
        }

        $tab = $req->query('tab', 'detail');
        $allowedTabs = ['detail', 'ubah-undangan', 'tamu-undangan'];
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
                                $query->withTrashed();
                            }, 'plan.w_vendor'])
                            ->where('w_c_wedding_id', $id)
                            ->where('status', '!=', 'batal')
                            ->get()
                            ->groupBy(function ($booking) {
                                return $booking->plan->w_vendor->jenis;
                            });

            $bookedOrganizer = $bookedVendor->get('wedding-organizer', collect());
            $bookedPhotographers = $bookedVendor->get('photographer', collect());
            $bookedCatering = $bookedVendor->get('catering', collect());
            $bookedVenue = $bookedVendor->get('venue', collect());

            return view('user.wedding-couple.wedding.detail', compact(
                'tab',
                'wedding',
                'weddingEvents',
                'bookedOrganizer',
                'bookedPhotographers',
                'bookedCatering',
                'bookedVenue',
            ));
        } elseif ($tab == 'ubah-undangan') {
            $invitation = $wedding->invitation;
            return view('user.wedding-couple.wedding.detail', compact(
                'tab',
                'wedding',
                'weddingEvents',
                'invitation',
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
            return view('user.wedding-couple.wedding.detail', compact(
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

        if ($wedding->w_detail) {
            foreach ($wedding->w_detail as $event) {
                $event->delete();
            }
        }

        if ($wedding->w_o_booking) {
            foreach ($wedding->w_o_booking as $bookedOrganizer) {
                $bookedOrganizer->delete();

                if ($bookedOrganizer->bukti_bayar) {
                    unlink(public_path($bookedOrganizer->bukti_bayar));
                }
            }
        }

        if ($wedding->w_p_booking) {
            foreach ($wedding->w_p_booking as $bookedPhotographer) {
                $bookedPhotographer->delete();

                if ($bookedPhotographer->bukti_bayar) {
                    unlink(public_path($bookedPhotographer->bukti_bayar));
                }
            }
        }

        $data = $wedding->delete();

        if ($data) {
            return redirect()->route('wedding-couple.pernikahan.index')->with('sukses', 'Menghapus Pernikahan');
        }
        return redirect()->route('wedding-couple.pernikahan.index')->with('gagal', 'Menghapus Pernikahan');
    }

    public function hapus_wo($id) {
        $booking = WVBooking::find($id);
        if ($booking->bukti_bayar) {
            unlink(public_path($booking->bukti_bayar));
        }
        $booking->status = 'batal';
        $booking->save();
        $data = $booking->delete();

        if ($data) {
            return redirect()->back()->with('sukses', 'Membatalkan Pesanan Wedding Organizer');
        }
        return redirect()->back()->with('gagal', 'Membatalkan Pesanan Wedding Organizer');
    }

    public function hapus_wp($id) {
        $booking = WVBooking::find($id);
        if ($booking->bukti_bayar) {
            unlink(public_path($booking->bukti_bayar));
        }
        $booking->status = 'batal';
        $booking->save();
        $data = $booking->delete();

        if ($data) {
            return redirect()->back()->with('sukses', 'Menghapus Pesanan Wedding Photographer');
        }
        return redirect()->back()->with('gagal', 'Menghapus Pesanan Wedding Photographer');
    }

    public function selesai(Request $req) {
        $booking = WVBooking::find($req->id_booking);
        $booking->status = 'selesai';
        $data = $booking->save();

        if ($data) {
            return redirect()->back()->with('sukses', 'Menyelesaikan Pesanan Wedding Organizer');
        }
        return redirect()->back()->with('gagal', 'Menyelesaikan Pesanan Wedding Organizer');
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
                'rating' => $req->rating,
                'komentar' => $req->komentar,
            ]);
        } else {
            $data = $booking->rating()->update([
                'rating' => $req->rating,
                'komentar' => $req->komentar,
            ]);
        }

        if ($data) {
            return redirect()->back()->with('sukses', 'Memberikan Ulasan pada Wedding Organizer');
        }
        return redirect()->back()->with('gagal', 'Memberikan Ulasan pada Wedding Organizer');
    }
}
