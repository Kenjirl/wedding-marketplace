<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WeddingOrganizerController extends Controller
{
    public function index() {
        return view('user.wedding-organizer.index');
    }
}
