<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\WVBooking;
use App\Models\WVJenis;
use Carbon\Carbon;
use Illuminate\Http\Request;

class VRevenueController extends Controller
{
    public function index(Request $req) {
        $jenis_id = $req->query('jenis_id');
        $tab      = $req->query('tab', 'all');

        $allowedTabs = ['all', 'total', 'table'];
        if (!in_array($tab, $allowedTabs)) {
            $tab = 'all';
        }

        $vendorId = auth()->user()->w_vendor->id;

        $j_vendor = WVJenis::where('w_vendor_id', $vendorId)
                            ->with(['master'])
                            ->get();

        $validJenisIds = $j_vendor->pluck('m_jenis_vendor_id')->toArray();

        if ($jenis_id && !in_array($jenis_id, $validJenisIds)) {
            $jenis_id = null;
        }

        $bookingsQuery = WVBooking::where('w_vendor_id', $vendorId)
                    ->with(['wedding', 'plan' => function ($query) {
                        $query->with(['jenis' => function ($query) {
                            $query->withTrashed();
                        }])->withTrashed();
                    }])
                    ->whereIn('status', ['dibayar', 'selesai'])
                    ->orderBy('untuk_tanggal');

        if ($jenis_id) {
            $bookingsQuery->whereHas('plan', function ($query) use ($jenis_id) {
                $query->withTrashed()->where('m_jenis_vendor_id', $jenis_id);
            });
        }

        $revenues = $bookingsQuery->get();

        foreach ($revenues as $revenue) {
            $revenue->jenis_vendor = $revenue->plan->jenis->nama;
        }

        $data = [];
        $categories = [];
        foreach ($revenues as $revenue) {
            $date = Carbon::parse($revenue->untuk_tanggal)->format('Y-m-d');
            $data[$revenue->jenis_vendor][$date][] = $revenue->total_bayar;
            $categories[] = $date;
        }

        $categories = array_unique($categories);
        sort($categories);

        $series = [];
        foreach (array_unique(array_column($revenues->toArray(), 'jenis_vendor')) as $jenis) {
            $seriesData = array_fill(0, count($categories), 0);
            foreach ($data[$jenis] as $date => $amounts) {
                $index = array_search($date, $categories);
                $seriesData[$index] = array_sum($amounts);
            }
            $series[] = [
                'name' => $jenis,
                'data' => $seriesData
            ];
        }

        $groupedRevenues = $revenues->groupBy('jenis_vendor')->map(function ($items) {
            return $items->sum('total_bayar');
        });

        $columnChartData = [
            'categories' => $groupedRevenues->keys(),
            'series' => [
                [
                    'name' => 'Total Pendapatan',
                    'data' => $groupedRevenues->values()
                ]
            ]
        ];

        $areaChartData = [
            'categories' => $categories,
            'series' => $series
        ];

        return view('vendor.pendapatan.index', compact(
            'jenis_id', 'tab',
            'j_vendor', 'revenues',
            'areaChartData', 'columnChartData'
        ));
    }
}
