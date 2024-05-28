<?php

namespace App\Http\Controllers\WeddingCouple;

use App\Http\Controllers\Controller;
use App\Models\WCWedding;
use App\Models\WVBooking;
use App\Models\WVendor;
use App\Models\WVPlan;
use App\Models\WVPortofolio;
use Illuminate\Http\Request;

class WPBookingController extends Controller
{
    public function index(Request $req) {
        $photographers = WVendor::where('jenis', 'photographer')
                    ->orderBy('nama', 'asc')
                    ->get();

        foreach ($photographers as $photographer) {
            $plans = WVPlan::where('w_vendor_id', $photographer->id)->get();

            $photographer->harga_terendah = null;
            $photographer->harga_tertinggi = null;

            foreach ($plans as $plan) {
                if ($photographer->harga_terendah === null || $plan->harga < $photographer->harga_terendah) {
                    $photographer->harga_terendah = $plan->harga;
                }

                if ($photographer->harga_tertinggi === null || $plan->harga > $photographer->harga_tertinggi) {
                    $photographer->harga_tertinggi = $plan->harga;
                }
            }
        }

        $search_harga = null;
        if ($req->has('harga') && $req->harga !== null) {
            $search_harga = $req->harga;
        }

        $search_basis_operasi = null;
        if ($req->has('basis_operasi') && $req->basis_operasi !== null) {
            $search_basis_operasi = $req->basis_operasi;
        }

        $search_kota_operasi = null;
        if ($req->has('kota_operasi') && $req->kota_operasi !== null) {
            $search_kota_operasi = $req->kota_operasi;
        }

        $filteredPhotographers = [];
        foreach ($photographers as $photographer) {

            // Filter berdasarkan harga
            if ($search_harga !== null) {
                if ($photographer->harga_terendah > $search_harga) {
                    continue;
                }
            }

            // Filter berdasarkan basis_operasi
            if ($search_basis_operasi !== null) {
                if (strpos(strtolower($photographer->basis_operasi), strtolower($search_basis_operasi)) === false) {
                    continue;
                }
            }

            // Filter berdasarkan kota_operasi
            if ($search_kota_operasi !== null) {
                if (strpos(strtolower($photographer->kota_operasi), strtolower($search_kota_operasi)) === false) {
                    continue;
                }
            }

            $filteredPhotographers[] = $photographer;
        }

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

        $portofolios = WVPortofolio::where('w_vendor_id', $photographer->id)
                        ->where('status', 'diterima')
                        ->orderBy('tanggal', 'asc')
                        ->orderBy('judul', 'asc')
                        ->get();
        $plans = WVPlan::where('w_vendor_id', $photographer->id)
                        ->orderBy('harga', 'asc')
                        ->get();

        $weddings = WCWedding::where('w_couple_id', auth()->user()->w_couple->id)
            ->orderBy('p_sapaan', 'asc')
            ->get();
        $plan_ids = $plans->pluck('id');
        $booked_wedding_ids = WVBooking::whereIn('w_v_plan_id', $plan_ids)->pluck('w_c_wedding_id');
        $weddings = $weddings->whereNotIn('id', $booked_wedding_ids);

        $portofolio_detail = null;

        if (!$portofolios->isEmpty()) {
            $portofolio_detail = $portofolios->first();
        }

        if ($req->has('portofolio_id')) {
            $portofolio_detail = WVPortofolio::where('id', $req->portofolio_id)->first();
        }

        return view('user.wedding-couple.booking.wp.detail', compact(
            'photographer',
            'portofolios',
            'plans',
            'weddings',
            'portofolio_detail',
        ));
    }

    public function pesan(Request $req) {
        $req->validate([
            'plan_id'    => 'required',
            'wedding_id' => 'required',
            'tanggal'    => 'required|date|after:' . date('Y-m-d'),
        ],[
            'plan_id.required'    => 'Paket Layanan tidak boleh kosong',
            'wedding_id.required' => 'Pernikahan tidak boleh kosong',
            'tanggal.required'    => 'Tanggal Pernikahan tidak boleh kosong',
            'tanggal.date'        => 'Tanggal Pernikahan herus menggunakan format tanggal yang benar',
            'tanggal.after'       => 'Tanggal Pernikahan harus setelah tanggal hari ini',
        ]);

        $plan = WVPlan::find($req->plan_id);

        $booking = new WVBooking();
        $booking->w_c_wedding_id = $req->wedding_id;
        $booking->w_v_plan_id    = $req->plan_id;
        $booking->untuk_tanggal  = $req->tanggal;
        $booking->qty            = 1;
        $booking->total_bayar    = $plan->harga * 1;
        $data = $booking->save();

        if ($data) {
            return redirect()->route('wedding-couple.pernikahan.ke_detail', $req->wedding_id)->with('sukses', 'Memesan Fotografer');
        }
        return redirect()->route('wedding-couple.pernikahan.ke_detail', $req->wedding_id)->with('gagal', 'Memesan Fotografer');
    }
}
