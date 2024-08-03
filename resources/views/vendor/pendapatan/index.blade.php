@extends('vendor.layout')

@section('title')
    <title>Pendapatan | Wedding Marketplace</title>
@endsection

@section('h1', 'Pendapatan')

@section('content')
    <div class="relative w-full flex items-start justify-center gap-2">
        {{-- KIRI --}}
        <div class="flex-1 w-full">
            {{-- GRAFIK SELURUH PENDAPATAN --}}
            @if ($tab == 'all')
                <div class="w-full rounded-lg shadow border">
                    <div class="w-full p-4 font-semibold border-b-2">
                        <span>
                            Grafik Seluruh Pendapatan Per Jenis Vendor
                        </span>
                    </div>
                    <div class="w-[95%] mx-auto p-4">
                        <div class="w-full" id="revenueAreaChart"></div>
                    </div>
                </div>
            @endif

            {{-- GRAFIK TOTAL PENDAPATAN --}}
            @if ($tab == 'total')
                <div class="w-full rounded-lg shadow border">
                    <div class="w-full p-4 font-semibold border-b-2">
                        <span>
                            Grafik Total Pendapatan Per Jenis Vendor
                        </span>
                    </div>
                    <div class="w-[95%] mx-auto p-4">
                        <div class="w-full" id="revenueColumnChart"></div>
                    </div>
                </div>
            @endif

            {{-- TABEL --}}
            @if ($tab == 'table')
                <div class="w-full min-h-[80vh]">
                    <div class="w-full rounded-lg shadow border">
                        <div class="w-full p-4 font-semibold border-b-2">
                            <span>
                                Daftar Pendapatan
                            </span>
                        </div>
                        <div class="w-full p-4">
                            <table class="w-full display table-auto cell-border compact hover" id="dataTable">
                                <thead>
                                    <tr class="border-t">
                                        <th>No</th>
                                        <th>Pernikahan</th>
                                        <th>Untuk Tanggal</th>
                                        <th>Pendapatan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($revenues as $revenue)
                                        <tr class="border-b">
                                            <td class="text-center">
                                                {{ $loop->iteration }}
                                            </td>
                                            <td class="px-2">
                                                <div class="line-clamp-1">
                                                    {{ 'Tn. ' . $revenue->wedding->p_lengkap . ' & Nn. ' . $revenue->wedding->w_lengkap}}
                                                </div>
                                            </td>
                                            <td class="px-2 text-end">
                                                {{ \Carbon\Carbon::parse($revenue->untuk_tanggal)->translatedFormat('d F Y') }}
                                            </td>
                                            <td class="px-2 text-end">
                                                {{ number_format($revenue->total_bayar, 0, ',', '.') }}
                                            </td>
                                            <td class="p-2">
                                                <a class="block text-center text-sm font-semibold p-2 outline-none text-pink bg-white hover:bg-pink hover:text-white focus:bg-pink focus:text-white active:bg-pink-active transition-colors rounded"
                                                    href="{{ route('vendor.pesanan.ke_detail', $revenue->id) }}">
                                                    <i class="fa-solid fa-magnifying-glass"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr class="border-b text-center">
                                            <td class="p-2">Belum ada data</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endif
        </div>

        {{-- KANAN FILTER --}}
        <div class="flex-shrink w-[200px]">
            {{-- TAB --}}
            <div class="w-full mb-2 flex items-center justify-end gap-2">
                <a class="w-[30px] aspect-square flex items-center justify-center {{ $tab == 'all' ? 'bg-pink text-white' : 'bg-white text-pink' }} outline-pink border border-pink rounded active:bg-pink-active active:text-white transition-colors"
                    href="{{ route('vendor.pendapatan.index', ['jenis_id' => $jenis_id, 'tab' => 'all']) }}">
                    <i class="fa-solid fa-chart-line"></i>
                </a>
                <a class="w-[30px] aspect-square flex items-center justify-center {{ $tab == 'total' ? 'bg-pink text-white' : 'bg-white text-pink' }} outline-pink border border-pink rounded active:bg-pink-active active:text-white transition-colors"
                    href="{{ route('vendor.pendapatan.index', ['jenis_id' => $jenis_id, 'tab' => 'total']) }}">
                    <i class="fa-solid fa-chart-column"></i>
                </a>
                <a class="w-[30px] aspect-square flex items-center justify-center {{ $tab == 'table' ? 'bg-pink text-white' : 'bg-white text-pink' }} outline-pink border border-pink rounded active:bg-pink-active active:text-white transition-colors"
                    href="{{ route('vendor.pendapatan.index', ['jenis_id' => $jenis_id, 'tab' => 'table']) }}">
                    <i class="fa-solid fa-table-list"></i>
                </a>
            </div>

            {{-- FILTER --}}
            <div class="w-full flex flex-wrap items-start justify-end gap-2">
                <a class="block w-fit px-2 py-1 border border-pink outline-pink {{ $jenis_id == null ? 'bg-pink text-white' : 'bg-white text-pink' }} text-sm font-semibold rounded active:bg-pink-active active:text-white transition-colors"
                    href="{{ route('vendor.pendapatan.index', ['tab' => $tab]) }}">
                    All
                </a>
                @forelse ($j_vendor as $jenis)
                    <a class="block w-fit px-2 py-1 border border-pink outline-pink {{ $jenis_id == $jenis->m_jenis_vendor_id ? 'bg-pink text-white' : 'bg-white text-pink' }} text-sm font-semibold rounded active:bg-pink-active active:text-white transition-colors"
                        href="{{ route('vendor.pendapatan.index', ['jenis_id' => $jenis->m_jenis_vendor_id, 'tab' => $tab]) }}">
                        {{ $jenis->master->nama }}
                    </a>
                @empty
                @endforelse
            </div>
        </div>
    </div>
@endsection

@push('child-js')
    {{-- GRAFIK REVENUE --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var areaOptions = {
                series: @json($areaChartData['series']),
                chart: {
                    type: 'area',
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    curve: 'smooth'
                },
                xaxis: {
                    categories: @json($areaChartData['categories']),
                    title: {
                        text: 'Tanggal'
                    }
                },
                yaxis: {
                    title: {
                        text: 'Pendapatan'
                    }
                },
                tooltip: {
                    shared: true,
                    intersect: false,
                },
                legend: {
                    position: 'top',
                }
            };

            var areaChart = new ApexCharts(document.querySelector("#revenueAreaChart"), areaOptions);
            areaChart.render();

            var colOptions = {
                chart: {
                    type: 'bar',
                },
                series: @json($columnChartData['series']),
                xaxis: {
                    categories: @json($columnChartData['categories']),
                    title: {
                        text: 'Jenis Vendor'
                    }
                },
                yaxis: {
                    title: {
                        text: 'Total Pendapatan'
                    }
                }
            };

            var columnChart = new ApexCharts(document.querySelector("#revenueColumnChart"), colOptions);
            columnChart.render();
        });
    </script>
@endpush
