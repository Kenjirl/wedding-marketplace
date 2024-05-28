@extends('user.wedding-photographer.layout')

@section('title')
    <title>Tambah Layanan | Wedding Marketplace</title>
@endsection

@section('h1', 'Layanan > Tambah Layanan')

@section('content')
    <form action="{{ route('wedding-photographer.layanan.tambah') }}" method="post" autocomplete="off">
        @csrf
        <div class="w-full">
            {{-- INPUT --}}
            <div class="w-full flex items-start justify-center gap-8">
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
                                type="number" name="harga" id="harga" placeholder="tanpa Rp" min="0"
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

                    {{-- SATUAN --}}
                    <div class="w-full mb-4">
                        <div class="w-full">
                            <div class="w-full p-2 text-xs font-bold bg-pink @error('satuan') bg-red-500 @enderror text-white flex items-center justify-start rounded-t">
                                <i class="fa-regular fa-circle-dot"></i>
                                <span class="ml-2">
                                    Satuan Harga
                                </span>
                            </div>
                            <select class="w-full p-2 flex-1 border-x-2 border-b-2 text-sm @error('gender') border-red-500 @enderror rounded-b focus:border-pink outline-none"
                                name="satuan" id="satuan" required>
                                <option value="" selected>Pilih Satuan Harga</option>
                                <option value="acara" {{ old('satuan') == 'acara' ? 'selected' : '' }}>
                                    Acara
                                </option>
                                <option value="hari" {{ old('satuan') == 'hari' ? 'selected' : '' }}>
                                    Hari
                                </option>
                                <option value="jam" {{ old('satuan') == 'jam' ? 'selected' : '' }}>
                                    Jam
                                </option>
                            </select>
                        </div>

                        <div class="mt-1 text-sm text-red-500 flex items-center justify-start gap-2">
                            @error('satuan')
                                <i class="fa-solid fa-circle-info"></i>
                                <span>{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="w-full">
                    {{-- DETAIL --}}
                    <div class="w-100 mb-4">
                        <div class="w-100">
                            <div class="w-full p-2 text-xs font-bold bg-pink @error('detail') bg-red-500 @enderror text-white flex items-center justify-start rounded-t">
                                <i class="fa-solid fa-circle-info"></i>
                                <span class="ml-2">
                                    Detail
                                </span>
                            </div>
                            <textarea class="w-full p-2 flex-1 border-x-2 border-b-2 resize-none text-sm @error('detail') border-red-500 @enderror rounded-b focus:border-pink focus:outline-none"
                                name="detail" id="input" rows="3" placeholder="masukan detail paket layanan"
                                >{{ old('detail', '') }}</textarea>
                        </div>

                        <div class="mt-1 text-sm text-red-500 flex items-center justify-start gap-2">
                            @error('detail')
                                <i class="fa-solid fa-circle-info"></i>
                                <span>{{ $message }}</span>
                            @enderror
                        </div>
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

                <button class="w-fit px-4 py-2 rounded text-white font-semibold bg-pink hover:bg-pink-hover focus:bg-pink-hover active:bg-pink-active focus:outline-pink-hover focus:outline-offset-2 transition-colors"
                    type="submit">
                    <i class="fa-regular fa-floppy-disk"></i>
                    <span>Simpan</span>
                </button>
            </div>
        </div>
    </form>
@endsection
