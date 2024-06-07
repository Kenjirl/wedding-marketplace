<?php

namespace App\Http\Controllers\WeddingCouple\Booking;

use App\Helpers\BookingFormatter;
use App\Helpers\NumberFormatter;
use App\Http\Controllers\Controller;
use App\Models\WCWedding;
use App\Models\WVBooking;
use App\Models\WVendor;
use App\Models\WVPlan;
use App\Models\WVPortofolio;
use App\Models\WVRating;
use Carbon\Carbon;
use Illuminate\Http\Request;

class VBookingController extends Controller
{
    public function index(Request $req) {
        $venues = WVendor::where('jenis', 'venue')
                    ->orderBy('nama', 'asc')
                    ->with('plan')
                    ->get();

        foreach ($venues as $venue) {
            $plans = $venue->plan;

            $venue->harga_terendah = $plans->min('harga');
            $venue->harga_tertinggi = $plans->max('harga');
            $venue->rate = 0;
            $venue->bookedCount = 0;

            $bookings = WVBooking::whereIn('w_v_plan_id', $plans->pluck('id'))
                                ->where('status', 'selesai')
                                ->get();

            if ($bookings->isNotEmpty()) {
                $venue->rate = WVRating::whereIn('w_v_booking_id', $bookings->pluck('id'))->avg('rating');
                $venue->bookedCount = BookingFormatter::format($bookings->count());
            }

            $venue->harga_terendah = NumberFormatter::format($venue->harga_terendah);
            $venue->harga_tertinggi = NumberFormatter::format($venue->harga_tertinggi);
        }

        $search_harga = $req->input('harga');
        $search_basis_operasi = $req->input('basis_operasi');
        $search_kota_operasi = $req->input('kota_operasi');

        $filteredVenues = $venues->filter(function($venue) use ($search_harga, $search_basis_operasi, $search_kota_operasi) {
            if ($search_harga !== null && $venue->harga_terendah > $search_harga) {
                return false;
            }

            if ($search_basis_operasi !== null && strpos(strtolower($venue->basis_operasi), strtolower($search_basis_operasi)) === false) {
                return false;
            }

            if ($search_kota_operasi !== null && strpos(strtolower($venue->kota_operasi), strtolower($search_kota_operasi)) === false) {
                return false;
            }

            return true;
        });

        return view('user.wedding-couple.booking.v.index', [
            'filteredVenues' => $filteredVenues,
            'search_harga' => $search_harga,
            'search_basis_operasi' => $search_basis_operasi,
            'search_kota_operasi' => $search_kota_operasi,
        ]);
    }

    public function ke_detail(Request $req, $id) {
        $venue = WVendor::find($id);

        if (!$venue) {
            return back()->with('gagal', 'ID Invalid');
        }

        $tab = $req->query('tab', 'portofolio');
        $allowedTabs = ['portofolio', 'layanan'];
        if (!in_array($tab, $allowedTabs)) {
            $tab = 'portofolio';
        }

        $portofolios = collect();
        $portofolio_detail = null;
        $plans = collect();
        $weddings = collect();

        // DATA PLAN
        $plans = WVPlan::where('w_vendor_id', $venue->id)
                    ->orderBy('harga', 'asc')
                    ->withCount(['bookings as bookings_count' => function ($query) {
                        $query->where('status', 'selesai');
                    }])
                    ->with(['bookings' => function ($query) {
                        $query->with('rating');
                    }])
                    ->get();

        $totalRatingAllPlans = 0;
        $totalReviewCountAllPlans = 0;

        foreach ($plans as $plan) {
            $plan->bookings = $plan->bookings->sortByDesc(function ($booking) {
                return $booking->rating->rating ?? 0;
            });

            $plan->count = BookingFormatter::format($plan->bookings_count);

            $totalRating = 0;
            $ratingCount = 0;
            foreach ($plan->bookings as $booking) {
                if ($booking->rating) {
                    $totalRating += $booking->rating->rating;
                    $ratingCount++;
                }
            }
            $plan->rate = $ratingCount ? $totalRating / $ratingCount : null;
            $plan->ulasanCount = $ratingCount;

            $totalRatingAllPlans += $totalRating;
            $totalReviewCountAllPlans += $ratingCount;
        }

        $venue->rate = $totalReviewCountAllPlans ? $totalRatingAllPlans / $totalReviewCountAllPlans : null;

        if ($tab == 'portofolio') {
            // DATA PORTOFOLIO
            $portofolios = WVPortofolio::where('w_vendor_id', $venue->id)
                            ->where('status', 'diterima')
                            ->orderBy('tanggal', 'asc')
                            ->orderBy('judul', 'asc')
                            ->get();

            $portofolio_detail = $portofolios->first();

            if ($req->has('portofolio_id')) {
                $portofolio_detail = WVPortofolio::find($req->portofolio_id);
            }
        } else {
            // DATA BOOKING
            $vPlanIds = $plans->pluck('id');
            $bookedWeddingIds = WVBooking::whereIn('w_v_plan_id', $vPlanIds)
                                ->whereNotIn('status', ['batal', 'ditolak'])
                                ->pluck('w_c_wedding_id');

            $today = Carbon::today();
            $weddings = WCWedding::where('w_couple_id', auth()->user()->w_couple->id)
                ->whereNotIn('id', $bookedWeddingIds)
                ->whereHas('w_detail', function ($query) use ($today) {
                    $query->whereRaw('waktu = (SELECT MAX(wd.waktu) FROM w_c_wedding_details wd WHERE wd.w_c_wedding_id = w_c_weddings.id)')
                        ->where('waktu', '>', $today);
                })
                ->orderBy('p_lengkap', 'asc')
                ->get();
        }

        return view('user.wedding-couple.booking.v.detail', compact(
            'venue',
            'portofolios',
            'plans',
            'weddings',
            'portofolio_detail',
            'tab',
        ));
    }

    public function pesan(Request $req) {
        $req->validate([
            'plan_id'    => 'required',
            'wedding_id' => 'required',
            'tanggal'    => 'required|date|after:' . date('Y-m-d'),
            'qty'        => 'required|numeric|min:1',
        ],[
            'plan_id.required'    => 'Paket Layanan tidak boleh kosong',
            'wedding_id.required' => 'Pernikahan tidak boleh kosong',
            'tanggal.required'    => 'Tanggal Pernikahan tidak boleh kosong',
            'tanggal.date'        => 'Tanggal Pernikahan herus menggunakan format tanggal yang benar',
            'tanggal.after'       => 'Tanggal Pernikahan harus setelah tanggal hari ini',
            'qty.required'        => 'Jumlah pesanan tidak boleh kosong',
            'qty.numeric'         => 'Jumlah pesanan harus berupa angka',
            'qty.min'             => 'Jumlah pesanan tidak boleh kurang dari 1',
        ]);

        $plan = WVPlan::find($req->plan_id);

        $booking = new WVBooking();
        $booking->w_c_wedding_id = $req->wedding_id;
        $booking->w_v_plan_id    = $req->plan_id;
        $booking->untuk_tanggal  = $req->tanggal;
        $booking->qty            = $req->qty;
        $booking->total_bayar    = $plan->harga * $req->qty;
        $data = $booking->save();

        if ($data) {
            return redirect()->route('wedding-couple.pernikahan.ke_detail', $req->wedding_id)->with('sukses', 'Memesan Wedding venue');
        }
        return redirect()->route('wedding-couple.pernikahan.ke_detail', $req->wedding_id)->with('gagal', 'Memesan Wedding venue');
    }
}
