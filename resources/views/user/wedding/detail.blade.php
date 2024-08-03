@extends('user.layout')

@section('title')
    <title>Detail Pernikahan | Wedding Marketplace</title>
@endsection

@php
    $statusClasses = [
        'ditolak'  => ['red-400', 'fa-circle-xmark'],
        'diterima' => ['blue-400', 'fa-circle-check'],
        'selesai'  => ['green-400', 'fa-circle-check'],
        'dibayar'  => ['green-400', 'fa-circle-check'],
    ];
    $defaultClasses = ['yellow-400', 'fa-clock'];

    $eventDate = \Carbon\Carbon::parse($weddingEvents[0]->waktu)->startOfDay();
    $today = \Carbon\Carbon::today();

    $base_url = config('app.url');
@endphp

@section('content')
    <div class="w-full max-w-[1200px] py-4 mx-auto">
        {{-- BUTTONS --}}
        <div class="w-full flex items-center justify-between">
            <div class="w-1/3">
                <a class="block w-fit px-4 py-2 font-semibold outline-pink outline-offset-4 text-pink bg-white hover:bg-pink hover:text-white focus:bg-pink focus:text-white active:bg-pink-active transition-colors rounded"
                    href="{{ route('user.pernikahan.index') }}">
                    <i class="fa-solid fa-arrow-left-long"></i>
                    <span>Kembali</span>
                </a>
            </div>

            @if ($tab == 'detail')
                <div class="w-1/3">
                    <button class="w-[40px] aspect-square mx-auto flex items-center justify-center font-semibold {{ $wedding->status == 'selesai' ? 'bg-green-400' : 'bg-yellow-400' }} text-white rounded"
                        type="button" id="statusInfoBtn" data-status="{{ $wedding->status }}">
                        <i class="{{ $wedding->status == 'selesai' ? 'fa-solid fa-circle-check' : 'fa-solid fa-circle-exclamation' }}"></i>
                    </button>
                </div>
            @endif

            <div class="relative w-1/3 flex items-center justify-end gap-2">
                {{-- TOMBOL DETAIL --}}
                <a class="w-[40px] aspect-square flex items-center justify-center outline-pink outline-offset-4 shadow-sm border border-pink hover:bg-pink hover:text-white focus:bg-pink focus:text-white active:bg-pink-active transition-colors rounded
                    {{ $tab == 'detail' ? 'bg-pink text-white' : 'text-pink bg-white' }}"
                    href="{{ route('user.pernikahan.ke_detail', $wedding->id) }}" title="detail pernikahan" data-tippy-content="detail pernikahan">
                    <i class="fa-solid fa-info"></i>
                </a>

                @if ($wedding->status != 'selesai')
                    <a class="w-[40px] aspect-square flex items-center justify-center outline-pink outline-offset-4 shadow-sm border border-pink text-pink hover:bg-pink hover:text-white focus:bg-pink focus:text-white active:bg-pink-active transition-colors rounded"
                        href="{{ route('user.pernikahan.ke_ubah', $wedding->id) }}" title="lengkapi pernikahan" data-tippy-content="lengkapi pernikahan">
                        <i class="fa-solid fa-pen"></i>
                    </a>
                @endif

                @if (!$wedding->invitation)
                    {{-- TOMBOL BUAT UNDANGAN --}}
                    <a class="w-[40px] aspect-square flex items-center justify-center outline-pink outline-offset-4 shadow-sm border hover:bg-pink hover:text-white focus:bg-pink focus:text-white active:bg-pink-active transition-colors rounded
                        {{ $today->lt($eventDate) && $wedding->status == 'selesai' ? 'border-pink text-pink bg-white' : 'bg-slate-300 text-white pointer-events-none' }}"
                        href="{{ route('user.undangan.ke_tambah', ['id'=>$wedding->id]) }}" title="buat undangan" data-tippy-content="buat undangan">
                        <i class="fa-regular fa-envelope"></i>
                    </a>
                @else
                    {{-- TOMBOL EDIT UNDANGAN --}}
                    <a class="w-[40px] aspect-square flex items-center justify-center outline-pink outline-offset-4 shadow-sm border border-pink hover:bg-pink hover:text-white focus:bg-pink focus:text-white active:bg-pink-active transition-colors rounded
                        {{ $tab == 'ubah-undangan' ? 'bg-pink text-white' : 'text-pink bg-white' }}" target="_blank"
                        href="{{ route('user.undangan.cek', ['id'=>$wedding->id]) }}" title="lihat undangan" data-tippy-content="lihat undangan">
                        <i class="fa-regular fa-envelope"></i>
                    </a>
                @endif

                {{-- TOMBOL TAMU UNDANGAN --}}
                <a class="w-[40px] aspect-square flex items-center justify-center outline-pink outline-offset-4 shadow-sm border hover:bg-pink hover:text-white focus:bg-pink focus:text-white active:bg-pink-active transition-colors rounded
                    {{ ($wedding->invitation && $wedding->invitation->status == 'selesai') ? 'border-pink ' . ($tab == 'tamu-undangan' ? 'bg-pink text-white' : 'text-pink bg-white') : 'bg-slate-300 text-white pointer-events-none' }}"
                    href="{{ route('user.pernikahan.ke_detail', ['id'=>$wedding->id, 'tab' => 'tamu-undangan']) }}" title="tamu undangan" data-tippy-content="tamu undangan">
                    <i class="fa-solid fa-user"></i>
                </a>

                @if ($today->lt($eventDate))
                    {{-- Ini tampil jika hari ini belum mencapai tanggal $eventDate --}}
                    <form action="{{ route('user.pernikahan.hapus', $wedding->id) }}" method="post" id="deleteWeddingForm">
                        @csrf
                        <button class="w-[40px] aspect-square flex items-center justify-center outline-pink outline-offset-4 shadow-sm border border-pink text-pink bg-white hover:bg-pink hover:text-white focus:bg-pink focus:text-white active:bg-pink-active transition-colors rounded"
                            type="button" title="hapus pernikahan" data-tippy-content="hapus pernikahan" id="deleteWeddingBtn">
                            <i class="fa-solid fa-trash-can"></i>
                        </button>
                    </form>
                @else
                    {{-- Ini tampil jika hari ini sudah mencapai atau melewati tanggal $eventDate --}}
                    <button class="w-[40px] aspect-square flex items-center justify-center outline-pink outline-offset-4 shadow-sm border border-pink text-pink bg-white hover:bg-pink hover:text-white focus:bg-pink focus:text-white active:bg-pink-active transition-colors rounded"
                        type="button" title="hapus pernikahan" data-tippy-content="hapus pernikahan" id="deleteWeddingWrn">
                        <i class="fa-solid fa-trash-can"></i>
                    </button>
                @endif
            </div>
        </div>

        <hr class="my-4">

        {{-- JUDUL --}}
        <div class="w-full flex items-center justify-center gap-2 text-4xl font-semibold font-great-vibes">
            <span class="text-blue-400">
                Tn. {{ $wedding->p_lengkap }}
            </span>
            &
            <span class="text-red-400">
                Nn. {{ $wedding->w_lengkap }}
            </span>
        </div>

        <hr class="my-4">

        @if ($tab == 'detail')
            @include('user.wedding.info')
        @endif

        @if ($tab == 'tamu-undangan')
            @include('user.wedding.tamu-undangan')
        @endif
    </div>

    <form hidden action="{{ route('user.pernikahan.selesai') }}" method="post" id="selesaiForm">
        @csrf
        <input hidden type="number" name="id_booking" id="id_booking">
    </form>
