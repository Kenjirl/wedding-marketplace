@extends('user.wedding-photographer.layout')

@section('title')
    <title>Jadwal | Wedding Marketplace</title>
@endsection

@section('h1', 'Jadwal > Detail Jadwal')

@section('content')
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

    <div class="w-full grid grid-cols-3 gap-4">
        {{-- KIRI --}}
        <div class="w-full h-fit col-span-2">
            {{-- EVENTS --}}
            <div class="w-full p-2 grid grid-cols-2 gap-8 border-t-2 border-slate-100">
                @foreach ($events as $event)
                    {{-- EVENT --}}
                    <div class="w-full mb-4 flex items-center justify-center gap-4">
                        {{-- NUMBER --}}
                        <div class="w-[50px] aspect-square flex items-center justify-center text-2xl italic bg-pink text-white font-semibold rounded">
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
                                    Pada {{ \Carbon\Carbon::parse($event->waktu)->format('d/m/Y') }}
                                    pukul {{ \Carbon\Carbon::parse($event->waktu)->format('H:i') }}
                                </div>
                                <div>
                                    {{ $event->lokasi }}
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- FORM SUBMIT --}}
            <form action="{{ route('wedding-photographer.jadwal.batal', $booking->id) }}" method="post" id="pesananForm">
                @csrf
                {{-- STATUS --}}
                <div class="hidden">
                    <input type="text" name="status" id="status" value="">
                </div>

                <div class="w-full p-2 flex items-center justify-end gap-2">
                    <a class="w-fit px-4 py-2 font-semibold outline-none text-pink bg-white hover:bg-pink hover:text-white focus:bg-pink focus:text-white active:bg-pink-active transition-colors rounded"
                        href="{{ url()->previous() }}">
                        <i class="fa-solid fa-arrow-left-long"></i>
                        <span>Kembali</span>
                    </a>

                    @if (!$booking->bukti_bayar)
                        <button class="w-fit px-4 py-2 font-semibold outline-none text-red-400 bg-white hover:bg-red-400 hover:text-white focus:bg-red-400 focus:text-white active:bg-red-200 transition-colors rounded"
                            id="rejectBtn" type="button" onclick="respon('ditolak')">
                            <i class="fa-solid fa-ban"></i>
                            <span>Batalkan</span>
                        </button>
                    @endif
                </div>
            </form>
        </div>

        {{-- KANAN --}}
        <div class="w-full h-fit">
            {{-- STATUS --}}
            <div class="w-full px-4 py-2 bg-green-400 text-white font-semibold rounded-tr-lg border-2 border-green-400 text-end">
                {{ $booking->status }}
            </div>

            {{-- PEMESAN --}}
            <div class="w-full p-2 text-sm border-2 border-slate-100">
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

            {{-- DETAIL PAKET & ULASAN --}}
            @if ($booking->status == 'dibayar')
                {{-- DETAIL PAKET --}}
                <div class="w-full p-2 border-2 border-t-0 border-slate-100">
                    {{-- nama --}}
                    <div class="w-full">
                        <span class="text-2xl font-semibold">
                            {{ $plan->nama }}
                        </span>
                    </div>

                    {{-- detail --}}
                    <div class="w-full max-h-[100px] p-4 overflow-y-auto">
                        <p>
                            {!! $plan->detail !!}
                        </p>
                    </div>

                    {{-- harga --}}
                    <div class="w-full flex items-start justify-end gap-2">
                        <i class="fa-solid fa-rupiah-sign text-xl"></i>
                        <span class="text-xl">
                            {{ number_format($plan->harga, 0, ',', '.') }}
                        </span>
                    </div>
                </div>
            @else
                {{-- ULASAN --}}
                <div class="w-full p-4 border-2 border-t-0 border-slate-100 text-sm">
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
            @endif

            {{-- TANGGAL PESAN --}}
            <div class="w-full p-2 border-2 border-t-0 border-slate-100">
                <p>
                    Dipesan untuk tanggal : {{ $booking->untuk_tanggal->format('d/m/Y') }}
                </p>
            </div>

            {{-- BUKTI BAYAR --}}
            <div class="w-full p-2 border-2 border-t-0 border-slate-100 rounded-b-lg">
                @if ($booking->bukti_bayar)
                    <div class="w-full flex items-center justify-center overflow-hidden bg-slate-200 rounded-lg">
                        <a class="cursor-zoom-in"
                            id="bukti_bayar_img" href="{{ asset($booking->bukti_bayar) }}">
                            <img class="max-h-[300px] object-contain object-center"
                                src="{{ asset($booking->bukti_bayar) }}" alt="Bukti Bayar">
                        </a>
                    </div>

                    <div class="w-full mt-2">
                        <a class="w-full block px-4 py-2 text-center font-semibold outline-none text-pink bg-white hover:bg-pink hover:text-white focus:bg-pink focus:text-white active:bg-pink-active transition-colors rounded"
                            href="{{ asset($booking->bukti_bayar) }}" download>
                            <i class="fa-solid fa-download"></i>
                            Unduh Gambar
                        </a>
                    </div>
                @else
                    <div class="w-full bg-slate-200 rounded-lg">
                        <div class="w-full p-4 text-center">
                            Belum ada bukti bayar
                        </div>
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
