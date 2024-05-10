@extends('user.wedding-photographer.layout')

@section('title')
    <title>Pesanan | Wedding Marketplace</title>
@endsection

@section('h1', 'Pesanan')

@section('content')
    <div class="w-full">
        <table class="w-full table-auto cell-border compact hover" id="dataTable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Pernikahan</th>
                    <th>Dipesan Tanggal</th>
                    <th>Untuk Tanggal</th>
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
                            {{ \Carbon\Carbon::parse($booking->created_at)->format('Y-m-d') }}
                        </td>
                        <td class="px-2 text-end">
                            {{ $booking->untuk_tanggal }}
                        </td>
                        <td class="p-2">
                            <a class="block text-center text-sm font-semibold p-2 outline-none text-pink bg-white hover:bg-pink hover:text-white focus:bg-pink focus:text-white active:bg-pink-active transition-colors rounded"
                                href="{{ route('wedding-photographer.pesanan.ke_detail', $booking->id) }}">
                                <i class="fa-solid fa-magnifying-glass"></i>
                                {{-- Detail --}}
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
