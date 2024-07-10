<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\WVPortofolio;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AController extends Controller
{
    public function index() {
        $currentYear = Carbon::now()->year;

        $users = User::whereYear('created_at', $currentYear)
                    ->where('role', 'user')
                    ->get();

        $monthlyUserRegistrations = $users->groupBy(function($date) {
            return Carbon::parse($date->created_at)->format('m');
        })->map(function($row) {
            return count($row);
        });

        $userRegistrationsPerMonth = array_fill(1, 12, 0);
        foreach ($monthlyUserRegistrations as $month => $count) {
            $userRegistrationsPerMonth[(int)$month] = $count;
        }

        $vendors = User::whereYear('created_at', $currentYear)
                    ->where('role', 'vendor')
                    ->get();

        $monthlyVendorRegistrations = $vendors->groupBy(function($date) {
            return Carbon::parse($date->created_at)->format('m');
        })->map(function($row) {
            return count($row);
        });

        $vendorRegistrationsPerMonth = array_fill(1, 12, 0);
        foreach ($monthlyVendorRegistrations as $month => $count) {
            $vendorRegistrationsPerMonth[(int)$month] = $count;
        }

        $totalUsers = User::where('role', 'user')->count();
        $totalVendors = User::where('role', 'vendor')->count();
        $nullRoleUsers = User::whereNull('role')->count();

        $portofolios = WVPortofolio::where('status', 'menunggu konfirmasi')
                        ->orderBy('created_at','asc')
                        ->limit(5)
                        ->get();

        return view('admin.index', compact(
            'userRegistrationsPerMonth',
            'vendorRegistrationsPerMonth',
            'totalUsers',
            'totalVendors',
            'nullRoleUsers',
            'portofolios',
        ));
    }
}