@endsection

@push('child-js')
    <script>
        $(document).ready(function() {
            // HAPUS WEDDING
            $('#deleteWeddingBtn').on('click', function () {
                Swal.fire({
                    title: 'Yakin ingin menghapus pernikahan ini?',
                    html: `
                        <div class="w-full text-start">
                            <p>Informasi yang akan terhapus</p>
                            <ul class="px-8 list-disc">
                                <li>Informasi pernikahan</li>
                                <li>Informasi pemesanan vendor</li>
                                <li>Informasi transaksi & pembayaran</li>
                                <li>Informasi undangan digital</li>
                                <li>Informasi tamu undangan</li>
                            </ul>
                            <p>Data tidak akan dapat dikembalikan lagi</p>
                        </div>
                    `,
                    icon: "warning",
                    iconColor: "#F78CA2",
                    showCloseButton: true,
                    confirmButtonColor: "#F78CA2",
                    confirmButtonText: "Konfirmasi"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#deleteWeddingForm').submit();
                    }
                });
            });

            $('#deleteWeddingWrn').on('click', function () {
                Swal.fire({
                    title: 'Tidak dapat menghapus pernikahan',
                    text: 'Hari ini sudah memasuki/melewati tanggal pertama pada acara',
                    icon: "warning",
                    iconColor: "#F78CA2",
                    showCloseButton: true,
                    confirmButtonColor: "#F78CA2",
                    confirmButtonText: "OK"
                }).then((result) => {
                    $("#toggleDeleteWeddingContainer").click();
                    return;
                });
            });
        });
    </script>

    @if ($tab == 'detail')
        <script>
            $(document).ready(function() {
                // FILTER BOOKED VENDOR
                const buttons = $('button[data-target]');
                const sections = $('div[id^="targetDiv-"]');
                const filterBtn = $('#filter-btn');

                buttons.on('click', function() {
                    let targetId = $(this).data('target');

                    buttons.removeClass('bg-pink text-white').addClass('text-pink');
                    filterBtn.removeClass('bg-pink text-white').addClass('text-pink');

                    $(this).removeClass('text-pink').addClass('bg-pink text-white');
                    sections.addClass('hidden');
                    $('#targetDiv-' + targetId).removeClass('hidden');
                });

                filterBtn.on('click', function() {
                    buttons.removeClass('bg-pink text-white').addClass('text-pink');
                    $(this).removeClass('text-pink').addClass('bg-pink text-white');
                    sections.removeClass('hidden');
                });

                // HAPUS PESANAN VENDOR
                $('.hapusWPBtn').click(function () {
                    let form = $('#hapusWPForm-' + $(this).data('id'));

                    Swal.fire({
                        title: 'Batalkan pesanan vendor ini?',
                        text: "Data tidak akan dapat dikembalikan lagi",
                        icon: "warning",
                        iconColor: "#F78CA2",
                        showCloseButton: true,
                        confirmButtonColor: "#F78CA2",
                        confirmButtonText: "Konfirmasi"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });

                $('.pay-button').each(function(){
                    $(this).on('click', function(){
                        let bookingId = $(this).data('id_booking');
                        let snapContainer = 'snap-container-' + bookingId;

                        $(this).addClass('hidden');

                        $('#hapusWPForm-'+bookingId).addClass('hidden');

                        $('#close-transaction-'+bookingId).removeClass('hidden');

                        $.ajax({
                            url: '/user/pernikahan/transaksi',
                            method: 'GET',
                            data: { id_booking: bookingId },
                            dataType: 'json',
                            success: function(data) {
                                snap.embed(data.snap_token, {
                                    embedId: snapContainer,
                                });
                            },
                            error: function(jqXHR, textStatus, errorThrown) {
                                console.error("Error fetching payment token: ", textStatus, errorThrown);
                                $('#' + snapContainer).html('<p>Error: ' + response.error + '</p>');
                            }
                        });
                    });
                });

                $('.close-transaction').each(function(){
                    $(this).on('click', function(){
                        let bookingId = $(this).data('id');

                        $('#pay-button-'+bookingId).removeClass('hidden');

                        let snapContainer = $(`#snap-container-${bookingId}`);
                        if (snapContainer.length > 0 && snapContainer.find('#snap-midtrans').length > 0) {
                            snap.hide();
                        }

                        $('#hapusWPForm-'+bookingId).removeClass('hidden');
                        $(this).addClass('hidden');
                    });
                });

                $('.cancel-transaction').each(function() {
                    $(this).on('click', function(event) {
                        event.preventDefault();

                        Swal.fire({
                            title: 'Yakin ingin membatalkan transaksi ini?',
                            icon: "warning",
                            iconColor: "#F78CA2",
                            showCloseButton: true,
                            confirmButtonColor: "#F78CA2",
                            confirmButtonText: "Ya, Batalkan"
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = $(this).attr('href');
                            }
                        });
                    });
                });

                // VENDOR TOGGLE MODAL
                $('.openFtgModalBtn').on('click', function() {
                    const modalId = $(this).data('ftg-modal');
                    $(`#bookingFtgModal-${modalId}`).removeClass('top-full').addClass('top-0');
                    $(`#bookingFtgModal-${modalId} button`).attr('tabindex', 0);
                    $(`#bookingFtgModal-${modalId} a`).attr('tabindex', 0);
                });
                $('.closeFtgModalBtn').on('click', function() {
                    const modalId = $(this).data('ftg-modal');
                    $(`#bookingFtgModal-${modalId}`).removeClass('top-0').addClass('top-full');
                    $(`#bookingFtgModal-${modalId} button`).attr('tabindex', -1);
                    $(`#bookingFtgModal-${modalId} a`).attr('tabindex', -1);

                    let snapContainer = $(`#snap-container-${modalId}`);
                    if (snapContainer.length > 0 && snapContainer.find('#snap-midtrans').length > 0) {
                        $('#pay-button-'+modalId).removeClass('hidden');
                        snap.hide();
                        $('#hapusWPForm-'+modalId).removeClass('hidden');
                        $('#close-transaction-'+modalId).addClass('hidden');
                    }
                });

                // SELESAIKAN PESANAN
                $('#selesaiBtn').on('click', function () {
                    let bookingId = $(this).data('id_booking');
                    $('#id_booking').val(bookingId);

                    Swal.fire({
                        title: 'Selesaikan pesanan ini?',
                        icon: "warning",
                        iconColor: "#F78CA2",
                        showCloseButton: true,
                        confirmButtonColor: "#F78CA2",
                        confirmButtonText: "Konfirmasi"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $('#selesaiForm').submit();
                        }
                    });
                });

                // ATUR NILAI RATING
                $('.starBtn').on('click', function () {
                    let ratingValue = $(this).data('value');
                    let parentForm = $(this).closest('form');
                    let ratingInput = parentForm.find('.ratingInput');

                    ratingInput.val(ratingValue);

                    parentForm.find('.starBtn i').removeClass('text-pink');

                    parentForm.find('.starBtn').each(function(index) {
                        if (index < ratingValue) {
                            $(this).find('i').addClass('text-pink');
                        }
                    });
                });

                // COPY TO CLIPBOARD
                $('.copyToClipBtn').on('click', function() {
                    let textToCopy = $(this).data("value");

                    let tempInput = $('<input>');
                    $('body').append(tempInput);
                    tempInput.val(textToCopy).select();
                    document.execCommand('copy');
                    tempInput.remove();

                    toastr.success("Berhasil menyalin ke clipboard", "Sukses");
                });

                // OPEN INFO BTN
                $('#statusInfoBtn').on('click', function() {
                    let title = '';
                    let text = '';
                    let icon = '';
                    let status = $(this).data("status");

                    if (status == 'selesai') {
                        title = 'Selesai';
                        text = 'Informasi acara untuk pernikahan Anda sudah lengkap';
                        icon = 'success';
                    } else {
                        title = 'Perhatian';
                        text = 'Informasi acara untuk pernikahan Anda belum lengkap';
                        icon = 'warning';
                    }

                    Swal.fire({
                        title: title,
                        text: text,
                        icon: icon,
                        showCloseButton: true
                    });
                });

                $('.detail-plan ul').addClass('list-disc px-4');
            });
        </script>
    @endif

    @if ($tab == 'tamu-undangan')
        <script>
            const p_lengkap = @json($wedding->p_lengkap);
            const w_lengkap = @json($wedding->w_lengkap);
            const base_url = @json($base_url);
            console.log(base_url);
            const teks = `Anda diundang ke acara pernikahan kami,\n${p_lengkap} & ${w_lengkap}\n\nSilakan klik tautan berikut untuk melihat undangan Anda:`;

            const url = base_url+'/undangan/'+@json($wedding->p_sapaan)+'-'+@json($wedding->w_sapaan)+'/';

            function copyText(text) {
                navigator.clipboard.writeText(text).then(function() {
                    toastr.success('Teks berhasil disalin ke clipboard', "Sukses");
                }, function(err) {
                    toastr.success('Gagal menyalin teks ke clipboard', 'Gagal');
                });
            }

            function sendWhatsAppMessage(nama, telp, link) {
                const message = `Halo, ${nama}\n${teks}\n${url+link}`;
                const whatsappUrl = `https://wa.me/${telp}?text=${encodeURIComponent(message)}`;
                window.open(whatsappUrl, '_blank');
            }

            function copyTextToClipboard(nama, link) {
                const message = `Halo, ${nama}\n${teks}\n${url+link}`;
                copyText(message);
            }

            function copyLinkToClipboard(link) {
                copyText(url+link);
            }

            function showGuestInfoModal(id) {
                const modal = $(`#guestInfoModal-${id}`);
                if (modal.length > 0) {
                    modal.removeClass('top-full').addClass('top-0');
                }
            }

            $(document).ready(function () {
                Fancybox.bind("[data-fancybox]");

                $('.closeGIModalBtn').click(function() {
                    const modalId = $(this).data('gi-modal');
                    const modal = $(`#guestInfoModal-${modalId}`);
                    if (modal.length > 0) {
                        modal.removeClass('top-0').addClass('top-full');
                    }
                });

                $('.validasiKirimUndanganForm').on('submit', function (e) {
                    e.preventDefault();
                    Swal.fire({
                        title: 'Konfirmasi pengiriman undangan?',
                        text: "Pastikan Anda sudah mengirimkan undangan sebelum memvalidasi",
                        icon: "warning",
                        iconColor: "#F78CA2",
                        showCloseButton: true,
                        confirmButtonColor: "#F78CA2",
                    }).then((result) => {
                        if (result.isConfirmed) {
                            this.submit();
                        }
                    });
                });

                $('.hapusUndanganForm').on('submit', function (e) {
                    e.preventDefault();
                    Swal.fire({
                        title: 'Hapus tamu undangan?',
                        text: "Anda tidak akan dapat mengembalikan data tamu ini",
                        icon: "warning",
                        iconColor: "#F78CA2",
                        showCloseButton: true,
                        confirmButtonColor: "#F78CA2",
                    }).then((result) => {
                        if (result.isConfirmed) {
                            this.submit();
                        }
                    });
                });
            });
        </script>
    @endif
@endpush
