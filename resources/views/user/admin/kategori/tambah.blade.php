@extends('user.admin.layout')

@section('title')
    <title>Kategori Pernikahan | Wedding Marketplace</title>
@endsection

@section('h1', 'Kategori Pernikahan > Tambah')

@section('content')
    <form action="{{ route('admin.kategori-pernikahan.tambah') }}" method="post">
        @csrf
        <div class="w-[50%]">
            <div class="w-full">
                {{-- KATEGORI --}}
                <div class="w-100 mb-4">
                    <div class="w-100">
                        <div class="w-100 p-2 text-xs font-bold bg-pink @error('nama') bg-red-500 @enderror text-white flex items-center justify-start rounded-t">
                            Kategori
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

                {{-- KETERANGAN --}}
                <div class="w-100 mb-4">
                    <div class="w-100">
                        <div class="w-100 p-2 text-xs font-bold bg-pink @error('keterangan') bg-red-500 @enderror text-white flex items-center justify-start rounded-t">
                            Keterangan
                        </div>
                        <textarea class="w-full p-2 flex-1 border-x-2 border-b-2 resize-none text-sm @error('keterangan') border-red-500 @enderror rounded-b focus:border-pink focus:outline-none"
                            name="keterangan" id="input" rows="3" placeholder="masukkan keterangan kategori ini"
                            >{{ old('keterangan', '') }}</textarea>
                    </div>

                    <div class="mt-1 text-sm text-red-500 flex items-center justify-start gap-2">
                        @error('keterangan')
                            <i class="fa-solid fa-circle-info"></i>
                            <span>{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            {{-- BUTTON --}}
            <div class="w-100 mt-4 flex items-center justify-end gap-4">
                <a class="w-fit px-4 py-2 font-semibold outline-none text-pink bg-white hover:bg-pink hover:text-white focus:bg-pink focus:text-white active:bg-pink-active transition-colors rounded"
                    href="{{ route('admin.kategori-pernikahan.index') }}">
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
