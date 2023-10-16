@extends('user.wedding-organizer.layout')

@section('title')
    <title>Profil | Wedding Marketplace</title>
@endsection

@section('h1', 'Profil')

@section('content')
    {{-- DATA DIRI --}}
    <div class="w-100 flex gap-8">
        <div>
            <img class="w-[200px] aspect-square object-cover object-center rounded-full border-4 border-pink"
                src="{{ asset('img/Foto Profil.jpg') }}" alt="Foto Profil">
        </div>

        <div class="w-100 flex-1">
            {{-- ATAS --}}
            <div class="w-100 flex items-start justify-between gap-8">
                {{-- KIRI --}}
                <div class="flex-1">
                    {{-- NAMA PEMILIK --}}
                    <div class="w-100 mb-4">
                        <div class="w-100 p-2 text-xs font-bold bg-pink text-white flex items-center justify-start rounded-t">
                            Nama Pemilik
                        </div>
                        <input class="w-full p-2 flex-1 border-x-2 border-b-2 rounded-b focus:border-pink focus:outline-none"
                            type="text" name="nama_pemilik" id="nama_pemilik" placeholder="Budi Pekerti"
                            value="{{ auth()->user()->w_organizer ? auth()->user()->w_organizer->nama_pemilik : 'Belum Terdata'  }}"
                            disabled>
                    </div>

                    {{-- NAMA PERUSAHAAN --}}
                    <div class="w-100 mb-4">
                        <div class="w-100 p-2 text-xs font-bold bg-pink text-white flex items-center justify-start rounded-t">
                            Nama Perusahaan
                        </div>
                        <input class="w-full p-2 flex-1 border-x-2 border-b-2 rounded-b focus:border-pink focus:outline-none"
                            type="text" name="nama_perusahaan" id="nama_perusahaan" placeholder="PT. Ayo Nikah"
                            value="{{ auth()->user()->w_organizer ? auth()->user()->w_organizer->nama_perusahaan : 'Belum Terdata'  }}"
                            disabled>
                    </div>

                    {{-- TELEPON --}}
                    <div class="w-100 mb-4">
                        <div class="w-100 p-2 text-xs font-bold bg-pink text-white flex items-center justify-start rounded-t">
                            Telepon
                        </div>
                        <input class="w-full p-2 flex-1 border-x-2 border-b-2 rounded-b focus:border-pink focus:outline-none"
                            type="number" name="no_telp" id="no_telp" placeholder="081234567890"
                            value="{{ auth()->user()->w_organizer ? auth()->user()->w_organizer->no_telp : '0800000000'  }}"
                            disabled>
                    </div>

                    {{-- EMAIL --}}
                    <div class="w-100 mb-4">
                        <div class="w-100 p-2 text-xs font-bold bg-pink text-white flex items-center justify-start rounded-t">
                            Email
                        </div>
                        <input class="w-full p-2 flex-1 border-x-2 border-b-2 rounded-b focus:border-pink focus:outline-none"
                            type="email" name="email" id="email" placeholder="email@gmai.com" value="{{ auth()->user()->email }}" disabled>
                    </div>
                </div>

                {{-- KANAN --}}
                <div class="flex-1">
                    {{-- BASIS OPERASI --}}
                    <div class="w-100 mb-4">
                        <div class="w-100 p-2 text-xs font-bold bg-pink text-white flex items-center justify-start rounded-t">
                            Basis Operasi
                        </div>
                        <input class="w-full p-2 flex-1 border-x-2 border-b-2 rounded-b focus:border-pink focus:outline-none"
                            type="text" name="basis_operasi" id="basis_operasi" placeholder="Dalam/Luar Kota"
                            value="{{ auth()->user()->w_organizer ? auth()->user()->w_organizer->basis_operasi : 'Belum Terdata'  }}"
                            disabled>
                    </div>

                    @if (auth()->user()->w_organizer && auth()->user()->w_organizer->basis_operasi == 'Hanya di Dalam Kota')
                        {{-- KOTA OPERASI --}}
                        <div class="w-100 mb-4">
                            <div class="w-100 p-2 text-xs font-bold bg-pink text-white flex items-center justify-start rounded-t">
                                Kota Operasi
                            </div>
                            <input class="w-full p-2 flex-1 border-x-2 border-b-2 rounded-b focus:border-pink focus:outline-none"
                                type="text" name="kota_operasi" id="kota_operasi" placeholder="Badung"
                                value="{{ auth()->user()->w_organizer ? auth()->user()->w_organizer->kota_operasi : 'Belum Terdata'  }}"
                                disabled>
                        </div>
                    @endif
                </div>
            </div>

            <div class="w-100 mb-4">
                <div class="w-100 p-2 text-xs font-bold bg-pink text-white flex items-center justify-start rounded-t">
                    Alamat Perusahaan
                </div>
                <input class="w-full p-2 flex-1 border-x-2 border-b-2 rounded-b focus:border-pink focus:outline-none"
                type="text" name="alamat" id="alamat" placeholder="Jl. Kebon Duren"
                value="{{ auth()->user()->w_organizer ? auth()->user()->w_organizer->alamat : 'Belum Terdata'  }}"
                disabled>
            </div>

            {{-- BUTTON --}}
            <div class="w-100 mt-4 flex items-center justify-end gap-4">
                <a class="w-fit p-2 font-semibold outline-none text-pink bg-white hover:bg-pink hover:text-white focus:bg-pink focus:text-white active:bg-pink-active transition-colors rounded"
                    href="{{ route('wedding-organizer.ke_ubah_password') }}">
                    <i class="fa-solid fa-lock"></i>
                    <span>Ubah Password</span>
                </a>

                <a class="w-fit px-4 py-2 rounded text-white font-semibold bg-pink hover:bg-pink-hover focus:bg-pink-hover active:bg-pink-active focus:outline-pink-hover focus:outline-offset-2 transition-colors"
                    href="{{ route('wedding-organizer.ke_ubah_profil') }}">
                    <i class="fa-regular fa-pen-to-square"></i>
                    <span>Ubah Profil</span>
                </a>
            </div>
        </div>
    </div>
@endsection
