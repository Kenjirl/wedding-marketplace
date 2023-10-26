<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SAController extends Controller
{
    public function index() {
        return view('user.super-admin.index');
    }
}
