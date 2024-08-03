<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\WCWedding;
use App\Models\WCWeddingDetail;
use App\Models\WVBooking;
use App\Models\WVJenis;
use App\Models\WVPlan;
use App\Models\WVTransaction;
use Illuminate\Http\Request;

class VScheduleController extends Controller
{
    public function index(Request $req) {
        $jenis_id = $req->query('jenis_id');
        $tab      = $req->query('tab', 'calendar');

        $allowedTabs = ['calendar', 'table'];
        if (!in_array($tab, $allowedTabs)) {
            $tab = 'calendar';
        }

        $vendorId = auth()->user()->w_vendor->id;

        $j_vendor = WVJenis::where('w_vendor_id', $vendorId)
                            ->with(['master'])
                            ->withTrashed()
                            ->get();

        $validJenisIds = $j_vendor->pluck('m_jenis_vendor_id')->toArray();

        if ($jenis_id && !in_array($jenis_id, $validJenisIds)) {
            $jenis_id = null;
        }

        $bookingsQuery = WVBooking::where('w_vendor_id', $vendorId)
                    ->with(['wedding', 'plan'])
                    ->whereIn('status', ['dibayar', 'selesai'])
                    ->orderBy('untuk_tanggal');

        if ($jenis_id) {
            $bookingsQuery->whereHas('plan', function ($query) use ($jenis_id) {
                $query->withTrashed()->where('m_jenis_vendor_id', $jenis_id);
            });
        }

        $bookings = $bookingsQuery->get();

        $events = [];

        if ($tab == 'calendar') {
            foreach ($bookings as $booking) {
                $events[] = [
                    'title'  => 'Tn.'.$booking->wedding->p_sapaan.' & Ny. '.$booking->wedding->w_sapaan,
                    'allDay' => true,
                    'url'    => route('vendor.jadwal.ke_detail', $booking->id),
                    'start' => $booking->untuk_tanggal,
                ];
            }
        }

        return view('vendor.jadwal.index', compact('j_vendor', 'jenis_id', 'tab', 'bookings', 'events'));
    }

    public function ke_detail($id) {
        $booking  = WVBooking::where('id', $id)
                        ->whereIn('status', ['dibayar', 'selesai'])
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
}
