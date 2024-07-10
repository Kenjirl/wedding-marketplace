@extends('user.layout')

@section('title')
    <title>Cari Paket Layanan | Wedding Marketplace</title>
@endsection

@section('content')
    <div class="w-full max-w-[1600px] mx-auto p-4">
        {{-- TITLE --}}
        <div class="w-full">
            <p class="w-full text-center text-3xl">
                Cari Paket Layanan
            </p>
        </div>

        <hr class="my-4">

        <div class="w-full flex items-start justify-between gap-8">
            {{-- FILTER --}}
            <div class="w-[500px] min-h-[400px] p-4 rounded-lg border shadow">
                {{-- FILTER FORM --}}
                <form action="{{ route('user.search.paket-layanan') }}" method="get">
                    @csrf
                    <div class="w-full flex flex-col items-end justify-center gap-4">
                        {{-- Judul --}}
                        <div class="w-full text-center text-xl">
                            <span>Filter</span>
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
                                    $nama_layanan !== null ||
                                    $nama_vendor !== null ||
                                    $search_harga !== null ||
                                    $search_basis_operasi !== null ||
                                    $search_kota_operasi !== null ||
                                    $search_jenis_vendor !== null
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

            {{-- WO CARDS --}}
            <div class="w-full grid grid-cols-4 gap-4">
                @forelse ($filteredPlans as $plan)
                    <a class="relative w-full rounded-lg outline-none hover:shadow-lg hover:-translate-y-2 focus:shadow-lg focus:-translate-y-2 transition-all"
                    href="{{ route('user.search.ke_detail', $plan->w_vendor->id) }}?tab=booking&id_layanan={{ $plan->id }}">
                        {{-- GAMBAR --}}
                        <div class="w-full p-2 pb-0">
                            @if ($plan->jenis_layanan == 'produk')
                                <img class="w-full aspect-video object-cover object-center rounded-lg"
                                    src="{{ asset($plan->foto[0]['url']) }}" alt="">
                            @else
                                <span class="w-full aspect-video bg-slate-300 flex items-center justify-center text-[2em] font-bold text-white rounded-lg">
                                    <i class="fa-regular fa-image"></i>
                                </span>
                            @endif
                        </div>

                        <div class="w-full p-2 pt-0">
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

                            {{-- BASIS/KOTA OPERASI --}}
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
