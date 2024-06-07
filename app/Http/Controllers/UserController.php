<?php

namespace App\Http\Controllers;

use App\Http\Requests\DaftarRequest;
use App\Http\Requests\MasukRequest;
use App\Http\Requests\UbahPasswordRequest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

class UserController extends Controller
{
    private $allowedRoles = [
        'admin'             => 'admin.index',
        'super-admin'       => 'super-admin.index',
        'wedding-couple'    => 'wedding-couple.index',
        'wedding-organizer' => 'wedding-organizer.index',
        'photographer'      => 'wedding-photographer.index',
        'catering'          => 'catering.index',
        'venue'             => 'venue.index',
    ];

    public function ke_masuk() {
        return view('masuk.index');
    }

    public function masuk(MasukRequest $req) {
        $req->validated();

        // Email belum terdaftar
        if(!$user = User::where(['email' => $req->email])->first()){
            return redirect()->route('ke_masuk')->with('gagal', 'Email anda belum terdaftar!');
        }

        // Email belum terverifikasi
        if($user->email_verified_at == null){
            return redirect()->route('ke_masuk')->with('gagal', 'Email anda belum terverifikasi');
        }

        $check = $req->only('email','password');

        // Set Remember Cookie jika user mencentang box
        $remember = $req->has('remember') ? true : false;

        // Sukses
        if(Auth::guard('web')->attempt($check,$remember)){
            $req->session()->regenerate();

            if (array_key_exists($user->role, $this->allowedRoles)) {
                return redirect()->route($this->allowedRoles[$user->role])->with('sukses', 'Selamat datang!');
            } else {
                return redirect()->route('ke_pilih_peran')->with('sukses', 'Selamat datang!');
            }
        }

        // Gagal
        return redirect()->route('ke_masuk')->with('gagal', 'Email atau Password tidak sesuai');
    }

    public function redirectToGoogle() {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback(Request $req) {
        try {
            $googleUser = Socialite::driver('google')->user();

            $user = User::where('email', $googleUser->getEmail())->first();

            if (!$user) {
                $user = new User();
                $user->name = $googleUser->getName();
                $user->email = $googleUser->getEmail();
                $user->email_verified_at = new Carbon();
                $user->password = Hash::make('Login_with_Google');
                $user->verification_code = sha1(time());
                $user->google_id = $googleUser->getId();
                $user->save();
            }

            Auth::login($user);
            $req->session()->regenerate();

            if (array_key_exists($user->role, $this->allowedRoles)) {
                return redirect()->route($this->allowedRoles[$user->role])->with('sukses', 'Selamat datang!');
            } else {
                return redirect()->route('ke_pilih_peran')->with('sukses', 'Selamat datang!');
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function keluar(Request $req) {
        Auth::logout();
        $req->session()->invalidate();
        $req->session()->regenerateToken();
        return redirect()->intended('/')->with('sukses', 'Anda telah keluar');
    }

    public function ke_daftar() {
        return view('daftar.index');
    }

    public function daftar(DaftarRequest $req) {
        $req->validated();

        $user = new User();
        $user->name = 'User-' . str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        $user->email = $req->email;
        $user->password = Hash::make($req->password);
        $user->verification_code = sha1(time());
        $data = $user->save();

        if($data){
            EmailController::verifikasi($user->email, $user->verification_code);
            return redirect()->route('ke_masuk')->with('sukses', 'Silahkan periksa pesan masuk atau spam di email Anda untuk konfirmasi pendaftaran.');
        }

        return redirect()->route('ke_masuk')->with('gagal', 'Maaf, telah terjadi kesalahan. Anda belum bisa mendaftar untuk saat ini.');
    }

    public function verifikasi(){
        // Mengambil kode verifikasi lewat route
        $verification_code = \Illuminate\Support\Facades\Request::get('code');

        $user = User::where(['verification_code' => $verification_code])->first();

        // Verifikasi Akun
        if($user){
            $user->email_verified_at = new Carbon();
            $user->save();
            return redirect()->route('ke_masuk')->with('sukses', 'Akun Anda telah diverifikasi');
        }

        // Gagal Verifikasi
        return redirect()->route('ke_masuk')->with('gagal', 'Kode verifikasi tidak valid!');
    }

    public function ke_lupa_password() {
        return view('masuk.lupa-password');
    }

    public function lupa_password(Request $req) {
        $req->validate([
            'email' => 'required|email',
        ],
        [
            'email.required' => 'Email tidak boleh kosong',
            'email.email'    => 'Email tidak valid',
        ]);

        // Email belum terdaftar
        if(!$user = User::where(['email' => $req->email])->first()){
            return redirect()->route('ke_lupa_password')->with('gagal', 'Email anda belum terdaftar');
        }

        // Email belum terverifikasi
        if($user->email_verified_at == null){
            return redirect()->route('ke_lupa_password')->with('gagal', 'Silahkan verifikasi akun anda terlebih dahulu');
        }

        // Buat kode verifikasi
        $user->verification_code = sha1(time());
        $data = $user->save();

        // Kirim email
        EmailController::reset($user->email, $user->verification_code);
        return redirect()->route('ke_masuk')->with('sukses', 'Silahkan cek pesan masuk atau spam untuk mengubah password anda');
    }

    public function ke_ubah_password() {
        // Mengambil kode verifikasi lewat route
        $verification_code = \Illuminate\Support\Facades\Request::get('code');

        $user = User::where(['verification_code' => $verification_code])->first();

        // Ganti Password
        if($user){
            $email = $user->email;
            return view('masuk.ubah-password', ['email'=>$email]);
        }

        // Gagal ganti Password
        return redirect()->route('ke_masuk')->with('gagal', 'Kode verifikasi tidak valid!');
    }

    public function ubah_password(UbahPasswordRequest $req) {
        $req->validated();

        $user = User::where(['email' => $req->email])->first();

        // Save Password baru
        if($user){
            $user->password = Hash::make($req->password);
            $user->save();
            return redirect()->route('ke_masuk')->with('sukses', 'Password anda berhasil diubah');
        }

        // Gagal save Password
        return redirect()->route('ke_masuk')->with('gagal', 'Maaf, telah terjadi kesalahan. Password Anda belum bisa diubah');
    }

    public function ke_pilih_peran() {
        $user = auth()->user();

        if (array_key_exists($user->role, $this->allowedRoles)) {
            return redirect()->route($this->allowedRoles[$user->role]);
        }

        return view('user.pilih-peran');
    }

    public function pilih_peran(Request $req) {
        $req->validate([
            'role' => 'required'
        ]);

        $user = User::find(auth()->user()->id);

        if (!$user) {
            return redirect()->route('ke_masuk')->with('gagal', 'Silahkan masuk terlebih dahulu');
        }

        if (array_key_exists($req->role, $this->allowedRoles)) {
            $user->role = $req->role;
            $user->save();

            return redirect()->route($this->allowedRoles[$req->role])->with('sukses', 'Silahkan lengkapi profil anda');
        }

        return view('user.pilih-peran');
    }

    public function undangan() {
        return view('invitation.index');
    }
}
