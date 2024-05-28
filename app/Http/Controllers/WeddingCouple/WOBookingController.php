<?php

namespace App\Http\Controllers\WeddingCouple;

use App\Http\Controllers\Controller;
use App\Models\WCWedding;
use App\Models\WVBooking;
use App\Models\WVendor;
use App\Models\WVPlan;
use App\Models\WVPortofolio;
use Illuminate\Http\Request;

class WOBookingController extends Controller
{
    public function index(Request $req) {
        $organizers = WVendor::where('jenis', 'wedding-organizer')
                    ->orderBy('nama', 'asc')
                    ->get();

        foreach ($organizers as $organizer) {
            $plans = WVPlan::where('w_vendor_id', $organizer->id)->get();

            $organizer->harga_terendah = null;
            $organizer->harga_tertinggi = null;

            foreach ($plans as $plan) {
                if ($organizer->harga_terendah === null || $plan->harga < $organizer->harga_terendah) {
                    $organizer->harga_terendah = $plan->harga;
                }

                if ($organizer->harga_tertinggi === null || $plan->harga > $organizer->harga_tertinggi) {
                    $organizer->harga_tertinggi = $plan->harga;
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

        $filteredOrganizers = [];
        foreach ($organizers as $organizer) {
            // Filter berdasarkan harga
            if ($search_harga !== null) {
                if ($organizer->harga_terendah > $search_harga) {
                    continue;
                }
            }

            // Filter berdasarkan basis_operasi
            if ($search_basis_operasi !== null) {
                if (strpos(strtolower($organizer->basis_operasi), strtolower($search_basis_operasi)) === false) {
                    continue;
                }
            }

            // Filter berdasarkan kota_operasi
            if ($search_kota_operasi !== null) {
                if (strpos(strtolower($organizer->kota_operasi), strtolower($search_kota_operasi)) === false) {
                    continue;
                }
            }

            $filteredOrganizers[] = $organizer;
        }

        return view('user.wedding-couple.booking.wo.index', compact(
            'filteredOrganizers',
            'search_harga',
            'search_basis_operasi',
            'search_kota_operasi',
        ));
    }

    public function ke_detail(Request $req, $id) {
        $organizer = WVendor::find($id);

        if (!$organizer) {
            return back()->with('gagal', 'ID Invalid');
        }

        $portofolios = WVPortofolio::where('w_vendor_id', $organizer->id)
                        ->where('status', 'diterima')
                        ->orderBy('tanggal', 'asc')
                        ->orderBy('judul', 'asc')
                        ->get();
        $plans = WVPlan::where('w_vendor_id', $organizer->id)
                        ->orderBy('harga', 'asc')
                        ->get();

        $bookedWeddingIds = WVBooking::pluck('w_c_wedding_id');
        $weddings = WCWedding::where('w_couple_id', auth()->user()->w_couple->id)
            ->whereNotIn('id', $bookedWeddingIds)
            ->orderBy('p_lengkap', 'asc')
            ->get();

        $portofolio_detail = null;

        if (!$portofolios->isEmpty()) {
            $portofolio_detail = $portofolios->first();
        }

        if ($req->has('portofolio_id')) {
            $portofolio_detail = WVPortofolio::where('id', $req->portofolio_id)->first();
        }

        return view('user.wedding-couple.booking.wo.detail', compact(
            'organizer',
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
            return redirect()->route('wedding-couple.pernikahan.ke_detail', $req->wedding_id)->with('sukses', 'Memesan Wedding Organizer');
        }
        return redirect()->route('wedding-couple.pernikahan.ke_detail', $req->wedding_id)->with('gagal', 'Memesan Wedding Organizer');
    }
}
