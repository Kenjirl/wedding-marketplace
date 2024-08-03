@extends('vendor.layout')

@section('title')
    <title>Ulasan | Wedding Marketplace</title>
@endsection

@section('h1', 'Ulasan')

@php
    $fullStars = $total['average'] ? floor($total['average']) : 0;
    $halfStar = ($total['average'] - $fullStars) >= 0.5 ? 1 : 0;
    $emptyStars = 5 - $fullStars - $halfStar;
@endphp

@section('content')
    <div class="w-full flex items-start justify-center gap-4">
        {{-- LIST --}}
        @if ($tab == 'list')
            <div class="flex-1 w-full grid grid-cols-3 gap-4">
                @forelse ($reviews as $review)
                    <a class="w-full h-fit block bg-slate-100 rounded-xl text-center outline-pink shadow-none hover:shadow-md focus:shadow-md transition-shadow"
                        href="{{ route('vendor.jadwal.ke_detail', $review->w_booking->id) }}">
                        <div class="w-full p-2 rounded-t-xl font-semibold">
                            {{ $review->w_booking->wedding->w_couple->nama }}
                        </div>
                        <div class="w-full px-1 text-sm">
                            <div class="w-full h-full p-2 bg-white rounded">
                                <div class="w-full flex items-center justify-center gap-1 text-yellow-400">
                                    @for ($i = 1; $i <= $review->rating; $i++)
                                        <i class="fa-solid fa-star"></i>
                                    @endfor
                                    @for ($i = 1; $i <= (5-$review->rating); $i++)
                                        <i class="fa-regular fa-star"></i>
                                    @endfor
                                </div>
                                <div class="w-full h-4"></div>
                                <p class="break-words">
                                    {{ $review->komentar }}
                                </p>
                            </div>
                        </div>
                        <div class="w-full p-2 rounded-b-xl text-end font-semibold italic text-sm">
                            {{ \Carbon\Carbon::parse($review->updated_at)->translatedFormat('d-m-Y') }}
                        </div>
                    </a>
                @empty
                    <div class="w-full">Belum ada ulasan</div>
                @endforelse
            </div>
        @endif

        {{-- TABEL --}}
        @if ($tab == 'table')
            <div class="flex-1 w-full rounded-lg shadow border">
                <div class="w-full p-4 font-semibold border-b-2">
                    <span>
                        Daftar Ulasan
                    </span>
                </div>
                <div class="w-full mx-auto p-4">
                    <table class="w-full display table-auto cell-border compact hover" id="dataTable">
                        <thead>
                            <tr class="border-t">
                                <th>No</th>
                                <th>Oleh</th>
                                <th>Komentar</th>
                                <th>Nilai</th>
                                <th>Tanggal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($reviews as $review)
                                <tr class="border-b">
                                    <td class="text-center">
                                        {{ $loop->iteration }}
                                    </td>
                                    <td class="w-1/2 px-2"> {{-- Oleh --}}
                                        <div class="line-clamp-1">
                                            {{ $review->w_booking->wedding->w_couple->nama }}
                                        </div>
                                    </td>
                                    <td class="w-1/2 px-2">
                                        <p class="w-full break-words line-clamp-1">
                                            {{ Str::limit($review->komentar, 30) }}
                                        </p>
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
            </div>
        @endif

        {{-- KIRI --}}
        <div class="w-[250px] sticky top-0">
            {{-- RATING --}}
            <div class="min-w-[100px] mx-auto text-center text-sm">
                <div class="text-7xl font-semibold">
                    {{ number_format($total['average'], 1) }}
                </div>
                <div class="text-yellow-400">
                    @for ($i = 0; $i < $fullStars; $i++)
                        <i class="fa-solid fa-star"></i>
                    @endfor
                    @for ($i = 0; $i < $halfStar; $i++)
                        <i class="fa-solid fa-star-half-stroke"></i>
                    @endfor
                    @for ($i = 0; $i < $emptyStars; $i++)
                        <i class="fa-regular fa-star"></i>
                    @endfor
                </div>
                <div>
                    {{ number_format($total['count'], 0, ',', '.') }}
                </div>
            </div>

            <hr class="my-4">

            {{-- NILAI --}}
            <div class="w-fit mx-auto">
                @foreach ($ratingDetails as $rating => $details)
                    <div class="w-full flex items-center justify-start gap-4">
                        <div class="w-[20px] text-center">
                            {{ $rating }}
                        </div>

                        @php
                            $width = $total['count'] != 0 ? $details['count']/$total['count']*100 : 0;
                        @endphp
                        <div class="w-full">
                            <div class="w-[200px] bg-gray-200 rounded-full h-2.5">
                                <div class="bg-pink h-2.5 rounded-full" style="width: {{ $width }}%"></div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <hr class="my-4">

            {{-- TAB --}}
            <div class="w-full mb-2 flex items-center justify-end gap-2">
                <a class="w-[30px] aspect-square flex items-center justify-center {{ $tab == 'list' ? 'bg-pink text-white' : 'bg-white text-pink' }} outline-pink border border-pink rounded active:bg-pink-active active:text-white transition-colors"
                    href="{{ route('vendor.ulasan.index', ['jenis_id' => $jenis_id, 'tab' => 'list', 'search_rate' => $search_rate]) }}">
                    <i class="fa-solid fa-table-cells-large"></i>
                </a>
                <a class="w-[30px] aspect-square flex items-center justify-center {{ $tab == 'table' ? 'bg-pink text-white' : 'bg-white text-pink' }} outline-pink border border-pink rounded active:bg-pink-active active:text-white transition-colors"
                    href="{{ route('vendor.ulasan.index', ['jenis_id' => $jenis_id, 'tab' => 'table', 'search_rate' => $search_rate]) }}">
                    <i class="fa-solid fa-table-list"></i>
                </a>
            </div>

            {{-- FILTER JENIS VENDOR --}}
            <div class="w-full mb-2 flex flex-wrap items-start justify-end gap-2">
                <a class="block w-fit px-2 py-1 border border-pink outline-pink {{ $jenis_id == null ? 'bg-pink text-white' : 'bg-white text-pink' }} text-sm font-semibold rounded active:bg-pink-active active:text-white transition-colors"
                    href="{{ route('vendor.ulasan.index', ['tab' => $tab, 'search_rate' => $search_rate]) }}">
                    All
                </a>
                @forelse ($j_vendor as $jenis)
                    <a class="block w-fit px-2 py-1 border border-pink outline-pink {{ $jenis_id == $jenis->m_jenis_vendor_id ? 'bg-pink text-white' : 'bg-white text-pink' }} text-sm font-semibold rounded active:bg-pink-active active:text-white transition-colors"
                        href="{{ route('vendor.ulasan.index', ['jenis_id' => $jenis->m_jenis_vendor_id, 'tab' => $tab, 'search_rate' => $search_rate]) }}">
                        {{ $jenis->master->nama }}
                    </a>
                @empty
                @endforelse
            </div>

            {{-- FILTER RATE --}}
            <div class="w-full flex flex-wrap items-start justify-end gap-2">
                <a class="block w-fit px-2 py-1 border border-pink outline-pink {{ $search_rate == null ? 'bg-pink text-white' : 'bg-white text-pink' }} text-sm font-semibold rounded active:bg-pink-active active:text-white transition-colors"
                    href="{{ route('vendor.ulasan.index', ['jenis_id' => $jenis_id, 'tab' => $tab]) }}">
                    All
                </a>
                @for ($i = 1; $i <= 5; $i++)
                    <a class="w-[30px] aspect-square flex items-center justify-center border border-pink outline-pink {{ $search_rate == $i ? 'bg-pink text-white' : 'bg-white text-pink' }} text-sm font-semibold rounded active:bg-pink-active active:text-white transition-colors"
                        href="{{ route('vendor.ulasan.index', ['jenis_id' => $jenis_id, 'tab' => $tab, 'search_rate' => $i]) }}">
                        {{ $i }}
                    </a>
                @endfor
            </div>
        </div>
    </div>
@endsection
