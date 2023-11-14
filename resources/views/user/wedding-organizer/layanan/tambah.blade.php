@extends('user.wedding-organizer.layout')

@section('title')
    <title>Tambah Layanan | Wedding Marketplace</title>
@endsection

@section('h1', 'Layanan > Tambah Layanan')

@section('content')
    <form action="{{ route('wedding-organizer.layanan.tambah') }}" method="post" autocomplete="off">
        @csrf
        <div class="w-[50%]">
            <div class="w-full">
                {{-- NAMA --}}
                <div class="w-full mb-4">
                    <div class="w-full">
                        <div class="w-full p-2 text-xs font-bold bg-pink @error('nama') bg-red-500 @enderror text-white flex items-center justify-start rounded-t">
                            <i class="fa-solid fa-gift"></i>
                            <span class="ml-2">
                                Nama Paket
                            </span>
                        </div>
                        <input class="w-full p-2 flex-1 border-x-2 border-b-2 text-sm @error('nama') border-red-500 @enderror rounded-b focus:border-pink focus:outline-none"
                            type="text" name="nama" id="nama" placeholder="nama"
                            value="{{ old('nama', '') }}"
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
                            <i class="fa-solid fa-circle-info"></i>
                            <span class="ml-2">
                                Detail Fitur
                            </span>
                        </div>

                        <div class="w-full px-2 pt-2 border-2 border-t-0 ">
                            {{-- FITUR UTAMA --}}
                            <div class="w-full mb-2">
                                <input class="w-full p-2 flex-1 border-2 text-sm @error('fitur_utama') border-red-500 @enderror rounded focus:border-pink focus:outline-none"
                                    type="text" name="fitur_utama" id="fitur_utama" placeholder="fitur utama"
                                    value="{{ old('fitur_utama', '') }}"
                                    required>
                            </div>

                            {{-- FITUR TAMBAHAN CONTAINER --}}
                            <div class="w-full" id="fiturTambahanContainer">
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
                            <i class="fa-solid fa-rupiah-sign"></i>
                            <span class="ml-2">
                                Harga Paket
                            </span>
                        </div>
                        <input class="w-full p-2 flex-1 border-x-2 border-b-2 text-sm @error('harga') border-red-500 @enderror rounded-b focus:border-pink focus:outline-none"
                            type="number" name="harga" id="harga" placeholder="tanpa Rp"
                            value="{{ old('harga', '') }}"
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
                    href="{{ route('wedding-organizer.layanan.index') }}">
                    <i class="fa-solid fa-arrow-left-long"></i>
                    <span>Kembali</span>
                </a>

                <button class="w-fit px-4 py-2 rounded text-white font-semibold bg-pink hover:bg-pink-hover focus:bg-pink-hover active:bg-pink-active focus:outline-pink-hover focus:outline-offset-2 transition-colors"
                    type="submit">
                    <i class="fa-regular fa-floppy-disk"></i>
                    <span>Simpan</span>
                </button>
            </div>
        </div>
    </form>
@endsection

@push('child-js')
    <script>
        $(document).ready(function() {
            let count = 0;

            $('#tambahFiturBtn').on('click', function() {
                count++;
                let newFeatureId = `fitur-${count}`;
                $('#fiturTambahanContainer').append(
                    `<div class="w-full mb-2 flex items-start justify-start" id="${newFeatureId}">
                        <input class="w-full p-2 flex-1 border-2 text-sm @error('fitur_tambahan[]') border-red-500 @enderror rounded-s focus:border-pink focus:outline-none"
                            type="text" name="fitur_tambahan[]" placeholder="fitur tambahan"
                            value="">
                        <button class="w-[39.2px] aspect-square flex items-center justify-center outline-none text-white bg-pink hover:bg-pink-hover focus:bg-pink-hover focus:text-white active:bg-pink-active transition-colors rounded-e"
                            type="button" id="hapusFiturBtn-${count}">
                            <i class="fa-regular fa-circle-xmark"></i>
                        </button>
                    </div>`
                );

                // Tambahkan event handler untuk tombol hapusFiturBtn dengan ID yang sesuai
                $(`#hapusFiturBtn-${count}`).on('click', function() {
                    hapusFitur(newFeatureId);
                });
            });

            function hapusFitur(fiturId) {
                let featureToRemove = $(`#${fiturId}`);
                if (featureToRemove) {
                    featureToRemove.remove();
                }
            }
        });
    </script>
@endpush
