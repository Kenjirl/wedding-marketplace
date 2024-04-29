<?php

namespace App\Http\Controllers\WeddingPhotographer;

use App\Http\Controllers\Controller;
use App\Models\WCWedding;
use App\Models\WCWeddingDetail;
use App\Models\WPBooking;
use App\Models\WPPlan;
use Illuminate\Http\Request;

class WPPesananController extends Controller
{
    public function index() {
        $bookings = WPBooking::join('w_p_plans', 'w_p_bookings.w_p_plan_id', '=', 'w_p_plans.id')
                ->join('w_photographers', 'w_p_plans.w_photographer_id', '=', 'w_photographers.id')
                ->where('w_photographers.id', auth()->user()->w_photographer->id)
                ->where('w_p_bookings.status', 'diproses')
                ->select('w_p_bookings.*')
                ->orderBy('w_p_bookings.created_at', 'desc')
                ->get();

        return view('user.wedding-photographer.pesanan.index', compact('bookings'));
    }

    public function ke_detail($id) {
        $booking  = WPBooking::find($id);

        if (!$booking) {
            return redirect()->route('wedding-photographer.pesanan.index')->with('gagal', 'ID Invalid');
        }

        $plan     = WPPlan::find($booking->w_p_plan_id);
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

        $data = WPBooking::find($id)
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
