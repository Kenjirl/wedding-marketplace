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
        $userRegistrations = User::where('role', 'user')
            ->get()
            ->groupBy(function($date) {
                return Carbon::parse($date->created_at)->format('Y-m');
            })->map(function($row) {
                return count($row);
            });

        $vendorRegistrations = User::where('role', 'vendor')
            ->get()
            ->groupBy(function($date) {
                return Carbon::parse($date->created_at)->format('Y-m');
            })->map(function($row) {
                return count($row);
            });

        $userRegisChartData = [];
        foreach ($userRegistrations as $monthYear => $count) {
            $userRegisChartData[$monthYear]['Pengguna'] = $count;
        }
        foreach ($vendorRegistrations as $monthYear => $count) {
            if (isset($userRegisChartData[$monthYear])) {
                $userRegisChartData[$monthYear]['Vendor'] = $count;
            } else {
                $userRegisChartData[$monthYear] = ['Pengguna' => 0, 'Vendor' => $count];
            }
        }

        foreach ($userRegisChartData as &$data) {
            if (!isset($data['Pengguna'])) {
                $data['Pengguna'] = 0;
            }
            if (!isset($data['Vendor'])) {
                $data['Vendor'] = 0;
            }
        }

        $totalUsers = User::where('role', 'user')->count();
        $totalVendors = User::where('role', 'vendor')->count();

        $userTotalChartData = [
            'Pengguna' => $totalUsers,
            'Vendor' => $totalVendors,
        ];

        return view('admin.index', compact(
            'userRegisChartData',
            'userTotalChartData'
        ));
    }
}
