<?php

namespace App\Http\Controllers;

use App\Mail\UbahPasswordPengguna;
use App\Mail\VerifikasiPengguna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public static function verifikasi($email, $verification_code){
        $data = [
            'verification_code' => $verification_code,
        ];

        Mail::to($email)->send(new VerifikasiPengguna($data));
    }

    public static function reset($email, $verification_code){
        $data = [
            'verification_code' => $verification_code,
        ];

        Mail::to($email)->send(new UbahPasswordPengguna($data));
    }
}
