@extends('user.wedding-organizer.layout')

@section('title')
    <title>Profil | Wedding Marketplace</title>
@endsection

@section('h1', 'Profil')

@section('content')
    {{-- DATA DIRI --}}
    <div class="w-100 flex gap-8">
        <div class="w-fit">
            <div class="flex flex-col items-center justify-start gap-4 mb-4">
                @if (auth()->user()->w_organizer && auth()->user()->w_organizer->foto_profil)
                    <img class="w-[200px] aspect-square object-cover object-center rounded-full border-4 border-pink"
                        src="{{ asset(auth()->user()->w_organizer->foto_profil) }}" alt="Foto Profil" id="fotoProfil">
                @else
                    <span class="w-[200px] aspect-square bg-pink rounded-full flex items-center justify-center text-[5em] font-bold text-white border-4 border-pink"
                        id="fotoProfilText">
                        {{ substr(auth()->user()->name, 0, 1) }}
                    </span>
                    <img class="hidden w-[200px] aspect-square object-cover object-center rounded-full border-4 border-pink"
                        src="" alt="Foto Profil" id="fotoProfil">
                @endif

                @if (auth()->user()->w_organizer)
                    <a class="w-full py-2 font-semibold outline-none text-center text-pink bg-white hover:bg-pink hover:text-white focus:bg-pink focus:text-white active:bg-pink-active transition-colors rounded"
                        href="{{ route('wedding-organizer.profil.ke_ubah_foto') }}" id="gantiFotoBtn">
                        <i class="fa-regular fa-image"></i>
                        <span>Ganti Foto</span>
                    </a>
                @endif
            </div>

            <div class="w-full shadow rounded">
                <div class="w-full px-2 py-1 bg-pink text-white text-sm font-semibold rounded-t">
                    <i class="fa-solid fa-hashtag"></i>
                    <span class="ml-2">
                        Kategori
                    </span>
                </div>
                <div class="w-full p-2 flex flex-wrap items-start justify-start">
                    @if (auth()->user()->w_organizer)
                        @forelse (auth()->user()->w_organizer->category as $category)
                            <div class="w-fit px-2 py-1 text-xs border border-pink rounded-full">
                                {{ $category->w_categories->nama }}
                            </div>
                        @empty
                            <div class="w-fit px-1 text-xs border border-pink rounded-full">
                                no data
                            </div>
                        @endforelse
                    @else
                        <div class="w-fit px-1 text-xs border border-pink rounded-full">
                            no data
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="w-full flex-1">
            {{-- ATAS --}}
            <div class="w-100 flex items-start justify-between gap-8">
                {{-- KIRI --}}
                <div class="flex-1">
                    {{-- NAMA PEMILIK --}}
                    <div class="w-100 mb-4">
                        <div class="w-100 p-2 text-xs font-bold bg-pink text-white flex items-center justify-start rounded-t">
                            <i class="fa-solid fa-building-user"></i>
                            <span class="ml-2">
                                Nama Pemilik
                            </span>
                        </div>
                        <input class="w-full p-2 flex-1 border-x-2 border-b-2 text-sm rounded-b focus:border-pink focus:outline-none"
                            type="text" name="nama_pemilik" id="nama_pemilik" placeholder="Budi Pekerti"
                            value="{{ auth()->user()->w_organizer ? auth()->user()->w_organizer->nama_pemilik : 'Belum Terdata'  }}"
                            disabled>
                    </div>

                    {{-- NAMA PERUSAHAAN --}}
                    <div class="w-100 mb-4">
                        <div class="w-100 p-2 text-xs font-bold bg-pink text-white flex items-center justify-start rounded-t">
                            <i class="fa-solid fa-building"></i>
                            <span class="ml-2">
                                Nama Perusahaan
                            </span>
                        </div>
                        <input class="w-full p-2 flex-1 border-x-2 border-b-2 text-sm rounded-b focus:border-pink focus:outline-none"
                            type="text" name="nama_perusahaan" id="nama_perusahaan" placeholder="PT. Ayo Nikah"
                            value="{{ auth()->user()->w_organizer ? auth()->user()->w_organizer->nama_perusahaan : 'Belum Terdata'  }}"
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
                            type="number" name="no_telp" id="no_telp" placeholder="081234567890"
                            value="{{ auth()->user()->w_organizer ? auth()->user()->w_organizer->no_telp : '0800000000'  }}"
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

                {{-- KANAN --}}
                <div class="flex-1">
                    {{-- BASIS OPERASI --}}
                    <div class="w-100 mb-4">
                        <div class="w-100 p-2 text-xs font-bold bg-pink text-white flex items-center justify-start rounded-t">
                            <i class="fa-regular fa-circle-dot"></i>
                            <span class="ml-2">
                                Basis Operasi
                            </span>
                        </div>
                        <input class="w-full p-2 flex-1 border-x-2 border-b-2 text-sm rounded-b focus:border-pink focus:outline-none"
                            type="text" name="basis_operasi" id="basis_operasi" placeholder="Dalam/Luar Kota"
                            value="{{ auth()->user()->w_organizer ? auth()->user()->w_organizer->basis_operasi : 'Belum Terdata'  }}"
                            disabled>
                    </div>

                    @if (auth()->user()->w_organizer && auth()->user()->w_organizer->basis_operasi == 'Hanya di Dalam Kota')
                        {{-- KOTA OPERASI --}}
                        <div class="w-100 mb-4">
                            <div class="w-100 p-2 text-xs font-bold bg-pink text-white flex items-center justify-start rounded-t">
                                <i class="fa-solid fa-location-crosshairs"></i>
                                <span class="ml-2">
                                    Kota Operasi
                                </span>
                            </div>
                            <input class="w-full p-2 flex-1 border-x-2 border-b-2 text-sm rounded-b focus:border-pink focus:outline-none"
                                type="text" name="kota_operasi" id="kota_operasi" placeholder="Badung"
                                value="{{ auth()->user()->w_organizer ? auth()->user()->w_organizer->kota_operasi : 'Belum Terdata'  }}"
                                disabled>
                        </div>
                    @endif
                </div>
            </div>

            <div class="w-100 mb-4">
                <div class="w-100 p-2 text-xs font-bold bg-pink text-white flex items-center justify-start rounded-t">
                    <i class="fa-solid fa-location-dot"></i>
                    <span class="ml-2">
                        Alamat Perusahaan
                    </span>
                </div>
                <input class="w-full p-2 flex-1 border-x-2 border-b-2 text-sm rounded-b focus:border-pink focus:outline-none"
                type="text" name="alamat" id="alamat" placeholder="Jl. Kebon Duren"
                value="{{ auth()->user()->w_organizer ? auth()->user()->w_organizer->alamat : 'Belum Terdata'  }}"
                disabled>
            </div>

            {{-- BUTTON --}}
            <div class="w-100 mt-4 flex items-center justify-end gap-4">
                <a class="w-fit px-4 py-2 font-semibold outline-none text-pink bg-white hover:bg-pink hover:text-white focus:bg-pink focus:text-white active:bg-pink-active transition-colors rounded"
                    href="{{ route('wedding-organizer.profil.ke_ubah_password') }}">
                    <i class="fa-solid fa-lock"></i>
                    <span>Ubah Password</span>
                </a>

                @if (auth()->user()->w_organizer)
                    <a class="w-fit px-4 py-2 font-semibold outline-none text-pink bg-white hover:bg-pink hover:text-white focus:bg-pink focus:text-white active:bg-pink-active transition-colors rounded"
                        href="{{ route('wedding-organizer.profil.ke_ubah_kategori') }}">
                        <i class="fa-solid fa-hashtag"></i>
                        <span>Ubah Kategori</span>
                    </a>
                @endif

                <a class="w-fit px-4 py-2 rounded text-white font-semibold bg-pink hover:bg-pink-hover focus:bg-pink-hover active:bg-pink-active focus:outline-pink-hover focus:outline-offset-2 transition-colors"
                    href="{{ route('wedding-organizer.profil.ke_ubah') }}">
                    <i class="fa-regular fa-pen-to-square"></i>
                    <span>Ubah Profil</span>
                </a>
            </div>
        </div>
    </div>
@endsection
