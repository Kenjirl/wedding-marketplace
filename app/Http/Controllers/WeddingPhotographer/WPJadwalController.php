<?php

namespace App\Http\Controllers\WeddingPhotographer;

use App\Http\Controllers\Controller;
use App\Models\WCWedding;
use App\Models\WCWeddingDetail;
use App\Models\WPBooking;
use App\Models\WPPlan;
use App\Models\WPPlanDetail;
use Illuminate\Http\Request;

class WPJadwalController extends Controller
{
    public function index() {
        $bookings = WPBooking::join('w_p_plans', 'w_p_bookings.w_p_plan_id', '=', 'w_p_plans.id')
                ->join('w_photographers', 'w_p_plans.w_photographer_id', '=', 'w_photographers.id')
                ->where('w_photographers.id', auth()->user()->w_photographer->id)
                ->where('w_p_bookings.status', 'diproses')
                ->select('w_p_bookings.*')
                ->get();

        $events = [];

        foreach ($bookings as $booking) {
            $events[] = [
                'title'  => 'Tn.'.$booking->wedding->groom.' & Ny. '.$booking->wedding->bride,
                'allDay' => true,
                'url'    => route('wedding-photographer.jadwal.ke_detail', $booking->id),
                'start' => $booking->untuk_tanggal,
            ];
        }

        return view('user.wedding-photographer.jadwal.index', compact('events'));
    }

    public function ke_detail($id) {
        $booking  = WPBooking::find($id);
        $plan     = WPPlan::find($booking->w_p_plan_id);
        $features = WPPlanDetail::where('w_p_plan_id', $booking->w_p_plan_id)->get();
        $wedding  = WCWedding::find($booking->w_c_wedding_id);
        $events   = WCWeddingDetail::where('w_c_wedding_id', $booking->w_c_wedding_id)
                        ->orderBy('waktu', 'asc')
                        ->get();

        return view('user.wedding-photographer.jadwal.detail', compact(
            'booking',
            'plan',
            'features',
            'wedding',
            'events',
        ));
    }

    public function batal(Request $req, $id) {
        $req->validate([
            'status' => 'required',
        ],[
            'status.required' => 'Status tidak boleh kosong',
        ]);

        $data = WPBooking::find($id)
                ->update([
                    'status' => $req->status,
                ]);

        if ($data) {
            return redirect()->route('wedding-photographer.jadwal.index')->with('sukses', 'Membatalkan Pesanan');
        }
        return redirect()->route('wedding-photographer.jadwal.ke_detail', $id)->with('gagal', 'Terjadi kesalahan');
    }
}
