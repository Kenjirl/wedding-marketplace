@extends('user.wedding-couple.layout')

@section('title')
    <title>Buat Pernikahan | Wedding Marketplace</title>
@endsection

@section('content')
    <div class="w-full max-w-[1200px] mx-auto p-4">
        {{-- TITLE --}}
        <div class="w-full mb-4">
            <p class="w-full text-center">
                Buat Pernikahan
            </p>
        </div>

        <div class="w-full">
            <form action="{{ route('wedding-couple.pernikahan.tambah') }}" method="post">
                @csrf
                <div class="w-full">
                    {{-- GROOM & BRIDE --}}
                    <div class="flex-1 w-full flex items-start justify-center gap-4">
                        {{-- GROOM --}}
                        <div class="w-full mb-4">
                            <div class="w-100">
                                <div class="w-full p-2 text-xs font-bold bg-pink @error('groom') bg-red-500 @enderror text-white flex items-center justify-start rounded-t">
                                    <i class="fa-solid fa-mars"></i>
                                    <span class="ml-2">
                                        Pengantin Pria
                                    </span>
                                </div>
                                <input class="w-full p-2 flex-1 border-x-2 border-b-2 text-sm @error('groom') border-red-500 @enderror rounded-b focus:border-pink focus:outline-none"
                                    type="text" name="groom" id="groom" placeholder="Nama Pengantin Pria (tanpa gelar)"
                                    required
                                    value="{{ old('groom', '') }}">
                            </div>

                            <div class="mt-1 text-sm text-red-500 flex items-center justify-start gap-2">
                                @error('groom')
                                    <i class="fa-solid fa-circle-info"></i>
                                    <span>{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        {{-- BRIDE --}}
                        <div class="w-full mb-4">
                            <div class="w-100">
                                <div class="w-full p-2 text-xs font-bold bg-pink @error('bride') bg-red-500 @enderror text-white flex items-center justify-start rounded-t">
                                    <i class="fa-solid fa-venus"></i>
                                    <span class="ml-2">
                                        Pengantin Wanita
                                    </span>
                                </div>
                                <input class="w-full p-2 flex-1 border-x-2 border-b-2 text-sm @error('bride') border-red-500 @enderror rounded-b focus:border-pink focus:outline-none"
                                    type="text" name="bride" id="bride" placeholder="Nama Pengantin Wanita (tanpa gelar)"
                                    required
                                    value="{{ old('bride', '') }}">
                            </div>

                            <div class="mt-1 text-sm text-red-500 flex items-center justify-start gap-2">
                                @error('bride')
                                    <i class="fa-solid fa-circle-info"></i>
                                    <span>{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="w-1/2 mb-4">
                        <div class="w-fit px-4 py-2 bg-pink rounded-t text-white">
                            Perhatian
                        </div>
                        <div class="w-full px-6 py-2 border-2 border-pink">
                            <ol class="list-decimal text-sm">
                                <li>Pilih acara pernikahan yang ingin ditampilkan pada undangan</li>
                                <li>Acara pernikahan dapat dipilih dengan mencentang kotak yang ada di bagian kiri judul acara pernikahan</li>
                                <li>Setiap acara pernikahan dikelompokkan berdasarkan Agama</li>
                                <li>Harap lengkapi data setiap acara pernikahan yang dipilih</li>
                                <li>Rentetan acara pernikahan akan diurutkan berdasarkan waktu pelaksanaan acara</li>
                            </ol>
                        </div>
                    </div>

                    {{-- EVENTS CONTAINER --}}
                    <div class="w-full">
                        {{-- BUTTON FILTER EVENT BERDASARKAN JENIS EVENT --}}
                        <div class="w-full flex items-stretch justify-center">
                            <button class="filter-button w-fit px-4 outline-none rounded-t bg-pink text-white hover:bg-pink hover:text-white focus:bg-pink focus:text-white active:bg-pink-active transition-colors"
                                type="button" data-tippy-content="Umum">
                                <i class="fa-solid fa-xmark"></i>
                                <span>
                                    Umum
                                </span>
                            </button>
                            <button class="filter-button w-fit px-4 py-2 outline-none rounded-t bg-white text-slate-600 hover:bg-pink hover:text-white focus:bg-pink focus:text-white active:bg-pink-active transition-colors"
                                type="button" data-tippy-content="Buddha">
                                <i class="fa-solid fa-dharmachakra"></i>
                                <span>
                                    Buddha
                                </span>
                            </button>
                            <button class="filter-button w-fit px-4 py-2 outline-none rounded-t bg-white text-slate-600 hover:bg-pink hover:text-white focus:bg-pink focus:text-white active:bg-pink-active transition-colors"
                                type="button" data-tippy-content="Hindu">
                                <i class="fa-solid fa-om"></i>
                                <span>
                                    Hindu
                                </span>
                            </button>
                            <button class="filter-button w-fit px-4 py-2 outline-none rounded-t bg-white text-slate-600 hover:bg-pink hover:text-white focus:bg-pink focus:text-white active:bg-pink-active transition-colors"
                                type="button" data-tippy-content="Islam">
                                <i class="fa-solid fa-star-and-crescent"></i>
                                <span>
                                    Islam
                                </span>
                            </button>
                            <button class="filter-button w-fit px-4 py-2 outline-none rounded-t bg-white text-slate-600 hover:bg-pink hover:text-white focus:bg-pink focus:text-white active:bg-pink-active transition-colors"
                                type="button" data-tippy-content="Katolik">
                                <i class="fa-solid fa-cross"></i>
                                <span>
                                    Katolik
                                </span>
                            </button>
                            <button class="filter-button w-fit px-4 py-2 outline-none rounded-t bg-white text-slate-600 hover:bg-pink hover:text-white focus:bg-pink focus:text-white active:bg-pink-active transition-colors"
                                type="button" data-tippy-content="Khonghucu">
                                <i class="fa-solid fa-yin-yang"></i>
                                <span>
                                    Khonghucu
                                </span>
                            </button>
                            <button class="filter-button w-fit px-4 py-2 outline-none rounded-t bg-white text-slate-600 hover:bg-pink hover:text-white focus:bg-pink focus:text-white active:bg-pink-active transition-colors"
                                type="button" data-tippy-content="Protestan">
                                <i class="fa-solid fa-cross"></i>
                                <span>
                                    Protestan
                                </span>
                            </button>
                        </div>

                        {{-- EVENT INPUT --}}
                        <div class="w-full max-h-[80vh] p-4 grid grid-cols-2 gap-4 border-2 border-pink overflow-y-auto">
                            {{-- EVENT PER-AGAMA --}}
                            @foreach ($events as $event)
                                <div class="w-full event-item hidden container-{{ $event->jenis }} container-event-per-agama">
                                    <div class="w-full p-2 flex items-center justify-between bg-slate-200 text-center rounded-t-lg border-2 border-slate-200 border-b-0">
                                        <div class="w-fit flex items-center justify-start gap-2">
                                            <input class="w-4 aspect-square event-checkbox"
                                                id="event_checkbox" type="checkbox" value="" data-id="{{ $event->id }}">
                                        </div>
                                        <div class="flex-1 w-full text-sm text-center">
                                            Tempat & Tanggal {{ ucwords($event->nama) }}
                                        </div>
                                        <div class="w-4 aspect-square flex items-center justify-end cursor-pointer"
                                            data-tippy-content="{{ $event->keterangan }}">
                                            <i class="fa-regular fa-circle-question"></i>
                                        </div>
                                    </div>

                                    <div class="w-full p-2 rounded-b-lg border-2 border-slate-200 border-t-0 input-container-{{ $event->id }}">
                                        {{-- ID EVENT --}}
                                        <input class="hidden"
                                            type="number" name="w_event_id[]" id="w_event_id" value="{{ $event->id }}" disabled>

                                        {{-- TANGGAL --}}
                                        <div class="w-100 mb-4">
                                            <div class="w-100">
                                                <div class="w-full p-2 text-xs font-bold bg-slate-300 @error('waktu[]') bg-red-500 @enderror text-white flex items-center justify-start rounded-t">
                                                    <i class="fa-regular fa-calendar"></i>
                                                    <span class="ml-2">
                                                        Waktu
                                                    </span>
                                                </div>
                                                <input class="w-full p-2 flex-1 border-x-2 border-b-2 text-sm @error('waktu[]') border-red-500 @enderror rounded-b disabled:cursor-not-allowed focus:border-pink focus:outline-none"
                                                    type="datetime-local" name="waktu[]" id="waktu"
                                                    disabled
                                                    value="{{ old('waktu[]') }}">
                                            </div>
                                        </div>

                                        <div class="grid grid-cols-2 gap-4">
                                            {{-- PROVINSI --}}
                                            <div class="relative w-100">
                                                <div class="w-100">
                                                    <div class="w-full p-2 text-xs font-bold bg-slate-300 @error('provinsi[]') bg-red-500 @enderror text-white flex items-center justify-start rounded-t">
                                                        <i class="fa-solid fa-location-dot"></i>
                                                        <span class="ml-2">
                                                            Provinsi
                                                        </span>
                                                    </div>
                                                    <input class="w-full p-2 flex-1 border-x-2 border-b-2 text-sm @error('provinsi[]') border-red-500 @enderror rounded-b disabled:cursor-not-allowed focus:border-pink focus:outline-none"
                                                        type="text" name="provinsi[]" id="provinsi" placeholder="Bali"
                                                        disabled
                                                        value="{{ old('provinsi[]') }}">
                                                </div>
                                            </div>

                                            {{-- KOTA --}}
                                            <div class="relative w-100">
                                                <div class="w-100">
                                                    <div class="w-full p-2 text-xs font-bold bg-slate-300 @error('kota[]') bg-red-500 @enderror text-white flex items-center justify-start rounded-t">
                                                        <i class="fa-solid fa-location-dot"></i>
                                                        <span class="ml-2">
                                                            Kota/Kabupaten
                                                        </span>
                                                    </div>
                                                    <input class="w-full p-2 flex-1 border-x-2 border-b-2 text-sm @error('kota[]') border-red-500 @enderror rounded-b disabled:cursor-not-allowed focus:border-pink focus:outline-none"
                                                        type="text" name="kota[]" id="kota" placeholder="Badung"
                                                        disabled
                                                        value="{{ old('kota[]') }}">
                                                </div>
                                            </div>

                                            {{-- KECAMATAN --}}
                                            <div class="relative w-100">
                                                <div class="w-100">
                                                    <div class="w-full p-2 text-xs font-bold bg-slate-300 @error('kecamatan[]') bg-red-500 @enderror text-white flex items-center justify-start rounded-t">
                                                        <i class="fa-solid fa-location-dot"></i>
                                                        <span class="ml-2">
                                                            Kecamatan
                                                        </span>
                                                    </div>
                                                    <input class="w-full p-2 flex-1 border-x-2 border-b-2 text-sm @error('kecamatan[]') border-red-500 @enderror rounded-b disabled:cursor-not-allowed focus:border-pink focus:outline-none"
                                                        type="text" name="kecamatan[]" id="kecamatan" placeholder="Kuta Selatan"
                                                        disabled
                                                        value="{{ old('kecamatan[]') }}">
                                                </div>
                                            </div>

                                            {{-- KELURAHAN --}}
                                            <div class="relative w-100">
                                                <div class="w-100">
                                                    <div class="w-full p-2 text-xs font-bold bg-slate-300 @error('kelurahan[]') bg-red-500 @enderror text-white flex items-center justify-start rounded-t">
                                                        <i class="fa-solid fa-location-dot"></i>
                                                        <span class="ml-2">
                                                            Kelurahan
                                                        </span>
                                                    </div>
                                                    <input class="w-full p-2 flex-1 border-x-2 border-b-2 text-sm @error('kelurahan[]') border-red-500 @enderror rounded-b disabled:cursor-not-allowed focus:border-pink focus:outline-none"
                                                        type="text" name="kelurahan[]" id="kelurahan" placeholder="Jimbaran"
                                                        disabled
                                                        value="{{ old('kelurahan[]') }}">
                                                </div>
                                            </div>

                                            {{-- ALAMAT --}}
                                            <div class="relative w-100 col-span-2">
                                                <div class="w-100">
                                                    <div class="w-full p-2 text-xs font-bold bg-slate-300 @error('alamat[]') bg-red-500 @enderror text-white flex items-center justify-start rounded-t">
                                                        <i class="fa-solid fa-location-dot"></i>
                                                        <span class="ml-2">
                                                            Alamat Detail
                                                        </span>
                                                    </div>
                                                    <input class="w-full p-2 flex-1 border-x-2 border-b-2 text-sm @error('alamat[]') border-red-500 @enderror rounded-b disabled:cursor-not-allowed focus:border-pink focus:outline-none"
                                                        type="text" name="alamat[]" id="alamat" placeholder="Jl. Besar no. 1"
                                                        disabled
                                                        value="{{ old('alamat[]') }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                            {{-- EVENT UMUM --}}
                            @foreach ($event_umum as $evu)
                                <div class="w-full">
                                    <div class="w-full p-2 flex items-center justify-between bg-slate-200 text-center rounded-t-lg border-2 border-slate-200 border-b-0">
                                        <div class="w-4 flex items-center justify-start gap-2">
                                        </div>
                                        <div class="flex-1 w-full text-sm text-center">
                                            Tempat & Tanggal {{ ucwords($evu->nama) }}
                                        </div>
                                        <div class="w-4 aspect-square flex items-center justify-end cursor-pointer"
                                            data-tippy-content="{{ $evu->keterangan }}">
                                            <i class="fa-regular fa-circle-question"></i>
                                        </div>
                                    </div>

                                    <div class="w-full p-2 rounded-b-lg border-2 border-slate-200 border-t-0">
                                        {{-- ID EVENT --}}
                                        <input class="hidden"
                                            type="number" name="w_event_id[]" id="w_event_id" value="{{ $evu->id }}">

                                        {{-- TANGGAL --}}
                                        <div class="w-100 mb-4">
                                            <div class="w-100">
                                                <div class="w-full p-2 text-xs font-bold bg-pink @error('waktu[]') bg-red-500 @enderror text-white flex items-center justify-start rounded-t">
                                                    <i class="fa-regular fa-calendar"></i>
                                                    <span class="ml-2">
                                                        Waktu
                                                    </span>
                                                </div>
                                                <input class="w-full p-2 flex-1 border-x-2 border-b-2 text-sm @error('waktu[]') border-red-500 @enderror rounded-b focus:border-pink focus:outline-none"
                                                    type="datetime-local" name="waktu[]" id="waktu"
                                                    required
                                                    value="{{ old('waktu[]', '') }}">
                                            </div>
                                        </div>

                                        <div class="grid grid-cols-2 gap-4">
                                            {{-- PROVINSI --}}
                                            <div class="relative w-100">
                                                <div class="w-100">
                                                    <div class="w-full p-2 text-xs font-bold bg-pink @error('provinsi[]') bg-red-500 @enderror text-white flex items-center justify-start rounded-t">
                                                        <i class="fa-solid fa-location-dot"></i>
                                                        <span class="ml-2">
                                                            Provinsi
                                                        </span>
                                                    </div>
                                                    <input class="w-full p-2 flex-1 border-x-2 border-b-2 text-sm @error('provinsi[]') border-red-500 @enderror rounded-b focus:border-pink focus:outline-none"
                                                        type="text" name="provinsi[]" id="provinsi" placeholder="Bali"
                                                        required
                                                        value="{{ old('provinsi[]', '') }}">
                                                </div>
                                            </div>

                                            {{-- KOTA --}}
                                            <div class="relative w-100">
                                                <div class="w-100">
                                                    <div class="w-full p-2 text-xs font-bold bg-pink @error('kota[]') bg-red-500 @enderror text-white flex items-center justify-start rounded-t">
                                                        <i class="fa-solid fa-location-dot"></i>
                                                        <span class="ml-2">
                                                            Kota/Kabupaten
                                                        </span>
                                                    </div>
                                                    <input class="w-full p-2 flex-1 border-x-2 border-b-2 text-sm @error('kota[]') border-red-500 @enderror rounded-b focus:border-pink focus:outline-none"
                                                        type="text" name="kota[]" id="kota" placeholder="Badung"
                                                        required
                                                        value="{{ old('kota[]', '') }}">
                                                </div>
                                            </div>

                                            {{-- KECAMATAN --}}
                                            <div class="relative w-100">
                                                <div class="w-100">
                                                    <div class="w-full p-2 text-xs font-bold bg-pink @error('kecamatan[]') bg-red-500 @enderror text-white flex items-center justify-start rounded-t">
                                                        <i class="fa-solid fa-location-dot"></i>
                                                        <span class="ml-2">
                                                            Kecamatan
                                                        </span>
                                                    </div>
                                                    <input class="w-full p-2 flex-1 border-x-2 border-b-2 text-sm @error('kecamatan[]') border-red-500 @enderror rounded-b focus:border-pink focus:outline-none"
                                                        type="text" name="kecamatan[]" id="kecamatan" placeholder="Kuta Selatan"
                                                        required
                                                        value="{{ old('kecamatan[]', '') }}">
                                                </div>
                                            </div>

                                            {{-- KELURAHAN --}}
                                            <div class="relative w-100">
                                                <div class="w-100">
                                                    <div class="w-full p-2 text-xs font-bold bg-pink @error('kelurahan[]') bg-red-500 @enderror text-white flex items-center justify-start rounded-t">
                                                        <i class="fa-solid fa-location-dot"></i>
                                                        <span class="ml-2">
                                                            Kelurahan
                                                        </span>
                                                    </div>
                                                    <input class="w-full p-2 flex-1 border-x-2 border-b-2 text-sm @error('kelurahan[]') border-red-500 @enderror rounded-b focus:border-pink focus:outline-none"
                                                        type="text" name="kelurahan[]" id="kelurahan" placeholder="Jimbaran"
                                                        required
                                                        value="{{ old('kelurahan[]', '') }}">
                                                </div>
                                            </div>

                                            {{-- ALAMAT --}}
                                            <div class="relative w-100 col-span-2">
                                                <div class="w-100">
                                                    <div class="w-full p-2 text-xs font-bold bg-pink @error('alamat[]') bg-red-500 @enderror text-white flex items-center justify-start rounded-t">
                                                        <i class="fa-solid fa-location-dot"></i>
                                                        <span class="ml-2">
                                                            Alamat Detail
                                                        </span>
                                                    </div>
                                                    <input class="w-full p-2 flex-1 border-x-2 border-b-2 text-sm @error('alamat[]') border-red-500 @enderror rounded-b focus:border-pink focus:outline-none"
                                                        type="text" name="alamat[]" id="alamat" placeholder="Jl. Besar no. 1"
                                                        required
                                                        value="{{ old('alamat[]', '') }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="w-full mt-4 flex items-start justify-center gap-4">
                    <div class="flex-1 w-full">
                        @if($errors->any())
                            <div class="w-fit px-4 py-2 bg-red-500 rounded-t text-white">
                                Terdapat Kesalahan!
                            </div>
                            <div class="w-full px-6 py-2 border-2 border-red-500">
                                <ol class="list-disc text-sm">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ol>
                            </div>
                        @endif
                    </div>

                    <div class="flex-1 w-full flex items-center justify-end gap-4">
                        <a class="w-fit px-4 py-2 font-semibold outline-none text-pink bg-white hover:bg-pink hover:text-white focus:bg-pink focus:text-white active:bg-pink-active transition-colors rounded"
                            href="{{ route('wedding-couple.pernikahan.index') }}">
                            <i class="fa-solid fa-arrow-left-long"></i>
                            <span>Kembali</span>
                        </a>

                        <button class="w-fit px-4 py-2 rounded text-white font-semibold bg-pink hover:bg-pink-hover focus:bg-pink-hover active:bg-pink-active focus:outline-pink-hover focus:outline-offset-2 transition-colors"
                            type="submit">
                            <i class="fa-regular fa-floppy-disk"></i>
                            <span>Simpan</span>
                        </button>
                    </div>
                </div>
            </form>
        </div>

    </div>
@endsection

@push('child-js')
    <script>
        $(document).ready(function () {
            // Tangani klik pada tombol agama
            $('.filter-button').click(function () {
                let agama = 'container-' + $(this).data('tippy-content');

                $('.filter-button').removeClass('bg-pink text-white').addClass('bg-white text-slate-600');
                $(this).removeClass('bg-white text-slate-600').addClass('bg-pink text-white');

                $('.event-checkbox').prop("checked", false);
                let cepa = $('.container-event-per-agama input').not(':checkbox');
                cepa.prop('disabled', true);
                cepa.prop('required', false);

                let pervDiv = cepa.prev('div');
                pervDiv.removeClass('bg-pink').addClass('bg-slate-300');

                // Sembunyikan semua elemen event
                $('.event-item').addClass('hidden');

                // Tampilkan elemen yang sesuai dengan agama yang diklik
                $('.' + agama).removeClass('hidden');
            });

            $('.event-checkbox').change(function () {
                let eventId = $(this).data('id');
                let isChecked = $(this).prop('checked');

                // Temukan semua input yang sesuai dengan ID event
                let inputs = $('.input-container-' + eventId + ' input');

                // Ubah atribut input sesuai dengan status checkbox
                inputs.prop('disabled', !isChecked);
                inputs.prop('required', isChecked);

                let pervDiv = inputs.prev('div');
                if (isChecked) {
                    pervDiv.removeClass('bg-slate-300').addClass('bg-pink');
                } else {
                    pervDiv.removeClass('bg-pink').addClass('bg-slate-300');
                }
            });
        });
        </script>
@endpush
