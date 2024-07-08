{{-- CATERING --}}
<div id="include-ct">
    @forelse ($bookedCatering as $bct)
        @php
            $classes = $statusClasses[$bct->status] ?? $defaultClasses;
        @endphp

        {{-- BOOKED Catering CARD --}}
        <div class="w-full flex items-center justify-between gap-4 rounded-md border-l-8 border-{{ $classes[0] }}">
            {{-- NAMA --}}
            <div class="w-full p-2 flex items-center justify-start gap-2">
                <span class="flex-shrink-0 w-[50px] aspect-square flex items-center justify-center bg-pink rounded text-white">
                    <i class="fa-solid fa-utensils"></i>
                </span>
                {{-- NAMA --}}
                <a class="w-fit text-start text-lg line-clamp-1 font-semibold outline-pink outline-offset-4 hover:underline focus:underline"
                    href="{{ route('wedding-couple.search.ct.ke_detail', $bct->plan->w_vendor->id) }}" target="_blank">
                    {{ $bct->plan->w_vendor->nama }}
                </a>
            </div>

            {{-- STATUS --}}
            <div class="flex items-center justify-start gap-2 text-sm italic">
                <div class="w-fit aspect-square rounded-full text-{{ $classes[0] }}">
                    <i class="fa-solid {{ $classes[1] }}"></i>
                </div>
                <span class="text-gray-400">
                    {{ $bct->status }}
                </span>
            </div>

            {{-- TOMBOL OPEN MODAL --}}
            <div class="w-fit text-end">
                <button class="openFtgModalBtn w-fit px-2 py-1 rounded outline-pink outline-offset-4 bg-pink text-white hover:bg-pink-hover focus:bg-pink-hover active:bg-pink-active transition-colors"
                    type="button" data-ftg-modal="{{ $bct->id }}">
                    <i class="fa-solid fa-{{ $bct->status == 'selesai' ? 'star' : 'magnifying-glass' }}"></i>
                </button>
            </div>
        </div>

        {{-- FOTOGRAFER BOOKING DETAIL MODAL --}}
        <div class="fixed top-full left-0 w-full h-screen flex items-center justify-center bg-slate-500/50 z-10 transition-all duration-500"
            id="bookingFtgModal-{{ $bct->id }}">
            <div class="w-[80%] max-w-[1200px] bg-white rounded-md">
                {{-- atas --}}
                <div class="w-full p-4 flex items-center justify-between">
                    <div>
                        <span class="text-xl font-semibold">
                            Detail Pemesanan Catering
                        </span>
                    </div>

                    {{-- TOMBOL CLOSE MODAL --}}
                    <div>
                        <button class="closeFtgModalBtn w-fit px-2 aspect-square rounded outline-pink outline-offset-4 bg-pink text-white hover:bg-pink-hover focus:bg-pink-hover active:bg-pink-active transition-colors"
                            type="button" tabindex="-1" data-ftg-modal="{{ $bct->id }}">
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
                                {{-- GAMBAR --}}
                                <div>
                                    @if ($bct->plan->w_vendor->foto_profil)
                                        <img class="w-[50px] aspect-square object-cover object-center rounded-full border-2 border-pink"
                                            src="{{ asset($bct->plan->w_vendor->foto_profil) }}" alt="Foto Profil" id="fotoProfil">
                                    @else
                                        <span class="w-[50px] aspect-square bg-pink rounded-full flex items-center justify-center text-[1.25em] font-bold text-white border-4 border-pink"
                                            id="fotoProfilText">
                                            {{ substr($bct->plan->w_vendor->nama, 0, 1) }}
                                        </span>
                                    @endif
                                </div>

                                <a class="block text-2xl font-semibold outline-pink outline-offset-4 hover:underline focus:underline"
                                    href="{{ route('wedding-couple.search.ct.ke_detail', $bct->plan->w_vendor->id) }}" tabindex="-1" target="_blank">
                                    {{ $bct->plan->w_vendor->nama }}
                                </a>
                            </div>

                            {{-- paket --}}
                            <div class="w-full mb-4">
                                <div class="w-full flex items-center justify-start gap-4">
                                    <span class="text-lg text-pink">
                                        <i class="fa-solid fa-gift"></i>
                                    </span>

                                    <span class="text-lg font-semibold">
                                        {{ $bct->plan->nama }}
                                    </span>
                                </div>

                                {{-- fitur --}}
                                <div class="w-full max-h-[200px] overflow-y-auto px-4 my-2 detail-plan">
                                    {!! $bct->plan->detail !!}
                                </div>
                            </div>

                            {{-- tanggal --}}
                            <div class="w-full">
                                <span>
                                    Dipesan untuk tanggal {{ date('d/m/Y', strtotime($bct->untuk_tanggal)) }}
                                </span>
                            </div>
                        </div>

                        {{-- kanan --}}
                        <div class="w-full p-2 text-start">
                            @if ($bct->status == 'diterima' || $bct->status == 'dibayar')
                                @php
                                    $transaction = $bct->transaction()->latest()->first();
                                @endphp
                                @if (!$transaction || ($transaction && !in_array($transaction->transaction_status, ['pending', 'capture', 'settlement'])))
                                    <button class="pay-button w-full p-2 bg-white rounded border border-pink text-pink
                                        hover:bg-pink hover:text-white
                                        focus:bg-pink focus:text-white
                                        transition-colors"
                                        data-id_booking="{{ $bct->id }}">
                                        Buat Transaksi
                                    </button>
                                    <div id="snap-container-{{ $bct->id }}" class="snap-container w-full"></div>
                                @elseif ($transaction)
                                    <div class="w-full">
                                        <div class="w-full mb-4 flex items-center justify-start gap-4">
                                            @if ($transaction->transaction_status == 'pending')
                                                <i class="fa-regular fa-clock text-yellow-400"></i>
                                                Segera selesaikan pembayaran Anda
                                            @else
                                                <i class="fa-regular fa-circle-check text-green-400"></i>
                                                Pembayaran telah berhasil!
                                            @endif
                                        </div>

                                        <div class="w-full mb-16">
                                            {{-- QRIS --}}
                                            @if ($transaction->payment_type == 'qris')
                                                <div class="w-full text-center mb-2">
                                                    QRIS
                                                </div>
                                                <img class="w-[300px] aspect-square mx-auto"
                                                    src="https://api.sandbox.midtrans.com/v2/qris/{{ $transaction->transaction_id }}/qr-code" alt="Qris">
                                                @if ($transaction->transaction_status == 'pending')
                                                    <div>
                                                        Waktu Expired : {{ \Carbon\Carbon::parse($transaction->expiry_time)->translatedFormat('l, d F Y - H : m : s') }}
                                                    </div>
                                                @else
                                                    <div>
                                                        Diselesaikan pada : {{ \Carbon\Carbon::parse($transaction->updated_at)->translatedFormat('l, d F Y - H : m : s') }}
                                                    </div>
                                                @endif

                                            {{-- BANKS & TRANSFER BANK --}}
                                            @else
                                                {{-- BANK NAME --}}
                                                <div class="w-full mb-2">
                                                    Bank : {{ $transaction->bank }}
                                                </div>

                                                {{-- VA NUMBER --}}
                                                @if ($transaction->payment_type == 'bank_transfer')
                                                    <div class="w-full mb-2 flex items-center justify-start gap-4">
                                                        <div>
                                                            Nomor Virtual Account : {{ $transaction->va_number }}
                                                        </div>
                                                        <button class="copyToClipBtn text-pink" data-value="{{ $transaction->va_number }}">
                                                            <i class="fa-regular fa-clone"></i>
                                                        </button>
                                                    </div>
                                                @elseif ($transaction->payment_type == 'echannel')
                                                        <div class="w-full mb-2 flex items-center justify-start gap-4">
                                                        <div>
                                                            Bill Key - Biller Code : {{ $transaction->va_number }}
                                                        </div>
                                                        <button class="copyToClipBtn text-pink" data-value="{{ $transaction->va_number }}">
                                                            <i class="fa-regular fa-clone"></i>
                                                        </button>
                                                    </div>
                                                @endif

                                                {{-- NOMINAL --}}
                                                <div class="w-full mb-2 flex items-center justify-start gap-4">
                                                    <div>
                                                        Nominal : {{ number_format($transaction->gross_amount) }}
                                                    </div>
                                                    <button class="copyToClipBtn text-pink" data-value="{{ $transaction->gross_amount }}">
                                                        <i class="fa-regular fa-clone"></i>
                                                    </button>
                                                </div>

                                                {{-- WAKTU --}}
                                                @if ($transaction->transaction_status == 'pending')
                                                    <div>
                                                        Waktu Expired : {{ \Carbon\Carbon::parse($transaction->expiry_time)->translatedFormat('l, d F Y - H : m : s') }}
                                                    </div>
                                                @else
                                                    <div>
                                                        Diselesaikan pada : {{ \Carbon\Carbon::parse($transaction->updated_at)->translatedFormat('l, d F Y - H : m : s') }}
                                                    </div>
                                                @endif
                                            @endif
                                        </div>

                                        @if ($transaction->transaction_status == 'pending')
                                            <div class="w-full flex items-center justify-evenly gap-4">
                                                <a class="cancel-transaction block w-full px-4 py-2 rounded border border-pink bg-white text-pink text-sm text-center
                                                    hover:bg-pink hover:text-white
                                                    focus:bg-pink focus:text-white
                                                    active:bg-pink-active transition-colors"
                                                    href="{{ route('wedding-couple.transaksi.batal', $transaction->order_id) }}">
                                                    Batal
                                                </a>
                                                <a class="block w-full px-4 py-2 rounded border border-pink bg-pink text-white text-sm text-center
                                                    hover:bg-pink-hover focus:bg-pink-hover active:bg-pink-active transition-colors"
                                                    href="{{ route('wedding-couple.transaksi.cek_status', $transaction->order_id) }}">
                                                    Cek Status
                                                </a>
                                            </div>
                                        @endif
                                    </div>
                                @else
                                    {{ $transaction }}
                                @endif
                            @elseif ($bct->status == 'selesai')
                                <div class="w-full">
                                    <form action="{{ route('wedding-couple.pernikahan.ulasan', $bct->id) }}" method="post" id="ulasWPForm-{{ $bct->id }}">
                                        @csrf

                                        {{-- RATING --}}
                                        <div class="w-full mb-4">
                                            <div class="w-full flex items-center justify-center gap-2 ratingStars" id="ratingStarsWP-{{ $bct->id }}">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    <button type="button" class="starBtn"
                                                        data-value="{{ $i }}">
                                                        <i class="fa-solid fa-star {{ $bct->rating && $bct->rating->rating >= $i ? 'text-pink' : ($i == 1 ? 'text-pink' : '') }}"></i>
                                                    </button>
                                                @endfor
                                            </div>

                                            {{-- HIDDEN RATING INPUT --}}
                                            <input hidden type="number" name="rating" class="ratingInput"
                                                value="{{ old('rating', $bct->rating ? $bct->rating->rating : 1) }}" min="1" max="5" required>

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
                                                name="komentar" rows="5" required placeholder="tulis ulasan anda ..." minlength="10" maxlength="250">{{ old('komentar', $bct->rating ? $bct->rating->komentar : '') }}</textarea>

                                            <div class="mt-1 text-sm text-red-500 flex items-center justify-start gap-2">
                                                @error('komentar')
                                                    <i class="fa-solid fa-circle-info"></i>
                                                    <span>{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        {{-- BUTTON --}}
                                        <div class="w-full text-end">
                                            @if ($bct->status == 'selesai' && !$bct->w_booking)
                                                <button class="w-fit px-4 py-2 rounded outline-pink outline-offset-4 bg-pink text-white hover:bg-pink-hover focus:bg-pink-hover active:bg-pink-active transition-colors"
                                                        type="submit" tabindex="-1">
                                                    {{ $bct->rating ? 'Ubah' : 'Kirim' }} Ulasan
                                                </button>
                                            @endif
                                        </div>
                                    </form>
                                </div>
                            @elseif ($bct->status == 'ditolak')
                                <p>Pesanan telah ditolak pihak fotografer. Silahkan batalkan pesanan dan pilih fotografer lainnya. </p>
                            @else
                                <p>Menunggu pesanan diterima pihak fotografer.</p>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- bawah --}}
                <div class="w-full px-4 py-2 flex items-center justify-between text-[.9em]">
                    {{-- status --}}
                    <div class="flex items-center justify-start gap-2">
                        <div class="w-fit aspect-square rounded-full text-{{ $classes[0] }}">
                            <i class="fa-solid {{ $classes[1] }}"></i>
                        </div>
                        <span>
                            {{ $bct->status }}
                        </span>
                    </div>

                    {{-- buttons --}}
                    <div class="w-fit">
                        @if ($bct->status == 'diproses' || $bct->status == 'ditolak')
                            <form action="{{ route('wedding-couple.pernikahan.hapus_wo', $bct->id) }}" method="post" id="hapusWPForm-{{ $bct->id }}">
                                @csrf
                                <button class="hapusWPBtn w-fit px-4 py-2 rounded outline-pink outline-offset-4 bg-pink text-white hover:bg-pink-hover focus:bg-pink-hover active:bg-pink-active transition-colors"
                                    type="button" data-id="{{ $bct->id }}" tabindex="-1">
                                    Batalkan Pesanan
                                </button>
                            </form>
                        @endif
                        @if ($bct->untuk_tanggal <= $today && $bct->status == 'dibayar')
                            <button class="w-fit px-4 py-2 rounded outline-pink outline-offset-4 bg-pink text-white hover:bg-pink-hover focus:bg-pink-hover active:bg-pink-active transition-colors"
                                type="button" id="selesaiBtn" tabindex="-1" data-id_booking="{{ $bct->id }}">
                                Selesaikan Pesanan
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @empty

    @endforelse

    {{-- <a class="block w-fit mx-auto px-4 py-2 text-sm bg-pink text-white outline-pink outline-offset-4 hover:bg-pink-hover focus:bg-pink-hover active:bg-pink-active rounded-full transition-colors"
        href="{{ route('wedding-couple.search.ct.index') }}">
            <i class="fa-solid fa-magnifying-glass"></i>
            Cari Catering
    </a> --}}
</div>