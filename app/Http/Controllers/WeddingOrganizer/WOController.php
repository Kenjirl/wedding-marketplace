<?php

namespace App\Http\Controllers\WeddingOrganizer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WOController extends Controller
{
    public function index() {
        return view('user.wedding-organizer.index');
    }
}
