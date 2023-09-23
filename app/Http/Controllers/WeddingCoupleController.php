<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WeddingCoupleController extends Controller
{
    public function index() {
        return view('user.wedding-couple.index');
    }
}
