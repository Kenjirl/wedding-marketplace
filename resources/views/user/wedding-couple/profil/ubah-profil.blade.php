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
        <form action="{{ route('wedding-couple.ubah_profil') }}" method="post" autocomplete="off">
            @csrf
            {{-- ATAS --}}
            <div class="w-100 flex items-start justify-between gap-8">
                {{-- KIRI --}}
                <div class="w-full" id="formKiri">
                    {{-- NAMA --}}
                    <div class="w-100 mb-4">
                        <div class="w-100">
                            <div class="w-full p-2 text-xs font-bold bg-pink @error('nama') bg-red-500 @enderror text-white flex items-center justify-start rounded-t">
                                Nama
                            </div>
                            <input class="w-full p-2 flex-1 border-x-2 border-b-2 @error('nama') border-red-500 @enderror rounded-b focus:border-pink focus:outline-none"
                                type="text" name="nama" id="nama" placeholder="Budi Pekerti"
                                required
                                value="{{ old('nama', auth()->user()->w_couple ? auth()->user()->w_couple->nama : '') }}">
                        </div>

                        <div class="h-4 mt-1 text-sm text-red-500 flex items-center justify-start gap-2">
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
                                Nama Pengguna
                            </div>
                            <input class="w-full p-2 flex-1 border-x-2 border-b-2 @error('username') border-red-500 @enderror rounded-b focus:border-pink focus:outline-none"
                                type="text" name="username" id="username" placeholder="Budi123"
                                required
                                value="{{ old('username', auth()->user()->name) }}">
                        </div>

                        <div class="h-4 mt-1 text-sm text-red-500 flex items-center justify-start gap-2">
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
                                Telepon
                            </div>
                            <input class="w-full p-2 flex-1 border-x-2 border-b-2 @error('no_telp') border-red-500 @enderror rounded-b focus:border-pink focus:outline-none"
                                type="number" name="no_telp" id="no_telp" placeholder="081234567890"
                                required
                                value="{{ old('no_telp', auth()->user()->w_couple ? auth()->user()->w_couple->no_telp : '') }}">
                        </div>

                        <div class="h-4 mt-1 text-sm text-red-500 flex items-center justify-start gap-2">
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
                                Gender
                            </div>
                            <input class="w-full p-2 flex-1 border-x-2 border-b-2 @error('gender') border-red-500 @enderror rounded-b focus:border-pink focus:outline-none"
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

                        <div class="h-4 mt-1 text-sm text-red-500 flex items-center justify-start gap-2">
                            @error('gender')
                                <i class="fa-solid fa-circle-info"></i>
                                <span>{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            {{-- BUTTON --}}
            <div class="w-100 mt-4 flex items-center justify-end gap-4">
                <a class="w-fit p-2 font-semibold outline-none text-pink bg-white hover:bg-pink hover:text-white focus:bg-pink focus:text-white active:bg-pink-active transition-colors rounded"
                    href="{{ route('wedding-couple.ke_profil') }}">
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
            const genderOptions = document.getElementById('genderOptions');
            genderOptions.classList.remove('hidden');
            genderOptions.classList.add('flex');
        }

        function hideGenderOptions() {
            const genderOptions = document.getElementById('genderOptions');
            genderOptions.classList.remove('flex');
            genderOptions.classList.add('hidden');
        }

        function changeGenderOptions() {
            const genderInput = document.getElementById('gender');
            const genderOptions = document.getElementById('genderOptions');
            const genderButtons = genderOptions.querySelectorAll('button');
            const filterValue = genderInput.value.toLowerCase();

            for (const button of genderButtons) {
                const buttonFilter = button.getAttribute('data-value').toLowerCase();
                if (buttonFilter.includes(filterValue)) {
                    button.classList.remove('hidden');
                } else {
                    button.classList.add('hidden');
                }
            }
        }

        function selectGender(button) {
            const genderInput = document.getElementById('gender');
            const dataValue = button.getAttribute('data-value');
            genderInput.value = dataValue;
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
