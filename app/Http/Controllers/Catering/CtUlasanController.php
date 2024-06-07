<?php

namespace App\Http\Controllers\Catering;

use App\Http\Controllers\Controller;
use App\Models\WVBooking;
use App\Models\WVRating;
use Illuminate\Http\Request;

class CtUlasanController extends Controller
{
    public function index() {
        $plans_id = auth()->user()->w_vendor->plan->pluck('id');
        $bookings_id = WVBooking::whereIn('w_v_plan_id', $plans_id)->pluck('id');
        $reviews = WVRating::whereIn('w_v_booking_id', $bookings_id)
                        ->orderBy('updated_at', 'desc')
                        ->get();

        $reviewsCount = $reviews->count();
        $averageRating = $reviews->avg('rating');

        $lowestRateReview = $reviews->sortBy('rating')->first();
        $lowestRate = $lowestRateReview ? ['id' => $lowestRateReview->w_booking->id, 'rate' => $lowestRateReview->rating] : null;

        $highestRateReview = $reviews->sortByDesc('rating')->first();
        $highestRate = $highestRateReview ? ['id' => $highestRateReview->w_booking->id, 'rate' => $highestRateReview->rating] : null;

        return view('user.catering.ulasan.index',
                compact(
                    'reviews',
                    'reviewsCount',
                    'averageRating',
                    'lowestRate',
                    'highestRate'
                )
        );
    }
}
