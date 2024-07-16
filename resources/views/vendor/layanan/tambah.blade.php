@extends('vendor.layout')

@section('title')
    <title>Tambah Layanan | Wedding Marketplace</title>
@endsection

@section('h1', 'Layanan > Tambah Layanan')

@section('content')
    <form action="{{ route('vendor.layanan.tambah') }}" method="post" enctype="multipart/form-data" autocomplete="off">
        @csrf
        {{-- BUTTON --}}
        <div class="w-full flex items-center justify-between">
            <a class="block w-fit px-4 py-2 font-semibold outline-none text-pink bg-white hover:bg-pink hover:text-white focus:bg-pink focus:text-white active:bg-pink-active transition-colors rounded"
                href="{{ route('vendor.layanan.index') }}">
                <i class="fa-solid fa-arrow-left-long"></i>
                <span>Kembali</span>
            </a>

            <button class="w-fit px-4 py-2 rounded text-white font-semibold bg-pink hover:bg-pink-hover focus:bg-pink-hover active:bg-pink-active focus:outline-pink-hover focus:outline-offset-2 disabled:bg-slate-500 disabled:cursor-not-allowed transition-colors"
                type="submit">
                <i class="fa-regular fa-floppy-disk"></i>
                <span>Simpan</span>
            </button>
        </div>

        <hr class="my-4">

        {{-- INPUT --}}
        <div class="w-full flex items-start justify-center gap-8 mb-4">
            <div class="w-full">
                {{-- NAMA --}}
                <div class="w-full mb-4">
                    <div class="w-full">
                        <div class="w-full p-2 text-xs font-bold bg-pink @error('nama') bg-red-500 @enderror text-white flex items-center justify-start rounded-t">
                            <i class="fa-solid fa-gift"></i>
                            <span class="ml-2">
                                Nama Paket
                            </span>
                        </div>
                        <input class="w-full p-2 flex-1 border-x-2 border-b-2 text-sm @error('nama') border-red-500 @enderror rounded-b focus:border-pink focus:outline-none"
                            type="text" name="nama" id="nama" placeholder="nama"
                            value="{{ old('nama', '') }}"
                            required>
                    </div>

                    <div class="mt-1 text-sm text-red-500 flex items-center justify-start gap-2">
                        @error('nama')
                            <i class="fa-solid fa-circle-info"></i>
                            <span>{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                {{-- JENIS VENDOR PAKET --}}
                <div class="w-full mb-4">
                    <div class="w-full">
                        <div class="w-full p-2 text-xs font-bold bg-pink @error('j_vendor') bg-red-500 @enderror text-white flex items-center justify-start rounded-t">
                            <i class="fa-regular fa-circle-dot"></i>
                            <span class="ml-2">
                                Jenis Vendor Paket
                            </span>
                        </div>
                        <select class="w-full p-2 flex-1 border-x-2 border-b-2 text-sm @error('j_vendor') border-red-500 @enderror rounded-b focus:border-pink outline-none"
                            name="j_vendor" id="j_vendor" required>
                            <option value="" selected>Pilih Jenis Vendor</option>
                            @foreach ($j_vendors as $jenis)
                                <option value="{{ $jenis->m_jenis_vendor_id }}" {{ old('j_vendor') == $jenis->m_jenis_vendor_id ? 'selected' : '' }}>
                                    {{ $jenis->master->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mt-1 text-sm text-red-500 flex items-center justify-start gap-2">
                        @error('j_vendor')
                            <i class="fa-solid fa-circle-info"></i>
                            <span>{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                {{-- HARGA --}}
                <div class="w-full mb-4">
                    <div class="w-full">
                        <div class="w-full p-2 text-xs font-bold bg-pink @error('harga') bg-red-500 @enderror text-white flex items-center justify-start rounded-t">
                            <i class="fa-solid fa-rupiah-sign"></i>
                            <span class="ml-2">
                                Harga Paket
                            </span>
                        </div>
                        <input class="w-full p-2 flex-1 border-x-2 border-b-2 text-sm @error('harga') border-red-500 @enderror rounded-b focus:border-pink focus:outline-none"
                            type="number" name="harga" id="harga" placeholder="tanpa Rp" min="0"
                            value="{{ old('harga', '') }}"
                            required>
                    </div>

                    <div class="mt-1 text-sm text-red-500 flex items-center justify-start gap-2">
                        @error('harga')
                            <i class="fa-solid fa-circle-info"></i>
                            <span>{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                {{-- SATUAN --}}
                <div class="w-full mb-4">
                    <div class="w-full">
                        <div class="w-full p-2 text-xs font-bold bg-pink @error('satuan') bg-red-500 @enderror text-white flex items-center justify-start rounded-t">
                            <i class="fa-regular fa-circle-dot"></i>
                            <span class="ml-2">
                                Satuan Harga
                            </span>
                        </div>
                        <select class="w-full p-2 flex-1 border-x-2 border-b-2 text-sm @error('satuan') border-red-500 @enderror rounded-b focus:border-pink outline-none"
                            name="satuan" id="satuan" required>
                            <option value="" selected>Pilih Satuan Harga</option>
                            @foreach ($satuans as $category => $options)
                                <optgroup label="{{ $category }}">
                                    @foreach ($options as $option)
                                        <option value="{{ $option }}" {{ old('satuan') == $option ? 'selected' : '' }}>
                                            {{ $option }}
                                        </option>
                                    @endforeach
                                </optgroup>
                            @endforeach
                        </select>
                    </div>

                    <div class="mt-1 text-sm text-red-500 flex items-center justify-start gap-2">
                        @error('satuan')
                            <i class="fa-solid fa-circle-info"></i>
                            <span>{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                {{-- JENIS PAKET --}}
                <div class="w-full mb-4">
                    <div class="w-full">
                        <div class="w-full p-2 text-xs font-bold bg-pink @error('jenis_layanan') bg-red-500 @enderror text-white flex items-center justify-start rounded-t">
                            <i class="fa-regular fa-circle-dot"></i>
                            <span class="ml-2">
                                Jenis Paket
                            </span>
                        </div>
                        <select class="w-full p-2 flex-1 border-x-2 border-b-2 text-sm @error('jenis_layanan') border-red-500 @enderror rounded-b focus:border-pink outline-none"
                            name="jenis_layanan" id="jenis_layanan" required>
                            <option value="jasa" {{ old('jenis_layanan') == 'jasa' ? 'selected' : '' }}>
                                Layanan/Jasa
                            </option>
                            <option value="produk" {{ old('jenis_layanan') == 'produk' ? 'selected' : '' }}>
                                Produk/Barang
                            </option>
                        </select>
                    </div>

                    <div class="mt-1 text-sm text-red-500 flex items-center justify-start gap-2">
                        @error('jenis_layanan')
                            <i class="fa-solid fa-circle-info"></i>
                            <span>{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="w-full">
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
                            name="detail" id="input" rows="3" placeholder="masukan detail paket layanan"
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

        {{-- GAMBAR --}}
        <div id="produkDiv" class="w-full {{ old('jenis_layanan') == 'produk' ? '' : 'hidden' }}">
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
                <div id="image-preview" class="w-full h-[250px] p-2 flex items-center justify-start gap-2 border-x-2 border-slate-100"></div>

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
        </div>
    </form>
@endsection

@push('child-js')
    <script>
        $(document).ready(function() {
            $('#jenis_layanan').change(function() {
                if ($(this).val() === 'produk') {
                    $('#produkDiv').removeClass('hidden');
                } else {
                    $('#produkDiv').addClass('hidden');
                }
            });

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
