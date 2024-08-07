<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AConfiguration;
use App\Models\WVPortofolio;
use Illuminate\Http\Request;

class APortofolioController extends Controller
{
    public function index($tab) {
        $tabMap = [
            'diterima' => 'accept',
            'ditolak' => 'reject',
            'menunggu' => 'pending'
        ];

        $tab = $tabMap[$tab] ?? $tab;

        if (!in_array($tab, ['accept', 'reject', 'pending'])) {
            $tab = 'pending';
        }

        $statusMap = [
            'accept' => 'diterima',
            'reject' => 'ditolak',
            'pending' => 'menunggu konfirmasi'
        ];

        $status = $statusMap[$tab];

        $portofolio = WVPortofolio::where('status', $status)
            ->with('admin', function ($query) {
                $query->withTrashed();
            })
            ->orderBy('updated_at', 'asc')
            ->get();

        $config = AConfiguration::where('nama', 'portofolio-automation')->first();
        $vendorConfig = $config->value;

        return view('admin.portofolio.index', compact(
            'portofolio',
            'vendorConfig',
            'tab'
        ));
    }

    public function ke_validasi($id) {
        $portofolio = WVPortofolio::find($id);

        if (!$portofolio) {
            return back()->with('gagal', 'ID Invalid');
        }

        return view('admin.portofolio.validasi', compact(
            'portofolio',
        ));
    }

    public function validasi(Request $req, $id) {
        $req->validate([
            'status' => 'required'
        ]);

        $portofolio = WVPortofolio::findOrFail($id);

        $currentFoto = $portofolio->foto;
        foreach ($currentFoto as &$photo) {
            $photo['rejected'] = false;
        }
        unset($photo);

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
            return back()->with('sukses', 'Mengubah Validasi Portofolio');
        }
        return back()->with('gagal', 'Mengubah Validasi Portofolio');
    }

    public function config(Request $req) {
        $config = AConfiguration::where('nama', 'portofolio-automation')->first();
        $data = $config->update([
            'value' => (int)($req->config == 'on'),
            'admin_id' => ($req->config == 'on' ? auth()->user()->admin->id : null)
        ]);

        if ($data) {
            return back()->with('sukses', 'Mengubah Konfigurasi Portofolio');
        }
        return back()->with('gagal', 'Mengubah Konfigurasi Portofolio');
    }
}
