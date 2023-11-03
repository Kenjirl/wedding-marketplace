@extends('user.admin.layout')

@section('title')
    <title>Ubah Portofolio | Wedding Marketplace</title>
@endsection

@section('h1', 'Portofolio > Ubah Portofolio')

@section('content')
    <form action="{{ route('admin.wp.portofolio.validasi', $portofolio->id) }}" method="post" id="validasiForm">
        @csrf
        <div class="w-full flex items-start justify-between gap-8">
            {{-- KIRI --}}
            <div class="flex-1">
                {{-- JUDUL --}}
                <div class="w-100 mb-4">
                    <div class="w-100">
                        <div class="w-full p-2 text-xs font-bold bg-pink text-white flex items-center justify-start rounded-t">
                            Judul
                        </div>
                        <input class="w-full p-2 flex-1 border-x-2 border-b-2 text-sm rounded-b focus:border-pink focus:outline-none"
                            type="text" readonly disabled
                            value="{{ $portofolio->judul }}">
                    </div>
                </div>

                {{-- PEMBUAT --}}
                <div class="w-100 mb-4">
                    <div class="w-100">
                        <div class="w-full p-2 text-xs font-bold bg-pink text-white flex items-center justify-start rounded-t">
                            Pembuat
                        </div>
                        <input class="w-full p-2 flex-1 border-x-2 border-b-2 text-sm rounded-b focus:border-pink focus:outline-none"
                            type="text" readonly disabled
                            value="{{ $portofolio->w_photographer->nama }}">
                    </div>
                </div>

                {{-- TANGGAL --}}
                <div class="w-100 mb-4">
                    <div class="w-100">
                        <div class="w-full p-2 text-xs font-bold bg-pink text-white flex items-center justify-start rounded-t">
                            Tanggal
                        </div>
                        <input class="w-full p-2 flex-1 border-x-2 border-b-2 text-sm rounded-b focus:border-pink focus:outline-none"
                            type="date" readonly disabled
                            value="{{ $portofolio->tanggal }}">
                    </div>
                </div>

                {{-- DETAIL --}}
                <div class="w-100 mb-4">
                    <div class="w-100">
                        <div class="w-full p-2 text-xs font-bold bg-pink text-white flex items-center justify-start rounded-t">
                            Detail
                        </div>
                        <div class="w-full p-2 flex-1 border-x-2 border-b-2 text-sm rounded-b focus:border-pink focus:outline-none">
                            {!! $portofolio->detail !!}
                        </div>
                    </div>
                </div>

                {{-- LOKASI --}}
                <div class="w-100 mb-4">
                    <div class="w-100">
                        <div class="w-100">
                            <div class="w-full p-2 text-xs font-bold bg-pink text-white flex items-center justify-start rounded-t">
                                Lokasi
                            </div>
                            <input class="w-full p-2 flex-1 border-x-2 border-b-2 text-sm rounded-b focus:border-pink focus:outline-none"
                                type="text" readonly disabled
                                value="{{ $portofolio->lokasi }}">
                        </div>
                    </div>
                    @error('status')
                            <i class="fa-solid fa-circle-info"></i>
                            <span>{{ $message }}</span>
                        @enderror
                </div>

                {{-- STATUS --}}
                <div class="hidden w-100 mb-4">
                    <div class="w-100">
                        <div class="w-100">
                            <input type="text" name="status" id="status" value="">
                        </div>
                    </div>
                </div>
            </div>

            {{-- KANAN --}}
            <div class="flex-1">
                {{-- GALERI --}}
                <div class="w-full rounded shadow">
                    <div class="p-2 rounded-t font-semibold bg-slate-100">
                        Galeri
                    </div>

                    <div class="w-full max-h-[400px] grid grid-cols-2 p-2 gap-2 overflow-y-auto"
                        id="image-preview">
                        @foreach ($portofolio->photo as $foto)
                            <div class="relative flex items-center justify-center rounded bg-slate-100">
                                <img class="h-[300px] object-contain"
                                    src="{{ asset($foto->url) }}" alt="Foto Portofolio">
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        {{-- BUTTON --}}
        <div class="w-100 mt-4 flex items-center justify-end gap-4">
            <a class="w-fit px-4 py-2 font-semibold outline-none text-pink bg-white hover:bg-pink hover:text-white focus:bg-pink focus:text-white active:bg-pink-active transition-colors rounded"
                href="{{ route('admin.wp.portofolio.index') }}">
                <i class="fa-solid fa-arrow-left-long"></i>
                <span>Kembali</span>
            </a>

            <button class="w-fit px-4 py-2 font-semibold outline-none text-red-400 bg-white hover:bg-red-400 hover:text-white focus:bg-red-400 focus:text-white active:bg-red-200 transition-colors rounded"
                id="rejectBtn" type="button" onclick="kirim('ditolak')">
                <i class="fa-solid fa-ban"></i>
                <span>Tolak</span>
            </button>

            <button class="w-fit px-4 py-2 font-semibold outline-none text-blue-400 bg-white hover:bg-blue-400 hover:text-white focus:bg-blue-400 focus:text-white active:bg-blue-200 transition-colors rounded"
                id="acceptBtn" type="button" onclick="kirim('diterima')">
                <i class="fa-regular fa-circle-check"></i>
                <span>Terima</span>
            </button>
        </div>
    </form>

    <script>
        function kirim(status) {
            console.log(status);
            if (confirm('Apakah Anda yakin ingin menjalankan aksi ini?')) {
                $("#status").val(status);

                const validasiForm = document.getElementById('validasiForm');
                validasiForm.submit();
            }
        }
    </script>
@endsection
