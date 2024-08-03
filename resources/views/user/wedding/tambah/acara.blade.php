@extends('user.wedding.tambah.index')

@php
    $tomDate = new DateTime('tomorrow');
@endphp

@section('part')
    <div class="w-full flex items-start justify-center gap-4">
        <div class="w-full">
            <div class="w-full flex items-center justify-end">
                <button class="w-fit px-4 py-2 rounded text-white text-sm font-semibold bg-pink hover:bg-pink-hover focus:bg-pink-hover active:bg-pink-active focus:outline-pink-hover focus:outline-offset-2 transition-colors"
                    type="button" id="openAddEventModalBtn">
                    <i class="fa-solid fa-plus"></i>
                    Tambah Acara
                </button>
            </div>

            <hr class="my-2">

            <div class="w-full max-h-[500px] px-2 pb-2 grid grid-cols-1 gap-4 overflow-y-auto"
                id="listAcara"></div>
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
                        Tambah Acara
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
                {{-- DAFTAR EVENT --}}
                <div class="w-full p-2 grid grid-cols-3 gap-2" id="eventList"></div>

                {{-- ADD EVENT --}}
                <div class="w-full p-2 hidden items-start justify-center gap-4" id="addEventInputContainer">
                    <div class="w-full">
                        {{-- ID --}}
                        <input class="hidden" type="number" name="add_event_id"   id="add_event_id"   value="">

                        {{-- INPUT READONLY --}}
                        {{-- NAMA --}}
                        <input class="w-full mb-2 bg-white outline-none text-pink text-lg"
                            type="text" name="add_nama" id="add_nama" value="" readonly disabled>

                        {{-- JENIS --}}
                        <input class="w-[100px] mb-2 px-2 py-1 rounded bg-pink text-white text-center font-semibold text-sm outline-none"
                            type="text" name="add_jenis" id="add_jenis" value="" readonly disabled>

                        {{-- KETERANGAN --}}
                        <input class="w-full text-sm bg-white text-slate-400 italic outline-none"
                            type="text" name="add_keterangan" id="add_keterangan" value="" readonly disabled>

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
                                type="datetime-local" name="add_waktu" id="add_waktu" min="{{ $tomDate->format('Y-m-d H:i:s') }}" value="">
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
                <button class="w-fit px-4 py-2 hidden font-semibold outline-none text-pink bg-white hover:bg-pink hover:text-white focus:bg-pink focus:text-white active:bg-pink-active transition-colors rounded"
                    type="button" tabindex="-1" id="backToEventListBtn">
                    Kembali ke Daftar Acara
                </button>

                <button class="w-[40px] aspect-square bg-pink text-white text-center rounded"
                    type="button" id="infoBtn">
                    <i class="fa-solid fa-circle-info"></i>
                </button>

                <button class="w-fit px-4 py-2 hidden rounded outline-pink outline-offset-4 bg-pink text-white hover:bg-pink-hover focus:bg-pink-hover active:bg-pink-active disabled:bg-slate-400 disabled:text-white transition-colors"
                    type="button" tabindex="-1" id="submitAddEventBtn" disabled>
                    Tambahkan Acara
                </button>
            </div>
        </div>
    </div>

    <form action="{{ route('user.pernikahan.acara', $wedding->id) }}" method="post" id="weddingForm">
        @csrf
    </form>
@endsection

