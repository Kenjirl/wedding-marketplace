@extends('vendor.layout')

@section('title')
    <title>Ubah Layanan | Wedding Marketplace</title>
@endsection

@section('h1', 'Layanan > Ubah Layanan')

@section('content')
    <form action="{{ route('vendor.layanan.ubah', $plan->id) }}" method="post" enctype="multipart/form-data" autocomplete="off">
        @csrf
        <div class="w-full">
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
                                value="{{ old('nama', $plan->nama) }}"
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
                            <div class="w-full p-2 text-xs font-bold bg-pink text-white flex items-center justify-start rounded-t">
                                <i class="fa-regular fa-circle-dot"></i>
                                <span class="ml-2">
                                    Jenis Vendor Paket
                                </span>
                            </div>
                            <input class="w-full p-2 flex-1 border-x-2 border-b-2 text-sm rounded-b focus:border-pink focus:outline-none"
                                value="{{ old('nama', $plan->jenis->nama) }}" readonly disabled>
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
                                value="{{ old('harga', $plan->harga) }}"
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
                                            <option value="{{ $option }}" {{ old('satuan', $plan->satuan) == $option ? 'selected' : '' }}>
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

                    {{-- JENIS LAYANAN --}}
                    <div class="w-full mb-4">
                        <div class="w-full">
                            <div class="w-full p-2 text-xs font-bold bg-pink text-white flex items-center justify-start rounded-t">
                                <i class="fa-regular fa-circle-dot"></i>
                                <span class="ml-2">
                                    Jenis Layanan
                                </span>
                            </div>
                            <input class="w-full p-2 flex-1 border-x-2 border-b-2 text-sm rounded-b focus:border-pink focus:outline-none"
                                value="{{ old('nama', $plan->jenis_layanan) }}" readonly disabled>
                        </div>
                    </div>
                </div>

                <div class="w-full">
                    {{-- DETAIL --}}
                    <div class="w-100 mb-4">
                        <div class="w-100">
                            <div class="w-full p-2 text-xs font-bold bg-pink @error('detail') bg-red-500 @enderror text-white flex items-center justify-start rounded-t">
                                <i class="fa-solid fa-circle-info"></i>
                                <span class="ml-2">
                                    Detail
                                </span>
                            </div>
                            <textarea class="w-full p-2 flex-1 border-x-2 border-b-2 resize-none text-sm @error('detail') border-red-500 @enderror rounded-b focus:border-pink focus:outline-none"
                                name="detail" id="input" rows="3" placeholder="masukan detail acara ini"
                                >{{ old('detail', $plan->detail) }}</textarea>
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

            {{-- FOTO --}}
            @if ($plan->jenis_layanan == 'produk')
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
                    <input class="hidden"
                        type="file" name="foto[]" id="foto" accept="image/*" value="{{ old('foto[]', '') }}">

                    {{-- PREVIEW --}}
                    <div class="w-full h-[350px] p-2 flex items-center justify-start gap-2 border-x-2 border-slate-100 overflow-y-auto"
                        id="image-preview">
                        <div class="relative hidden w-1/5 h-full rounded bg-slate-100" id="new-image"></div>

                        @foreach ($plan->foto as $index => $foto)
                            <div class="relative w-1/5 h-full rounded bg-slate-100">
                                <img class="w-full h-full object-contain"
                                    src="{{ asset($foto['url']) }}" alt="Foto Plan">

                                @if (count($plan->foto) > 1)
                                    <button class="absolute top-0 right-0 w-8 aspect-square bg-pink rounded text-white"
                                        type="button" onclick="deleteImage({{ $index }})">
                                        <i class="fa-solid fa-xmark"></i>
                                    </button>
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
            @endif

            {{-- BUTTON --}}
            <div class="w-100 mt-4 flex items-center justify-end gap-4">
                <a class="w-fit px-4 py-2 font-semibold outline-none text-pink bg-white hover:bg-pink hover:text-white focus:bg-pink focus:text-white active:bg-pink-active transition-colors rounded"
                    href="{{ route('vendor.layanan.index') }}">
                    <i class="fa-solid fa-arrow-left-long"></i>
                    <span>Kembali</span>
                </a>

                <button class="w-fit px-4 py-2 font-semibold outline-none text-pink bg-white hover:bg-pink hover:text-white focus:bg-pink focus:text-white active:bg-pink-active transition-colors rounded"
                    id="deleteBtn" type="button" data-layanan="{{ $plan->nama }}">
                    <i class="fa-solid fa-trash-can"></i>
                    <span>Hapus</span>
                </button>

                <button class="w-fit px-4 py-2 rounded text-white font-semibold bg-pink hover:bg-pink-hover focus:bg-pink-hover active:bg-pink-active focus:outline-pink-hover focus:outline-offset-2 transition-colors"
                    type="submit">
                    <i class="fa-regular fa-floppy-disk"></i>
                    <span>Simpan</span>
                </button>
            </div>
        </div>
    </form>

    {{-- FORM HAPUS LAYANAN --}}
    <form class="hidden" action="{{ route('vendor.layanan.hapus', $plan->id) }}" method="post">
        @csrf
        <button id="submitDeleteBtn" type="submit"></button>
    </form>

    {{-- FORM HAPUS FOTO LAYANAN --}}
    @if ($plan->jenis_layanan == 'produk')
        @foreach ($plan->foto as $index => $foto)
            <form id="deleteImageForm-{{ $index }}" action="{{ route('vendor.layanan.hapus-foto', ['id' => $plan->id, 'index' => $index]) }}" method="post">
                @csrf
            </form>
        @endforeach
    @endif
@endsection

@push('child-js')
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
                title: `Hapus layanan ${$(this).data('layanan')}?`,
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
                            src="${URL.createObjectURL(files[i])}" alt="Foto plan">

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

        $(document).ready(function () {
            setImgCount(count);
        });
    </script>
@endpush
