@extends('user.wedding-couple.booking.wp.detail')

@section('item')
    @if (!$plans->isEmpty())
        <div class="w-full">
            {{-- detail paket layanan & form pemesanan atas --}}
            <div class="w-full my-2 grid grid-cols-2 gap-4">
                {{-- paket --}}
                @foreach ($plans as $plan)
                    {{-- detail paket --}}
                    <div class="flex-1 w-full h-full px-4 pt-2 mb-4 hidden detail-layanan"
                        id="detailLayanan-{{  $plan->id  }}">
                        {{-- nama --}}
                        <div class="w-full">
                            <span class="text-2xl font-semibold"
                                id="namaPlan">
                                {{ $plan->nama }}
                            </span>
                        </div>

                        {{-- fitur --}}
                        <div class="w-full max-h-[200px] overflow-y-auto px-4 my-2"
                            id="detailPlan">
                            {!! $plan->detail !!}
                        </div>

                        {{-- harga --}}
                        <div class="w-full mb-2 flex items-start justify-end gap-2">
                            <i class="fa-solid fa-rupiah-sign text-xl"></i>
                            <span class="">
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
                                        <button class="closeUlasanBtn w-fit px-4 aspect-square rounded outline-none bg-pink text-white hover:bg-pink-hover focus:bg-pink-hover active:bg-pink-active transition-colors"
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
                                        <button id="sort-button" class="w-fit px-2 aspect-square rounded outline-none bg-pink text-white hover:bg-pink-hover focus:bg-pink-hover active:bg-pink-active transition-colors"
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
                @endforeach

                {{-- form booking --}}
                @if (!$weddings->isEmpty())
                    <div class="flex-1 h-full p-4 bg-slate-100 rounded-lg">
                        <form action="{{ route('wedding-couple.search.wp.pesan') }}" method="post" id="bookingForm">
                            @csrf
                            <input class="hidden" type="text" name="plan_id" id="plan_id" value="{{ old('plan_id', '') }}">

                            <div class="w-full flex flex-col items-center justify-center gap-4">
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
                                        <button class="w-[30px] aspect-square flex items-center justify-center rounded bg-pink text-white outline-none
                                            hover:bg-pink-hover focus:bg-pink-hover active:bg-pink-active transition-colors qty-decrease"
                                            type="button">-</button>
                                        <input class="w-[7ch] pl-3 text-center border rounded outline-pink"
                                            type="number" inputmode="numeric" name="qty" id="qty" min="1" value="{{ old('qty', 1) }}">
                                        <button class="w-[30px] aspect-square flex items-center justify-center rounded bg-pink text-white outline-none
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
                            </div>
                        </form>
                    </div>
                @else
                    <div class="flex-1 w-full h-full bg-slate-100 rounded-lg flex items-center justify-center">
                        <a class="w-fit place-self-center px-4 py-2 rounded outline-none text-white bg-pink active:bg-pink-active transition-colors"
                            href="{{ route('wedding-couple.pernikahan.ke_tambah') }}">
                            <i class="fa-regular fa-envelope"></i>
                            Buat Pernikahan untuk memesan
                        </a>
                    </div>
                @endif
            </div>

            {{-- list paket layanan bawah --}}
            <div class="w-full mt-2 py-4 px-2 flex flex-nowrap items-start justify-start gap-4 overflow-x-auto">
                @foreach ($plans as $plan)
                    <button class="relative min-w-[200px] max-w-[200px] p-2 rounded text-start outline-none bg-white border-2 border-slate-100 shadow overflow-hidden hover:shadow-lg hover:-translate-y-2 focus:shadow-lg focus:-translate-y-2 active:shadow active:translate-y-0 transition-all paket-layanan-button"
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
        </div>
    @else
        <div class="w-full my-8 text-xl text-center">
            Tidak ada paket layanan
        </div>
    @endif
@endsection
