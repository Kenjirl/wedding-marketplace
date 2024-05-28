<?php

namespace App\Http\Controllers\WeddingPhotographer;

use App\Http\Controllers\Controller;
use App\Models\WCWedding;
use App\Models\WCWeddingDetail;
use App\Models\WVBooking;
use App\Models\WVPlan;
use Illuminate\Http\Request;

class WPPesananController extends Controller
{
    public function index() {
        $bookings = WVBooking::join('w_v_plans', 'w_v_bookings.w_v_plan_id', '=', 'w_v_plans.id')
                ->join('w_vendors', 'w_v_plans.w_vendor_id', '=', 'w_vendors.id')
                ->where('w_vendors.id', auth()->user()->w_vendor->id)
                ->whereIn('w_v_bookings.status', ['diterima', 'diproses'])
                ->select('w_v_bookings.*')
                ->orderBy('w_v_bookings.created_at', 'desc')
                ->get();

        return view('user.wedding-photographer.pesanan.index', compact('bookings'));
    }

    public function ke_detail($id) {
        $booking  = WVBooking::find($id);

        if (!$booking) {
            return redirect()->route('wedding-photographer.pesanan.index')->with('gagal', 'ID Invalid');
        }

        $plan     = WVPlan::find($booking->w_v_plan_id);
        $wedding  = WCWedding::find($booking->w_c_wedding_id);
        $events   = WCWeddingDetail::where('w_c_wedding_id', $booking->w_c_wedding_id)
                        ->orderBy('waktu', 'asc')
                        ->get();

        return view('user.wedding-photographer.pesanan.detail', compact(
            'booking',
            'plan',
            'wedding',
            'events',
        ));
    }

    public function respon(Request $req, $id) {
        $req->validate([
            'status' => 'required',
        ],[
            'status.required' => 'Status tidak boleh kosong',
        ]);

        $data = WVBooking::find($id)
                ->update([
                    'status' => $req->status,
                ]);

        if ($data && $req->status == 'diterima') {
            return redirect()->route('wedding-photographer.pesanan.index')->with('sukses', 'Menerima Pesanan');
        } else if ($data && $req->status == 'ditolak') {
            return redirect()->route('wedding-photographer.pesanan.index')->with('sukses', 'Menolak Pesanan');
        }
        return redirect()->route('wedding-photographer.pesanan.ke_detail', $id)->with('gagal', 'Terjadi kesalahan');
    }
}
