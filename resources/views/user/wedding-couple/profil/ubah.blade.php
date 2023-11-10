@extends('user.wedding-couple.layout')

@section('title')
    <title>Ubah Profil | Wedding Marketplace</title>
@endsection

@section('h1', 'Profil > Ubah Profil')

@section('content')
    <div class="px-4 pb-4">
        <ol class="list-decimal text-sm">
            <li>Silahkan isi data diri Anda</li>
            <li>Harap memilih data sesuai dengan pilihan yang sudah disediakan</li>
            <li>Harap untuk tidak menggunakan tanda baca apapun kecuali pada Nama Pengguna</li>
        </ol>
    </div>

    <div class="w-[50%]">
        <form action="{{ route('wedding-couple.profil.ubah') }}" method="post" autocomplete="off">
            @csrf
            {{-- ATAS --}}
            <div class="w-full flex items-start justify-between gap-8">
                <div class="w-full">
                    {{-- NAMA & NAMA PENGGUNA CONTAINER --}}
                    <div class="grid grid-cols-2 gap-4">
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
                    </div>

                    {{-- TELEPON & GENDER CONTAINER --}}
                    <div class="grid grid-cols-2 gap-4">
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
                                    type="number" name="no_telp" id="no_telp" placeholder="081234567890"
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

                        {{-- GENDER --}}
                        <div class="relative w-100 mb-4" id="genderContainer">
                            <div class="w-100">
                                <div class="w-full p-2 text-xs font-bold bg-pink @error('gender') bg-red-500 @enderror text-white flex items-center justify-start rounded-t">
                                    <i class="fa-solid fa-venus-mars"></i>
                                    <span class="ml-2">
                                        Gender
                                    </span>
                                </div>
                                <input class="w-full p-2 flex-1 border-x-2 border-b-2 text-sm @error('gender') border-red-500 @enderror rounded-b focus:border-pink focus:outline-none"
                                    type="text" name="gender" id="gender" placeholder="Pria/Wanita" onkeyup="changeGenderOptions()" onfocus="showGenderOptions()"
                                    required
                                    value="{{ old('gender', auth()->user()->w_couple ? auth()->user()->w_couple->gender : '') }}">

                                <div class="absolute w-full p-1 gap-1 rounded bg-slate-200 hidden flex-col items-start justify-start z-10"
                                    id="genderOptions">
                                    <button class="w-full text-start outline-none rounded-sm px-2 bg-white hover:bg-slate-300 focus:bg-slate-300 active:bg-slate-400 transition-colors"
                                        type="button" data-value="Pria" onclick="selectGender(this)">
                                        Pria
                                    </button>
                                    <button class="w-full text-start outline-none rounded-sm px-2 bg-white hover:bg-slate-300 focus:bg-slate-300 active:bg-slate-400 transition-colors"
                                        type="button" data-value="Wanita" onclick="selectGender(this)">
                                        Wanita
                                    </button>
                                </div>
                            </div>

                            <div class="mt-1 text-sm text-red-500 flex items-center justify-start gap-2">
                                @error('gender')
                                    <i class="fa-solid fa-circle-info"></i>
                                    <span>{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- BUTTON --}}
            <div class="w-100 mt-4 flex items-center justify-end gap-4">
                <a class="w-fit p-2 font-semibold outline-none text-pink bg-white hover:bg-pink hover:text-white focus:bg-pink focus:text-white active:bg-pink-active transition-colors rounded"
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

    {{-- GENDER SCRIPT --}}
    <script>
        function showGenderOptions() {
            $('#genderOptions').removeClass('hidden').addClass('flex');
        }

        function hideGenderOptions() {
            $('#genderOptions').removeClass('flex').addClass('hidden');
        }

        function changeGenderOptions() {
            const filterValue = $('#gender').val().toLowerCase();
            $('#genderOptions button').each(function() {
                const buttonFilter = $(this).data('value').toLowerCase();
                if (buttonFilter.includes(filterValue)) {
                    $(this).removeClass('hidden');
                } else {
                    $(this).addClass('hidden');
                }
            });
        }

        function selectGender(button) {
            const dataValue = button.getAttribute('data-value');
            $('#gender').val(dataValue);
            hideGenderOptions();
        }
    </script>

    <script>
        document.addEventListener('click', function(event) {
            const genderOptions = document.getElementById('genderOptions');
            const genderInput = document.getElementById('gender');
            if (!genderOptions.classList.contains('hidden') && event.target !== genderOptions && !genderOptions.contains(event.target) && event.target !== genderInput) {
                hideGenderOptions();
            }
        });
    </script>
@endsection
