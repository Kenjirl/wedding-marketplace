@extends('user.layout')

@section('title')
    <title>Pesanan | Wedding Marketplace</title>
@endsection

@section('content')
    <div class="max-w-[1200px] mx-auto mt-4">
        {{-- H1 --}}
        <div class="mb-8">
            <h1 class="text-[2em] font-bold">
                Transaksi Anda
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
                        <th>Nominal</th>
                        <th>Status</th>
                        <th>Dibuat Pada</th>
                        <th>Selesai Pada</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($transactions as $trx)
                        @php
                            $color = 'red';
                            if (in_array($trx->transaction_status, ['captue', 'settlement'])) {
                                $color = 'green';
                            } elseif ($trx->transaction_status == 'pending') {
                                $color = 'yellow';
                            }
                        @endphp
                        <tr class="border-b">
                            <td class="text-center">
                                {{ $loop->iteration }}
                            </td>
                            <td class="px-2">
                                <div class="w-full line-clamp-1">
                                    {{ $trx->booking->wedding->p_sapaan . ' & ' . $trx->booking->wedding->w_sapaan }}
                                </div>
                            </td>
                            <td class="px-2">
                                <div class="w-full line-clamp-1">
                                    {{ $trx->booking->vendor->nama }}
                                </div>
                            </td>
                            <td class="px-2">
                                <div class="w-full line-clamp-1">
                                    {{ $trx->booking->plan->nama }}
                                </div>
                            </td>
                            <td class="px-2 text-end">
                                Rp {{ number_format($trx->gross_amount, 0, ',', '.') }}
                            </td>
                            <td class="px-2">
                                <div class="block w-fit mx-auto px-2 rounded-full bg-{{ $color }}-400 text-white font-semibold text-sm">
                                    {{ $trx->transaction_status }}
                                </div>
                            </td>
                            <td class="px-2 text-center">
                                {{ \Carbon\Carbon::parse($trx->transaction_time)->translatedFormat('d M Y - H:i:s') }}
                            </td>
                            <td class="px-2 text-center">
                                {{ in_array($trx->transaction_status, ['captue', 'settlement']) ? \Carbon\Carbon::parse($trx->updated_at)->translatedFormat('d M Y - H:i:s') : '-'}}
                            </td>
                            <td class="flex items-center justify-center gap-2 p-2">
                                <a class="text-center text-sm font-semibold px-4 py-2 outline-none text-pink bg-white hover:bg-pink hover:text-white focus:bg-pink focus:text-white active:bg-pink-active transition-colors rounded"
                                    href="{{ route('user.pernikahan.ke_detail', $trx->booking->w_c_wedding_id) }}?id_info={{ $trx->booking->id }}">
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
                            <td></td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
