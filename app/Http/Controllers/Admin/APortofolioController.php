<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AConfiguration;
use App\Models\WVPortofolio;
use Illuminate\Http\Request;

class APortofolioController extends Controller
{
    private $vendorTypes = ['wedding-organizer', 'photographer', 'catering', 'venue'];

    public function index($vendor, $tab) {
        if (!in_array($vendor, $this->vendorTypes)) {
            abort(404, 'Vendor type not found');
        }

        $tabMap = [
            'diterima' => 'accept',
            'ditolak' => 'reject',
            'menunggu' => 'pending'
        ];

        $tab = $tabMap[$tab] ?? $tab;

        if (!in_array($tab, ['accept', 'reject', 'pending'])) {
            return redirect()->route('admin.portofolio.index', ['vendor' => $vendor, 'tab' => 'pending']);
        }

        $statusMap = [
            'accept' => 'diterima',
            'reject' => 'ditolak',
            'pending' => 'menunggu konfirmasi'
        ];

        $status = $statusMap[$tab];

        $portofolio = WVPortofolio::where('status', $status)
            ->whereHas('w_vendor', function($query) use ($vendor) {
                $query->where('jenis', $vendor);
            })
            ->orderBy('updated_at', 'asc')
            ->get();

        $config = AConfiguration::where('nama', 'portofolio-automation')->first();
        $vendorConfig = null;

        if ($config && $config->value) {
            foreach ($config->value as $item) {
                if (isset($item['vendor']) && $item['vendor'] === $vendor) {
                    $vendorConfig = $item;
                    break;
                }
            }
        }

        return view("user.admin.portofolio.index", compact(
            'portofolio',
            'vendorConfig',
            'vendor',
            'tab'
        ));
    }

    public function ke_validasi($vendor, $id) {
        if (!in_array($vendor, $this->vendorTypes)) {
            abort(404, 'Vendor type not found');
        }

        $portofolio = WVPortofolio::find($id);

        if (!$portofolio) {
            return back()->with('gagal', 'ID Invalid');
        }

        return view("user.admin.portofolio.validasi", compact(
            'portofolio',
            'vendor',
        ));
    }

    public function validasi(Request $req, $vendor, $id) {
        if (!in_array($vendor, $this->vendorTypes)) {
            abort(404, 'Vendor type not found');
        }

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
            return redirect()->route('admin.portofolio.index', ['vendor' => $vendor, 'tab' => $req->status])->with('sukses', 'Mengubah Validasi Portofolio');
        }
        return redirect()->route('admin.portofolio.index', ['vendor' => $vendor, 'tab' => $req->status])->with('gagal', 'Mengubah Validasi Portofolio');
    }

    public function config(Request $req, $vendor) {
        if (!in_array($vendor, $this->vendorTypes)) {
            abort(404, 'Vendor type not found');
        }

        $config = AConfiguration::where('nama', 'portofolio-automation')->first();

        $value = $config->value ?: [];
        $vendorExists = false;

        foreach ($value as $key => $item) {
            if (isset($item['vendor']) && $item['vendor'] === $vendor) {
                $vendorExists = true;
                if ($req->config != 'on') {
                    unset($value[$key]);
                }
                break;
            }
        }

        if (!$vendorExists && $req->config == 'on') {
            $value[] = [
                'vendor' => $vendor,
                'admin_id' => auth()->user()->admin->id
            ];
        }

        $config->value = array_values($value);
        $data = $config->save();

        if ($data) {
            return redirect()->back()->with('sukses', "Mengubah Konfigurasi Portofolio");
        }
        return redirect()->back()->with('gagal', "Mengubah Konfigurasi Portofolio");
    }
}
