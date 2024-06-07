@extends('user.catering.layout')

@section('title')
    <title>Tambah Portofolio | Wedding Marketplace</title>
@endsection

@section('h1', 'Portofolio > Tambah Portofolio')

@section('content')
    <form action="{{ route('catering.portofolio.tambah') }}" method="post" enctype="multipart/form-data">
        @csrf
        {{-- INPUTS --}}
        <div class="w-full flex items-start justify-between gap-8 mb-4">
            {{-- KIRI --}}
            <div class="flex-1">
                {{-- JUDUL --}}
                <div class="w-full mb-4">
                    <div class="w-full">
                        <div class="w-full p-2 text-xs font-bold bg-pink @error('judul') bg-red-500 @enderror text-white flex items-center justify-start rounded-t">
                            <i class="fa-solid fa-heading"></i>
                            <span class="ml-2">
                                Judul
                            </span>
                        </div>
                        <input class="w-full p-2 flex-1 border-x-2 border-b-2 text-sm @error('judul') border-red-500 @enderror rounded-b focus:border-pink focus:outline-none"
                            type="text" name="judul" id="judul" placeholder="Pernikahan Budi dan Ani"
                            required
                            value="{{ old('judul', '') }}">
                    </div>

                    <div class="mt-1 text-sm text-red-500 flex items-center justify-start gap-2">
                        @error('judul')
                            <i class="fa-solid fa-circle-info"></i>
                            <span>{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                {{-- TANGGAL --}}
                @php
                    $yesdate = date('Y-m-d', strtotime("-1 days"));
                @endphp
                <div class="w-full mb-4">
                    <div class="w-full">
                        <div class="w-full p-2 text-xs font-bold bg-pink @error('tanggal') bg-red-500 @enderror text-white flex items-center justify-start rounded-t">
                            <i class="fa-regular fa-calendar"></i>
                            <span class="ml-2">
                                Tanggal
                            </span>
                        </div>
                        <input class="w-full p-2 flex-1 border-x-2 border-b-2 text-sm @error('tanggal') border-red-500 @enderror rounded-b focus:border-pink focus:outline-none"
                            type="date" name="tanggal" id="tanggal" max="{{ $yesdate }}"
                            required
                            value="{{ old('tanggal', '') }}">
                    </div>

                    <div class="mt-1 text-sm text-red-500 flex items-center justify-start gap-2">
                        @error('tanggal')
                            <i class="fa-solid fa-circle-info"></i>
                            <span>{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                {{-- LOKASI --}}
                <div class="grid grid-cols-2 gap-4">
                    {{-- PROVINSI --}}
                    <div class="relative w-full">
                        <div class="w-full">
                            <div class="w-full p-2 text-xs font-bold bg-pink @error('provinsi') bg-red-500 @enderror text-white flex items-center justify-start rounded-t">
                                <i class="fa-solid fa-location-dot"></i>
                                <span class="ml-2">
                                    Provinsi
                                </span>
                            </div>
                            <select class="w-full p-2 flex-1 border-x-2 border-b-2 text-sm @error('provinsi') border-red-500 @enderror rounded-b focus:border-pink outline-none"
                                name="provinsi" id="provinsi">
                                <option value="" selected>Pilih Provinsi</option>
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
                    <div class="relative w-full">
                        <div class="w-full">
                            <div class="w-full p-2 text-xs font-bold bg-pink @error('kota') bg-red-500 @enderror text-white flex items-center justify-start rounded-t">
                                <i class="fa-solid fa-location-dot"></i>
                                <span class="ml-2">
                                    Kota/Kabupaten
                                </span>
                            </div>
                            <select class="w-full p-2 flex-1 border-x-2 border-b-2 text-sm @error('kota') border-red-500 @enderror rounded-b focus:border-pink outline-none"
                                name="kota" id="kota">
                                <option value="" selected>Pilih Kota/Kabupaten</option>
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
                    <div class="relative w-full">
                        <div class="w-full">
                            <div class="w-full p-2 text-xs font-bold bg-pink @error('kecamatan') bg-red-500 @enderror text-white flex items-center justify-start rounded-t">
                                <i class="fa-solid fa-location-dot"></i>
                                <span class="ml-2">
                                    Kecamatan
                                </span>
                            </div>
                            <select class="w-full p-2 flex-1 border-x-2 border-b-2 text-sm @error('kecamatan') border-red-500 @enderror rounded-b focus:border-pink outline-none"
                                name="kecamatan" id="kecamatan">
                                <option value="" selected>Pilih Kecamatan</option>
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
                    <div class="relative w-full">
                        <div class="w-full">
                            <div class="w-full p-2 text-xs font-bold bg-pink @error('kelurahan') bg-red-500 @enderror text-white flex items-center justify-start rounded-t">
                                <i class="fa-solid fa-location-dot"></i>
                                <span class="ml-2">
                                    Kelurahan
                                </span>
                            </div>
                            <select class="w-full p-2 flex-1 border-x-2 border-b-2 text-sm @error('kelurahan') border-red-500 @enderror rounded-b focus:border-pink outline-none"
                                name="kelurahan" id="kelurahan">
                                <option value="" selected>Pilih Kelurahan</option>
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
                    <div class="relative w-full mb-4 col-span-2">
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
                                value="{{ old('alamat_detail', '') }}">
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

            {{-- KANAN --}}
            <div class="flex-1">
                {{-- DETAIL --}}
                <div class="w-full mb-4">
                    <div class="w-full">
                        <div class="w-full p-2 text-xs font-bold bg-pink @error('detail') bg-red-500 @enderror text-white flex items-center justify-start rounded-t">
                            <i class="fa-solid fa-circle-info"></i>
                            <span class="ml-2">
                                Detail
                            </span>
                        </div>
                        <textarea class="w-full p-2 flex-1 border-x-2 border-b-2 resize-none text-sm @error('detail') border-red-500 @enderror rounded-b focus:border-pink focus:outline-none"
                            name="detail" id="input" rows="3" placeholder="masukan detail acara ini"
                            >{{ old('detail', '') }}</textarea>
                    </div>

                    <div class="mt-1 text-sm text-red-500 flex items-center justify-start gap-2">
                        @error('detail')
                            <i class="fa-solid fa-circle-info"></i>
                            <span>{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        {{-- TIPE INPUT --}}
        <div class="hidden">
            <input type="text" name="form-info" id="form-info" value="add">
        </div>

        {{-- FOTO --}}
        <div class="w-full rounded shadow">
            {{-- ATAS --}}
            <div class="w-full px-4 py-2 flex items-center justify-between gap-2 rounded-t bg-slate-100 border-2 border-slate-100">
                <div class="p-2 font-semibold">
                    <i class="fa-solid fa-images"></i>
                    <span class="ml-2">
                        Galeri
                    </span>
                </div>

                <div class="w-fit">
                    <button class="w-full px-4 py-2 rounded text-white font-semibold text-sm bg-pink
                            hover:bg-pink-hover focus:bg-pink-hover active:bg-pink-active
                            disabled:bg-slate-400 disabled:cursor-not-allowed
                            transition-colors"
                            type="button" id="unggahFotoBtn">
                        <i class="fa-solid fa-plus"></i>
                        Tambah Gambar
                    </button>
                </div>
            </div>

            {{-- INPUT --}}
            <input class="hidden" type="file" name="foto[]" id="foto" accept="image/*" multiple value="{{ old('foto[]', '') }}" tabindex="-1">

            {{-- PREVIEW --}}
            <div id="image-preview" class="w-full h-[350px] p-2 flex items-center justify-start gap-2 border-x-2 border-slate-100"></div>

            {{-- BAWAH --}}
            <div class="w-full px-4 py-2 flex items-center justify-between text-sm rounded-b border-2 border-slate-100">
                <div class="text-red-500 flex items-center justify-start gap-2">
                    @error('foto')
                        <i class="fa-solid fa-circle-info"></i>
                        <span>{{ $message }}</span>
                    @enderror
                </div>

                <div id="jumlahFoto">
                    <span>0/5</span>
                </div>
            </div>
        </div>

        {{-- BUTTON --}}
        <div class="w-full mt-4 flex items-center justify-end gap-4">
            <a class="w-fit px-4 py-2 font-semibold outline-none text-pink bg-white hover:bg-pink hover:text-white focus:bg-pink focus:text-white active:bg-pink-active transition-colors rounded"
                href="{{ route('catering.portofolio.index') }}">
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
    {{-- SCRIPT LOKASI --}}
    <script src="{{ asset('js/input-select-wilayah.js') }}"></script>
    <script>
        $(document).ready(function() {
            let provinsiData = {!! file_get_contents(public_path('json/provinsi.json')) !!};
            populateSelect(provinsiData, 'provinsi', 'Pilih Provinsi', 'name');
        });
    </script>

    {{-- SCRIPT FOTO --}}
    <script>
        $(document).ready(function () {
            const $unggahFotoBtn = $('#unggahFotoBtn');
            const $fotoInput = $('#foto');
            const $imagePreview = $('#image-preview');
            const $jumlahFoto = $('#jumlahFoto');

            let fileArray = [];

            function updateFotoJson() {
                const dataTransfer = new DataTransfer();
                fileArray.forEach(file => {
                    dataTransfer.items.add(file);
                });
                $fotoInput[0].files = dataTransfer.files;

                if (fileArray.length >= 5) {
                    $unggahFotoBtn.prop('disabled', true);
                } else {
                    $unggahFotoBtn.prop('disabled', false);
                }

                $jumlahFoto.text(fileArray.length + '/5');
            }

            $unggahFotoBtn.on('click', function () {
                $fotoInput.click();
            });

            $fotoInput.on('change', function () {
                const files = Array.from(this.files);
                const maxFiles = 5 - fileArray.length;

                if (files.length > maxFiles) {
                    Swal.fire({
                        title: "Eitssssss!",
                        text: "Maksimal 5 gambar saja ya!",
                        icon: "warning"
                    });
                    return;
                }

                files.forEach(file => {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        const $imgWrapper = $('<div>').addClass('relative w-1/5 h-full bg-slate-100 rounded');
                        const $img = $('<img>').attr('src', e.target.result).addClass('w-full h-full object-contain');
                        const $deleteBtn = $('<button type="button"><i class="fa-solid fa-xmark"></i></button>').addClass('absolute top-0 right-0 w-8 aspect-square bg-pink rounded text-white');

                        $deleteBtn.on('click', function () {
                            const index = fileArray.findIndex(f => f.name === file.name);
                            if (index !== -1) {
                                fileArray.splice(index, 1);
                                $imgWrapper.remove();
                                updateFotoJson();
                            }
                        });

                        $imgWrapper.append($img).append($deleteBtn);
                        $imagePreview.append($imgWrapper);
                        fileArray.push(file);
                        updateFotoJson();
                    };
                    reader.readAsDataURL(file);
                });
            });

            updateFotoJson();  // Initialize foto count on page load
        });
    </script>
@endpush
