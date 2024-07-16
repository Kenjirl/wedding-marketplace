@extends('vendor.layout')

@section('title')
    <title>Ulasan | Wedding Marketplace</title>
@endsection

@section('h1', 'Ulasan')

@section('content')
    @php
        function renderStars($rating) {
            $fullStars = floor($rating);
            $halfStar = ($rating - $fullStars) >= 0.5 ? 1 : 0;
            $emptyStars = 5 - $fullStars - $halfStar;

            $stars = '';
            for ($i = 0; $i < $fullStars; $i++) {
                $stars .= '<i class="fa-solid fa-star"></i>';
            }
            for ($i = 0; $i < $halfStar; $i++) {
                $stars .= '<i class="fa-solid fa-star-half-stroke"></i>';
            }
            for ($i = 0; $i < $emptyStars; $i++) {
                $stars .= '<i class="fa-regular fa-star"></i>';
            }

            return $stars;
        }
    @endphp
    {{-- INFO ATAS --}}
    <div class="w-full flex items-start justify-center gap-8">
        <div class="min-w-[100px] text-sm">
            <div class="text-7xl font-semibold">
                {{ number_format($total['average'], 1) }}
            </div>
            <div class="text-yellow-400">
                {!! renderStars($total['average']) !!}
            </div>
            <div>
                {{ number_format($total['count'], 0, ',', '.') }}
            </div>
        </div>

        <div class="w-fit">
            @foreach ($ratingDetails as $rating => $details)
                <div class="w-full flex items-center justify-start gap-4">
                    <div class="w-[20px] text-center">
                        {{ $rating }}
                    </div>

                    @php
                        $width = $details['count']/$total['count']*100;
                    @endphp
                    <div class="w-full">
                        <div class="w-[200px] bg-gray-200 rounded-full h-2.5">
                            <div class="bg-pink h-2.5 rounded-full" style="width: {{ $width }}%"></div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <hr class="my-4">

    {{-- TABEL --}}
    <div class="w-full">
        <table class="w-full table-auto cell-border compact hover" id="dataTable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Oleh</th>
                    <th>Komentar</th>
                    <th class="whitespace-nowrap">Nama Layanan</th>
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
                        <td class="w-1/2 px-2"> {{-- Oleh --}}
                            <div class="line-clamp-1">
                                {{ $review->w_booking->wedding->w_couple->nama }}
                            </div>
                        </td>
                        <td class="w-1/2 px-2">
                            <div class="line-clamp-1">
                                {{ $review->komentar }}
                            </div>
                        </td>
                        <td class="w-1/2 px-2">
                            <div class="line-clamp-1">
                                {{ $review->plan->nama }}
                            </div>
                        </td>
                        <td class="px-2 text-center">
                            {{ $review->rating }}
                        </td>
                        <td class="px-2 text-center">
                            {{ \Carbon\Carbon::parse($review->updated_at)->translatedFormat('d F Y') }}
                        </td>
                        <td class="p-2">
                            <a class="block text-center text-sm font-semibold p-2 outline-none text-pink bg-white hover:bg-pink hover:text-white focus:bg-pink focus:text-white active:bg-pink-active transition-colors rounded"
                                href="{{ route('vendor.jadwal.ke_detail', $review->w_booking->id) }}">
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
