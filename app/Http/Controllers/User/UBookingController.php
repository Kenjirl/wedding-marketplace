<?php

namespace App\Http\Controllers\User;

use App\Helpers\BookingFormatter;
use App\Helpers\NumberFormatter;
use App\Http\Controllers\Controller;
use App\Models\MJenisVendor;
use App\Models\WCWedding;
use App\Models\WCWeddingDetail;
use App\Models\WVBooking;
use App\Models\WVendor;
use App\Models\WVJenis;
use App\Models\WVPlan;
use App\Models\WVPortofolio;
use App\Models\WVRating;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UBookingController extends Controller
{
    public function paket_layanan(Request $req) {
        $nama_layanan         = $req->input('nama_layanan');
        $jenis_layanan        = $req->input('jenis_layanan');
        $nama_vendor          = $req->input('nama_vendor');
        $search_harga         = $req->input('harga');
        $search_basis_operasi = $req->input('basis_operasi');
        $search_kota_operasi  = $req->input('kota_operasi');
        $search_jenis_vendor  = $req->input('search_jenis_vendor');
        $sort_by              = $req->input('sort_by', '');
        $sort_as              = $req->input('sort_as', 'asc');

        $plansQuery = WVPlan::with('w_vendor');

        if ($nama_layanan) {
            $plansQuery->where('nama', 'like', "%$nama_layanan%");
        }

        if ($jenis_layanan) {
            $plansQuery->where('jenis_layanan', 'like', "%$jenis_layanan%");
        }

        if ($search_basis_operasi) {
            $plansQuery->whereHas('w_vendor', function($query) use ($search_basis_operasi) {
                $query->where('basis_operasi', 'like', "%$search_basis_operasi%");
            });
        }

        if ($search_kota_operasi) {
            $plansQuery->whereHas('w_vendor', function($query) use ($search_kota_operasi) {
                $query->where('kota_operasi', 'like', "%$search_kota_operasi%");
            });
        }

        if ($nama_vendor) {
            $plansQuery->whereHas('w_vendor', function($query) use ($nama_vendor) {
                $query->where('nama', 'like', "%$nama_vendor%");
            });
        }

        if ($search_jenis_vendor) {
            $plansQuery->where('m_jenis_vendor_id', 'like', "%$search_jenis_vendor%");
        }

        $plans = $plansQuery->get();

        foreach ($plans as $plan) {
            $bookings = WVBooking::where('w_v_plan_id', $plan->id)
                                ->where('status', 'selesai')
                                ->get();

            if ($bookings->isNotEmpty()) {
                $plan->rate = WVRating::whereIn('w_v_booking_id', $bookings->pluck('id'))->avg('rating');
                $plan->bookedCount = BookingFormatter::format($bookings->count());
            } else {
                $plan->rate = 0;
                $plan->bookedCount = 0;
            }

            $plan->basis_operasi = $plan->w_vendor->basis_operasi;
            $plan->kota_operasi = $plan->w_vendor->kota_operasi;
        }

        $filteredPlans = $plans->filter(function($plan) use ($search_harga) {
            if ($search_harga !== null && $plan->harga > $search_harga) {
                return false;
            }

            return true;
        });

        if ($sort_by) {
            if ($sort_as == 'asc') {
                $filteredPlans = $filteredPlans->sortBy($sort_by);
            } else {
                $filteredPlans = $filteredPlans->sortByDesc($sort_by);
            }
        }

        $m_j_vendor = MJenisVendor::all();

        return view('user.search.paket-layanan', compact(
            'filteredPlans',
            'nama_layanan',
            'jenis_layanan',
            'nama_vendor',
            'search_harga',
            'search_basis_operasi',
            'search_kota_operasi',
            'search_jenis_vendor',
            'sort_by',
            'sort_as',
            'm_j_vendor'
        ));
    }

    public function portofolio(Request $req) {
        $nama_portofolio      = $req->input('nama_portofolio');
        $nama_vendor          = $req->input('nama_vendor');
        $search_lokasi        = $req->input('search_lokasi');
        $search_jenis_vendor  = $req->input('search_jenis_vendor');
        $sort_by              = $req->input('sort_by', '');
        $sort_as              = $req->input('sort_as', 'asc');

        $portfolQuery = WVPortofolio::with('w_vendor')->where('status', 'diterima');

        if ($nama_portofolio) {
            $portfolQuery->where('judul', 'like', "%$nama_portofolio%");
        }

        if ($search_lokasi) {
            $portfolQuery->where('lokasi', 'like', "%$search_lokasi%");
        }

        if ($nama_vendor) {
            $portfolQuery->whereHas('w_vendor', function($query) use ($nama_vendor) {
                $query->where('nama', 'like', "%$nama_vendor%");
            });
        }

        if ($search_jenis_vendor) {
            $portfolQuery->where('m_jenis_vendor_id', 'like', "%$search_jenis_vendor%");
        }

        $portofolios = $portfolQuery->get();

        if ($sort_by) {
            if ($sort_as == 'asc') {
                $portofolios = $portofolios->sortBy($sort_by);
            } else {
                $portofolios = $portofolios->sortByDesc($sort_by);
            }
        }

        $m_j_vendor = MJenisVendor::all();

        return view('user.search.portofolio', compact(
            'portofolios',
            'nama_portofolio',
            'nama_vendor',
            'search_lokasi',
            'search_jenis_vendor',
            'sort_by',
            'sort_as',
            'm_j_vendor'
        ));
    }

    public function vendor(Request $req) {
        $nama_vendor          = $req->input('nama_vendor');
        $search_harga         = $req->input('harga');
        $search_basis_operasi = $req->input('basis_operasi');
        $search_kota_operasi  = $req->input('kota_operasi');
        $search_jenis_vendor  = $req->input('search_jenis_vendor');
        $sort_by              = $req->input('sort_by', '');
        $sort_as              = $req->input('sort_as', 'asc');

        $vendorsQuery = WVendor::whereHas('jenis')
                        ->orderBy('nama', 'asc')
                        ->with(['plan' => function ($query) {
                            $query->select('id', 'w_vendor_id', 'harga');
                        }]);

        if ($nama_vendor) {
            $vendorsQuery->where('nama', 'like', "%$nama_vendor%");
        }
        if ($search_basis_operasi) {
            $vendorsQuery->where('basis_operasi', 'like', "%$search_basis_operasi%");
        }
        if ($search_kota_operasi) {
            $vendorsQuery->where('kota_operasi', 'like', "%$search_kota_operasi%");
        }

        $vendors = $vendorsQuery->get();

        foreach ($vendors as $vendor) {
            $plans = $vendor->plan;

            $vendor->harga_terendah = $plans->isNotEmpty() ? NumberFormatter::format($plans->min('harga')) : 0;
            $vendor->harga_tertinggi = $plans->isNotEmpty() ? NumberFormatter::format($plans->max('harga')) : 0;

            $bookings = WVBooking::whereIn('w_v_plan_id', $plans->pluck('id'))
                                ->where('status', 'selesai')
                                ->get();

            if ($bookings->isNotEmpty()) {
                $vendor->rate = WVRating::whereIn('w_v_booking_id', $bookings->pluck('id'))->avg('rating');
                $vendor->bookedCount = BookingFormatter::format($bookings->count());
            } else {
                $vendor->rate = 0;
                $vendor->bookedCount = 0;
            }
        }

        $filteredVendors = $vendors->filter(function($vendor) use ($search_harga, $search_jenis_vendor) {
            if ($search_harga !== null) {
                if ($vendor->harga_terendah <= 0 || $vendor->harga_terendah > $search_harga) {
                    return false;
                }
            }

            if ($search_jenis_vendor !== null) {
                $jenisIds = $vendor->jenis->pluck('m_jenis_vendor_id')->toArray();
                if (!in_array($search_jenis_vendor, $jenisIds)) {
                    return false;
                }
            }

            return true;
        });

        if ($sort_by) {
            if ($sort_as == 'asc') {
                $filteredVendors = $filteredVendors->sortBy($sort_by);
            } else {
                $filteredVendors = $filteredVendors->sortByDesc($sort_by);
            }
        }

        $m_j_vendor = MJenisVendor::all();

        return view('user.search.vendor', compact(
            'filteredVendors',
            'nama_vendor',
            'search_harga',
            'search_basis_operasi',
            'search_kota_operasi',
            'search_jenis_vendor',
            'sort_by',
            'sort_as',
            'm_j_vendor'
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

        $j_vendor = WVJenis::where('w_vendor_id', $vendor->id)->get();

        $filterJenisVendor = $req->jenis_vendor;

        if ($tab == 'portofolio') {
            $portofoliosQuery = WVPortofolio::where('w_vendor_id', $vendor->id)
                            ->where('status', 'diterima')
                            ->orderBy('tanggal', 'asc')
                            ->orderBy('judul', 'asc');

            if ($filterJenisVendor) {
                $portofoliosQuery->where('m_jenis_vendor_id', $filterJenisVendor);
            }

            $portofolios = $portofoliosQuery->get();

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
                'j_vendor',
                'filterJenisVendor',
                'portofolios',
                'portofolio_detail',
                'tab',
            ));
        } elseif ($tab == 'layanan') {
            if ($filterJenisVendor) {
                $plans = $plans->filter(function ($plan) use ($filterJenisVendor) {
                    return $plan->m_jenis_vendor_id == $filterJenisVendor;
                });
            }

            return view('user.search.detail.' . $tab, compact(
                'vendor',
                'j_vendor',
                'filterJenisVendor',
                'plans',
                'tab',
            ));
        } else {
            $id_layanan = $req->input('id_layanan');

            $plan = $plans->where('id', $id_layanan)->first();

            if (!$plan) {
                return back()->with('gagal', 'ID Layanan tidak valid');
            }

            $today = Carbon::today()->startOfDay();
            $weddings = WCWedding::where('w_couple_id', auth()->user()->w_couple->id)
                ->with(['w_detail' => function($query) use ($today) {
                    $query->whereDate('waktu', '>', $today);
                }])
                ->whereHas('w_detail', function ($query) use ($today) {
                    $query
                        // ->whereRaw('waktu = (
                        //     SELECT MIN(wd.waktu)
                        //     FROM w_c_wedding_details wd
                        //     WHERE wd.w_c_wedding_id = w_c_weddings.id
                        // )')
                        ->whereDate('waktu', '>', $today);
                })
                ->orderBy('p_lengkap', 'asc')
                ->get();

            $filterJenisVendor = $plan->m_jenis_vendor_id;

            return view('user.search.detail.' . $tab, compact(
                'vendor',
                'plan',
                'weddings',
                'tab',
                'filterJenisVendor',
            ));
        }
    }

    public function pesan(Request $req) {
        $req->validate([
            'plan_id'    => 'required',
            'wedding_id' => 'required',
            'tanggal'    => 'required|date|after:' . date('Y-m-d'),
            'qty'        => 'required|numeric|min:1',
            'catatan'    => 'nullable|string',
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
        $booking->catatan        = $req->catatan;
        $data = $booking->save();

        if ($data) {
            return redirect()->route('user.pernikahan.ke_detail', $booking->w_c_wedding_id)->with('sukses', 'Memesan Vendor');
        }
        return back()->with('gagal', 'Memesan Vendor');
    }

    public function daftar() {
        $user = auth()->user();
        $w_couple = $user->w_couple;

        $idWeddings = WCWedding::where('w_couple_id', $w_couple->id)->withTrashed()->pluck('id');
        $bookings = WVBooking::with(['plan' => function ($query) {
                $query->withTrashed();
            }, 'wedding' => function ($query) {
                $query->withTrashed();
            }])
            ->whereIn('w_c_wedding_id', $idWeddings)->get();

        return view('user.pesanan.index', compact('bookings'));
    }
}
