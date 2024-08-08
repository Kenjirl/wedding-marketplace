@extends('main')

@section('title')
    <title>Buat Undangan | Wedding Marketplace</title>
@endsection

@section('body')
    <div class="w-full font-quicksand">
        {{-- TAMPILAN UNDANGAN --}}
        <div class="w-full mx-auto bg-slate-300">
            <div class="w-full max-w-[1400px] max-h-screen mx-auto overflow-y-auto bg-white"
                id="digitalInvitationView">
                <div class="min-h-screen flex items-center justify-center" style="background-color: #ffffff; color: #000000;"
                    id="header">
                    @include('user.undangan.template.header.1')
                </div>
                <div class="w-full flex items-center justify-center" style="background-color: #ffffff; color: #000000;"
                    id="quote">
                    @include('user.undangan.template.quote.1')
                </div>
                <div class="flex items-center justify-center" style="background-color: #ffffff; color: #000000;"
                    id="profile">
                    @include('user.undangan.template.profile.1')
                </div>
                <div class="min-h-[50vh] flex items-center justify-center" style="background-color: #ffffff; color: #000000;"
                    id="event">
                    @include('user.undangan.template.event.1')
                </div>
                <div class="min-h-[50vh] flex items-center justify-center" style="background-color: #ffffff; color: #000000;"
                    id="gallery">
                    @include('user.undangan.template.gallery.1')
                </div>
                <div class="min-h-screen flex items-center justify-center" style="background-color: #ffffff; color: #000000;"
                    id="wish">
                    @include('user.undangan.template.wish.1')
                </div>
                <div class="flex items-center justify-center" style="background-color: #ffffff; color: #000000;"
                    id="info">
                    @include('user.undangan.template.info.1')
                </div>
                <div class="min-h-screen flex items-center justify-center" style="background-color: #ffffff; color: #000000;"
                    id="footer">
                    @include('user.undangan.template.footer.1')
                </div>
            </div>
        </div>

        {{-- BUTTON --}}
        <div class="fixed bottom-4 right-4 w-[calc(100%-32px)] z-40 transition-all"
            id="islandContainer">
            <div class="relative w-full p-2 flex items-center justify-center rounded-full bg-white shadow border">
                <button class="absolute bottom-full inset-x-auto w-[100px] outline-pink bg-white text-pink rounded-t-full border border-b-0 overflow-hidden"
                    type="button" id="asd">
                    <div class="chevron-div hidden">
                        <i class="fa-solid fa-chevron-up"></i>
                    </div>
                    <div class="chevron-div">
                        <i class="fa-solid fa-chevron-down"></i>
                    </div>
                </button>

                <div class="w-1/3 flex items-center justify-between">
                    <a class="min-w-[45px] aspect-square flex items-center justify-center rounded-full outline-pink outline-offset-4 text-pink bg-white border
                        hover:bg-pink hover:text-white focus:bg-pink focus:text-white transition-colors"
                        href="{{ route('user.pernikahan.index') }}">
                        <i class="fa-solid fa-arrow-left"></i>
                    </a>
                </div>

                <div class="w-1/3">
                    <div class="w-full mx-auto flex items-center justify-center flex-nowrap gap-4">
                        <a class="island-section-anchor min-w-[45px] aspect-square flex items-center justify-center rounded-full outline-pink outline-offset-4 text-pink bg-white border
                            hover:bg-pink hover:text-white focus:bg-pink focus:text-white transition-colors"
                            href="#header" data-section="header">
                            <i class="fa-solid fa-house"></i>
                        </a>
                        <a class="island-section-anchor min-w-[45px] aspect-square flex items-center justify-center rounded-full outline-pink outline-offset-4 text-pink bg-white border
                            hover:bg-pink hover:text-white focus:bg-pink focus:text-white transition-colors"
                            href="#quote" data-section="quote">
                            <i class="fa-solid fa-quote-left"></i>
                        </a>
                        <a class="island-section-anchor min-w-[45px] aspect-square flex items-center justify-center rounded-full outline-pink outline-offset-4 text-pink bg-white border
                            hover:bg-pink hover:text-white focus:bg-pink focus:text-white transition-colors"
                            href="#profile" data-section="profile">
                            <i class="fa-solid fa-user"></i>
                        </a>
                        <a class="island-section-anchor min-w-[45px] aspect-square flex items-center justify-center rounded-full outline-pink outline-offset-4 text-pink bg-white border
                            hover:bg-pink hover:text-white focus:bg-pink focus:text-white transition-colors"
                            href="#event" data-section="event">
                            <i class="fa-regular fa-calendar"></i>
                        </a>
                        <a class="island-section-anchor min-w-[45px] aspect-square flex items-center justify-center rounded-full outline-pink outline-offset-4 text-pink bg-white border
                            hover:bg-pink hover:text-white focus:bg-pink focus:text-white transition-colors"
                            href="#gallery" data-section="gallery">
                            <i class="fa-solid fa-image"></i>
                        </a>
                        <a class="island-section-anchor min-w-[45px] aspect-square flex items-center justify-center rounded-full outline-pink outline-offset-4 text-pink bg-white border
                            hover:bg-pink hover:text-white focus:bg-pink focus:text-white transition-colors"
                            href="#wish" data-section="wish">
                            <i class="fa-regular fa-comment"></i>
                        </a>
                        <a class="island-section-anchor min-w-[45px] aspect-square flex items-center justify-center rounded-full outline-pink outline-offset-4 text-pink bg-white border
                            hover:bg-pink hover:text-white focus:bg-pink focus:text-white transition-colors"
                            href="#info" data-section="info">
                            <i class="fa-solid fa-circle-info"></i>
                        </a>
                        <a class="island-section-anchor min-w-[45px] aspect-square flex items-center justify-center rounded-full outline-pink outline-offset-4 text-pink bg-white border
                            hover:bg-pink hover:text-white focus:bg-pink focus:text-white transition-colors"
                            href="#footer" data-section="footer">
                            <i class="fa-solid fa-envelope"></i>
                        </a>
                    </div>
                </div>

                <div class="w-1/3 flex items-center justify-end gap-4">
                    {{-- <button class="w-[45px] aspect-square flex items-center justify-center rounded-full outline-pink outline-offset-4 text-pink bg-white border
                        hover:bg-pink hover:text-white focus:bg-pink focus:text-white transition-colors"
                        type="button" id="changeViewWidthBtn">
                        <i class="fa-solid fa-desktop"></i>
                    </button> --}}

                    <button class="w-[45px] aspect-square flex items-center justify-center rounded-full outline-pink outline-offset-4 text-pink bg-white border
                        hover:bg-pink hover:text-white focus:bg-pink focus:text-white transition-colors"
                        type="button" id="openEditModalBtn">
                        <i class="fa-solid fa-pen"></i>
                    </button>

                    <button class="w-[45px] aspect-square flex items-center justify-center rounded-full outline-green-400 outline-offset-4 text-green-400 bg-white border
                        hover:bg-green-400 hover:text-white focus:bg-green-400 focus:text-white transition-colors"
                        type="button" id="submitInvitationBtn">
                        <i class="fa-solid fa-check"></i>
                    </button>
                </div>
            </div>
        </div>

        {{-- DEVICE BUTTON --}}
        {{-- <div class="fixed bottom-4 right-4 w-fit p-2 flex items-center justify-center gap-4 rounded-full bg-white shadow border z-10 translate-y-0 transition-all"
            id="deviceBtnContainer">
            <button tabindex="-1" class="change-width-item w-[45px] aspect-square flex items-center justify-center rounded-full outline-pink text-pink bg-white border
                hover:bg-pink hover:text-white focus:bg-pink focus:text-white transition-colors"
                type="button" data-width="mobile">
                <i class="fa-solid fa-mobile-screen-button"></i>
            </button>

            <button tabindex="-1" class="change-width-item w-[45px] aspect-square flex items-center justify-center rounded-full outline-pink text-pink bg-white border
                hover:bg-pink hover:text-white focus:bg-pink focus:text-white transition-colors"
                type="button" data-width="tablet">
                <i class="fa-solid fa-tablet-screen-button"></i>
            </button>

            <button tabindex="-1" class="change-width-item w-[45px] aspect-square flex items-center justify-center rounded-full outline-pink text-white bg-pink border
                hover:bg-pink hover:text-white focus:bg-pink focus:text-white transition-colors"
                type="button" data-width="desktop">
                <i class="fa-solid fa-desktop"></i>
            </button>
        </div> --}}

        {{-- SETTING UNDANGAN --}}
        <div class="fixed top-full left-0 w-full h-screen flex items-center justify-center bg-slate-500/50 z-50 transition-all duration-500"
            id="editModal">
            <div class="w-[90%] max-w-[1300px] bg-white rounded-md">
                {{-- atas --}}
                <div class="w-full p-4 flex items-center justify-between">
                    <div>
                        <span class="text-xl font-semibold">
                            Edit Undangan Digital
                        </span>
                    </div>

                    {{-- TOMBOL CLOSE MODAL --}}
                    <div>
                        <button class="w-fit px-2 aspect-square rounded outline-pink outline-offset-4 bg-pink text-white hover:bg-pink-hover focus:bg-pink-hover active:bg-pink-active transition-colors"
                            type="button" tabindex="-1" id="closeEditModalBtn">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </div>
                </div>

                {{-- konten --}}
                <div class="w-full max-h-[70vh] p-4 flex items-start justify-center gap-4 overflow-y-auto border-y-2">
                    {{-- SECTIONS --}}
                    <div class="w-full px-2">
                        @foreach ($f_counts as $folder => $count)
                            <div class="w-full mb-2 section-container border-pink" data-section="{{ $folder }}">
                                <div class="w-full flex items-center justify-between border-b-2 border-transparent transition-colors">
                                    <button class="section-toggle-btn w-full p-2 flex items-center justify-start gap-2 text-pink font-semibold"
                                        type="button" data-section="{{ $folder }}">
                                        <i class="fa-solid fa-caret-right"></i>
                                        {{ ucfirst($folder) }}
                                    </button>
                                    <span class="w-fit italic text-slate-500 text-sm" id="val-{{ $folder }}">(1)</span>
                                </div>
                                <div class="overflow-hidden transition-all section-content" data-section="{{ $folder }}">
                                    <div class="input-color-container w-full" data-section="{{ $folder }}">
                                        <div class="p-2 flex items-center justify-start gap-2 overflow-x-auto">
                                            @for ($i = 1; $i <= $count; $i++)
                                                <button class="section-item relative min-w-[40px] aspect-square border border-pink rounded shadow font-semibold text-pink outline-pink outline-offset-4
                                                    hover:bg-pink hover:text-white focus:bg-pink focus:text-white transition-colors active:bg-pink-active"
                                                    type="button" data-value="t_{{ $folder }}-{{ $i }}">
                                                    {{ $i }}
                                                </button>
                                            @endfor
                                        </div>

                                        {{-- COLOR SELECTION --}}
                                        <div class="w-full p-2 grid grid-cols-2 gap-2 text-sm">
                                            {{-- COLOR BACKGROUND --}}
                                            <div class="w-full">
                                                {{-- COLOR BACKGROUND MAIN --}}
                                                <div class="w-full mb-2 flex items-center justify-start gap-2">
                                                    <label class="w-[30px] h-[30px] flex items-center justify-center bg-pink text-white rounded shadow"
                                                        for="{{ $folder }}_div" title="pilih warna latar utama">
                                                        <i class="fa-solid fa-palette"></i>
                                                    </label>
                                                    <input class="w-[30px] h-[30px] cursor-pointer"
                                                        value="#ffffff" type="color" name="{{ $folder }}_div" id="{{ $folder }}_div">
                                                    <input class="text-color w-fit px-4 py-2 bg-slate-200 rounded-full text-xs"
                                                        type="text" value="#FFFFFF" maxlength="7">
                                                </div>
                                                {{-- COLOR BACKGROUND SUB --}}
                                                <div class="w-full flex items-center justify-start gap-2">
                                                    <label class="w-[30px] h-[30px] flex items-center justify-center bg-white text-pink rounded shadow"
                                                        for="{{ $folder }}_sdiv" title="pilih warna latar kedua">
                                                        <i class="fa-solid fa-palette"></i>
                                                    </label>
                                                    <input class="w-[30px] h-[30px] cursor-pointer"
                                                        value="#ffffff" type="color" name="{{ $folder }}_sdiv" id="{{ $folder }}_sdiv">
                                                    <input class="text-color w-fit px-4 py-2 bg-slate-200 rounded-full text-xs"
                                                        type="text" value="#FFFFFF" maxlength="7">
                                                </div>
                                            </div>

                                            {{-- COLOR TEXT --}}
                                            <div class="w-full">
                                                {{-- COLOR TEXT BASE --}}
                                                <div class="w-full mb-2 flex items-center justify-start gap-2">
                                                    <label class="w-[30px] h-[30px] flex items-center justify-center bg-pink text-white rounded shadow"
                                                        for="{{ $folder }}_text" title="pilih warna font biasa">
                                                        <i class="fa-solid fa-font"></i>
                                                    </label>
                                                    <input class="w-[30px] h-[30px] cursor-pointer"
                                                        value="#000000" type="color" name="{{ $folder }}_text" id="{{ $folder }}_text">
                                                    <input class="text-color w-fit px-4 py-2 bg-slate-200 rounded-full text-xs"
                                                        type="text" value="#000000" maxlength="7">
                                                </div>
                                                {{-- COLOR TEXT HEADING --}}
                                                <div class="w-full flex items-center justify-start gap-2">
                                                    <label class="w-[30px] h-[30px] flex items-center justify-center bg-white text-pink rounded shadow"
                                                        for="{{ $folder }}_stext" title="pilih warna font utama">
                                                        <i class="fa-solid fa-heading"></i>
                                                    </label>
                                                    <input class="w-[30px] h-[30px] cursor-pointer"
                                                        value="#000000" type="color" name="{{ $folder }}_stext" id="{{ $folder }}_stext">
                                                    <input class="text-color w-fit px-4 py-2 bg-slate-200 rounded-full text-xs"
                                                        type="text" value="#000000" maxlength="7">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    @if ($folder == 'quote' || $folder == 'gallery' || $folder == 'info')
                                        <div class="w-full mt-4 flex items-center justify-start gap-2 text-sm text-slate-500 italic">
                                            <input class="w-4 h-4 rounded"
                                                type="checkbox" name="{{ $folder }}_check" id="{{ $folder }}_check">
                                            <label for="{{ $folder }}_check">Hapus bagian {{ $folder }}</label>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="w-full min-h-1">
                        {{-- TAMBAH QUOTE --}}
                        <div class="tambah-container w-full hidden" data-section="quote">
                            <input class="w-full mb-2 p-2 flex-1 border text-sm rounded outline-pink"
                                type="text" name="add_quote_content" id="add_quote_content" placeholder="masukkan kutipan" maxlength="255" value="">
                            <input class="w-full p-2 flex-1 border text-sm rounded outline-pink"
                                type="text" name="add_quote_author" id="add_quote_author" placeholder="masukan penulis/pengarang/asal kutipan/anonim" maxlength="50" value="">

                            <div class="w-full p-2 flex items-center justify-end gap-2 text-sm">
                                <button class="w-fit px-4 py-2 rounded text-white font-semibold text-sm bg-pink
                                    hover:bg-pink-hover focus:bg-pink-hover active:bg-pink-active
                                    disabled:bg-slate-400 disabled:cursor-not-allowed
                                    transition-colors"
                                    type="button" id="terapkanQuoteBtn" disabled>
                                    Terapkan Quote
                                </button>
                            </div>
                        </div>

                        {{-- TAMBAH FOTO PENGANTIN --}}
                        <div class="tambah-container w-full hidden" data-section="profile">
                            {{-- PREVIEW --}}
                            <div id="image-profil-preview" class="w-full min-h-[350px] p-2 grid grid-cols-2 gap-2 border bg-white overflow-y-auto">
                                <div class="w-full h-full flex items-center justify-center bg-slate-100 rounded">
                                    <span id="pengantin-pria" class="text-gray-500">Pengantin Pria</span>
                                </div>
                                <div class="w-full h-full flex items-center justify-center bg-slate-100 rounded">
                                    <span id="pengantin-wanita" class="text-gray-500">Pengantin Wanita</span>
                                </div>
                            </div>

                            {{-- TENGAH --}}
                            <div class="w-full px-4 py-2 flex items-center justify-end text-sm border border-t-0 rounded-b">
                                <div id="jumlahFotoProfil">
                                    <span>0/2</span>
                                </div>
                            </div>

                            {{-- BAWAH --}}
                            <div class="w-full p-2 flex items-center justify-center gap-2 text-sm">
                                <button class="w-full px-4 py-2 rounded text-white font-semibold text-sm bg-pink
                                    hover:bg-pink-hover focus:bg-pink-hover active:bg-pink-active
                                    disabled:bg-slate-400 disabled:cursor-not-allowed
                                    transition-colors"
                                    type="button" id="unggahFotoProfilBtn">
                                    Tambah Gambar
                                </button>
                                <button class="w-full px-4 py-2 rounded text-white font-semibold text-sm bg-pink
                                    hover:bg-pink-hover focus:bg-pink-hover active:bg-pink-active
                                    disabled:bg-slate-400 disabled:cursor-not-allowed
                                    transition-colors"
                                    type="button" id="terapkanFotoProfilBtn" disabled>
                                    Terapkan Gambar
                                </button>
                            </div>
                        </div>

                        {{-- TAMBAH GALERI --}}
                        <div class="tambah-container w-full hidden" data-section="gallery">
                            {{-- PREVIEW --}}
                            <div id="image-galeri-preview" class="w-full min-h-[350px] p-2 grid grid-cols-3 gap-2 border bg-white overflow-y-auto"></div>

                            {{-- TENGAH --}}
                            <div class="w-full px-4 py-2 flex items-center justify-end text-sm border border-t-0 rounded-b">
                                <div id="jumlahFotoGaleri">
                                    <span>0/6</span>
                                </div>
                            </div>

                            {{-- BAWAH --}}
                            <div class="w-full p-2 flex items-center justify-center gap-2">
                                <button class="w-full px-4 py-2 rounded text-white font-semibold text-sm bg-pink
                                    hover:bg-pink-hover focus:bg-pink-hover active:bg-pink-active
                                    disabled:bg-slate-400 disabled:cursor-not-allowed
                                    transition-colors"
                                    type="button" id="unggahFotoGaleriBtn">
                                    Tambah Gambar
                                </button>
                                <button class="w-full px-4 py-2 rounded text-white font-semibold text-sm bg-pink
                                    hover:bg-pink-hover focus:bg-pink-hover active:bg-pink-active
                                    disabled:bg-slate-400 disabled:cursor-not-allowed
                                    transition-colors"
                                    type="button" id="terapkanFotoGaleriBtn" disabled>
                                    Terapkan Gambar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- bawah --}}
                <div class="w-full px-4 py-2 flex items-center justify-between text-[.9em]">
                    <button class="w-[40px] aspect-square p-2 bg-pink text-white text-center rounded"
                        type="button" id="infoBtn">
                        <i class="fa-solid fa-circle-info"></i>
                    </button>
                    </div>
                </div>
            </div>
        </div>

        {{-- FORM SUBMIT --}}
        <div class="w-full">
            <form action="{{ route('user.undangan.tambah') }}" method="POST" id="undanganTemplateForm"  enctype="multipart/form-data">
                @csrf
                <input class="hidden" type="number" name="wedding_id" id="wedding_id" value="{{ $wedding->id }}" hidden tabindex="-1">

                <input class="hidden" type="hidden" name="type" id="type" value="part" hidden tabindex="-1">

                @foreach ($f_counts as $folder => $count)
                    <input class="hidden" type="text" name="t_{{ $folder }}"         id="t_{{ $folder }}"                         hidden tabindex="-1">
                    <input class="hidden" type="text" name="{{ $folder }}_div_col"   id="{{ $folder }}_div_col"   value="#ffffff" hidden tabindex="-1">
                    <input class="hidden" type="text" name="{{ $folder }}_sdiv_col"  id="{{ $folder }}_sdiv_col"  value="#ffffff" hidden tabindex="-1">
                    <input class="hidden" type="text" name="{{ $folder }}_stext_col" id="{{ $folder }}_stext_col" value="#000000" hidden tabindex="-1">
                    <input class="hidden" type="text" name="{{ $folder }}_text_col"  id="{{ $folder }}_text_col"  value="#000000" hidden tabindex="-1">
                @endforeach

                <input class="hidden" type="text" name="quote_content" id="quote_content" hidden tabindex="-1">
                <input class="hidden" type="text" name="quote_author" id="quote_author" hidden tabindex="-1">

                <input class="hidden" type="file" name="foto_profil[]" id="foto_profil" accept="image/*" multiple tabindex="-1">

                <input class="hidden" type="file" name="foto_galeri[]" id="foto_galeri" accept="image/*" multiple tabindex="-1">
            </form>
        </div>
    </div>
