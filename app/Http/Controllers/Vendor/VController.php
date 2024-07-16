<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\WVBooking;
use App\Models\WVPortofolio;
use Carbon\Carbon;
use Illuminate\Http\Request;

class VController extends Controller
{
    public function index() {
        $vendor = auth()->user()->w_vendor;

        $bookings = WVBooking::where('w_vendor_id', $vendor->id)
                        ->with(['wedding'])
                        ->whereIn('status', ['diproses', 'diterima'])
                        ->latest()->limit(5)->get();

        $paidBookings = WVBooking::where('w_vendor_id', $vendor->id)
                        ->with(['wedding', 'rating'])
                        ->whereIn('status', ['dibayar', 'selesai'])
                        ->whereMonth('untuk_tanggal', now()->month)
                        ->whereYear('untuk_tanggal', now()->year)
                        ->get();
        $schedules = [];

        foreach ($paidBookings as $booking) {
            $schedules[] = [
                'title'  => 'Tn.'.$booking->wedding->p_sapaan.' & Ny. '.$booking->wedding->w_sapaan,
                'allDay' => true,
                'url'    => route('vendor.jadwal.ke_detail', $booking->id),
                'start' => $booking->untuk_tanggal,
            ];
        }

        $oneYearAgo = Carbon::now()->subYear();

        $revenues = WVBooking::where('w_vendor_id', $vendor->id)
            ->whereIn('status', ['dibayar', 'selesai'])
            ->where('created_at', '>=', $oneYearAgo)
            ->get()
            ->groupBy(function ($date) {
                return Carbon::parse($date->created_at)->format('m');
            });

        $monthlyRevenue = [];

        for ($i = 1; $i <= 12; $i++) {
            $monthlyRevenue[$i] = 0;
        }

        foreach ($revenues as $month => $revenue) {
            $total = $revenue->sum('total_bayar');
            $monthlyRevenue[(int)$month] = $total;
        }

        return view('vendor.index', compact('bookings', 'schedules', 'monthlyRevenue'));
    }
}
