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

class WPBookingController extends Controller
{
    public function index(Request $req) {
        $photographers = WVendor::where('jenis', 'photographer')
                    ->orderBy('nama', 'asc')
                    ->with('plan')
                    ->get();

        foreach ($photographers as $photographer) {
            $plans = $photographer->plan;

            $photographer->harga_terendah = $plans->min('harga');
            $photographer->harga_tertinggi = $plans->max('harga');
            $photographer->rate = 0;
            $photographer->bookedCount = 0;

            $bookings = WVBooking::whereIn('w_v_plan_id', $plans->pluck('id'))
                                ->where('status', 'selesai')
                                ->get();

            if ($bookings->isNotEmpty()) {
                $photographer->rate = WVRating::whereIn('w_v_booking_id', $bookings->pluck('id'))->avg('rating');
                $photographer->bookedCount = BookingFormatter::format($bookings->count());
            }

            $photographer->harga_terendah = NumberFormatter::format($photographer->harga_terendah);
            $photographer->harga_tertinggi = NumberFormatter::format($photographer->harga_tertinggi);
        }

        $search_harga = $req->input('harga');
        $search_basis_operasi = $req->input('basis_operasi');
        $search_kota_operasi = $req->input('kota_operasi');

        $filteredPhotographers = $photographers->filter(function($photographer) use ($search_harga, $search_basis_operasi, $search_kota_operasi) {
            if ($search_harga !== null && $photographer->harga_terendah > $search_harga) {
                return false;
            }

            if ($search_basis_operasi !== null && strpos(strtolower($photographer->basis_operasi), strtolower($search_basis_operasi)) === false) {
                return false;
            }

            if ($search_kota_operasi !== null && strpos(strtolower($photographer->kota_operasi), strtolower($search_kota_operasi)) === false) {
                return false;
            }

            return true;
        });

        return view('user.wedding-couple.booking.wp.index', compact(
            'filteredPhotographers',
            'search_harga',
            'search_basis_operasi',
            'search_kota_operasi',
        ));
    }

    public function ke_detail(Request $req, $id) {
        $photographer = WVendor::find($id);

        if (!$photographer) {
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
        $plans = WVPlan::where('w_vendor_id', $photographer->id)
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

        $photographer->rate = $totalReviewCountAllPlans ? $totalRatingAllPlans / $totalReviewCountAllPlans : null;

        if ($tab == 'portofolio') {
            $portofolios = WVPortofolio::where('w_vendor_id', $photographer->id)
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
            $wpPlanIds = $plans->pluck('id');
            $bookedWeddingIds = WVBooking::whereIn('w_v_plan_id', $wpPlanIds)
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

        return view('user.wedding-couple.booking.wp.detail', compact(
            'photographer',
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
            return redirect()->route('wedding-couple.pernikahan.ke_detail', $req->wedding_id)->with('sukses', 'Memesan Fotografer');
        }
        return redirect()->route('wedding-couple.pernikahan.ke_detail', $req->wedding_id)->with('gagal', 'Memesan Fotografer');
    }
}
