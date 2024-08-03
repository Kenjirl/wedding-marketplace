@extends('vendor.layout')

@section('title')
    <title>Pesanan | Wedding Marketplace</title>
@endsection

@section('h1', 'Pesanan')

@section('content')
    {{-- FILTER JENIS VENDOR --}}
    <div class="w-full mb-2 flex flex-wrap items-start justify-end gap-2">
        <a class="block w-fit px-2 py-1 border border-pink outline-pink {{ $jenis_id == null ? 'bg-pink text-white' : 'bg-white text-pink' }} text-sm font-semibold rounded active:bg-pink-active active:text-white transition-colors"
            href="{{ route('vendor.pesanan.index') }}">
            All
        </a>
        @forelse ($j_vendor as $jenis)
            <a class="block w-fit px-2 py-1 border border-pink outline-pink {{ $jenis_id == $jenis->m_jenis_vendor_id ? 'bg-pink text-white' : 'bg-white text-pink' }} text-sm font-semibold rounded active:bg-pink-active active:text-white transition-colors"
                href="{{ route('vendor.pesanan.index', ['jenis_id' => $jenis->m_jenis_vendor_id]) }}">
                {{ $jenis->master->nama }}
            </a>
        @empty
        @endforelse
    </div>

    <hr class="my-4">

    {{-- TABLE --}}
    <div class="w-full">
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
@endsection
