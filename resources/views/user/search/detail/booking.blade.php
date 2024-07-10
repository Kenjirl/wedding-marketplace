@extends('user.search.detail.index')

@section('item')
    <div class="w-full">
        {{-- detail paket layanan & form pemesanan atas --}}
        <div class="w-full my-2 grid grid-cols-2 gap-4">
            {{-- detail paket --}}
            <div class="flex-1 w-full h-full px-4 pt-2 mb-4"
                id="detailLayanan-{{  $plan->id  }}">
                {{-- nama --}}
                <div class="w-full">
                    <span class="text-2xl font-semibold"
                    id="namaPlan">
                        {{ $plan->nama }}
                    </span>
                </div>

                {{-- fitur --}}
                <div class="w-full max-h-[200px] overflow-y-auto px-4 my-2">
                    {!! $plan->detail !!}
                </div>

                @if ($plan->jenis_layanan == 'produk')
                    <hr class="my-4">

                    {{-- FOTO --}}
                    <div class="w-full flex items-center justify-start plan-gallery-container">
                        @foreach ($plan->foto as $index => $foto)
                            <a class="w-1/5 cursor-zoom-in" data-fancybox="gallery-{{ $plan->id }}" href="{{ asset($foto['url']) }}">
                                <img class="w-full aspect-square object-cover object-center"
                                    src="{{ asset($foto['url']) }}" alt="Foto Paket {{ $index+1 }}">
                            </a>
                        @endforeach
                    </div>
                @endif
                <hr class="my-4">

                {{-- harga --}}
                <div class="w-full mb-2 flex items-start justify-end gap-2">
                    <i class="fa-solid fa-rupiah-sign text-xl"></i>
                    <span>
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

            {{-- form booking --}}
            @if (!$weddings->isEmpty())
                <div class="flex-1 h-full p-4 bg-slate-100 rounded-lg">
                    <form action="{{ route('user.search.pesan') }}" method="post" id="bookingForm">
                        @csrf
                        <input class="hidden" type="text" name="plan_id" id="plan_id" value="{{ old('plan_id', $plan->id) }}">

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
                        href="{{ route('user.pernikahan.ke_tambah') }}">
                        <i class="fa-regular fa-envelope"></i>
                        Buat Pernikahan untuk memesan
                    </a>
                </div>
            @endif
        </div>
    </div>
@endsection

@push('child-js')
    <script>
        $(document).ready(function() {
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
                let organizer = $('#namaOrganizer').text();
                let plan      = @json($plan->nama);
                let wedding   = "Anda belum memilih pernikahan!";
                let tanggal   = "Anda belum memilih tanggal!";
                let qty       = $(`#qty`).val();

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
                                        ${organizer}
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
