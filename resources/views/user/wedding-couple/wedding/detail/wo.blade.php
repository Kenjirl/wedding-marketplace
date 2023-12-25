{{-- ORGANIZER --}}
<div class="flex-1 w-full text-center">
    @if ($bookedOrganizer)
        {{-- BOOKED WO CARD --}}
        @if ($bookedOrganizer->status == 'ditolak')
            <div class="w-3/4 mx-auto rounded-md border-l-8 border-red-400">
        @elseif ($bookedOrganizer->status == 'diterima')
            <div class="w-3/4 mx-auto rounded-md border-l-8 border-blue-400">
        @elseif ($bookedOrganizer->status == 'selesai')
            <div class="w-3/4 mx-auto rounded-md border-l-8 border-green-400">
        @else
            <div class="w-3/4 mx-auto rounded-md border-l-8 border-yellow-400">
        @endif
            <div class="w-full p-4 flex items-center justify-start gap-2 border-2 border-l-0 border-slate-100 rounded-tr-md">
                {{-- GAMBAR --}}
                <div>
                    @if ($bookedOrganizer->plan->w_organizer->foto_profil)
                        <img class="w-[50px] aspect-square object-cover object-center rounded-full border-2 border-pink"
                            src="{{ asset($bookedOrganizer->plan->w_organizer->foto_profil) }}" alt="Foto Profil" id="fotoProfil">
                    @else
                        <span class="w-[50px] aspect-square bg-pink rounded-full flex items-center justify-center text-[1.25em] font-bold text-white border-4 border-pink"
                            id="fotoProfilText">
                            {{ substr($bookedOrganizer->plan->w_organizer->nama_perusahaan, 0, 1) }}
                        </span>
                    @endif
                </div>

                {{-- NAMA PERUSH --}}
                <div class="text-xl font-semibold">
                    <a class="w-fit outline-pink outline-offset-4 underline"
                        href="{{ route('wedding-couple.search.wo.ke_detail', $bookedOrganizer->plan->w_organizer->id) }}" target="_blank">
                        {{ $bookedOrganizer->plan->w_organizer->nama_perusahaan }}
                    </a>
                </div>
            </div>

            {{-- NAMA PLAN --}}
            <div class="w-full mx-auto py-4 px-6 border-e-2 border-slate-100">
                <div class="w-full flex items-center justify-start gap-2">
                    <i class="fa-solid fa-gift text-3xl text-pink"></i>
                    <span>
                        {{ $bookedOrganizer->plan->nama }}
                    </span>
                </div>
            </div>

            {{-- BAWAH --}}
            <div class="w-full p-4 flex items-center justify-between border-2 border-l-0 border-slate-100 rounded-br-md">
                {{-- STATUS --}}
                <div class="flex items-center justify-start gap-2 text-[.9em]">
                    @if ($bookedOrganizer->status == 'ditolak')
                        <div class="w-fit aspect-square rounded-full text-red-500">
                            <i class="fa-solid fa-circle-xmark"></i>
                        </div>
                    @elseif ($bookedOrganizer->status == 'diterima')
                        <div class="w-fit aspect-square rounded-full text-blue-500">
                            <i class="fa-solid fa-circle-check"></i>
                        </div>
                    @elseif ($bookedOrganizer->status == 'selesai')
                        <div class="w-fit aspect-square rounded-full text-green-500">
                            <i class="fa-solid fa-circle-check"></i>
                        </div>
                    @else
                        <div class="w-fit aspect-square rounded-full text-yellow-400">
                            <i class="fa-solid fa-clock"></i>
                        </div>
                    @endif
                    <span>
                        {{ $bookedOrganizer->status }}
                    </span>
                </div>

                {{-- TOMBOL OPEN MODAL --}}
                <div class="flex-1 w-full text-end">
                    <button class="w-fit px-4 py-2 rounded outline-pink outline-offset-4 bg-pink text-white hover:bg-pink-hover focus:bg-pink-hover active:bg-pink-active transition-colors"
                        type="button" id="openOrgModalBtn">
                        Detail
                    </button>
                </div>
            </div>
        </div>

        {{-- ORGANIZER BOOKING DETAIL MODAL --}}
        <div class="fixed top-full left-0 w-full h-screen flex items-center justify-center bg-slate-500/50 z-10 transition-all duration-500"
            id="bookingOrgModal">
            <div class="max-w-[1200px] bg-white rounded-md">
                {{-- ATAS --}}
                <div class="w-full p-4 flex items-center justify-between">
                    <div>
                        <span class="text-xl font-semibold">
                            Detail Pemesanan Organizer
                        </span>
                    </div>

                    {{-- TOMBOL CLOSE MODAL --}}
                    <div>
                        <button class="w-fit px-4 aspect-square rounded outline-pink outline-offset-4 bg-pink text-white hover:bg-pink-hover focus:bg-pink-hover active:bg-pink-active transition-colors"
                            type="button" id="closeOrgModalBtn" tabindex="-1">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </div>
                </div>

                {{-- konten --}}
                <div class="w-full max-h-[70vh] overflow-y-auto p-4 border-y-2">
                    {{-- grid --}}
                    <div class="w-full grid grid-cols-2 gap-4 text-start">
                        {{-- kiri --}}
                        <div class="w-full">
                            {{-- nama --}}
                            <div class="w-full mb-4 flex items-center justify-start gap-4">
                                <span class="w-fit px-4 flex items-center justify-center aspect-square bg-pink rounded text-xl text-white">
                                    <i class="fa-solid fa-building"></i>
                                </span>

                                <a class="block text-2xl font-semibold outline-pink outline-offset-4 underline"
                                    href="{{ route('wedding-couple.search.wo.ke_detail', $bookedOrganizer->plan->w_organizer->id) }}" tabindex="-1" target="_blank">
                                    {{ $bookedOrganizer->plan->w_organizer->nama_perusahaan }}
                                </a>
                            </div>

                            {{-- paket --}}
                            <div class="w-full mb-4">
                                <div class="w-full flex items-center justify-start gap-4">
                                    <span class="text-lg text-pink">
                                        <i class="fa-solid fa-gift"></i>
                                    </span>

                                    <span class="text-lg font-semibold">
                                        {{ $bookedOrganizer->plan->nama }}
                                    </span>
                                </div>

                                {{-- FITUR --}}
                                <div class="w-full pl-8">
                                    <ul class="list-disc grid grid-cols-2 gap-2">
                                        @forelse ($bookedOrganizer->plan->fitur as $fitur)
                                            <li>{{ $fitur->isi }}</li>
                                        @empty
                                            <li>Tidak ada fitur</li>
                                        @endforelse
                                    </ul>
                                </div>
                            </div>

                            {{-- tanggal --}}
                            <div class="w-full">
                                <span>
                                    Dipesan untuk tanggal {{ date('d-m-Y', strtotime($bookedOrganizer->untuk_tanggal)) }}
                                </span>
                            </div>
                        </div>

                        {{-- kanan --}}
                        <div class="w-full p-2 text-start">
                            {{-- nomor rekening --}}
                            <div class="w-full text-base">
                                <div class="w-full mb-4">
                                    <span>
                                        Silahkan transfer ke nomor rekening <b>Bank {{ $bookedOrganizer->plan->w_organizer->jenis_rekening }}</b> berikut:
                                    </span>
                                    <div class="w-full flex items-stretch justify-center rounded-md border-2 border-slate-300">
                                        <div class="flex-1 w-full p-2">
                                            {{ implode('-', str_split($bookedOrganizer->plan->w_organizer->no_rekening, 4)) }}
                                        </div>

                                        <button class="copyToClipBtn w-10 aspect-square p-2 rounded-e outline-pink outline-offset-4 bg-slate-300 hover:bg-slate-200 focus:bg-slate-200 transition-colors"
                                            data-value="{{ $bookedOrganizer->plan->w_organizer->no_rekening }}" tabindex="-1">
                                            <i class="fa-regular fa-copy"></i>
                                        </button>
                                    </div>
                                </div>

                                <div class="w-full mb-4">
                                    <span>
                                        Dengan nominal pembayaran:
                                    </span>
                                    <div class="w-full flex items-stretch justify-center rounded-md border-2 border-slate-300">
                                        <div class="flex-1 w-full p-2">
                                            Rp {{ number_format($bookedOrganizer->plan->harga, 0, ',', '.') }}
                                        </div>

                                        <button class="copyToClipBtn w-10 aspect-square p-2 rounded-e outline-pink outline-offset-4 bg-slate-300 hover:bg-slate-200 focus:bg-slate-200 transition-colors"
                                            data-value="{{ $bookedOrganizer->plan->harga }}" tabindex="-1">
                                            <i class="fa-regular fa-copy"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            {{-- gambar / input gambar bukti bayar --}}
                            <div class="w-full max-w-[400px] mx-auto">
                                <div class="w-full p-2 text-center bg-slate-300 rounded-t">
                                    Bukti Pembayaran
                                </div>
                                @if ($bookedOrganizer->bukti_bayar)
                                    <div class="w-full aspect-square mx-auto mb-4 flex items-center justify-center rounded-b border-2 border-t-0 border-slate-300 overflow-hidden"
                                        id="upBuktiBayarOrgContainer">
                                        <img class="h-full object-contain"
                                            src="{{ asset($bookedOrganizer->bukti_bayar) }}" alt="Bukti bayar organizer">
                                    </div>
                                @else
                                    <form action="{{ route('wedding-couple.pernikahan.upload_bukti_bayar_wo', $bookedOrganizer->id) }}" method="post" enctype="multipart/form-data" id="buktiBayarOrgForm">
                                        @csrf
                                        <div class="w-full aspect-square mx-auto mb-4 flex items-center justify-center rounded-b border-2 border-t-0 border-slate-300 overflow-hidden"
                                            id="upBuktiBayarOrgContainer">
                                            {{-- Nanti diisi dengan JS --}}
                                            Belum ada bukti pembayaran
                                        </div>
                                        <input class="hidden" type="file" name="bukti_bayar" id="bukti_bayar_org" accept="image/*" value="" tabindex="-1">
                                        <div class="w-full flex items-center justify-center gap-2">
                                            <button class="flex-1 w-full px-4 py-2 rounded outline-pink outline-offset-4 bg-white text-pink hover:bg-pink hover:text-white focus:bg-pink focus:text-white active:bg-pink-active transition-colors"
                                                type="button" id="upBuktiBayarOrgBtn" tabindex="-1">
                                                Pilih Gambar
                                            </button>
                                            <button class="flex-1 w-full px-4 py-2 rounded outline-pink outline-offset-4 bg-pink text-white hover:bg-pink-hover focus:bg-pink-hover active:bg-pink-active disabled:outline-slate-200 disabled:bg-slate-200 disabled:text-slate-500 disabled:cursor-not-allowed transition-colors"
                                                type="button" id="submitBuktiBayarOrgBtn" disabled tabindex="-1">
                                                Unggah Gambar
                                            </button>
                                        </div>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                {{-- bawah --}}
                <div class="w-full p-4 flex items-center justify-between">
                    {{-- status --}}
                    <div class="flex items-center justify-start gap-2 text-[.9em]">
                        @if ($bookedOrganizer->status == 'ditolak')
                            <div class="w-fit aspect-square rounded-full text-red-500">
                                <i class="fa-solid fa-circle-xmark"></i>
                            </div>
                        @elseif ($bookedOrganizer->status == 'diterima')
                            <div class="w-fit aspect-square rounded-full text-blue-500">
                                <i class="fa-solid fa-circle-check"></i>
                            </div>
                        @elseif ($bookedOrganizer->status == 'selesai')
                            <div class="w-fit aspect-square rounded-full text-green-500">
                                <i class="fa-solid fa-circle-check"></i>
                            </div>
                        @else
                            <div class="w-fit aspect-square rounded-full text-yellow-400">
                                <i class="fa-solid fa-clock"></i>
                            </div>
                        @endif
                        <span>
                            {{ $bookedOrganizer->status }}
                        </span>
                    </div>

                    {{-- buttons --}}
                    <div class="w-fit text-sm">
                        {{-- @if ($bookedOrganizer->status == 'diproses' || $bookedOrganizer->status == 'ditolak') --}}
                        @if ($bookedOrganizer->status != 'selesai')
                            <form action="{{ route('wedding-couple.pernikahan.hapus_wo', $bookedOrganizer->id) }}" method="post" id="hapusWOForm">
                                @csrf
                                <button class="w-fit px-4 py-2 rounded outline-pink outline-offset-4 bg-pink text-white hover:bg-pink-hover focus:bg-pink-hover active:bg-pink-active transition-colors"
                                    type="button" id="hapusWOBtn" tabindex="-1">
                                    Batalkan Pesanan
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @else
        <a class="block w-fit mx-auto px-4 py-2 bg-pink text-white outline-pink outline-offset-4 hover:bg-pink-hover focus:bg-pink-hover active:bg-pink-active rounded-full transition-colors"
            href="{{ route('wedding-couple.search.wo.index') }}">
                <i class="fa-solid fa-magnifying-glass"></i>
                Cari Wedding Organizer
        </a>
    @endif
</div>
