<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AConfiguration;
use App\Models\WVPortofolio;
use Illuminate\Http\Request;

class WPhotographerController extends Controller
{
    public function index($tab) {
        $tabMap = [
            'diterima' => 'accept',
            'ditolak' => 'reject',
            'menunggu' => 'pending'
        ];

        $tab = $tabMap[$tab] ?? $tab;

        if (!in_array($tab, ['accept', 'reject', 'pending'])) {
            return redirect()->route('admin.wp.portofolio.index', 'pending');
        }

        $statusMap = [
            'accept' => 'diterima',
            'reject' => 'ditolak',
            'pending' => 'menunggu konfirmasi'
        ];

        $status = $statusMap[$tab];

        $portofolio = WVPortofolio::where('status', $status)
                        ->whereHas('w_vendor', function($query) {
                            $query->where('jenis', 'photographer');
                        })
                        ->orderBy('updated_at', 'asc')
                        ->get();

        $wpConfig = null;
        $config = AConfiguration::where('nama', 'portofolio-automation')->first();
        if ($config->value) {
            foreach ($config->value as $item) {
                if (isset($item['vendor']) && $item['vendor'] === 'photographer') {
                    $wpConfig = $item;
                    break;
                }
            }
        }

        return view('user.admin.portofolio.w-photographer.index', compact(
            'portofolio',
            'wpConfig',
            'tab',
        ));
    }

    public function ke_validasi($id) {
        $portofolio = WVPortofolio::find($id);

        if (!$portofolio) {
            return back()->with('gagal', 'ID Invalid');
        }

        return view('user.admin.portofolio.w-photographer.validasi', compact('portofolio'));
    }

    public function validasi(Request $req, $id) {
        $req->validate([
            'status' => 'required'
        ]);

        $portofolio = WVPortofolio::findOrFail($id);

        // Set all 'rejected' statuses to false by default
        $currentFoto = $portofolio->foto;
        foreach ($currentFoto as &$photo) {
            $photo['rejected'] = false;
        }
        unset($photo);

        // If 'status' is 'ditolak', update 'rejected' statuses based on input
        if ($req->status === 'ditolak') {
            $rejectedPhotoIds = $req->input('rejected', []);
            foreach ($rejectedPhotoIds as $index) {
                if (isset($currentFoto[$index])) {
                    $currentFoto[$index]['rejected'] = true;
                }
            }
        }
        $portofolio->admin_id = auth()->user()->admin->id;
        $portofolio->status = $req->status;
        $portofolio->foto = $currentFoto;
        $data = $portofolio->save();

        if ($data) {
            return redirect()->route('admin.wp.portofolio.index', $req->status)->with('sukses', 'Mengubah Validasi Portofolio');
        }
        return redirect()->route('admin.wp.portofolio.index', $req->status)->with('gagal', 'Mengubah Validasi Portofolio');
    }

    public function config(Request $req) {
        $config = AConfiguration::where('nama', 'portofolio-automation')->first();

        $value = $config->value ?: [];
        $vendorExists = false;

        foreach ($value as $key => $item) {
            if (isset($item['vendor']) && $item['vendor'] === 'photographer') {
                $vendorExists = true;
                if ($req->config != 'on') {
                    unset($value[$key]);
                }
                break;
            }
        }

        if (!$vendorExists && $req->config == 'on') {
            $value[] = [
                'vendor' => 'photographer',
                'admin_id' => auth()->user()->admin->id
            ];
        }

        $config->value = array_values($value);
        $data = $config->save();

        if ($data) {
            return redirect()->back()->with('sukses', 'Mengubah Konfigurasi Portofolio Organizer');
        }
        return redirect()->back()->with('gagal', 'Mengubah Konfigurasi Portofolio Organizer');
    }
}
