@extends('user.wedding-couple.layout')

@section('title')
    <title>Detail Pernikahan | Wedding Marketplace</title>
@endsection

@section('content')
    <div class="w-full max-w-[1200px] mx-auto">
        <div class="w-full">
            {{-- BUTTONS --}}
            <div class="w-full mt-4 px-4 flex items-center justify-between">
                <div class="w-fit">
                    <a class="block w-fit px-4 py-2 font-semibold outline-pink outline-offset-4 text-pink bg-white hover:bg-pink hover:text-white focus:bg-pink focus:text-white active:bg-pink-active transition-colors rounded"
                        href="{{ route('wedding-couple.pernikahan.index') }}">
                        <i class="fa-solid fa-arrow-left-long"></i>
                        <span>Kembali</span>
                    </a>
                </div>

                <div class="relative w-fit">
                    <button class="w-fit px-4 aspect-square flex items-center justify-center font-semibold outline-pink outline-offset-4 text-pink bg-white hover:bg-pink hover:text-white focus:bg-pink focus:text-white active:bg-pink-active transition-colors rounded-full"
                        type="button" id="toggleDeleteWeddingContainer">
                        <i class="fa-solid fa-ellipsis-vertical"></i>
                    </button>

                    <div class="absolute top-[calc(100%+5px)] right-0 w-fit p-1 hidden rounded-lg bg-slate-200"
                        id="deleteWeddingContainer">
                        <form action="{{ route('wedding-couple.pernikahan.hapus', $wedding->id) }}" method="post" id="deleteWeddingForm">
                            @csrf
                            <button class="w-fit px-2 py-1 whitespace-nowrap font-semibold text-sm outline-pink outline-offset-4 text-pink bg-white hover:bg-pink hover:text-white focus:bg-pink focus:text-white active:bg-pink-active transition-colors rounded"
                                type="button" id="deleteWeddingBtn" tabindex="-1">
                                Hapus Pernikahan
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            {{-- JUDUL --}}
            <div class="w-full p-4 flex items-center justify-start gap-8">
                <div class="w-fit aspect-square p-4 bg-pink rounded text-4xl text-white">
                    <i class="fa-solid fa-dove"></i>
                </div>

                <div class="flex-1 w-full text-3xl text-slate-600 font-semibold">
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

            {{-- EVENTS --}}
            <div class="w-full p-4 grid grid-cols-2 gap-4 border-t-2 border-slate-100">
                @foreach ($weddingEvents as $w_event)
                    {{-- EVENT --}}
                    <div class="flex-1 w-full">
                        <div class="w-full p-4 flex items-center justify-center gap-2 text-2xl border-b-2 border-pink font-semibold">
                            <span>
                                Tempat & Waktu {{ $w_event->event->nama }}
                            </span>
                            <div class="w-4 aspect-square flex items-center justify-end text-sm cursor-pointer"
                                data-tippy-content="{{ $w_event->event->keterangan }}">
                                <i class="fa-regular fa-circle-question"></i>
                            </div>
                        </div>

                        <div class="w-fit mx-auto p-4">
                            <table>
                                <tbody>
                                    <tr>
                                        <td class="pr-2 text-center">
                                            <i class="fa-solid fa-calendar-day text-3xl text-pink"></i>
                                        </td>
                                        <td>Tanggal</td>
                                        <td class="px-2 text-center">:</td>
                                        <td>
                                            {{ \Carbon\Carbon::parse($w_event->waktu)->format('Y-m-d') }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="pr-2 text-center">
                                            <i class="fa-regular fa-clock text-3xl text-pink"></i>
                                        </td>
                                        <td>Jam</td>
                                        <td class="px-2 text-center">:</td>
                                        <td>
                                            {{ \Carbon\Carbon::parse($w_event->waktu)->format('H:i') }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="pr-2 text-center">
                                            <i class="fa-solid fa-place-of-worship text-3xl text-pink"></i>
                                        </td>
                                        <td>Tempat</td>
                                        <td class="px-2 text-center">:</td>
                                        <td>
                                            {{ $w_event->lokasi }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="w-full p-4 flex items-start justify-between gap-2 border-t-2 border-slate-100">
            @include('user.wedding-couple.wedding.detail.wo')

            @include('user.wedding-couple.wedding.detail.wp')
        </div>
    </div>

    <form hidden action="{{ route('wedding-couple.pernikahan.selesai') }}" method="post" id="selesaiForm">
        @csrf
        <input hidden type="number" name="id_booking" id="id_booking">
    </form>
@endsection

@push('child-js')
    <script>
        $(document).ready(function() {
            // TOGGLE CONTAINER DELETE WEDDING
            $("#toggleDeleteWeddingContainer").click(function () {
                $("#deleteWeddingContainer").toggleClass("hidden");
                $("#deleteWeddingContainer button").attr("tabindex", 0);
            });

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

            // HAPUS PESANAN WO
            $('#hapusWOBtn').on('click', function () {
                Swal.fire({
                    title: 'Batalkan pesanan organizer ini?',
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
                    title: 'Batalkan pesanan fotografer ini?',
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

            // UP BUKTI BAYAR WO
            $('#upBuktiBayarOrgBtn').on('click', function () {
                $('#bukti_bayar_org').click();
            });

            $('#bukti_bayar_org').on('change', function () {
                let files = this.files;
                $("#upBuktiBayarOrgContainer").empty();

                for (let i = 0; i < files.length; i++) {
                    if (i < 1) {
                        let img = $('<img>');
                        img.attr('src', URL.createObjectURL(files[i])).addClass('h-full object-contain');
                        $('#upBuktiBayarOrgContainer').append(img);
                    }
                }

                $('#submitBuktiBayarOrgBtn').attr('disabled', false);
            });
            // SUBMIT BUKTI BAYAR WO
            $('#submitBuktiBayarOrgBtn').on('click', function () {
                Swal.fire({
                    title: 'Upload bukti bayar?',
                    text: "Anda tidak akan dapat mengganti bukti pembayaran setelah konfirmasi",
                    icon: "warning",
                    iconColor: "#F78CA2",
                    showCloseButton: true,
                    confirmButtonColor: "#F78CA2",
                    confirmButtonText: "Konfirmasi"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#buktiBayarOrgForm').submit();
                    }
                });
            });

            // UP BUKTI BAYAR WP
            $('.upBuktiBayarFtgBtn').on('click', function () {
                let id = $(this).data('id');
                $(`#bukti_bayar_ftg-${id}`).click();
            });

            $('.bukti_bayar_ftg').on('change', function () {
                let files = this.files;
                let id = $(this).data('id');
                $(`#upBuktiBayarFtgContainer-${id}`).empty();

                for (let i = 0; i < files.length; i++) {
                    if (i < 1) {
                        let img = $('<img>');
                        img.attr('src', URL.createObjectURL(files[i])).addClass('h-full object-contain');
                        $(`#upBuktiBayarFtgContainer-${id}`).append(img);
                    }
                }

                $(`#submitBuktiBayarFtgBtn-${id}`).attr('disabled', false);
            });
            // SUBMIT BUKTI BAYAR WP
            $('.submitBuktiBayarFtgBtn').on('click', function () {
                let form = $('#upBuktiBayarFtgForm-' + $(this).data('id'));

                Swal.fire({
                    title: 'Upload bukti bayar?',
                    text: "Anda tidak akan dapat mengganti bukti pembayaran setelah konfirmasi",
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
@endpush
