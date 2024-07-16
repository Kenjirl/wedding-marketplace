@extends('vendor.layout')

@section('title')
    <title>Detail Pesanan | Wedding Marketplace</title>
@endsection

@section('h1', 'Detail Pesanan')

@section('content')
    <div class="w-full flex items-center justify-between">
        <a class="w-fit px-4 py-2 font-semibold outline-none text-pink bg-white hover:bg-pink hover:text-white focus:bg-pink focus:text-white active:bg-pink-active transition-colors rounded"
            href="{{ route('vendor.pesanan.index') }}">
            <i class="fa-solid fa-arrow-left-long"></i>
            <span>Kembali</span>
        </a>

        {{-- FORM SUBMIT --}}
        <form action="{{ route('vendor.pesanan.respon', $booking->id) }}" method="post" id="pesananForm">
            @csrf
            {{-- STATUS --}}
            <div class="hidden">
                <input type="text" name="status" id="status" value="">
            </div>

            @if ($booking->status == 'diproses')
                <div class="w-fit flex items-center justify-center gap-2">
                    <button class="w-fit px-4 py-2 font-semibold outline-none border border-red-400 text-red-400 bg-white hover:bg-red-400 hover:text-white focus:bg-red-400 focus:text-white active:bg-red-200 transition-colors rounded"
                        id="rejectBtn" type="button" onclick="respon('ditolak')">
                        <i class="fa-solid fa-ban"></i>
                        <span>Tolak</span>
                    </button>

                    <button class="w-fit px-4 py-2 font-semibold outline-none border border-blue-400 text-blue-400 bg-white hover:bg-blue-400 hover:text-white focus:bg-blue-400 focus:text-white active:bg-blue-200 transition-colors rounded"
                        id="acceptBtn" type="button" onclick="respon('diterima')">
                        <i class="fa-regular fa-circle-check"></i>
                        <span>Terima</span>
                    </button>
                </div>
            @endif
        </form>
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
            <div class="w-full p-2 border-t-2 border-slate-100">
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
            <div class="w-full px-4 py-2 text-white font-semibold rounded-tr-lg border-2 text-end
                {{ $booking->status == 'diproses' ? 'bg-yellow-400 border-yellow-400' : 'bg-blue-400 border-blue-400' }}
                ">
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
        </div>
    </div>
@endsection

@push('child-js')
    <script>
        function respon(status) {
            let title = 'menolak';
            let text = 'Anda tidak akan dapat menerima pesanan ini jika sudah ditolak'

            if (status === 'diterima') {
                title = 'menerima';
                text = 'Pastikan anda tidak memiliki jadwal yang bertabrakan';
            }

            Swal.fire({
                title: `Ingin ${title} pesanan ini?`,
                text: `${text}`,
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

        $('#detailPlan ul').addClass('list-disc px-4');
    </script>
@endpush
