<?php

namespace App\Http\Controllers\Catering;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CtController extends Controller
{
    public function index() {
        return view('user.catering.index');
    }
}
