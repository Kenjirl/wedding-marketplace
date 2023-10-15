<?php

namespace App\Http\Controllers\WeddingPhotographer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WPController extends Controller
{
    public function index() {
        return view('user.wedding-photographer.index');
    }
}
