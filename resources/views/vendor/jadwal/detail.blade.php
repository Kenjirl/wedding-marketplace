@extends('vendor.layout')

@section('title')
    <title>Jadwal | Wedding Marketplace</title>
@endsection

@section('h1', 'Jadwal > Detail Jadwal')

@section('content')
    <div class="w-full flex items-center justify-start">
        <a class="block w-fit px-4 py-2 font-semibold outline-none text-pink bg-white hover:bg-pink hover:text-white focus:bg-pink focus:text-white active:bg-pink-active transition-colors rounded"
            href="{{ url()->previous() }}">
            <i class="fa-solid fa-arrow-left-long"></i>
            <span>Kembali</span>
        </a>
    </div>

    <hr class="my-4">

    {{-- JUDUL --}}
    <div class="w-full p-2 flex items-center justify-start gap-4">
        <div class="w-fit aspect-square px-2 flex items-center bg-pink rounded text-2xl text-white">
            <i class="fa-solid fa-dove"></i>
        </div>

        <div class="flex-1 w-full text-lg text-slate-600 font-semibold">
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

    <div class="w-full grid grid-cols-2 gap-4">
        {{-- KIRI --}}
        <div class="w-full h-fit">
            {{-- EVENTS --}}
            <div class="w-full p-2 gap-8 border-t-2 border-slate-100">
                @foreach ($events as $event)
                    {{-- EVENT --}}
                    <div class="w-full mb-4 flex items-center justify-center gap-4">
                        {{-- NUMBER --}}
                        <div class="w-[40px] aspect-square flex items-center justify-center text-lg italic bg-pink text-white font-semibold rounded">
                            {{ $loop->iteration }}
                        </div>

                        {{-- RIGHT --}}
                        <div class="flex-1 w-full">
                            {{-- TOP --}}
                            <div class="w-full flex">
                                <div class="flex-1 w-full text-lg font-semibold">
                                    {{ $event->event->nama }}
                                </div>

                                <div class="w-4 aspect-square flex items-center justify-end text-sm cursor-pointer"
                                    data-tippy-content="{{ $event->event->keterangan }}">
                                    <i class="fa-regular fa-circle-question"></i>
                                </div>
                            </div>

                            <div class="w-full h-[2px] my-1 bg-pink"></div>

                            {{-- BOTTOM --}}
                            <div class="w-full text-sm text-gray-400 italic">
                                <div>
                                    Pada {{ \Carbon\Carbon::parse($event->waktu)->translatedFormat('l, d F Y') }} <br>
                                    pukul {{ \Carbon\Carbon::parse($event->waktu)->translatedFormat('H:i') }}
                                </div>
                                <div>
                                    {{ $event->lokasi }}
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- KANAN --}}
        <div class="w-full h-fit">
            {{-- STATUS --}}
            <div class="w-full px-4 py-2 bg-green-400 text-white font-semibold rounded-tr-lg border-2 border-green-400 text-end">
                {{ $booking->status }}
            </div>

            {{-- PEMESAN --}}
            <div class="w-full p-2 border-2 border-slate-100">
                <table>
                    <tr>
                        <td class="pr-2"><i class="fa-solid fa-user text-pink"></i></td>
                        <td class="pr-2">Pelanggan</td>
                        <td class="pr-2">:</td>
                        <td>{{ $booking->wedding->w_couple->nama }}</td>
                    </tr>
                    <tr>
                        <td><i class="fa-solid fa-phone text-pink"></i></td>
                        <td>Kontak</td>
                        <td>:</td>
                        <td>{{ $booking->wedding->w_couple->no_telp }}</td>
                    </tr>
                </table>
            </div>

            {{-- DETAIL PESANAN --}}
            <div class="w-full p-2 border-2 border-t-0 border-slate-100">
                {{-- nama paket --}}
                <div class="w-full flex items-start justify-between gap-2">
                    <span class="w-1/2">
                        Nama Paket Layanan
                    </span>
                    <span class="w-1/2 text-end line-clamp-1">
                        <a class="font-semibold underline"
                            href="{{ route('vendor.layanan.ke_ubah', $plan->id) }}">
                            {{ $plan->nama }}
                        </a>
                    </span>
                </div>

                {{-- jumlah pesanan --}}
                <div class="w-full flex items-start justify-between gap-2">
                    <span class="w-1/2">
                        Jumlah Pesanan
                    </span>
                    <span class="w-1/2 text-end line-clamp-1">
                        {{ $booking->qty . ' ' . $plan->satuan }}
                    </span>
                </div>

                {{-- harga --}}
                <div class="w-full flex items-start justify-between gap-2">
                    <span class="w-1/2">
                        Total Harga
                    </span>
                    <span class="w-1/2 text-end line-clamp-1">
                        Rp
                        {{ number_format($plan->harga, 0, ',', '.') }}
                    </span>
                </div>

                {{-- tanggal pesan --}}
                <div class="w-full flex items-start justify-between gap-2">
                    <span class="w-1/2">
                        Dipesan untuk tanggal
                    </span>
                    <span class="w-1/2 text-end line-clamp-1">
                        {{ \Carbon\Carbon::parse($booking->untuk_tanggal)->translatedFormat('l, d F Y') }}
                    </span>
                </div>
            </div>

            {{-- DETAIL TRANSAKSI --}}
            @if ($transaksi)
                <div class="w-full p-2 border-2 border-t-0 border-slate-100">
                    <div class="w-full flex items-center justify-start gap-2">
                        <i class="fa-regular fa-circle-check text-green-400"></i>
                        <span>Transaksi telah dilakukan</span>
                    </div>

                    {{-- TANGGAL --}}
                    <div class="w-full flex items-center justify-between">
                        <span>Pada</span>
                        <span>{{ \Carbon\Carbon::parse($transaksi->updated_at)->translatedFormat('l, d F Y - H:m:s') }}</span>
                    </div>

                    {{-- NOMINAL --}}
                    <div class="w-full flex items-center justify-between">
                        <span>Nominal</span>
                        <span>Rp {{ number_format($transaksi->gross_amount, 0, ',', '.') }}</span>
                    </div>
                </div>
            @endif

            {{-- ULASAN --}}
            <div class="w-full p-4 border-2 border-t-0 rounded-b-lg border-slate-100 text-sm">
                @if ($booking->rating)
                    <div class="w-full flex items-center justify-start gap-2 mb-4">
                        @for ($i = 1; $i <= 5; $i++)
                            <i class="fa-solid fa-star {{ $booking->rating->rating >= $i ? 'text-pink' : '' }}"></i>
                        @endfor
                    </div>
                    <div class="w-full text-justify">
                        Komentar : <br> {{ $booking->rating->komentar }}
                    </div>
                @else
                    <div class="w-full flex items-center justify-start gap-2 mb-4">
                        @for ($i = 1; $i <= 5; $i++)
                            <i class="fa-solid fa-star"></i>
                        @endfor
                    </div>
                    <div class="w-full text-justify">
                        Belum ada ulasan
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@push('child-js')
    <script>
        function respon(status) {
            Swal.fire({
                title: `Ingin membatalkan pesanan ini?`,
                text: 'Anda tidak akan dapat menerima pesanan ini jika sudah ditolak',
                icon: "warning",
                iconColor: "#F78CA2",
                showCloseButton: true,
                confirmButtonColor: "#F78CA2",
                confirmButtonText: "Konfirmasi"
            }).then((result) => {
                if (result.isConfirmed) {
                    $("#status").val(status);
                    $('#pesananForm').submit();
                }
            });
        }

        $('#bukti_bayar_img').magnificPopup({
            type: 'image'
        });
    </script>
@endpush
