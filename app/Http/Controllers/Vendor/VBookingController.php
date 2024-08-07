<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\WCWedding;
use App\Models\WCWeddingDetail;
use App\Models\WVBooking;
use App\Models\WVJenis;
use App\Models\WVPlan;
use Illuminate\Http\Request;

class VBookingController extends Controller
{
    public function index(Request $req) {
        $jenis_id = $req->query('jenis_id');

        $vendorId = auth()->user()->w_vendor->id;

        $j_vendor = WVJenis::where('w_vendor_id', $vendorId)
                            ->with(['master'])
                            ->get();

        $validJenisIds = $j_vendor->pluck('m_jenis_vendor_id')->toArray();

        if ($jenis_id && !in_array($jenis_id, $validJenisIds)) {
            $jenis_id = null;
        }

        $bookingsQuery = WVBooking::where('w_vendor_id', $vendorId)
                    ->with(['plan'])
                    ->whereIn('status', ['diterima', 'diproses'])
                    ->orderBy('created_at');

        if ($jenis_id) {
            $bookingsQuery->whereHas('plan', function ($query) use ($jenis_id) {
                $query->where('m_jenis_vendor_id', $jenis_id);
            });
        }

        $bookings = $bookingsQuery->get();

        return view('vendor.pesanan.index', compact('jenis_id', 'j_vendor', 'bookings'));
    }

    public function ke_detail($id) {
        $booking  = WVBooking::where('id', $id)
                        ->whereIn('status', ['diterima', 'diproses'])
                        ->first();

        if (!$booking) {
            return back()->with('gagal', 'ID tidak valid');
        }

        $plan     = WVPlan::withTrashed()->find($booking->w_v_plan_id);
        $wedding  = WCWedding::find($booking->w_c_wedding_id);
        $events   = WCWeddingDetail::where('w_c_wedding_id', $booking->w_c_wedding_id)
                        ->with(['event' => function ($query) {
                            $query->withTrashed();
                        }])
                        ->orderBy('waktu', 'asc')
                        ->get();

        return view('vendor.pesanan.detail', compact(
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
            return back()->with('sukses', 'Menerima Pesanan');
        } else if ($data && $req->status == 'ditolak') {
            return redirect()->route('vendor.pesanan.index')->with('sukses', 'Menolak Pesanan');
        }
        return back()->with('gagal', 'Terjadi kesalahan');
    }
}
