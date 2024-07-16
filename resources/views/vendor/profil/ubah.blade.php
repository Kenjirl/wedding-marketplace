@extends('vendor.layout')

@section('title')
    <title>Ubah Profil | Wedding Marketplace</title>
@endsection

@section('h1', 'Profil > Ubah Profil')

@section('content')
    <div class="mb-4 flex items-center justify-end gap-2">
        <button class="w-[40px] aspect-square p-2 bg-pink text-white text-center rounded"
            type="button" id="infoBtn">
            <i class="fa-solid fa-circle-info"></i>
        </button>
    </div>

    <div class="w-full flex-1">
        <form action="{{ route('vendor.profil.ubah') }}" method="post" autocomplete="off">
            @csrf
            {{-- ATAS --}}
            <div class="w-full flex items-start justify-between gap-8">
                {{-- KIRI --}}
                <div class="w-[50%]" id="formKiri">
                    {{-- NAMA --}}
                    <div class="w-full mb-4">
                        <div class="w-full">
                            <div class="w-full p-2 text-xs font-bold bg-pink @error('nama') bg-red-500 @enderror text-white flex items-center justify-start rounded-t">
                                <i class="fa-solid fa-building-user"></i>
                                <span class="ml-2">
                                    Nama
                                </span>
                            </div>
                            <input class="w-full p-2 flex-1 border-x-2 border-b-2 text-sm @error('nama') border-red-500 @enderror rounded-b focus:border-pink focus:outline-none"
                                type="text" name="nama" id="nama" placeholder="nama pribadi atau perusahaan"
                                required
                                value="{{ old('nama', auth()->user()->w_vendor ? auth()->user()->w_vendor->nama : '') }}">
                        </div>

                        <div class="mt-1 text-sm text-red-500 flex items-center justify-start gap-2">
                            @error('nama')
                                <i class="fa-solid fa-circle-info"></i>
                                <span>{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    {{-- NAMA PENGGUNA & NO TELP CONTAINER --}}
                    <div class="grid grid-cols-2 gap-4">
                        {{-- NAMA PENGGUNA --}}
                        <div class="w-full mb-4">
                            <div class="w-full">
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
                        <div class="w-full mb-4">
                            <div class="w-full">
                                <div class="w-full p-2 text-xs font-bold bg-pink @error('no_telp') bg-red-500 @enderror text-white flex items-center justify-start rounded-t">
                                    <i class="fa-solid fa-phone"></i>
                                    <span class="ml-2">
                                        Telepon
                                    </span>
                                </div>
                                <input class="w-full p-2 flex-1 border-x-2 border-b-2 text-sm @error('no_telp') border-red-500 @enderror rounded-b focus:border-pink focus:outline-none"
                                    type="number" name="no_telp" id="no_telp" placeholder="081234567890" min="0"
                                    required
                                    value="{{ old('no_telp', auth()->user()->w_vendor ? auth()->user()->w_vendor->no_telp : '') }}">
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
                        <div class="relative w-full mb-4">
                            <div class="w-full">
                                <div class="w-full p-2 text-xs font-bold bg-pink @error('basis_operasi') bg-red-500 @enderror text-white flex items-center justify-start rounded-t">
                                    <i class="fa-regular fa-circle-dot"></i>
                                    <span class="ml-2">
                                        Basis Operasi
                                    </span>
                                </div>
                                <select class="w-full p-2 flex-1 border-x-2 border-b-2 text-sm @error('gender') border-red-500 @enderror rounded-b focus:border-pink outline-none"
                                    name="basis_operasi" id="basis_operasi" required>
                                    <option value="" selected>Pilih Basis Operasi</option>
                                    <option value="Hanya di Dalam Kota" {{ old('basis_operasi', auth()->user()->w_vendor ? auth()->user()->w_vendor->basis_operasi : '') == 'Hanya di Dalam Kota' ? 'selected' : '' }}>
                                        Hanya di Dalam Kota
                                    </option>
                                    <option value="Bisa ke Luar Kota" {{ old('basis_operasi', auth()->user()->w_vendor ? auth()->user()->w_vendor->basis_operasi : '') == 'Bisa ke Luar Kota' ? 'selected' : '' }}>
                                        Bisa ke Luar Kota
                                    </option>
                                </select>
                            </div>

                            <div class="mt-1 text-sm text-red-500 flex items-center justify-start gap-2">
                                @error('basis_operasi')
                                    <i class="fa-solid fa-circle-info"></i>
                                    <span>{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        {{-- KOTA OPERASI --}}
                        <div class="relative w-full mb-4 hidden" id="kotaOperasiContainer">
                            <div class="w-full">
                                <div class="w-full p-2 text-xs font-bold bg-pink @error('kota_operasi') bg-red-500 @enderror text-white flex items-center justify-start rounded-t">
                                    <i class="fa-solid fa-location-crosshairs"></i>
                                    <span class="ml-2">
                                        Kota Operasi
                                    </span>
                                </div>
                                <input class="w-full p-2 flex-1 border-x-2 border-b-2 text-sm @error('kota_operasi') border-red-500 @enderror rounded-b outline-none"
                                    type="text" name="kota_operasi" id="kota_operasi" placeholder="Mengikuti Kota/Kabupaten Perusahaan"
                                    disabled readonly
                                    value="{{ old('kota_operasi', auth()->user()->w_vendor && auth()->user()->w_vendor->kota_operasi ? $kota : '') }}">
                            </div>

                            <div class="mt-1 text-sm text-red-500 flex items-center justify-start gap-2">
                                @error('kota_operasi')
                                    <i class="fa-solid fa-circle-info"></i>
                                    <span>{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    {{-- REKENING CONTAINER --}}
                    <div class="w-full mb-4" id="rekeningContainer">
                        <div class="w-full">
                            <div class="w-full p-2 text-xs font-bold bg-pink @error('rekening') bg-red-500 @enderror text-white flex items-center justify-start rounded-t">
                                <i class="fa-solid fa-credit-card"></i>
                                <span class="ml-2">Rekening</span>
                            </div>
                            <div class="w-full p-2 border-x-2 border-b-2 text-sm @error('rekening') border-red-500 @enderror rounded-b outline-none">
                                @php
                                    // JENIS REKENING
                                    $banks = ['BRI', 'BNI', 'BCA', 'Mandiri'];
                                @endphp
                                @foreach($banks as $bank)
                                    @php
                                        // OLD VALUE REKENING
                                        $oldRekening = old('rekening');
                                        $rekeningData = null;

                                        if (is_array($oldRekening) && isset($oldRekening[$bank])) {
                                            $rekeningData = ['jenis' => $bank, 'nomor' => $oldRekening[$bank]];
                                        } elseif (auth()->user()->w_vendor && auth()->user()->w_vendor->rekening) {
                                            $rekeningData = collect(auth()->user()->w_vendor->rekening)->where('jenis', $bank)->first();
                                        }

                                        $rekeningValue = $rekeningData ? $rekeningData['nomor'] : '';
                                    @endphp
                                    <div class="w-full mb-2 flex rounded">
                                        <span class="w-1/4 py-1 px-4 border border-slate-300 rounded-s-lg bg-slate-300 font-semibold">{{ $bank }}</span>
                                        <input class="w-3/4 p-1 px-2 border border-slate-300 outline-none focus:border-pink
                                            rekening-input"
                                            type="number" name="rekening[{{ $bank }}]" id="rekening_{{ $bank }}" value="{{ $rekeningValue }}"
                                            min="0" placeholder="0123456789" required>
                                    </div>
                                @endforeach
                                <div class="text-end">
                                    <span class="text-sm italic text-slate-400">*minimal harus memiliki 1 nomor rekening</span>
                                </div>
                            </div>
                        </div>

                        <div class="mt-1 text-sm text-red-500 flex items-center justify-start gap-2">
                            @error('rekening')
                                <i class="fa-solid fa-circle-info"></i>
                                <span>{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- KANAN --}}
                <div class="flex-1" id="formKanan">
                    {{-- PROVINSI --}}
                    <div class="relative w-full mb-4">
                        <div class="w-full">
                            <div class="w-full p-2 text-xs font-bold bg-pink @error('provinsi') bg-red-500 @enderror text-white flex items-center justify-start rounded-t">
                                <i class="fa-solid fa-location-dot"></i>
                                <span class="ml-2">
                                    Provinsi
                                </span>
                            </div>
                            <select class="w-full p-2 flex-1 border-x-2 border-b-2 text-sm @error('provinsi') border-red-500 @enderror rounded-b focus:border-pink outline-none"
                                name="provinsi" id="provinsi" required>
                                <option value="" selected>Pilih Provinsi</option>
                                @forelse ($provinsiData as $provinsiItem)
                                    <option value="{{ $provinsiItem->name }}" {{ $provinsiItem->name == $provinsi ? 'selected' : '' }}>
                                        {{ $provinsiItem->name }}
                                    </option>
                                @empty

                                @endforelse
                            </select>
                        </div>

                        <div class="mt-1 text-sm text-red-500 flex items-center justify-start gap-2">
                            @error('provinsi')
                                <i class="fa-solid fa-circle-info"></i>
                                <span>{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    {{-- KOTA --}}
                    <div class="relative w-full mb-4">
                        <div class="w-full">
                            <div class="w-full p-2 text-xs font-bold bg-pink @error('kota') bg-red-500 @enderror text-white flex items-center justify-start rounded-t">
                                <i class="fa-solid fa-location-dot"></i>
                                <span class="ml-2">
                                    Kota/Kabupaten
                                </span>
                            </div>
                            <select class="w-full p-2 flex-1 border-x-2 border-b-2 text-sm @error('kota') border-red-500 @enderror rounded-b focus:border-pink outline-none"
                                name="kota" id="kota" required>
                                <option value="" selected>Pilih Kota/Kabupaten</option>
                                @forelse ($filteredKotaData as $kotaItem)
                                    <option value="{{ $kotaItem->name }}" {{ $kotaItem->name == $kota ? 'selected' : '' }}>
                                        {{ $kotaItem->name }}
                                    </option>
                                @empty

                                @endforelse
                            </select>
                        </div>

                        <div class="mt-1 text-sm text-red-500 flex items-center justify-start gap-2">
                            @error('kota')
                                <i class="fa-solid fa-circle-info"></i>
                                <span>{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    {{-- KECAMATAN --}}
                    <div class="relative w-full mb-4">
                        <div class="w-full">
                            <div class="w-full p-2 text-xs font-bold bg-pink @error('kecamatan') bg-red-500 @enderror text-white flex items-center justify-start rounded-t">
                                <i class="fa-solid fa-location-dot"></i>
                                <span class="ml-2">
                                    Kecamatan
                                </span>
                            </div>
                            <select class="w-full p-2 flex-1 border-x-2 border-b-2 text-sm @error('kecamatan') border-red-500 @enderror rounded-b focus:border-pink outline-none"
                                name="kecamatan" id="kecamatan" required>
                                <option value="" selected>Pilih Kecamatan</option>
                                @forelse ($filteredKecamatanData as $kecamatanItem)
                                    <option value="{{ $kecamatanItem->name }}" {{ $kecamatanItem->name == $kecamatan ? 'selected' : '' }}>
                                        {{ $kecamatanItem->name }}
                                    </option>
                                @empty

                                @endforelse
                            </select>
                        </div>

                        <div class="mt-1 text-sm text-red-500 flex items-center justify-start gap-2">
                            @error('kecamatan')
                                <i class="fa-solid fa-circle-info"></i>
                                <span>{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    {{-- KELURAHAN --}}
                    <div class="relative w-full mb-4">
                        <div class="w-full">
                            <div class="w-full p-2 text-xs font-bold bg-pink @error('kelurahan') bg-red-500 @enderror text-white flex items-center justify-start rounded-t">
                                <i class="fa-solid fa-location-dot"></i>
                                <span class="ml-2">
                                    Kelurahan
                                </span>
                            </div>
                            <select class="w-full p-2 flex-1 border-x-2 border-b-2 text-sm @error('kelurahan') border-red-500 @enderror rounded-b focus:border-pink outline-none"
                                name="kelurahan" id="kelurahan" required>
                                <option value="" selected>Pilih Kelurahan</option>
                                @forelse ($filteredKelurahanData as $kelurahanItem)
                                    <option value="{{ $kelurahanItem->name }}" {{ $kelurahanItem->name == $kelurahan ? 'selected' : '' }}>
                                        {{ $kelurahanItem->name }}
                                    </option>
                                @empty

                                @endforelse
                            </select>
                        </div>

                        <div class="mt-1 text-sm text-red-500 flex items-center justify-start gap-2">
                            @error('kelurahan')
                                <i class="fa-solid fa-circle-info"></i>
                                <span>{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    {{-- ALAMAT --}}
                    <div class="relative w-full mb-4">
                        <div class="w-full">
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
            <div class="w-full mt-4 flex items-center justify-end gap-4">
                <a class="w-fit px-4 py-2 font-semibold outline-none text-pink bg-white hover:bg-pink hover:text-white focus:bg-pink focus:text-white active:bg-pink-active transition-colors rounded"
                    href="{{ route('vendor.profil.index') }}">
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
    <script>
        // BASIS OPERASI SCRIPT
        $('#basis_operasi').change(function () {
            if ($(this).val() === 'Hanya di Dalam Kota') {
                $('#kota_operasi').prop('disabled', false).prop('required', true).val($('#kota').val());
                $('#kotaOperasiContainer').removeClass('hidden');
            } else {
                $('#kota_operasi').prop('disabled', true).prop('required', false).val('');
                $('#kotaOperasiContainer').addClass('hidden');
            }
        });

        // KOTA OPERASI SCRIPT
        $('#kota').change(function () {
            $('#kota_operasi').val($(this).val());
        });
    </script>

    <script>
        window.onload = function() {
            // BASIS OPERASI
            if ($('#basis_operasi').val() === 'Hanya di Dalam Kota') {
                $('#kota_operasi').prop({ disabled: false, required: true });
                $('#kotaOperasiContainer').removeClass('hidden');
            } else {
                $('#kota_operasi').prop({ disabled: true, required: false });
                $('#kotaOperasiContainer').addClass('hidden');
            }

            $('#infoBtn').on("click", function () {
                Swal.fire({
                    title: "Info",
                    icon: "info",
                    iconColor: "#F78CA2",
                    html: `
                        <p class="text-justify text-sm">
                            1. Silahkan isi data diri Anda <br>
                            2. Harap memilih data sesuai dengan pilihan yang sudah disediakan <br>
                            3. Harap untuk tidak menggunakan tanda baca apapun kecuali pada Nama Pengguna <br>
                        </p>
                    `,
                    showCloseButton: true,
                    confirmButtonColor: "#F78CA2",
                    confirmButtonText: "OK"
                }).then((result) => {
                    return;
                });
            });
        }
    </script>

    <script>
        // REKENING INPUT SCRIPT
        document.addEventListener('DOMContentLoaded', function() {
            const rekeningInputs = document.querySelectorAll('.rekening-input');

            function checkRequired() {
                let hasValue = false;

                rekeningInputs.forEach(input => {
                    if (input.value.trim() !== '') {
                        hasValue = true;
                    }
                });

                rekeningInputs.forEach(input => {
                    if (hasValue) {
                        input.removeAttribute('required');
                    } else {
                        input.setAttribute('required', 'required');
                    }
                });
            }

            rekeningInputs.forEach(input => {
                input.addEventListener('input', checkRequired);
            });

            checkRequired();
        });

    </script>

    @if(App::environment('local'))
        <script src="{{ asset('js/input-select-wilayah.js') }}"></script>
    @else
        <script src="https://pro-malamute-vastly.ngrok-free.app/js/input-select-wilayah.js"></script>
    @endif
@endpush
