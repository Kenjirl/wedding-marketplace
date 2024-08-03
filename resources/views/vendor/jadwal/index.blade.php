@extends('vendor.layout')

@section('title')
    <title>Jadwal | Wedding Marketplace</title>
@endsection

@section('h1', 'Jadwal')

@section('content')
<div class="relative w-full flex items-start justify-center gap-4">
    {{-- KIRI --}}
    <div class="flex-1 w-full">
        {{-- KALENDAR --}}
        @if ($tab == 'calendar')
            <div class="w-full h-[80vh]" id="calendar"></div>
        @endif

        {{-- TABEL --}}
        @if ($tab == 'table')
            <div class="w-full min-h-[80vh]" id="tableContainer">
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
        @endif
    </div>

    {{-- KANAN --}}
    <div class="flex-shrink sticky top-0 w-[200px]">
        {{-- TAB --}}
        <div class="w-full mb-2 flex items-center justify-end gap-2">
            <a class="w-[30px] aspect-square flex items-center justify-center {{ $tab == 'calendar' ? 'bg-pink text-white' : 'bg-white text-pink' }} outline-pink border border-pink rounded active:bg-pink-active active:text-white transition-colors"
                href="{{ route('vendor.jadwal.index', ['jenis_id' => $jenis_id, 'tab' => 'calendar']) }}">
                <i class="fa-solid fa-calendar"></i>
            </a>
            <a class="w-[30px] aspect-square flex items-center justify-center {{ $tab != 'calendar' ? 'bg-pink text-white' : 'bg-white text-pink' }} outline-pink border border-pink rounded active:bg-pink-active active:text-white transition-colors"
                href="{{ route('vendor.jadwal.index', ['jenis_id' => $jenis_id, 'tab' => 'table']) }}">
                <i class="fa-solid fa-table-list"></i>
            </a>
        </div>

        {{-- FILTER --}}
        <div class="w-full flex flex-wrap items-start justify-end gap-2">
            <a class="block w-fit px-2 py-1 border border-pink outline-pink {{ $jenis_id == null ? 'bg-pink text-white' : 'bg-white text-pink' }} text-sm font-semibold rounded active:bg-pink-active active:text-white transition-colors"
                href="{{ route('vendor.jadwal.index', ['tab' => $tab]) }}">
                All
            </a>
            @forelse ($j_vendor as $jenis)
                <a class="block w-fit px-2 py-1 border border-pink outline-pink {{ $jenis_id == $jenis->m_jenis_vendor_id ? 'bg-pink text-white' : 'bg-white text-pink' }} text-sm font-semibold rounded active:bg-pink-active active:text-white transition-colors"
                    href="{{ route('vendor.jadwal.index', ['jenis_id' => $jenis->m_jenis_vendor_id, 'tab' => $tab]) }}">
                    {{ $jenis->master->nama }}
                </a>
            @empty
            @endforelse
        </div>
    </div>
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
