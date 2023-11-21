<?php

namespace App\Http\Controllers\WeddingCouple;

use App\Http\Controllers\Controller;
use App\Http\Requests\WeddingCouple\WeddingRequest;
use App\Models\WCWedding;
use App\Models\WOBooking;
use App\Models\WPBooking;
use Illuminate\Http\Request;

class WCWeddingController extends Controller
{
    public function index() {
        $weddings = WCWedding::where('w_couple_id', auth()->user()->w_couple->id)
                    ->orderBy('created_at', 'asc')
                    ->orderBy('groom', 'asc')
                    ->get();

        return view('user.wedding-couple.wedding.index', compact('weddings'));
    }

    public function ke_tambah() {
        return view('user.wedding-couple.wedding.tambah');
    }

    public function tambah(WeddingRequest $req) {
        $req->validated();

        $lokasi_pemberkatan = $req->alamat_pemberkatan . ', ' . $req->kelurahan_pemberkatan . ', ' . $req->kecamatan_pemberkatan . ', ' . $req->kota_pemberkatan . ', ' . $req->provinsi_pemberkatan;
        $lokasi_perayaan = $req->alamat_perayaan . ', ' . $req->kelurahan_perayaan . ', ' . $req->kecamatan_perayaan . ', ' . $req->kota_perayaan . ', ' . $req->provinsi_perayaan;

        $wedding = new WCWedding();
        $wedding->w_couple_id = auth()->user()->w_couple->id;
        $wedding->groom = $req->groom;
        $wedding->bride = $req->bride;
        $wedding->waktu_pemberkatan = $req->waktu_pemberkatan;
        $wedding->waktu_perayaan = $req->waktu_perayaan;
        $wedding->lokasi_pemberkatan = $lokasi_pemberkatan;
        $wedding->lokasi_perayaan = $lokasi_perayaan;
        $data = $wedding->save();

        if ($data) {
            return redirect()->route('wedding-couple.pernikahan.ke_detail', $wedding->id)->with('sukses', 'Membuat Pernikahan');
        }
        return redirect()->route('wedding-couple.pernikahan.ke_detail', $wedding->id)->with('gagal', 'Membuat Pernikahan');
    }

    public function ke_detail($id) {
        $wedding             = WCWedding::find($id);
        $bookedOrganizer     = WOBooking::where('w_c_wedding_id', $id)->first();
        $bookedPhotographers = WPBooking::where('w_p_bookings.w_c_wedding_id', $id)
                ->join('w_p_plans', 'w_p_bookings.w_p_plan_id', '=', 'w_p_plans.id')
                ->join('w_photographers', 'w_p_plans.w_photographer_id', '=', 'w_photographers.id')
                ->orderBy('w_photographers.nama', 'asc')
                ->select('w_p_bookings.*')
                ->get();

        return view('user.wedding-couple.wedding.detail', compact(
            'wedding',
            'bookedOrganizer',
            'bookedPhotographers'
        ));
    }

    public function hapus_wo($id) {
        $booking = WOBooking::find($id);
        $data = $booking->delete();
        if ($data) {
            return redirect()->back()->with('sukses', 'Menghapus Pesanan Wedding Organizer');
        }
        return redirect()->back()->with('gagal', 'Menghapus Pesanan Wedding Organizer');
    }

    public function hapus_wp($id) {
        $booking = WPBooking::find($id);
        $data = $booking->delete();
        if ($data) {
            return redirect()->back()->with('sukses', 'Menghapus Pesanan Wedding Photographer');
        }
        return redirect()->back()->with('gagal', 'Menghapus Pesanan Wedding Photographer');
    }
}
