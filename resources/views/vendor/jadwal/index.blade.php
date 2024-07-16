@extends('vendor.layout')

@section('title')
    <title>Jadwal | Wedding Marketplace</title>
@endsection

@section('h1', 'Jadwal')

@section('content')
    <div class="w-2/3"
        id="calendar"></div>

    <hr class="my-4">

    <div class="w-full min-h-[80vh]">
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
                        <td class="px-2 text-center">
                            <div class="w-[100px] mx-auto px-2 py-1 text-sm text-white font-semibold bg-green-400 rounded-full">
                                {{ $booking->status }}
                            </div>
                        </td>
                        <td class="p-2">
                            <a class="block text-center text-sm font-semibold p-2 outline-none text-pink bg-white hover:bg-pink hover:text-white focus:bg-pink focus:text-white active:bg-pink-active transition-colors rounded"
                                href="{{ route('vendor.jadwal.ke_detail', $booking->id) }}">
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
@endsection

@push('child-js')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            let calendarEl = document.getElementById('calendar');
            let calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                events: @json($events),
                eventBackgroundColor: '#F78CA2',
                eventTextColor: '#FFFFFF',
                headerToolbar: {
                    left: 'prev,next',
                    center: 'title',
                    right: 'dayGridYear,dayGridMonth,dayGridWeek,dayGridDay'
                },
                weekNumbers: true,
            });
            calendar.render();
        });
    </script>
@endpush
