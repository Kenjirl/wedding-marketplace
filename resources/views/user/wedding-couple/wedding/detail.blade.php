@extends('user.wedding-couple.layout')

@section('title')
    <title>Detail Pernikahan | Wedding Marketplace</title>
@endsection

@section('content')
    <div class="w-full max-w-[1200px] mx-auto">
        <div class="w-full">
            {{-- JUDUL --}}
            <div class="w-full p-4 flex items-center justify-start gap-8">
                <div class="w-fit aspect-square p-4 bg-pink rounded text-4xl text-white">
                    <i class="fa-solid fa-dove"></i>
                </div>

                <div class="flex-1 w-full text-3xl text-slate-600 font-semibold">
                    Pernikahan
                    <span class="text-blue-400">
                        Tn. {{ $wedding->groom }}
                    </span>
                    &
                    <span class="text-red-400">
                        Nn. {{ $wedding->bride }}
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
@endsection

@push('child-js')
    <script>
        $(document).ready(function() {
            // HAPUS PESANAN WO
            $('#hapusWOBtn').on('click', function () {
                if (confirm('Apakah Anda yakin ingin membatalkan pesanan organizer ini?')) {
                    $('#hapusWOForm').submit();
                }
            });

            // HAPUS PESANAN WP
            $('.hapus-wp-btn').click(function () {
                let form = $('#hapusWPForm-' + $(this).data('id'));
                if (confirm('Apakah Anda yakin ingin membatalkan pesanan photographer ini?')) {
                    form.submit();
                }
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

            // ORGANIZER TOGGLE MODAL
            $("#openOrgModalBtn").on('click', function() {
                $('#bookingOrgModal').removeClass('top-full').addClass('top-0');
            });
            $("#closeOrgModalBtn").on('click', function() {
                $('#bookingOrgModal').removeClass('top-0').addClass('top-full');
            });

            // FOTOGRAFER TOGGLE MODAL
            $('.openFtgModalBtn').on('click', function() {
                const modalId = $(this).data('ftg-modal');
                const modal = $(`#bookingFtgModal-${modalId}`);

                if (modal) {
                    modal.removeClass('top-full').addClass('top-0');
                }
            });
            $('.closeFtgModalBtn').on('click', function() {
                const modalId = $(this).data('ftg-modal');
                const modal = $(`#bookingFtgModal-${modalId}`);

                if (modal) {
                    modal.removeClass('top-0').addClass('top-full');
                }
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
        });
    </script>
@endpush
