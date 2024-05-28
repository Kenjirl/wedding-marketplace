@extends('user.wedding-couple.layout')

@section('title')
    <title>Ubah Profil | Wedding Marketplace</title>
@endsection

@section('content')
    <div class="max-w-[600px] mx-auto mt-4">
        {{-- H1 --}}
        <div class="mb-4">
            <h1 class="text-[2em] font-bold">
                Profil > Ubah Profil
            </h1>
        </div>

        <div class="px-4 pb-4">
            <ol class="list-decimal text-sm">
                <li>Silahkan isi data diri Anda</li>
                <li>Harap memilih data sesuai dengan pilihan yang sudah disediakan</li>
                <li>Harap untuk tidak menggunakan tanda baca apapun kecuali pada Nama Pengguna</li>
            </ol>
        </div>

        <div class="w-full">
            <form action="{{ route('wedding-couple.profil.ubah') }}" method="post" autocomplete="off">
                @csrf
                {{-- ATAS --}}
                <div class="w-full flex items-start justify-between gap-8">
                    <div class="w-full">
                        {{-- NAMA --}}
                        <div class="w-100 mb-4">
                            <div class="w-100">
                                <div class="w-full p-2 text-xs font-bold bg-pink @error('nama') bg-red-500 @enderror text-white flex items-center justify-start rounded-t">
                                    <i class="fa-solid fa-user"></i>
                                    <span class="ml-2">
                                        Nama
                                    </span>
                                </div>
                                <input class="w-full p-2 flex-1 border-x-2 border-b-2 text-sm @error('nama') border-red-500 @enderror rounded-b focus:border-pink focus:outline-none"
                                    type="text" name="nama" id="nama" placeholder="Budi Pekerti"
                                    required
                                    value="{{ old('nama', auth()->user()->w_couple ? auth()->user()->w_couple->nama : '') }}">
                            </div>

                            <div class="mt-1 text-sm text-red-500 flex items-center justify-start gap-2">
                                @error('nama')
                                    <i class="fa-solid fa-circle-info"></i>
                                    <span>{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        {{-- NAMA PENGGUNA --}}
                        <div class="w-100 mb-4">
                            <div class="w-100">
                                <div class="w-full p-2 text-xs font-bold bg-pink @error('username') bg-red-500 @enderror text-white flex items-center justify-start rounded-t">
                                    <i class="fa-solid fa-user-tag"></i>
                                    <span class="ml-2">
                                        Nama Pengguna
                                    </span>
                                </div>
                                <input class="w-full p-2 flex-1 border-x-2 border-b-2 text-sm @error('username') border-red-500 @enderror rounded-b focus:border-pink focus:outline-none"
                                    type="text" name="username" id="username" placeholder="Budi123"
                                    required
                                    value="{{ old('username', auth()->user()->name) }}">
                            </div>

                            <div class="mt-1 text-sm text-red-500 flex items-center justify-start gap-2">
                                @error('username')
                                    <i class="fa-solid fa-circle-info"></i>
                                    <span>{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        {{-- TELEPON --}}
                        <div class="w-100 mb-4">
                            <div class="w-100">
                                <div class="w-full p-2 text-xs font-bold bg-pink @error('no_telp') bg-red-500 @enderror text-white flex items-center justify-start rounded-t">
                                    <i class="fa-solid fa-phone"></i>
                                    <span class="ml-2">
                                        Telepon
                                    </span>
                                </div>
                                <input class="w-full p-2 flex-1 border-x-2 border-b-2 text-sm @error('no_telp') border-red-500 @enderror rounded-b focus:border-pink focus:outline-none"
                                    type="number" name="no_telp" id="no_telp" placeholder="081234567890" min="0"
                                    required
                                    value="{{ old('no_telp', auth()->user()->w_couple ? auth()->user()->w_couple->no_telp : '') }}">
                            </div>

                            <div class="mt-1 text-sm text-red-500 flex items-center justify-start gap-2">
                                @error('no_telp')
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
                        href="{{ route('wedding-couple.profil.index') }}">
                        <i class="fa-solid fa-arrow-left-long"></i>
                        <span>Kembali</span>
                    </a>

                    <button class="w-fit px-4 py-2 rounded text-white font-semibold bg-pink hover:bg-pink-hover focus:bg-pink-hover active:bg-pink-active focus:outline-pink-hover focus:outline-offset-2 transition-colors"
                        type="submit">
                        <i class="fa-regular fa-floppy-disk"></i>
                        <span>Simpan</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
