<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\MJenisVendor;
use Illuminate\Http\Request;

class UController extends Controller
{
    public function index() {
        if (!auth()->user()->w_couple) {
            return redirect()->route('user.profil.ke_ubah');
        }

        $j_vendor = MJenisVendor::all();

        return view('user.index', compact('j_vendor'));
    }
}
