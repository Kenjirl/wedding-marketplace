@extends('user.wedding-photographer.layout')

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
        <form action="{{ route('wedding-photographer.profil.ubah') }}" method="post" autocomplete="off">
            @csrf
            {{-- ATAS --}}
            <div class="w-100 flex items-start justify-between gap-8">
                {{-- KIRI --}}
                <div class="w-[50%]" id="formKiri">
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
                                value="{{ old('nama', auth()->user()->w_photographer ? auth()->user()->w_photographer->nama : '') }}">
                        </div>

                        <div class="mt-1 text-sm text-red-500 flex items-center justify-start gap-2">
                            @error('nama')
                                <i class="fa-solid fa-circle-info"></i>
                                <span>{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

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
                                    value="{{ old('no_telp', auth()->user()->w_photographer ? auth()->user()->w_photographer->no_telp : '') }}">
                            </div>

                            <div class="mt-1 text-sm text-red-500 flex items-center justify-start gap-2">
                                @error('no_telp')
                                    <i class="fa-solid fa-circle-info"></i>
                                    <span>{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        {{-- STATUS --}}
                        <div class="relative w-100 mb-4">
                            <div class="w-100">
                                <div class="w-full p-2 text-xs font-bold bg-pink @error('status') bg-red-500 @enderror text-white flex items-center justify-start rounded-t">
                                    <i class="fa-solid fa-briefcase"></i>
                                    <span class="ml-2">
                                        Status
                                    </span>
                                </div>
                                <select class="w-full p-2 flex-1 border-x-2 border-b-2 text-sm @error('status') border-red-500 @enderror rounded-b focus:border-pink outline-none"
                                    name="status" id="status" required>
                                    <option value="" selected>Pilih Status</option>
                                    <option value="Individu" {{ old('status', auth()->user()->w_photographer ? auth()->user()->w_photographer->status : '') == 'Individu' ? 'selected' : '' }}>
                                        Individu
                                    </option>
                                    <option value="Organisasi" {{ old('status', auth()->user()->w_photographer ? auth()->user()->w_photographer->status : '') == 'Organisasi' ? 'selected' : '' }}>
                                        Organisasi
                                    </option>
                                </select>
                            </div>

                            <div class="mt-1 text-sm text-red-500 flex items-center justify-start gap-2">
                                @error('status')
                                    <i class="fa-solid fa-circle-info"></i>
                                    <span>{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        {{-- GENDER --}}
                        <div class="relative hidden w-100 mb-4" id="genderContainer">
                            <div class="w-100">
                                <div class="w-full p-2 text-xs font-bold bg-pink @error('gender') bg-red-500 @enderror text-white flex items-center justify-start rounded-t">
                                    <i class="fa-solid fa-venus-mars"></i>
                                    <span class="ml-2">
                                        Gender
                                    </span>
                                </div>

                                <select class="w-full p-2 flex-1 border-x-2 border-b-2 text-sm @error('gender') border-red-500 @enderror rounded-b focus:border-pink outline-none"
                                    name="gender" id="gender">
                                    <option value="" selected>Pilih Gender</option>
                                    <option value="Pria" {{ old('gender',  auth()->user()->w_photographer && auth()->user()->w_photographer->gender) == 'Pria' ? 'selected' : '' }}>
                                        Pria
                                    </option>
                                    <option value="Wanita" {{ old('gender',  auth()->user()->w_photographer && auth()->user()->w_photographer->gender) == 'Wanita' ? 'selected' : '' }}>
                                        Wanita
                                    </option>
                                </select>
                            </div>

                            <div class="mt-1 text-sm text-red-500 flex items-center justify-start gap-2">
                                @error('gender')
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
                                <select class="w-full p-2 flex-1 border-x-2 border-b-2 text-sm @error('basis_operasi') border-red-500 @enderror rounded-b focus:border-pink outline-none"
                                    name="basis_operasi" id="basis_operasi" required>
                                    <option value="" selected>Pilih Basis Operasi</option>
                                    <option value="Hanya di Dalam Kota" {{ old('basis_operasi', auth()->user()->w_photographer ? auth()->user()->w_photographer->basis_operasi : '') == 'Hanya di Dalam Kota' ? 'selected' : '' }}>
                                        Hanya di Dalam Kota
                                    </option>
                                    <option value="Bisa ke Luar Kota" {{ old('basis_operasi', auth()->user()->w_photographer ? auth()->user()->w_photographer->basis_operasi : '') == 'Bisa ke Luar Kota' ? 'selected' : '' }}>
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
                        <div class="relative w-100 mb-4 hidden" id="kotaOperasiContainer">
                            <div class="w-100">
                                <div class="w-full p-2 text-xs font-bold bg-pink @error('kota_operasi') bg-red-500 @enderror text-white flex items-center justify-start rounded-t">
                                    <i class="fa-solid fa-location-crosshairs"></i>
                                    <span class="ml-2">
                                        Kota Operasi
                                    </span>
                                </div>
                                <select class="w-full p-2 flex-1 border-x-2 border-b-2 text-sm @error('kota_operasi') border-red-500 @enderror rounded-b focus:border-pink outline-none"
                                    name="kota_operasi" id="kota_operasi">
                                    <option value="" selected>Pilih Kota/Kabupaten</option>
                                    @forelse ($sortedKotaData as $sortedKotaItem)
                                        <option value="{{ $sortedKotaItem->name }}" {{ $sortedKotaItem->name == old('kota_operasi', auth()->user()->w_photographer && auth()->user()->w_photographer->kota_operasi ? auth()->user()->w_photographer->kota_operasi : '') ? 'selected' : '' }}>
                                            {{ $sortedKotaItem->name }}
                                        </option>
                                    @empty

                                    @endforelse
                                </select>
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
                    <div class="grid grid-cols-2 gap-4">
                        {{-- JENIS REKENING --}}
                        <div class="relative w-100 mb-4">
                            <div class="w-100">
                                <div class="w-full p-2 text-xs font-bold bg-pink @error('jenis_rekening') bg-red-500 @enderror text-white flex items-center justify-start rounded-t">
                                    <i class="fa-solid fa-building-columns"></i>
                                    <span class="ml-2">
                                        Jenis Rekening
                                    </span>
                                </div>
                                <select class="w-full p-2 flex-1 border-x-2 border-b-2 text-sm @error('jenis_rekening') border-red-500 @enderror rounded-b focus:border-pink outline-none"
                                    name="jenis_rekening" id="jenis_rekening" required>
                                    <option value="" selected>Pilih Jenis Rekening</option>
                                    <option value="BCA" {{ old('jenis_rekening', auth()->user()->w_photographer ? auth()->user()->w_photographer->jenis_rekening : '') == 'BCA' ? 'selected' : '' }}>
                                        Bank BCA
                                    </option>
                                    <option value="BNI" {{ old('jenis_rekening', auth()->user()->w_photographer ? auth()->user()->w_photographer->jenis_rekening : '') == 'BNI' ? 'selected' : '' }}>
                                        Bank BNI
                                    </option>
                                    <option value="BRI" {{ old('jenis_rekening', auth()->user()->w_photographer ? auth()->user()->w_photographer->jenis_rekening : '') == 'BRI' ? 'selected' : '' }}>
                                        Bank BRI
                                    </option>
                                    <option value="Mandiri" {{ old('jenis_rekening', auth()->user()->w_photographer ? auth()->user()->w_photographer->jenis_rekening : '') == 'Mandiri' ? 'selected' : '' }}>
                                        Bank Mandiri
                                    </option>
                                </select>
                            </div>

                            <div class="mt-1 text-sm text-red-500 flex items-center justify-start gap-2">
                                @error('jenis_rekening')
                                    <i class="fa-solid fa-circle-info"></i>
                                    <span>{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        {{-- NOMOR REKENING --}}
                        <div class="relative w-100 mb-4">
                            <div class="w-100">
                                <div class="w-full p-2 text-xs font-bold bg-pink @error('no_rekening') bg-red-500 @enderror text-white flex items-center justify-start rounded-t">
                                    <i class="fa-solid fa-money-check"></i>
                                    <span class="ml-2">
                                        Nomor Rekening
                                    </span>
                                </div>
                                <input class="w-full p-2 flex-1 border-x-2 border-b-2 text-sm @error('no_rekening') border-red-500 @enderror rounded-b focus:border-pink focus:outline-none"
                                    type="number" name="no_rekening" id="no_rekening" placeholder="tanpa tanda baca" min="0" minlength="10"
                                    required
                                    value="{{ old('no_rekening', auth()->user()->w_photographer ? auth()->user()->w_photographer->no_rekening : '') }}">
                            </div>

                            <div class="mt-1 text-sm text-red-500 flex items-center justify-start gap-2">
                                @error('no_rekening')
                                    <i class="fa-solid fa-circle-info"></i>
                                    <span>{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                {{-- KANAN --}}
                <div class="hidden flex-1" id="formKanan">
                    {{-- PROVINSI --}}
                    <div class="relative w-100 mb-4">
                        <div class="w-100">
                            <div class="w-full p-2 text-xs font-bold bg-pink @error('provinsi') bg-red-500 @enderror text-white flex items-center justify-start rounded-t">
                                <i class="fa-solid fa-location-dot"></i>
                                <span class="ml-2">
                                    Provinsi
                                </span>
                            </div>
                            <select class="w-full p-2 flex-1 border-x-2 border-b-2 text-sm @error('provinsi') border-red-500 @enderror rounded-b focus:border-pink outline-none"
                                name="provinsi" id="provinsi">
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
                    <div class="relative w-100 mb-4">
                        <div class="w-100">
                            <div class="w-full p-2 text-xs font-bold bg-pink @error('kota') bg-red-500 @enderror text-white flex items-center justify-start rounded-t">
                                <i class="fa-solid fa-location-dot"></i>
                                <span class="ml-2">
                                    Kota/Kabupaten
                                </span>
                            </div>
                            <select class="w-full p-2 flex-1 border-x-2 border-b-2 text-sm @error('kota') border-red-500 @enderror rounded-b focus:border-pink outline-none"
                                name="kota" id="kota">
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
                    <div class="relative w-100 mb-4">
                        <div class="w-100">
                            <div class="w-full p-2 text-xs font-bold bg-pink @error('kecamatan') bg-red-500 @enderror text-white flex items-center justify-start rounded-t">
                                <i class="fa-solid fa-location-dot"></i>
                                <span class="ml-2">
                                    Kecamatan
                                </span>
                            </div>
                            <select class="w-full p-2 flex-1 border-x-2 border-b-2 text-sm @error('kecamatan') border-red-500 @enderror rounded-b focus:border-pink outline-none"
                                name="kecamatan" id="kecamatan">
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
                    <div class="relative w-100 mb-4">
                        <div class="w-100">
                            <div class="w-full p-2 text-xs font-bold bg-pink @error('kelurahan') bg-red-500 @enderror text-white flex items-center justify-start rounded-t">
                                <i class="fa-solid fa-location-dot"></i>
                                <span class="ml-2">
                                    Kelurahan
                                </span>
                            </div>
                            <select class="w-full p-2 flex-1 border-x-2 border-b-2 text-sm @error('kelurahan') border-red-500 @enderror rounded-b focus:border-pink outline-none"
                                name="kelurahan" id="kelurahan">
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
                                disabled
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
                    href="{{ route('wedding-photographer.profil.index') }}">
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
        $('#basis_operasi').change(function () {
            if ($(this).val() === 'Hanya di Dalam Kota') {
                $('#kota_operasi').prop('disabled', false).prop('required', true).val($('#kota').val());
                $('#kotaOperasiContainer').removeClass('hidden');
            } else {
                $('#kota_operasi').prop('disabled', true).prop('required', false).val('');
                $('#kotaOperasiContainer').addClass('hidden');
            }
        });
    </script>

    {{-- STATUS SCRIPT --}}
    <script>
        $('#status').change(function () {
            console.log($(this).val());
            if ($(this).val() === 'Organisasi') {
                $('#provinsi').prop({ required: true, disabled: false });
                $('#kota').prop({ required: true, disabled: false });
                $('#kecamatan').prop({ required: true, disabled: false });
                $('#kelurahan').prop({ required: true, disabled: false });
                $('#alamat_detail').prop({ required: true, disabled: false });

                $('#formKiri').removeClass('w-[50%]').addClass('flex-1');
                $('#formKanan').removeClass('hidden');

                $('#gender').prop({ disabled: true, required: false });
                $('#genderContainer').addClass('hidden');
            } else if ($(this).val() === 'Individu') {
                $('#provinsi').prop({ required: false, disabled: true });
                $('#kota').prop({ required: false, disabled: true });
                $('#kecamatan').prop({ required: false, disabled: true });
                $('#kelurahan').prop({ required: false, disabled: true });
                $('#alamat_detail').prop({ required: false, disabled: true });

                $('#formKiri').removeClass('flex-1').addClass('w-[50%]');
                $('#formKanan').addClass('hidden');

                $('#gender').prop({ disabled: false, required: true });
                $('#genderContainer').removeClass('hidden');
            } else {
                $('#provinsi').prop({ required: false, disabled: true });
                $('#kota').prop({ required: false, disabled: true });
                $('#kecamatan').prop({ required: false, disabled: true });
                $('#kelurahan').prop({ required: false, disabled: true });
                $('#alamat_detail').prop({ required: false, disabled: true });

                $('#formKiri').removeClass('flex-1').addClass('w-[50%]');
                $('#formKanan').addClass('hidden');

                $('#gender').prop({ disabled: true, required: false });
                $('#genderContainer').addClass('hidden');
            }
        });
    </script>

    <script>
        window.onload = function() {
            // STATUS
            if ($('#status').val() === 'Individu') {
                $('#provinsi').prop({ required: false, disabled: true });
                $('#kota').prop({ required: false, disabled: true });
                $('#kecamatan').prop({ required: false, disabled: true });
                $('#kelurahan').prop({ required: false, disabled: true });
                $('#alamat_detail').prop({ required: false, disabled: true });

                $('#formKiri').removeClass('flex-1').addClass('w-[50%]');
                $('#formKanan').addClass('hidden');

                $('#gender').prop({ disabled: false, required: true });
                $('#genderContainer').removeClass('hidden');
            } else if ($('#status').val() === 'Organisasi') {
                $('#provinsi').prop({ required: true, disabled: false });
                $('#kota').prop({ required: true, disabled: false });
                $('#kecamatan').prop({ required: true, disabled: false });
                $('#kelurahan').prop({ required: true, disabled: false });
                $('#alamat_detail').prop({ required: true, disabled: false });

                $('#formKiri').removeClass('w-[50%]').addClass('flex-1');
                $('#formKanan').removeClass('hidden');

                $('#gender').prop({ disabled: true, required: false });
                $('#genderContainer').addClass('hidden');
            }

            // BASIS OPERASI
            if ($('#basis_operasi').val() === 'Hanya di Dalam Kota') {
                $('#kota_operasi').prop({ disabled: false, required: true });
                $('#kotaOperasiContainer').removeClass('hidden');
            } else {
                $('#kota_operasi').prop({ disabled: true, required: false });
                $('#kotaOperasiContainer').addClass('hidden');
            }
        }
    </script>

    <script src="{{ asset('js/input-select-wilayah.js') }}"></script>
@endpush
