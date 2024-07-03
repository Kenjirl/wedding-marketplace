<div class="w-full mb-10">
    {{-- ATAS --}}
    <div class="w-full mx-auto flex items-center justify-evenly">
        {{-- TOTAL UNDANGAN --}}
        <div>
            <div class="w-full mb-2 text-center">
                TOTAL UNDANGAN
            </div>

            <div class="w-full flex items-center justify-center">
                <div class="w-[100px] aspect-video mx-auto flex items-center justify-center rounded-xl font-semibold bg-blue-400 text-white shadow">
                    {{ $counts->total }}
                </div>
            </div>
        </div>

        {{-- STATUS PENGIRIMAN --}}
        <div>
            <div class="w-full mb-2 text-center">
                STATUS PENGIRIMAN
            </div>

            <div class="w-full flex items-center justify-center gap-2">
                <div class="w-[100px] aspect-video flex items-center justify-center rounded-xl font-semibold bg-yellow-400 text-white shadow">
                    {{ $counts->belum_terkirim ? $counts->belum_terkirim : '0' }}
                </div>
                <div class="w-[100px] aspect-video flex items-center justify-center rounded-xl font-semibold bg-green-400 text-white shadow">
                    {{ $counts->terkirim ? $counts->terkirim : '0' }}
                </div>
            </div>
        </div>

        {{-- RESPON TAMU UNDANGAN --}}
        <div>
            <div class="w-full mb-2 text-center">
                RESPON TAMU UNDANGAN
            </div>

            <div class="w-full flex items-center justify-center gap-2">
                <div class="w-[100px] aspect-video flex items-center justify-center rounded-xl font-semibold bg-yellow-400 text-white shadow">
                    {{ $counts->belum_menjawab ? $counts->belum_menjawab : '0' }}
                </div>
                <div class="w-[100px] aspect-video flex items-center justify-center rounded-xl font-semibold bg-green-400 text-white shadow">
                    {{ $counts->hadir ? $counts->hadir : '0' }}
                </div>
                <div class="w-[100px] aspect-video flex items-center justify-center rounded-xl font-semibold bg-red-400 text-white shadow">
                    {{ $counts->tidak_hadir ? $counts->tidak_hadir : '0' }}
                </div>
            </div>
        </div>

        {{-- PERKIRAAN TAMU DATANG --}}
        <div>
            <div class="w-full mb-2 text-center">
                PERKIRAAN TAMU
            </div>

            <div class="w-[100px] aspect-video mx-auto flex items-center justify-center rounded-xl font-semibold bg-blue-400 text-white shadow">
                {{ $counts->perkiraan_tamu ? $counts->perkiraan_tamu : '0' }}
            </div>
        </div>
    </div>

    <hr class="my-5">

    {{-- KONTEN --}}
    <div class="relative w-full flex items-start justify-center gap-4">
        {{-- TABEL --}}
        <div class="flex-1 w-full">
            <table class="w-full table-auto cell-border compact hover" id="dataTable">
                <thead>
                    <td>No</td>
                    <td>Nama</td>
                    <td>Telp</td>
                    <td>Status</td>
                    <td>Respon</td>
                    <td>Jumlah</td>
                    <td>Kirim</td>
                    <td>Lainnya</td>
                </thead>
                <tbody class="text-sm">
                    @forelse ($guests as $tamu)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>
                                <div class="line-clamp-1">
                                    {{ $tamu->nama }}
                                </div>
                            </td>
                            <td>{{ $tamu->no_telp }}</td>
                            <td>
                                <div class="w-[75px] p-[2px] mx-auto text-center {{ $tamu->status == 'Sudah Terkirim' ? 'bg-green-400' : 'bg-yellow-400' }} text-white rounded-full text-xs"
                                    data-tippy-content="{{ $tamu->status }}">
                                    <i class="fa-solid {{ $tamu->status == 'Sudah Terkirim' ? 'fa-check' : 'fa-clock' }}"></i>
                                    <span class="hidden">{{ $tamu->status }}</span>
                                </div>
                            </td>
                            <td>
                                <div class="w-[75px] p-[2px] mx-auto text-center {{ $tamu->respon == 'Belum Menjawab' ? 'bg-yellow-400' : ($tamu->respon == 'Hadir' ? 'bg-green-400' : 'bg-red-400') }} text-white rounded-full text-xs"
                                    data-tippy-content="{{ $tamu->respon }}">
                                    <i class="fa-solid {{ $tamu->respon == 'Belum Menjawab' ? 'fa-clock' : ($tamu->respon == 'Hadir' ? 'fa-check' : 'fa-xmark') }}"></i>
                                    <span class="hidden">{{ $tamu->respon }}</span>
                                </div>
                            </td>
                            <td class="text-center">{{ $tamu->jumlah }}</td>
                            <td>
                                <div class="flex items-center justify-center gap-1 text-xs">
                                    {{-- KIRIM WHATSAPP --}}
                                    <a class="w-[30px] aspect-square flex items-center justify-center outline-green-400 outline-offset-4 shadow-sm text-green-400 border border-green-400 hover:bg-green-400 hover:text-white focus:bg-green-400 focus:text-white active:bg-green-300 transition-colors rounded"
                                        href="javascript:void(0);" title="kirim ke Whatsapp" data-tippy-content="kirim ke Whatsapp"
                                        onclick="sendWhatsAppMessage('{{ $tamu->nama }}', '{{ $tamu->no_telp }}', '{{ $tamu->link }}')">
                                        <i class="fa-brands fa-whatsapp"></i>
                                    </a>
                                    {{-- COPY TEXT TO CLIPBOARD --}}
                                    <a class="w-[30px] aspect-square flex items-center justify-center outline-slate-400 outline-offset-4 shadow-sm text-slate-400 border border-slate-400 hover:bg-slate-400 hover:text-white focus:bg-slate-400 focus:text-white active:bg-slate-300 transition-colors rounded"
                                        href="javascript:void(0);" title="salin pesan" data-tippy-content="salin pesan"
                                        onclick="copyTextToClipboard('{{ $tamu->nama }}', '{{ $tamu->link }}')">
                                        <i class="fa-regular fa-clone"></i>
                                    </a>
                                    {{-- COPY LINK TO CLIPBOARD --}}
                                    <a class="w-[30px] aspect-square flex items-center justify-center outline-slate-400 outline-offset-4 shadow-sm text-slate-400 border border-slate-400 hover:bg-slate-400 hover:text-white focus:bg-slate-400 focus:text-white active:bg-slate-300 transition-colors rounded"
                                        href="javascript:void(0);" title="salin tautan" data-tippy-content="salin tautan"
                                        onclick="copyLinkToClipboard('{{ $tamu->link }}')">
                                        <i class="fa-solid fa-link"></i>
                                    </a>
                                </div>
                            </td>
                            <td>
                                <div class="flex items-center justify-center gap-1 text-xs">
                                    {{-- CEK UNDANGAN --}}
                                    @php
                                        $pengantin = $wedding->p_sapaan.'-'.$wedding->w_sapaan;
                                    @endphp
                                    <a class="w-[30px] aspect-square flex items-center justify-center outline-pink outline-offset-4 shadow-sm text-pink border border-pink hover:bg-pink hover:text-white focus:bg-pink focus:text-white active:bg-pink-hover transition-colors rounded"
                                        href="{{ route('undangan.tamu', ['pengantin' => $pengantin, 'link' => $tamu->link]) }}"
                                        target="_blank" title="cek undangan" data-tippy-content="cek undangan">
                                        <i class="fa-regular fa-envelope"></i>
                                    </a>
                                    {{-- VALIDASI PENGIRIMAN --}}
                                    @if ($today->lt($eventDate))
                                        <form action="{{ route('wedding-couple.tamu.kirim', $tamu->id) }}" method="post" class="validasiKirimUndanganForm">
                                            @csrf
                                            <button class="w-[30px] aspect-square flex items-center justify-center outline-green-400 outline-offset-4 shadow-sm text-green-400 border border-green-400 hover:bg-green-400 hover:text-white focus:bg-green-400 focus:text-white active:bg-green-300 transition-colors rounded
                                                disabled:bg-slate-400 disabled:text-white disabled:border-slate-400"
                                                {{ $tamu->status == 'Sudah Terkirim' ? 'disabled' : '' }}
                                                type="submit" title="konfirmasi kirim" data-tippy-content="konfirmasi kirim">
                                                <i class="fa-solid fa-check"></i>
                                            </button>
                                        </form>
                                    @endif
                                    {{-- INFO DETAIL --}}
                                    <button class="w-[30px] aspect-square flex items-center justify-center outline-blue-400 outline-offset-4 shadow-sm text-blue-400 border border-blue-400 hover:bg-blue-400 hover:text-white focus:bg-blue-400 focus:text-white active:bg-blue-300 transition-colors rounded
                                        disabled:bg-slate-400 disabled:text-white disabled:border-slate-400"
                                        {{ $tamu->pesan == null ? 'disabled' : '' }}
                                        type="button" onclick="showGuestInfoModal({{ $tamu->id }})" title="info detail" data-tippy-content="info detail">
                                        <i class="fa-solid fa-info"></i>
                                    </button>
                                    {{-- HAPUS --}}
                                    @if ($today->lt($eventDate))
                                        <form action="{{ route('wedding-couple.tamu.hapus', $tamu->id) }}" method="post" class="hapusUndanganForm">
                                            @csrf
                                            <button class="w-[30px] aspect-square flex items-center justify-center outline-red-400 outline-offset-4 shadow-sm text-red-400 border border-red-400 hover:bg-red-400 hover:text-white focus:bg-red-400 focus:text-white active:bg-red-300 transition-colors rounded"
                                                type="submit" title="hapus" data-tippy-content="hapus">
                                                <i class="fa-regular fa-trash-can"></i>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                    @endforelse
                </tbody>
            </table>

            <div>
                <div>
                    Ket:
                </div>

                <div class="w-[60%] pl-10 flex items-start justify-between">
                    <div class="flex-1">
                        <div>Status</div>
                        <div class="w-full flex items-center justify-start gap-2">
                            <div class="w-[20px] text-center text-yellow-400">
                                <i class="fa-solid fa-clock"></i>
                            </div>
                            <span>Belum Terkirim</span>
                        </div>
                        <div class="w-full flex items-center justify-start gap-2">
                            <div class="w-[20px] text-center text-green-400">
                                <i class="fa-solid fa-check"></i>
                            </div>
                            <span>Sudah Terkirim</span>
                        </div>
                    </div>
                    <div class="flex-1">
                        <div>Respon</div>
                        <div class="w-full flex items-center justify-start gap-2">
                            <div class="w-[20px] text-center text-yellow-400">
                                <i class="fa-solid fa-clock"></i>
                            </div>
                            <span>Belum Menjawab</span>
                        </div>
                        <div class="w-full flex items-center justify-start gap-2">
                            <div class="w-[20px] text-center text-green-400">
                                <i class="fa-solid fa-check"></i>
                            </div>
                            <span>Hadir</span>
                        </div>
                        <div class="w-full flex items-center justify-start gap-2">
                            <div class="w-[20px] text-center text-red-400">
                                <i class="fa-solid fa-xmark"></i>
                            </div>
                            <span>Tidak Hadir</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- MODAL --}}
        @forelse ($guests as $tamu)
            @if ($tamu->pesan !== null)
                <div class="fixed top-full left-0 w-full h-screen flex items-center justify-center bg-slate-500/50 z-10 transition-all duration-500"
                    id="guestInfoModal-{{ $tamu->id }}">
                    <div class="w-full max-w-[400px] bg-white rounded-md">
                        {{-- atas --}}
                        <div class="w-full py-2 px-4 flex items-center justify-between border-b">
                            <div>
                                <span class="text-lg font-semibold">
                                    Pesan dari Tamu Undangan
                                </span>
                            </div>
                            {{-- TOMBOL CLOSE MODAL --}}
                            <div>
                                <button class="closeGIModalBtn w-fit px-2 aspect-square rounded outline-pink outline-offset-4 bg-pink text-white hover:bg-pink-hover focus:bg-pink-hover active:bg-pink-active transition-colors"
                                    type="button" tabindex="-1" data-gi-modal="{{ $tamu->id }}">
                                    <i class="fa-solid fa-xmark"></i>
                                </button>
                            </div>
                        </div>

                        {{-- konten --}}
                        <div class="w-full max-h-[70vh] overflow-y-auto p-4">
                            <div class="w-full">
                                {{-- Your content goes here --}}
                                <p>{{ $tamu->pesan }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @empty

        @endforelse

        @if ($today->lt($eventDate))
            {{-- INPUT FORM --}}
            <div class="sticky top-4 w-[300px] bg-white rounded-xl p-4 border shadow-sm text-sm">
                <form action="{{ route('wedding-couple.tamu.tambah', $wedding->id) }}" method="post">
                    @csrf
                    {{-- NAMA --}}
                    <div class="w-full mb-4">
                        <label class="block w-full mb-2"
                            for="nama">
                            Nama Penerima
                        </label>
                        <input class="w-full p-2 flex-1 border text-sm @error('nama') border-red-500 @enderror rounded outline-pink"
                            type="text" name="nama" id="nama" placeholder="nama yang tampil pada undangan" maxlength="255"
                            required
                            value="{{ old('nama', '') }}">
                        <div class="mt-1 text-sm text-red-500 flex items-center justify-start gap-2">
                            @error('nama')
                                <i class="fa-solid fa-circle-info"></i>
                                <span>{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    {{-- NO TELP --}}
                    <div class="w-full mb-8">
                        <label class="block w-full mb-2"
                            for="no_telp">
                            Nomor Kontak
                        </label>
                        <input class="w-full p-2 flex-1 border text-sm @error('no_telp') border-red-500 @enderror rounded outline-pink"
                            type="number" inputmode="" name="no_telp" id="no_telp" placeholder="62xxxxxxx" min="0"
                            required
                            value="{{ old('no_telp', '') }}">
                        <div class="mt-1 text-sm text-slate-300 italic">
                            gunakan kode negara di awal nomor
                        </div>
                        <div class="mt-1 text-sm text-red-500 flex items-center justify-start gap-2">
                            @error('no_telp')
                                <i class="fa-solid fa-circle-info"></i>
                                <span>{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <button class="w-full p-2 rounded text-white font-semibold bg-pink hover:bg-pink-hover focus:bg-pink-hover active:bg-pink-active focus:outline-pink-hover focus:outline-offset-2 transition-colors"
                        type="submit">
                        Simpan
                    </button>
                </form>
            </div>
        @else
            <div class="w-[300px] text-slate-400 text-center italic text-sm">
                Telah memasuki tanggal acara pertama, tidak dapat menambahkan tamu lagi
            </div>
        @endif
    </div>
</div>
