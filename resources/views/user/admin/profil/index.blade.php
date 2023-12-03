@extends('user.admin.layout')

@section('title')
    <title>Profil | Wedding Marketplace</title>
@endsection

@section('h1', 'Profil')

@section('content')
    <div class="w-[50%]">
        <div class="w-full">
            {{-- NAMA --}}
            <div class="w-100 mb-4">
                <div class="w-100 p-2 text-xs font-bold bg-pink text-white flex items-center justify-start rounded-t">
                    Nama
                </div>
                <input class="w-full p-2 flex-1 border-x-2 border-b-2 text-sm rounded-b focus:border-pink focus:outline-none"
                    type="text" name="nama" id="nama" placeholder="Budi Pekerti"
                    value="{{ auth()->user()->admin->nama }}"
                    disabled>
            </div>

            {{-- TELEPON --}}
            <div class="w-100 mb-4">
                <div class="w-100 p-2 text-xs font-bold bg-pink text-white flex items-center justify-start rounded-t">
                    Telepon
                </div>
                <input class="w-full p-2 flex-1 border-x-2 border-b-2 text-sm rounded-b focus:border-pink focus:outline-none"
                    type="number" name="no_telp" id="no_telp" placeholder="081234567890" min="0"
                    value="{{ auth()->user()->admin->no_telp }}"
                    disabled>
            </div>

            {{-- EMAIL --}}
            <div class="w-100 mb-4">
                <div class="w-100 p-2 text-xs font-bold bg-pink text-white flex items-center justify-start rounded-t">
                    Email
                </div>
                <input class="w-full p-2 flex-1 border-x-2 border-b-2 text-sm rounded-b focus:border-pink focus:outline-none"
                    type="email" name="email" id="email" placeholder="email@gmai.com" value="{{ auth()->user()->email }}" disabled>
            </div>

            {{-- GENDER --}}
            <div class="w-100 mb-4">
                <div class="w-100 p-2 text-xs font-bold bg-pink text-white flex items-center justify-start rounded-t">
                    Gender
                </div>
                <input class="w-full p-2 flex-1 border-x-2 border-b-2 text-sm rounded-b focus:border-pink focus:outline-none"
                    type="text" name="gender" id="gender" placeholder="Pria/Wanita"
                    value="{{ auth()->user()->admin->gender }}"
                    disabled>
            </div>

            <div class="w-100 mb-4">
                <div class="w-100 p-2 text-xs font-bold bg-pink text-white flex items-center justify-start rounded-t">
                    Alamat
                </div>
                <input class="w-full p-2 flex-1 border-x-2 border-b-2 text-sm rounded-b focus:border-pink focus:outline-none"
                type="text" name="alamat" id="alamat" placeholder="Jl. Kebon Duren"
                value="{{ auth()->user()->admin->alamat }}"
                disabled>
            </div>
        </div>

        {{-- BUTTON --}}
        <div class="w-100 mt-4 flex items-center justify-end gap-4">
            <a class="w-fit px-4 py-2 font-semibold outline-none text-pink bg-white hover:bg-pink hover:text-white focus:bg-pink focus:text-white active:bg-pink-active transition-colors rounded"
                href="{{ route('admin.profil.ke_ubah_password') }}">
                <i class="fa-solid fa-lock"></i>
                <span>Ubah Password</span>
            </a>

            <a class="w-fit px-4 py-2 rounded text-white font-semibold bg-pink hover:bg-pink-hover focus:bg-pink-hover active:bg-pink-active focus:outline-pink-hover focus:outline-offset-2 transition-colors"
                href="{{ route('admin.profil.ke_ubah') }}">
                <i class="fa-regular fa-pen-to-square"></i>
                <span>Ubah Profil</span>
            </a>
        </div>
    </div>
@endsection
