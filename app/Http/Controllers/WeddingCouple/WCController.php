<?php

namespace App\Http\Controllers\WeddingCouple;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Access\Gate;
use Illuminate\Http\Request;

class WCController extends Controller
{
    public function index() {
        if (!auth()->user()->w_couple) {
            return redirect()->route('wedding-couple.profil.ke_ubah');
        }
        return view('user.wedding-couple.index');
    }
}
