<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Http\Requests\PortofolioRequest;
use App\Models\AConfiguration;
use App\Models\WVJenis;
use App\Models\WVPortofolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VPortfolioController extends Controller
{
    public function index(Request $req) {
        $jenis_id = $req->query('jenis_id');
        $vendorId = auth()->user()->w_vendor->id;

        $j_vendor = WVJenis::where('w_vendor_id', $vendorId)
                            ->with(['master'])
                            ->withTrashed()
                            ->get();

        $validJenisIds = $j_vendor->pluck('m_jenis_vendor_id')->toArray();

        if ($jenis_id && !in_array($jenis_id, $validJenisIds)) {
            $jenis_id = null;
        }

        $latest_portofolio = WVPortofolio::where('w_vendor_id', auth()->user()->w_vendor->id)
                        ->orderBy('updated_at', 'desc')
                        ->take(4)
                        ->get();

        $portofolioQuery = WVPortofolio::where('w_vendor_id', $vendorId)
                    ->orderBy('judul', 'asc');

        if ($jenis_id) {
            $portofolioQuery->where('m_jenis_vendor_id', $jenis_id);
        }

        $portofolio = $portofolioQuery->get();

        return view('vendor.portofolio.index', compact('jenis_id', 'j_vendor', 'latest_portofolio', 'portofolio'));
    }

    public function ke_tambah() {
        $j_vendors = WVJenis::where('w_vendor_id', auth()->user()->w_vendor->id)->get();

        return view('vendor.portofolio.tambah', compact('j_vendors'));
    }

    public function tambah(PortofolioRequest $req) {
        $req->validated();

        $config = AConfiguration::where('nama', 'portofolio-automation')->first();

        $koordinat = [
            'lat' => $req->lat,
            'lng' => $req->lng,
        ];

        $portofolio = new WVPortofolio();
        $portofolio->w_vendor_id        = auth()->user()->w_vendor->id;
        $portofolio->m_jenis_vendor_id  = $req->j_vendor;
        $portofolio->judul              = $req->judul;
        $portofolio->tanggal            = $req->tanggal;
        $portofolio->detail             = $req->detail;
        $portofolio->lokasi             = $req->lokasi;
        $portofolio->koordinat          = $koordinat;

        if ($config->value == true) {
            $portofolio->admin_id = $config->admin_id;
            $portofolio->status = 'diterima';
        }

        if ($req->hasFile('foto')) {
            $fotos = $req->file('foto');
            $arrFoto = $portofolio->foto ?? [];

            foreach ($fotos as $foto) {
                $filename = 'v/portofolio/' . str()->uuid() . '.' . $foto->extension();
                $url = Storage::disk('public')->putFileAs('/', $foto, $filename);

                $arrFoto[] = [
                    'url' => $url,
                    'rejected' => false,
                ];
            }
            $portofolio->foto = $arrFoto;
        }

        $data = $portofolio->save();

        if ($data) {
            return redirect()->route('vendor.portofolio.ke_ubah', $portofolio->id)->with('sukses', 'Menambah Portofolio');
        }
        return back()->with('gagal', 'Menambah Portofolio');
    }

    public function ke_ubah($id) {
        $portofolio = WVPortofolio::find($id);

        if (!$portofolio) {
            return back()->with('gagal', 'Portofolio tidak ditemukan');
        }

        $j_vendors = WVJenis::where('w_vendor_id', auth()->user()->w_vendor->id)->get();

        $currentPhotos = $portofolio->foto ?? [];
        $count = count($currentPhotos);

        return view('vendor.portofolio.ubah',
            compact(
                'portofolio',
                'j_vendors',
                'count'
            ));
    }

    public function ubah(PortofolioRequest $req, $id) {
        $req->validated();

        $portofolio = WVPortofolio::find($id);

        $config = AConfiguration::where('nama', 'portofolio-automation')->first();

        $currentPhotos = $portofolio->foto ?? [];
        $count = count($currentPhotos);
        if ($count > 5) {
            return redirect()->route('vendor.portofolio.ke_ubah', $id)->with('gagal', 'Maksimal 5 Gambar Saja');
        }

        $koordinat = [
            'lat' => $req->lat,
            'lng' => $req->lng,
        ];

        $portofolio->m_jenis_vendor_id  = $req->j_vendor;
        $portofolio->judul              = $req->judul;
        $portofolio->tanggal            = $req->tanggal;
        $portofolio->detail             = $req->detail;
        $portofolio->lokasi             = $req->lokasi;
        $portofolio->koordinat          = $koordinat;

        if ($config->value == true) {
            $portofolio->admin_id = $config->admin_id;
            $portofolio->status = 'diterima';
        } else {
            $portofolio->admin_id = null;
            $portofolio->status = 'menunggu konfirmasi';
        }

        if ($req->hasFile('foto')) {
            $fotos = $req->file('foto');
            $arrFoto = $portofolio->foto ?? [];

            foreach ($fotos as $foto) {
                $filename = 'v/portofolio/' . str()->uuid() . '.' . $foto->extension();
                $url = Storage::disk('public')->putFileAs('/', $foto, $filename);

                $arrFoto[] = [
                    'url' => $url,
                    'rejected' => false,
                ];
            }
            $portofolio->foto = $arrFoto;
        }
        $data = $portofolio->save();

        if ($data) {
            return back()->with('sukses', 'Mengubah Portofolio');
        }
        return back()->with('gagal', 'Mengubah Portofolio');
    }

    public function hapus($id) {
        $portofolio = WVPortofolio::findOrFail($id);

        $photos = $portofolio->foto;
        foreach ($photos as $photo) {
            unlink(public_path($photo['url']));
        }

        $data = $portofolio->delete();

        if ($data) {
            return redirect()->route('vendor.portofolio.index')->with('sukses', 'Menghapus Portofolio');
        } else {
            return redirect()->route('vendor.portofolio.index')->with('gagal', 'Gagal menghapus Portofolio');
        }
    }

    public function hapus_foto($id, $index) {
        $portofolio = WVPortofolio::findOrFail($id);

        if (isset($portofolio->foto[$index])) {
            $photo = $portofolio->foto[$index];
            $url = $photo['url'];

            $currentFoto = $portofolio->foto;
            unset($currentFoto[$index]);
            $currentFoto = array_values($currentFoto);

            $rejectedPhotosExist = false;
            foreach ($currentFoto as $foto) {
                if ($foto['rejected']) {
                    $rejectedPhotosExist = true;
                    break;
                }
            }

            if (!$rejectedPhotosExist) {
                $config = AConfiguration::where('nama', 'portofolio-automation')->first();

                if ($config->value == true) {
                    $portofolio->admin_id = $config->admin_id;
                    $portofolio->status = 'diterima';
                } else {
                    $portofolio->admin_id = null;
                    $portofolio->status = 'menunggu konfirmasi';
                }
            }

            $portofolio->foto = $currentFoto;
            $portofolio->save();

            unlink(public_path($url));
            return back()->with('sukses', 'Menghapus Foto Portofolio');
        }
        return back()->with('gagal', 'Menghapus Foto Portofolio');
    }
}
