@extends('user.wedding-photographer.layout')

@section('title')
    <title>Tambah Portofolio | Wedding Marketplace</title>
@endsection

@section('h1', 'Portofolio > Tambah Portofolio')

@section('content')
    <div class="px-4 pb-4">
        <ol class="list-decimal text-sm">
            <li>Silahkan isi detail dari portofolio Anda</li>
            <li>Harap memasukan gambar (maks. 5) secara sekaligus agar gambar dapat tersimpan dengan benar</li>
            <li>Jika gambar lebih dari 5, maka yang akan tersimpan adalah 5 gambar pertama</li>
        </ol>
    </div>

    <form action="{{ route('wedding-photographer.portofolio.tambah') }}" method="post" enctype="multipart/form-data">
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
                <div class="w-100 mb-4">
                    <div class="w-100">
                        <div class="w-full p-2 text-xs font-bold bg-pink @error('tanggal') bg-red-500 @enderror text-white flex items-center justify-start rounded-t">
                            Tanggal
                        </div>
                        <input class="w-full p-2 flex-1 border-x-2 border-b-2 text-sm @error('tanggal') border-red-500 @enderror rounded-b focus:border-pink focus:outline-none"
                            type="date" name="tanggal" id="tanggal" placeholder="Pernikahan Budi dan Ani"
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

                <div class="grid grid-cols-2 gap-4">
                    {{-- PROVINSI --}}
                    <div class="relative w-100">
                        <div class="w-100">
                            <div class="w-full p-2 text-xs font-bold bg-pink @error('provinsi') bg-red-500 @enderror text-white flex items-center justify-start rounded-t">
                                Provinsi
                            </div>
                            <input class="w-full p-2 flex-1 border-x-2 border-b-2 text-sm @error('provinsi') border-red-500 @enderror rounded-b focus:border-pink focus:outline-none"
                                type="text" name="provinsi" id="provinsi" placeholder="Bali"
                                value="{{ old('provinsi', '') }}">
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
                                value="{{ old('kota', '') }}">
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
                                value="{{ old('kecamatan', '') }}">
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
                                value="{{ old('kelurahan', '') }}">
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
                {{-- UPLOAD MULTI FOTO --}}
                <div class="w-100 mb-4">
                    <div class="w-100 mb-4">
                        <button class="w-full px-4 py-2 rounded text-white font-semibold text-sm bg-pink hover:bg-pink-hover focus:bg-pink-hover active:bg-pink-active transition-colors"
                            type="button" id="unggahFotoBtn">
                            <i class="fa-solid fa-plus"></i>
                            Unggah Foto Sampul
                        </button>

                        <input class="hidden" type="file" name="foto" id="foto" accept="image/*" value="{{ old('foto', '') }}">

                        <div class="mt-1 text-sm text-red-500 flex items-center justify-start gap-2">
                            @error('foto')
                                <i class="fa-solid fa-circle-info"></i>
                                <span>{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="w-full mt-4 flex items-start justify-start gap-2 overflow-x-auto"
                    id="image-preview">
                </div>
            </div>
        </div>

        {{-- BUTTON --}}
        <div class="w-100 mt-4 flex items-center justify-end gap-4">
            <a class="w-fit p-2 font-semibold outline-none text-pink bg-white hover:bg-pink hover:text-white focus:bg-pink focus:text-white active:bg-pink-active transition-colors rounded"
                href="{{ route('wedding-photographer.portofolio.index') }}">
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

    <script>
        $("#unggahFotoBtn").on("click", function () {
            $("#foto").click();
        });

        $('#foto').on('change', function() {
            let files = this.files;
            console.log(files)
            $('#image-preview').empty(); // Bersihkan tampilan gambar sebelum menambahkan yang baru

            for (let i = 0; i < files.length; i++) {
                if (i < 1) { // Hanya tampilkan maksimal 1 gambar
                    let img = $('<img>');
                    img.attr('src', URL.createObjectURL(files[i])).addClass('h-[300px] object-fit');

                    $('#image-preview').append(img);
                }
            }
        });
    </script>
@endsection
