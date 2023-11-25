<?php

namespace App\Http\Controllers\WeddingOrganizer;

use App\Http\Controllers\Controller;
use App\Models\WOBooking;
use App\Models\WOrganizer;
use Illuminate\Http\Request;

class WOPesananController extends Controller
{
    public function index() {
        $bookings = WOBooking::join('w_o_plans', 'w_o_bookings.w_o_plan_id', '=', 'w_o_plans.id')
                ->join('w_organizers', 'w_o_plans.w_organizer_id', '=', 'w_organizers.id')
                ->where('w_organizers.id', auth()->user()->w_organizer->id)
                ->select('w_o_bookings.*')
                ->get();
        dd($bookings);
    }
}