@endsection

@push('child-js')
    <script>
        let weddingData = @json($wedding->id);
        let values = {
            quote: {
                is_deleted: false,
                author: null,
                text: null,
                is_allowed: false
            },
            profile: {
                images: [],
                is_allowed: false
            },
            gallery: {
                is_deleted: false,
                images: [],
                is_allowed: false
            }
        };

        $(document).ready(function() {
            // $(window).on('beforeunload', function() {
            //     return 'Apakah Anda yakin ingin meninggalkan halaman ini? Perubahan yang belum disimpan akan hilang.';
            // });

            // // Jika Anda ingin menghapus peringatan ini dalam kondisi tertentu, misalnya saat user menyimpan data
            // $('#saveButton').on('click', function() {
            //     $(window).off('beforeunload');
            // });

            Fancybox.bind("[data-fancybox]");

            $('#asd').on('click', function() {
                $('#islandContainer').toggleClass('translate-y-[78px]');
                $('#deviceBtnContainer').toggleClass('translate-y-[78px]');
                $('.chevron-div').toggleClass('hidden');
            });

            $('.island-section-anchor').click(function() {
                let folder = $(this).data('section');
                $(`.section-toggle-btn[data-section="${folder}"]`).each(function() {
                    this.click();
                });
            });

            $('#changeViewWidthBtn').click(function() {
                $('#deviceBtnContainer').toggleClass('translate-y-0 -translate-y-20');
            });

            $('#openEditModalBtn').on('click', function() {
                $(`#editModal`).removeClass('top-full').addClass('top-0');
                $(`#editModal button`).attr('tabindex', 0);
                $(`#editModal a`).attr('tabindex', 0);
                $(`#editModal input`).attr('tabindex', 0);
            });

            $('#closeEditModalBtn').on('click', function() {
                $(`#editModal`).removeClass('top-0').addClass('top-full');
                $(`#editModal button`).attr('tabindex', -1);
                $(`#editModal a`).attr('tabindex', -1);
                $(`#editModal input`).attr('tabindex', -1);
            });

            $('.section-toggle-btn').click(function() {
                $('.section-toggle-btn').parent('div').removeClass('border-transparent').addClass('border-pink');
                $('.section-content').addClass('h-0 p-0').removeClass('p-1');

                $('.section-container').removeClass('border-b-2');
                $(this).parent('div').toggleClass('border-transparent').toggleClass('border-pink');
                $('.section-content button').attr('tabindex', -1);
                $('.section-content input').attr('tabindex', -1);

                let folder = $(this).data('section');
                $(`.section-container[data-section="${folder}"]`).toggleClass('border-b-2');
                $(`.section-content[data-section="${folder}"]`).toggleClass('h-0 p-0').toggleClass('p-1');
                $(`.section-content[data-section="${folder}"] button`).attr('tabindex', 0);
                $(`.section-content[data-section="${folder}"] input`).attr('tabindex', 0);

                $('.tambah-container').addClass('hidden');

                $(`.island-section-anchor[data-section="${folder}"]`).each(function() {
                    this.click();
                });
                $(`.tambah-container[data-section="${folder}"]`).removeClass('hidden');
            });

            $('.section-toggle-btn:first').trigger('click');

            function fetchTemplate(type, value) {
                let data = weddingData;
                $.ajax({
                    url: `/fetch-template/${type}/${value}`,
                    method: 'GET',
                    data: { wedding: data },
                    success: function(res) {
                        $(`#${type}`).html(res);

                        setTimeout(function() {
                            $(`#${type} #sdiv`).css('background-color', $(`#${type}_sdiv_col`).val());
                            $(`#${type} #stext`).css('color', $(`#${type}_stext_col`).val());

                            if ($(`#${type} #div`).length) {
                                $(`#${type} #div`).css({
                                    'background-color': $(`#${type}_div_col`).val(),
                                    'color': $(`#${type}_text_col`).val()
                                });
                            }
                        }, 0);
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error('Error fetching the template:', errorThrown);
                    }
                });
            }

            function handleButtonClick(button) {
                let data = button.data('value');
                let section = data.split('-')[0];
                let value = data.split('-')[1];
                $('#' + section).val(value);
                $('#val-' + section.split('_')[1]).text(`(${value})`);

                fetchTemplate(section.split('_')[1], value);
            }

            $('.section-container .section-content .section-item').click(function() {
                handleButtonClick($(this));

                $(this).closest('.section-content').find('.section-item').removeClass('bg-pink text-white').addClass('bg-white text-pink');
                $(this).removeClass('bg-white text-pink').addClass('bg-pink text-white');
            });

            $('.section-container .section-content .section-item:first-child').each(function() {
                $(this).click();
            });

            // COLOR CONTROL
            $('input[type="color"]').on('input', function() {
                let colorInputId = $(this).attr('id');
                let textInputId = colorInputId + '_col';
                $('#' + textInputId).val($(this).val());

                $(this).next('input[type="text"]').val($(this).val().toUpperCase());

                let div = colorInputId.split('_')[0];
                let type = colorInputId.split('_')[1];

                if (type == 'div') {
                    $('#' + div).css('background-color', $(this).val());

                    if ($('#'+div).has('#div')) {
                        $('#' + div + ' #div').css('background-color', $(this).val());
                    }
                }
                else if (type == 'sdiv') {
                    $('#' + div + ' #sdiv').css('background-color', $(this).val());
                    $('#' + div + ' .sdiv').css('background-color', $(this).val());
                }
                else if (type == 'text') {
                    $('#' + div).css('color', $(this).val());

                    if ($('#'+div).has('#div')) {
                        $('#' + div + ' #div').css('color', $(this).val());
                    }
                }
                else {
                    $('#' + div + ' #stext').css('color', $(this).val());
                }
            });

            function hexToRgb(hex) {
                hex = hex.replace(/^#/, '');

                let bigint = parseInt(hex, 16);
                let r = (bigint >> 16) & 255;
                let g = (bigint >> 8) & 255;
                let b = bigint & 255;

                return `rgb(${r}, ${g}, ${b})`;
            }

            $('.text-color').on('input', function() {
                if (!$(this).val().startsWith('#')) {
                    $(this).val('#' + $(this).val());
                }

                if ($(this).val().length === 7) {
                    if (/^#[0-9A-F]{6}$/i.test($(this).val())) {
                        let rgbValue = hexToRgb($(this).val());
                        let colorInput = $(this).prev('input[type="color"]');
                        colorInput.val($(this).val());
                        colorInput.trigger('input');
                    }
                }
            });

            $('input[type="checkbox"]').on('change', function() {
                let folder = $(this).attr('id').split('_')[0];
                $('#'+folder).toggleClass('hidden');

                let container = $(`.input-color-container[data-section="${folder}"]`)
                if(this.checked) {
                    $('#val-'+folder).text('(0)');
                    $('#t_'  +folder).val('0');
                    container.addClass('hidden');
                    container.find('button').attr('tabindex', -1);
                    container.find('input').attr('tabindex', -1);
                    $(`.tambah-container[data-section="${folder}"]`).addClass('hidden');
                    $(`.island-section-anchor[data-section="${folder}"]`).addClass('hidden');
                } else {
                    container.removeClass('hidden');
                    container.find('button').attr('tabindex',0);
                    container.find('input').attr('tabindex', 0);
                    $(`.tambah-container[data-section="${folder}"]`).removeClass('hidden');
                    $(`.island-section-anchor[data-section="${folder}"]`).removeClass('hidden');
                    $(`button[data-value="t_${folder}-1"]`).click();
                }

                if (['quote', 'gallery'].includes(folder)) {
                    values[folder].is_deleted = this.checked;
                    values[folder].is_allowed = this.checked;

                    if (folder == 'quote' && values.quote.author != '' && values.quote.text != '') {
                        values.quote.is_allowed = true;
                    }

                    if (folder == 'gallery' && values.gallery.images.length == 6) {
                        values.gallery.is_allowed = true;
                    }
                }
            });

            // INPUT QUOTE
                function updateQuoteValues() {
                    let quoteValue = $('#add_quote_content').val().trim();
                    let authorValue = $('#add_quote_author').val().trim();

                    values.quote.text = quoteValue;
                    values.quote.author = authorValue;

                    if (quoteValue !== '' && authorValue !== '') {
                        values.quote.is_allowed = true;
                        $('#terapkanQuoteBtn').prop('disabled', false);
                    } else {
                        values.quote.is_allowed = false;
                        $('#terapkanQuoteBtn').prop('disabled', true);
                    }

                    $('#quote_content').val(quoteValue);
                    $('#quote_author').val(authorValue);
                }

                $('#add_quote_content').on('input', updateQuoteValues);
                $('#add_quote_author').on('input', updateQuoteValues);

                $('#terapkanQuoteBtn').on('click', function() {
                    $('#quoteText').text($('#quote_content').val().trim());
                    $('#quoteAuthor').text($('#quote_author').val().trim());
                });

            // INPUT PROFILE
                const $unggahFotoProfilBtn = $('#unggahFotoProfilBtn');
                const $terapkanFotoProfilBtn = $('#terapkanFotoProfilBtn');
                const $fotoProfilInput = $('#foto_profil');
                const $imageProfilPreview = $('#image-profil-preview');
                const $jumlahFotoProfil = $('#jumlahFotoProfil');
                const $pengantinPria = $('#pengantin-pria');
                const $pengantinWanita = $('#pengantin-wanita');
                let profilFileArray = [];

                function updateFotoProfilJson() {
                    const dataTransfer = new DataTransfer();
                    profilFileArray.forEach(file => {
                        dataTransfer.items.add(file);
                    });
                    $fotoProfilInput[0].files = dataTransfer.files;

                    if (profilFileArray.length >= 2) {
                        $unggahFotoProfilBtn.prop('disabled', true);
                        $terapkanFotoProfilBtn.prop('disabled', false);
                        console.log(values.profile.images);
                    } else {
                        $unggahFotoProfilBtn.prop('disabled', false);
                        $terapkanFotoProfilBtn.prop('disabled', true);
                    }

                    if (values.profile.images.length >= 2) {
                        values.profile.is_allowed = true;
                    } else {
                        values.profile.is_allowed = false;
                    }

                    $jumlahFotoProfil.text(profilFileArray.length + '/2');

                    // Hide placeholder text when images are added
                    if (profilFileArray.length > 0) {
                        $pengantinPria.hide();
                        $pengantinWanita.hide();
                    } else {
                        $pengantinPria.show();
                        $pengantinWanita.show();
                    }
                }

                $unggahFotoProfilBtn.on('click', function () {
                    $fotoProfilInput.click();
                });

                $fotoProfilInput.on('change', function () {
                    const files = Array.from(this.files);
                    const maxFiles = 2 - profilFileArray.length;

                    if (files.length > maxFiles) {
                        Swal.fire({
                            title: "Eitssssss!",
                            text: "Maksimal 2 gambar saja ya!",
                            icon: "warning",
                            iconColor: "#F78CA2",
                            showCloseButton: true,
                            confirmButtonColor: "#F78CA2",
                        });
                        return;
                    }

                    files.forEach(file => {
                        const reader = new FileReader();
                        reader.onload = function (e) {
                            const $imgWrapper = $('<div>').addClass('relative w-full h-[350px] bg-slate-100 rounded');
                            const $img = $('<img>').attr('src', e.target.result).addClass('w-full h-full object-contain');
                            const $deleteBtn = $('<button type="button"><i class="fa-solid fa-xmark"></i></button>').addClass('absolute top-0 right-0 w-8 aspect-square bg-pink rounded text-white');

                            $deleteBtn.on('click', function () {
                                const index = profilFileArray.findIndex(f => f.name === file.name);
                                if (index !== -1) {
                                    profilFileArray.splice(index, 1);
                                    values.profile.images.splice(index, 1);
                                    $imgWrapper.remove();
                                    updateFotoProfilJson();
                                }
                            });

                            $imgWrapper.append($img).append($deleteBtn);
                            $imageProfilPreview.append($imgWrapper);
                            profilFileArray.push(file);
                            values.profile.images.push(file);
                            updateFotoProfilJson();
                        };
                        reader.readAsDataURL(file);
                    });
                });

                $('#terapkanFotoProfilBtn').click(function() {
                    const $profileImages = $('#profile img');

                    values.profile.images.forEach((file, index) => {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            if (index < $profileImages.length) {
                                $($profileImages[index]).attr('src', e.target.result);
                            }
                        };
                        reader.readAsDataURL(file);
                    });
                });

                updateFotoProfilJson();
            // END INPUT PROFILE

            // INPUT GALLERY
                const $unggahFotoGaleriBtn = $('#unggahFotoGaleriBtn');
                const $terapkanFotoGaleriBtn = $('#terapkanFotoGaleriBtn');
                const $fotoGaleriInput = $('#foto_galeri');
                const $imageGaleriPreview = $('#image-galeri-preview');
                const $jumlahFotoGaleri = $('#jumlahFotoGaleri');
                let galeriFileArray = [];

                function updateFotoGaleriJson() {
                    const dataTransfer = new DataTransfer();
                    galeriFileArray.forEach(file => {
                        dataTransfer.items.add(file);
                    });
                    $fotoGaleriInput[0].files = dataTransfer.files;

                    if (galeriFileArray.length >= 6) {
                        $unggahFotoGaleriBtn.prop('disabled', true);
                        $terapkanFotoGaleriBtn.prop('disabled', false);
                    } else {
                        $unggahFotoGaleriBtn.prop('disabled', false);
                        $terapkanFotoGaleriBtn.prop('disabled', true);
                    }

                    if (values.gallery.images.length >= 6) {
                        values.gallery.is_allowed = true;
                    } else {
                        values.gallery.is_allowed = false;
                    }

                    $jumlahFotoGaleri.text(galeriFileArray.length + '/6');
                }

                $unggahFotoGaleriBtn.on('click', function () {
                    $fotoGaleriInput.click();
                });

                $fotoGaleriInput.on('change', function () {
                    const files = Array.from(this.files);
                    const maxFiles = 6 - galeriFileArray.length;

                    if (files.length > maxFiles) {
                        Swal.fire({
                            title: "Eitssssss!",
                            text: "Maksimal 6 gambar saja ya!",
                            icon: "warning",
                            iconColor: "#F78CA2",
                            showCloseButton: true,
                            confirmButtonColor: "#F78CA2",
                        });
                        return;
                    }

                    files.forEach(file => {
                        const reader = new FileReader();
                        reader.onload = function (e) {
                            const $imgWrapper = $('<div>').addClass('relative w-full h-full bg-slate-100 rounded');
                            const $img = $('<img>').attr('src', e.target.result).addClass('w-full h-full object-contain');
                            const $deleteBtn = $('<button type="button"><i class="fa-solid fa-xmark"></i></button>').addClass('absolute top-0 right-0 w-8 aspect-square bg-pink rounded text-white');

                            $deleteBtn.on('click', function () {
                                const index = galeriFileArray.findIndex(f => f.name === file.name);
                                if (index !== -1) {
                                    galeriFileArray.splice(index, 1);
                                    values.gallery.images.splice(index, 1);
                                    $imgWrapper.remove();
                                    updateFotoGaleriJson();
                                }
                            });

                            $imgWrapper.append($img).append($deleteBtn);
                            $imageGaleriPreview.append($imgWrapper);
                            galeriFileArray.push(file);
                            values.gallery.images.push(file);
                            updateFotoGaleriJson();
                        };
                        reader.readAsDataURL(file);
                    });
                });

                $('#terapkanFotoGaleriBtn').click(function() {
                    const $galleryAnchors = $('#gallery a');

                    values.gallery.images.forEach((file, index) => {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            if (index < $galleryAnchors.length) {
                                const $anchor = $($galleryAnchors[index]);
                                $anchor.attr('href', e.target.result);
                                $anchor.find('img').attr('src', e.target.result);
                            }
                        };
                        reader.readAsDataURL(file);
                    });
                });

                updateFotoGaleriJson();
            // END INPUT GALLERY

            // SUBMIT BUTTON
            $('#submitInvitationBtn').click(function() {
                if (values.quote.is_allowed && values.profile.is_allowed && values.gallery.is_allowed) {
                    Swal.fire({
                        title: 'Yakin ingin membuat undangan ini?',
                        text: "Undangan digital tidak dapat diubah kembali",
                        icon: "warning",
                        showCloseButton: true,
                        confirmButtonText: "Konfirmasi"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $('#undanganTemplateForm').submit();
                        }
                    });
                } else {
                    let html = '';
                    html += values.quote.is_allowed ? '' : '<li>Anda belum mengisi quote</li>';
                    html += values.profile.is_allowed ? '' : '<li>Anda belum menambah foto pengantin</li>';
                    html += values.gallery.is_allowed ? '' : '<li>Anda belum menambah foto untuk galeri</li>';

                    Swal.fire({
                        title: 'Undangan Digital Anda belum lengkap!',
                        html: `<ul class="p-2 list-disc">${html}</ul>`,
                        icon: "error",
                        showCloseButton: true,
                        confirmButtonText: "Konfirmasi"
                    }).then((result) => {
                        return;
                    });
                }
            });

            $('#infoBtn').on("click", function () {
                Swal.fire({
                    title: "Info",
                    icon: "info",
                    iconColor: "#F78CA2",
                    html: `
                        <p class="text-justify text-sm">
                            1. Silahkan mendesain undangan digital Anda <br>
                            2. Anda dapat mengubah warna untuk tiap bagian dari undangan digital <br>
                            3. Anda dapat menghapus beberapa bagian yang opsional, seperti <i>quote</i>, <i>gallery</i>, dan <i>info</i> <br>
                            4. Anda perlu melengkapi beberapa informasi, seperti <i>quote</i>, <i>profile</i>, dan <i>gallery</i> <br>
                            5. Jika Anda memilih menggunakan <b>Template</b> (mis: <b>t1</b>), Anda tidak dapat mengubah per bagian dari undangan digital
                        </p>
                    `,
                    showCloseButton: true,
                    confirmButtonColor: "#F78CA2",
                    confirmButtonText: "OK"
                }).then((result) => {
                    return;
                });
            });
        });
    </script>
@endpush
