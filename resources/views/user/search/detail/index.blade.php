@extends('user.layout')

@section('title')
    <title>{{ $vendor->nama }} | Wedding Marketplace</title>
@endsection

@section('content')
    <div class="relative w-full p-4 flex items-start justify-center gap-4">
        {{-- container kiri --}}
        <div class="sticky top-4 w-1/4 mx-auto">
            {{-- BACK --}}
            <div class="relative w-full mb-2">
                <a class="block w-fit px-4 py-2 font-semibold outline-none text-pink bg-white hover:bg-pink hover:text-white focus:bg-pink focus:text-white active:bg-pink-active transition-colors rounded"
                    href="{{ route('user.search.vendor') }}">
                    <i class="fa-solid fa-arrow-left-long"></i>
                    <span>Kembali</span>
                </a>
            </div>

            {{-- data organizer --}}
            <div class="w-full">
                {{-- foto --}}
                <div class="w-full">
                    @if ($vendor->foto_profil)
                        <img class="w-full aspect-video object-cover object-center rounded-t-lg"
                            src="{{ asset($vendor->foto_profil) }}" alt="">
                    @else
                        <span class="w-full aspect-video bg-pink flex items-center justify-center text-[3em] font-bold text-white rounded-t-lg">
                            {{ substr($vendor->nama, 0, 1) }}
                        </span>
                    @endif
                </div>

                {{-- data lengkap --}}
                <div class="w-full p-2 text-sm">
                    <div class="w-full mb-2"> {{-- Nama --}}
                        <div class="w-full flex items-center justify-start gap-2">
                            <i class="fa-solid fa-user-tie text-pink"></i>
                            <p>Nama</p>
                        </div>
                        <div class="w-full px-6" id="namaOrganizer">
                            {{ $vendor->nama }}
                        </div>
                    </div>
                    <div class="w-full mb-2"> {{-- Telepon --}}
                        <div class="w-full flex items-center justify-start gap-2">
                            <i class="fa-solid fa-phone text-pink"></i>
                            <p>Telepon</p>
                        </div>
                        <div class="w-full px-6">
                            <span id="phoneNumber">
                                {{ $vendor->no_telp }}
                            </span>
                            <button class="w-fit ml-2 text-pink" id="copyPhoneNumberBtn">
                                <i class="fa-regular fa-clone"></i>
                            </button>
                        </div>
                    </div>
                    <div class="w-full mb-2"> {{-- Alamat --}}
                        @php
                            $urlAddress = 'https://www.google.com/maps/search/?api=1&query=' . urlencode($vendor->alamat);
                            if (!is_null($vendor->koordinat['lat']) && !is_null($vendor->koordinat['lng'])) {
                                $urlCoordinate = 'https://www.google.com/maps?q=' . $vendor->koordinat['lat'] . ',' . $vendor->koordinat['lng'];
                            } else {
                                $urlCoordinate = $urlAddress;
                            }
                        @endphp
                        <div class="w-full flex items-center justify-start gap-2">
                            <i class="fa-solid fa-location-dot text-pink"></i>
                            <p>Alamat</p>
                        </div>
                        <div class="w-full px-6">
                            <a class="hover:underline"
                                href="{{ $urlAddress }}" target="_blank">
                                {{ $vendor->alamat }}
                            </a>
                            <a class="w-fit ml-2 text-pink"
                                href="{{ $urlCoordinate }}" target="_blank">
                                <i class="fa-solid fa-square-arrow-up-right"></i>
                            </a>
                        </div>
                    </div>
                    <div class="w-full mb-2"> {{-- Basis Operasi --}}
                        <div class="w-full flex items-center justify-start gap-2">
                            <i class="fa-solid fa-circle-dot text-pink"></i>
                            <p>Basis Operasi</p>
                        </div>
                        <div class="w-full px-6">
                            {{ $vendor->basis_operasi }}
                        </div>
                    </div>
                    @if ($vendor->basis_operasi == 'Hanya di Dalam Kota')
                        <div class="w-full mb-2"> {{-- Kota Operasi --}}
                            <div class="w-full flex items-center justify-start gap-2">
                                <i class="fa-solid fa-location-crosshairs text-pink"></i>
                                <p>Kota Operasi</p>
                            </div>
                            <div class="w-full px-6">
                                {{ $vendor->kota_operasi }}
                            </div>
                        </div>
                    @endif
                    <div class="w-full mb-2"> {{-- Basis Operasi --}}
                        <div class="w-full mb-1 flex items-center justify-start gap-2">
                            <i class="fa-solid fa-user-tie text-pink"></i>
                            <p>Jenis Vendor</p>
                        </div>
                        <div class="w-full px-5 flex items-start justify-start flex-wrap gap-1">
                            @forelse ($vendor->jenis as $j_vendor)
                                <a class="w-fit px-2 py-1 flex items-center justify-center gap-2 text-xs border border-pink rounded font-semibold
                                    {{ $filterJenisVendor == $j_vendor->master->id ? 'bg-pink text-white' : 'bg-white text-pink' }}"
                                    href="{{ route('user.search.ke_detail', $vendor->id) }}?tab=layanan&jenis_vendor={{ $j_vendor->master->id }}">
                                    <i class="{{ $j_vendor->master->icon }}"></i>
                                    <span>
                                        {{ $j_vendor->master->nama }}
                                    </span>
                                </a>
                            @empty

                            @endforelse
                        </div>
                    </div>
                    <div class="w-full mt-8">
                        <div class="w-full flex items-center justify-center gap-2 mb-2">
                            @for ($i = 1; $i <= 5; $i++)
                                <i class="fa-solid fa-star {{ $vendor->rate >= $i ? 'text-pink' : '' }}"></i>
                            @endfor
                        </div>
                        <div class="w-full text-center">
                            {{ $vendor->rate > 0 ? number_format($vendor->rate, 1) : '-' }} dari 5
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- container kanan --}}
        <div class="w-3/4">
            {{-- TAB --}}
            <div class="w-full mb-2 flex items-center justify-start gap-4">
                <a class="w-fit px-4 py-2 font-semibold outline-none hover:bg-pink hover:text-white focus:bg-pink focus:text-white active:bg-pink-active transition-colors rounded
                {{ $tab == 'portofolio' ? 'bg-pink text-white' : 'text-pink bg-white' }}"
                    href="{{ route('user.search.ke_detail', $vendor->id) }}">
                    <span>Portofolio</span>
                </a>
                <a class="w-fit px-4 py-2 font-semibold outline-none hover:bg-pink hover:text-white focus:bg-pink focus:text-white active:bg-pink-active transition-colors rounded
                {{ ($tab == 'layanan' || $tab == 'booking') ? 'bg-pink text-white' : 'text-pink bg-white' }}"
                    href="{{ route('user.search.ke_detail', ['id' => $vendor->id, 'tab' => 'layanan']) }}">
                    <span>Layanan</span>
                </a>
            </div>

            {{-- KONTEN --}}
            <div class="w-full border-t-4 border-slate-100">
                @yield('item')
            </div>
        </div>
    </div>
@endsection

@push('child-js')
    <script>
        $(document).ready(function() {
            Fancybox.bind("[data-fancybox]");

            $('ul').addClass('list-disc pl-8');

            $('#copyPhoneNumberBtn').on('click', function() {
                const noTelp = $('#phoneNumber').text().trim();
                const tempInput = $('<textarea>');
                $('body').append(tempInput);
                tempInput.val(noTelp).select();
                document.execCommand('copy');
                tempInput.remove();
                toastr.success("Menyalin Nomor Telepon Vendor", "Sukses");
            });

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
        });
    </script>
@endpush
