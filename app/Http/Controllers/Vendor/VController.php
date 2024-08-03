<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\WVBooking;
use Carbon\Carbon;
use Illuminate\Http\Request;

class VController extends Controller
{
    public function index() {
        $user = auth()->user();
        $vendor = $user->w_vendor ?? null;
        $jenis = $vendor ? $vendor->jenis : collect();

        if ($vendor && $jenis->isNotEmpty()) {
            $bookings = WVBooking::where('w_vendor_id', $vendor->id)
                            ->with(['wedding'])
                            ->whereIn('status', ['diproses', 'diterima'])
                            ->latest()->limit(5)->get();

            $paidBookings = WVBooking::where('w_vendor_id', $vendor->id)
                        ->with(['wedding', 'rating'])
                        ->whereIn('status', ['dibayar', 'selesai'])
                        ->whereBetween('untuk_tanggal', [now()->startOfWeek(), now()->endOfWeek()])
                        ->get();
            $schedules = [];

            foreach ($paidBookings as $paidBooking) {
                $schedules[] = [
                    'title'  => 'Tn.'.$paidBooking->wedding->p_sapaan.' & Ny. '.$paidBooking->wedding->w_sapaan,
                    'allDay' => true,
                    'url'    => route('vendor.jadwal.ke_detail', $paidBooking->id),
                    'start' => $paidBooking->untuk_tanggal,
                ];
            }

            $oneMonthAgo = Carbon::now()->subMonth();

            $revenues = WVBooking::where('w_vendor_id', $vendor->id)
                ->whereIn('status', ['dibayar', 'selesai'])
                ->whereMonth('created_at', now()->month)
                ->whereYear('created_at', now()->year)
                ->with(['plan' => function ($query) {
                    $query->withTrashed()->with(['jenis' => function ($query) {
                        $query->withTrashed();
                    }]);
                }])
                ->get()
                ->groupBy(function ($book) {
                    return $book->plan->jenis->nama;
                });

            $monthlyRevenue = [];

            foreach ($revenues as $jenisVendorName => $books) {
                $monthlyRevenue[$jenisVendorName] = 0;

                foreach ($books as $book) {
                    $monthlyRevenue[$jenisVendorName] += $book->total_bayar;
                }
            }

            return view('vendor.index', compact(
                'vendor',
                'jenis',
                'bookings',
                'schedules',
                'monthlyRevenue'
            ));
        } else {
            return view('vendor.index', compact(
                'vendor',
                'jenis',
            ));
        }
    }
}
