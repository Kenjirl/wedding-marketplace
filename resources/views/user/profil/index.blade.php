@extends('user.layout')

@section('title')
    <title>Profil | Wedding Marketplace</title>
@endsection

@section('content')
    <div class="max-w-[800px] mx-auto mt-4">
        {{-- H1 --}}
        <div class="mb-8">
            <h1 class="text-[2em] font-bold">
                Profil
            </h1>
        </div>

        {{-- DATA DIRI --}}
        <div class="w-full flex gap-8">
            <div class="w-fit flex flex-col items-center justify-start gap-4">
                @if (auth()->user()->w_couple && auth()->user()->w_couple->foto_profil)
                    <img class="w-[200px] aspect-square object-cover object-center rounded-full border-4 border-pink"
                        src="{{ asset(auth()->user()->w_couple->foto_profil) }}" alt="Foto Profil" id="fotoProfil">
                @else
                    <span class="w-[200px] aspect-square bg-pink rounded-full flex items-center justify-center text-[5em] font-bold text-white border-4 border-pink"
                        id="fotoProfilText">
                        {{ ucwords(substr(auth()->user()->name, 0, 1)) }}
                    </span>
                @endif

                @if (auth()->user()->w_couple)
                    <a class="w-full py-2 font-semibold outline-none text-center text-pink bg-white hover:bg-pink hover:text-white focus:bg-pink focus:text-white active:bg-pink-active transition-colors rounded"
                        href="{{ route('user.profil.ke_ubah_foto') }}" id="gantiFotoBtn">
                        <i class="fa-regular fa-image"></i>
                        <span>Ganti Foto</span>
                    </a>
                @endif
            </div>

            <div class="w-full">
                {{-- ATAS --}}
                <div class="w-100 flex items-start justify-between gap-8">
                    {{-- KIRI --}}
                    <div class="w-[50%] flex-1">
                        {{-- NAMA --}}
                        <div class="w-100 mb-4">
                            <div class="w-100 p-2 text-xs font-bold bg-pink text-white flex items-center justify-start rounded-t">
                                <i class="fa-solid fa-user"></i>
                                <span class="ml-2">
                                    Nama
                                </span>
                            </div>
                            <input class="w-full p-2 flex-1 border-x-2 border-b-2 text-sm rounded-b focus:border-pink focus:outline-none"
                                type="text" name="nama" id="nama" placeholder="Budi Pekerti"
                                value="{{ auth()->user()->w_couple ? auth()->user()->w_couple->nama : 'Belum Terdata'  }}"
                                disabled>
                        </div>

                        {{-- TELEPON --}}
                        <div class="w-100 mb-4">
                            <div class="w-100 p-2 text-xs font-bold bg-pink text-white flex items-center justify-start rounded-t">
                                <i class="fa-solid fa-phone"></i>
                                <span class="ml-2">
                                    Telepon
                                </span>
                            </div>
                            <input class="w-full p-2 flex-1 border-x-2 border-b-2 text-sm rounded-b focus:border-pink focus:outline-none"
                                type="number" name="no_telp" id="no_telp" placeholder="081234567890" min="0"
                                value="{{ auth()->user()->w_couple ? auth()->user()->w_couple->no_telp : '0800000000'  }}"
                                disabled>
                        </div>

                        {{-- EMAIL --}}
                        <div class="w-100 mb-4">
                            <div class="w-100 p-2 text-xs font-bold bg-pink text-white flex items-center justify-start rounded-t">
                                <i class="fa-solid fa-at"></i>
                                <span class="ml-2">
                                    Email
                                </span>
                            </div>
                            <input class="w-full p-2 flex-1 border-x-2 border-b-2 text-sm rounded-b focus:border-pink focus:outline-none"
                                type="email" name="email" id="email" placeholder="email@gmai.com" value="{{ auth()->user()->email }}" disabled>
                        </div>
                    </div>
                </div>

                {{-- BUTTON --}}
                <div class="w-100 mt-4 flex items-center justify-end gap-4">
                    <a class="w-fit px-4 py-2 font-semibold outline-none text-pink bg-white hover:bg-pink hover:text-white focus:bg-pink focus:text-white active:bg-pink-active transition-colors rounded"
                        href="{{ route('user.profil.ke_ubah_password') }}">
                        <i class="fa-solid fa-lock"></i>
                        <span>Ubah Password</span>
                    </a>

                    <a class="w-fit px-4 py-2 rounded text-white font-semibold bg-pink hover:bg-pink-hover focus:bg-pink-hover active:bg-pink-active focus:outline-pink-hover focus:outline-offset-2 transition-colors"
                        href="{{ route('user.profil.ke_ubah') }}">
                        <i class="fa-regular fa-pen-to-square"></i>
                        <span>Ubah Profil</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
