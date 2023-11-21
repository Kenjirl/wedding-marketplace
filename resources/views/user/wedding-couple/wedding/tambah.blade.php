@extends('user.wedding-couple.layout')

@section('title')
    <title>Buat Pernikahan | Wedding Marketplace</title>
@endsection

@section('content')
    <div class="w-full max-w-[1200px] mx-auto p-4">
        {{-- TITLE --}}
        <div class="w-full mb-4">
            <p class="w-full text-center">
                Buat Pernikahan
            </p>
        </div>

        <div class="w-full">
            <form action="{{ route('wedding-couple.pernikahan.tambah') }}" method="post">
                @csrf
                <div class="w-full flex items-start justify-between gap-4">
                    <div class="flex-1 w-full">
                        {{-- GROOM --}}
                        <div class="w-100 mb-4">
                            <div class="w-100">
                                <div class="w-full p-2 text-xs font-bold bg-pink @error('groom') bg-red-500 @enderror text-white flex items-center justify-start rounded-t">
                                    <i class="fa-solid fa-mars"></i>
                                    <span class="ml-2">
                                        Pengantin Pria
                                    </span>
                                </div>
                                <input class="w-full p-2 flex-1 border-x-2 border-b-2 text-sm @error('groom') border-red-500 @enderror rounded-b focus:border-pink focus:outline-none"
                                    type="text" name="groom" id="groom" placeholder="Nama Pengantin Pria (tanpa gelar)"
                                    required
                                    value="{{ old('groom', '') }}">
                            </div>

                            <div class="mt-1 text-sm text-red-500 flex items-center justify-start gap-2">
                                @error('groom')
                                    <i class="fa-solid fa-circle-info"></i>
                                    <span>{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="w-full">
                            {{-- PEMBERKATAN --}}
                            <div class="w-full p-2 bg-slate-200 text-center rounded-t-lg border-2 border-slate-200 border-b-0">
                                <span class="text-sm">
                                    Tempat & Tanggal Pemberkatan
                                </span>
                            </div>

                            <div class="w-full p-2 rounded-b-lg border-2 border-slate-200 border-t-0">
                                {{-- TANGGAL --}}
                                <div class="w-100 mb-4">
                                    <div class="w-100">
                                        <div class="w-full p-2 text-xs font-bold bg-pink @error('waktu_pemberkatan') bg-red-500 @enderror text-white flex items-center justify-start rounded-t">
                                            <i class="fa-regular fa-calendar"></i>
                                            <span class="ml-2">
                                                Waktu Pemberkatan
                                            </span>
                                        </div>
                                        <input class="w-full p-2 flex-1 border-x-2 border-b-2 text-sm @error('waktu_pemberkatan') border-red-500 @enderror rounded-b focus:border-pink focus:outline-none"
                                            type="datetime-local" name="waktu_pemberkatan" id="waktu_pemberkatan"
                                            required
                                            value="{{ old('waktu_pemberkatan', '') }}">
                                    </div>

                                    <div class="mt-1 text-sm text-red-500 flex items-center justify-start gap-2">
                                        @error('waktu_pemberkatan')
                                            <i class="fa-solid fa-circle-info"></i>
                                            <span>{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="grid grid-cols-2 gap-4">
                                    {{-- PROVINSI --}}
                                    <div class="relative w-100">
                                        <div class="w-100">
                                            <div class="w-full p-2 text-xs font-bold bg-pink @error('provinsi_pemberkatan') bg-red-500 @enderror text-white flex items-center justify-start rounded-t">
                                                <i class="fa-solid fa-location-dot"></i>
                                                <span class="ml-2">
                                                    Provinsi
                                                </span>
                                            </div>
                                            <input class="w-full p-2 flex-1 border-x-2 border-b-2 text-sm @error('provinsi_pemberkatan') border-red-500 @enderror rounded-b focus:border-pink focus:outline-none"
                                                type="text" name="provinsi_pemberkatan" id="provinsi_pemberkatan" placeholder="Bali"
                                                required
                                                value="{{ old('provinsi_pemberkatan', '') }}">
                                        </div>

                                        <div class="mt-1 text-sm text-red-500 flex items-center justify-start gap-2">
                                            @error('provinsi_pemberkatan')
                                                <i class="fa-solid fa-circle-info"></i>
                                                <span>{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- KOTA --}}
                                    <div class="relative w-100">
                                        <div class="w-100">
                                            <div class="w-full p-2 text-xs font-bold bg-pink @error('kota_pemberkatan') bg-red-500 @enderror text-white flex items-center justify-start rounded-t">
                                                <i class="fa-solid fa-location-dot"></i>
                                                <span class="ml-2">
                                                    Kota/Kabupaten
                                                </span>
                                            </div>
                                            <input class="w-full p-2 flex-1 border-x-2 border-b-2 text-sm @error('kota_pemberkatan') border-red-500 @enderror rounded-b focus:border-pink focus:outline-none"
                                                type="text" name="kota_pemberkatan" id="kota_pemberkatan" placeholder="Badung"
                                                required
                                                value="{{ old('kota_pemberkatan', '') }}">
                                        </div>

                                        <div class="mt-1 text-sm text-red-500 flex items-center justify-start gap-2">
                                            @error('kota_pemberkatan')
                                                <i class="fa-solid fa-circle-info"></i>
                                                <span>{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- KECAMATAN --}}
                                    <div class="relative w-100">
                                        <div class="w-100">
                                            <div class="w-full p-2 text-xs font-bold bg-pink @error('kecamatan_pemberkatan') bg-red-500 @enderror text-white flex items-center justify-start rounded-t">
                                                <i class="fa-solid fa-location-dot"></i>
                                                <span class="ml-2">
                                                    Kecamatan
                                                </span>
                                            </div>
                                            <input class="w-full p-2 flex-1 border-x-2 border-b-2 text-sm @error('kecamatan_pemberkatan') border-red-500 @enderror rounded-b focus:border-pink focus:outline-none"
                                                type="text" name="kecamatan_pemberkatan" id="kecamatan_pemberkatan" placeholder="Kuta Selatan"
                                                required
                                                value="{{ old('kecamatan_pemberkatan', '') }}">
                                        </div>

                                        <div class="mt-1 text-sm text-red-500 flex items-center justify-start gap-2">
                                            @error('kecamatan_pemberkatan')
                                                <i class="fa-solid fa-circle-info"></i>
                                                <span>{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- KELURAHAN --}}
                                    <div class="relative w-100">
                                        <div class="w-100">
                                            <div class="w-full p-2 text-xs font-bold bg-pink @error('kelurahan_pemberkatan') bg-red-500 @enderror text-white flex items-center justify-start rounded-t">
                                                <i class="fa-solid fa-location-dot"></i>
                                                <span class="ml-2">
                                                    Kelurahan
                                                </span>
                                            </div>
                                            <input class="w-full p-2 flex-1 border-x-2 border-b-2 text-sm @error('kelurahan_pemberkatan') border-red-500 @enderror rounded-b focus:border-pink focus:outline-none"
                                                type="text" name="kelurahan_pemberkatan" id="kelurahan_pemberkatan" placeholder="Jimbaran"
                                                required
                                                value="{{ old('kelurahan_pemberkatan', '') }}">
                                        </div>

                                        <div class="mt-1 text-sm text-red-500 flex items-center justify-start gap-2">
                                            @error('kelurahan_pemberkatan')
                                                <i class="fa-solid fa-circle-info"></i>
                                                <span>{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- ALAMAT --}}
                                    <div class="relative w-100 col-span-2">
                                        <div class="w-100">
                                            <div class="w-full p-2 text-xs font-bold bg-pink @error('alamat_pemberkatan') bg-red-500 @enderror text-white flex items-center justify-start rounded-t">
                                                <i class="fa-solid fa-location-dot"></i>
                                                <span class="ml-2">
                                                    Alamat Detail
                                                </span>
                                            </div>
                                            <input class="w-full p-2 flex-1 border-x-2 border-b-2 text-sm @error('alamat_pemberkatan') border-red-500 @enderror rounded-b focus:border-pink focus:outline-none"
                                                type="text" name="alamat_pemberkatan" id="alamat_pemberkatan" placeholder="Jl. Besar no. 1"
                                                required
                                                value="{{ old('alamat_pemberkatan', '') }}">
                                        </div>

                                        <div class="mt-1 text-sm text-red-500 flex items-center justify-start gap-2">
                                            @error('alamat_pemberkatan')
                                                <i class="fa-solid fa-circle-info"></i>
                                                <span>{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex-1 w-full">
                        {{-- BRIDE --}}
                        <div class="w-100 mb-4">
                            <div class="w-100">
                                <div class="w-full p-2 text-xs font-bold bg-pink @error('bride') bg-red-500 @enderror text-white flex items-center justify-start rounded-t">
                                    <i class="fa-solid fa-venus"></i>
                                    <span class="ml-2">
                                        Pengantin Wanita
                                    </span>
                                </div>
                                <input class="w-full p-2 flex-1 border-x-2 border-b-2 text-sm @error('bride') border-red-500 @enderror rounded-b focus:border-pink focus:outline-none"
                                    type="text" name="bride" id="bride" placeholder="Nama Pengantin Wanita (tanpa gelar)"
                                    required
                                    value="{{ old('bride', '') }}">
                            </div>

                            <div class="mt-1 text-sm text-red-500 flex items-center justify-start gap-2">
                                @error('bride')
                                    <i class="fa-solid fa-circle-info"></i>
                                    <span>{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="w-full">
                            {{-- PERAYAAN --}}
                            <div class="w-full p-2 bg-slate-200 text-center rounded-t-lg border-2 border-slate-200 border-b-0">
                                <span class="text-sm">
                                    Tempat & Tanggal Perayaan
                                </span>
                            </div>

                            <div class="w-full p-2 rounded-b-lg border-2 border-slate-200 border-t-0">
                                {{-- TANGGAL --}}
                                <div class="w-100 mb-4">
                                    <div class="w-100">
                                        <div class="w-full p-2 text-xs font-bold bg-pink @error('waktu_perayaan') bg-red-500 @enderror text-white flex items-center justify-start rounded-t">
                                            <i class="fa-regular fa-calendar"></i>
                                            <span class="ml-2">
                                                Waktu Perayaan
                                            </span>
                                        </div>
                                        <input class="w-full p-2 flex-1 border-x-2 border-b-2 text-sm @error('waktu_perayaan') border-red-500 @enderror rounded-b focus:border-pink focus:outline-none"
                                            type="datetime-local" name="waktu_perayaan" id="waktu_perayaan"
                                            required
                                            value="{{ old('waktu_perayaan', '') }}">
                                    </div>

                                    <div class="mt-1 text-sm text-red-500 flex items-center justify-start gap-2">
                                        @error('waktu_perayaan')
                                            <i class="fa-solid fa-circle-info"></i>
                                            <span>{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="grid grid-cols-2 gap-4">
                                    {{-- PROVINSI --}}
                                    <div class="relative w-100">
                                        <div class="w-100">
                                            <div class="w-full p-2 text-xs font-bold bg-pink @error('provinsi_perayaan') bg-red-500 @enderror text-white flex items-center justify-start rounded-t">
                                                <i class="fa-solid fa-location-dot"></i>
                                                <span class="ml-2">
                                                    Provinsi
                                                </span>
                                            </div>
                                            <input class="w-full p-2 flex-1 border-x-2 border-b-2 text-sm @error('provinsi_perayaan') border-red-500 @enderror rounded-b focus:border-pink focus:outline-none"
                                                type="text" name="provinsi_perayaan" id="provinsi_perayaan" placeholder="Bali"
                                                required
                                                value="{{ old('provinsi_perayaan', '') }}">
                                        </div>

                                        <div class="mt-1 text-sm text-red-500 flex items-center justify-start gap-2">
                                            @error('provinsi_perayaan')
                                                <i class="fa-solid fa-circle-info"></i>
                                                <span>{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- KOTA --}}
                                    <div class="relative w-100">
                                        <div class="w-100">
                                            <div class="w-full p-2 text-xs font-bold bg-pink @error('kota_perayaan') bg-red-500 @enderror text-white flex items-center justify-start rounded-t">
                                                <i class="fa-solid fa-location-dot"></i>
                                                <span class="ml-2">
                                                    Kota/Kabupaten
                                                </span>
                                            </div>
                                            <input class="w-full p-2 flex-1 border-x-2 border-b-2 text-sm @error('kota_perayaan') border-red-500 @enderror rounded-b focus:border-pink focus:outline-none"
                                                type="text" name="kota_perayaan" id="kota_perayaan" placeholder="Badung"
                                                required
                                                value="{{ old('kota_perayaan', '') }}">
                                        </div>

                                        <div class="mt-1 text-sm text-red-500 flex items-center justify-start gap-2">
                                            @error('kota_perayaan')
                                                <i class="fa-solid fa-circle-info"></i>
                                                <span>{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- KECAMATAN --}}
                                    <div class="relative w-100">
                                        <div class="w-100">
                                            <div class="w-full p-2 text-xs font-bold bg-pink @error('kecamatan_perayaan') bg-red-500 @enderror text-white flex items-center justify-start rounded-t">
                                                <i class="fa-solid fa-location-dot"></i>
                                                <span class="ml-2">
                                                    Kecamatan
                                                </span>
                                            </div>
                                            <input class="w-full p-2 flex-1 border-x-2 border-b-2 text-sm @error('kecamatan_perayaan') border-red-500 @enderror rounded-b focus:border-pink focus:outline-none"
                                                type="text" name="kecamatan_perayaan" id="kecamatan_perayaan" placeholder="Kuta Selatan"
                                                required
                                                value="{{ old('kecamatan_perayaan', '') }}">
                                        </div>

                                        <div class="mt-1 text-sm text-red-500 flex items-center justify-start gap-2">
                                            @error('kecamatan_perayaan')
                                                <i class="fa-solid fa-circle-info"></i>
                                                <span>{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- KELURAHAN --}}
                                    <div class="relative w-100">
                                        <div class="w-100">
                                            <div class="w-full p-2 text-xs font-bold bg-pink @error('kelurahan_perayaan') bg-red-500 @enderror text-white flex items-center justify-start rounded-t">
                                                <i class="fa-solid fa-location-dot"></i>
                                                <span class="ml-2">
                                                    Kelurahan
                                                </span>
                                            </div>
                                            <input class="w-full p-2 flex-1 border-x-2 border-b-2 text-sm @error('kelurahan_perayaan') border-red-500 @enderror rounded-b focus:border-pink focus:outline-none"
                                                type="text" name="kelurahan_perayaan" id="kelurahan_perayaan" placeholder="Jimbaran"
                                                required
                                                value="{{ old('kelurahan_perayaan', '') }}">
                                        </div>

                                        <div class="mt-1 text-sm text-red-500 flex items-center justify-start gap-2">
                                            @error('kelurahan_perayaan')
                                                <i class="fa-solid fa-circle-info"></i>
                                                <span>{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- ALAMAT --}}
                                    <div class="relative w-100 col-span-2">
                                        <div class="w-100">
                                            <div class="w-full p-2 text-xs font-bold bg-pink @error('alamat_perayaan') bg-red-500 @enderror text-white flex items-center justify-start rounded-t">
                                                <i class="fa-solid fa-location-dot"></i>
                                                <span class="ml-2">
                                                    Alamat Detail
                                                </span>
                                            </div>
                                            <input class="w-full p-2 flex-1 border-x-2 border-b-2 text-sm @error('alamat_perayaan') border-red-500 @enderror rounded-b focus:border-pink focus:outline-none"
                                                type="text" name="alamat_perayaan" id="alamat_perayaan" placeholder="Jl. Besar no. 1"
                                                required
                                                value="{{ old('alamat_perayaan', '') }}">
                                        </div>

                                        <div class="mt-1 text-sm text-red-500 flex items-center justify-start gap-2">
                                            @error('alamat_perayaan')
                                                <i class="fa-solid fa-circle-info"></i>
                                                <span>{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="w-100 mt-4 flex items-center justify-end gap-4">
                    <a class="w-fit px-4 py-2 font-semibold outline-none text-pink bg-white hover:bg-pink hover:text-white focus:bg-pink focus:text-white active:bg-pink-active transition-colors rounded"
                        href="{{ route('wedding-couple.pernikahan.index') }}">
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

    </div>
@endsection
