@extends('admin.layout')

@section('title')
    <title>Dashboard | Wedding Marketplace</title>
@endsection

@section('h1', 'Dashboard')

@section('content')
    @php
        $statuses = [
            'menunggu konfirmasi' => ['name' => 'Menunggu Konfirmasi', 'color' => 'yellow', 'icon' => 'fa-regular fa-clock'],
            'diterima' => ['name' => 'Diterima', 'color' => 'blue', 'icon' => 'fa-regular fa-circle-check'],
            'ditolak' => ['name' => 'Ditolak', 'color' => 'red', 'icon' => 'fa-regular fa-circle-xmark']
        ];
    @endphp

    <div class="w-full">
        {{-- ATAS --}}
        <div class="w-full flex items-start justify-center gap-4">
            {{-- KIRI --}}
            <div class="w-1/2 grid grid-cols-2 gap-4">
                <div class="w-full p-4 rounded shadow">
                    <div class="w-full mb-2">
                        Pengguna
                    </div>
                    <div class="w-full text-center text-[3em] font-bold">
                        {{ $totalUsers }}
                    </div>
                </div>
                <div class="w-full p-4 rounded shadow">
                    <div class="w-full mb-2">
                        Vendor
                    </div>
                    <div class="w-full text-center text-[3em] font-bold">
                        {{ $totalVendors }}
                    </div>
                </div>
                <div class="w-full p-4 rounded shadow">
                    <div class="w-full mb-2">
                        Belum Memilih Role
                    </div>
                    <div class="w-full text-center text-[3em] font-bold">
                        {{ $nullRoleUsers }}
                    </div>
                </div>
                <div class="w-full p-4 rounded shadow">
                    <div class="w-full mb-2">
                        Total Pengguna
                    </div>
                    <div class="w-full text-center text-[3em] font-bold">
                        {{ $totalUsers + $totalVendors + $nullRoleUsers }}
                    </div>
                </div>
            </div>

            {{-- KANAN --}}
            <div class="w-1/2 rounded-lg shadow-md">
                {{-- DAFTAR ADMIN --}}
                <div class="w-full p-2 flex items-center justify-between border-b-2">
                    <div class="text-lg font-semibold">
                        Portofolio Terbaru
                    </div>
                </div>
                <div class="w-full h-[300px] p-4 overflow-y-auto">
                    @forelse ($portofolios as $portofolio)
                        @php
                            $statusIcon = $statuses[$portofolio->status]['icon'] ?? 'fa-regular fa-question-circle';
                        @endphp

                        <div class="w-full p-2 pr-4 flex items-center justify-between gap-4 shadow-md rounded-lg">
                            <div class="w-[50px] aspect-square flex items-center justify-center rounded bg-pink text-white">
                                {{ $loop->iteration }}
                            </div>
                            <div class="w-full line-clamp-1">
                                {{ $portofolio->judul }}
                            </div>
                            <div class="w-[50px] aspect-square flex items-center justify-center rounded bg-{{ $statuses[$portofolio->status]['color'] }}-400 text-white"
                                data-tippy-content="{{ $statuses[$portofolio->status]['name'] }}">
                                <i class="{{ $statusIcon }}"></i>
                            </div>
                            <div>
                                <a class="text-sm font-semibold text-slate-400"
                                    href="{{ route('admin.portofolio.ke_validasi', ['id' => $portofolio->id, 'vendor' => $portofolio->w_vendor->jenis]) }}">
                                    detail
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="p-4 text-sm">
                            Tidak ada portofolio yang menunggu konfirmasi
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        <hr class="my-8">

        {{-- GRAFIK --}}
        <div class="w-full flex items-center justify-center gap-8">
            <div class="w-1/2 rounded-lg shadow">
                <div class="w-full p-4 font-semibold border-b-2">
                    Registrasi Pengguna
                </div>
                <div class="w-full p-2">
                    <canvas id="userChart">Your browser does not support the canvas element.</canvas>
                </div>
            </div>

            <div class="w-1/2 rounded-lg shadow">
                <div class="w-full p-4 font-semibold border-b-2">
                    Registrasi Vendor
                </div>
                <div class="w-full p-2">
                    <canvas id="vendorChart">Your browser does not support the canvas element.</canvas>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('child-js')
    <script>
        const userCtx = document.getElementById('userChart').getContext('2d');
        const vendorCtx = document.getElementById('vendorChart').getContext('2d');
        const labels = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

        const userDataset = @json(array_values($userRegistrationsPerMonth));
        const vendorDataset = @json(array_values($vendorRegistrationsPerMonth));

        new Chart(userCtx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Registrasi Pengguna',
                    data: userDataset,
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

        new Chart(vendorCtx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Registrasi Vendor',
                    data: vendorDataset,
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
@endpush
