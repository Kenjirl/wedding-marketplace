{{-- PHOTOGRAPHER --}}
@php
    $today = now()->toDateString();
@endphp

<div class="flex-1 w-full text-center">
    @forelse ($bookedPhotographers as $bp)
        {{-- BOOKED WP CARD --}}
        @if ($bp->status == 'ditolak')
            <div class="w-3/4 mx-auto mb-4 rounded-md border-l-8 border-red-400">
        @elseif ($bp->status == 'diterima')
            <div class="w-3/4 mx-auto mb-4 rounded-md border-l-8 border-blue-400">
        @elseif ($bp->status == 'selesai' || $bp->status == 'dibayar')
            <div class="w-3/4 mx-auto mb-4 rounded-md border-l-8 border-green-400">
        @else
            <div class="w-3/4 mx-auto mb-4 rounded-md border-l-8 border-yellow-400">
        @endif
            <div class="w-full p-4 flex items-center justify-start gap-2 border-2 border-l-0 border-slate-100 rounded-tr-md">
                {{-- GAMBAR --}}
                <div>
                    @if ($bp->plan->w_vendor->foto_profil)
                        <img class="w-[50px] aspect-square object-cover object-center rounded-full border-2 border-pink"
                            src="{{ asset($bp->plan->w_vendor->foto_profil) }}" alt="Foto Profil" id="fotoProfil">
                    @else
                        <span class="w-[50px] aspect-square bg-pink rounded-full flex items-center justify-center text-[1.25em] font-bold text-white border-4 border-pink"
                            id="fotoProfilText">
                            {{ substr($bp->plan->w_vendor->nama, 0, 1) }}
                        </span>
                    @endif
                </div>

                {{-- NAMA --}}
                <div class="text-xl font-semibold">
                    <a class="w-fit outline-pink outline-offset-4 hover:underline focus:underline"
                        href="{{ route('wedding-couple.search.wp.ke_detail', $bp->plan->w_vendor->id) }}" target="_blank">
                        {{ $bp->plan->w_vendor->nama }}
                    </a>
                </div>
            </div>

            {{-- BAWAH --}}
            <div class="w-full p-4 flex items-center justify-between border-2 border-t-0 border-l-0 border-slate-100 rounded-br-md">
                {{-- STATUS --}}
                <div class="flex items-center justify-start gap-2 text-[.9em]">
                    @if ($bp->status == 'ditolak')
                        <div class="w-fit aspect-square rounded-full text-red-500">
                            <i class="fa-solid fa-circle-xmark"></i>
                        </div>
                    @elseif ($bp->status == 'diterima')
                        <div class="w-fit aspect-square rounded-full text-blue-500">
                            <i class="fa-solid fa-circle-check"></i>
                        </div>
                    @elseif ($bp->status == 'selesai' || $bp->status == 'dibayar')
                        <div class="w-fit aspect-square rounded-full text-green-500">
                            <i class="fa-solid fa-circle-check"></i>
                        </div>
                    @else
                        <div class="w-fit aspect-square rounded-full text-yellow-400">
                            <i class="fa-solid fa-clock"></i>
                        </div>
                    @endif
                    <span>
                        {{ $bp->status }}
                    </span>
                </div>

                {{-- TOMBOL OPEN MODAL --}}
                <div class="flex-1 w-full flex items-center justify-end gap-4">
                    <button class="openFtgModalBtn w-fit px-4 py-2 rounded outline-pink outline-offset-4 bg-pink text-white hover:bg-pink-hover focus:bg-pink-hover active:bg-pink-active transition-colors"
                        type="button" data-ftg-modal="{{ $bp->id }}">
                        {{ $bp->status == 'selesai' ? $bp->rating ? 'Lihat Ulasan' : 'Buat Ulasan' : 'Detail' }}
                    </button>
                </div>
            </div>
        </div>

        {{-- FOTOGRAFER BOOKING DETAIL MODAL --}}
        <div class="fixed top-full left-0 w-full h-screen flex items-center justify-center bg-slate-500/50 z-10 transition-all duration-500"
            id="bookingFtgModal-{{ $bp->id }}">
            <div class="w-[80%] max-w-[1200px] bg-white rounded-md">
                {{-- atas --}}
                <div class="w-full p-4 flex items-center justify-between">
                    <div>
                        <span class="text-xl font-semibold">
                            Detail Pemesanan Fotografer
                        </span>
                    </div>

                    {{-- TOMBOL CLOSE MODAL --}}
                    <div>
                        <button class="closeFtgModalBtn w-fit px-4 aspect-square rounded outline-pink outline-offset-4 bg-pink text-white hover:bg-pink-hover focus:bg-pink-hover active:bg-pink-active transition-colors"
                            type="button" tabindex="-1" data-ftg-modal="{{ $bp->id }}">
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
                                    <i class="fa-solid fa-camera-retro"></i>
                                </span>

                                <a class="block text-2xl font-semibold outline-pink outline-offset-4 hover:underline focus:underline"
                                    href="{{ route('wedding-couple.search.wp.ke_detail', $bp->plan->w_vendor->id) }}" tabindex="-1" target="_blank">
                                    {{ $bp->plan->w_vendor->nama }}
                                </a>
                            </div>

                            {{-- paket --}}
                            <div class="w-full mb-4">
                                <div class="w-full flex items-center justify-start gap-4">
                                    <span class="text-lg text-pink">
                                        <i class="fa-solid fa-gift"></i>
                                    </span>

                                    <span class="text-lg font-semibold">
                                        {{ $bp->plan->nama }}
                                    </span>
                                </div>

                                {{-- fitur --}}
                                <div class="w-full max-h-[200px] overflow-y-auto px-4 my-2 detail-plan">
                                    {!! $bp->plan->detail !!}
                                </div>
                            </div>

                            {{-- tanggal --}}
                            <div class="w-full">
                                <span>
                                    Dipesan untuk tanggal {{ date('d-m-Y', strtotime($bp->untuk_tanggal)) }}
                                </span>
                            </div>
                        </div>

                        {{-- kanan --}}
                        <div class="w-full p-2 text-start">
                            @if ($bp->status == 'diterima' || $bp->status == 'dibayar')
                                @if ($bp->status == 'diterima')
                                    {{-- nomor rekening --}}
                                    <div class="w-full text-base">
                                        <div class="w-full mb-4">
                                            <span>
                                                Silahkan transfer ke nomor rekening berikut:
                                            </span>

                                            @foreach ($bp->plan->w_vendor->rekening as $index => $rekening)
                                                <div class="w-full mb-2 flex items-stretch justify-center rounded-md border-2 border-slate-300">
                                                    <div class="min-w-[20%] p-2 bg-slate-300 text-center">
                                                        {{ $rekening['jenis'] }}
                                                    </div>

                                                    <div class="flex-1 w-full p-2">
                                                        {{ implode('-', str_split($rekening['nomor'], 4)) }}
                                                    </div>

                                                    <button class="copyToClipBtn w-10 aspect-square p-2 rounded-e outline-pink outline-offset-4 bg-slate-300 hover:bg-slate-200 focus:bg-slate-200 transition-colors"
                                                        data-value="{{ $rekening['nomor'] }}" tabindex="-1">
                                                        <i class="fa-regular fa-copy"></i>
                                                    </button>
                                                </div>
                                            @endforeach
                                        </div>

                                        <div class="w-full mb-4">
                                            <span>
                                                Dengan nominal pembayaran:
                                            </span>
                                            <div class="w-full flex items-stretch justify-center rounded-md border-2 border-slate-300">
                                                <div class="flex-1 w-full p-2">
                                                    Rp {{ number_format($bp->plan->harga, 0, ',', '.') }}
                                                </div>

                                                <button class="copyToClipBtn w-10 aspect-square p-2 rounded-e outline-pink outline-offset-4 bg-slate-300 hover:bg-slate-200 focus:bg-slate-200 transition-colors"
                                                    data-value="{{ $bp->plan->harga }}" tabindex="-1">
                                                    <i class="fa-regular fa-copy"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                {{-- gambar / input gambar bukti bayar --}}
                                <div class="w-full max-w-[400px] mx-auto">
                                    <div class="w-full p-2 text-center bg-slate-300 rounded-t">
                                        Bukti Pembayaran
                                    </div>
                                    @if ($bp->bukti_bayar)
                                        <div class="w-full aspect-square mb-4 flex items-center justify-center rounded-b border-2 border-t-0 border-slate-300 overflow-hidden"
                                            id="upBuktiBayarOrgContainer">
                                            <img class="h-full object-contain"
                                                src="{{ asset($bp->bukti_bayar) }}" alt="Bukti fotografer">
                                        </div>
                                    @else
                                        <form action="{{ route('wedding-couple.pernikahan.upload_bukti_bayar_wp', $bp->id) }}" method="post" enctype="multipart/form-data" id="upBuktiBayarFtgForm-{{ $bp->id }}">
                                            @csrf
                                            <div class="w-full aspect-square mx-auto mb-4 flex items-center justify-center rounded-b border-2 border-t-0 border-slate-300 overflow-hidden"
                                                id="upBuktiBayarFtgContainer-{{ $bp->id }}">
                                                {{-- Nanti diisi dengan JS --}}
                                                Belum ada bukti pembayaran
                                            </div>
                                            <input class="hidden bukti_bayar_ftg" type="file" name="bukti_bayar" id="bukti_bayar_ftg-{{ $bp->id }}" data-id="{{ $bp->id }}" accept="image/*" value="" tabindex="-1">
                                            <div class="w-full flex items-center justify-center gap-2">
                                                <button class="upBuktiBayarFtgBtn flex-1 w-full px-4 py-2 rounded outline-pink outline-offset-4 bg-white text-pink hover:bg-pink hover:text-white focus:bg-pink focus:text-white active:bg-pink-active transition-colors"
                                                    type="button" data-id="{{ $bp->id }}" tabindex="-1">
                                                    Pilih Gambar
                                                </button>
                                                <button class="submitBuktiBayarFtgBtn flex-1 w-full px-4 py-2 rounded outline-pink outline-offset-4 bg-pink text-white hover:bg-pink-hover focus:bg-pink-hover active:bg-pink-active disabled:outline-slate-200 disabled:bg-slate-200 disabled:text-slate-500 disabled:cursor-not-allowed transition-colors"
                                                    type="button" id="submitBuktiBayarFtgBtn-{{ $bp->id }}" data-id="{{ $bp->id }}" tabindex="-1" disabled>
                                                    Unggah Gambar
                                                </button>
                                            </div>
                                        </form>
                                    @endif
                                </div>
                            @elseif ($bp->status == 'selesai')
                                <div class="w-full">
                                    <form action="{{ route('wedding-couple.pernikahan.ulasan', $bp->id) }}" method="post" id="ulasWPForm-{{ $bp->id }}">
                                        @csrf

                                        {{-- RATING --}}
                                        <div class="w-full mb-4">
                                            <div class="w-full flex items-center justify-center gap-2 ratingStars" id="ratingStarsWP-{{ $bp->id }}">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    <button type="button" class="starBtn"
                                                        data-value="{{ $i }}">
                                                        <i class="fa-solid fa-star {{ $bp->rating && $bp->rating->rating >= $i ? 'text-pink' : ($i == 1 ? 'text-pink' : '') }}"></i>
                                                    </button>
                                                @endfor
                                            </div>

                                            {{-- HIDDEN RATING INPUT --}}
                                            <input hidden type="number" name="rating" class="ratingInput"
                                                value="{{ old('rating', $bp->rating ? $bp->rating->rating : 1) }}" min="1" max="5" required>

                                            <div class="mt-1 text-sm text-red-500 flex items-center justify-start gap-2">
                                                @error('rating')
                                                    <i class="fa-solid fa-circle-info"></i>
                                                    <span>{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        {{-- KOMENTAR --}}
                                        <div class="w-full mb-4">
                                            <textarea class="block w-full p-2 bg-gray-50 rounded-lg border border-gray-300 outline-pink ring-pink focus:border-pink"
                                                name="komentar" rows="5" required placeholder="tulis ulasan anda ..." minlength="10" maxlength="250">{{ old('komentar', $bp->rating ? $bp->rating->komentar : '') }}</textarea>

                                            <div class="mt-1 text-sm text-red-500 flex items-center justify-start gap-2">
                                                @error('komentar')
                                                    <i class="fa-solid fa-circle-info"></i>
                                                    <span>{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        {{-- BUTTON --}}
                                        <div class="w-full text-end">
                                            @if ($bp->status == 'selesai' && !$bp->w_booking)
                                                <button class="w-fit px-4 py-2 rounded outline-pink outline-offset-4 bg-pink text-white hover:bg-pink-hover focus:bg-pink-hover active:bg-pink-active transition-colors"
                                                        type="submit" tabindex="-1">
                                                    {{ $bp->rating ? 'Ubah' : 'Kirim' }} Ulasan
                                                </button>
                                            @endif
                                        </div>
                                    </form>
                                </div>
                            @elseif ($bp->status == 'ditolak')
                                <p>Pesanan telah ditolak pihak fotografer. Silahkan batalkan pesanan dan pilih fotografer lainnya. </p>
                            @else
                                <p>Menunggu pesanan diterima pihak fotografer.</p>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- bawah --}}
                <div class="w-full p-4 flex items-center justify-between">
                    {{-- status --}}
                    <div class="flex items-center justify-start gap-2 text-[.9em]">
                        @if ($bp->status == 'ditolak')
                            <div class="w-fit aspect-square rounded-full text-red-500">
                                <i class="fa-solid fa-circle-xmark"></i>
                            </div>
                        @elseif ($bp->status == 'diterima')
                            <div class="w-fit aspect-square rounded-full text-blue-500">
                                <i class="fa-solid fa-circle-check"></i>
                            </div>
                        @elseif ($bp->status == 'selesai' || $bp->status == 'dibayar')
                            <div class="w-fit aspect-square rounded-full text-green-500">
                                <i class="fa-solid fa-circle-check"></i>
                            </div>
                        @else
                            <div class="w-fit aspect-square rounded-full text-yellow-400">
                                <i class="fa-solid fa-clock"></i>
                            </div>
                        @endif
                        <span>
                            {{ $bp->status }}
                        </span>
                    </div>

                    {{-- buttons --}}
                    <div class="w-fit text-sm">
                        @if ($bp->status == 'diproses' || $bp->status == 'ditolak')
                            <form action="{{ route('wedding-couple.pernikahan.hapus_wp', $bp->id) }}" method="post" id="hapusWPForm-{{ $bp->id }}">
                                @csrf
                                <button class="hapusWPBtn w-fit px-4 py-2 rounded outline-pink outline-offset-4 bg-pink text-white hover:bg-pink-hover focus:bg-pink-hover active:bg-pink-active transition-colors"
                                    type="button" data-id="{{ $bp->id }}" tabindex="-1">
                                    Batalkan Pesanan
                                </button>
                            </form>
                        @endif
                        @if ($bp->untuk_tanggal >= $today && $bp->status == 'dibayar')
                            <button class="w-fit px-4 py-2 rounded outline-pink outline-offset-4 bg-pink text-white hover:bg-pink-hover focus:bg-pink-hover active:bg-pink-active transition-colors"
                                type="button" id="selesaiBtn" tabindex="-1" data-id_booking="{{ $bp->id }}">
                                Selesaikan Pesanan
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @empty

    @endforelse

    @if ($bookedPhotographers->isEmpty() || $bookedPhotographers->last()->untuk_tanggal < $today)
        <a class="block w-fit mx-auto px-4 py-2 bg-pink text-white outline-pink outline-offset-4 hover:bg-pink-hover focus:bg-pink-hover active:bg-pink-active rounded-full transition-colors"
            href="{{ route('wedding-couple.search.wp.index') }}">
                <i class="fa-solid fa-magnifying-glass"></i>
                Cari Wedding Photographer
        </a>
    @endif
</div>
