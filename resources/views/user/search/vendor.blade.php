@extends('user.layout')

@section('title')
    <title>Cari Vendor | Wedding Marketplace</title>
@endsection

@section('content')
    <div class="w-full max-w-[1600px] mx-auto p-4">
        {{-- TITLE --}}
        <div class="w-full">
            <p class="w-full text-center text-3xl">
                Cari Vendor
            </p>
        </div>

        <hr class="my-4">

        <div class="w-full flex items-start justify-between gap-8">
            {{-- FILTER --}}
            <div class="w-[500px] min-h-[400px] p-4 rounded-lg border shadow">
                {{-- FILTER FORM --}}
                <form action="{{ route('user.search.vendor') }}" method="get">
                    @csrf
                    <div class="w-full flex flex-col items-end justify-center gap-4">
                        {{-- Judul --}}
                        <div class="w-full text-center text-xl">
                            <span>Filter</span>
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
                                <option value="" selected>Jenis Vendor</option>
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
                                    Basis Operasi
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

                        {{-- TOMBOL --}}
                        <div class="w-full flex items-start justify-end gap-2">
                            {{-- HAPUS FILTER --}}
                            @if (
                                    $nama_vendor !== null ||
                                    $search_harga !== null ||
                                    $search_basis_operasi !== null ||
                                    $search_kota_operasi !== null ||
                                    $search_jenis_vendor !== null
                                )
                                <a class="w-fit px-4 py-2 rounded outline-none text-pink hover:bg-pink-hover hover:text-white focus:bg-pink-hover focus:text-white active:bg-pink-active transition-colors"
                                    href="{{ route('user.search.vendor') }}">
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

            {{-- VENDOR CARDS --}}
            <div class="w-full grid grid-cols-4 gap-8">
                @forelse ($filteredVendors as $vendor)
                    <a class="w-full rounded-lg outline-none shadow hover:shadow-lg hover:-translate-y-2 focus:shadow-lg focus:-translate-y-2 transition-all"
                        href="{{ route('user.search.ke_detail', $vendor->id) }}">
                        <div class="w-full">
                            {{-- GAMBAR --}}
                            <div class="w-full">
                                @if ($vendor->foto_profil)
                                    <img class="w-full aspect-video object-cover object-center rounded-t-lg"
                                        src="{{ asset($vendor->foto_profil) }}" alt="">
                                @else
                                    <span class="w-full aspect-video bg-pink flex items-center justify-center text-[5em] font-bold text-white rounded-t-lg">
                                        {{ substr($vendor->nama, 0, 1) }}
                                    </span>
                                @endif
                            </div>

                            <div class="w-full p-2">
                                {{-- NAMA ORGANIZER --}}
                                <div>
                                    <span class="text-xl font-semibold line-clamp-1">
                                        {{ $vendor->nama }}
                                    </span>
                                </div>

                                {{-- RANGE HARGA --}}
                                <div class="my-2">
                                    <p>
                                        {{
                                            'Rp ' . $vendor->harga_terendah .
                                            ' ~ ' .
                                            'Rp ' . $vendor->harga_tertinggi
                                        }}
                                    </p>
                                </div>

                                <hr class="my-2">

                                {{-- BASIS/KOTA OPERASI --}}
                                <div class="w-full mb-2 flex items-center justify-start gap-1 flex-wrap">
                                    @forelse ($vendor->jenis as $j_vendor)
                                        <div class="w-fit px-2 py-1 text-xs border border-pink rounded">
                                            <i class="{{ $j_vendor->master->icon }} text-pink"></i>
                                            <span>
                                                {{ $j_vendor->master->nama }}
                                            </span>
                                        </div>
                                    @empty

                                    @endforelse
                                </div>

                                <hr class="my-2">

                                {{-- BASIS/KOTA OPERASI --}}
                                <div class="w-full mb-2">
                                    @if ($vendor->basis_operasi == 'Hanya di Dalam Kota')
                                        <div class="w-fit px-2 py-1 text-xs border border-pink rounded">
                                            <i class="fa-solid fa-location-dot text-pink"></i>
                                            <span>
                                                {{ $vendor->kota_operasi }}
                                            </span>
                                        </div>
                                    @else
                                        <div class="w-fit px-2 py-1 text-xs border border-pink rounded">
                                            <i class="fa-solid fa-location-dot text-pink"></i>
                                            <span>
                                                {{ $vendor->basis_operasi }}
                                            </span>
                                        </div>
                                    @endif
                                </div>

                                {{-- RATING --}}
                                <div class="w-full">
                                    <p class="text-sm">
                                        <i class="fa-solid fa-star text-pink"></i>
                                        {{ $vendor->rate > 0 ? number_format($vendor->rate, 1, ',') : '-' }}/5
                                        @if ($vendor->bookedCount > 0)
                                            | {{ $vendor->bookedCount }} dipesan
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="w-full">
                        Tidak ada vendor
                    </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection

@push('child-js')
    <script>
        $(document).ready(function() {
            // Fungsi yang akan dijalankan saat halaman selesai di-load
            let selectedValue = $('#basis_operasi').val();

            // Tentukan apakah div terluar dari Kota Operasi harus hidden atau flex
            if (selectedValue === 'Hanya di Dalam Kota') {
                $('#kotaOperasiContainer').removeClass('hidden').addClass('flex');
                $('#kota_operasi').prop('disabled', false);
                $('#kota_operasi').prop('required', true);
            } else {
                $('#kotaOperasiContainer').removeClass('flex').addClass('hidden');
                $('#kota_operasi').prop('disabled', true);
                $('#kota_operasi').prop('required', false);
            }
        });

        // Menggunakan jQuery untuk mendeteksi perubahan pada basis_operasi
        $('#basis_operasi').on('change', function() {
            // Ambil nilai yang dipilih
            let selectedValue = $(this).val();

            // Tentukan apakah div terluar dari Kota Operasi harus hidden atau flex
            if (selectedValue === 'Hanya di Dalam Kota') {
                $('#kotaOperasiContainer').removeClass('hidden').addClass('flex');
                $('#kota_operasi').prop('disabled', false);
                $('#kota_operasi').prop('required', true);
            } else {
                $('#kotaOperasiContainer').removeClass('flex').addClass('hidden');
                $('#kota_operasi').prop('disabled', true);
                $('#kota_operasi').prop('required', false);
            }
        });

        $('#toggleFilterBtn').on('click', function () {
            let toggleValue = $(this).data("toggle");

            if (toggleValue == false) {
                $("#filterContainer").removeClass("-right-[400px]").addClass("right-0");
                $(this).data("toggle", true);
            } else {
                $("#filterContainer").removeClass("right-0").addClass("-right-[400px]");
                $(this).data("toggle", false);
            }
        });
    </script>
@endpush
