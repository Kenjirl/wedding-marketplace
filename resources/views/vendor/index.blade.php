@extends('vendor.layout')

@section('title')
    <title>Dashboard | Wedding Marketplace</title>
@endsection

@section('h1', 'Dashboard')

@php
    $statuses = [
        'menunggu konfirmasi' => ['name' => 'Menunggu Konfirmasi', 'color' => 'yellow', 'icon' => 'fa-regular fa-clock'],
        'diterima' => ['name' => 'Diterima', 'color' => 'blue', 'icon' => 'fa-regular fa-circle-check'],
        'ditolak' => ['name' => 'Ditolak', 'color' => 'red', 'icon' => 'fa-regular fa-circle-xmark']
    ];
@endphp

@section('content')
    @if ($vendor && $jenis->isNotEmpty())
        {{-- ATAS --}}
        <div class="w-full mb-8 flex items-start justify-center gap-8">
            {{-- GRAFIK PENDAPATAN --}}
            <div class="w-1/2 rounded-lg shadow border">
                <div class="w-full p-2 pl-4 flex items-center justify-between font-semibold border-b-2">
                    <span>
                        Pendapatan Bulan Ini
                    </span>
                    <a class="w-[30px] aspect-square flex items-center justify-center rounded bg-pink text-white active:bg-pink-active transition-colors"
                        href="{{ route('vendor.pendapatan.index') }}">
                        <i class="fa-solid fa-square-arrow-up-right"></i>
                    </a>
                </div>
                <div class="w-full">
                    <div id="revenueChart"></div>
                </div>
            </div>

            {{-- KALENDAR JADWAL --}}
            <div class="w-1/2 rounded-lg shadow border">
                <div class="w-full p-2 pl-4 flex items-center justify-between font-semibold border-b-2">
                    <span>
                        Jadwal Minggu Ini
                    </span>
                    <a class="w-[30px] aspect-square flex items-center justify-center rounded bg-pink text-white active:bg-pink-active transition-colors"
                        href="{{ route('vendor.jadwal.index') }}">
                        <i class="fa-solid fa-square-arrow-up-right"></i>
                    </a>
                </div>
                <div class="w-full max-h-[315px] overflow-y-auto">
                    <div class="w-full" id="scheduleCalendar"></div>
                </div>
            </div>
        </div>

        {{-- PESANAN TERBARU --}}
        <div class="w-full rounded-lg shadow border">
            <div class="w-full p-2 pl-4 flex items-center justify-between font-semibold border-b-2">
                <span>
                    Pesanan Bulan Ini
                </span>
                <a class="w-[30px] aspect-square flex items-center justify-center rounded bg-pink text-white active:bg-pink-active transition-colors"
                    href="{{ route('vendor.pesanan.index') }}">
                    <i class="fa-solid fa-square-arrow-up-right"></i>
                </a>
            </div>
            <div class="w-full p-4 pb-0">
                <table class="w-full display table-auto cell-border compact hover" id="dataTable">
                    <thead>
                        <tr class="border-t">
                            <th>No</th>
                            <th>Pernikahan</th>
                            <th>Dipesan Tanggal</th>
                            <th>Untuk Tanggal</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($bookings as $booking)
                            <tr class="border-b">
                                <td class="text-center">
                                    {{ $loop->iteration }}
                                </td>
                                <td class="px-2">
                                    <div class="line-clamp-1">
                                        {{ 'Tn. ' . $booking->wedding->p_lengkap . ' & Nn. ' . $booking->wedding->w_lengkap}}
                                    </div>
                                </td>
                                <td class="px-2 text-end">
                                    {{ \Carbon\Carbon::parse($booking->created_at)->translatedFormat('d F Y') }}
                                </td>
                                <td class="px-2 text-end">
                                    {{ \Carbon\Carbon::parse($booking->untuk_tanggal)->translatedFormat('d F Y') }}
                                </td>
                                <td class="px-2 text-end">
                                    @if ($booking->status == 'diproses')
                                    <div class="w-fit mx-auto text-sm rounded-full text-white font-semibold py-1 px-2 bg-yellow-500">
                                        menunggu konfirmasi
                                    </div>
                                    @else
                                    <div class="w-fit mx-auto text-sm rounded-full text-white font-semibold py-1 px-2 bg-green-500">
                                        menunggu pembayaran
                                    </div>
                                    @endif
                                </td>
                                <td class="p-2">
                                    <a class="block text-center text-sm font-semibold p-2 outline-none text-pink bg-white hover:bg-pink hover:text-white focus:bg-pink focus:text-white active:bg-pink-active transition-colors rounded"
                                        href="{{ route('vendor.pesanan.ke_detail', $booking->id) }}">
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
                                <td></td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    @else
        <div class="w-full h-[60vh] flex flex-col items-center justify-center gap-8">
            @if ($vendor && $jenis->isEmpty())
                <span class="text-lg">Silahkan pilih minimal 1 jenis vendor</span>
                <a class="w-fit px-4 py-2 rounded text-white font-semibold bg-pink hover:bg-pink-hover outline-pink outline-offset-4 focus:bg-pink-hover active:bg-pink-active transition-colors"
                    href="{{ route('vendor.profil.index') }}?#jenisVendor">
                    <i class="fa-regular fa-user"></i>
                    Pilih Jenis Vendor
                </a>
            @else
                <span class="text-lg">Silahkan lengkapi profil kamu terlebih dahulu</span>
                <a class="w-fit px-4 py-2 rounded text-white font-semibold bg-pink hover:bg-pink-hover outline-pink outline-offset-4 focus:bg-pink-hover active:bg-pink-active transition-colors"
                    href="{{ route('vendor.profil.ke_ubah') }}">
                    <i class="fa-regular fa-user"></i>
                    Lengkapi Profil
                </a>
            @endif
        </div>
    @endif
@endsection

@if ($vendor && $jenis->isNotEmpty())
    @push('child-js')
        {{-- GRAFIK PENDAPATAN --}}
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                var monthlyRevenue = @json($monthlyRevenue);
                var seriesData = [];

                Object.keys(monthlyRevenue).forEach(function(jenisVendorName) {
                    seriesData.push({
                        name: jenisVendorName,
                        data: [monthlyRevenue[jenisVendorName]]
                    });
                });

                var options = {
                    series: seriesData,
                    chart: {
                        height: 300,
                        type: 'bar'
                    },
                    dataLabels: {
                        enabled: false
                    },
                    xaxis: {
                        categories: ['Bulan Ini']
                    },
                    tooltip: {
                        x: {
                            format: 'MM/yyyy'
                        },
                    },
                };

                var chart = new ApexCharts(document.querySelector("#revenueChart"), options);
                chart.render();
            });
        </script>

        {{-- KALENDAR JADWAL --}}
        <script>
            let calendarEl = document.getElementById('scheduleCalendar');
            let calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridWeek',
                events: @json($schedules),
                eventBackgroundColor: '#F78CA2',
                eventTextColor: '#FFFFFF',
                headerToolbar: false
            });
            calendar.render();
        </script>
    @endpush
@endif
