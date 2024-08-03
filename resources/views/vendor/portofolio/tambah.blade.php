@extends('vendor.layout')

@section('title')
    <title>Tambah Portofolio | Wedding Marketplace</title>
@endsection

@section('h1', 'Portofolio > Tambah Portofolio')

@section('content')
    <form action="{{ route('vendor.portofolio.tambah') }}" method="post" enctype="multipart/form-data">
        @csrf
        {{-- BUTTON --}}
        <div class="w-full flex items-center justify-between">
            <a class="w-fit px-4 py-2 font-semibold outline-none text-pink bg-white hover:bg-pink hover:text-white focus:bg-pink focus:text-white active:bg-pink-active transition-colors rounded"
                href="{{ route('vendor.portofolio.index') }}">
                <i class="fa-solid fa-arrow-left-long"></i>
                <span>Kembali</span>
            </a>

            <button class="w-fit px-4 py-2 rounded text-white font-semibold bg-pink hover:bg-pink-hover focus:bg-pink-hover active:bg-pink-active focus:outline-pink-hover focus:outline-offset-2 transition-colors"
                type="submit">
                <i class="fa-regular fa-floppy-disk"></i>
                <span>Simpan</span>
            </button>
        </div>

        <hr class="my-4">

        {{-- INPUTS --}}
        <div class="w-full flex items-start justify-between gap-8">
            {{-- KIRI --}}
            <div class="flex-1">
                {{-- JUDUL --}}
                <div class="w-full mb-4">
                    <div class="w-full">
                        <div class="w-full p-2 text-xs font-bold bg-pink @error('judul') bg-red-400 @enderror text-white flex items-center justify-start rounded-t">
                            <i class="fa-solid fa-heading"></i>
                            <span class="ml-2">
                                Judul
                            </span>
                        </div>
                        <input class="w-full p-2 flex-1 border-x-2 border-b-2 text-sm @error('judul') border-red-400 @enderror rounded-b focus:border-pink focus:outline-none"
                            type="text" name="judul" id="judul" placeholder="Pernikahan Budi dan Ani"
                            required
                            value="{{ old('judul', '') }}">
                    </div>

                    <div class="mt-1 text-sm text-red-400 flex items-center justify-start gap-2">
                        @error('judul')
                            <i class="fa-solid fa-circle-info"></i>
                            <span>{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                {{-- JENIS VENDOR --}}
                <div class="w-full mb-4">
                    <div class="w-full">
                        <div class="w-full p-2 text-xs font-bold bg-pink @error('j_vendor') bg-red-400 @enderror text-white flex items-center justify-start rounded-t">
                            <i class="fa-solid fa-user-tie"></i>
                            <span class="ml-2">
                                Jenis Vendor
                            </span>
                        </div>
                        <select class="w-full p-2 flex-1 border-x-2 border-b-2 text-sm @error('j_vendor') border-red-400 @enderror rounded-b focus:border-pink focus:outline-none"
                            name="j_vendor" id="j_vendor">
                            <option value="" selected>Jenis Vendor</option>
                            @forelse ($j_vendors as $j_vendor)
                                <option value="{{ $j_vendor->m_jenis_vendor_id }}" {{ old('j_vendor', '') == $j_vendor->m_jenis_vendor_id ? 'selected' : '' }}>
                                    {{ $j_vendor->master->nama }}
                                </option>
                            @empty
                            @endforelse
                        </select>
                    </div>

                    <div class="mt-1 text-sm text-red-400 flex items-center justify-start gap-2">
                        @error('j_vendor')
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
                        <div class="w-full p-2 text-xs font-bold bg-pink @error('tanggal') bg-red-400 @enderror text-white flex items-center justify-start rounded-t">
                            <i class="fa-regular fa-calendar"></i>
                            <span class="ml-2">
                                Tanggal
                            </span>
                        </div>
                        <input class="w-full p-2 flex-1 border-x-2 border-b-2 text-sm @error('tanggal') border-red-400 @enderror rounded-b focus:border-pink focus:outline-none"
                            type="date" name="tanggal" id="tanggal" max="{{ $yesdate }}"
                            required
                            value="{{ old('tanggal', '') }}">
                    </div>

                    <div class="mt-1 text-sm text-red-400 flex items-center justify-start gap-2">
                        @error('tanggal')
                            <i class="fa-solid fa-circle-info"></i>
                            <span>{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                {{-- LOKASI --}}
                <div class="relative w-full mb-4 col-span-2">
                    <div class="w-full">
                        <div class="w-full p-2 text-xs font-bold bg-pink @error('lokasi') bg-red-400 @enderror text-white flex items-center justify-start rounded-t">
                            <i class="fa-solid fa-location-dot"></i>
                            <span class="ml-2">
                                Lokasi
                            </span>
                        </div>
                        <input class="w-full p-2 flex-1 border-x-2 border-b-2 text-sm @error('lokasi') border-red-400 @enderror rounded-b focus:border-pink focus:outline-none"
                            type="text" name="lokasi" id="lokasi" placeholder="Jl. Besar no. 1"
                            required
                            value="{{ old('lokasi', '') }}">
                    </div>

                    <div class="mt-1 text-sm text-red-400 flex items-center justify-start gap-2">
                        @error('lokasi')
                            <i class="fa-solid fa-circle-info"></i>
                            <span>{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                {{-- KOORDINAT --}}
                <div class="flex items-center gap-4">
                    {{-- LATITUDE --}}
                    <div class="relative w-full">
                        <div class="w-full">
                            <div class="w-full p-2 text-xs font-bold bg-pink @error('lat') bg-red-400 @enderror text-white flex items-center justify-start rounded-t">
                                <i class="fa-solid fa-location-dot"></i>
                                <span class="ml-2">
                                    Latitude
                                </span>
                            </div>
                            <input class="w-full p-2 flex-1 border-x-2 border-b-2 text-sm @error('lat') border-red-400 @enderror rounded-b focus:border-pink focus:outline-none"
                                type="text" name="lat" id="lat" placeholder="(opsional)"
                                value="{{ old('lat', '') }}">
                        </div>

                        <div class="mt-1 text-sm text-red-400 flex items-center justify-start gap-2">
                            @error('lat')
                                <i class="fa-solid fa-circle-info"></i>
                                <span>{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    {{-- LONGITUDE --}}
                    <div class="relative w-full">
                        <div class="w-full">
                            <div class="w-full p-2 text-xs font-bold bg-pink @error('lng') bg-red-400 @enderror text-white flex items-center justify-start rounded-t">
                                <i class="fa-solid fa-location-dot"></i>
                                <span class="ml-2">
                                    Longitude
                                </span>
                            </div>
                            <input class="w-full p-2 flex-1 border-x-2 border-b-2 text-sm @error('lng') border-red-400 @enderror rounded-b focus:border-pink focus:outline-none"
                                type="text" name="lng" id="lng" placeholder="(opsional)"
                                value="{{ old('lng', '') }}">
                        </div>

                        <div class="mt-1 text-sm text-red-400 flex items-center justify-start gap-2">
                            @error('lng')
                                <i class="fa-solid fa-circle-info"></i>
                                <span>{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    {{-- OPEN MAP BUTTON --}}
                    <button class="flex-shrink-0 w-[40px] aspect-square flex items-center justify-center bg-pink text-white font-semibold rounded"
                        type="button" id="openMapModalBtn">
                        <i class="fa-solid fa-map"></i>
                    </button>
                </div>
            </div>

            {{-- KANAN --}}
            <div class="flex-1">
                {{-- DETAIL --}}
                <div class="w-full mb-4">
                    <div class="w-full">
                        <div class="w-full p-2 text-xs font-bold bg-pink @error('detail') bg-red-400 @enderror text-white flex items-center justify-start rounded-t">
                            <i class="fa-solid fa-circle-info"></i>
                            <span class="ml-2">
                                Detail
                            </span>
                        </div>
                        <textarea class="w-full p-2 flex-1 border-x-2 border-b-2 resize-none text-sm @error('detail') border-red-400 @enderror rounded-b focus:border-pink focus:outline-none"
                            name="detail" id="input" rows="3" placeholder="masukan detail acara ini"
                            >{{ old('detail', '') }}</textarea>
                    </div>

                    <div class="mt-1 text-sm text-red-400 flex items-center justify-start gap-2">
                        @error('detail')
                            <i class="fa-solid fa-circle-info"></i>
                            <span>{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        {{-- MAP MODAL --}}
        <div class="fixed top-full left-0 w-full h-screen flex items-center justify-center bg-slate-500/50 z-10 transition-all duration-500"
            id="mapModal">
            <div class="w-[80%] max-w-[1200px] bg-white rounded-md">
                {{-- atas --}}
                <div class="w-full p-4 flex items-center justify-between">
                    <div>
                        <span class="text-xl font-semibold">
                            Cari Titik Koordinat
                        </span>
                    </div>

                    {{-- TOMBOL CLOSE MODAL --}}
                    <div>
                        <button class="w-fit px-2 aspect-square rounded outline-pink outline-offset-4 bg-pink text-white hover:bg-pink-hover focus:bg-pink-hover active:bg-pink-active transition-colors"
                            type="button" tabindex="-1" id="closeMapModalBtn">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </div>
                </div>

                {{-- konten --}}
                <div class="w-full max-h-[70vh] overflow-y-auto">
                    <div class="relative w-full h-[500px]"
                        id="map"></div>
                </div>

                {{-- bawah --}}
                <div class="w-full px-4 py-2 flex items-center justify-between text-[.9em]">
                    {{-- input search koordinat --}}
                    <div class="w-1/3 flex items-center justify-start gap-2">
                        <input class="w-[200px] p-2 rounded border outline-pink"
                            type="text" id="cari_koordinat" name="cari_koordinat" placeholder="cari kota/alamat">

                        <button class="w-[40px] aspect-square flex items-center justify-center rounded outline-pink outline-offset-4 bg-pink text-white hover:bg-pink-hover focus:bg-pink-hover active:bg-pink-active transition-colors"
                            type="button" tabindex="-1" id="cariKoordinatBtn">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                    </div>

                    {{-- koordinat map --}}
                    <div class="w-1/3 flex items-center justify-start gap-2">
                        <div>
                            Latitude :
                            <span id="latText"></span>
                        </div>
                        <div>
                            Longitude :
                            <span id="lngText"></span>
                        </div>
                    </div>

                    {{-- buttons --}}
                    <div class="w-1/3 flex items-center justify-end gap-2">
                        <a id="googleMapLink" class="block w-fit px-4 py-2 rounded outline-pink outline-offset-4 border border-pink text-pink hover:bg-pink hover:text-white focus:bg-pink focus:text-white active:bg-pink-active transition-colors"
                            href="https://www.google.com/maps" target="_blank" tabindex="-1">
                            Cek di Google Map
                        </a>

                        <button class="w-fit px-4 py-2 rounded outline-pink outline-offset-4 bg-pink text-white hover:bg-pink-hover focus:bg-pink-hover active:bg-pink-active disabled:bg-slate-400 disabled:text-white transition-colors"
                            type="button" tabindex="-1" id="submitKoordinatBtn" disabled>
                            Koordinat Sudah Pas!
                        </button>
                    </div>
                </div>
            </div>
        </div>

        {{-- TIPE INPUT --}}
        <div class="hidden">
            <input type="text" name="form-info" id="form-info" value="add">
        </div>

        {{-- FOTO --}}
        <div class="w-full mt-4 rounded shadow">
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
                <div class="text-red-400 flex items-center justify-start gap-2">
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
    </form>
@endsection

@push('child-js')
    {{-- SCRIPT MAP --}}
    <script>
        $(document).ready(function () {
            // MODAL
            $('#openMapModalBtn').on('click', function() {
                $(`#mapModal`).removeClass('top-full').addClass('top-0');
                $(`#mapModal button`).attr('tabindex', 0);
                $(`#mapModal a`).attr('tabindex', 0);
            });
            $('#closeMapModalBtn').on('click', function() {
                $(`#mapModal`).removeClass('top-0').addClass('top-full');
                $(`#mapModal button`).attr('tabindex', -1);
                $(`#mapModal a`).attr('tabindex', -1);
            });

            let lat = '';
            let lng = '';
            let lokasi = '';

            // LEAFLET
            let map = L.map('map').setView([-2.600029, 118.015776], 5);
            L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
            }).addTo(map);

            let popup = L.popup();

            function onMapClick(e) {
                let latlng = e.latlng.toString();
                lat = latlng.split(',')[0].replace('LatLng(', '');
                lng = latlng.split(',')[1].replace(')', '');

                let url = `https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}`;

                fetch(url)
                    .then(response => response.json())
                    .then(data => {
                        console.log(data);
                        if (data) {
                            lat = data.lat;
                            lng = data.lon;
                            lokasi = data.display_name;

                            $('#latText').text(lat);
                            $('#lngText').text(lng);

                            map.flyTo([lat, lng], 15);

                            popup
                                .setLatLng([lat, lng])
                                .setContent(`
                                    <p>
                                        Lokasi : <b>${lokasi}</b> <br>
                                        lat : ${lat} <br>
                                        long : ${lng}
                                    </p>
                                `)
                                .openOn(map);

                            updateGoogleMapLink(lat, lng);
                            updateSubmitCoordinateBtn(lat, lng);
                        } else {
                            toastr.error("Koordinat tidak ditemukan", "Gagal");
                        }
                    })
                    .catch(err => console.log(err));

                updateGoogleMapLink(lat, lng);
                updateSubmitCoordinateBtn(lat, lng);
            }

            map.on('click', onMapClick);

            $('#cariKoordinatBtn').on('click', function() {
                let alamat = $('#cari_koordinat').val();
                let url = "https://nominatim.openstreetmap.org/search?format=json&limit=3&q=" + alamat;

                fetch(url)
                    .then(response => response.json())
                    .then(data => {
                        let addressArr = data;
                        if (addressArr.length > 0) {
                            let address = addressArr[0];
                            lat = address.lat;
                            lng = address.lon;
                            lokasi = address.display_name;

                            $('#latText').text(lat);
                            $('#lngText').text(lng);

                            map.flyTo([lat, lng], 15);

                            popup
                                .setLatLng([lat, lng])
                                .setContent(`
                                    <p>
                                        Lokasi : <b>${lokasi}</b> <br>
                                        lat : ${lat} <br>
                                        long : ${lng}
                                    </p>
                                `)
                                .openOn(map);

                            updateGoogleMapLink(lat, lng);
                            updateSubmitCoordinateBtn(lat, lng);
                        } else {
                            toastr.error("Koordinat tidak ditemukan", "Gagal");
                        }
                    })
                    .catch(err => console.log(err));
            });

            function updateGoogleMapLink(lat, lng) {
                let googleMapLink = `https://www.google.com/maps?q=${lat},${lng}`;
                $('#googleMapLink').attr('href', googleMapLink);
            }

            function updateSubmitCoordinateBtn(lat, lng) {
                if (lat !== '' && lng !== '') {
                    $('#submitKoordinatBtn').removeAttr('disabled');
                } else {
                    $('#submitKoordinatBtn').attr('disabled', 'true');
                }
            }

            $('#submitKoordinatBtn').on('click', function() {
                $('#lat').val(lat);
                $('#lng').val(lng);
                $('#lokasi').val(lokasi);
                $('#closeMapModalBtn').click();
                toastr.success("Lokasi & Koordinat ditambahkan", "Sukses");
            });
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

            updateFotoJson();
        });
    </script>
@endpush
