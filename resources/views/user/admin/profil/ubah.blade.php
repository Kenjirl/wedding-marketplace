@extends('user.admin.layout')

@section('title')
    <title>Ubah Profil | Wedding Marketplace</title>
@endsection

@section('h1', 'Profil > Ubah Profil')

@section('content')
    <form action="{{ route('admin.profil.ubah') }}" method="post">
        @csrf
        {{-- INPUT --}}
        <div class="w-full flex items-start justify-start gap-8">
            {{-- KIRI --}}
            <div class="flex-1">
                {{-- NAMA --}}
                <div class="w-100 mb-4">
                    <div class="w-100">
                        <div class="w-100 p-2 text-xs font-bold bg-pink @error('nama') bg-red-500 @enderror text-white flex items-center justify-start rounded-t">
                            Nama
                        </div>
                        <input class="w-full p-2 flex-1 border-x-2 border-b-2 text-sm @error('nama') border-red-500 @enderror rounded-b focus:border-pink focus:outline-none"
                            type="text" name="nama" id="nama" placeholder="Budi Pekerti"
                            value="{{ old('nama', auth()->user()->admin->nama) }}"
                            required>
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
                        <div class="w-100 p-2 text-xs font-bold bg-pink @error('username') bg-red-500 @enderror text-white flex items-center justify-start rounded-t">
                            Nama Pengguna
                        </div>
                        <input class="w-full p-2 flex-1 border-x-2 border-b-2 text-sm @error('username') border-red-500 @enderror rounded-b focus:border-pink focus:outline-none"
                            type="text" name="username" id="username" placeholder="Budi123"
                            value="{{ old('username', auth()->user()->name) }}"
                            required>
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
                        <div class="w-100 p-2 text-xs font-bold bg-pink @error('no_telp') bg-red-500 @enderror text-white flex items-center justify-start rounded-t">
                            Telepon
                        </div>
                        <input class="w-full p-2 flex-1 border-x-2 border-b-2 text-sm @error('no_telp') border-red-500 @enderror rounded-b focus:border-pink focus:outline-none"
                            type="number" name="no_telp" id="no_telp" placeholder="081234567890" min="0"
                            value="{{ old('no_telp', auth()->user()->admin->no_telp) }}"
                            required>
                    </div>

                    <div class="mt-1 text-sm text-red-500 flex items-center justify-start gap-2">
                        @error('no_telp')
                            <i class="fa-solid fa-circle-info"></i>
                            <span>{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                {{-- GENDER --}}
                <div class="w-100 mb-4">
                    <div class="relative w-100">
                        <div class="w-full p-2 text-xs font-bold bg-pink @error('gender') bg-red-500 @enderror text-white flex items-center justify-start rounded-t">
                            Gender
                        </div>
                        <input class="w-full p-2 flex-1 border-x-2 border-b-2 text-sm @error('gender') border-red-500 @enderror rounded-b focus:border-pink focus:outline-none"
                            type="text" name="gender" id="gender" placeholder="Pria/Wanita" onkeyup="changeGenderOptions()" onfocus="showGenderOptions()"
                            required
                            value="{{ old('gender', auth()->user()->admin->gender) }}">

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

            {{-- KANAN --}}
            <div class="flex-1">
                {{-- PROVINSI --}}
                <div class="relative w-100 mb-4">
                    <div class="w-100">
                        <div class="w-full p-2 text-xs font-bold bg-pink @error('provinsi') bg-red-500 @enderror text-white flex items-center justify-start rounded-t">
                            Provinsi
                        </div>
                        <input class="w-full p-2 flex-1 border-x-2 border-b-2 text-sm @error('provinsi') border-red-500 @enderror rounded-b focus:border-pink focus:outline-none"
                            type="text" name="provinsi" id="provinsi" placeholder="Bali"
                            required
                            value="{{ old('provinsi', $provinsi) }}">
                    </div>

                    <div class="mt-1 text-sm text-red-500 flex items-center justify-start gap-2">
                        @error('provinsi')
                            <i class="fa-solid fa-circle-info"></i>
                            <span>{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                {{-- KOTA --}}
                <div class="relative w-100 mb-4">
                    <div class="w-100">
                        <div class="w-full p-2 text-xs font-bold bg-pink @error('kota') bg-red-500 @enderror text-white flex items-center justify-start rounded-t">
                            Kota/Kabupaten
                        </div>
                        <input class="w-full p-2 flex-1 border-x-2 border-b-2 text-sm @error('kota') border-red-500 @enderror rounded-b focus:border-pink focus:outline-none"
                            type="text" name="kota" id="kota" placeholder="Badung"
                            required
                            value="{{ old('kota', $kota) }}">
                    </div>

                    <div class="mt-1 text-sm text-red-500 flex items-center justify-start gap-2">
                        @error('kota')
                            <i class="fa-solid fa-circle-info"></i>
                            <span>{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                {{-- KECAMATAN --}}
                <div class="relative w-100 mb-4">
                    <div class="w-100">
                        <div class="w-full p-2 text-xs font-bold bg-pink @error('kecamatan') bg-red-500 @enderror text-white flex items-center justify-start rounded-t">
                            Kecamatan
                        </div>
                        <input class="w-full p-2 flex-1 border-x-2 border-b-2 text-sm @error('kecamatan') border-red-500 @enderror rounded-b focus:border-pink focus:outline-none"
                            type="text" name="kecamatan" id="kecamatan" placeholder="Kuta Selatan"
                            value="{{ old('kecamatan', $kecamatan) }}">
                    </div>

                    <div class="mt-1 text-sm text-red-500 flex items-center justify-start gap-2">
                        @error('kecamatan')
                            <i class="fa-solid fa-circle-info"></i>
                            <span>{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                {{-- KELURAHAN --}}
                <div class="relative w-100 mb-4">
                    <div class="w-100">
                        <div class="w-full p-2 text-xs font-bold bg-pink @error('kelurahan') bg-red-500 @enderror text-white flex items-center justify-start rounded-t">
                            Kelurahan
                        </div>
                        <input class="w-full p-2 flex-1 border-x-2 border-b-2 text-sm @error('kelurahan') border-red-500 @enderror rounded-b focus:border-pink focus:outline-none"
                            type="text" name="kelurahan" id="kelurahan" placeholder="Jimbaran"
                            required
                            value="{{ old('kelurahan', $kelurahan) }}">
                    </div>

                    <div class="mt-1 text-sm text-red-500 flex items-center justify-start gap-2">
                        @error('kelurahan')
                            <i class="fa-solid fa-circle-info"></i>
                            <span>{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                {{-- ALAMAT --}}
                <div class="relative w-100 mb-4">
                    <div class="w-100">
                        <div class="w-full p-2 text-xs font-bold bg-pink @error('alamat_detail') bg-red-500 @enderror text-white flex items-center justify-start rounded-t">
                            Alamat Detail
                        </div>
                        <input class="w-full p-2 flex-1 border-x-2 border-b-2 text-sm @error('alamat_detail') border-red-500 @enderror rounded-b focus:border-pink focus:outline-none"
                            type="text" name="alamat_detail" id="alamat_detail" placeholder="Jl. Besar no. 1"
                            required
                            value="{{ old('alamat_detail', $alamat_detail) }}">
                    </div>

                    <div class="mt-1 text-sm text-red-500 flex items-center justify-start gap-2">
                        @error('alamat_detail')
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
                href="{{ route('admin.profil.index') }}">
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
@endsection

@push('child-js')
    {{-- GENDER SCRIPT --}}
    <script>
        function showGenderOptions() {
            $('#genderOptions').removeClass('hidden').addClass('flex');
        }

        function hideGenderOptions() {
            $("#genderOptions").removeClass("flex").addClass("hidden");
        }

        function changeGenderOptions() {
            const filterValue = $("#gender").val().toLowerCase();
            $("#genderOptions button").each(function() {
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

        document.addEventListener('click', function(event) {
            const genderOptions = document.getElementById('genderOptions');
            const genderInput = document.getElementById('gender');
            if (!genderOptions.classList.contains('hidden') && event.target !== genderOptions && !genderOptions.contains(event.target) && event.target !== genderInput) {
                hideGenderOptions();
            }
        });
    </script>
@endpush
