@extends('vendor.layout')

@section('title')
    <title>Dashboard | Wedding Marketplace</title>
@endsection

@section('h1', 'Dashboard')

@php
    $user = auth()->user();
    $wVendor = $user->w_vendor ?? null;
    $jenis = $wVendor ? $wVendor->jenis : collect();

    $statuses = [
        'menunggu konfirmasi' => ['name' => 'Menunggu Konfirmasi', 'color' => 'yellow', 'icon' => 'fa-regular fa-clock'],
        'diterima' => ['name' => 'Diterima', 'color' => 'blue', 'icon' => 'fa-regular fa-circle-check'],
        'ditolak' => ['name' => 'Ditolak', 'color' => 'red', 'icon' => 'fa-regular fa-circle-xmark']
    ];
@endphp

@section('content')
    @if ($wVendor && $jenis->isNotEmpty())
        {{-- ATAS --}}
        <div class="w-full flex items-start justify-center gap-4">
            {{-- GRAFIK PENDAPATAN --}}
            <div class="w-1/2 rounded-lg shadow border">
                <div class="w-full p-4 font-semibold border-b-2">
                    Pendapatan Tahun Ini
                </div>
                <div class="w-full p-2 h-[300px]">
                    <canvas id="revenueChart">Your browser does not support the canvas element.</canvas>
                </div>
            </div>

            {{-- KALENDAR JADWAL --}}
            <div class="w-1/2 rounded-lg shadow border">
                <div class="w-full p-4 font-semibold border-b-2">
                    Jadwal Minggu Ini
                </div>
                <div class="w-full max-h-[300px] overflow-y-auto">
                    <div class="w-full" id="scheduleCalendar"></div>
                </div>
            </div>
        </div>

        <hr class="my-8">

        <div class="w-full min-h-[50vh]">
            <table class="w-full table-auto cell-border compact hover" id="dataTable">
                <thead>
                    <tr>
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
                        <tr>
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
                        {{-- NO DATA --}}
                    @endforelse
                </tbody>
            </table>
        </div>
    @else
        <div class="w-full h-[60vh] flex flex-col items-center justify-center gap-8">
            @if ($wVendor && $jenis->isEmpty())
                <span class="text-lg">Silahkan pilih minimal 1 jenis vendor</span>
            @else
                <span class="text-lg">Silahkan lengkapi profil kamu terlebih dahulu</span>
            @endif
            <a class="w-fit px-4 py-2 rounded text-white font-semibold bg-pink hover:bg-pink-hover outline-pink outline-offset-4 focus:bg-pink-hover active:bg-pink-active transition-colors"
                href="{{ route('vendor.profil.ke_ubah') }}">
                <i class="fa-regular fa-user"></i>
                Lengkapi Profil
            </a>
        </div>
    @endif
@endsection

@push('child-js')
    {{-- GRAFIK PENDAPATAN --}}
    <script>
        const ctx = document.getElementById('revenueChart').getContext('2d');
        const labels = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        const revenueData = @json(array_values($monthlyRevenue));

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Total Pendapatan',
                    data: revenueData,
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                plugins: {
                    legend: {
                        display: true,
                        position: 'bottom'
                    }
                }
            }
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
