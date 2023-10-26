<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AController extends Controller
{
    public function index() {
        return view('user.admin.index');
    }
}
