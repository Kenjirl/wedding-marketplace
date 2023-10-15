<?php

namespace App\Http\Controllers\WeddingCouple;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WCController extends Controller
{
    public function index() {
        return view('user.wedding-couple.index');
    }
}
