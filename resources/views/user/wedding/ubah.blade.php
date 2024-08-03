@extends('user.layout')

@section('title')
    <title>Lengkapi Pernikahan | Wedding Marketplace</title>
@endsection

@php
    $currentUrl = Request::url();
    $tomDate = new DateTime('tomorrow');
@endphp

@section('content')
    <div class="w-full max-w-[1200px] mx-auto">
        {{-- BUTTONS --}}
        <div class="w-full mt-4 flex items-start justify-between">
            <a class="block w-fit px-4 py-2 font-semibold outline-none text-pink bg-white hover:bg-pink hover:text-white focus:bg-pink focus:text-white active:bg-pink-active transition-colors rounded"
                href="{{ route('user.pernikahan.ke_detail', $wedding->id) }}">
                <i class="fa-solid fa-arrow-left-long"></i>
                <span>Kembali</span>
            </a>

            <button class="w-fit px-4 py-2 rounded text-white font-semibold bg-pink hover:bg-pink-hover focus:bg-pink-hover active:bg-pink-active focus:outline-pink-hover focus:outline-offset-2 disabled:bg-slate-400 disabled:text-white transition-colors"
                type="button" id="submitWeddingBtn">
                <i class="fa-regular fa-floppy-disk"></i>
                <span>Simpan</span>
            </button>
        </div>

        <hr class="my-2">

        <div class="w-full flex items-start justify-center gap-4">
            <div class="w-full max-h-[500px] px-2 pb-2 grid grid-cols-1 gap-4 overflow-y-auto"
                id="listAcara">
                @forelse ($events as $acara)
                    <div class="w-full shadow rounded" id="acara-{{$acara->id}}">
                        <div class="w-full flex items-center justify-start gap-2 border-b border-pink">
                            <div class="text-nomor-acara w-[40px] aspect-square flex items-center justify-center bg-pink text-white rounded-tl font-semibold">
                                {{$loop->iteration}}
                            </div>
                            <div class="w-full font-semibold" id="teksNamaAcara-{{ $acara->id }}">
                                {{$acara->event->nama}}
                            </div>
                            <div class="w-[40px] text-centercursor-pointer" title="{{$acara->event->keterangan}}" id="teksKetAcara-{{ $acara->id }}">
                                <i class="fa-regular fa-circle-question"></i>
                            </div>
                        </div>
                        <div class="w-full">
                            <div class="w-full p-2">
                                <div class="w-fit px-2 py-1 mb-1 bg-pink text-white font-semibold text-xs rounded-sm"
                                    id="teksJenisAcara-{{ $acara->id }}">
                                    {{$acara->event->jenis}}
                                </div>
                                <div class="w-full text-sm text-slate-400 italic">
                                    <div id="teksWaktuAcara-{{$acara->id}}">
                                        Pada : {{\Carbon\Carbon::parse($acara->waktu)->translatedFormat('l, d F Y')}}
                                        pukul {{ \Carbon\Carbon::parse($acara->waktu)->translatedFormat('H:i') }}
                                    </div>
                                    <div id="teksLokasiAcara-{{$acara->id}}">
                                        bertempat di :
                                        {{$acara->lokasi != '' ? $acara->lokasi.' ('.$acara->koordinat['lat'].', '.$acara->koordinat['lng'].')' : 'belum memilih lokasi' }}
                                    </div>
                                </div>
                            </div>

                            @if ($acara->lokasi == '')
                                <div class="w-full p-2 flex items-center justify-end gap-2 border-t">
                                    <button class="edit-input-btn w-[30px] aspect-square flex items-center justify-center bg-white text-pink outline-pink font-semibold rounded
                                        hover:bg-pink hover:text-white focus:bg-pink focus:text-white active:bg-pink-active transition-colors"
                                        type="button" title="ubah" data-id="{{ $acara->id }}">
                                        <i class="fa-regular fa-pen-to-square"></i>
                                    </button>
                                </div>
                            @endif
                        </div>
                    </div>
                @empty

                @endforelse

            </div>

            <div class="w-full aspect-square"
                id="mapResult"></div>
        </div>

        <div class="fixed top-full left-0 w-full h-screen flex items-center justify-center bg-slate-500/50 z-[1000] transition-all duration-500"
            id="addEventModal">
            <div class="w-[80%] max-w-[1200px] bg-white rounded-md">
                {{-- atas --}}
                <div class="w-full p-4 flex items-center justify-between">
                    <div>
                        <span class="text-xl font-semibold">
                            Lengkapi Acara
                        </span>
                    </div>

                    {{-- TOMBOL CLOSE MODAL --}}
                    <div>
                        <button class="w-fit px-2 aspect-square rounded outline-pink outline-offset-4 bg-pink text-white hover:bg-pink-hover focus:bg-pink-hover active:bg-pink-active transition-colors"
                            type="button" tabindex="-1" id="closeAddEventModalBtn">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </div>
                </div>

                {{-- konten --}}
                <div class="w-full h-[70vh] overflow-y-auto border-y-2">
                    {{-- UPDATE EVENT --}}
                    <div class="w-full p-2 flex items-start justify-center gap-4" id="addEventInputContainer">
                        <div class="w-full">
                            {{-- ID --}}
                            <input class="hidden" type="number" name="add_event_id"   id="add_event_id"   value="">

                            {{-- INPUT READONLY --}}
                            {{-- NAMA --}}
                            <div class="w-full mb-2 bg-white outline-none text-pink text-lg" id="add_nama"></div>

                            {{-- JENIS --}}
                            <div class="w-[100px] mb-2 px-2 py-1 rounded bg-pink text-white text-center font-semibold text-sm outline-none" id="add_jenis"></div>

                            {{-- KETERANGAN --}}
                            <div class="w-full text-sm bg-white text-slate-400 italic outline-none" id="add_keterangan"></div>

                            <hr class="my-2">

                            {{-- TANGGAL & WAKTU --}}
                            <div class="w-full mb-4">
                                <div class="w-full p-2 text-xs font-bold bg-pink text-white flex items-center justify-start rounded-t">
                                    <i class="fa-regular fa-calendar"></i>
                                    <span class="ml-2">
                                        Tanggal & Waktu
                                    </span>
                                </div>
                                <input class="w-full p-2 flex-1 border-x-2 border-b-2 text-sm rounded-b focus:border-pink focus:outline-none"
                                    type="datetime-local" name="add_waktu" id="add_waktu" value="" readonly>
                            </div>

                            {{-- LOKASI --}}
                            <div class="w-full mb-4 flex items-center justify-start gap-2">
                                <div class="w-full">
                                    <div class="w-full p-2 text-xs font-bold bg-pink text-white flex items-center justify-start rounded-t">
                                        <i class="fa-solid fa-location-dot"></i>
                                        <span class="ml-2">
                                            Lokasi
                                        </span>
                                    </div>
                                    <input class="w-full p-2 flex-1 border-x-2 border-b-2 text-sm rounded-b focus:border-pink focus:outline-none"
                                        type="text" name="add_lokasi" id="add_lokasi" placeholder="boleh dikosongkan" value="">
                                </div>
                                <button class="w-[40px] aspect-square flex items-center justify-center rounded outline-pink outline-offset-4 bg-pink text-white hover:bg-pink-hover focus:bg-pink-hover active:bg-pink-active transition-colors"
                                    type="button" tabindex="-1" id="cariKoordinatBtn">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </button>
                            </div>

                            {{-- KOORDINAT --}}
                            <div class="flex items-center gap-4">
                                {{-- LATITUDE --}}
                                <div class="w-full">
                                    <div class="w-full p-2 text-xs font-bold bg-pink text-white flex items-center justify-start rounded-t">
                                        <i class="fa-solid fa-location-dot"></i>
                                        <span class="ml-2">
                                            Koordinat Latitude
                                        </span>
                                    </div>
                                    <input class="w-full p-2 flex-1 border-x-2 border-b-2 text-sm rounded-b focus:border-pink focus:outline-none"
                                        type="number" name="add_lat" id="add_lat" placeholder="0.000">
                                </div>

                                {{-- LONGITUDE --}}
                                <div class="w-full">
                                    <div class="w-full p-2 text-xs font-bold bg-pink text-white flex items-center justify-start rounded-t">
                                        <i class="fa-solid fa-location-dot"></i>
                                        <span class="ml-2">
                                            Koordinat Longitude
                                        </span>
                                    </div>
                                    <input class="w-full p-2 flex-1 border-x-2 border-b-2 text-sm rounded-b focus:border-pink focus:outline-none"
                                        type="number" name="add_lng" id="add_lng" placeholder="0.000">
                                </div>
                            </div>
                        </div>

                        {{-- MAP --}}
                        <div class="w-full">
                            <div class="relative w-full h-[450px] mb-2" id="map"></div>

                            <div class="w-full flex items-center justify-end text-sm">
                                <button class="w-fit px-4 py-2 rounded outline-pink outline-offset-4 bg-pink text-white hover:bg-pink-hover focus:bg-pink-hover active:bg-pink-active disabled:bg-slate-400 disabled:text-white transition-colors"
                                    type="button" tabindex="-1" id="takeMapInfoBtn" disabled>
                                    Ambil Data Lokasi & Koordinat
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- bawah --}}
                <div class="w-full p-2 flex items-center justify-between text-[.9em]">
                    <button class="w-[40px] aspect-square bg-pink text-white text-center rounded"
                        type="button" id="infoBtn">
                        <i class="fa-solid fa-circle-info"></i>
                    </button>

                    <button class="w-fit px-4 py-2 rounded outline-pink outline-offset-4 bg-pink text-white hover:bg-pink-hover focus:bg-pink-hover active:bg-pink-active disabled:bg-slate-400 disabled:text-white transition-colors"
                        type="button" tabindex="-1" id="submitAddEventBtn">
                        Lengkapi Acara
                    </button>
                </div>
            </div>
        </div>

        <form action="{{ route('user.pernikahan.ubah', $wedding->id) }}" method="post" id="weddingForm">
            @csrf
            @foreach ($events as $acara)
                @if ($acara->lokasi == '')
                    <input type="hidden" id="w_event_id-{{ $acara->id }}" name="w_event_id[]" value="{{ $acara->id }}">
                    <input type="hidden" id="lokasi-{{ $acara->id }}"     name="lokasi[]"     value="{{ $acara->lokasi }}">
                    <input type="hidden" id="lat-{{ $acara->id }}"        name="lat[]"        value="{{ $acara->lat }}">
                    <input type="hidden" id="lng-{{ $acara->id }}"        name="lng[]"        value="{{ $acara->lng }}">
                @endif
            @endforeach
        </form>
    </div>
