@extends('user.layout')

@section('title')
    <title>Pesanan | Wedding Marketplace</title>
@endsection

@section('content')
    <div class="max-w-[1200px] mx-auto mt-4">
        {{-- H1 --}}
        <div class="mb-8">
            <h1 class="text-[2em] font-bold">
                Pesanan Anda
            </h1>
        </div>

        <div class="w-full">
            <table class="w-full table-auto cell-border compact hover" id="dataTable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Pernikahan</th>
                        <th>Vendor</th>
                        <th>Layanan</th>
                        <th>Status</th>
                        <th>Dibuat Pada</th>
                        <th>Direspon Pada</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($bookings as $booking)
                        @php
                            $color = 'red';
                            if (in_array($booking->status, ['dibayar', 'selesai'])) {
                                $color = 'green';
                            } elseif ($booking->status == 'diterima') {
                                $color = 'blue';
                            } elseif ($booking->status == 'diproses') {
                                $color = 'yellow';
                            }
                        @endphp
                        <tr class="border-b">
                            <td class="text-center">
                                {{ $loop->iteration }}
                            </td>
                            <td class="px-2">
                                <div class="w-full line-clamp-1">
                                    {{ $booking->wedding->p_sapaan . ' & ' . $booking->wedding->w_sapaan }}
                                </div>
                            </td>
                            <td class="px-2">
                                <div class="w-full line-clamp-1">
                                    {{ $booking->vendor->nama }}
                                </div>
                            </td>
                            <td class="px-2">
                                <div class="w-full line-clamp-1">
                                    {{ $booking->plan->nama }}
                                </div>
                            </td>
                            <td class="px-2">
                                <div class="block w-fit mx-auto px-2 rounded-full bg-{{ $color }}-400 text-white font-semibold text-sm">
                                    {{ $booking->status }}
                                </div>
                            </td>
                            <td class="px-2 text-center">
                                {{ \Carbon\Carbon::parse($booking->created_at)->translatedFormat('d M Y - H:i:s') }}
                            </td>
                            <td class="px-2 text-center">
                                {{ ($booking->status != 'diproses') ? \Carbon\Carbon::parse($booking->updated_at)->translatedFormat('d M Y - H:i:s') : '-'}}
                            </td>
                            <td class="flex items-center justify-center gap-2 p-2">
                                <a class="text-center text-sm font-semibold px-4 py-2 outline-none text-pink bg-white hover:bg-pink hover:text-white focus:bg-pink focus:text-white active:bg-pink-active transition-colors rounded"
                                    href="{{ route('user.pernikahan.ke_detail', $booking->w_c_wedding_id) }}?id_info={{ $booking->id }}">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td>Belum ada transaksi</td>
                            <td></td>
                            <td></td>
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
@endsection
