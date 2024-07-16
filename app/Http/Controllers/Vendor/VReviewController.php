<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\WVBooking;
use App\Models\WVRating;
use Illuminate\Http\Request;

class VReviewController extends Controller
{
    public function index() {
        $plans_id = auth()->user()->w_vendor->plan->pluck('id');
        $bookings_id = WVBooking::whereIn('w_v_plan_id', $plans_id)->pluck('id');
        $reviews = WVRating::whereIn('w_v_booking_id', $bookings_id)
                        ->orderBy('updated_at', 'desc')
                        ->get();

        $reviewsCount = $reviews->count();
        $averageRating = $reviewsCount > 0 ? $reviews->avg('rating') : 0;

        $ratings = [5,4,3,2,1];
        $ratingDetails = [];
        foreach ($ratings as $rating) {
            $filteredReviews = $reviews->where('rating', $rating);
            $count = $filteredReviews->count();
            $ratingDetails[$rating] = [
                'count' => $count
            ];
        }

        $total = [
            'count' => $reviewsCount,
            'average' => $averageRating
        ];

        return view('vendor.ulasan.index', compact('reviews', 'total', 'ratingDetails'));
    }
}
