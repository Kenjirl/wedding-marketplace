<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\WCGuest;
use App\Models\WCInvitation;
use App\Models\WCWedding;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class UInvitationController extends Controller
{
    public function ke_tambah(Request $req) {
        $wedding = WCWedding::with('w_detail')->find($req->id);

        $invitation = $wedding->invitation;
        if ($invitation) {
            return back()->with('gagal', 'Pernikahan ini sudah memiliki undangan digital');
        }

        $folders = [
            'header',
            'quote',
            'profile',
            'event',
            'gallery',
            'wish',
            'info',
            'footer',
        ];
        $f_counts = [];

        foreach ($folders as $folder) {
            $path = resource_path("views/user/undangan/template/$folder");
            if (File::exists($path)) {
                $files = File::files($path);
                $f_counts[$folder] = count($files);
            } else {
                $f_counts[$folder] = 0;
            }
        }

        return view('user.undangan.tambah', compact('wedding', 'f_counts'));
    }

    public function tambah(Request $req) {
        $wedding = WCWedding::find($req->wedding_id);
        if (!$wedding) {
            return redirect()->route('user.pernikahan.index')->with('gagal', 'ID tidak valid');
        }

        $data = [
            'header'  => [
                'template' => $req->t_header,
                'div'   => $req->header_div_col,
                'sdiv'  => $req->header_sdiv_col,
                'stext' => $req->header_stext_col,
                'text'  => $req->header_text_col,
            ],
            'quote'   => [
                'template' => $req->t_quote,
                'div'   => $req->quote_div_col,
                'sdiv'  => $req->quote_sdiv_col,
                'stext' => $req->quote_stext_col,
                'text'  => $req->quote_text_col,
            ],
            'profile' => [
                'template' => $req->t_profile,
                'div'   => $req->profile_div_col,
                'sdiv'  => $req->profile_sdiv_col,
                'stext' => $req->profile_stext_col,
                'text'  => $req->profile_text_col,
            ],
            'event'   => [
                'template' => $req->t_event,
                'div'   => $req->event_div_col,
                'sdiv'  => $req->event_sdiv_col,
                'stext' => $req->event_stext_col,
                'text'  => $req->event_text_col,
            ],
            'gallery' => [
                'template' => $req->t_gallery,
                'div'   => $req->gallery_div_col,
                'sdiv'  => $req->gallery_sdiv_col,
                'stext' => $req->gallery_stext_col,
                'text'  => $req->gallery_text_col,
            ],
            'wish'    => [
                'template' => $req->t_wish,
                'div'   => $req->wish_div_col,
                'sdiv'  => $req->wish_sdiv_col,
                'stext' => $req->wish_stext_col,
                'text'  => $req->wish_text_col,
            ],
            'info'    => [
                'template' => $req->t_info,
                'div'   => $req->info_div_col,
                'sdiv'  => $req->info_sdiv_col,
                'stext' => $req->info_stext_col,
                'text'  => $req->info_text_col,
            ],
            'footer'  => [
                'template' => $req->t_footer,
                'div'   => $req->footer_div_col,
                'sdiv'  => $req->footer_sdiv_col,
                'stext' => $req->footer_stext_col,
                'text'  => $req->footer_text_col,
            ],
            'status' => 'selesai',
        ];

        if ($req->t_quote != '0') {
            $data['quote']['quote'] = $req->quote_content;
            $data['quote']['author'] = $req->quote_author;
        }

        if ($req->t_gallery != '0' && $req->hasFile('foto_galeri')) {
            $new_photos = [];
            foreach ($req->file('foto_galeri') as $file) {
                $filename = 'u/undangan/galeri/' . str()->uuid() . '.' . $file->extension();
                $url = Storage::disk('public')->putFileAs('/', $file, $filename);
                $new_photos[] = $url;
            }
            $data['gallery']['photos'] = $new_photos;
        }

        if ($req->hasFile('foto_profil')) {
            $new_profil_photos = [];
            foreach ($req->file('foto_profil') as $file) {
                $filename = 'u/undangan/profil/' . str()->uuid() . '.' . $file->extension();
                $url = Storage::disk('public')->putFileAs('/', $file, $filename);
                $new_profil_photos[] = $url;
            }
            $data['profile']['foto_pria'] = $new_profil_photos[0];
            $data['profile']['foto_wanita'] = $new_profil_photos[1];
        }

        $invitation = $wedding->invitation()->create($data);

        if ($invitation) {
            return redirect()->route('user.pernikahan.ke_detail', $wedding->id)->with('sukses', 'Membuat Undangan Digital');
        }

        return redirect()->route('user.pernikahan.ke_detail', $wedding->id)->with('gagal', 'Membuat Undangan Digital');
    }

    public function cek($id) {
        $wedding = WCWedding::find($id)->with(['w_detail', 'invitation'])->first();

        if (!$wedding) {
            return back()->with('gagal', 'ID tidak valid');
        }

        if (is_null($wedding->invitation)) {
            return back()->with('gagal', 'Pernikahan belum memiliki undangan digital');
        }

        $buatTamu = collect([
            new WCGuest([
                'id' => 0,
                'w_c_wedding_id' => 0,
                'nama' => 'Cek Undangan',
                'no_telp' => '123123123123',
                'link' => null,
                'status' => 'Belum Terkirim',
                'respon' => 'Belum Menjawab',
                'jumlah' => 0,
                'pesan' => null,
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
            ]),
        ]);
        $tamu = $buatTamu->first();
        $tamu->id = 0;

        return view('user.undangan.cek', compact(
            'wedding',
            'tamu'
        ));
    }

    public function undangan($pengantin, $link) {
        $names = explode('-', $pengantin);
        if (count($names) !== 2) {
            return redirect('/')->with('gagal', 'Undangan tidak valid');
        }

        $p_sapaan = $names[0];
        $w_sapaan = $names[1];

        $rawTimestamp = substr($link, 0, 14);
        $timestamp = Carbon::createFromFormat('YmdHis', $rawTimestamp)->format('Y-m-d H:i:s');

        $id = (int)substr($link, 14);

        $tamu = WCGuest::where(
            [
                'created_at' => $timestamp,
                'id' => $id
            ])->first();

        if (!$tamu) {
            return redirect('/')->with('gagal', 'Undangan tidak valid');
        }

        $wedding = WCWedding::where([
            'p_sapaan' => $p_sapaan,
            'w_sapaan' => $w_sapaan,
            'id' => $tamu->w_c_wedding_id
        ])
        ->with(['w_detail', 'invitation', 'guests'])
        ->first();

        if (!$wedding) {
            return redirect('/')->with('gagal', 'Undangan tidak valid');
        }

        return view('user.undangan.index', compact(
            'wedding',
            'tamu',
        ));
    }
}
