<?php

namespace App\Http\Controllers\WeddingCouple;

use App\Http\Controllers\Controller;
use App\Models\WCategories;
use App\Models\WCWedding;
use App\Models\WOBooking;
use App\Models\WOCategories;
use App\Models\WOPlan;
use App\Models\WOPortofolio;
use App\Models\WOrganizer;
use Illuminate\Http\Request;

class WOBookingController extends Controller
{
    public function index(Request $req) {
        $organizers = WOrganizer::orderBy('nama_perusahaan', 'asc')->get();

        foreach ($organizers as $organizer) {
            $plans = WOPlan::where('w_organizer_id', $organizer->id)->get();

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

        $search_kategori = null;
        if ($req->has('kategori') && $req->kategori !== null) {
            $search_kategori = $req->kategori;
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
            // Filter berdasarkan kategori
            if ($search_kategori !== null) {
                $kategoriMatch = false;

                foreach ($organizer->categories as $kategori) {
                    if ($kategori->id === (int)$search_kategori) {
                        $kategoriMatch = true;
                        break;
                    }
                }

                if (!$kategoriMatch) {
                    continue;
                }
            }

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

        $categories = WCategories::orderBy('nama', 'asc')->get();

        return view('user.wedding-couple.booking.wo.index', compact(
            'filteredOrganizers',
            'categories',
            'search_kategori',
            'search_harga',
            'search_basis_operasi',
            'search_kota_operasi',
        ));
    }

    public function ke_detail(Request $req, $id) {
        $organizer = WOrganizer::find($id);
        $categories = WOCategories::where('w_organizer_id', $organizer->id)
                        ->join('w_categories', 'w_o_categories.w_categories_id', '=', 'w_categories.id')
                        ->orderBy('w_categories.nama', 'asc')
                        ->get();
        $portofolios = WOPortofolio::where('w_organizer_id', $organizer->id)
                        ->where('status', 'diterima')
                        ->orderBy('tanggal', 'asc')
                        ->orderBy('judul', 'asc')
                        ->get();
        $plans = WOPlan::where('w_organizer_id', $organizer->id)
                        ->where('status', 'aktif')
                        ->orderBy('harga', 'asc')
                        ->get();

        $bookedWeddingIds = WOBooking::pluck('w_c_wedding_id');
        $weddings = WCWedding::where('w_couple_id', auth()->user()->w_couple->id)
            ->whereNotIn('id', $bookedWeddingIds)
            ->orderBy('groom', 'asc')
            ->get();

        $portofolio_detail = null;

        if (!$portofolios->isEmpty()) {
            $portofolio_detail = $portofolios->first();
        }

        if ($req->has('portofolio_id')) {
            $portofolio_detail = WOPortofolio::where('id', $req->portofolio_id)->first();
        }

        return view('user.wedding-couple.booking.wo.detail', compact(
            'organizer',
            'categories',
            'portofolios',
            'plans',
            'weddings',
            'portofolio_detail',
        ));
    }

    public function pesan(Request $req) {
        $req->validate([
            'plan_id' => 'required',
            'wedding_id' => 'required',
            'tanggal' => 'required',
        ],[
            'plan_id.required'    => 'Paket Layanan tidak boleh kosong',
            'wedding_id.required' => 'Pernikahan tidak boleh kosong',
            'tanggal.required'    => 'Tanggal Pernikahan tidak boleh kosong',
        ]);

        $booking = new WOBooking();
        $booking->w_c_wedding_id = $req->wedding_id;
        $booking->w_o_plan_id = $req->plan_id;
        $booking->bukti_bayar = '-';
        $booking->untuk_tanggal = $req->tanggal;
        $data = $booking->save();

        if ($data) {
            return redirect()->route('wedding-couple.pernikahan.index')->with('sukses', 'Memesan Wedding Organizer');
        }
        return redirect()->route('wedding-couple.pernikahan.index')->with('gagal', 'Memesan Wedding Organizer');
    }
}
