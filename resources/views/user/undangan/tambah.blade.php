@extends('main')

@section('title')
    <title>Buat Undangan | Wedding Marketplace</title>
@endsection

@section('body')
    <div class="w-full max-w-[1600px] mx-auto flex items-start justify-center font-quicksand">
        {{-- TAMPILAN UNDANGAN --}}
        <div class="w-full bg-slate-300">
            <div class="w-full max-w-[1200px] max-h-screen mx-auto overflow-y-auto bg-white">
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
                <div class="min-h-screen flex items-center justify-center" style="background-color: #ffffff; color: #000000;"
                    id="footer">
                    @include('user.undangan.template.footer.1')
                </div>
            </div>
        </div>

        {{-- SETTING UNDANGAN --}}
        <div class="relative max-w-[250px] h-screen flex flex-col items-center justify-between gap-2 border-l-2 border-pink">
            {{-- SECTIONS --}}
            <div class="w-full min-h-[75vh] max-h-[75vh] px-2 overflow-y-auto">
                @foreach ($f_counts as $folder => $count)
                    <div class="w-full mb-2 section-container">
                        <div class="w-full flex items-center justify-between border-b-2 border-transparent transition-colors">
                            <button class="w-full p-2 flex items-center justify-start gap-2 text-pink font-semibold section-toggle-btn"
                                type="button">
                                <i class="fa-solid fa-caret-right"></i>
                                {{ ucfirst($folder) }}
                            </button>

                            <span class="w-fit italic text-slate-500 text-sm" id="val-{{ $folder }}">(1)</span>

                            <a class="hidden" href="#{{ $folder }}" hidden></a>
                        </div>
                        <div class="overflow-hidden transition-all section-content">
                            <div class="px-2 py-4 flex items-center justify-start gap-2 overflow-x-auto">
                                @for ($i = 1; $i <= $count; $i++)
                                    <button class="relative min-w-[50px] aspect-square border border-pink rounded shadow font-semibold text-pink
                                        hover:bg-pink hover:text-white focus:bg-pink focus:text-white transition-colors active:bg-pink-active section-item"
                                        type="button" data-value="t_{{ $folder }}-{{ $i }}">
                                        {{ $i }}
                                    </button>
                                @endfor
                            </div>

                            {{-- COLOR SELECTION --}}
                            <div class="w-full p-2 grid grid-cols-2 gap-2">
                                {{-- COLOR BACKGROUND --}}
                                <div class="w-full">
                                    {{-- COLOR BACKGROUND MAIN --}}
                                    <div class="w-full mb-2 flex items-center justify-start gap-2">
                                        <label class="w-[40px] h-[40px] flex items-center justify-center bg-pink text-white rounded shadow"
                                            for="{{ $folder }}_div" title="pilih warna latar utama">
                                            <i class="fa-solid fa-palette"></i>
                                        </label>
                                        <input class="w-[40px] h-[40px] cursor-pointer"
                                            value="#ffffff" type="color" name="{{ $folder }}_div" id="{{ $folder }}_div">
                                    </div>
                                    {{-- COLOR BACKGROUND SUB --}}
                                    <div class="w-full flex items-center justify-start gap-2">
                                        <label class="w-[40px] h-[40px] flex items-center justify-center bg-white text-pink rounded shadow"
                                            for="{{ $folder }}_sdiv" title="pilih warna latar kedua">
                                            <i class="fa-solid fa-palette"></i>
                                        </label>
                                        <input class="w-[40px] h-[40px] cursor-pointer"
                                            value="#ffffff" type="color" name="{{ $folder }}_sdiv" id="{{ $folder }}_sdiv">
                                    </div>
                                </div>

                                {{-- COLOR TEXT --}}
                                <div class="w-full">
                                    {{-- COLOR TEXT BASE --}}
                                    <div class="w-full mb-2 flex items-center justify-end gap-2">
                                        <label class="w-[40px] h-[40px] flex items-center justify-center bg-pink text-white rounded shadow"
                                            for="{{ $folder }}_text" title="pilih warna font biasa">
                                            <i class="fa-solid fa-font"></i>
                                        </label>
                                        <input class="w-[40px] h-[40px] cursor-pointer"
                                            value="#000000" type="color" name="{{ $folder }}_text" id="{{ $folder }}_text">
                                    </div>
                                    {{-- COLOR TEXT HEADING --}}
                                    <div class="w-full flex items-center justify-end gap-2">
                                        <label class="w-[40px] h-[40px] flex items-center justify-center bg-white text-pink rounded shadow"
                                            for="{{ $folder }}_stext" title="pilih warna font utama">
                                            <i class="fa-solid fa-heading"></i>
                                        </label>
                                        <input class="w-[40px] h-[40px] cursor-pointer"
                                            value="#000000" type="color" name="{{ $folder }}_stext" id="{{ $folder }}_stext">
                                    </div>
                                </div>
                            </div>

                            @if ($folder == 'quote' || $folder == 'gallery')
                                <div class="w-full mt-4 flex items-center justify-start gap-2 text-sm text-slate-500 italic">
                                    <input class="w-4 h-4 rounded"
                                        type="checkbox" name="{{ $folder }}_check" id="{{ $folder }}_check">
                                    <label for="{{ $folder }}_check">Buang bagian {{ $folder }}</label>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- BAWAH --}}
            <div class="w-full h-full p-2 flex flex-col items-center justify-end gap-2">
                {{-- BACK --}}
                <div class="w-full">
                    <a class="block w-full px-4 py-2 text-center font-semibold outline-none text-pink bg-white hover:bg-pink hover:text-white focus:bg-pink focus:text-white active:bg-pink-active transition-colors rounded"
                        href="{{ route('user.pernikahan.index') }}">
                        Kembali
                    </a>
                </div>

                {{-- FORM SUBMIT --}}
                <div class="w-full">
                    <form action="{{ route('user.undangan.tambah') }}" method="POST" id="undanganTemplateForm">
                        @csrf
                        <input class="hidden" type="number" name="wedding_id" id="wedding_id" value="{{ $wedding->id }}" hidden>

                        @foreach ($f_counts as $folder => $count)
                            <input class="hidden" type="text" name="t_{{ $folder }}"         id="t_{{ $folder }}"                        hidden>
                            <input class="hidden" type="text" name="{{ $folder }}_div_col"   id="{{ $folder }}_div_col"  value="#ffffff" hidden>
                            <input class="hidden" type="text" name="{{ $folder }}_sdiv_col"  id="{{ $folder }}_sdiv_col" value="#ffffff" hidden>
                            <input class="hidden" type="text" name="{{ $folder }}_stext_col" id="{{ $folder }}_stext_col" value="#000000" hidden>
                            <input class="hidden" type="text" name="{{ $folder }}_text_col"  id="{{ $folder }}_text_col" value="#000000" hidden>
                        @endforeach

                        <button class="w-full px-4 py-2 rounded outline-none bg-pink text-white hover:bg-pink-hover focus:bg-pink-hover active:bg-pink-active transition-colors"
                            type="button" id="submitForm">
                            Buat Undangan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('child-js')
    <script>
        let weddingData = @json($wedding->id);

        $(document).ready(function() {
            Fancybox.bind("[data-fancybox]");

            $('.section-toggle-btn').click(function() {
                $('.section-toggle-btn').parent('div').removeClass('border-transparent').addClass('border-pink');
                $('.section-content').addClass('h-0 p-0').removeClass('p-1');

                $(this).parent('div').toggleClass('border-transparent').toggleClass('border-pink');
                $(this).closest('.section-container').find('.section-content').toggleClass('h-0 p-0').toggleClass('p-1');

                $(this).siblings('a')[0].click();
            });

            $('.section-toggle-btn:first').click();

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
            $('input[type="color"]').on('change', function() {
                let colorInputId = $(this).attr('id');
                let textInputId = colorInputId + '_col';
                $('#' + textInputId).val($(this).val());

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

            $('input[type="checkbox"]').on('change', function() {
                let folder = $(this).attr('id').split('_')[0];
                $('#'+folder).toggleClass('hidden');

                if(this.checked) {
                    $('#val-'+folder).text('(0)');
                    $('#t_'  +folder).val('0');
                } else {
                    $(`button[data-value="t_${folder}-1"]`).click();
                }
            });

            $('#submitForm').click(function() {
                Swal.fire({
                    title: 'Yakin ingin membuat undangan ini?',
                    text: "Undangan digital tidak dapat diubah kembali",
                    icon: "warning",
                    iconColor: "#F78CA2",
                    showCloseButton: true,
                    confirmButtonColor: "#F78CA2",
                    confirmButtonText: "Konfirmasi"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#undanganTemplateForm').submit();
                    }
                });
            });
        });
    </script>
@endpush
