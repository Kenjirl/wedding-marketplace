@extends('user.wedding-organizer.layout')

@section('title')
    <title>Pesanan | Wedding Marketplace</title>
@endsection

@section('h1', 'Pesanan')

@section('content')
    <div class="w-full">
        <table class="w-full table-auto border-collapse border border-slate-500">
            <thead>
                <tr>
                    <th class="border border-slate-500">No</th>
                    <th class="border border-slate-500">Pernikahan</th>
                    {{-- <th class="border border-slate-500">Status</th> --}}
                    <th class="border border-slate-500">Dipesan Tanggal</th>
                    <th class="border border-slate-500">Untuk Tanggal</th>
                    <th class="border border-slate-500">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($bookings as $booking)
                    <tr>
                        <td class="text-center border border-slate-500">
                            {{ $loop->iteration }}
                        </td>
                        <td class="px-2 border border-slate-500">
                            <div class="line-clamp-1">
                                {{ 'Tn. ' . $booking->wedding->groom . ' & Nn. ' . $booking->wedding->bride}}
                            </div>
                        </td>
                        {{-- <td class="px-2 border border-slate-500">
                            {{ $booking->status }}
                        </td> --}}
                        <td class="px-2 text-end border border-slate-500">
                            {{ \Carbon\Carbon::parse($booking->created_at)->format('Y-m-d') }}
                        </td>
                        <td class="px-2 text-end border border-slate-500">
                            {{ $booking->untuk_tanggal }}
                        </td>
                        <td class="h-full flex flex-nowrap items-center justify-center gap-2 p-2">
                            {{-- <div class="w-fit"> --}}
                                <a class="w-full text-center text-sm font-semibold p-2 outline-none text-pink bg-white hover:bg-pink hover:text-white focus:bg-pink focus:text-white active:bg-pink-active transition-colors rounded"
                                    href="{{ route('wedding-organizer.pesanan.ke_detail', $booking->id) }}">
                                    <i class="fa-solid fa-circle-info"></i>
                                    Detail
                                </a>
                            {{-- </div> --}}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td class="text-center">-</td>
                        <td class="text-center">-</td>
                        <td class="text-center">-</td>
                        <td class="text-center">-</td>
                        <td class="text-center">-</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
