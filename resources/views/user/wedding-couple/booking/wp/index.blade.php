@extends('user.wedding-couple.layout')

@section('title')
    <title>Find Wedding Photographer | Wedding Marketplace</title>
@endsection

@section('content')
    <div class="w-full max-w-[1200px] mx-auto p-4">
        {{-- TITLE --}}
        <div class="w-full mb-4">
            <p class="w-full text-center">
                Wedding Photographer
            </p>
        </div>

        {{-- SEARCH --}}
        <div class="w-full p-4 rounded-lg shadow">
            <form action="{{ route('wedding-couple.search.wp.index') }}" method="get">
                @csrf
                <div class="w-full flex items-center justify-center gap-4">

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
                    @if ($search_harga !== null || $search_basis_operasi !== null || $search_kota_operasi !== null)
                        <a class="w-fit px-4 py-2 rounded outline-none text-pink hover:bg-pink-hover hover:text-white focus:bg-pink-hover focus:text-white active:bg-pink-active transition-colors"
                            href="{{ route('wedding-couple.search.wp.index') }}">
                            <i class="fa-solid fa-xmark"></i>
                        </a>
                    @endif
                </div>
            </form>
        </div>

        {{-- WO CARDS --}}
        <div class="w-full p-8 grid grid-cols-4 gap-8">
            @forelse ($filteredPhotographers as $photographer)
                <a class="w-full rounded-lg outline-none shadow hover:shadow-lg hover:-translate-y-2 focus:shadow-lg focus:-translate-y-2 transition-all"
                    href="{{ route('wedding-couple.search.wp.ke_detail', $photographer->id) }}">
                    <div class="w-full">
                        {{-- GAMBAR --}}
                        <div class="w-full">
                            @if ($photographer->foto_profil)
                                <img class="w-full aspect-video object-cover object-center rounded-t-lg"
                                    src="{{ asset($photographer->foto_profil) }}" alt="">
                            @else
                                <span class="w-full aspect-video bg-pink flex items-center justify-center text-[5em] font-bold text-white rounded-t-lg">
                                    {{ substr($photographer->nama, 0, 1) }}
                                </span>
                            @endif
                        </div>

                        <div class="w-full p-2">
                            {{-- NAMA ORGANIZER --}}
                            <div>
                                <span class="text-xl font-semibold line-clamp-1">
                                    {{ $photographer->nama }}
                                </span>
                            </div>

                            {{-- RANGE HARGA --}}
                            <div class="my-2">
                                <p>
                                    {{
                                        'Rp ' . number_format($photographer->harga_terendah, 0, ',', '.') .
                                        ' ~ ' .
                                        'Rp ' . number_format($photographer->harga_tertinggi, 0, ',', '.')
                                    }}
                                </p>
                            </div>

                            {{-- BASIS/KOTA OPERASI --}}
                            <div class="w-full mb-3">
                                @if ($photographer->basis_operasi == 'Hanya di Dalam Kota')
                                    <div class="w-fit px-2 py-1 text-xs border border-pink rounded">
                                        <i class="fa-solid fa-location-dot text-pink"></i>
                                        <span>
                                            {{ $photographer->kota_operasi }}
                                        </span>
                                    </div>
                                @else
                                    <div class="w-fit px-2 py-1 text-xs border border-pink rounded">
                                        <i class="fa-solid fa-location-dot text-pink"></i>
                                        <span>
                                            {{ $photographer->basis_operasi }}
                                        </span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </a>
            @empty
                <div class="w-full">
                    Tidak ada photographer
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
