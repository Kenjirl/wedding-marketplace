<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\WCWedding;
use App\Models\WCWeddingDetail;
use App\Models\WVBooking;
use App\Models\WVPlan;
use App\Models\WVTransaction;
use Illuminate\Http\Request;

class VScheduleController extends Controller
{
    public function index() {
        $bookings = WVBooking::where('w_vendor_id', auth()->user()->w_vendor->id)
                ->with(['wedding', 'plan'])
                ->whereIn('status', ['dibayar', 'selesai'])
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

        return view('vendor.jadwal.index', compact('bookings', 'events'));
    }

    public function ke_detail($id) {
        $booking  = WVBooking::where('id', $id)
                        ->whereIn('status', ['dibayar', 'selesai'])
                        ->first();

        if (!$booking) {
            return back()->with('gagal', 'ID tidak valid');
        }

        $plan     = WVPlan::find($booking->w_v_plan_id);
        $wedding  = WCWedding::find($booking->w_c_wedding_id);
        $events   = WCWeddingDetail::where('w_c_wedding_id', $booking->w_c_wedding_id)
                        ->with(['event' => function ($query) {
                            $query->withTrashed();
                        }])
                        ->orderBy('waktu', 'asc')
                        ->get();
        $transaksi = WVTransaction::where('w_v_booking_id', $booking->id)
                        ->whereIn('transaction_status', ['capture', 'settlement'])
                        ->first();

        return view('vendor.jadwal.detail', compact(
            'booking',
            'plan',
            'wedding',
            'events',
            'transaksi',
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
        return redirect()->route('vendor.jadwal.index')->with('gagal', 'Terjadi kesalahan');
    }
}
