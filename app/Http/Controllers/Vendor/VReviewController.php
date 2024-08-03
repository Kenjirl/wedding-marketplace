<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\WVBooking;
use App\Models\WVJenis;
use App\Models\WVRating;
use Illuminate\Http\Request;

class VReviewController extends Controller
{
    public function index(Request $req) {
        $jenis_id    = $req->query('jenis_id');
        $tab         = $req->query('tab', 'list');
        $search_rate = $req->query('search_rate', null);

        $allowedTabs = ['list', 'table'];
        if (!in_array($tab, $allowedTabs)) {
            $tab = 'list';
        }

        $allowedRate = [1, 2, 3, 4, 5];
        if (!in_array($search_rate, $allowedRate)) {
            $search_rate = null;
        }

        $vendorId = auth()->user()->w_vendor->id;

        $j_vendor = WVJenis::where('w_vendor_id', $vendorId)
                            ->with(['master'])
                            ->withTrashed()
                            ->get();

        $validJenisIds = $j_vendor->pluck('m_jenis_vendor_id')->toArray();

        if ($jenis_id && !in_array($jenis_id, $validJenisIds)) {
            $jenis_id = null;
        }

        $reviews = WVRating::where('w_vendor_id', $vendorId)
                ->with(['plan' => function ($query) {
                    $query->withTrashed();
                }])
                ->orderBy('updated_at', 'desc')
                ->get();

        $reviewsCount = $reviews->count();
        $averageRating = $reviewsCount > 0 ? $reviews->avg('rating') : 0;

        $ratings = [5, 4, 3, 2, 1];
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

        if ($jenis_id) {
            $reviews = $reviews->filter(function ($review) use ($jenis_id) {
                return $review->plan->m_jenis_vendor_id == $jenis_id;
            });
        }

        if ($search_rate) {
            $reviews = $reviews->filter(function ($review) use ($search_rate) {
                return $review->rating == $search_rate;
            });
        }

        return view('vendor.ulasan.index', compact(
            'jenis_id', 'tab', 'search_rate',
            'j_vendor', 'reviews', 'total', 'ratingDetails'
        ));
    }
}
