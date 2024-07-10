@extends('admin.layout')

@section('title')
    <title>Jenis Vendor | Wedding Marketplace</title>
@endsection

@section('h1', 'Jenis Vendor > Ubah')

@section('content')
    <form action="{{ route('admin.jenis-vendor.ubah', $j_vendor->id) }}" method="post">
        @csrf
        {{-- INPUT --}}
        <div class="w-1/2">
            {{-- NAMA --}}
            <div class="w-full mb-4">
                <div class="w-full">
                    <div class="w-full p-2 text-xs font-bold bg-pink @error('nama') bg-red-500 @enderror text-white flex items-center justify-start rounded-t">
                        Jenis Vendor
                    </div>
                    <input class="w-full p-2 flex-1 border-x-2 border-b-2 text-sm @error('nama') border-red-500 @enderror rounded-b focus:border-pink focus:outline-none"
                        type="text" name="nama" id="nama" placeholder="fotografer" autofocus
                        value="{{ old('nama', $j_vendor->nama) }}"
                        required>
                </div>

                <div class="mt-1 text-sm text-red-500 flex items-center justify-start gap-2">
                    @error('nama')
                        <i class="fa-solid fa-circle-info"></i>
                        <span>{{ $message }}</span>
                    @enderror
                </div>
            </div>

            {{-- ICON --}}
            <div class="w-full mb-4">
                <div class="w-full">
                    <div class="w-full p-2 text-xs font-bold bg-pink @error('icon') bg-red-500 @enderror text-white flex items-center justify-start rounded-t">
                        Icon
                    </div>
                    <input class="w-full p-2 flex-1 border-x-2 border-b-2 text-sm @error('icon') border-red-500 @enderror rounded-b focus:border-pink focus:outline-none"
                        type="text" name="icon" id="icon" placeholder="fa-solid fa-house"
                        value="{{ old('icon', $j_vendor->icon) }}"
                        required>
                </div>

                <div class="mt-1 text-sm text-red-500 flex items-center justify-start gap-2">
                    @error('icon')
                        <i class="fa-solid fa-circle-info"></i>
                        <span>{{ $message }}</span>
                    @enderror
                </div>

                <div class="mt-1 text-sm text-slate-500 italic flex items-center justify-start gap-2">
                    <i class="fa-solid fa-circle-info"></i>
                    <p>
                        gunakan icon dari link berikut :
                        <a class="underline" href="https://fontawesome.com/icons">https://fontawesome.com/icons</a>
                    </p>
                </div>
            </div>

            {{-- BUTTON --}}
            <div class="w-full flex items-center justify-end">
                <div class="w-full flex items-center justify-end gap-4">
                    <a class="w-fit px-4 py-2 font-semibold outline-none text-pink bg-white hover:bg-pink hover:text-white focus:bg-pink focus:text-white active:bg-pink-active transition-colors rounded"
                        href="{{ route('admin.jenis-vendor.index') }}">
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
        </div>
    </form>
@endsection
