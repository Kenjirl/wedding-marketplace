<?php

namespace App\Http\Controllers\WeddingOrganizer;

use App\Http\Controllers\Controller;
use App\Models\WCWedding;
use App\Models\WCWeddingDetail;
use App\Models\WOBooking;
use App\Models\WOPlan;
use App\Models\WOPlanDetail;
use Illuminate\Http\Request;

class WOJadwalController extends Controller
{
    public function index() {
        $bookings = WOBooking::join('w_o_plans', 'w_o_bookings.w_o_plan_id', '=', 'w_o_plans.id')
                ->join('w_organizers', 'w_o_plans.w_organizer_id', '=', 'w_organizers.id')
                ->where('w_organizers.id', auth()->user()->w_organizer->id)
                ->where('w_o_bookings.status', 'diterima')
                ->select('w_o_bookings.*')
                ->get();

        $events = [];

        foreach ($bookings as $booking) {
            $events[] = [
                'title'  => 'Tn.'.$booking->wedding->groom.' & Ny. '.$booking->wedding->bride,
                'allDay' => true,
                'url'    => route('wedding-organizer.jadwal.ke_detail', $booking->id),
                'start' => $booking->untuk_tanggal,
            ];
        }

        return view('user.wedding-organizer.jadwal.index', compact('events'));
    }

    public function ke_detail($id) {
        $booking  = WOBooking::find($id);
        $plan     = WOPlan::find($booking->w_o_plan_id);
        $features = WOPlanDetail::where('w_o_plan_id', $booking->w_o_plan_id)->get();
        $wedding  = WCWedding::find($booking->w_c_wedding_id);
        $events   = WCWeddingDetail::where('w_c_wedding_id', $booking->w_c_wedding_id)
                        ->orderBy('waktu', 'asc')
                        ->get();

        return view('user.wedding-organizer.jadwal.detail', compact(
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

        $data = WOBooking::find($id)
                ->update([
                    'status' => $req->status,
                ]);

        if ($data) {
            return redirect()->route('wedding-organizer.jadwal.index')->with('sukses', 'Membatalkan Pesanan');
        }
        return redirect()->route('wedding-organizer.jadwal.ke_detail', $id)->with('gagal', 'Terjadi kesalahan');
    }
}
