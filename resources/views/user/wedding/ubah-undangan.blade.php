@php
    $items = [
        'header'  => 't_header',
        'quote'   => 't_quote',
        'profile' => 't_profile',
        'event'   => 't_event',
        'gallery' => 't_gallery',
        'wish'    => 't_wish',
        'footer'  => 't_footer'
    ];

    if ($invitation->t_quote === '0') {
        unset($items['quote']);
    }

    if ($invitation->t_gallery === '0') {
        unset($items['gallery']);
    }

    $done = $invitation->status == 'selesai' ? true : false;
@endphp

<div class="w-full mb-10">
    <div class="w-full px-4 mb-8">
        {{-- ATAS --}}
        <div class="w-full h-fit p-4 bg-slate-50 rounded-xl shadow">
            <form action="{{ route('user.undangan.ubah', $wedding->invitation->id) }}" method="post" id="editUndanganForm" enctype="multipart/form-data">
                @csrf
                <div class="w-full flex items-start justify-center gap-4">
                    <div class="w-full">
                    {{-- QUOTE --}}
                    @if ($invitation->t_quote !== '0')
                        <div class="w-full">
                            <div class="w-full pt-3 mb-2 font-semibold">
                                Quote
                            </div>

                            <div class="w-full mb-2">
                                <input class="w-full p-2 flex-1 border text-sm @error('quote') border-red-500 @enderror rounded outline-pink"
                                    type="text" name="quote" id="quote" placeholder="masukkan kutipan" maxlength="255"
                                    required {{ $done ? 'readonly' : '' }}
                                    value="{{ old('quote', ($done ? $invitation->c_quote['quote'] : '')) }}">
                                <div class="mt-1 text-sm text-red-500 flex items-center justify-start gap-2">
                                    @error('quote')
                                        <i class="fa-solid fa-circle-info"></i>
                                        <span>{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="w-full">
                                <input class="w-full p-2 flex-1 border text-sm @error('author') border-red-500 @enderror rounded outline-pink"
                                    type="text" name="author" id="author" placeholder="masukan penulis/pengarang/asal kutipan/anonim" maxlength="50"
                                    required {{ $done ? 'readonly' : '' }}
                                    value="{{ old('author', ($done ? $invitation->c_quote['author'] : '')) }}">
                                <div class="mt-1 text-sm text-red-500 flex items-center justify-start gap-2">
                                    @error('author')
                                        <i class="fa-solid fa-circle-info"></i>
                                        <span>{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    @endif

                    <hr class="my-2">

                    {{-- PROFILE --}}
                    <div class="w-full">
                        {{-- ATAS --}}
                        <div class="w-full mb-2 flex items-center justify-between">
                            <div class="font-semibold">
                                Foto Pengantin
                            </div>

                            @if (!$done)
                                <div class="w-fit">
                                    <button class="w-full px-4 py-2 rounded text-white font-semibold text-sm bg-pink
                                            hover:bg-pink-hover focus:bg-pink-hover active:bg-pink-active
                                            disabled:bg-slate-400 disabled:cursor-not-allowed
                                            transition-colors"
                                            type="button" id="unggahFotoProfilBtn">
                                        <i class="fa-solid fa-plus"></i>
                                        Tambah Gambar
                                    </button>
                                </div>
                            @endif
                        </div>

                        {{-- INPUT --}}
                        <input class="hidden" type="file" name="foto_profil[]" id="foto_profil" accept="image/*" multiple value="{{ old('foto_profil[]', '') }}" tabindex="-1">

                        {{-- PREVIEW --}}
                        <div id="image-profil-preview" class="w-full min-h-[350px] p-2 grid grid-cols-2 gap-2 border bg-white overflow-y-auto">
                            @if ($done)
                                <div class="w-full h-full bg-slate-100 rounded">
                                    <a class="cursor-zoom-in" href="{{ asset($invitation->c_profile['foto_pria']) }}" data-fancybox="gallery">
                                        <img class="w-full h-full object-contain"
                                            src="{{ asset($invitation->c_profile['foto_pria']) }}" alt="Foto Pengantin Pria">
                                    </a>
                                </div>
                                <div class="w-full h-full bg-slate-100 rounded">
                                    <a class="cursor-zoom-in" href="{{ asset($invitation->c_profile['foto_wanita']) }}" data-fancybox="gallery">
                                        <img class="w-full h-full object-contain"
                                            src="{{ asset($invitation->c_profile['foto_wanita']) }}" alt="Foto Pengantin Wanita">
                                    </a>
                                </div>
                            @else
                                <div class="w-full h-full flex items-center justify-center bg-slate-100 rounded">
                                    <span id="pengantin-pria" class="text-gray-500">Pengantin Pria</span>
                                </div>
                                <div class="w-full h-full flex items-center justify-center bg-slate-100 rounded">
                                    <span id="pengantin-wanita" class="text-gray-500">Pengantin Wanita</span>
                                </div>
                            @endif
                        </div>

                        {{-- BAWAH --}}
                        @if (!$done)
                            <div class="w-full px-4 py-2 flex items-center justify-between text-sm">
                                <div class="text-red-500 flex items-center justify-start gap-2">
                                    @error('foto_profil')
                                        <i class="fa-solid fa-circle-info"></i>
                                        <span>{{ $message }}</span>
                                    @enderror
                                </div>

                                <div id="jumlahFotoProfil">
                                    <span>0/2</span>
                                </div>
                            </div>
                        @endif
                    </div>
                    </div>

                    @if ($invitation->t_gallery !== '0')
                        {{-- GALLERY --}}
                        <div class="w-full">
                            {{-- ATAS --}}
                            <div class="w-full mb-2 flex items-center justify-between">
                                <div class="font-semibold">
                                    Galeri
                                </div>

                                @if (!$done)
                                    <div class="w-fit">
                                        <button class="w-full px-4 py-2 rounded text-white font-semibold text-sm bg-pink
                                                hover:bg-pink-hover focus:bg-pink-hover active:bg-pink-active
                                                disabled:bg-slate-400 disabled:cursor-not-allowed
                                                transition-colors"
                                                type="button" id="unggahFotoGaleriBtn">
                                            <i class="fa-solid fa-plus"></i>
                                            Tambah Gambar
                                        </button>
                                    </div>
                                @endif
                            </div>

                            {{-- INPUT --}}
                            <input class="hidden" type="file" name="foto_galeri[]" id="foto_galeri" accept="image/*" multiple value="{{ old('foto_galeri[]', '') }}" tabindex="-1">

                            {{-- PREVIEW --}}
                            <div id="image-galeri-preview" class="w-full min-h-[350px] p-2 grid grid-cols-3 gap-2 border bg-white overflow-y-auto">
                                @if ($done)
                                    @foreach ($invitation->c_gallery['photos'] as $foto_galeri)
                                        <div class="w-full h-full bg-slate-100 rounded">
                                            <a class="cursor-zoom-in" href="{{ asset($foto_galeri) }}" data-fancybox="gallery">
                                                <img class="w-full h-full object-contain"
                                                    src="{{ asset($foto_galeri) }}" alt="Foto Undangan {{ $loop->iteration }}">
                                            </a>
                                        </div>
                                    @endforeach
                                @endif
                            </div>

                            {{-- BAWAH --}}
                            @if (!$done)
                                <div class="w-full px-4 py-2 flex items-center justify-between text-sm">
                                    <div class="text-red-500 flex items-center justify-start gap-2">
                                        @error('foto_galeri')
                                            <i class="fa-solid fa-circle-info"></i>
                                            <span>{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div id="jumlahFotoGaleri">
                                        <span>0/6</span>
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endif
                </div>

                @if (!$done)
                    <button class="w-full p-2 rounded text-white font-semibold bg-pink hover:bg-pink-hover focus:bg-pink-hover active:bg-pink-active focus:outline-pink-hover focus:outline-offset-2 transition-colors"
                        type="submit">
                        Simpan
                    </button>
                @endif
            </form>
        </div>

        <hr class="mt-12 mb-4">

        {{-- BAWAH --}}
        <div class="w-full grid grid-cols-8 gap-2">
            {{-- ATAS --}}
            <div class="w-full grid grid-rows-4 gap-2 text-center font-semibold items-center">
                <div class="w-full aspect-video flex items-center justify-center"></div>
                <div class="w-full aspect-video flex items-center justify-center">Template</div>
                <div class="w-full aspect-video flex items-center justify-center">Warna <br> Utama</div>
                <div class="w-full aspect-video flex items-center justify-center">Warna <br> Sub</div>
            </div>

            {{-- KONTEN --}}
            @foreach ($items as $key => $value)
                <div class="w-full grid grid-rows-4 gap-2">
                    {{-- TITLE --}}
                    <div class="w-full aspect-video flex items-center justify-center font-semibold">
                        {{ ucfirst($key) }}
                    </div>

                    {{-- TEMPLATE --}}
                    <div class="w-full aspect-video flex items-center justify-center bg-pink text-white font-semibold rounded-xl shadow border">
                        #{{ $invitation->$value }}
                    </div>

                    @php
                        $colors = ['div', 'sdiv'];
                    @endphp

                    @foreach ($colors as $color)
                        @php
                            $textColor = $color === 'div' ? $invitation->{'c_'.$key}['stext'] : $invitation->{'c_'.$key}['text'];
                        @endphp
                        <div class="w-full aspect-video flex items-center justify-center font-semibold shadow border rounded-xl overflow-hidden">
                            <div class="w-full h-full flex items-center justify-center"
                                style="background-color: {{ $invitation->{'c_'.$key}[$color] }}; color: {{ $textColor }}">
                                <i class="fa-solid fa-palette"></i>
                            </div>
                            <div class="w-full h-full flex items-center justify-center"
                                style="background-color: {{ $textColor }}; color: {{ $invitation->{'c_'.$key}[$color] }}">
                                <i class="fa-solid fa-font"></i>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>
    </div>
</div>
