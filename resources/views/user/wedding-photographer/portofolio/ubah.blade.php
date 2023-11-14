@extends('user.wedding-photographer.layout')

@section('title')
    <title>Ubah Portofolio | Wedding Marketplace</title>
@endsection

@section('h1', 'Portofolio > Ubah Portofolio')

@section('content')
    <div class="pl-4 mb-4 flex items-end justify-normal">
        <div class="flex-1 w-full">
            <ol class="list-decimal text-sm">
                <li>Silahkan lengkapi gambar dari portofolio Anda</li>
                <li>Masukan maksimal 5 gambar untuk tiap portofolio</li>
                <li>Masukan gambar 1 per 1 kemudian submit untuk tiap gambar</li>
                <li>Jika latar gambar berwarna kemerahan, artinya gambar tersebut ditolak oleh admin</li>
            </ol>
        </div>

        <div class="flex-1 w-full flex items-start justify-end">
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
    </div>

    <form action="{{ route('wedding-photographer.portofolio.ubah', $portofolio->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="w-full flex items-start justify-between gap-8">
            {{-- KIRI --}}
            <div class="flex-1">
                {{-- JUDUL --}}
                <div class="w-100 mb-4">
                    <div class="w-100">
                        <div class="w-full p-2 text-xs font-bold bg-pink @error('judul') bg-red-500 @enderror text-white flex items-center justify-start rounded-t">
                            Judul
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
                <div class="w-100 mb-4">
                    <div class="w-100">
                        <div class="w-full p-2 text-xs font-bold bg-pink @error('tanggal') bg-red-500 @enderror text-white flex items-center justify-start rounded-t">
                            Tanggal
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

                {{-- DETAIL --}}
                <div class="w-100 mb-4">
                    <div class="w-100">
                        <div class="w-full p-2 text-xs font-bold bg-pink @error('detail') bg-red-500 @enderror text-white flex items-center justify-start rounded-t">
                            Detail
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

                <div class="grid grid-cols-2 gap-4">
                    {{-- PROVINSI --}}
                    <div class="relative w-100">
                        <div class="w-100">
                            <div class="w-full p-2 text-xs font-bold bg-pink @error('provinsi') bg-red-500 @enderror text-white flex items-center justify-start rounded-t">
                                Provinsi
                            </div>
                            <input class="w-full p-2 flex-1 border-x-2 border-b-2 text-sm @error('provinsi') border-red-500 @enderror rounded-b focus:border-pink focus:outline-none"
                                type="text" name="provinsi" id="provinsi" placeholder="Bali"
                                required
                                value="{{ old('provinsi', $provinsi) }}">
                        </div>

                        <div class="mt-1 text-sm text-red-500 flex items-center justify-start gap-2">
                            @error('provinsi')
                                <i class="fa-solid fa-circle-info"></i>
                                <span>{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    {{-- KOTA --}}
                    <div class="relative w-100">
                        <div class="w-100">
                            <div class="w-full p-2 text-xs font-bold bg-pink @error('kota') bg-red-500 @enderror text-white flex items-center justify-start rounded-t">
                                Kota/Kabupaten
                            </div>
                            <input class="w-full p-2 flex-1 border-x-2 border-b-2 text-sm @error('kota') border-red-500 @enderror rounded-b focus:border-pink focus:outline-none"
                                type="text" name="kota" id="kota" placeholder="Badung"
                                required
                                value="{{ old('kota', $kota) }}">
                        </div>

                        <div class="mt-1 text-sm text-red-500 flex items-center justify-start gap-2">
                            @error('kota')
                                <i class="fa-solid fa-circle-info"></i>
                                <span>{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    {{-- KECAMATAN --}}
                    <div class="relative w-100">
                        <div class="w-100">
                            <div class="w-full p-2 text-xs font-bold bg-pink @error('kecamatan') bg-red-500 @enderror text-white flex items-center justify-start rounded-t">
                                Kecamatan
                            </div>
                            <input class="w-full p-2 flex-1 border-x-2 border-b-2 text-sm @error('kecamatan') border-red-500 @enderror rounded-b focus:border-pink focus:outline-none"
                                type="text" name="kecamatan" id="kecamatan" placeholder="Kuta Selatan"
                                required
                                value="{{ old('kecamatan', $kecamatan) }}">
                        </div>

                        <div class="mt-1 text-sm text-red-500 flex items-center justify-start gap-2">
                            @error('kecamatan')
                                <i class="fa-solid fa-circle-info"></i>
                                <span>{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    {{-- KELURAHAN --}}
                    <div class="relative w-100">
                        <div class="w-100">
                            <div class="w-full p-2 text-xs font-bold bg-pink @error('kelurahan') bg-red-500 @enderror text-white flex items-center justify-start rounded-t">
                                Kelurahan
                            </div>
                            <input class="w-full p-2 flex-1 border-x-2 border-b-2 text-sm @error('kelurahan') border-red-500 @enderror rounded-b focus:border-pink focus:outline-none"
                                type="text" name="kelurahan" id="kelurahan" placeholder="Jimbaran"
                                required
                                value="{{ old('kelurahan', $kelurahan) }}">
                        </div>

                        <div class="mt-1 text-sm text-red-500 flex items-center justify-start gap-2">
                            @error('kelurahan')
                                <i class="fa-solid fa-circle-info"></i>
                                <span>{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    {{-- ALAMAT --}}
                    <div class="relative w-100 mb-4 col-span-2">
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

            <div class="hidden">
                <input type="text" name="form-info" id="form-info" value="edit">
            </div>

            {{-- KANAN --}}
            <div class="flex-1">
                {{-- UPLOAD MULTI FOTO --}}
                <div class="w-100 mb-4">
                    <button class="w-full px-4 py-2 rounded text-white font-semibold text-sm {{ $count >= 5 ? 'cursor-not-allowed' : '' }} bg-pink hover:bg-pink-hover focus:bg-pink-hover active:bg-pink-active disabled:bg-slate-400 transition-colors"
                        type="button" id="unggahFotoBtn"
                        {{ $count >= 5 ? 'disabled' : '' }}>
                        <i class="fa-solid fa-plus"></i>
                        Unggah Foto
                    </button>

                    <input class="hidden" type="file" name="foto" id="foto" accept="image/*" value="{{ old('foto', '') }}">

                    <div class="mt-1 text-sm text-red-500 flex items-center justify-start gap-2">
                        @error('foto')
                            <i class="fa-solid fa-circle-info"></i>
                            <span>{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="w-full mt-4 rounded shadow">
                    <div class="p-2 rounded-t font-semibold bg-slate-100">
                        Galeri
                    </div>

                    <div class="w-full max-h-[350px] grid grid-cols-2 p-2 gap-2 overflow-y-auto"
                        id="image-preview">
                        <div class="relative hidden items-center justify-center rounded bg-slate-100" id="new-image"></div>

                        @foreach ($portofolio->photo as $foto)
                            <div class="relative flex items-center justify-center rounded {{ $foto->rejected ? 'bg-red-500' : 'bg-slate-100' }}">
                                <img class="h-[300px] object-contain"
                                    src="{{ asset($foto->url) }}" alt="Foto Portofolio">

                                @if ($count > 1)
                                    <button class="absolute top-0 right-0 w-8 aspect-square bg-pink rounded text-white"
                                        type="button" onclick="deleteImage({{ $foto->id }})">
                                        <i class="fa-solid fa-xmark"></i>
                                    </button>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        {{-- BUTTON --}}
        <div class="w-100 mt-4 flex items-center justify-end gap-4">
            <a class="w-fit px-4 py-2 font-semibold outline-none text-pink bg-white hover:bg-pink hover:text-white focus:bg-pink focus:text-white active:bg-pink-active transition-colors rounded"
                href="{{ route('wedding-photographer.portofolio.index') }}">
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
    <form class="hidden" action="{{ route('wedding-photographer.portofolio.hapus', $portofolio->id) }}" method="post">
        @csrf
        <button id="submitDeleteBtn" type="submit"></button>
    </form>

    {{-- FORM HAPUS FOTO PORTOFOLIO --}}
    @foreach ($portofolio->photo as $foto)
        <form id="deleteImageForm-{{ $foto->id }}" action="{{ route('wedding-photographer.portofolio.hapus-foto', $foto->id) }}" method="post">
            @csrf
        </form>
    @endforeach
@endsection

@push('child-js')
    <script>
        $("#unggahFotoBtn").on("click", function () {
            $("#foto").click();
        });

        $('#deleteBtn').on("click", function () {
            if(confirm('Yakin ingin menghapus portofolio ini?')) {
                $('#submitDeleteBtn').click();
            }
        });

        $('#foto').on('change', function() {
            let files = this.files;
            $('#new-image').empty().removeClass('hidden').addClass('flex');

            for (let i = 0; i < files.length; i++) {
                if (i < 5) {
                    $('#new-image').append(`
                        <img style="height: 300px; object-fit: contain;"
                            src="${URL.createObjectURL(files[i])}" alt="Foto Portofolio">

                        <button class="absolute top-0 right-0 w-8 aspect-square bg-pink rounded text-white"
                            type="button" onclick="deleteNewImage()">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    `);
                }
            }
        });

        function deleteImage(id) {
            if (confirm('Apakah Anda yakin ingin menghapus gambar ini?')) {
                const formId = 'deleteImageForm-' + id;
                const imageForm = document.getElementById(formId);

                if (imageForm) {
                    imageForm.submit();
                }
            }
        }

        function deleteNewImage() {
            $('#new-image').empty().removeClass('flex').addClass('hidden');
        }
    </script>
@endpush
