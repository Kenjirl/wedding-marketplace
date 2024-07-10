<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\WCWedding;
use App\Models\WCWeddingDetail;
use App\Models\WVBooking;
use App\Models\WVPlan;
use Illuminate\Http\Request;

class VScheduleController extends Controller
{
    public function index() {
        $bookings = WVBooking::join('w_v_plans', 'w_v_bookings.w_v_plan_id', '=', 'w_v_plans.id')
                ->join('w_vendors', 'w_v_plans.w_vendor_id', '=', 'w_vendors.id')
                ->where('w_vendors.id', auth()->user()->w_vendor->id)
                ->whereIn('w_v_bookings.status', ['dibayar', 'selesai'])
                ->select('w_v_bookings.*')
                ->get();

        $events = [];

        foreach ($bookings as $booking) {
            $events[] = [
                'title'  => 'Tn.'.$booking->wedding->p_sapaan.' & Ny. '.$booking->wedding->w_sapaan,
                'allDay' => true,
                'url'    => route('vendor.jadwal.ke_detail', $booking->id),
                'start' => $booking->untuk_tanggal,
            ];
        }

        return view('vendor.jadwal.index', compact('events'));
    }

    public function ke_detail($id) {
        $booking  = WVBooking::find($id);

        if (!$booking) {
            return redirect()->route('vendor.jadwal.index')->with('gagal', 'ID Invalid');
        }

        $plan     = WVPlan::find($booking->w_v_plan_id);
        $wedding  = WCWedding::find($booking->w_c_wedding_id);
        $events   = WCWeddingDetail::where('w_c_wedding_id', $booking->w_c_wedding_id)
                        ->with(['event' => function ($query) {
                            $query->withTrashed();
                        }])
                        ->orderBy('waktu', 'asc')
                        ->get();

        return view('vendor.jadwal.detail', compact(
            'booking',
            'plan',
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

        $data = WVBooking::find($id)
                ->update([
                    'status' => $req->status,
                ]);

        if ($data) {
            return redirect()->route('vendor.jadwal.index')->with('sukses', 'Membatalkan Pesanan');
        }
        return redirect()->route('vendor.jadwal.ke_detail', $id)->with('gagal', 'Terjadi kesalahan');
    }
}
