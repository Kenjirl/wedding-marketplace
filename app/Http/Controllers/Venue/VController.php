<?php

namespace App\Http\Controllers\Venue;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VController extends Controller
{
    public function index() {
        return view('user.venue.index');
    }
}
