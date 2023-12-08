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
                        <select class="w-full p-2 flex-1 border-x-2 border-b-2 text-sm @error('gender') border-red-500 @enderror rounded-b focus:border-pink outline-none"
                            name="gender" id="gender" required>
                            <option value="" selected>Pilih Gender</option>
                            <option value="Pria" {{ old('gender', auth()->user()->admin->gender) == 'Pria' ? 'selected' : '' }}>
                                Pria
                            </option>
                            <option value="Wanita" {{ old('gender', auth()->user()->admin->gender) == 'Wanita' ? 'selected' : '' }}>
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

            {{-- KANAN --}}
            <div class="flex-1">
                {{-- PROVINSI --}}
                <div class="relative w-100 mb-4">
                    <div class="w-100">
                        <div class="w-full p-2 text-xs font-bold bg-pink @error('provinsi') bg-red-500 @enderror text-white flex items-center justify-start rounded-t">
                            Provinsi
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
                            Kota/Kabupaten
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
                            Kecamatan
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
                            Kelurahan
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
    <script src="{{ asset('js/input-select-wilayah.js') }}"></script>
@endpush