@push('child-js')
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
        let event_umum = @json($event_umum);
        let events = @json($events);
        let filteredEvents = events;
        let addedEvents = [];
        let canSubmit = false;
        let countAcara = 1;

        let options = {year: 'numeric', month: 'long', day: 'numeric', hour: '2-digit', minute: '2-digit'};

        // console.log(event_umum, events);

        function eventBtnClick(id) {
            $('#eventList').addClass('hidden');
            $('#addEventInputContainer').removeClass('hidden').addClass('flex');
            $('#submitAddEventBtn').removeClass('hidden');
            $('#backToEventListBtn').removeClass('hidden');

            let t_nama  = $('#eventListNama-' +id).text();
            let t_jenis = $('#eventListJenis-'+id).text();
            let t_ket   = $('#eventListKet-'  +id).text();

            $('#add_event_id').val(id);
            $('#add_nama').val(t_nama);
            $('#add_jenis').val(t_jenis);
            $('#add_keterangan').val(t_ket);
        }

        function renderEventList(event) {
            if (canSubmit) {
                let ele = '';
                event.map(e => {
                    ele = ele + `
                        <button class="w-full h-full p-2 flex flex-col items-start justify-start text-start rounded-lg border border-pink"
                            type="button" data-id-event="${ e.id }" onclick="eventBtnClick(${ e.id })">
                            <div id="eventListNama-${e.id}" class="w-full text-pink">${ e.nama }</div>
                            <div id="eventListJenis-${e.id}" class="w-full text-sm font-semibold">${ e.jenis }</div>
                            <div id="eventListKet-${e.id}" class="w-full text-sm text-slate-400 italic">${ e.keterangan }</div>
                        </button>
                    `
                });
                $('#eventList').html(ele);
            } else {
                $('#eventList').html(`
                    <button class="w-full p-2 text-start rounded-lg border border-pink"
                        type="button" data-id-event="${ event.id }" onclick="eventBtnClick(${ event.id })">
                        <div id="eventListNama-${event.id}" class="w-full text-pink">${ event.nama }</div>
                        <div id="eventListJenis-${event.id}" class="w-full text-sm font-semibold">${ event.jenis }</div>
                        <div id="eventListKet-${event.id}" class="w-full text-sm text-slate-400 italic">${ event.keterangan }</div>
                    </button>
                `);
            }
        }

        function renderInputList(id, nama, jenis, keterangan, waktu, lokasi, lat, lng) {
            // buat template input dengan value dari parameter
            $('<input>', {type: 'hidden', id: 'w_event_id-'+id, name: 'w_event_id[]', value: id    }).appendTo($('#weddingForm'));
            $('<input>', {type: 'hidden', id: 'waktu-'+id,      name: 'waktu[]',      value: waktu }).appendTo($('#weddingForm'));
            $('<input>', {type: 'hidden', id: 'lokasi-'+id,     name: 'lokasi[]',     value: lokasi}).appendTo($('#weddingForm'));
            $('<input>', {type: 'hidden', id: 'lat-'+id,        name: 'lat[]',        value: lat   }).appendTo($('#weddingForm'));
            $('<input>', {type: 'hidden', id: 'lng-'+id,        name: 'lng[]',        value: lng   }).appendTo($('#weddingForm'));

            let dateObj = new Date(waktu);
            let t_waktu = dateObj.toLocaleDateString('id-ID', options);

            let t_lokasi = lokasi != '' ? `${lokasi} (${lat}, ${lng})` : 'belum diisi';
            let acaraItem = `
                <div class="w-full shadow rounded" id="acara-${id}">
                    <div class="w-full flex items-center justify-start gap-2 border-b border-pink">
                        <div class="text-nomor-acara w-[40px] aspect-square flex items-center justify-center bg-pink text-white rounded-tl font-semibold">
                            ${countAcara}
                        </div>
                        <div class="w-full font-semibold">
                            ${nama}
                        </div>
                        <div class="w-[40px] text-centercursor-pointer" title="${keterangan}">
                            <i class="fa-regular fa-circle-question"></i>
                        </div>
                    </div>
                    <div class="w-full">
                        <div class="w-full p-2">
                            <div class="w-fit px-2 py-1 mb-1 bg-pink text-white font-semibold text-xs rounded-sm">
                                ${jenis}
                            </div>
                            <div class="w-full text-sm text-slate-400 italic">
                                <div id="teksWaktuAcara-${id}">
                                    Pada : ${t_waktu}
                                </div>
                                <div id="teksLokasiAcara-${id}">
                                    bertempat di : ${t_lokasi}
                                </div>
                            </div>
                        </div>

                        <div class="w-full p-2 flex items-center justify-end gap-2 border-t">
                            <button class="w-[30px] aspect-square flex items-center justify-center bg-white text-pink outline-pink font-semibold rounded
                                hover:bg-pink hover:text-white focus:bg-pink focus:text-white active:bg-pink-active transition-colors"
                                type="button" title="ubah" onclick="editInputList(${id})">
                                <i class="fa-regular fa-pen-to-square"></i>
                            </button>
            `;

            if (id != 1) {
                acaraItem += `
                    <button class="w-[30px] aspect-square flex items-center justify-center bg-white text-pink outline-pink font-semibold rounded
                        hover:bg-pink hover:text-white focus:bg-pink focus:text-white active:bg-pink-active transition-colors"
                        type="button" title="hapus" onclick="removeInputList(${id})">
                        <i class="fa-regular fa-rectangle-xmark"></i>
                    </button>`;
            }

            acaraItem += `
                        </div>
                    </div>
                </div>`;

            // filter variabel events jika id != 1
            if (id != 1) {
                addedEvents.push(+id);
                filteredEvents = events.filter(e => !addedEvents.includes(e.id));

                $('#listAcara').append(acaraItem);
            } else {
                $('#listAcara').html(acaraItem);
            }

            countAcara++;

            // render event list dengan variabel filteredEvents yang baru
            renderEventList(filteredEvents);
        }

        function updateTakeMapInfoBtn(lat, lng, lokasi) {
            if (lat !== '' && lng !== '' && lokasi !== '') {
                $('#takeMapInfoBtn').removeAttr('disabled');
            } else {
                $('#takeMapInfoBtn').attr('disabled', 'true');
            }
        }

        function editInputList(id) {
            $('#openAddEventModalBtn').click();

            // pengaturan tampilan
            $('#eventList').addClass('hidden');
            $('#addEventInputContainer').removeClass('hidden').addClass('flex');
            $('#submitAddEventBtn').removeClass('hidden');
            $('#backToEventListBtn').removeClass('hidden');

            // update value input
            let nama = '';
            let jenis = '';
            let keterangan = '';
            if (id == 1) {
                nama = event_umum.nama;
                jenis = event_umum.jenis;
                keterangan = event_umum.keterangan;
            } else {
                let evt = events.find(t => t.id == id);
                nama = evt.nama;
                jenis = evt.jenis;
                keterangan = evt.keterangan;
            }

            let lokasi = $('#lokasi-'+id).val();
            let lat    = $('#lat-'   +id).val();
            let lng    = $('#lng-'   +id).val();

            $('#add_event_id'  ).val($('#w_event_id-'+id).val());
            $('#add_nama'      ).val(nama                      );
            $('#add_jenis'     ).val(jenis                     );
            $('#add_keterangan').val(keterangan                );
            $('#add_waktu'     ).val($('#waktu-'     +id).val()).trigger('change');;
            $('#add_lokasi'    ).val(lokasi                    );
            $('#add_lat'       ).val(lat                       );
            $('#add_lng'       ).val(lng                       );

            updateTakeMapInfoBtn(lat, lng, lokasi);

            // pengaturan marker map
            if (modalCurMarker) {
                map.removeLayer(modalCurMarker);
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
        }

        function removeInputList(id) {
            if (id == 1) {
                // not allowed
                toastr.error("Tidak dapat menghapus acara Pernikahan.", "Gagal");
                return;
            }

            // render event list dengan variabel filteredEvents yang baru
            addedEvents = addedEvents.filter(e => +e != +id);
            filteredEvents = events.filter(e => !addedEvents.includes(e.id));
            countAcara--;
            renderEventList(filteredEvents);

            // hapus element input dari acara
            $('#w_event_id-'+id).remove();
            $('#waktu-'     +id).remove();
            $('#lokasi-'    +id).remove();
            $('#lat-'       +id).remove();
            $('#lng-'       +id).remove();

            // hapus element tampilan dari acara
            $('#acara-' +id).remove();

            // ulang penomoran
            let i = 1;
            $('.text-nomor-acara').each(function() {
                $(this).text(i);
                i++;
            });

            // hapus dari koordinatArr, fly to original map view
            removeCoordinate(id);

            toastr.success("Menghapus Acara", "Sukses");
        }

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

        // Fungsi untuk menghapus lokasi
        function removeCoordinate(id) {
            koordinatArr = koordinatArr.filter(location => +location.id !== +id);
            renderMarkers();
            if (koordinatArr.length > 0) {
                // Fokus pada koordinat pertama jika ada
                mapResult.flyTo([koordinatArr[0].lat, koordinatArr[0].lng], 10);
            } else {
                mapResult.flyTo([-2.600029, 118.015776], 5);
            }
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

        $(document).ready(function () {
            renderEventList(event_umum);
        });
    </script>

    {{-- SCRIPT MAP MODAL --}}
    <script>
        $(document).ready(function () {
            // MODAL
            $('#openAddEventModalBtn').on('click', function() {
                $(`#addEventModal`).removeClass('top-full').addClass('top-0');
                $(`#addEventModal button`).attr('tabindex', 0);
                $(`#addEventModal a`).attr('tabindex', 0);
                $(`#addEventModal input`).attr('tabindex', 0);
            });
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

                $('#eventList').removeClass('hidden');
                $('#addEventInputContainer').removeClass('flex').addClass('hidden');
                $('#submitAddEventBtn').addClass('hidden').attr('disabled', 'true');
                $('#backToEventListBtn').addClass('hidden');
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

            $('#add_waktu').on('change', function() {
                if ($(this).val() !== '') {
                    $('#submitAddEventBtn').removeAttr('disabled');
                } else {
                    $('#submitAddEventBtn').attr('disabled', 'true');
                }
            });

            $('#submitAddEventBtn').on('click', function() {
                canSubmit         = true;
                let v_id          = $('#add_event_id').val();
                let v_nama        = $('#add_nama').val();
                let v_jenis       = $('#add_jenis').val();
                let v_keterangan  = $('#add_keterangan').val();
                let v_waktu       = $('#add_waktu').val();
                let v_lokasi      = $('#add_lokasi').val();
                let v_lat         = $('#add_lat').val();
                let v_lng         = $('#add_lng').val();

                // Lokasi dan koordinat harus sama-sama ada atau sama-sama tidak ada
                if ((v_lokasi == '' && v_lat == '' && v_lng == '') || (v_lokasi != '' && v_lat != '' && v_lng != '')) {
                    let input_is_available = $('#w_event_id-'+v_id).length > 0;

                    if (input_is_available) {
                        // mode ubah acara yang sudah ada
                        // ubah value
                        $('#w_waktu-'+v_id).val(v_waktu);
                        $('#lokasi-' +v_id).val(v_lokasi);
                        $('#lat-'    +v_id).val(v_lat);
                        $('#lng-'    +v_id).val(v_lng);

                        let dateObj = new Date(v_waktu);
                        let t_waktu = dateObj.toLocaleDateString('id-ID', options);

                        let t_lokasi = v_lokasi != '' ? `${v_lokasi} (${v_lat}, ${v_lng})` : 'belum diisi';

                        // ubah tampilan
                        $('#teksWaktuAcara-'+v_id).html(`Pada : ${t_waktu}`);
                        $('#teksLokasiAcara-'+v_id).html(`bertempat di : ${t_lokasi}`);

                        updateCoordinate(v_id, v_lokasi, v_lat, v_lng);

                        toastr.success("Berhasil mengubah acara.", "Sukses");
                    } else {
                        // mode tambah acara baru
                        renderInputList(v_id, v_nama, v_jenis, v_keterangan, v_waktu, v_lokasi, v_lat, v_lng);

                        $('#submitWeddingBtn').removeAttr('disabled');

                        addCoordinate(v_id, v_lokasi, v_lat, v_lng);

                        toastr.success("Berhasil menambah acara.", "Sukses");
                    }
                    $('#closeAddEventModalBtn').click();
                } else {
                    toastr.error("Koordinat diperlukan dalam mengisi Alamat. Berlaku juga sebaliknya.", "Gagal");
                }
            });

            $('#backToEventListBtn').on('click', function() {
                $('#eventList').removeClass('hidden');
                $('#addEventInputContainer').addClass('hidden').removeClass('flex');
                $('#submitAddEventBtn').addClass('hidden');
                $('#backToEventListBtn').addClass('hidden');

                $('#add_event_id').val();
                $('#add_nama').val('');
                $('#add_jenis').val('');
                $('#add_keterangan').val('');
                $('#add_waktu').val('');
                $('#add_lokasi').val('');
                $('#add_lat').val('');
                $('#add_lng').val('');
            });

            $('#infoBtn').on("click", function () {
                Swal.fire({
                    title: "Info",
                    icon: "info",
                    iconColor: "#F78CA2",
                    html: `
                        <p class="text-start text-sm">
                            1. Pilih acara yang ingin ditampilkan pada undangan <br>
                            2. Acara Pernikahan merupakan acara yang wajib ada <br>
                            3. Acara dapat dipilih dari daftar yang ada berdasarkan kebutuhan <br>
                            4. Tanggal dan Waktu acara wajib diisi <br>
                            5. Lokasi acara tidak wajib diisi untuk memesan vendor, namun wajib diisi jika ingin membuat undangan digital <br>
                            6. Rentetan acara akan tampil berurutan berdasarkan tanggal & waktu pelaksanaan acara
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
