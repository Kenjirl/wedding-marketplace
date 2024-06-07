@extends('user.wedding-couple.layout')

@section('title')
    <title>{{ $photographer->nama }} | Wedding Marketplace</title>
@endsection

@section('content')
    <div class="relative w-full p-8 flex items-start justify-center gap-4">
        {{-- container kiri --}}
        <div class="sticky top-4 w-1/3 mx-auto">
            {{-- BACK --}}
            <div class="relative w-full mb-4">
                <a class="block w-fit px-4 py-2 font-semibold outline-none text-pink bg-white hover:bg-pink hover:text-white focus:bg-pink focus:text-white active:bg-pink-active transition-colors rounded"
                    href="{{ route('wedding-couple.search.wp.index') }}">
                    <i class="fa-solid fa-arrow-left-long"></i>
                    <span>Kembali</span>
                </a>
            </div>

            {{-- data photographer --}}
            <div class="w-full">
                {{-- foto --}}
                <div class="w-full">
                    @if ($photographer->foto_profil)
                        <img class="w-full aspect-video object-cover object-center rounded-t-lg"
                            src="{{ asset($photographer->foto_profil) }}" alt="">
                    @else
                        <span class="w-full aspect-video bg-pink flex items-center justify-center text-[5em] font-bold text-white rounded-t-lg">
                            {{ substr($photographer->nama, 0, 1) }}
                        </span>
                    @endif
                </div>

                {{-- data lengkap --}}
                <div class="w-full p-2 text-sm">
                    <div class="w-full mb-2"> {{-- Vendor --}}
                        <p class="w-full text-center text-lg text-pink font-semibold">
                            Fotografer
                        </p>
                    </div>
                    <div class="w-full mb-2"> {{-- Nama --}}
                        <div class="w-full flex items-center justify-start gap-2">
                            <i class="fa-solid fa-user-tie text-pink"></i>
                            <p>Nama</p>
                        </div>
                        <div class="w-full px-6" id="namaFotografer">
                            {{ $photographer->nama }}
                        </div>
                    </div>
                    <div class="w-full mb-2"> {{-- Telepon --}}
                        <div class="w-full flex items-center justify-start gap-2">
                            <i class="fa-solid fa-phone text-pink"></i>
                            <p>Telepon</p>
                        </div>
                        <div class="w-full px-6">
                            {{ $photographer->no_telp }}
                        </div>
                    </div>
                    <div class="w-full mb-2"> {{-- Alamat --}}
                        <div class="w-full flex items-center justify-start gap-2">
                            <i class="fa-solid fa-location-dot text-pink"></i>
                            <p>Alamat</p>
                        </div>
                        <div class="w-full px-6">
                            {{ $photographer->alamat }}
                        </div>
                    </div>
                    <div class="w-full mb-2"> {{-- Basis Operasi --}}
                        <div class="w-full flex items-center justify-start gap-2">
                            <i class="fa-solid fa-circle-dot text-pink"></i>
                            <p>Basis Operasi</p>
                        </div>
                        <div class="w-full px-6">
                            {{ $photographer->basis_operasi }}
                        </div>
                    </div>
                    @if ($photographer->basis_operasi == 'Hanya di Dalam Kota')
                        <div class="w-full mb-2"> {{-- Kota Operasi --}}
                            <div class="w-full flex items-center justify-start gap-2">
                                <i class="fa-solid fa-location-crosshairs text-pink"></i>
                                <p>Kota Operasi</p>
                            </div>
                            <div class="w-full px-6">
                                {{ $photographer->kota_operasi }}
                            </div>
                        </div>
                    @endif
                    <div class="w-full mt-8">
                        <div class="w-full flex items-center justify-center gap-2 mb-2">
                            @for ($i = 1; $i <= 5; $i++)
                                <i class="fa-solid fa-star {{ $photographer->rate >= $i ? 'text-pink' : '' }}"></i>
                            @endfor
                        </div>
                        <div class="w-full text-center">
                            {{ $photographer->rate > 0 ? number_format($photographer->rate, 1) : '-' }} dari 5
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- container kanan --}}
        <div class="w-full">
            {{-- TAB --}}
            <div class="w-full mb-4 flex items-center justify-start gap-4">
                <a class="w-fit px-4 py-2 font-semibold outline-none hover:bg-pink hover:text-white focus:bg-pink focus:text-white active:bg-pink-active transition-colors rounded
                {{ $tab == 'portofolio' ? 'bg-pink text-white' : 'text-pink bg-white' }}"
                    href="{{ route('wedding-couple.search.wp.ke_detail', $photographer->id) }}">
                    <span>Portofolio</span>
                </a>
                <a class="w-fit px-4 py-2 font-semibold outline-none hover:bg-pink hover:text-white focus:bg-pink focus:text-white active:bg-pink-active transition-colors rounded
                {{ $tab == 'layanan' ? 'bg-pink text-white' : 'text-pink bg-white' }}"
                    href="{{ route('wedding-couple.search.wp.ke_detail', ['id' => $photographer->id, 'tab' => 'layanan']) }}">
                    <span>Layanan</span>
                </a>
            </div>

            @if ($tab != 'layanan')
            {{-- container portofolio --}}
            <div class="w-full border-t-4 border-slate-100">
                @if ($portofolio_detail)
                    {{-- portofolio --}}
                    <div class="w-full my-4">
                        {{-- detail portofolio --}}
                        <div class="w-full flex items-start justify-between gap-2">
                            {{-- detail foto portofolio --}}
                            <div class="flex-1 w-full p-2 bg-slate-100 rounded-lg">
                                {{-- foto besar --}}
                                <div class="w-full aspect-[3/2] flex items-center justify-center" id="foto_besar">
                                    @foreach ($portofolio_detail->foto as $index => $foto)
                                        <a class="{{ $loop->index == 0 ? '' : 'hidden' }} bg-white"
                                            href="{{ asset($foto['url']) }}" data-fancybox="gallery" id="zoom-photo-{{ $loop->index }}">
                                            <img class="w-full h-[400px] object-contain rounded-md bg-white"
                                                src="{{ asset($foto['url']) }}" alt="Foto portofolio {{ $loop->iteration }}">
                                        </a>
                                    @endforeach
                                </div>

                                {{-- foto kecil --}}
                                <div class="w-full mt-2 flex items-start justify-center gap-2 overflow-x-auto">
                                    @foreach ($portofolio_detail->foto as $index => $foto)
                                        <button class="w-[50px] p-1 flex items-center justify-center rounded outline-none bg-white hover:bg-slate-500 focus:bg-slate-500 active:bg-slate-300 transition-colors foto-kecil"
                                            type="button" data-index="{{ $loop->index }}">
                                            <img class="w-full aspect-square object-contain" src="{{ asset($foto['url']) }}" alt="Foto portofolio {{ $loop->iteration }}">
                                        </button>
                                    @endforeach
                                </div>
                            </div>

                            {{-- detail portofolio --}}
                            <div class="flex-1 w-full px-4 pb-4">
                                <h2 class="text-2xl font-semibold">
                                    {{ $portofolio_detail->judul }}
                                </h2>
                                <table>
                                    <tbody>
                                        <tr>
                                            <td class="text-center align-top"><i class="fa-regular fa-calendar"></i></td>
                                            <td class="align-top">Tanggal</td>
                                            <td class="align-top px-2">:</td>
                                            <td class="align-top">{{ $portofolio_detail->tanggal }}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-center align-top"><i class="fa-solid fa-info"></i></td>
                                            <td class="align-top">Detail</td>
                                            <td class="align-top px-2">:</td>
                                            <td class="align-top">{!! $portofolio_detail->detail !!}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-center align-top"><i class="fa-solid fa-location-dot"></i></td>
                                            <td class="align-top">Lokasi</td>
                                            <td class="align-top px-2">:</td>
                                            <td class="align-top">{{ $portofolio_detail->lokasi }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        {{-- list portofolio --}}
                        <div class="w-full p-4 pb-0">
                            <div class="w-full">
                                <i class="fa-solid fa-grip"></i>
                                <span class="font-semibold">
                                    Portofolio Lainnya
                                </span>
                            </div>

                            <div class="w-full py-4 flex flex-nowrap items-start justify-start gap-4 overflow-x-auto">
                                {{-- item portofolio --}}
                                @forelse ($portofolios as $portofolio)
                                    <button class="w-[200px] min-w-[200px] rounded-lg outline-none bg-white shadow text-start hover:shadow-lg focus:shadow-lg active:shadow transition-all"
                                        type="button" onclick="setPortofolioId({{ $portofolio->id }})">
                                        <div class="w-full">
                                            <div class="w-full">
                                                <img class="w-full rounded-t-lg aspect-video object-cover object-center"
                                                    src="{{ asset($portofolio->foto[0]['url']) }}" alt="">
                                            </div>

                                            <div class="w-full p-2">
                                                <div>
                                                    <span class="line-clamp-1">{{ $portofolio->judul }}</span>
                                                </div>

                                                <div class="text-sm">
                                                    <span>{{ $portofolio->tanggal }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </button>
                                @empty

                                @endforelse
                            </div>
                        </div>
                    </div>

                    {{-- form ganti portofolio --}}
                    <div class="hidden">
                        <form action="{{ route('wedding-couple.search.wp.ke_detail', $photographer->id) }}" method="get" id="portofolioForm">
                            @csrf
                            <input type="text" name="portofolio_id" id="portofolio_id">
                        </form>
                    </div>
                @else
                    <div class="w-full my-8 text-xl text-center">
                        Tidak ada portofolio
                    </div>
                @endif
            </div>

            @else
            {{-- container paket layanan --}}
            <div class="w-full border-t-4 border-slate-100">
                @if (!$plans->isEmpty())
                    <div class="w-full flex items-start justify-start gap-6">
                        {{-- list paket layanan kiri --}}
                        <div class="flex-1 w-full max-h-[600px] grid grid-cols-2 gap-4 pr-2 py-4 overflow-y-auto">
                            @foreach ($plans as $plan)
                                <button class="relative w-full p-2 rounded text-start outline-none bg-white border-2 border-slate-100 shadow overflow-hidden hover:shadow-lg hover:-translate-y-2 focus:shadow-lg focus:-translate-y-2 active:shadow active:translate-y-0 transition-all paket-layanan-button"
                                    type="button" data-plan-id="{{ $plan->id }}" id="planBtn-{{ $plan->id }}">
                                    {{-- nama --}}
                                    <div class="w-full mb-4 flex items-center justify-start gap-2 font-semibold">
                                        <span class="flex-1 w-full line-clamp-1 text-lg">
                                            {{ $plan->nama }}
                                        </span>
                                    </div>

                                    {{-- harga --}}
                                    <div class="w-full mb-2 text-end">
                                        <i class="fa-solid fa-rupiah-sign"></i>
                                        {{ number_format($plan->harga, 0, ',', '.') }}
                                    </div>

                                    {{-- rate --}}
                                    <div class="w-full text-end">
                                        <p class="text-sm">
                                            <i class="fa-solid fa-star text-pink"></i>
                                            {{ $plan->rate > 0 ? number_format($plan->rate, 1, ',') : '-' }}/5
                                        </p>
                                    </div>

                                    <div class="absolute bottom-0 left-0 w-fit aspect-square p-2 flex items-center justify-center rounded-tr-sm bg-pink">
                                        <i class="fa-solid fa-gift text-sm text-white"></i>
                                    </div>
                                </button>
                            @endforeach
                        </div>

                        {{-- detail paket layanan kanan --}}
                        <div class="flex-1 w-full mt-4 shadow rounded-lg border-2 border-slate-100">
                            @forelse ($plans as $plan)
                                {{-- detail paket --}}
                                <div class="w-full px-4 pt-2 mb-4 hidden detail-layanan"
                                    id="detailLayanan-{{ $plan->id }}">
                                    {{-- nama --}}
                                    <div class="w-full">
                                        <span class="text-4xl font-semibold">
                                            {{ $plan->nama }}
                                        </span>
                                    </div>

                                    {{-- fitur --}}
                                    <div class="w-full max-h-[200px] overflow-y-auto px-4 my-2"
                                        id="detailPlan">
                                        {!! $plan->detail !!}
                                    </div>

                                    {{-- harga --}}
                                    <div class="w-full flex items-start justify-end gap-2">
                                        <i class="fa-solid fa-rupiah-sign text-2xl"></i>
                                        <span class="text-xl">
                                            {{ number_format($plan->harga, 0, ',', '.') }}/{{ $plan->satuan }}
                                        </span>
                                    </div>

                                    {{-- rate --}}
                                    <div class="w-full text-end text-sm">
                                        <p class="mb-2">
                                            @if ($plan->count > 0)
                                                {{ $plan->count }} dipesan |
                                            @endif
                                            <i class="fa-solid fa-star text-pink"></i>
                                            {{ $plan->rate > 0 ? number_format($plan->rate, 1, ',') : '-' }}/5
                                        </p>
                                        @if ($plan->rate > 0)
                                            <button class="w-fit text-slate-400 openUlasanBtn"
                                                type="button" id="openUlasanBtn" data-id="{{ $plan->id }}">
                                                lihat ulasan ({{ $plan->ulasanCount }})
                                            </button>
                                        @endif
                                    </div>
                                </div>

                                {{-- ULASAN MODAL --}}
                                @if ($plan->rate > 0)
                                    <div class="fixed top-full left-0 w-full h-screen flex items-center justify-center bg-slate-500/50 z-10 transition-all duration-500"
                                        id="ulasanModal-{{ $plan->id }}">
                                        <div class="w-[80%] max-w-[1200px] bg-white rounded-md">
                                            {{-- ATAS --}}
                                            <div class="w-full p-4 flex items-center justify-between">
                                                <div>
                                                    <span class="text-xl font-semibold">
                                                        Ulasan Paket Layanan : {{ $plan->nama }}
                                                    </span>
                                                </div>

                                                {{-- TOMBOL CLOSE MODAL --}}
                                                <div>
                                                    <button class="closeUlasanBtn w-fit px-4 aspect-square rounded outline-pink outline-offset-4 bg-pink text-white hover:bg-pink-hover focus:bg-pink-hover active:bg-pink-active transition-colors"
                                                        type="button" tabindex="-1" data-id="{{ $plan->id }}">
                                                        <i class="fa-solid fa-xmark"></i>
                                                    </button>
                                                </div>
                                            </div>

                                            {{-- KONTEN --}}
                                            <div id="ratings-container" class="w-full h-[70vh] overflow-y-auto p-4 grid grid-cols-4 gap-4 auto-rows-min items-start border-y-2">
                                                @forelse ($plan->bookings as $booking)
                                                    @if ($booking->rating)
                                                        <div class="w-full p-2 rounded-lg shadow-lg text-sm booking-item" data-rating="{{ $booking->rating->rating }}">
                                                            <div class="w-full flex items-center justify-center gap-2 mb-2">
                                                                @for ($i = 1; $i <= 5; $i++)
                                                                    <i class="fa-solid fa-star {{ $booking->rating->rating >= $i ? 'text-pink' : '' }}"></i>
                                                                @endfor
                                                            </div>
                                                            <div class="w-full min-h-[100px] p-2 rounded bg-gray-100 text-justify">
                                                                {{ $booking->rating->komentar }}
                                                            </div>
                                                        </div>
                                                    @endif
                                                @empty
                                                @endforelse
                                            </div>

                                            {{-- BAWAH --}}
                                            <div class="w-full p-4 flex items-center justify-end gap-2">
                                                <div>
                                                    <span>Urutkan berdasarkan : Rating</span>
                                                    <span id="sort-order">terbesar</span>
                                                </div>
                                                <div>
                                                    <button id="sort-button" class="w-fit px-2 aspect-square rounded outline-pink outline-offset-4 bg-pink text-white hover:bg-pink-hover focus:bg-pink-hover active:bg-pink-active transition-colors"
                                                        type="button">
                                                        <div>
                                                            <i class="fa-solid fa-arrow-down-wide-short"></i>
                                                        </div>
                                                        <div class="hidden">
                                                            <i class="fa-solid fa-arrow-down-short-wide"></i>
                                                        </div>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @empty

                            @endforelse

                            {{-- form booking --}}
                            <div class="w-full px-4 py-2 border-t-2 border-slate-100">
                                <form action="{{ route('wedding-couple.search.wp.pesan') }}" method="post" id="bookingForm">
                                    @csrf
                                    <input class="hidden" type="text" name="plan_id" id="plan_id" value="{{ old('plan_id', '') }}">

                                    <div class="w-full flex flex-col items-end justify-start gap-4">
                                        @if (!$weddings->isEmpty())
                                            {{-- PERNIKAHAN --}}
                                            <div class="w-full mb-4">
                                                <div class="w-full flex">
                                                    <div class="w-10 aspect-square p-2 bg-pink text-white text-sm flex items-center justify-center rounded-s">
                                                        <i class="fa-solid fa-dove"></i>
                                                    </div>
                                                    <select class="w-full p-2 text-sm appearance-none outline-none text-slate-500 border-2 border-s-0 focus:border-pink rounded-e"
                                                        name="wedding_id" id="wedding_id">
                                                        <option value="" selected>
                                                            Pilih Pernikahan
                                                        </option>

                                                        @foreach ($weddings as $wedding)
                                                            <option value="{{ $wedding->id }}" {{ old('wedding_id') == $wedding->id ? 'selected' : '' }}>
                                                                {{ 'Tn. ' . $wedding->p_sapaan . ' & Ny. ' . $wedding->w_sapaan }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="mt-1 text-sm text-red-500 flex items-center justify-start gap-2">
                                                    @error('wedding_id')
                                                        <i class="fa-solid fa-circle-info"></i>
                                                        <span>{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            {{-- TANGGAL --}}
                                            @php
                                                $tomDate = new DateTime('tomorrow');
                                            @endphp
                                            <div class="w-full mb-4">
                                                <div class="w-full flex">
                                                    <div class="w-10 aspect-square p-2 bg-pink text-white text-sm flex items-center justify-center rounded-s">
                                                        <i class="fa-regular fa-calendar"></i>
                                                    </div>
                                                    <input class="w-full p-2 flex-1 text-sm border-y-2 border-e-2 rounded-e focus:border-pink focus:outline-none"
                                                        type="date" name="tanggal" id="tanggal" placeholder="tanggal" min="{{ $tomDate->format('Y-m-d') }}"
                                                        required
                                                        value="{{ old('tanggal') }}">
                                                </div>
                                                <div class="mt-1 text-sm text-red-500 flex items-center justify-start gap-2">
                                                    @error('tanggal')
                                                        <i class="fa-solid fa-circle-info"></i>
                                                        <span>{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="w-full mb-4">
                                                <div class="w-full flex items-center justify-end gap-2">
                                                    <span>Jumlah Pesanan : </span>
                                                    <button class="w-[30px] aspect-square flex items-center justify-center rounded bg-pink text-white outline-pink outline-offset-4
                                                        hover:bg-pink-hover focus:bg-pink-hover active:bg-pink-active transition-colors qty-decrease"
                                                        type="button">-</button>
                                                    <input class="w-[7ch] pl-3 text-center border rounded outline-pink"
                                                        type="number" inputmode="numeric" name="qty" id="qty" min="1" value="{{ old('qty', 1) }}">
                                                    <button class="w-[30px] aspect-square flex items-center justify-center rounded bg-pink text-white outline-pink outline-offset-4
                                                        hover:bg-pink-hover focus:bg-pink-hover active:bg-pink-active transition-colors qty-increase"
                                                        type="button">+</button>
                                                </div>
                                                <div class="mt-1 text-sm text-red-500 flex items-center justify-end gap-2">
                                                    @error('qty')
                                                        <i class="fa-solid fa-circle-info"></i>
                                                        <span>{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            {{-- Button Submit --}}
                                            <button class="w-fit px-4 py-2 rounded outline-none bg-pink text-white hover:bg-pink-hover focus:bg-pink-hover active:bg-pink-active transition-colors"
                                                type="button" id="bookingBtn">
                                                Pesan
                                            </button>
                                        @else
                                            <a class="w-fit px-4 py-2 rounded outline-none text-pink hover:bg-pink hover:text-white focus:bg-pink focus:text-white active:bg-pink-active transition-colors"
                                                href="{{ route('wedding-couple.pernikahan.ke_tambah') }}">
                                                <i class="fa-regular fa-envelope"></i>
                                                Buat Pernikahan untuk memesan
                                            </a>
                                        @endif
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="w-full my-8 text-xl text-center">
                        Tidak ada paket layanan
                    </div>
                @endif
            </div>
            @endif
        </div>
    </div>
@endsection

@push('child-js')
    <script>
        // Ganti Portofolio
        function setPortofolioId(portofolioId) {
            $('#portofolio_id').val(portofolioId);
            $('#portofolioForm').submit();
        }

        $(document).ready(function() {
            Fancybox.bind("[data-fancybox]");

            $('ul').addClass('list-disc pl-8');

            // Ganti Foto Portofolio
            $('.foto-kecil').on('click', function() {
                let index = $(this).data('index');
                $('#foto_besar a').addClass('hidden');
                $('#zoom-photo-' + index).removeClass('hidden');
            });

            // Ganti Paket Layanan
            $('.paket-layanan-button').on('click', function() {
                let planId = $(this).data('plan-id');

                $('.paket-layanan-button').removeClass('border-pink').addClass('border-slate-100');
                $(this).removeClass('border-slate-100').addClass('border-pink');

                $('.detail-layanan').addClass('hidden');

                $('#detailLayanan-' + planId).removeClass('hidden');

                $('#plan_id').val(planId);
            });

            // PILIH PAKET LAYANAN KETIKA HALAMAN DI-LOAD
            // JIKA ADA NILAI OLD PADA PLAN ID
            if ($('#plan_id').val()) {
                // KLIK BUTTON DENGAN ID YANG SESUAI
                let btnId = $('#plan_id').val();
                $(`#planBtn-${btnId}`).click();
            } else {
                // KLIK BUTTON PERTAMA
                $('.paket-layanan-button:first').click();
            }

            $('#detailPlan ul').addClass('list-disc px-4');

            // ULASAN MODAL
            $('.openUlasanBtn').on('click', function() {
                const modalId = $(this).data('id');
                $(`#ulasanModal-${modalId}`).removeClass('top-full').addClass('top-0');
                $(`#ulasanModal-${modalId} button`).attr('tabindex', 0);
                $(`#ulasanModal-${modalId} a`).attr('tabindex', 0);
            });
            $('.closeUlasanBtn').on('click', function() {
                const modalId = $(this).data('id');
                $(`#ulasanModal-${modalId}`).removeClass('top-0').addClass('top-full');
                $(`#ulasanModal-${modalId} button`).attr('tabindex', -1);
                $(`#ulasanModal-${modalId} a`).attr('tabindex', -1);
            });

            // URUTKAN DATA ULASAN
            $('#sort-button').on('click', function() {
                let container = $('#ratings-container');
                let items = $('.booking-item');
                let sortOrder = $('#sort-order').text();

                let sortedItems = items.sort(function(a, b) {
                    let ratingA = parseInt($(a).data('rating'));
                    let ratingB = parseInt($(b).data('rating'));
                    if (sortOrder === 'terbesar') {
                        return ratingA - ratingB; // Ascending
                    } else {
                        return ratingB - ratingA; // Descending
                    }
                });

                container.empty().append(sortedItems);

                if (sortOrder === 'terbesar') {
                    $('#sort-order').text('terkecil');
                } else {
                    $('#sort-order').text('terbesar');
                }

                $('#sort-button div').toggleClass('hidden');
            });

            // SET QTY
            $('.qty-decrease').on('click', function() {
                let $qty = $('#qty');
                let currentVal = parseInt($qty.val());
                if (currentVal > 1) {
                    $qty.val(currentVal - 1);
                }
            });
            $('.qty-increase').on('click', function() {
                let $qty = $('#qty');
                let currentVal = parseInt($qty.val());
                $qty.val(currentVal + 1);
            });

            $('#bookingBtn').on('click', function() {
                let fotografer = $('#namaFotografer').text();
                let plan       = $(`#planBtn-${$('#plan_id').val()} span`).text();
                let wedding    = "Anda belum memilih pernikahan!";
                let tanggal    = "Anda belum memilih tanggal!";
                let qty        = $(`#qty`).val();

                if ($('#wedding_id').val() != '') {
                    wedding = `Pernikahan ${$(`#wedding_id option[value='${$('#wedding_id').val()}']`).text()}`;
                }

                if ($('#tanggal').val() != '') {
                    tanggal = $('#tanggal').val();
                }

                Swal.fire({
                    title: "Yakin ingin melakukan pemesanan?",
                    icon: "info",
                    iconColor: "#F78CA2",
                    html: `
                        <table>
                            <tbody>
                                <tr>
                                    <td class="text-start align-top whitespace-nowrap">
                                        Nama
                                    </td>
                                    <td class="align-top"> : </td>
                                    <td class="text-start align-top">
                                        ${fotografer}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-start align-top whitespace-nowrap">
                                        Paket
                                    </td>
                                    <td class="align-top"> : </td>
                                    <td class="text-start align-top">
                                        ${plan}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-start align-top whitespace-nowrap">
                                        Untuk
                                    </td>
                                    <td class="align-top"> : </td>
                                    <td class="text-start align-top">
                                        ${wedding}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-start align-top whitespace-nowrap">
                                        Pada
                                    </td>
                                    <td class="align-top"> : </td>
                                    <td class="text-start align-top">
                                        ${tanggal}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-start align-top whitespace-nowrap">
                                        Jumlah
                                    </td>
                                    <td class="align-top"> : </td>
                                    <td class="text-start align-top">
                                        ${qty}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    `,
                    showCloseButton: true,
                    confirmButtonColor: "#F78CA2",
                    confirmButtonText: "Konfirmasi"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#bookingForm').submit();
                    }
                });
            });
        });
    </script>
@endpush
