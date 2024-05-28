@extends('user.wedding-photographer.layout')

@section('title')
    <title>Ulasan | Wedding Marketplace</title>
@endsection

@section('h1', 'Ulasan')

@section('content')
    {{-- INFO ATAS --}}
    @if (!$reviews->isEmpty())
        <div class="w-full mb-8 grid grid-cols-4 gap-4">
            {{-- JUMLAH ULASAN --}}
            <div class="w-full rounded shadow-lg">
                <div class="w-full p-2 rounded-t bg-pink text-white font-semibold">
                    Jumlah Ulasan
                </div>

                <div class="w-1/2 aspect-video mx-auto flex items-center justify-center">
                    <span class="p-2 text-3xl font-semibold">
                        {{ $reviewsCount }}
                    </span>
                </div>
            </div>

            {{-- TOTAL RATE --}}
            <div class="w-full rounded shadow-lg">
                <div class="w-full p-2 rounded-t bg-pink text-white font-semibold">
                    Total Nilai
                </div>

                <div class="w-1/2 aspect-video mx-auto flex items-center justify-center">
                    <span class="p-2 text-3xl font-semibold">
                        {{ number_format($averageRating, 1) }}/5 <i class="fa-solid fa-star text-yellow-300"></i>
                    </span>
                </div>
            </div>

            {{-- LOWEST RATE --}}
            <div class="w-full rounded shadow-lg">
                <div class="w-full p-2 flex items-center justify-between rounded-t bg-pink text-white font-semibold">
                    <span>
                        Nilai Terendah
                    </span>

                    <div>
                        <a class="text-center text-sm font-semibold py-1 px-2 outline-none text-white bg-pink hover:bg-white hover:text-pink focus:bg-white focus:text-pink active:bg-pink-active transition-colors rounded"
                            href="{{ route('wedding-photographer.jadwal.ke_detail', $lowestRate['id']) }}">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </a>
                    </div>
                </div>

                <div class="w-1/2 aspect-video mx-auto flex items-center justify-center">
                    <span class="p-2 text-3xl font-semibold">
                        {{ number_format($lowestRate['rate'], 1) }}/5 <i class="fa-solid fa-star text-yellow-300"></i>
                    </span>
                </div>
            </div>

            {{-- HIGHEST RATE --}}
            <div class="w-full rounded shadow-lg">
                <div class="w-full p-2 flex items-center justify-between rounded-t bg-pink text-white font-semibold">
                    <span>
                        Nilai Tertinggi
                    </span>

                    <div>
                        <a class="text-center text-sm font-semibold py-1 px-2 outline-none text-white bg-pink hover:bg-white hover:text-pink focus:bg-white focus:text-pink active:bg-pink-active transition-colors rounded"
                            href="{{ route('wedding-photographer.jadwal.ke_detail', $lowestRate['id']) }}">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </a>
                    </div>
                </div>

                <div class="w-1/2 aspect-video mx-auto flex items-center justify-center">
                    <span class="p-2 text-3xl font-semibold">
                        {{ number_format($highestRate['rate'], 1) }}/5 <i class="fa-solid fa-star text-yellow-300"></i>
                    </span>
                </div>
            </div>
        </div>
    @endif

    {{-- TABEL --}}
    <div class="w-full">
        <table class="w-full table-auto cell-border compact hover" id="dataTable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Oleh</th>
                    <th>Komentar</th>
                    <th>Nilai</th>
                    <th class="whitespace-nowrap">Pada Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($reviews as $review)
                    <tr>
                        <td class="text-center">
                            {{ $loop->iteration }}
                        </td>
                        <td class="px-2"> {{-- Oleh --}}
                            {{ $review->w_booking->wedding->w_couple->nama }}
                        </td>
                        <td class="w-full px-2">
                            <div class="line-clamp-1">
                                {{ $review->komentar }}
                            </div>
                        </td>
                        <td class="px-2 text-center">
                            {{ $review->rating }}
                        </td>
                        <td class="px-2 text-center">
                            {{ $review->updated_at->format('d/m/Y') }}
                        </td>
                        <td class="p-2">
                            <a class="block text-center text-sm font-semibold p-2 outline-none text-pink bg-white hover:bg-pink hover:text-white focus:bg-pink focus:text-white active:bg-pink-active transition-colors rounded"
                                href="{{ route('wedding-photographer.jadwal.ke_detail', $review->w_booking->id) }}">
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
