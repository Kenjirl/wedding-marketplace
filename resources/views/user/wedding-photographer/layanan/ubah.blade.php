@extends('user.wedding-photographer.layout')

@section('title')
    <title>Ubah Layanan | Wedding Marketplace</title>
@endsection

@section('h1', 'Layanan > Ubah Layanan')

@section('content')
    <div class="w-full px-4 mb-4">
        <ol class="list-decimal text-sm">
            <li>Silahkan ubah detail layanan Anda</li>
            <li>Untuk fitur tambahan tidak dapat diubah, namun dapat dihapus</li>
            <li>Jika ingin mengubah fitur tambahan, silahkan hapus kemudian tambahkan fitur tambahan baru</li>
            <li>Jika status layanan nonaktif, maka pelanggan tidak akan dapat memilih layanan ini</li>
        </ol>
    </div>

    <div class="w-[50%] mb-4 flex items-start justify-end">
        @if ($plan->status == 'aktif')
            <div class="w-fit px-4 py-2 text-sm bg-blue-500 font-semibold text-white rounded">
        @else
            <div class="w-fit px-4 py-2 text-sm bg-red-500 font-semibold text-white rounded">
        @endif
                Status Layanan : {{ $plan->status }}
            </div>
    </div>

    <form action="{{ route('wedding-photographer.layanan.ubah', $plan->id) }}" method="post" autocomplete="off">
        @csrf
        <div class="w-[50%]">
            <div class="w-full">
                {{-- NAMA --}}
                <div class="w-full mb-4">
                    <div class="w-full">
                        <div class="w-full p-2 text-xs font-bold bg-pink @error('nama') bg-red-500 @enderror text-white flex items-center justify-start rounded-t">
                            Nama Paket
                        </div>
                        <input class="w-full p-2 flex-1 border-x-2 border-b-2 text-sm @error('nama') border-red-500 @enderror rounded-b focus:border-pink focus:outline-none"
                            type="text" name="nama" id="nama" placeholder="nama"
                            value="{{ old('nama', $plan->nama) }}"
                            required>
                    </div>

                    <div class="mt-1 text-sm text-red-500 flex items-center justify-start gap-2">
                        @error('nama')
                            <i class="fa-solid fa-circle-info"></i>
                            <span>{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                {{-- FITUR UTAMA --}}
                <div class="w-full mb-4">
                    <div class="w-full">
                        <div class="w-full p-2 text-xs font-bold bg-pink @error('fitur_utama') bg-red-500 @enderror text-white flex items-center justify-start rounded-t">
                            Detail Fitur
                        </div>

                        <div class="w-full px-2 pt-2 border-2 border-t-0 ">
                            {{-- FITUR UTAMA --}}
                            <div class="w-full mb-2">
                                <input class="w-full p-2 flex-1 border-2 text-sm @error('fitur_utama') border-red-500 @enderror rounded focus:border-pink focus:outline-none"
                                    type="text" name="fitur_utama" id="fitur_utama" placeholder="fitur utama"
                                    value="{{ old('fitur_utama', $plan->fitur->first()->isi) }}"
                                    required>
                            </div>

                            {{-- FITUR TAMBAHAN CONTAINER --}}
                            <div class="w-full" id="fiturTambahanContainer">
                                {{-- FITUR TAMBAHAN LAMA --}}
                                @foreach ($fitur_tambahan as $ft)
                                    <div class="w-full mb-2 flex items-start justify-start" id="fiturLama-{{ $ft->id }}">
                                        <input class="w-full p-2 flex-1 border-2 text-sm outline-none rounded-s cursor-not-allowed"
                                            type="text" name="fitur_tambahan[]" placeholder="fitur tambahan" readonly
                                            value="{{ $ft->isi }}">
                                        <button class="w-[39.2px] aspect-square flex items-center justify-center outline-none text-white bg-pink hover:bg-pink-hover focus:bg-pink-hover focus:text-white active:bg-pink-active transition-colors rounded-e"
                                            type="button" id="hapusFiturLamaBtn-{{ $ft->id }}">
                                            <i class="fa-regular fa-circle-xmark"></i>
                                        </button>
                                    </div>
                                @endforeach

                                {{-- FITUR TAMBAHAN BARU MELALUI JS --}}
                            </div>

                            {{-- BUTTON TAMBAH FITUR --}}
                            <div class="w-full mb-2">
                                <button class="w-full p-2 rounded text-white text-center text-sm font-semibold outline-none bg-pink hover:bg-pink-hover focus:bg-pink-hover focus:text-white active:bg-pink-active transition-colors"
                                    type="button" id="tambahFiturBtn">
                                    <i class="fa-solid fa-plus"></i>
                                    Tambah
                                </button>
                            </div>
                        </div>
                    </div>

                    {{-- ERROR FITUR UTAMA --}}
                    <div class="mt-1 text-sm text-red-500 flex items-center justify-start gap-2">
                        @error('fitur_utama')
                            <i class="fa-solid fa-circle-info"></i>
                            <span>{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                {{-- HARGA --}}
                <div class="w-full mb-4">
                    <div class="w-full">
                        <div class="w-full p-2 text-xs font-bold bg-pink @error('harga') bg-red-500 @enderror text-white flex items-center justify-start rounded-t">
                            Harga Paket (dalam rupiah)
                        </div>
                        <input class="w-full p-2 flex-1 border-x-2 border-b-2 text-sm @error('harga') border-red-500 @enderror rounded-b focus:border-pink focus:outline-none"
                            type="number" name="harga" id="harga" placeholder="tanpa Rp"
                            value="{{ old('harga', $plan->harga) }}"
                            required>
                    </div>

                    <div class="mt-1 text-sm text-red-500 flex items-center justify-start gap-2">
                        @error('harga')
                            <i class="fa-solid fa-circle-info"></i>
                            <span>{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            {{-- BUTTON --}}
            <div class="w-100 mt-4 flex items-center justify-end gap-4">
                <a class="w-fit px-4 py-2 font-semibold outline-none text-pink bg-white hover:bg-pink hover:text-white focus:bg-pink focus:text-white active:bg-pink-active transition-colors rounded"
                    href="{{ route('wedding-photographer.layanan.index') }}">
                    <i class="fa-solid fa-arrow-left-long"></i>
                    <span>Kembali</span>
                </a>

                <button class="w-fit px-4 py-2 font-semibold outline-none text-pink bg-white hover:bg-pink hover:text-white focus:bg-pink focus:text-white active:bg-pink-active transition-colors rounded"
                    id="deleteBtn" type="button">
                    <i class="fa-solid fa-trash-can"></i>
                    <span>Hapus</span>
                </button>

                @if ($plan->status == 'aktif')
                    <button class="w-fit px-4 py-2 font-semibold outline-none text-pink bg-white hover:bg-pink hover:text-white focus:bg-pink focus:text-white active:bg-pink-active transition-colors rounded"
                        id="ubahStatusBtn" type="button">
                        <i class="fa-solid fa-xmark"></i>
                        <span>Nonaktifkan</span>
                    </button>
                @else
                    <button class="w-fit px-4 py-2 font-semibold outline-none text-pink bg-white hover:bg-pink hover:text-white focus:bg-pink focus:text-white active:bg-pink-active transition-colors rounded"
                        id="ubahStatusBtn" type="button">
                        <i class="fa-solid fa-check"></i>
                        <span>Aktifkan</span>
                    </button>
                @endif

                <button class="w-fit px-4 py-2 rounded text-white font-semibold bg-pink hover:bg-pink-hover focus:bg-pink-hover active:bg-pink-active focus:outline-pink-hover focus:outline-offset-2 transition-colors"
                    type="submit">
                    <i class="fa-regular fa-floppy-disk"></i>
                    <span>Simpan</span>
                </button>
            </div>
        </div>
    </form>

    {{-- FORM HAPUS LAYANAN --}}
    <form class="hidden" action="{{ route('wedding-photographer.layanan.hapus', $plan->id) }}" method="post">
        @csrf
        <button id="submitDeleteBtn" type="submit"></button>
    </form>

    {{-- FORM AKTIF/NONAKTIF LAYANAN --}}
    <form class="hidden" action="{{ route('wedding-photographer.layanan.ubah_status', $plan->id) }}" method="post">
        @csrf
        @if ($plan->status == 'aktif')
            <input class="hidden"
                type="text" name="status" id="status" value="nonaktif" readonly>
        @else
            <input class="hidden"
                type="text" name="status" id="status" value="aktif" readonly>
        @endif
        <button id="submitUbahStatusBtn" type="submit"></button>
    </form>

    <script>
        $(document).ready(function() {
            let count = 0;

            $('#tambahFiturBtn').on('click', function() {
                count++;
                let newFeatureId = `fiturBaru-${count}`;
                $('#fiturTambahanContainer').append(
                    `<div class="w-full mb-2 flex items-start justify-start" id="${newFeatureId}">
                        <input class="w-full p-2 flex-1 border-2 text-sm rounded-s focus:border-pink focus:outline-none"
                            type="text" name="fitur_tambahan[]" placeholder="fitur tambahan"
                            value="">
                        <button class="w-[39.2px] aspect-square flex items-center justify-center outline-none text-white bg-pink hover:bg-pink-hover focus:bg-pink-hover focus:text-white active:bg-pink-active transition-colors rounded-e"
                            type="button" id="hapusFiturBaruBtn-${count}">
                            <i class="fa-regular fa-circle-xmark"></i>
                        </button>
                    </div>`
                );

                // Tambahkan event handler untuk tombol hapusFiturBaruBtn dengan ID yang sesuai
                $(`#hapusFiturBaruBtn-${count}`).on('click', function() {
                    hapusFitur(newFeatureId);
                });
            });

            function hapusFitur(fiturId) {
                let featureToRemove = $(`#${fiturId}`);
                if (featureToRemove) {
                    featureToRemove.remove();
                }
            }

            @foreach ($fitur_tambahan as $ft)
                $('#hapusFiturLamaBtn-{{ $ft->id }}').on('click', function() {
                    hapusFitur('fiturLama-{{ $ft->id }}');
                });
            @endforeach

            $('#deleteBtn').on("click", function () {
                if(confirm('Yakin ingin menghapus layanan ini?')) {
                    $('#submitDeleteBtn').click();
                }
            });

            $('#ubahStatusBtn').on("click", function () {
                if(confirm('Yakin ingin mengubah status layanan ini?')) {
                    $('#submitUbahStatusBtn').click();
                }
            });
        });
    </script>
@endsection
