@extends('user.wedding-couple.layout')

@section('title')
    <title>Find Wedding Organizer | Wedding Marketplace</title>
@endsection

@section('content')
    <div class="w-full max-w-[1200px] mx-auto p-4">
        {{-- TITLE --}}
        <div class="w-full mb-4">
            <p class="w-full text-center">
                Wedding Organizer
            </p>
        </div>

        {{-- SEARCH --}}
        <div class="w-full p-4 rounded-lg shadow">
            <form action="{{ route('wedding-couple.search.wo.index') }}" method="get">
                @csrf
                <div class="w-full flex items-center justify-center gap-4">
                    {{-- CARI KATEGORI --}}
                    <div class="w-1/5 flex items-center justify-start">
                        <div class="w-fit px-4 py-2 rounded-s bg-pink text-white">
                            <i class="fa-solid fa-hashtag"></i>
                        </div>
                        <select class="w-full p-2 text-sm text-gray-500 border-y-2 border-t-transparent border-b-gray-200 appearance-none outline-none focus:ring-0 focus:border-b-pink transition-colors"
                            name="kategori" id="kategori">
                            @if (!$categories->isEmpty())
                                <option value="" selected>
                                    Pilih Kategori
                                </option>
                                @foreach ($categories as $kategori)
                                    @if ($search_kategori !== null && (int)$search_kategori === $kategori->id))
                                        <option value="{{ $kategori->id }}" selected>
                                            {{ $kategori->nama }}
                                        </option>
                                    @else
                                        <option value="{{ $kategori->id }}">
                                            {{ $kategori->nama }}
                                        </option>
                                    @endif
                                @endforeach
                            @else
                                <option value="" selected>
                                    Tidak ada kategori
                                </option>
                            @endif
                        </select>
                    </div>

                    {{-- CARI HARGA --}}
                    <div class="w-1/5 flex items-center justify-start">
                        <div class="w-fit px-4 py-2 rounded-s bg-pink text-white">
                            <i class="fa-solid fa-rupiah-sign"></i>
                        </div>
                        <input class="w-full p-2 text-sm text-gray-500 border-y-2 border-t-transparent border-b-gray-200 appearance-none outline-none focus:ring-0 focus:border-b-pink transition-colors"
                            type="number" name="harga" id="harga" placeholder="Budget (Rp)" min="0"
                            value="{{ $search_harga === null ? '' : $search_harga }}">
                    </div>

                    {{-- BASIS OPERASI --}}
                    <div class="w-1/5 flex items-center justify-start">
                        <div class="w-fit px-4 py-2 rounded-s bg-pink text-white">
                            <i class="fa-regular fa-circle-dot"></i>
                        </div>
                        <select class="w-full p-2 text-sm text-gray-500 border-y-2 border-t-transparent border-b-gray-200 appearance-none outline-none focus:ring-0 focus:border-b-pink transition-colors"
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
                    <div class="w-1/5 items-center justify-start {{ $search_basis_operasi !== 'Hanya di Dalam Kota' ? 'hidden' : 'flex' }}"
                        id="kotaOperasiContainer">
                        <div class="w-fit px-4 py-2 rounded-s bg-pink text-white">
                            <i class="fa-solid fa-location-crosshairs"></i>
                        </div>
                        <input class="w-full p-2 text-sm text-gray-500 border-y-2 border-t-transparent border-b-gray-200 appearance-none outline-none focus:ring-0 focus:border-b-pink transition-colors"
                            type="text" name="kota_operasi" id="kota_operasi" placeholder="Kota Operasi"
                            {{ $search_basis_operasi !== 'Hanya di Dalam Kota' ? 'disabled' : 'required' }}
                            value="{{ $search_kota_operasi === null ? '' : $search_kota_operasi }}">
                    </div>

                    {{-- SUBMIT --}}
                    <button class="w-fit px-4 py-2 rounded outline-none bg-pink text-white hover:bg-pink-hover focus:bg-pink-hover active:bg-pink-active transition-colors"
                        type="submit">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>

                    {{-- HAPUS FILTER --}}
                    @if ($search_kategori !== null || $search_harga !== null || $search_basis_operasi !== null || $search_kota_operasi !== null)
                        <a class="w-fit px-4 py-2 rounded outline-none text-pink hover:bg-pink-hover hover:text-white focus:bg-pink-hover focus:text-white active:bg-pink-active transition-colors"
                            href="{{ route('wedding-couple.search.wo.index') }}">
                            <i class="fa-solid fa-xmark"></i>
                        </a>
                    @endif
                </div>
            </form>
        </div>

        {{-- WO CARDS --}}
        <div class="w-full p-8 grid grid-cols-4 gap-8">
            @forelse ($filteredOrganizers as $organizer)
                <a class="w-full rounded-lg outline-none shadow hover:shadow-lg hover:-translate-y-2 focus:shadow-lg focus:-translate-y-2 transition-all"
                    href="{{ route('wedding-couple.search.wo.ke_detail', $organizer->id) }}">
                    <div class="w-full">
                        {{-- GAMBAR --}}
                        <div class="w-full">
                            @if ($organizer->foto_profil)
                                <img class="w-full aspect-video object-cover object-center rounded-t-lg"
                                    src="{{ asset($organizer->foto_profil) }}" alt="">
                            @else
                                <span class="w-full aspect-video bg-pink flex items-center justify-center text-[5em] font-bold text-white rounded-t-lg">
                                    {{ substr($organizer->nama_perusahaan, 0, 1) }}
                                </span>
                            @endif
                        </div>

                        <div class="w-full p-2">
                            {{-- NAMA ORGANIZER --}}
                            <div>
                                <span class="text-xl font-semibold line-clamp-1">
                                    {{ $organizer->nama_perusahaan }}
                                </span>
                            </div>

                            {{-- RANGE HARGA --}}
                            <div class="my-2">
                                <p>
                                    {{
                                        'Rp ' . number_format($organizer->harga_terendah, 0, ',', '.') .
                                        ' ~ ' .
                                        'Rp ' . number_format($organizer->harga_tertinggi, 0, ',', '.')
                                    }}
                                </p>
                            </div>

                            {{-- BASIS/KOTA OPERASI --}}
                            <div class="w-full mb-3">
                                @if ($organizer->basis_operasi == 'Hanya di Dalam Kota')
                                    <div class="w-fit px-2 py-1 text-xs border border-pink rounded">
                                        <i class="fa-solid fa-location-dot text-pink"></i>
                                        <span>
                                            {{ $organizer->kota_operasi }}
                                        </span>
                                    </div>
                                @else
                                    <div class="w-fit px-2 py-1 text-xs border border-pink rounded">
                                        <i class="fa-solid fa-location-dot text-pink"></i>
                                        <span>
                                            {{ $organizer->basis_operasi }}
                                        </span>
                                    </div>
                                @endif
                            </div>

                            {{-- KATEGORI --}}
                            <div class="w-full overflow-x-auto pb-1 flex items-start justify-start gap-2">
                                @forelse ($organizer->categories as $ktg)
                                    <div class="w-fit px-2 py-1 text-xs border border-pink rounded-full whitespace-nowrap">
                                        <i class="fa-solid fa-hashtag text-pink"></i>
                                        <span>
                                            {{ $ktg->w_categories->nama }}
                                        </span>
                                    </div>
                                @empty
                                    <div class="w-fit px-2 py-1 text-xs border border-pink rounded-full">
                                        <i class="fa-solid fa-hashtag text-pink"></i>
                                        <span>
                                            tidak ada kategori
                                        </span>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </a>
            @empty
                <div class="w-full">
                    Tidak ada organizer
                </div>
            @endforelse
        </div>
    </div>
@endsection

@push('child-js')
    <script>
        $(document).ready(function() {
            // Fungsi yang akan dijalankan saat halaman selesai di-load
            var selectedValue = $('#basis_operasi').val();

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
            var selectedValue = $(this).val();

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
    </script>
@endpush
