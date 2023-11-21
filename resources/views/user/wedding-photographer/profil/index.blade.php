@extends('user.wedding-photographer.layout')

@section('title')
    <title>Profil | Wedding Marketplace</title>
@endsection

@section('h1', 'Profil')

@section('content')
    {{-- DATA DIRI --}}
    <div class="w-100 flex gap-8">
        <div class="w-fit flex flex-col items-center justify-start gap-4">
            @if (auth()->user()->w_photographer && auth()->user()->w_photographer->foto_profil)
                <img class="w-[200px] aspect-square object-cover object-center rounded-full border-4 border-pink"
                    src="{{ asset(auth()->user()->w_photographer->foto_profil) }}" alt="Foto Profil" id="fotoProfil">
            @else
                <span class="w-[200px] aspect-square bg-pink rounded-full flex items-center justify-center text-[5em] font-bold text-white border-4 border-pink"
                    id="fotoProfilText">
                    {{ substr(auth()->user()->name, 0, 1) }}
                </span>
            @endif

            @if (auth()->user()->w_photographer)
                <a class="w-full py-2 font-semibold outline-none text-center text-pink bg-white hover:bg-pink hover:text-white focus:bg-pink focus:text-white active:bg-pink-active transition-colors rounded"
                    href="{{ route('wedding-photographer.profil.ke_ubah_foto') }}" id="gantiFotoBtn">
                    <i class="fa-regular fa-image"></i>
                    <span>Ganti Foto</span>
                </a>
            @endif
        </div>

        <div class="w-100 flex-1">
            {{-- ATAS --}}
            <div class="w-100 flex items-start justify-between gap-8">
                {{-- KIRI --}}
                <div class="flex-1">
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
                            value="{{ auth()->user()->w_photographer ? auth()->user()->w_photographer->nama : 'Belum Terdata'  }}"
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
                            value="{{ auth()->user()->w_photographer ? auth()->user()->w_photographer->no_telp : '0800000000'  }}"
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

                    @if (auth()->user()->w_photographer && auth()->user()->w_photographer->status == 'Individu')
                        {{-- GENDER --}}
                        <div class="w-100 mb-4">
                            <div class="w-100 p-2 text-xs font-bold bg-pink text-white flex items-center justify-start rounded-t">
                                <i class="fa-solid fa-venus-mars"></i>
                                <span class="ml-2">
                                    Gender
                                </span>
                            </div>
                            <input class="w-full p-2 flex-1 border-x-2 border-b-2 text-sm rounded-b focus:border-pink focus:outline-none"
                                type="text" name="gender" id="gender" placeholder="Pria/Wanita"
                                value="{{ auth()->user()->w_photographer ? auth()->user()->w_photographer->gender : 'Belum Terdata'  }}"
                                disabled>
                        </div>
                    @endif
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
                            value="{{ auth()->user()->w_photographer ? auth()->user()->w_photographer->basis_operasi : 'Belum Terdata'  }}"
                            disabled>
                    </div>

                    @if (auth()->user()->w_photographer && auth()->user()->w_photographer->basis_operasi == 'Hanya di Dalam Kota')
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
                                value="{{ auth()->user()->w_photographer ? auth()->user()->w_photographer->kota_operasi : 'Belum Terdata'  }}"
                                disabled>
                        </div>
                    @endif

                    {{-- STATUS --}}
                    <div class="w-100 mb-4">
                        <div class="w-100 p-2 text-xs font-bold bg-pink text-white flex items-center justify-start rounded-t">
                            <i class="fa-solid fa-briefcase"></i>
                            <span class="ml-2">
                                Status
                            </span>
                        </div>
                        <input class="w-full p-2 flex-1 border-x-2 border-b-2 text-sm rounded-b focus:border-pink focus:outline-none"
                            type="text" name="status" id="status" placeholder="Individu/Organisasi"
                            value="{{ auth()->user()->w_photographer ? auth()->user()->w_photographer->status : 'Belum Terdata'  }}"
                            disabled>
                    </div>
                </div>
            </div>

            {{-- BAWAH --}}
            @if (auth()->user()->w_photographer && auth()->user()->w_photographer->status == 'Organisasi')
                <div class="w-100 mb-4">
                    <div class="w-100 p-2 text-xs font-bold bg-pink text-white flex items-center justify-start rounded-t">
                        <i class="fa-solid fa-location-dot"></i>
                        <span class="ml-2">
                            Alamat
                        </span>
                    </div>
                    <input class="w-full p-2 flex-1 border-x-2 border-b-2 text-sm rounded-b focus:border-pink focus:outline-none"
                        type="text" name="alamat" id="alamat" placeholder="Jl. Kebon Duren"
                        value="{{ auth()->user()->w_photographer ? auth()->user()->w_photographer->alamat : 'Belum Terdata'  }}"
                        disabled>
                </div>
            @endif

            {{-- BUTTON --}}
            <div class="w-100 mt-4 flex items-center justify-end gap-4">
                <a class="w-fit px-4 py-2 font-semibold outline-none text-pink bg-white hover:bg-pink hover:text-white focus:bg-pink focus:text-white active:bg-pink-active transition-colors rounded"
                    href="{{ route('wedding-photographer.profil.ke_ubah_password') }}">
                    <i class="fa-solid fa-lock"></i>
                    <span>Ubah Password</span>
                </a>

                <a class="w-fit px-4 py-2 rounded text-white font-semibold bg-pink hover:bg-pink-hover focus:bg-pink-hover active:bg-pink-active focus:outline-pink-hover focus:outline-offset-2 transition-colors"
                    href="{{ route('wedding-photographer.profil.ke_ubah') }}">
                    <i class="fa-regular fa-pen-to-square"></i>
                    <span>Ubah Profil</span>
                </a>
            </div>
        </div>
    </div>
@endsection
