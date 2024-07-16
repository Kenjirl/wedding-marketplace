<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\WCGuest;
use App\Models\WCInvitation;
use App\Models\WCWedding;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class UInvitationController extends Controller
{
    public function ke_tambah(Request $req) {
        $wedding = WCWedding::with('w_detail')->find($req->id);

        $folders = [
            'header',
            'quote',
            'profile',
            'event',
            'gallery',
            'wish',
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
        $req->validate([
            't_header'  => 'required',
            't_quote'   => 'required',
            't_profile' => 'required',
            't_event'   => 'required',
            't_gallery' => 'required',
            't_wish'    => 'required',
            't_footer'  => 'required',
        ]);

        $wedding = WCWedding::find($req->wedding_id);
        if (!$wedding) {
            return redirect()->route('user.pernikahan.index')->with('gagal', 'ID tidak valid');
        }

        $data = [
            't_header'  => $req->t_header,
            't_quote'   => $req->t_quote,
            't_profile' => $req->t_profile,
            't_event'   => $req->t_event,
            't_gallery' => $req->t_gallery,
            't_wish'    => $req->t_wish,
            't_footer'  => $req->t_footer,
            'c_header'  => [
                'div'   => $req->header_div_col,
                'sdiv'  => $req->header_sdiv_col,
                'stext' => $req->header_stext_col,
                'text'  => $req->header_text_col,
            ],
            'c_quote'   => [
                'div'   => $req->quote_div_col,
                'sdiv'  => $req->quote_sdiv_col,
                'stext' => $req->quote_stext_col,
                'text'  => $req->quote_text_col,
            ],
            'c_profile' => [
                'div'   => $req->profile_div_col,
                'sdiv'  => $req->profile_sdiv_col,
                'stext' => $req->profile_stext_col,
                'text'  => $req->profile_text_col,
            ],
            'c_event'   => [
                'div'   => $req->event_div_col,
                'sdiv'  => $req->event_sdiv_col,
                'stext' => $req->event_stext_col,
                'text'  => $req->event_text_col,
            ],
            'c_gallery' => [
                'div'   => $req->gallery_div_col,
                'sdiv'  => $req->gallery_sdiv_col,
                'stext' => $req->gallery_stext_col,
                'text'  => $req->gallery_text_col,
            ],
            'c_wish'    => [
                'div'   => $req->wish_div_col,
                'sdiv'  => $req->wish_sdiv_col,
                'stext' => $req->wish_stext_col,
                'text'  => $req->wish_text_col,
            ],
            'c_footer'  => [
                'div'   => $req->footer_div_col,
                'sdiv'  => $req->footer_sdiv_col,
                'stext' => $req->footer_stext_col,
                'text'  => $req->footer_text_col,
            ],
        ];

        $invitation = $wedding->invitation()->create($data);

        if ($invitation) {
            return redirect()->route('user.pernikahan.ke_detail', $wedding->id)->with('sukses', 'Membuat Undangan Digital');
        }

        return redirect()->route('user.pernikahan.ke_detail', $wedding->id)->with('gagal', 'Membuat Undangan Digital');
    }

    public function ubah(Request $req, $id) {
        $req->validate([
            'quote'         => 'nullable|string|max:255',
            'author'        => 'nullable|string|max:50',
            'foto_galeri'   => 'nullable|array|min:6|max:6',
            'foto_galeri.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'foto_profil'   => 'required|array|min:2|max:2',
            'foto_profil.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'quote.max'            => 'Kutipan maksimal 255 karakter.',
            'author.max'           => 'Asal kutipan maksimal 50 karakter.',
            'foto_galeri.min'      => 'Harus menyertakan minimal 6 foto.',
            'foto_galeri.max'      => 'Hanya boleh menyertakan maksimal 6 foto.',
            'foto_galeri.*.image'  => 'Semua file harus berupa gambar.',
            'foto_galeri.*.mimes'  => 'Gambar harus berupa file berformat: jpeg, png, jpg, gif.',
            'foto_galeri.*.max'    => 'Gambar maksimal berukuran 2MB.',
            'foto_profil.required' => 'Harus menyertakan 2 foto profil.',
            'foto_profil.min'      => 'Harus menyertakan minimal 2 foto profil.',
            'foto_profil.max'      => 'Hanya boleh menyertakan maksimal 2 foto profil.',
            'foto_profil.*.image'  => 'Semua file harus berupa gambar.',
            'foto_profil.*.mimes'  => 'Gambar harus berupa file berformat: jpeg, png, jpg, gif.',
            'foto_profil.*.max'    => 'Gambar maksimal berukuran 2MB.',
        ]);

        $invitation = WCInvitation::findOrFail($id);
        if (!$invitation) {
            return back()->with('gagal', 'ID tidak valid');
        }

        if ($invitation->t_quote != '0') {
            $c_quote = $invitation->c_quote;
            $c_quote['quote'] = $req->quote;
            $c_quote['author'] = $req->author;
            $invitation->c_quote = $c_quote;
        }

        if ($invitation->t_gallery != '0' && $req->hasFile('foto_galeri')) {
            $new_photos = [];
            foreach ($req->file('foto_galeri') as $file) {
                $filename = 'u/undangan/galeri/' . str()->uuid() . '.' . $file->extension();
                $url = Storage::disk('public')->putFileAs('/', $file, $filename);
                $new_photos[] = $url;
            }

            $c_gallery = $invitation->c_gallery;
            $c_gallery['photos'] = $new_photos;
            $invitation->c_gallery = $c_gallery;
        }

        if ($req->hasFile('foto_profil')) {
            $new_profil_photos = [];
            foreach ($req->file('foto_profil') as $file) {
                $filename = 'u/undangan/profil/' . str()->uuid() . '.' . $file->extension();
                $url = Storage::disk('public')->putFileAs('/', $file, $filename);
                $new_profil_photos[] = $url;
            }

            $c_profile = $invitation->c_profile;
            $c_profile['foto_pria'] = $new_profil_photos[0];
            $c_profile['foto_wanita'] = $new_profil_photos[1];
            $invitation->c_profile = $c_profile;
        }

        $invitation->status = 'selesai';

        $data = $invitation->save();

        if ($data) {
            return back()->with('sukses', 'Menyelesaikan Undangan Digital');
        }
        return back()->with('gagal', 'Menyelesaikan Undangan Digital');
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
