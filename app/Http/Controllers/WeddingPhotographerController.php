<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WeddingPhotographerController extends Controller
{
    public function index() {
        return view('user.wedding-photographer.index');
    }
}
