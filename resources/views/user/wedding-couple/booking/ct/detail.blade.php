@extends('user.wedding-couple.layout')

@section('title')
    <title>{{ $catering->nama }} | Wedding Marketplace</title>
@endsection

@section('content')
    <div class="relative w-full p-4 flex items-start justify-center gap-4">
        {{-- container kiri --}}
        <div class="sticky top-4 w-1/4 mx-auto">
            {{-- BACK --}}
            <div class="relative w-full mb-2">
                <a class="block w-fit px-4 py-2 font-semibold outline-none text-pink bg-white hover:bg-pink hover:text-white focus:bg-pink focus:text-white active:bg-pink-active transition-colors rounded"
                    href="{{ route('wedding-couple.search.ct.index') }}">
                    <i class="fa-solid fa-arrow-left-long"></i>
                    <span>Kembali</span>
                </a>
            </div>
            {{-- data catering --}}
            <div class="w-full">
                {{-- foto --}}
                <div class="w-full">
                    @if ($catering->foto_profil)
                        <img class="w-full aspect-video object-cover object-center rounded-t-lg"
                            src="{{ asset($catering->foto_profil) }}" alt="">
                    @else
                        <span class="w-full aspect-video bg-pink flex items-center justify-center text-[3em] font-bold text-white rounded-t-lg">
                            {{ substr($catering->nama, 0, 1) }}
                        </span>
                    @endif
                </div>

                {{-- data lengkap --}}
                <div class="w-full p-2 text-sm">
                    <div class="w-full mb-2"> {{-- Vendor --}}
                        <p class="w-full text-center text-lg text-pink font-semibold">
                            Vendor Catering
                        </p>
                    </div>
                    <div class="w-full mb-2"> {{-- Nama --}}
                        <div class="w-full flex items-center justify-start gap-2">
                            <i class="fa-solid fa-user-tie text-pink"></i>
                            <p>Nama</p>
                        </div>
                        <div class="w-full px-6" id="namaCatering">
                            {{ $catering->nama }}
                        </div>
                    </div>
                    <div class="w-full mb-2"> {{-- Telepon --}}
                        <div class="w-full flex items-center justify-start gap-2">
                            <i class="fa-solid fa-phone text-pink"></i>
                            <p>Telepon</p>
                        </div>
                        <div class="w-full px-6">
                            {{ $catering->no_telp }}
                        </div>
                    </div>
                    <div class="w-full mb-2"> {{-- Alamat --}}
                        <div class="w-full flex items-center justify-start gap-2">
                            <i class="fa-solid fa-location-dot text-pink"></i>
                            <p>Alamat</p>
                        </div>
                        <div class="w-full px-6">
                            {{ $catering->alamat }}
                        </div>
                    </div>
                    <div class="w-full mb-2"> {{-- Basis Operasi --}}
                        <div class="w-full flex items-center justify-start gap-2">
                            <i class="fa-solid fa-circle-dot text-pink"></i>
                            <p>Basis Operasi</p>
                        </div>
                        <div class="w-full px-6">
                            {{ $catering->basis_operasi }}
                        </div>
                    </div>
                    @if ($catering->basis_operasi == 'Hanya di Dalam Kota')
                        <div class="w-full mb-2"> {{-- Kota Operasi --}}
                            <div class="w-full flex items-center justify-start gap-2">
                                <i class="fa-solid fa-location-crosshairs text-pink"></i>
                                <p>Kota Operasi</p>
                            </div>
                            <div class="w-full px-6">
                                {{ $catering->kota_operasi }}
                            </div>
                        </div>
                    @endif
                    <div class="w-full mt-8">
                        <div class="w-full flex items-center justify-center gap-2 mb-2">
                            @for ($i = 1; $i <= 5; $i++)
                                <i class="fa-solid fa-star {{ $catering->rate >= $i ? 'text-pink' : '' }}"></i>
                            @endfor
                        </div>
                        <div class="w-full text-center">
                            {{ $catering->rate > 0 ? number_format($catering->rate, 1) : '-' }} dari 5
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
                    href="{{ route('wedding-couple.search.ct.ke_detail', $catering->id) }}">
                    <span>Portofolio</span>
                </a>
                <a class="w-fit px-4 py-2 font-semibold outline-none hover:bg-pink hover:text-white focus:bg-pink focus:text-white active:bg-pink-active transition-colors rounded
                {{ $tab == 'layanan' ? 'bg-pink text-white' : 'text-pink bg-white' }}"
                    href="{{ route('wedding-couple.search.ct.ke_detail', ['id' => $catering->id, 'tab' => 'layanan']) }}">
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
                let catering = $('#namaCatering').text();
                let plan     = $(`#planBtn-${$('#plan_id').val()} span`).text();
                let wedding  = "Anda belum memilih pernikahan!";
                let tanggal  = "Anda belum memilih tanggal!";
                let qty      = $(`#qty`).val();

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
                                        ${catering}
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
