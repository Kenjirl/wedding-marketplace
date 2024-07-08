@extends('user.wedding-couple.layout')

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
@endphp

@section('content')
    <div class="w-full max-w-[1200px] mx-auto">
        <div class="w-full mb-4 border-b-2 border-slate-300">
            {{-- BUTTONS --}}
            <div class="w-full mt-4 px-4 flex items-center justify-between">
                <div class="w-fit">
                    <a class="block w-fit px-4 py-2 font-semibold outline-pink outline-offset-4 text-pink bg-white hover:bg-pink hover:text-white focus:bg-pink focus:text-white active:bg-pink-active transition-colors rounded"
                        href="{{ route('wedding-couple.pernikahan.index') }}">
                        <i class="fa-solid fa-arrow-left-long"></i>
                        <span>Kembali</span>
                    </a>
                </div>

                <div class="relative w-fit flex items-center justify-center gap-2">
                    {{-- TOMBOL DETAIL --}}
                    <a class="w-[40px] aspect-square flex items-center justify-center outline-pink outline-offset-4 shadow-sm border border-pink hover:bg-pink hover:text-white focus:bg-pink focus:text-white active:bg-pink-active transition-colors rounded
                        {{ $tab == 'detail' ? 'bg-pink text-white' : 'text-pink bg-white' }}"
                        href="{{ route('wedding-couple.pernikahan.ke_detail', $wedding->id) }}" title="detail pernikahan" data-tippy-content="detail pernikahan">
                        <i class="fa-solid fa-info"></i>
                    </a>

                    @if (!$wedding->invitation)
                        {{-- TOMBOL BUAT UNDANGAN --}}
                        <a class="w-[40px] aspect-square flex items-center justify-center outline-pink outline-offset-4 shadow-sm border hover:bg-pink hover:text-white focus:bg-pink focus:text-white active:bg-pink-active transition-colors rounded
                            {{ $today->lt($eventDate) ? 'border-pink text-pink bg-white' : 'bg-slate-300 text-white pointer-events-none' }}"
                            href="{{ route('wedding-couple.undangan.ke_tambah', ['id'=>$wedding->id]) }}" title="buat undangan" data-tippy-content="buat undangan">
                            <i class="fa-regular fa-envelope"></i>
                        </a>
                    @else
                        {{-- TOMBOL EDIT UNDANGAN --}}
                        <a class="w-[40px] aspect-square flex items-center justify-center outline-pink outline-offset-4 shadow-sm border border-pink hover:bg-pink hover:text-white focus:bg-pink focus:text-white active:bg-pink-active transition-colors rounded
                            {{ $tab == 'ubah-undangan' ? 'bg-pink text-white' : 'text-pink bg-white' }}"
                            href="{{ route('wedding-couple.pernikahan.ke_detail', ['id'=>$wedding->id, 'tab' => 'ubah-undangan']) }}" title="edit undangan" data-tippy-content="edit undangan">
                            <i class="fa-regular fa-envelope"></i>
                        </a>
                    @endif

                    {{-- TOMBOL TAMU UNDANGAN --}}
                    <a class="w-[40px] aspect-square flex items-center justify-center outline-pink outline-offset-4 shadow-sm border hover:bg-pink hover:text-white focus:bg-pink focus:text-white active:bg-pink-active transition-colors rounded
                        {{ ($wedding->invitation && $wedding->invitation->status == 'selesai') ? 'border-pink ' . ($tab == 'tamu-undangan' ? 'bg-pink text-white' : 'text-pink bg-white') : 'bg-slate-300 text-white pointer-events-none' }}"
                        href="{{ route('wedding-couple.pernikahan.ke_detail', ['id'=>$wedding->id, 'tab' => 'tamu-undangan']) }}" title="tamu undangan" data-tippy-content="tamu undangan">
                        <i class="fa-solid fa-user"></i>
                    </a>

                    @if ($today->lt($eventDate))
                        {{-- Ini tampil jika hari ini belum mencapai tanggal $eventDate --}}
                        <form action="{{ route('wedding-couple.pernikahan.hapus', $wedding->id) }}" method="post" id="deleteWeddingForm">
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

            {{-- JUDUL --}}
            <div class="w-full p-4 flex items-center justify-start gap-2">
                <div class="w-[50px] aspect-square flex items-center justify-center bg-pink rounded text-2xl text-white">
                    <i class="fa-solid fa-dove"></i>
                </div>

                <div class="flex-1 w-full text-2xl text-slate-600 font-semibold">
                    Pernikahan
                    <span class="text-blue-400">
                        Tn. {{ $wedding->p_lengkap }}
                    </span>
                    &
                    <span class="text-red-400">
                        Nn. {{ $wedding->w_lengkap }}
                    </span>
                </div>
            </div>
        </div>

        @if ($tab == 'detail')
            @include('user.wedding-couple.wedding.info')
        @endif

        @if ($tab == 'ubah-undangan')
            @include('user.wedding-couple.wedding.ubah-undangan')
        @endif

        @if ($tab == 'tamu-undangan')
            @include('user.wedding-couple.wedding.tamu-undangan')
        @endif
    </div>

    <form hidden action="{{ route('wedding-couple.pernikahan.selesai') }}" method="post" id="selesaiForm">
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
                            <p>Data yang akan terhapus</p>
                            <ul class="px-8 list-disc">
                                <li>Data pernikahan</li>
                                <li>Data pemesanan organizer</li>
                                <li>Data pemesanan fotografer</li>
                                <li>Bukti-bukti pembayaran</li>
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
                const sections = $('div[id^="include-"]');
                const filterBtn = $('#filter-btn');

                buttons.on('click', function() {
                    let targetId = $(this).data('target');

                    buttons.removeClass('bg-pink text-white').addClass('text-pink');
                    filterBtn.removeClass('bg-pink text-white').addClass('text-pink');

                    $(this).removeClass('text-pink').addClass('bg-pink text-white');
                    sections.addClass('hidden');
                    $('#' + targetId).removeClass('hidden');
                });

                filterBtn.on('click', function() {
                    buttons.removeClass('bg-pink text-white').addClass('text-pink');
                    $(this).removeClass('text-pink').addClass('bg-pink text-white');
                    sections.removeClass('hidden');
                });

                // HAPUS PESANAN WO
                $('#hapusWOBtn').on('click', function () {
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
                            $('#hapusWOForm').submit();
                        }
                    });
                });

                // HAPUS PESANAN WP
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

                        $.ajax({
                            url: '/wedding-couple/pernikahan/transaksi',
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

                // ORGANIZER TOGGLE MODAL
                $("#openOrgModalBtn").on('click', function() {
                    $('#bookingOrgModal').removeClass('top-full').addClass('top-0');
                    $('#bookingOrgModal button').attr('tabindex', 0);
                    $('#bookingOrgModal a').attr('tabindex', 0);
                });
                $("#closeOrgModalBtn").on('click', function() {
                    $('#bookingOrgModal').removeClass('top-0').addClass('top-full');
                    $('#bookingOrgModal button').attr('tabindex', -1);
                    $('#bookingOrgModal a').attr('tabindex', -1);
                });

                // FOTOGRAFER TOGGLE MODAL
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

                $('.detail-plan ul').addClass('list-disc px-4');
            });
        </script>
    @endif

    @if ($tab == 'ubah-undangan')
        @if ($invitation->status != 'selesai')
            {{-- SCRIPT FOTO --}}
            <script>
                $(document).ready(function () {
                    // Profil
                    const $unggahFotoProfilBtn = $('#unggahFotoProfilBtn');
                    const $fotoProfilInput = $('#foto_profil');
                    const $imageProfilPreview = $('#image-profil-preview');
                    const $jumlahFotoProfil = $('#jumlahFotoProfil');
                    const $pengantinPria = $('#pengantin-pria');
                    const $pengantinWanita = $('#pengantin-wanita');

                    let profilFileArray = [];

                    function updateFotoProfilJson() {
                        const dataTransfer = new DataTransfer();
                        profilFileArray.forEach(file => {
                            dataTransfer.items.add(file);
                        });
                        $fotoProfilInput[0].files = dataTransfer.files;

                        if (profilFileArray.length >= 2) {
                            $unggahFotoProfilBtn.prop('disabled', true);
                        } else {
                            $unggahFotoProfilBtn.prop('disabled', false);
                        }

                        $jumlahFotoProfil.text(profilFileArray.length + '/2');

                        // Hide placeholder text when images are added
                        if (profilFileArray.length > 0) {
                            $pengantinPria.hide();
                            $pengantinWanita.hide();
                        } else {
                            $pengantinPria.show();
                            $pengantinWanita.show();
                        }
                    }

                    $unggahFotoProfilBtn.on('click', function () {
                        $fotoProfilInput.click();
                    });

                    $fotoProfilInput.on('change', function () {
                        const files = Array.from(this.files);
                        const maxFiles = 2 - profilFileArray.length;

                        if (files.length > maxFiles) {
                            Swal.fire({
                                title: "Eitssssss!",
                                text: "Maksimal 2 gambar saja ya!",
                                icon: "warning",
                                iconColor: "#F78CA2",
                                showCloseButton: true,
                                confirmButtonColor: "#F78CA2",
                            });
                            return;
                        }

                        files.forEach(file => {
                            const reader = new FileReader();
                            reader.onload = function (e) {
                                const $imgWrapper = $('<div>').addClass('relative w-full h-[350px] bg-slate-100 rounded');
                                const $img = $('<img>').attr('src', e.target.result).addClass('w-full h-full object-contain');
                                const $deleteBtn = $('<button type="button"><i class="fa-solid fa-xmark"></i></button>').addClass('absolute top-0 right-0 w-8 aspect-square bg-pink rounded text-white');

                                $deleteBtn.on('click', function () {
                                    const index = profilFileArray.findIndex(f => f.name === file.name);
                                    if (index !== -1) {
                                        profilFileArray.splice(index, 1);
                                        $imgWrapper.remove();
                                        updateFotoProfilJson();
                                    }
                                });

                                $imgWrapper.append($img).append($deleteBtn);
                                $imageProfilPreview.append($imgWrapper);
                                profilFileArray.push(file);
                                updateFotoProfilJson();
                            };
                            reader.readAsDataURL(file);
                        });
                    });

                    // Galeri
                    const $unggahFotoGaleriBtn = $('#unggahFotoGaleriBtn');
                    const $fotoGaleriInput = $('#foto_galeri');
                    const $imageGaleriPreview = $('#image-galeri-preview');
                    const $jumlahFotoGaleri = $('#jumlahFotoGaleri');

                    let galeriFileArray = [];

                    function updateFotoGaleriJson() {
                        const dataTransfer = new DataTransfer();
                        galeriFileArray.forEach(file => {
                            dataTransfer.items.add(file);
                        });
                        $fotoGaleriInput[0].files = dataTransfer.files;

                        if (galeriFileArray.length >= 6) {
                            $unggahFotoGaleriBtn.prop('disabled', true);
                        } else {
                            $unggahFotoGaleriBtn.prop('disabled', false);
                        }

                        $jumlahFotoGaleri.text(galeriFileArray.length + '/6');
                    }

                    $unggahFotoGaleriBtn.on('click', function () {
                        $fotoGaleriInput.click();
                    });

                    $fotoGaleriInput.on('change', function () {
                        const files = Array.from(this.files);
                        const maxFiles = 6 - galeriFileArray.length;

                        if (files.length > maxFiles) {
                            Swal.fire({
                                title: "Eitssssss!",
                                text: "Maksimal 6 gambar saja ya!",
                                icon: "warning",
                                iconColor: "#F78CA2",
                                showCloseButton: true,
                                confirmButtonColor: "#F78CA2",
                            });
                            return;
                        }

                        files.forEach(file => {
                            const reader = new FileReader();
                            reader.onload = function (e) {
                                const $imgWrapper = $('<div>').addClass('relative w-full h-full bg-slate-100 rounded');
                                const $img = $('<img>').attr('src', e.target.result).addClass('w-full h-full object-contain');
                                const $deleteBtn = $('<button type="button"><i class="fa-solid fa-xmark"></i></button>').addClass('absolute top-0 right-0 w-8 aspect-square bg-pink rounded text-white');

                                $deleteBtn.on('click', function () {
                                    const index = galeriFileArray.findIndex(f => f.name === file.name);
                                    if (index !== -1) {
                                        galeriFileArray.splice(index, 1);
                                        $imgWrapper.remove();
                                        updateFotoGaleriJson();
                                    }
                                });

                                $imgWrapper.append($img).append($deleteBtn);
                                $imageGaleriPreview.append($imgWrapper);
                                galeriFileArray.push(file);
                                updateFotoGaleriJson();
                            };
                            reader.readAsDataURL(file);
                        });
                    });

                    $('#editUndanganForm').on('submit', function(event) {
                        event.preventDefault();

                        if (profilFileArray.length < 2) {
                            Swal.fire({
                                title: "Eitssssss!",
                                text: "Anda harus memiliki 2 gambar untuk profil Anda",
                                icon: "warning",
                                iconColor: "#F78CA2",
                                showCloseButton: true,
                                confirmButtonColor: "#F78CA2",
                            });
                            return;
                        }

                        if (galeriFileArray.length < 6) {
                            Swal.fire({
                                title: "Eitssssss!",
                                text: "Anda harus memiliki 6 gambar untuk galeri undangan digital Anda",
                                icon: "warning",
                                iconColor: "#F78CA2",
                                showCloseButton: true,
                                confirmButtonColor: "#F78CA2",
                            });
                            return;
                        }

                        Swal.fire({
                            title: 'Yakin ingin menyimpan perubahan?',
                            text: "Proses ini akan menyelesaikan pembuatan undangan digital Anda, dan tidak akan dapat diubah kembali",
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

                    updateFotoProfilJson();
                    updateFotoGaleriJson();
                });
            </script>
        @else
            <script>
                $(document).ready(function () {
                    Fancybox.bind("[data-fancybox]");
                });
            </script>
        @endif
    @endif

    @if ($tab == 'tamu-undangan')
        <script>
            const p_lengkap = @json($wedding->p_lengkap);
            const w_lengkap = @json($wedding->w_lengkap);
            const teks = `Anda diundang ke acara pernikahan kami,\n${p_lengkap} & ${w_lengkap}\n\nSilakan klik tautan berikut untuk melihat undangan Anda:`;

            const url = 'http://127.0.0.1:8000/'+@json($wedding->p_sapaan)+'-'+@json($wedding->w_sapaan)+'/';

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
