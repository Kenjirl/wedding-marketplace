@extends('user.layout')

@section('title')
    <title>Paket Layanan | Wedding Marketplace</title>
@endsection

@section('content')
    <div class="w-full max-w-[1600px] mx-auto p-4 flex items-start justify-between gap-8">
        {{-- FILTER --}}
        <div class="w-[400px] p-4 rounded-lg border shadow">
            {{-- FILTER FORM --}}
            <form action="{{ route('user.search.paket-layanan') }}" method="get">
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
                            type="text" name="nama_layanan" id="nama_layanan" placeholder="nama paket layanan" minlength="3"
                            value="{{ $nama_layanan === null ? '' : $nama_layanan }}">
                    </div>

                    {{-- CARI JENIS PAKET LAYANAN --}}
                    <div class="w-full flex items-center justify-start text-sm">
                        <div class="w-fit px-4 py-2 rounded-s border-2 border-r-0 border-pink bg-pink text-white">
                            <i class="fa-solid fa-user-tie"></i>
                        </div>
                        <select class="w-full p-2 text-gray-500 border-2 border-l-0 border-gray-200 rounded-e appearance-none outline-none focus:ring-0 focus:border-pink transition-colors"
                            name="jenis_layanan" id="jenis_layanan">
                            <option value="" selected>Semua Paket Layanan</option>
                            <option value="produk" {{ $jenis_layanan == 'produk' ? 'selected' : '' }}>
                                Produk
                            </option>
                            <option value="jasa" {{ $jenis_layanan == 'jasa' ? 'selected' : '' }}>
                                Jasa
                            </option>
                        </select>
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

                    {{-- CARI HARGA --}}
                    <div class="w-full flex items-center justify-start text-sm">
                        <div class="w-fit px-4 py-2 rounded-s border-2 border-r-0 border-pink bg-pink text-white">
                            <i class="fa-solid fa-rupiah-sign"></i>
                        </div>
                        <input class="w-full p-2 text-gray-500 border-2 border-l-0 border-gray-200 rounded-e appearance-none outline-none focus:ring-0 focus:border-pink transition-colors"
                            type="number" name="harga" id="harga" placeholder="Budget (Rp)" min="0"
                            value="{{ $search_harga === null ? '' : $search_harga }}">
                    </div>

                    {{-- BASIS OPERASI --}}
                    <div class="w-full flex items-center justify-start text-sm">
                        <div class="w-fit px-4 py-2 rounded-s border-2 border-r-0 border-pink bg-pink text-white">
                            <i class="fa-regular fa-circle-dot"></i>
                        </div>
                        <select class="w-full p-2 text-gray-500 border-2 border-l-0 border-gray-200 rounded-e appearance-none outline-none focus:ring-0 focus:border-pink transition-colors"
                            name="basis_operasi" id="basis_operasi">
                            <option value="" selected>
                                Semua Basis Operasi
                            </option>
                            <option value="Hanya di Dalam Kota" {{ $search_basis_operasi == 'Hanya di Dalam Kota' ? 'selected' : '' }}>
                                Hanya di Dalam Kota
                            </option>
                            <option value="Bisa ke Luar Kota" {{ $search_basis_operasi == 'Bisa ke Luar Kota' ? 'selected' : '' }}>
                                Bisa ke Luar Kota
                            </option>
                        </select>
                    </div>

                    {{-- KOTA OPERASI --}}
                    <div class="w-full items-center justify-start text-sm {{ $search_basis_operasi !== 'Hanya di Dalam Kota' ? 'hidden' : 'flex' }}"
                        id="kotaOperasiContainer">
                        <div class="w-fit px-4 py-2 rounded-s border-2 border-r-0 border-pink bg-pink text-white">
                            <i class="fa-solid fa-location-crosshairs"></i>
                        </div>
                        <input class="w-full p-2 text-gray-500 border-2 border-l-0 border-gray-200 rounded-e appearance-none outline-none focus:ring-0 focus:border-pink transition-colors"
                            type="text" name="kota_operasi" id="kota_operasi" placeholder="Kota Operasi"
                            {{ $search_basis_operasi !== 'Hanya di Dalam Kota' ? 'disabled' : 'required' }}
                            value="{{ $search_kota_operasi === null ? '' : $search_kota_operasi }}">
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
                                Urut Berdasarkan Paket Layanan
                            </option>
                            <option value="w_vendor.nama" {{ $sort_by == 'w_vendor.nama' ? 'selected' : '' }}>
                                Urut Berdasarkan Vendor
                            </option>
                            <option value="harga" {{ $sort_by == 'harga' ? 'selected' : '' }}>
                                Urut Berdasarkan Harga
                            </option>
                            <option value="rate" {{ $sort_by == 'rate' ? 'selected' : '' }}>
                                Urut Berdasarkan Rate
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
                                $nama_layanan !== null ||
                                $jenis_layanan !== null ||
                                $nama_vendor !== null ||
                                $search_harga !== null ||
                                $search_basis_operasi !== null ||
                                $search_kota_operasi !== null ||
                                $search_jenis_vendor !== null ||
                                $sort_by !== '' ||
                                $sort_as !== 'asc'
                            )
                            <a class="w-fit px-4 py-2 rounded outline-none text-pink hover:bg-pink-hover hover:text-white focus:bg-pink-hover focus:text-white active:bg-pink-active transition-colors"
                                href="{{ route('user.search.paket-layanan') }}">
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

        {{-- PLAN CARDS --}}
        <div class="w-full grid grid-cols-4 gap-4">
            @forelse ($filteredPlans as $plan)
                <a class="relative w-full p-2 rounded-lg outline-none hover:shadow-lg hover:-translate-y-2 focus:shadow-lg focus:-translate-y-2 transition-all"
                href="{{ route('user.search.ke_detail', $plan->w_vendor->id) }}?tab=booking&id_layanan={{ $plan->id }}">
                    {{-- GAMBAR --}}
                    <div class="w-full mb-2">
                        @if ($plan->jenis_layanan == 'produk')
                            <img class="w-full aspect-video object-cover object-center rounded-lg"
                                src="{{ asset($plan->foto[0]['url']) }}" alt="">
                        @else
                            <img class="w-full aspect-video object-cover object-center rounded-lg"
                                src="{{ asset('template/layanan/1.jpg') }}" alt="">
                            {{-- <span class="w-full aspect-video bg-slate-300 flex items-center justify-center text-[2em] font-bold text-white rounded-lg">
                                <i class="fa-regular fa-image"></i>
                            </span> --}}
                        @endif
                    </div>

                    <div class="w-full">
                        {{-- NAMA PLAN --}}
                        <div>
                            <span class="text-xl font-semibold line-clamp-1">
                                {{ $plan->nama }}
                            </span>
                        </div>

                        {{-- RANGE HARGA --}}
                        <div class="my-2">
                            <p class="line-clamp-1 text-end">
                                {{ 'Rp ' . number_format($plan->harga, 0, ',', '.') }}
                            </p>
                        </div>

                        <hr class="my-2">

                        {{-- NAMA VENDOR --}}
                        <div class="w-full mb-2">
                            <div class="w-fit px-2 py-1 text-xs border border-pink rounded">
                                <i class="fa-solid fa-user-tie text-pink"></i>
                                <span>
                                    {{ $plan->w_vendor->nama }}
                                </span>
                            </div>
                        </div>

                        {{-- JENIS PAKET LAYANAN --}}
                        <div class="w-full mb-2">
                            <div class="w-fit px-2 py-1 text-xs border border-pink rounded">
                                <i class="fa-solid fa-hashtag text-pink"></i>
                                <span>
                                    {{ $plan->jenis_layanan }}
                                </span>
                            </div>
                        </div>

                        {{-- JENIS VENDOR --}}
                        <div class="w-full mb-2">
                            <div class="w-fit px-2 py-1 text-xs border border-pink rounded">
                                <i class="{{ $plan->jenis->icon }} text-pink"></i>
                                <span>
                                    {{ $plan->jenis->nama }}
                                </span>
                            </div>
                        </div>

                        {{-- BASIS/KOTA OPERASI --}}
                        <div class="w-full mb-2">
                            @if ($plan->basis_operasi == 'Hanya di Dalam Kota')
                                <div class="w-fit px-2 py-1 text-xs border border-pink rounded">
                                    <i class="fa-solid fa-location-dot text-pink"></i>
                                    <span>
                                        {{ $plan->kota_operasi }}
                                    </span>
                                </div>
                            @else
                                <div class="w-fit px-2 py-1 text-xs border border-pink rounded">
                                    <i class="fa-solid fa-location-dot text-pink"></i>
                                    <span>
                                        {{ $plan->basis_operasi }}
                                    </span>
                                </div>
                            @endif
                        </div>

                        <hr class="my-2">

                        {{-- RATING --}}
                        <div class="w-full">
                            <p class="text-sm text-end">
                                <i class="fa-solid fa-star text-pink"></i>
                                {{ $plan->rate > 0 ? number_format($plan->rate, 1, ',') : '-' }}/5
                                @if ($plan->bookedCount > 0)
                                    | {{ $plan->bookedCount }} dipesan
                                @endif
                            </p>
                        </div>
                    </div>
                </a>
            @empty
                <div class="w-full">
                    Tidak ada paket layanan
                </div>
            @endforelse
        </div>
    </div>
@endsection

@push('child-js')
    <script>
        $('#basis_operasi').on('change', function() {
            if ($(this).val() === 'Hanya di Dalam Kota') {
                $('#kotaOperasiContainer').removeClass('hidden').addClass('flex');
                $('#kota_operasi').prop('disabled', false);
                $('#kota_operasi').prop('required', true);
            } else {
                $('#kotaOperasiContainer').removeClass('flex').addClass('hidden');
                $('#kota_operasi').prop('disabled', true);
                $('#kota_operasi').prop('required', false);
            }
        });

        $('#sort_by').on('change', function() {
            if ($(this).val() !== '') {
                $('#sortAsContainer').removeClass('hidden').addClass('flex');
            } else {
                $('#sortAsContainer').removeClass('flex').addClass('hidden');
            }
        });
    </script>
@endpush
