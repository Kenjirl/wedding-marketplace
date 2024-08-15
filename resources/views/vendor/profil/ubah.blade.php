@extends('vendor.layout')

@section('title')
    <title>Ubah Profil | Wedding Marketplace</title>
@endsection

@section('h1', 'Profil > Ubah Profil')

@section('content')
    <div class="w-full flex-1">
        <form action="{{ route('vendor.profil.ubah') }}" method="post" autocomplete="off">
            @csrf
            {{-- BUTTON --}}
            <div class="w-full flex items-center justify-between">
                <a class="w-fit px-4 py-2 font-semibold outline-none text-pink bg-white hover:bg-pink hover:text-white focus:bg-pink focus:text-white active:bg-pink-active transition-colors rounded"
                    href="{{ route('vendor.profil.index') }}">
                    <i class="fa-solid fa-arrow-left-long"></i>
                    <span>Kembali</span>
                </a>

                <button class="w-[40px] aspect-square p-2 bg-pink text-white text-center rounded"
                    type="button" id="infoBtn">
                    <i class="fa-solid fa-circle-info"></i>
                </button>

                <button class="w-fit px-4 py-2 rounded text-white font-semibold bg-pink hover:bg-pink-hover focus:bg-pink-hover active:bg-pink-active focus:outline-pink-hover focus:outline-offset-2 transition-colors"
                    type="submit">
                    <i class="fa-regular fa-floppy-disk"></i>
                    <span>Simpan</span>
                </button>
            </div>

            <hr class="my-4">

            {{-- INPUT --}}
            <div class="w-2/3 mx-auto">
                {{-- NAMA --}}
                <div class="w-full mb-4">
                    <div class="w-full">
                        <div class="w-full p-2 text-xs font-bold bg-pink @error('nama') bg-red-400 @enderror text-white flex items-center justify-start rounded-t">
                            <i class="fa-solid fa-building-user"></i>
                            <span class="ml-2">
                                Nama
                            </span>
                        </div>
                        <input class="w-full p-2 flex-1 border-x-2 border-b-2 text-sm @error('nama') border-red-400 @enderror rounded-b focus:border-pink focus:outline-none"
                            type="text" name="nama" id="nama" placeholder="nama pribadi atau perusahaan"
                            required
                            value="{{ old('nama', auth()->user()->w_vendor ? auth()->user()->w_vendor->nama : '') }}">
                    </div>

                    <div class="mt-1 text-sm text-red-400 flex items-center justify-start gap-2">
                        @error('nama')
                            <i class="fa-solid fa-circle-info"></i>
                            <span>{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                {{-- NAMA PENGGUNA & NO TELP CONTAINER --}}
                <div class="w-full mb-4 grid grid-cols-2 gap-4">
                    {{-- NAMA PENGGUNA --}}
                    <div class="w-full">
                        <div class="w-full">
                            <div class="w-full p-2 text-xs font-bold bg-pink @error('username') bg-red-400 @enderror text-white flex items-center justify-start rounded-t">
                                <i class="fa-solid fa-user-tag"></i>
                                <span class="ml-2">
                                    Nama Pengguna
                                </span>
                            </div>
                            <input class="w-full p-2 flex-1 border-x-2 border-b-2 text-sm @error('username') border-red-400 @enderror rounded-b focus:border-pink focus:outline-none"
                                type="text" name="username" id="username" placeholder="Budi123"
                                required
                                value="{{ old('username', auth()->user()->name) }}">
                        </div>

                        <div class="mt-1 text-sm text-red-400 flex items-center justify-start gap-2">
                            @error('username')
                                <i class="fa-solid fa-circle-info"></i>
                                <span>{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    {{-- TELEPON --}}
                    <div class="w-full">
                        <div class="w-full">
                            <div class="w-full p-2 text-xs font-bold bg-pink @error('no_telp') bg-red-400 @enderror text-white flex items-center justify-start rounded-t">
                                <i class="fa-solid fa-phone"></i>
                                <span class="ml-2">
                                    Telepon
                                </span>
                            </div>
                            <input class="w-full p-2 flex-1 border-x-2 border-b-2 text-sm @error('no_telp') border-red-400 @enderror rounded-b focus:border-pink focus:outline-none"
                                type="number" name="no_telp" id="no_telp" placeholder="081234567890" min="0"
                                required
                                value="{{ old('no_telp', auth()->user()->w_vendor ? auth()->user()->w_vendor->no_telp : '') }}">
                        </div>

                        <div class="mt-1 text-sm text-red-400 flex items-center justify-start gap-2">
                            @error('no_telp')
                                <i class="fa-solid fa-circle-info"></i>
                                <span>{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- ALAMAT --}}
                <div class="w-full mb-4 col-span-2">
                    <div class="w-full">
                        <div class="w-full p-2 text-xs font-bold bg-pink @error('alamat') bg-red-400 @enderror text-white flex items-center justify-start rounded-t">
                            <i class="fa-solid fa-location-dot"></i>
                            <span class="ml-2">
                                Alamat
                            </span>
                        </div>
                        <input class="w-full p-2 flex-1 border-x-2 border-b-2 text-sm @error('alamat') border-red-400 @enderror rounded-b focus:border-pink focus:outline-none"
                            type="text" name="alamat" id="alamat" placeholder="Jl. Besar no. 1"
                            required
                            value="{{ old('alamat', auth()->user()->w_vendor ? auth()->user()->w_vendor->alamat : '') }}">
                    </div>

                    <div class="mt-1 text-sm text-red-400 flex items-center justify-start gap-2">
                        @error('alamat')
                            <i class="fa-solid fa-circle-info"></i>
                            <span>{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                {{-- KOORDINAT --}}
                <div class="w-full mb-4 flex items-center gap-4">
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
                                value="{{ old('lat', auth()->user()->w_vendor ? auth()->user()->w_vendor->koordinat['lat'] : '') }}">
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
                                value="{{ old('lng', auth()->user()->w_vendor ? auth()->user()->w_vendor->koordinat['lng'] : '') }}">
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

                {{-- BASIS KOTA OPERASI CONTAINER --}}
                <div class="w-full grid grid-cols-2 gap-4">
                    {{-- BASIS OPERASI --}}
                    <div class="relative w-full mb-4">
                        <div class="w-full">
                            <div class="w-full p-2 text-xs font-bold bg-pink @error('basis_operasi') bg-red-400 @enderror text-white flex items-center justify-start rounded-t">
                                <i class="fa-regular fa-circle-dot"></i>
                                <span class="ml-2">
                                    Basis Operasi
                                </span>
                            </div>
                            <select class="w-full p-2 flex-1 border-x-2 border-b-2 text-sm @error('gender') border-red-400 @enderror rounded-b focus:border-pink outline-none"
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

                        <div class="mt-1 text-sm text-red-400 flex items-center justify-start gap-2">
                            @error('basis_operasi')
                                <i class="fa-solid fa-circle-info"></i>
                                <span>{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    {{-- KOTA OPERASI --}}
                    <div class="relative w-full mb-4 hidden" id="kotaOperasiContainer">
                        <div class="w-full">
                            <div class="w-full p-2 text-xs font-bold bg-pink @error('kota_operasi') bg-red-400 @enderror text-white flex items-center justify-start rounded-t">
                                <i class="fa-solid fa-location-crosshairs"></i>
                                <span class="ml-2">
                                    Kota Operasi
                                </span>
                            </div>
                            <input class="w-full p-2 flex-1 border-x-2 border-b-2 text-sm @error('kota_operasi') border-red-400 @enderror rounded-b outline-none"
                                type="text" name="kota_operasi" id="kota_operasi" placeholder="Kota/Kabupaten Operasional"
                                value="{{ old('kota_operasi', auth()->user()->w_vendor ? auth()->user()->w_vendor->kota_operasi : '') }}">
                        </div>

                        <div class="mt-1 text-sm text-red-400 flex items-center justify-start gap-2">
                            @error('kota_operasi')
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
                    <div class="w-full max-h-[70vh] overflow-y-auto ">
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
            let alamat = '';

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
                            alamat = data.display_name;

                            $('#latText').text(lat);
                            $('#lngText').text(lng);

                            map.flyTo([lat, lng], 15);

                            popup
                                .setLatLng([lat, lng])
                                .setContent(`
                                    <p>
                                        Alamat : <b>${alamat}</b> <br>
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
                let alamatSearch = $('#cari_koordinat').val();
                let url = "https://nominatim.openstreetmap.org/search?format=json&limit=3&q=" + alamatSearch;

                fetch(url)
                    .then(response => response.json())
                    .then(data => {
                        let addressArr = data;
                        if (addressArr.length > 0) {
                            let address = addressArr[0];
                            lat = address.lat;
                            lng = address.lon;
                            alamat = address.display_name;

                            $('#latText').text(lat);
                            $('#lngText').text(lng);

                            map.flyTo([lat, lng], 15);

                            popup
                                .setLatLng([lat, lng])
                                .setContent(`
                                    <p>
                                        Alamat : <b>${alamat}</b> <br>
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
                $('#alamat').val(alamat);
                $('#closeMapModalBtn').click();
                toastr.success("Alamat & Koordinat ditambahkan", "Sukses");
            });
        });
    </script>
@endpush
