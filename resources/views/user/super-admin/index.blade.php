@extends('user.super-admin.layout')

@section('title')
    <title>Dashboard | Wedding Marketplace</title>
@endsection

@section('h1', 'Dashboard')

@section('content')
    <div class="w-full">
        {{-- ATAS --}}
        <div class="w-full flex items-start justify-center gap-8">
            {{-- KIRI --}}
            <div class="w-2/3 grid grid-cols-2 gap-4">
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
            <div class="w-1/3 rounded-lg shadow-md">
                {{-- DAFTAR ADMIN --}}
                <div class="w-full p-2 flex items-center justify-between border-b-2">
                    <div class="text-lg font-semibold">
                        Daftar Admin
                    </div>

                    <div>
                        <a class="w-[30px] aspect-square flex items-center justify-center bg-pink text-white outline-pink rounded transition-colors"
                            href="{{ route('super-admin.daftar-admin.ke_tambah') }}">
                            <i class="fa-solid fa-plus"></i>
                        </a>
                    </div>
                </div>
                <div class="w-full h-[300px] overflow-y-auto">
                    @foreach ($admins as $user)
                        <div class="w-full p-4 flex items-center justify-between">
                            <div class="line-clamp-1">
                                {{ $user->admin->nama }}
                            </div>
                            <div>
                                <a class="text-sm font-semibold text-slate-500"
                                    href="{{ route('super-admin.daftar-admin.ke_ubah', $user->admin->id) }}">
                                    detail
                                </a>
                            </div>
                        </div>
                    @endforeach
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
