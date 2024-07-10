<?php

namespace App\Http\Controllers\User;

use App\Helpers\BookingFormatter;
use App\Helpers\NumberFormatter;
use App\Http\Controllers\Controller;
use App\Models\MJenisVendor;
use App\Models\WCWedding;
use App\Models\WVBooking;
use App\Models\WVendor;
use App\Models\WVPlan;
use App\Models\WVPortofolio;
use App\Models\WVRating;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UBookingController extends Controller
{
    public function paket_layanan(Request $req) {
        $plans = WVPlan::all();

        foreach ($plans as $plan) {
            $bookings = WVBooking::where('w_v_plan_id', $plan->id)
                                ->where('status', 'selesai')
                                ->get();

            if ($bookings->isNotEmpty()) {
                $plan->rate = WVRating::whereIn('w_v_booking_id', $bookings->pluck('id'))->avg('rating');
                $plan->bookedCount = BookingFormatter::format($bookings->count());
            }

            $plan->basis_operasi = $plan->w_vendor->basis_operasi;
            $plan->kota_operasi = $plan->w_vendor->kota_operasi;
        }

        $nama_layanan         = $req->input('nama_layanan');
        $nama_vendor          = $req->input('nama_vendor');
        $search_harga         = $req->input('harga');
        $search_basis_operasi = $req->input('basis_operasi');
        $search_kota_operasi  = $req->input('kota_operasi');
        $search_jenis_vendor  = $req->input('search_jenis_vendor');

        $filteredPlans = $plans->filter(function($plan) use ($nama_layanan, $nama_vendor, $search_harga, $search_basis_operasi, $search_kota_operasi, $search_jenis_vendor) {
            if ($search_harga !== null && $plan->harga > $search_harga) {
                return false;
            }

            if ($search_basis_operasi !== null && stripos($plan->basis_operasi, $search_basis_operasi) === false) {
                return false;
            }

            if ($search_kota_operasi !== null && stripos($plan->kota_operasi, $search_kota_operasi) === false) {
                return false;
            }

            if ($search_jenis_vendor !== null && stripos($plan->m_jenis_vendor_id, $search_jenis_vendor) === false) {
                return false;
            }

            if ($nama_layanan !== null && stripos($plan->nama, $nama_layanan) === false) {
                return false;
            }

            if ($nama_vendor !== null && stripos($plan->w_vendor->nama, $nama_vendor) === false) {
                return false;
            }

            return true;
        });

        $m_j_vendor = MJenisVendor::all();

        return view('user.search.paket-layanan', compact(
            'filteredPlans',
            'nama_layanan',
            'nama_vendor',
            'search_harga',
            'search_basis_operasi',
            'search_kota_operasi',
            'search_jenis_vendor',
            'm_j_vendor',
        ));
    }

    public function vendor(Request $req) {
        $vendors = WVendor::whereHas('plan')
                    ->orderBy('nama', 'asc')
                    ->with('plan')
                    ->get();

        foreach ($vendors as $vendor) {
            $plans = $vendor->plan;

            $vendor->harga_terendah = $plans->min('harga');
            $vendor->harga_tertinggi = $plans->max('harga');
            $vendor->rate = 0;
            $vendor->bookedCount = 0;

            $bookings = WVBooking::whereIn('w_v_plan_id', $plans->pluck('id'))
                                ->where('status', 'selesai')
                                ->get();

            if ($bookings->isNotEmpty()) {
                $vendor->rate = WVRating::whereIn('w_v_booking_id', $bookings->pluck('id'))->avg('rating');
                $vendor->bookedCount = BookingFormatter::format($bookings->count());
            }

            $vendor->harga_terendah = NumberFormatter::format($vendor->harga_terendah);
            $vendor->harga_tertinggi = NumberFormatter::format($vendor->harga_tertinggi);
        }

        $nama_vendor          = $req->input('nama_vendor');
        $search_harga         = $req->input('harga');
        $search_basis_operasi = $req->input('basis_operasi');
        $search_kota_operasi  = $req->input('kota_operasi');
        $search_jenis_vendor  = $req->input('search_jenis_vendor');

        $filteredVendors = $vendors->filter(function($vendor) use ($search_harga, $search_basis_operasi, $search_kota_operasi, $search_jenis_vendor, $nama_vendor) {
            if ($search_harga !== null && $vendor->harga_terendah > $search_harga) {
                return false;
            }

            if ($search_basis_operasi !== null && strpos(strtolower($vendor->basis_operasi), strtolower($search_basis_operasi)) === false) {
                return false;
            }

            if ($search_kota_operasi !== null && strpos(strtolower($vendor->kota_operasi), strtolower($search_kota_operasi)) === false) {
                return false;
            }

            if ($search_jenis_vendor !== null) {
                $jenisIds = $vendor->jenis->pluck('m_jenis_vendor_id')->toArray();
                if (!in_array($search_jenis_vendor, $jenisIds)) {
                    return false;
                }
            }

            if ($nama_vendor !== null && stripos($vendor->nama, $nama_vendor) === false) {
                return false;
            }

            return true;
        });

        $m_j_vendor = MJenisVendor::all();

        return view('user.search.vendor', compact(
            'filteredVendors',
            'nama_vendor',
            'search_harga',
            'search_basis_operasi',
            'search_kota_operasi',
            'search_jenis_vendor',
            'm_j_vendor',
        ));
    }

    public function ke_detail(Request $req, $id) {
        $vendor = WVendor::find($id);

        if (!$vendor) {
            return back()->with('gagal', 'ID Invalid');
        }

        $tab = $req->query('tab', 'portofolio');
        $allowedTabs = ['portofolio', 'layanan', 'booking'];
        if (!in_array($tab, $allowedTabs)) {
            $tab = 'portofolio';
        }

        $portofolios = collect();
        $portofolio_detail = null;
        $plans = collect();
        $weddings = collect();

        $plans = WVPlan::where('w_vendor_id', $vendor->id)
                    ->orderBy('harga', 'asc')
                    ->withCount(['bookings as bookings_count' => function ($query) {
                        $query->where('status', 'selesai');
                    }])
                    ->with(['bookings.rating'])
                    ->get();

        $totalRatingAllPlans = 0;
        $totalReviewCountAllPlans = 0;

        foreach ($plans as $plan) {
            $plan->bookings = $plan->bookings->sortByDesc(function ($booking) {
                return $booking->rating->rating ?? 0;
            });

            $plan->count = BookingFormatter::format($plan->bookings_count);

            $totalRating = $plan->bookings->sum('rating.rating');
            $ratingCount = $plan->bookings->whereNotNull('rating.rating')->count();

            $plan->rate = $ratingCount ? $totalRating / $ratingCount : null;
            $plan->ulasanCount = $ratingCount;

            $totalRatingAllPlans += $totalRating;
            $totalReviewCountAllPlans += $ratingCount;
        }

        $vendor->rate = $totalReviewCountAllPlans ? $totalRatingAllPlans / $totalReviewCountAllPlans : null;

        if ($tab == 'portofolio') {
            $portofolios = WVPortofolio::where('w_vendor_id', $vendor->id)
                            ->where('status', 'diterima')
                            ->orderBy('tanggal', 'asc')
                            ->orderBy('judul', 'asc')
                            ->get();

            $portofolio_detail = null;
            if ($req->has('portofolio_id')) {
                $portofolio_detail = WVPortofolio::find($req->portofolio_id);
            } else {
                $portofolio_detail = $portofolios->first();
            }

            if ($portofolio_detail) {
                $portofolios = $portofolios->filter(function($portofolio) use ($portofolio_detail) {
                    return $portofolio->id !== $portofolio_detail->id;
                });
            } else {
                $portofolios = collect();
            }

            return view('user.search.detail.' . $tab, compact(
                'vendor',
                'portofolios',
                'portofolio_detail',
                'tab',
            ));
        } elseif ($tab == 'layanan') {
            return view('user.search.detail.' . $tab, compact(
                'vendor',
                'plans',
                'tab',
            ));
        } else {
            $id_layanan = $req->input('id_layanan');

            $plan = $plans->where('id', $id_layanan)->first();

            if (!$plan) {
                return redirect()->back()->with('gagal', 'ID Layanan tidak valid');
            }

            $today = Carbon::today()->startOfDay();
            $weddings = WCWedding::where('w_couple_id', auth()->user()->w_couple->id)
                // ->whereNotIn('id', $bookedWeddingIds)
                ->whereHas('w_detail', function ($query) use ($today) {
                    $query->whereRaw('waktu = (SELECT MAX(wd.waktu) FROM w_c_wedding_details wd WHERE wd.w_c_wedding_id = w_c_weddings.id)')
                        ->whereDate('waktu', '>', $today);
                })
                ->orderBy('p_lengkap', 'asc')
                ->get();

            return view('user.search.detail.' . $tab, compact(
                'vendor',
                'plan',
                'weddings',
                'tab',
            ));
        }
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
        $booking->w_vendor_id    = $plan->w_vendor->id;
        $booking->w_v_plan_id    = $req->plan_id;
        $booking->untuk_tanggal  = $req->tanggal;
        $booking->qty            = $req->qty;
        $booking->total_bayar    = $plan->harga * $req->qty;
        $data = $booking->save();

        if ($data) {
            return redirect()->route('user.pernikahan.ke_detail', $req->wedding_id)->with('sukses', 'Memesan Vendor');
        }
        return redirect()->route('user.pernikahan.ke_detail', $req->wedding_id)->with('gagal', 'Memesan Vendor');
    }
}
