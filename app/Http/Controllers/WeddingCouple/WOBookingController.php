<?php

namespace App\Http\Controllers\WeddingCouple;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WOBookingController extends Controller
{
    public function index() {
        return view('user.wedding-couple.booking.w-organizer.index');
    }
}