@endsection

@push('child-js')
    <script>
        $(document).ready(function () {
            $('#submitWeddingBtn').on('click', function () {
                $('#weddingForm').submit();
            });

            $('#weddingForm').on('submit', function (e) {
                e.preventDefault();
                const form = document.getElementById('weddingForm');

                if (form.checkValidity()) {
                    Swal.fire({
                        title: 'Perhatian',
                        html: `
                            <p class="text-start text-sm">
                                1. Acara yang sudah rampung & lengkap tidak dapat diubah kembali setelah disimpan <br>
                                2. Jika semua acara sudah lengkap, maka Anda tidak akan dapat melakukan pengubahan lagi
                            </p>
                        `,
                        icon: "warning",
                        iconColor: "#F78CA2",
                        showCloseButton: true,
                        confirmButtonColor: "#F78CA2",
                        confirmButtonText: "Konfirmasi"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            this.submit();
                        }
                    });
                } else {
                    form.reportValidity();
                }
            });
        });
    </script>

    {{-- SCRIPT INPUT --}}
    <script>
    // DECLARE FOR LEAFLET
        let lat = '';
        let lng = '';
        let lokasi = '';
        let modalCurMarker = null;
        let koordinatArr = [];
        let markers = {};

        let map = L.map('map').setView([-2.600029, 118.015776], 5);
        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
        }).addTo(map);

        let mapResult = L.map('mapResult').setView([-2.600029, 118.015776], 5);
        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
        }).addTo(mapResult);

        // DECLARE FOR INPUT
        let events = @json($events);

        // ATUR MARKER AWAL
        events.forEach(e => {
            if (e.lokasi != '' && e.lokasi != null) {
                koordinatArr.push({ id: e.id, lokasi: e.lokasi, lat: e.koordinat.lat, lng: e.koordinat.lng });
            }
        });
        renderMarkers();
        mapResult.flyTo([koordinatArr[0]['lat'], koordinatArr[0]['lng']], 13);

        function updateTakeMapInfoBtn(lat, lng, lokasi) {
            if (lat !== '' && lng !== '' && lokasi !== '') {
                $('#takeMapInfoBtn').removeAttr('disabled');
            } else {
                $('#takeMapInfoBtn').attr('disabled', 'true');
            }
        }

        $('.edit-input-btn').each(function() {
            let id = $(this).data('id');
            $(this).on('click', function() {
                openAddEventModal();

                // update value input
                let evt = events.find(t => t.id == id);

                $('#add_event_id'  ).val(evt.id                  );
                $('#add_nama'      ).text($('#teksNamaAcara-' +id).text());
                $('#add_jenis'     ).text($('#teksJenisAcara-'+id).text());
                $('#add_keterangan').text($('#teksKetAcara-'  +id).attr('title'));
                $('#add_waktu'     ).val(evt.waktu               );
                $('#add_lokasi'    ).val(evt.lokasi              );
                $('#add_lat'       ).val(evt.lat                 );
                $('#add_lng'       ).val(evt.lng                 );

                updateTakeMapInfoBtn(lat, lng, lokasi);

                // pengaturan marker map
                if (modalCurMarker) {
                    map.removeLay5er(modalCurMarker);
                }

                if (lat != '' && lng != '') {
                    modalCurMarker = L.marker([lat, lng])
                        .bindPopup(`<p>Lokasi : <b>${lokasi}</b> <br>lat : ${lat} <br>long : ${lng}</p>`)
                        .addTo(map)
                        .openPopup();

                    map.flyTo([lat, lng], 15);
                } else {
                    map.flyTo([-2.600029, 118.015776], 5);
                }
            });
        });

    // SCRIPT MAP INPUT
        function renderMarkers() {
            // Hapus semua marker dari peta
            Object.keys(markers).forEach(id => {
                mapResult.removeLayer(markers[id]);
            });
            markers = {};

            // Tambahkan marker baru dari array lokasi
            koordinatArr.forEach(data => {
                let marker = L.marker([data.lat, data.lng]).addTo(mapResult)
                    .bindPopup(`<p>Lokasi : <b>${data.lokasi}</b> <br>lat : ${data.lat} <br>long : ${data.lng}</p>`);
                markers[data.id] = marker;
            });
        }

        function addCoordinate(id, lokasi, lat, lng) {
            if (lat === null || lat === '' || lng === null || lng === '') {
                return;
            }

            // Tambahkan koordinat ke dalam array
            koordinatArr.push({ id: id, lokasi: lokasi, lat: lat, lng: lng });
            renderMarkers();
            mapResult.flyTo([lat, lng], 15);
        }

        function updateCoordinate(id, newLokasi, newLat, newLng) {
            if (newLat === null || newLat === '' || newLng === null || newLng === '') {
                return;
            }

            // Cari dan perbarui data lokasi
            let data = koordinatArr.find(data => data.id === id);
            if (data) {
                data.lokasi = newLokasi;
                data.lat = newLat;
                data.lng = newLng;

                // Perbarui posisi marker pada peta
                if (markers[id]) {
                    markers[id].setLatLng([newLat, newLng])
                        .bindPopup(`<p>Lokasi : <b>${data.lokasi}</b> <br>lat : ${data.lat} <br>long : ${data.lng}</p>`);
                }
            } else {
                addCoordinate(id, newLokasi, newLat, newLng);
            }
            mapResult.flyTo([newLat, newLng], 15);
        }
    </script>

    {{-- SCRIPT MAP MODAL --}}
    <script>
        // MODAL
        function openAddEventModal() {
            $(`#addEventModal`).removeClass('top-full').addClass('top-0');
            $(`#addEventModal button`).attr('tabindex', 0);
            $(`#addEventModal a`).attr('tabindex', 0);
            $(`#addEventModal input`).attr('tabindex', 0);
        };

        $(document).ready(function () {
            $('#closeAddEventModalBtn').on('click', function() {
                $(`#addEventModal`).removeClass('top-0').addClass('top-full');
                $(`#addEventModal button`).attr('tabindex', -1);
                $(`#addEventModal a`).attr('tabindex', -1);
                $(`#addEventModal input`).attr('tabindex', -1);

                lat = '';
                lng = '';
                lokasi = '';
                updateTakeMapInfoBtn(lat, lng, lokasi);

                $('#add_event_id').val('');
                $('#add_waktu').val('');
                $('#add_lokasi').val('');
                $('#add_lat').val('');
                $('#add_lng').val('');
            });

            // LEAFLET
            let popup = L.popup();

            function onMapClick(e) {
                let latlng = e.latlng.toString();
                lat = parseFloat(latlng.split(',')[0].replace('LatLng(', ''));
                lng = parseFloat(latlng.split(',')[1].replace(')', ''));

                let url = `https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}`;

                fetch(url)
                    .then(response => response.json())
                    .then(data => {
                        console.log(data);
                        if (data) {
                            lokasi = data.display_name;

                            $('#latText').text(lat);
                            $('#lngText').text(lng);

                            map.flyTo([lat, lng], 15);

                            if (modalCurMarker) {
                                map.removeLayer(modalCurMarker);
                            }

                            modalCurMarker = L.marker([lat, lng])
                                .bindPopup(`<p>Lokasi : <b>${lokasi}</b> <br>lat : ${lat} <br>long : ${lng}</p>`)
                                .addTo(map)
                                .openPopup();

                            updateTakeMapInfoBtn(lat, lng, lokasi);
                        } else {
                            toastr.error("Koordinat tidak ditemukan", "Gagal");
                        }
                    })
                    .catch(err => console.log(err));

                updateTakeMapInfoBtn(lat, lng, lokasi);
            }

            map.on('click', onMapClick);

            $('#cariKoordinatBtn').on('click', function() {
                let alamat = $('#add_lokasi').val();

                if (alamat !== '') {
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

                                if (modalCurMarker) {
                                    map.removeLayer(modalCurMarker);
                                }

                                modalCurMarker = L.marker([lat, lng])
                                    .bindPopup(`<p>Lokasi : <b>${lokasi}</b> <br>lat : ${lat} <br>long : ${lng}</p>`)
                                    .addTo(map)
                                    .openPopup();

                                updateTakeMapInfoBtn(lat, lng, lokasi);
                            } else {
                                toastr.error("Koordinat tidak ditemukan", "Gagal");
                            }
                        })
                        .catch(err => console.log(err));
                } else {
                    toastr.error("Lokasi masih kosong", "Gagal");
                }
            });

            $('#takeMapInfoBtn').on('click', function() {
                $('#add_lat').val(lat);
                $('#add_lng').val(lng);
                $('#add_lokasi').val(lokasi);
                toastr.success("Lokasi & Koordinat ditambahkan", "Sukses");
            });

            $('#submitAddEventBtn').on('click', function() {
                let v_id     = $('#add_event_id').val();
                let v_lokasi = $('#add_lokasi').val();
                let v_lat    = $('#add_lat').val();
                let v_lng    = $('#add_lng').val();

                // Lokasi dan koordinat harus sama-sama ada atau sama-sama tidak ada
                if ((v_lokasi == '' && v_lat == '' && v_lng == '') || (v_lokasi != '' && v_lat != '' && v_lng != '')) {
                    // ubah value
                    $('#lokasi-'+v_id).val(v_lokasi);
                    $('#lat-'   +v_id).val(v_lat);
                    $('#lng-'   +v_id).val(v_lng);

                    let t_lokasi = v_lokasi != '' ? `${v_lokasi} (${v_lat}, ${v_lng})` : 'belum diisi';

                    // ubah tampilan
                    $('#teksLokasiAcara-'+v_id).html(`bertempat di : ${t_lokasi}`);

                    updateCoordinate(v_id, v_lokasi, v_lat, v_lng);

                    toastr.success("Berhasil mengubah acara.", "Sukses");

                    $('#closeAddEventModalBtn').click();
                } else {
                    toastr.error("Koordinat diperlukan dalam mengisi Alamat. Berlaku juga sebaliknya.", "Gagal");
                }
            });

            $('#infoBtn').on("click", function () {
                Swal.fire({
                    title: "Info",
                    icon: "info",
                    iconColor: "#F78CA2",
                    html: `
                        <p class="text-start text-sm">
                            1. Lengkapi acara yang Anda buat <br>
                            2. Setiap acara yang sudah memiliki informasi lengkap tidak dapat diubah kembali <br>
                            3. Klik simpan untuk menyimpan perubahan yang Anda buat
                        </p>
                    `,
                    showCloseButton: true,
                    confirmButtonColor: "#F78CA2",
                    confirmButtonText: "OK"
                }).then((result) => {
                    return;
                });
            });
        });
    </script>
@endpush
