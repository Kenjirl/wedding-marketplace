<div class="w-full flex items-start justify-center">
    <div class="flex-1 w-full">
        {{-- EVENTS --}}
        <div class="w-full max-h-[600px] p-4 overflow-y-auto">
            @foreach ($weddingEvents as $w_event)
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
                                {{ $w_event->event->nama }}
                            </div>

                            <div class="w-4 aspect-square flex items-center justify-end text-sm cursor-pointer"
                                data-tippy-content="{{ $w_event->event->keterangan }}">
                                <i class="fa-regular fa-circle-question"></i>
                            </div>
                        </div>

                        <div class="w-full h-[2px] my-1 bg-pink"></div>

                        {{-- BOTTOM --}}
                        <div class="w-full text-sm text-gray-400 italic">
                            <div>
                                Pada {{ \Carbon\Carbon::parse($w_event->waktu)->format('d/m/Y') }}
                                pukul {{ \Carbon\Carbon::parse($w_event->waktu)->format('H:i') }}
                            </div>
                            <div>
                                {{ $w_event->lokasi }}
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="flex-1 w-full">
        <div class="w-3/4 mx-auto">
        {{-- FILTER BUTTON --}}
        <div class="p-4 flex items-center justify-start gap-2 border-b-2 border-pink overflow-x-auto">
            <button class="w-[40px] aspect-square flex items-center justify-center rounded shadow bg-pink text-white
                outline-pink outline-offset-4
                hover:bg-pink hover:text-white
                focus:bg-pink focus:text-white
                active:bg-pink-active active:text-white
                transition-colors"
                id="filter-btn" title="hapus filter">
                <i class="fa-solid fa-filter"></i>
            </button>
            @foreach ($m_j_vendors as $j_vendor)
                <button class="w-[40px] aspect-square flex items-center justify-center rounded shadow text-pink
                    outline-pink outline-offset-4
                    hover:bg-pink hover:text-white
                    focus:bg-pink focus:text-white
                    active:bg-pink-active active:text-white
                    transition-colors"
                    data-target="{{ $j_vendor->id }}" title="{{ $j_vendor->nama }}">
                    <i class="fa-solid {{ $j_vendor->icon }}"></i>
                </button>
            @endforeach
        </div>

        {{-- VENDORS --}}
        <div class="mb-4 max-h-[600px] p-4 grid grid-cols-1 gap-4 overflow-y-auto">
            @forelse ($bookedVendor as $bv)
                @php
                    $classes = $statusClasses[$bv->status] ?? $defaultClasses;
                @endphp

                {{-- BOOKED Catering CARD --}}
                <div class="w-full flex items-center justify-between gap-4 rounded-md border-l-8 border-{{ $classes[0] }}"
                    id="targetDiv-{{ $bv->plan->m_jenis_vendor_id }}">
                    {{-- NAMA --}}
                    <div class="w-full p-2 flex items-center justify-start gap-2">
                        <span class="flex-shrink-0 w-[50px] aspect-square flex items-center justify-center bg-pink rounded text-white">
                            <i class="{{ $bv->plan->jenis->icon }}"></i>
                        </span>
                        {{-- NAMA --}}
                        <a class="w-fit text-start text-lg line-clamp-1 font-semibold outline-pink outline-offset-4 hover:underline focus:underline"
                            href="{{ route('user.search.ke_detail', $bv->plan->w_vendor->id) }}" target="_blank">
                            {{ $bv->plan->w_vendor->nama }}
                        </a>
                    </div>

                    {{-- STATUS --}}
                    <div class="flex items-center justify-start gap-2 text-sm italic">
                        <div class="w-fit aspect-square rounded-full text-{{ $classes[0] }}">
                            <i class="fa-solid {{ $classes[1] }}"></i>
                        </div>
                        <span class="text-gray-400">
                            {{ $bv->status }}
                        </span>
                    </div>

                    {{-- TOMBOL OPEN MODAL --}}
                    <div class="w-fit text-end">
                        <button class="openFtgModalBtn w-fit px-2 py-1 rounded outline-pink outline-offset-4 bg-pink text-white hover:bg-pink-hover focus:bg-pink-hover active:bg-pink-active transition-colors"
                            type="button" data-ftg-modal="{{ $bv->id }}">
                            <i class="fa-solid fa-{{ $bv->status == 'selesai' ? 'star' : 'magnifying-glass' }}"></i>
                        </button>
                    </div>
                </div>

                {{-- FOTOGRAFER BOOKING DETAIL MODAL --}}
                <div class="fixed top-full left-0 w-full h-screen flex items-center justify-center bg-slate-500/50 z-10 transition-all duration-500"
                    id="bookingFtgModal-{{ $bv->id }}">
                    <div class="w-[80%] max-w-[1200px] bg-white rounded-md">
                        {{-- atas --}}
                        <div class="w-full p-4 flex items-center justify-between">
                            <div>
                                <span class="text-xl font-semibold">
                                    Detail Pemesanan Vendor
                                </span>
                            </div>

                            {{-- TOMBOL CLOSE MODAL --}}
                            <div>
                                <button class="closeFtgModalBtn w-fit px-2 aspect-square rounded outline-pink outline-offset-4 bg-pink text-white hover:bg-pink-hover focus:bg-pink-hover active:bg-pink-active transition-colors"
                                    type="button" tabindex="-1" data-ftg-modal="{{ $bv->id }}">
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
                                            @if ($bv->plan->w_vendor->foto_profil)
                                                <img class="w-[50px] aspect-square object-cover object-center rounded-full border-2 border-pink"
                                                    src="{{ asset($bv->plan->w_vendor->foto_profil) }}" alt="Foto Profil" id="fotoProfil">
                                            @else
                                                <span class="w-[50px] aspect-square bg-pink rounded-full flex items-center justify-center text-[1.25em] font-bold text-white border-4 border-pink"
                                                    id="fotoProfilText">
                                                    {{ substr($bv->plan->w_vendor->nama, 0, 1) }}
                                                </span>
                                            @endif
                                        </div>

                                        <a class="block text-2xl font-semibold outline-pink outline-offset-4 hover:underline focus:underline"
                                            href="{{ route('user.search.ke_detail', $bv->plan->w_vendor->id) }}" tabindex="-1" target="_blank">
                                            {{ $bv->plan->w_vendor->nama }}
                                        </a>
                                    </div>

                                    {{-- paket --}}
                                    <div class="w-full mb-4">
                                        <div class="w-full flex items-center justify-start gap-4">
                                            <span class="text-lg text-pink">
                                                <i class="fa-solid fa-gift"></i>
                                            </span>

                                            <span class="text-lg font-semibold">
                                                {{ $bv->plan->nama }}
                                            </span>
                                        </div>

                                        {{-- fitur --}}
                                        <div class="w-full max-h-[200px] overflow-y-auto px-4 my-2 detail-plan">
                                            {!! $bv->plan->detail !!}
                                        </div>
                                    </div>

                                    <div class="w-fit px-2 py-1 text-xs border border-pink rounded">
                                        <i class="{{ $bv->plan->jenis->icon }} text-pink"></i>
                                        <span>
                                            {{ $bv->plan->jenis->nama }}
                                        </span>
                                    </div>

                                    <hr class="my-4">

                                    {{-- tanggal --}}
                                    <div class="w-full mt-4 flex items-center justify-between border-b">
                                        <span>
                                            Dipesan untuk tanggal :
                                        </span>
                                        <span>
                                            {{ \Carbon\Carbon::parse($bv->untuk_tanggal)->translatedFormat('l, d F Y') }}
                                        </span>
                                    </div>

                                    {{-- jumlah pesanan --}}
                                    <div class="w-full mt-2 flex items-center justify-between border-b">
                                        <span>
                                            Jumlah pesanan :
                                        </span>
                                        <span>
                                            {{ $bv->qty }} {{ $bv->plan->satuan }}
                                        </span>
                                    </div>

                                    {{-- total harga --}}
                                    <div class="w-full mt-2 flex items-center justify-between text-end text-lg">
                                        <span>Total Biaya : </span>
                                        <span class="font-semibold">
                                            Rp {{ number_format($bv->total_bayar, 0, ',', '.') }}
                                        </span>
                                    </div>
                                </div>

                                {{-- kanan --}}
                                <div class="w-full p-2 text-start">
                                    @if ($bv->status == 'diterima' || $bv->status == 'dibayar')
                                        @php
                                            $transaction = $bv->transaction()->latest()->first();
                                        @endphp
                                        @if (!$transaction || ($transaction && !in_array($transaction->transaction_status, ['pending', 'capture', 'settlement'])))
                                            <button class="pay-button w-full p-2 bg-white rounded border border-pink text-pink
                                                hover:bg-pink hover:text-white
                                                focus:bg-pink focus:text-white
                                                transition-colors"
                                                data-id_booking="{{ $bv->id }}">
                                                Buat Transaksi
                                            </button>
                                            <div id="snap-container-{{ $bv->id }}" class="snap-container w-full"></div>
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
                                                            href="{{ route('user.transaksi.batal', $transaction->order_id) }}">
                                                            Batal
                                                        </a>
                                                        <a class="block w-full px-4 py-2 rounded border border-pink bg-pink text-white text-sm text-center
                                                            hover:bg-pink-hover focus:bg-pink-hover active:bg-pink-active transition-colors"
                                                            href="{{ route('user.transaksi.cek_status', $transaction->order_id) }}">
                                                            Cek Status
                                                        </a>
                                                    </div>
                                                @endif
                                            </div>
                                        @else
                                            {{-- {{ $transaction }} --}}
                                        @endif
                                    @elseif ($bv->status == 'selesai')
                                        <div class="w-full">
                                            <form action="{{ route('user.pernikahan.ulasan', $bv->id) }}" method="post" id="ulasWPForm-{{ $bv->id }}">
                                                @csrf

                                                {{-- RATING --}}
                                                <div class="w-full mb-4">
                                                    <div class="w-full flex items-center justify-center gap-2 ratingStars" id="ratingStarsWP-{{ $bv->id }}">
                                                        @for ($i = 1; $i <= 5; $i++)
                                                            <button type="button" class="starBtn"
                                                                data-value="{{ $i }}">
                                                                <i class="fa-solid fa-star {{ $bv->rating && $bv->rating->rating >= $i ? 'text-pink' : ($i == 1 ? 'text-pink' : '') }}"></i>
                                                            </button>
                                                        @endfor
                                                    </div>

                                                    {{-- HIDDEN RATING INPUT --}}
                                                    <input hidden type="number" name="rating" class="ratingInput"
                                                        value="{{ old('rating', $bv->rating ? $bv->rating->rating : 1) }}" min="1" max="5" required>

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
                                                        name="komentar" rows="5" required placeholder="tulis ulasan anda ..." minlength="10" maxlength="250">{{ old('komentar', $bv->rating ? $bv->rating->komentar : '') }}</textarea>

                                                    <div class="mt-1 text-sm text-red-500 flex items-center justify-start gap-2">
                                                        @error('komentar')
                                                            <i class="fa-solid fa-circle-info"></i>
                                                            <span>{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                {{-- BUTTON --}}
                                                <div class="w-full text-end">
                                                    @if ($bv->status == 'selesai' && !$bv->w_booking)
                                                        <button class="w-fit px-4 py-2 rounded outline-pink outline-offset-4 bg-pink text-white hover:bg-pink-hover focus:bg-pink-hover active:bg-pink-active transition-colors"
                                                                type="submit" tabindex="-1">
                                                            {{ $bv->rating ? 'Ubah' : 'Kirim' }} Ulasan
                                                        </button>
                                                    @endif
                                                </div>
                                            </form>
                                        </div>
                                    @elseif ($bv->status == 'ditolak')
                                        <p>Pesanan telah ditolak pihak vendor. Silahkan batalkan pesanan dan pilih vendor lainnya. </p>
                                    @else
                                        <p>Menunggu pesanan diterima pihak vendor.</p>
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
                                    {{ $bv->status }}
                                </span>
                            </div>

                            {{-- buttons --}}
                            <div class="w-fit">
                                @if ($bv->status == 'diproses' || $bv->status == 'ditolak')
                                    <form action="{{ route('user.pernikahan.hapus-vendor', $bv->id) }}" method="post" id="hapusWPForm-{{ $bv->id }}">
                                        @csrf
                                        <button class="hapusWPBtn w-fit px-4 py-2 rounded outline-pink outline-offset-4 bg-pink text-white hover:bg-pink-hover focus:bg-pink-hover active:bg-pink-active transition-colors"
                                            type="button" data-id="{{ $bv->id }}" tabindex="-1">
                                            Batalkan Pesanan
                                        </button>
                                    </form>
                                @endif
                                @if ($today->gte(($bv->untuk_tanggal)) && $bv->status == 'dibayar')
                                    <button class="w-fit px-4 py-2 rounded outline-pink outline-offset-4 bg-pink text-white hover:bg-pink-hover focus:bg-pink-hover active:bg-pink-active transition-colors"
                                        type="button" id="selesaiBtn" tabindex="-1" data-id_booking="{{ $bv->id }}">
                                        Selesaikan Pesanan
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @empty

            @endforelse
        </div>

        @if ($today->lt($eventDate))
            <div class="w-full p-2">
                <a class="block w-fit mx-auto px-4 py-2 text-sm bg-pink text-white outline-pink outline-offset-4 hover:bg-pink-hover focus:bg-pink-hover active:bg-pink-active rounded-full transition-colors"
                    href="{{ route('user.search.vendor') }}">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        Cari Vendor
                </a>
            </div>
        @else
            <div class="w-full p-2 text-center text-slate-300 italic text-sm">
                pemesanan hanya dapat dilakukan sebelum tanggal acara dimulai
            </div>
        @endif
    </div>
    </div>
</div>
