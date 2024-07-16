@extends('vendor.layout')

@section('title')
    <title>Ubah Portofolio | Wedding Marketplace</title>
@endsection

@section('h1', 'Portofolio > Ubah Portofolio')

@section('content')
    <div class="mb-4 flex items-center justify-end gap-2">
        <button class="w-[40px] aspect-square p-2 bg-pink text-white text-center rounded"
            type="button" id="infoBtn">
            <i class="fa-solid fa-circle-info"></i>
        </button>

        @if ($portofolio->admin_id && $portofolio->status == 'diterima')
            <div class="w-fit px-4 py-2 bg-blue-500 font-semibold text-white rounded">
        @elseif ($portofolio->admin_id && $portofolio->status == 'ditolak')
            <div class="w-fit px-4 py-2 bg-red-500 font-semibold text-white rounded">
        @else
            <div class="w-fit px-4 py-2 bg-yellow-500 font-semibold text-white rounded">
        @endif
                {{ $portofolio->status }}
            </div>
    </div>

    <form action="{{ route('vendor.portofolio.ubah', $portofolio->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        {{-- INPUTS --}}
        <div class="w-full flex items-start justify-between gap-8">
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
                            value="{{ old('judul', $portofolio->judul) }}">
                    </div>

                    <div class="mt-1 text-sm text-red-500 flex items-center justify-start gap-2">
                        @error('judul')
                            <i class="fa-solid fa-circle-info"></i>
                            <span>{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                {{-- TANGGAL --}}
                <div class="w-full mb-4">
                    <div class="w-full">
                        <div class="w-full p-2 text-xs font-bold bg-pink @error('tanggal') bg-red-500 @enderror text-white flex items-center justify-start rounded-t">
                            <i class="fa-regular fa-calendar"></i>
                            <span class="ml-2">
                                Tanggal
                            </span>
                        </div>
                        <input class="w-full p-2 flex-1 border-x-2 border-b-2 text-sm @error('tanggal') border-red-500 @enderror rounded-b focus:border-pink focus:outline-none"
                            type="date" name="tanggal" id="tanggal" placeholder="Pernikahan Budi dan Ani"
                            required
                            value="{{ old('tanggal', $portofolio->tanggal) }}">
                    </div>

                    <div class="mt-1 text-sm text-red-500 flex items-center justify-start gap-2">
                        @error('tanggal')
                            <i class="fa-solid fa-circle-info"></i>
                            <span>{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                {{-- ALAMAT --}}
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
                            name="detail" id="input" rows="3" placeholder="masukkan detail portofolio ini"
                            >{{ old('detail', $portofolio->detail) }}</textarea>
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
            <input type="text" name="form-info" id="form-info" value="edit">
        </div>

        {{-- FOTO --}}
        <div class="w-full rounded shadow">
            {{-- ATAS --}}
            <div class="w-full px-4 py-2 flex items-center justify-between gap-2 rounded-t bg-slate-100 border-2 border-slate-100">
                {{-- HEADING --}}
                <div class="p-2 font-semibold">
                    <i class="fa-solid fa-images"></i>
                    <span class="ml-2">
                        Galeri
                    </span>
                </div>

                {{-- TOMBOL INPUT GAMBAR --}}
                <div class="w-fit">
                    <button class="w-full px-4 py-2 rounded text-white font-semibold text-sm bg-pink
                            hover:bg-pink-hover focus:bg-pink-hover active:bg-pink-active
                            disabled:bg-slate-400 disabled:cursor-not-allowed
                            transition-colors"
                            type="button" id="unggahFotoBtn"
                            {{ $count >= 5 ? 'disabled' : '' }}>
                        <i class="fa-solid fa-plus"></i>
                        Tambah Gambar
                    </button>
                </div>
            </div>

            {{-- INPUT GAMBAR BARU --}}
            <input class="hidden" type="file" name="foto[]" id="foto" accept="image/*" value="{{ old('foto[]', '') }}">

            {{-- PREVIEW --}}
            <div class="w-full h-[350px] p-2 flex items-center justify-start gap-2 border-x-2 border-slate-100 overflow-y-auto"
                id="image-preview">
                <div class="relative hidden w-1/5 h-full rounded bg-slate-100" id="new-image"></div>

                @foreach ($portofolio->foto as $index => $foto)
                    <div class="relative w-1/5 h-full rounded {{ $foto['rejected'] ? 'bg-red-500' : 'bg-slate-100' }} ">
                        <img class="w-full h-full object-contain"
                            src="{{ asset($foto['url']) }}" alt="Foto Portofolio">

                        @if (count($portofolio->foto) > 1)
                            <button class="absolute top-0 right-0 w-8 aspect-square bg-pink rounded text-white"
                                type="button" onclick="deleteImage({{ $index }})">
                                <i class="fa-solid fa-xmark"></i>
                            </button>
                        @endif

                        @if ($foto['rejected'])
                            <p class="absolute left-0 top-[45%] w-full p-1 text-center bg-red-500 text-white font-semibold">
                                DITOLAK
                            </p>
                        @endif
                    </div>
                @endforeach
            </div>

            {{-- BAWAH --}}
            <div class="w-full px-4 py-2 flex items-center justify-between text-sm rounded-b border-2 border-slate-100">
                <div class="text-red-500 flex items-center justify-start gap-2">
                    @error('foto')
                        <i class="fa-solid fa-circle-info"></i>
                        <span>{{ $message }}</span>
                    @enderror
                </div>

                <div id="jumlahFoto">
                    <span data-count="{{ $count }}" id="imgCount">0/5</span>
                </div>
            </div>
        </div>

        {{-- BUTTON --}}
        <div class="w-full mt-4 flex items-center justify-end gap-4">
            <a class="w-fit px-4 py-2 font-semibold outline-none text-pink bg-white hover:bg-pink hover:text-white focus:bg-pink focus:text-white active:bg-pink-active transition-colors rounded"
                href="{{ route('vendor.portofolio.index') }}">
                <i class="fa-solid fa-arrow-left-long"></i>
                <span>Kembali</span>
            </a>

            <button class="w-fit px-4 py-2 font-semibold outline-none text-pink bg-white hover:bg-pink hover:text-white focus:bg-pink focus:text-white active:bg-pink-active transition-colors rounded"
                id="deleteBtn" type="button">
                <i class="fa-solid fa-trash-can"></i>
                <span>Hapus</span>
            </button>

            <button class="w-fit px-4 py-2 rounded text-white font-semibold bg-pink hover:bg-pink-hover focus:bg-pink-hover active:bg-pink-active focus:outline-pink-hover focus:outline-offset-2 transition-colors"
                type="submit">
                <i class="fa-regular fa-floppy-disk"></i>
                <span>Simpan</span>
            </button>
        </div>
    </form>

    {{-- FORM HAPUS PORTOFOLIO --}}
    <form class="hidden" action="{{ route('vendor.portofolio.hapus', $portofolio->id) }}" method="post">
        @csrf
        <button id="submitDeleteBtn" type="submit"></button>
    </form>

    {{-- FORM HAPUS FOTO PORTOFOLIO --}}
    @foreach ($portofolio->foto as $index => $foto)
        <form id="deleteImageForm-{{ $index }}" action="{{ route('vendor.portofolio.hapus-foto', ['id' => $portofolio->id, 'index' => $index]) }}" method="post">
            @csrf
        </form>
    @endforeach
@endsection

@push('child-js')
    @if(App::environment('local'))
        <script src="{{ asset('js/input-select-wilayah.js') }}"></script>
    @else
        <script src="https://pro-malamute-vastly.ngrok-free.app/js/input-select-wilayah.js"></script>
    @endif

    <script>
        let count = $('#imgCount').data('count');

        function setImgCount(x) {
            $('#imgCount').html(x + '/5');
        }

        $("#unggahFotoBtn").on("click", function () {
            $("#foto").click();
        });

        $('#deleteBtn').on("click", function () {
            Swal.fire({
                title: 'Hapus portofolio ini?',
                text: "Data tidak akan dapat dikembalikan lagi",
                icon: "warning",
                iconColor: "#F78CA2",
                showCloseButton: true,
                confirmButtonColor: "#F78CA2",
                confirmButtonText: "Konfirmasi"
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#submitDeleteBtn').click();
                }
            });
        });

        $('#foto').on('change', function() {
            let files = this.files;
            $('#new-image').empty().removeClass('hidden').addClass('flex');

            for (let i = 0; i < files.length; i++) {
                if (i < 5) {
                    $('#new-image').append(`
                        <img class="w-full h-full object-contain"
                            src="${URL.createObjectURL(files[i])}" alt="Foto Portofolio">

                        <button class="absolute top-0 right-0 w-8 aspect-square bg-pink rounded text-white"
                            type="button" onclick="deleteNewImage()">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    `);

                    count = $('#imgCount').data('count');
                    count++;
                    setImgCount(count);
                }
            }
        });

        function deleteImage(id) {
            Swal.fire({
                title: 'Hapus Foto',
                text: "Apakah Anda yakin ingin menghapus gambar ini?",
                icon: "warning",
                iconColor: "#F78CA2",
                showCloseButton: true,
                confirmButtonColor: "#F78CA2",
                confirmButtonText: "Konfirmasi"
            }).then((result) => {
                if (result.isConfirmed) {
                    const formId = 'deleteImageForm-' + id;
                    const imageForm = document.getElementById(formId);

                    if (imageForm) {
                        imageForm.submit();
                    }
                }
            });
        }

        function deleteNewImage() {
            $('#new-image').empty().removeClass('flex').addClass('hidden');
            $('#foto').val('');
            count--;
            setImgCount(count);
        }

        $('#infoBtn').on("click", function () {
            Swal.fire({
                title: "Info",
                icon: "info",
                iconColor: "#F78CA2",
                html: `
                    <p class="text-justify text-sm">
                        1. Maksimal 5 foto untuk tiap portofolio <br>
                        2. Silahkan ubah foto 1 per 1 <br>
                        3. Hapus foto dengan label <b>DITOLAK</b> <br>
                        4. Klik simpan jika sudah selesai
                    </p>
                `,
                showCloseButton: true,
                confirmButtonColor: "#F78CA2",
                confirmButtonText: "OK"
            }).then((result) => {
                return;
            });
        });

        $(document).ready(function () {
            setImgCount(count);
        });
    </script>
@endpush
