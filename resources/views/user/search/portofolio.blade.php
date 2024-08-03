@extends('user.layout')

@section('title')
    <title>Cari Paket Layanan | Wedding Marketplace</title>
@endsection

@section('content')
    <div class="w-full max-w-[1600px] mx-auto p-4 flex items-start justify-between gap-8">
        {{-- FILTER --}}
        <div class="w-[400px] p-4 rounded-lg border shadow">
            {{-- FILTER FORM --}}
            <form action="{{ route('user.search.portofolio') }}" method="get">
                @csrf
                <div class="w-full flex flex-col items-end justify-center gap-4">
                    {{-- Judul --}}
                    <div class="w-full text-center text-xl">
                        <span>Filter Layanan</span>
                    </div>

                    {{-- CARI NAMA PAKET LAYANAN --}}
                    <div class="w-full flex items-center justify-start text-sm">
                        <div class="w-fit px-4 py-2 rounded-s border-2 border-r-0 border-pink bg-pink text-white">
                            <i class="fa-solid fa-gift"></i>
                        </div>
                        <input class="w-full p-2 text-gray-500 border-2 border-l-0 border-gray-200 rounded-e appearance-none outline-none focus:ring-0 focus:border-pink transition-colors"
                            type="text" name="nama_portofolio" id="nama_portofolio" placeholder="nama portofolio" minlength="3"
                            value="{{ $nama_portofolio === null ? '' : $nama_portofolio }}">
                    </div>

                    {{-- CARI NAMA VENDOR --}}
                    <div class="w-full flex items-center justify-start text-sm">
                        <div class="w-fit px-4 py-2 rounded-s border-2 border-r-0 border-pink bg-pink text-white">
                            <i class="fa-solid fa-at"></i>
                        </div>
                        <input class="w-full p-2 text-gray-500 border-2 border-l-0 border-gray-200 rounded-e appearance-none outline-none focus:ring-0 focus:border-pink transition-colors"
                            type="text" name="nama_vendor" id="nama_vendor" placeholder="nama vendor" minlength="3"
                            value="{{ $nama_vendor === null ? '' : $nama_vendor }}">
                    </div>

                    {{-- CARI JENIS VENDOR --}}
                    <div class="w-full flex items-center justify-start text-sm">
                        <div class="w-fit px-4 py-2 rounded-s border-2 border-r-0 border-pink bg-pink text-white">
                            <i class="fa-solid fa-user-tie"></i>
                        </div>
                        <select class="w-full p-2 text-gray-500 border-2 border-l-0 border-gray-200 rounded-e appearance-none outline-none focus:ring-0 focus:border-pink transition-colors"
                            name="search_jenis_vendor" id="search_jenis_vendor">
                            <option value="" selected>Semua Jenis Vendor</option>
                            @forelse ($m_j_vendor as $j_vendor)
                                <option value="{{ $j_vendor->id }}"
                                    {{ $search_jenis_vendor == $j_vendor->id ? 'selected' : '' }}>
                                    {{ $j_vendor->nama }}
                                </option>
                            @empty
                            @endforelse
                        </select>
                    </div>

                    {{-- LOKASI --}}
                    <div class="w-full flex items-center justify-start text-sm">
                        <div class="w-fit px-4 py-2 rounded-s border-2 border-r-0 border-pink bg-pink text-white">
                            <i class="fa-solid fa-location-crosshairs"></i>
                        </div>
                        <input class="w-full p-2 text-gray-500 border-2 border-l-0 border-gray-200 rounded-e appearance-none outline-none focus:ring-0 focus:border-pink transition-colors"
                            type="text" name="search_lokasi" id="search_lokasi" placeholder="Lokasi"
                            value="{{ $search_lokasi === null ? '' : $search_lokasi }}">
                    </div>

                    {{-- SORT BY --}}
                    <div class="w-full flex items-center justify-start text-sm">
                        <div class="w-fit px-4 py-2 rounded-s border-2 border-r-0 border-pink bg-pink text-white">
                            <i class="fa-solid fa-sort"></i>
                        </div>
                        <select class="w-full p-2 text-gray-500 border-2 border-l-0 border-gray-200 rounded-e appearance-none outline-none focus:ring-0 focus:border-pink transition-colors"
                            name="sort_by" id="sort_by">
                            <option value="" selected>
                                Tanpa Urutan
                            </option>
                            <option value="nama" {{ $sort_by == 'nama' ? 'selected' : '' }}>
                                Urut Berdasarkan Portofolio
                            </option>
                            <option value="w_vendor.nama" {{ $sort_by == 'w_vendor.nama' ? 'selected' : '' }}>
                                Urut Berdasarkan Vendor
                            </option>
                            <option value="tanggal" {{ $sort_by == 'tanggal' ? 'selected' : '' }}>
                                Urut Berdasarkan Tanggal
                            </option>
                        </select>
                    </div>

                    {{-- SORT AS --}}
                    <div class="w-full {{ $sort_by == '' ? 'hidden' : 'flex' }} items-center justify-start text-sm"
                        id="sortAsContainer">
                        <div class="w-fit px-4 py-2 rounded-s border-2 border-r-0 border-pink bg-pink text-white">
                            <i class="fa-solid fa-arrow-down-short-wide"></i>
                        </div>
                        <select class="w-full p-2 text-gray-500 border-2 border-l-0 border-gray-200 rounded-e appearance-none outline-none focus:ring-0 focus:border-pink transition-colors"
                            name="sort_as" id="sort_as">
                            <option value="asc" selected>
                                Urut Dari Terkecil (A-Z, 1-9)
                            </option>
                            <option value="desc" {{ $sort_as == 'desc' ? 'selected' : '' }}>
                                Urut Dari Terbesar (Z-A, 9-1)
                            </option>
                        </select>
                    </div>

                    {{-- TOMBOL --}}
                    <div class="w-full flex items-start justify-end gap-2">
                        {{-- HAPUS FILTER --}}
                        @if (
                                $nama_portofolio !== null ||
                                $nama_vendor !== null ||
                                $search_lokasi !== null ||
                                $search_jenis_vendor !== null ||
                                $sort_by !== '' ||
                                $sort_as !== 'asc'
                            )
                            <a class="w-fit px-4 py-2 rounded outline-none text-pink hover:bg-pink-hover hover:text-white focus:bg-pink-hover focus:text-white active:bg-pink-active transition-colors"
                                href="{{ route('user.search.portofolio') }}">
                                <i class="fa-solid fa-xmark"></i>
                            </a>
                        @endif

                        {{-- SUBMIT --}}
                        <button class="w-fit px-4 py-2 rounded outline-none bg-pink text-white hover:bg-pink-hover focus:bg-pink-hover active:bg-pink-active transition-colors"
                            type="submit">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>

        {{-- PORTOFOLIO CARDS --}}
        <div class="w-full grid grid-cols-4 gap-4">
            @forelse ($portofolios as $portofolio)
                <a class="relative w-full p-2 rounded-lg outline-none hover:shadow-lg hover:-translate-y-2 focus:shadow-lg focus:-translate-y-2 transition-all"
                href="{{ route('user.search.ke_detail', $portofolio->w_vendor->id) }}?portofolio_id={{ $portofolio->id }}">
                    {{-- GAMBAR --}}
                    <div class="w-full mb-2">
                        <img class="w-full aspect-video object-cover object-center rounded-lg"
                            src="{{ asset($portofolio->foto[0]['url']) }}" alt="">
                    </div>

                    <div class="w-full">
                        {{-- NAMA portofolio --}}
                        <div>
                            <span class="text-xl font-semibold line-clamp-1">
                                {{ $portofolio->judul }}
                            </span>
                        </div>

                        <hr class="my-2">

                        <div>
                            <p class="w-full text-sm">
                                {{ $portofolio->lokasi }} <br>
                                {{ \Carbon\Carbon::parse($portofolio->tanggal)->translatedFormat('l, d F Y') }}
                            </p>
                        </div>

                        <hr class="my-2">

                        {{-- NAMA VENDOR --}}
                        <div class="w-full mb-2">
                            <div class="w-fit px-2 py-1 text-xs border border-pink rounded">
                                <i class="fa-solid fa-user-tie text-pink"></i>
                                <span>
                                    {{ $portofolio->w_vendor->nama }}
                                </span>
                            </div>
                        </div>

                        {{-- JENIS VENDOR --}}
                        <div class="w-full mb-2">
                            <div class="w-fit px-2 py-1 text-xs border border-pink rounded">
                                <i class="{{ $portofolio->jenis->icon }} text-pink"></i>
                                <span>
                                    {{ $portofolio->jenis->nama }}
                                </span>
                            </div>
                        </div>
                    </div>
                </a>
            @empty
                <div class="w-full">
                    Tidak ada portofolio
                </div>
            @endforelse
        </div>
    </div>
@endsection

@push('child-js')
    <script>
        $('#sort_by').on('change', function() {
            if ($(this).val() !== '') {
                $('#sortAsContainer').removeClass('hidden').addClass('flex');
            } else {
                $('#sortAsContainer').removeClass('flex').addClass('hidden');
            }
        });
    </script>
@endpush
