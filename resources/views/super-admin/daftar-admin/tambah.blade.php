@extends('super-admin.layout')

@section('title')
    <title>Tambah Admin | Wedding Marketplace</title>
@endsection

@section('h1', 'Tambah Admin')

@section('content')
    <form action="{{ route('super-admin.daftar-admin.tambah') }}" method="post">
        @csrf
        {{-- BUTTON --}}
        <div class="w-full flex items-center justify-between">
            <a class="w-fit px-4 py-2 font-semibold outline-none text-pink bg-white hover:bg-pink hover:text-white focus:bg-pink focus:text-white active:bg-pink-active transition-colors rounded"
                href="{{ route('super-admin.daftar-admin.ke_daftar') }}">
                <i class="fa-solid fa-arrow-left-long"></i>
                <span>Kembali</span>
            </a>

            <button class="w-fit px-4 py-2 rounded text-white font-semibold bg-pink hover:bg-pink-hover focus:bg-pink-hover active:bg-pink-active focus:outline-pink-hover focus:outline-offset-2 transition-colors"
                type="submit">
                <i class="fa-regular fa-floppy-disk"></i>
                <span>Simpan</span>
            </button>
        </div>

        <hr class="my-4">

        <div class="w-1/2 mx-auto">
            {{-- KIRI --}}
            <div class="w-full">
                {{-- NAMA ADMIN --}}
                <div class="w-full mb-4">
                    <div class="w-full">
                        <div class="w-full p-2 text-xs font-bold bg-pink @error('nama') bg-red-400 @enderror text-white flex items-center justify-start rounded-t">
                            Nama Lengkap
                        </div>
                        <input class="w-full p-2 flex-1 border-x-2 border-b-2 text-sm @error('nama') border-red-400 @enderror rounded-b focus:border-pink focus:outline-none"
                            type="text" name="nama" id="nama" placeholder="Budi Pekerti"
                            required
                            value="{{ old('nama', '') }}">
                    </div>

                    <div class="mt-1 text-sm text-red-400 flex items-center justify-start gap-2">
                        @error('nama')
                            <i class="fa-solid fa-circle-info"></i>
                            <span>{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                {{-- EMAIL AND PASSWORD CONTAINER --}}
                <div class="grid grid-cols-2 gap-4">
                    {{-- EMAIL --}}
                    <div class="w-full mb-4">
                        <div class="w-full">
                            <div class="w-full p-2 text-xs font-bold bg-pink @error('email') bg-red-400 @enderror text-white flex items-center justify-start rounded-t">
                                Email
                            </div>
                            <input class="w-full p-2 flex-1 border-x-2 border-b-2 text-sm @error('email') border-red-400 @enderror rounded-b focus:border-pink focus:outline-none"
                                type="email" name="email" id="email" placeholder="email@gmail.com"
                                required
                                value="{{ old('email', '') }}">
                        </div>

                        <div class="mt-1 text-sm text-red-400 flex items-center justify-start gap-2">
                            @error('email')
                                <i class="fa-solid fa-circle-info"></i>
                                <span>{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    {{-- PASSWORD --}}
                    <div class="w-full mb-4">
                        <div class="w-full">
                            <div class="w-full p-2 text-xs font-bold bg-pink text-white flex items-center justify-start rounded-t">
                                Password
                            </div>
                            <input class="w-full p-2 flex-1 border-x-2 border-b-2 text-sm rounded-b focus:border-pink focus:outline-none cursor-not-allowed"
                                type="text" name="password" id="password" placeholder="password123"
                                disabled
                                value="password123">
                        </div>
                    </div>
                </div>

                {{-- NAMA PENGGUNA & NO TELP CONTAINER --}}
                <div class="grid grid-cols-2 gap-4">
                    {{-- NAMA PENGGUNA --}}
                    <div class="w-full mb-4">
                        <div class="w-full">
                            <div class="w-full p-2 text-xs font-bold bg-pink @error('username') bg-red-400 @enderror text-white flex items-center justify-start rounded-t">
                                Nama Pengguna
                            </div>
                            <input class="w-full p-2 flex-1 border-x-2 border-b-2 text-sm @error('username') border-red-400 @enderror rounded-b focus:border-pink focus:outline-none"
                                type="text" name="username" id="username" placeholder="Budi123"
                                required
                                value="{{ old('username', '') }}">
                        </div>

                        <div class="mt-1 text-sm text-red-400 flex items-center justify-start gap-2">
                            @error('username')
                                <i class="fa-solid fa-circle-info"></i>
                                <span>{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    {{-- TELEPON --}}
                    <div class="w-full mb-4">
                        <div class="w-full">
                            <div class="w-full p-2 text-xs font-bold bg-pink @error('no_telp') bg-red-400 @enderror text-white flex items-center justify-start rounded-t">
                                Telepon
                            </div>
                            <input class="w-full p-2 flex-1 border-x-2 border-b-2 text-sm @error('no_telp') border-red-400 @enderror rounded-b focus:border-pink focus:outline-none"
                                type="number" name="no_telp" id="no_telp" placeholder="081234567890" min="0"
                                required
                                value="{{ old('no_telp', '') }}">
                        </div>

                        <div class="mt-1 text-sm text-red-400 flex items-center justify-start gap-2">
                            @error('no_telp')
                                <i class="fa-solid fa-circle-info"></i>
                                <span>{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- GENDER --}}
                <div class="relative w-full mb-4">
                    <div class="w-full">
                        <div class="w-full p-2 text-xs font-bold bg-pink @error('gender') bg-red-400 @enderror text-white flex items-center justify-start rounded-t">
                            Gender
                        </div>
                        <select class="w-full p-2 flex-1 border-x-2 border-b-2 text-sm @error('gender') border-red-400 @enderror rounded-b focus:border-pink outline-none"
                            name="gender" id="gender">
                            <option value="" selected>Pilih Gender</option>
                            <option value="Pria" {{ old('gender') == 'Pria' ? 'selected' : '' }}>Pria</option>
                            <option value="Wanita" {{ old('gender') == 'Wanita' ? 'selected' : '' }}>Wanita</option>
                        </select>
                    </div>

                    <div class="mt-1 text-sm text-red-400 flex items-center justify-start gap-2">
                        @error('gender')
                            <i class="fa-solid fa-circle-info"></i>
                            <span>{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                {{-- ALAMAT --}}
                <div class="relative w-full mb-4">
                    <div class="w-full">
                        <div class="w-full p-2 text-xs font-bold bg-pink @error('alamat') bg-red-400 @enderror text-white flex items-center justify-start rounded-t">
                            Alamat
                        </div>
                        <textarea class="w-full p-2 flex-1 border-x-2 border-b-2 text-sm @error('alamat') border-red-400 @enderror outline-pink rounded-b focus:border-pink focus:outline-none"
                            name="alamat" id="alamat" rows="3" required minlength="10" maxlength="254" placeholder="alamat lengkap">{{ old('alamat', '') }}</textarea>
                    </div>

                    <div class="mt-1 text-sm text-red-400 flex items-center justify-start gap-2">
                        @error('alamat')
                            <i class="fa-solid fa-circle-info"></i>
                            <span>{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
