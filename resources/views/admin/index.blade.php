@extends('admin.layout')

@section('title')
    <title>Dashboard | Wedding Marketplace</title>
@endsection

@section('h1', 'Dashboard')

@section('content')
    <div class="w-full">
        {{-- KIRI --}}
        <div class="w-full rounded-lg shadow-md">
            <div class="w-full p-4 border-b-2 text-lg font-semibold">
                Total Pengguna
            </div>
            <div class="w-full">
                <div class="w-full" id="userTotalChart"></div>
            </div>
        </div>

        <hr class="my-4">

        {{-- KANAN --}}
        <div class="w-full rounded-lg shadow-md">
            <div class="w-full p-4 border-b-2 text-lg font-semibold">
                Registrasi Pengguna
            </div>
            <div class="w-full">
                <div class="w-full" id="userRegisChart"></div>
            </div>
        </div>
    </div>
@endsection

@push('child-js')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Chart Total User
            let userTotalChartData = @json($userTotalChartData);
            let userTotalSeriesData = [];

            Object.keys(userTotalChartData).forEach(function(jenisStatName) {
                userTotalSeriesData.push({
                    name: jenisStatName,
                    data: [userTotalChartData[jenisStatName]]
                });
            });

            let userTotalChartOption = {
                series: userTotalSeriesData,
                chart: {
                    type: 'bar',
                    height: 500
                },
                xaxis: {
                    categories: ['Total Pengguna']
                },
                dataLabels: {
                    enabled: false
                },
                tooltip: {
                    x: {
                        format: 'MM/yyyy'
                    },
                },
            }

            let userTotalChart = new ApexCharts(document.querySelector("#userTotalChart"), userTotalChartOption);
            userTotalChart.render();

            // Chart Registrasi User per Bulan
            let userRegisChartData = @json($userRegisChartData);
            let regisSeriesData = [
                {
                    name: 'Pengguna',
                    data: Object.values(userRegisChartData).map(function(data) {
                        return data.Pengguna;
                    })
                },
                {
                    name: 'Vendor',
                    data: Object.values(userRegisChartData).map(function(data) {
                        return data.Vendor;
                    })
                }
            ];

            let userRegisChartOption = {
                series: regisSeriesData,
                chart: {
                    type: 'area',
                    height: 500
                },
                xaxis: {
                    categories: Object.keys(userRegisChartData),
                    title: {
                        text: 'Tahun-Bulan'
                    }
                },
                yaxis: {
                    title: {
                        text: 'Jumlah Registrasi'
                    }
                },
                dataLabels: {
                    enabled: false
                },
                tooltip: {
                    x: {
                        format: 'MM/yyyy'
                    },
                },
            };

            let userRegisChart = new ApexCharts(document.querySelector("#userRegisChart"), userRegisChartOption);
            userRegisChart.render();
        });
    </script>
@endpush
