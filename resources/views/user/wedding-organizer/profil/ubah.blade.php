@extends('user.wedding-organizer.layout')

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

    <div class="w-100 flex-1">
        <form action="{{ route('wedding-organizer.profil.ubah') }}" method="post" autocomplete="off">
            @csrf
            {{-- ATAS --}}
            <div class="w-100 flex items-start justify-between gap-8">
                {{-- KIRI --}}
                <div class="w-[50%]" id="formKiri">
                    {{-- NAMA PEMILIK --}}
                    <div class="w-100 mb-4">
                        <div class="w-100">
                            <div class="w-full p-2 text-xs font-bold bg-pink @error('nama_pemilik') bg-red-500 @enderror text-white flex items-center justify-start rounded-t">
                                <i class="fa-solid fa-building-user"></i>
                                <span class="ml-2">
                                    Nama Pemilik
                                </span>
                            </div>
                            <input class="w-full p-2 flex-1 border-x-2 border-b-2 text-sm @error('nama_pemilik') border-red-500 @enderror rounded-b focus:border-pink focus:outline-none"
                                type="text" name="nama_pemilik" id="nama_pemilik" placeholder="Budi Pekerti"
                                required
                                value="{{ old('nama_pemilik', auth()->user()->w_organizer ? auth()->user()->w_organizer->nama_pemilik : '') }}">
                        </div>

                        <div class="mt-1 text-sm text-red-500 flex items-center justify-start gap-2">
                            @error('nama_pemilik')
                                <i class="fa-solid fa-circle-info"></i>
                                <span>{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    {{-- NAMA PERUSAHAAN --}}
                    <div class="w-100 mb-4">
                        <div class="w-100">
                            <div class="w-full p-2 text-xs font-bold bg-pink @error('nama_perusahaan') bg-red-500 @enderror text-white flex items-center justify-start rounded-t">
                                <i class="fa-solid fa-building"></i>
                                <span class="ml-2">
                                    Nama Perusahaan
                                </span>
                            </div>
                            <input class="w-full p-2 flex-1 border-x-2 border-b-2 text-sm @error('nama_perusahaan') border-red-500 @enderror rounded-b focus:border-pink focus:outline-none"
                                type="text" name="nama_perusahaan" id="nama_perusahaan" placeholder="PT. Ayo Nikah"
                                required
                                value="{{ old('nama_perusahaan', auth()->user()->w_organizer ? auth()->user()->w_organizer->nama_perusahaan : '') }}">
                        </div>

                        <div class="mt-1 text-sm text-red-500 flex items-center justify-start gap-2">
                            @error('nama_perusahaan')
                                <i class="fa-solid fa-circle-info"></i>
                                <span>{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    {{-- NAMA PENGGUNA & NO TELP CONTAINER --}}
                    <div class="grid grid-cols-2 gap-4">
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
                                    value="{{ old('no_telp', auth()->user()->w_organizer ? auth()->user()->w_organizer->no_telp : '') }}">
                            </div>

                            <div class="mt-1 text-sm text-red-500 flex items-center justify-start gap-2">
                                @error('no_telp')
                                    <i class="fa-solid fa-circle-info"></i>
                                    <span>{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    {{-- BASIS KOTA OPERASI CONTAINER --}}
                    <div class="grid grid-cols-2 gap-4">
                        {{-- BASIS OPERASI --}}
                        <div class="relative w-100 mb-4">
                            <div class="w-100">
                                <div class="w-full p-2 text-xs font-bold bg-pink @error('basis_operasi') bg-red-500 @enderror text-white flex items-center justify-start rounded-t">
                                    <i class="fa-regular fa-circle-dot"></i>
                                    <span class="ml-2">
                                        Basis Operasi
                                    </span>
                                </div>
                                <input class="w-full p-2 flex-1 border-x-2 border-b-2 text-sm @error('basis_operasi') border-red-500 @enderror rounded-b focus:border-pink focus:outline-none"
                                    type="text" name="basis_operasi" id="basis_operasi" placeholder="Dalam/Luar Kota" onkeyup="changeBasisOperasiOptions()" onfocus="showBasisOperasiOptions()"
                                    required
                                    value="{{ old('basis_operasi', auth()->user()->w_organizer ? auth()->user()->w_organizer->basis_operasi : '') }}">

                                <div class="absolute w-full p-1 gap-1 rounded bg-slate-200 hidden flex-col items-start justify-start z-10"
                                    id="basisOperasiOptions">
                                    <button class="w-full text-start outline-none rounded-sm px-2 bg-white hover:bg-slate-300 focus:bg-slate-300 active:bg-slate-400 transition-colors"
                                        type="button" data-value="Hanya di Dalam Kota" onclick="selectBasisOperasi(this)">
                                        Hanya di Dalam Kota
                                    </button>
                                    <button class="w-full text-start outline-none rounded-sm px-2 bg-white hover:bg-slate-300 focus:bg-slate-300 active:bg-slate-400 transition-colors"
                                        type="button" data-value="Bisa ke Luar Kota" onclick="selectBasisOperasi(this)">
                                        Bisa ke Luar Kota
                                    </button>
                                </div>
                            </div>

                            <div class="mt-1 text-sm text-red-500 flex items-center justify-start gap-2">
                                @error('basis_operasi')
                                    <i class="fa-solid fa-circle-info"></i>
                                    <span>{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        {{-- KOTA OPERASI --}}
                        <div class="relative w-100 mb-4 hidden" id="kotaOperasiContainer">
                            <div class="w-100">
                                <div class="w-full p-2 text-xs font-bold bg-pink @error('kota_operasi') bg-red-500 @enderror text-white flex items-center justify-start rounded-t">
                                    <i class="fa-solid fa-location-crosshairs"></i>
                                    <span class="ml-2">
                                        Kota Operasi
                                    </span>
                                </div>
                                <input class="w-full p-2 flex-1 border-x-2 border-b-2 text-sm @error('kota_operasi') border-red-500 @enderror rounded-b focus:border-pink focus:outline-none"
                                    type="text" name="kota_operasi" id="kota_operasi" placeholder="Badung"
                                    disabled
                                    value="{{ old('kota_operasi', auth()->user()->w_organizer ? auth()->user()->w_organizer->kota_operasi : '') }}">
                            </div>

                            <div class="mt-1 text-sm text-red-500 flex items-center justify-start gap-2">
                                @error('kota_operasi')
                                    <i class="fa-solid fa-circle-info"></i>
                                    <span>{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                {{-- KANAN --}}
                <div class="flex-1" id="formKanan">
                    {{-- PROVINSI --}}
                    <div class="relative w-100 mb-4">
                        <div class="w-100">
                            <div class="w-full p-2 text-xs font-bold bg-pink @error('provinsi') bg-red-500 @enderror text-white flex items-center justify-start rounded-t">
                                <i class="fa-solid fa-location-dot"></i>
                                <span class="ml-2">
                                    Provinsi
                                </span>
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
                                <i class="fa-solid fa-location-dot"></i>
                                <span class="ml-2">
                                    Kota/Kabupaten
                                </span>
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
                                <i class="fa-solid fa-location-dot"></i>
                                <span class="ml-2">
                                    Kecamatan
                                </span>
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
                                <i class="fa-solid fa-location-dot"></i>
                                <span class="ml-2">
                                    Kelurahan
                                </span>
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
                                <i class="fa-solid fa-location-dot"></i>
                                <span class="ml-2">
                                    Alamat Detail
                                </span>
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
                <a class="w-fit p-2 font-semibold outline-none text-pink bg-white hover:bg-pink hover:text-white focus:bg-pink focus:text-white active:bg-pink-active transition-colors rounded"
                    href="{{ route('wedding-organizer.profil.index') }}">
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
@endsection

@push('child-js')
    {{-- BASIS OPERASI SCRIPT --}}
    <script>
        function showBasisOperasiOptions() {
            $('#basisOperasiOptions').removeClass('hidden').addClass('flex');
        }

        function hideBasisOperasiOptions() {
            $('#basisOperasiOptions').removeClass('flex').addClass('hidden');
        }

        function changeBasisOperasiOptions() {
            const filterValue = $('#basis_operasi').val().toLowerCase();
            $('#basisOperasiOptions button').each(function() {
                const buttonFilter = $(this).data('value').toLowerCase();
                if (buttonFilter.includes(filterValue)) {
                    $(this).removeClass('hidden');
                } else {
                    $(this).addClass('hidden');
                }
            });
        }

        function selectBasisOperasi(button) {
            const dataValue = button.getAttribute('data-value');

            $('#basis_operasi').val(dataValue);
            hideBasisOperasiOptions();

            if (dataValue === 'Hanya di Dalam Kota') {
                $('#kota_operasi').prop('disabled', false).prop('required', true);
                $('#kotaOperasiContainer').removeClass('hidden');
            } else {
                $('#kota_operasi').prop('disabled', true).prop('required', false);
                $('#kotaOperasiContainer').addClass('hidden');
            }
        }
    </script>

    <script>
        window.onload = function() {
            // BASIS OPERASI
            if ($('#basis_operasi').val() === 'Hanya di Dalam Kota') {
                $('#kota_operasi').prop('disabled', false).prop('required', true);
                $('#kotaOperasiContainer').removeClass('hidden');
            } else {
                $('#kota_operasi').prop('disabled', true).prop('required', false);
                $('#kotaOperasiContainer').addClass('hidden');
            }
        }

        document.addEventListener('click', function(event) {
            const basisOperasiOptions = document.getElementById('basisOperasiOptions');

            const basisOperasiInput = document.getElementById('basis_operasi');

            if (!basisOperasiOptions.classList.contains('hidden') && event.target!== basisOperasiOptions && !basisOperasiOptions.contains(event.target) && event.target!== basisOperasiInput) {
                hideBasisOperasiOptions();
            }
        });
    </script>
@endpush
