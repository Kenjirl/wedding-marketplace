@php
    $photos = $wedding->invitation ? $wedding->invitation->gallery['photos'] : [];
@endphp

<div class="max-w-[1000px] py-20">
    <div class="mb-2 text-[4em] text-center font-semibold font-great-vibes"
        style="color: {{ $wedding->invitation ? $wedding->invitation->gallery['stext'] : '#000000'}};"
        id="stext">
        Our Gallery
    </div>

    <div class="w-full p-4 grid grid-cols-5 gap-4">
        @for ($i = 0; $i < 10; $i++)
            @if ($i == 3)
                <div class="w-full h-full flex items-center justify-center text-[5em] font-great-vibes font-semibold rounded-xl shadow-sm"
                    style="background-color: {{ $wedding->invitation ? $wedding->invitation->gallery['sdiv'] : '#ffffff'}}"
                    id="sdiv">
                    <p>
                        {{ substr($wedding->p_sapaan, 0, 1) }}
                    </p>
                </div>
            @elseif ($i == 4 || $i == 5)
                <div></div>
            @elseif ($i == 6)
                <div class="w-full h-full flex items-center justify-center text-[5em] font-great-vibes font-semibold rounded-xl shadow-sm"
                    style="background-color: {{ $wedding->invitation ? $wedding->invitation->gallery['sdiv'] : '#ffffff'}}"
                    id="sdiv">
                    <p>
                        {{ substr($wedding->w_sapaan, 0, 1) }}
                    </p>
                </div>
            @else
                @if ($photos)
                    @php
                        $photo = array_shift($photos);
                    @endphp
                    <div>
                        <a class="cursor-zoom-in" data-fancybox="gal" href="{{ asset($photo) }}">
                            <img class="w-full aspect-[9/16] rounded-xl object-center object-cover shadow"
                                src="{{ asset($photo) }}" alt="">
                        </a>
                    </div>
                @else
                    <div>
                        <a class="cursor-zoom-in" data-fancybox="gal" href="{{ asset('template/undangan/gallery/p_light.jpg') }}">
                            <img class="w-full aspect-[9/16] rounded-xl object-center object-cover shadow"
                                src="{{ asset('template/undangan/gallery/p_light.jpg') }}" alt="Template">
                        </a>
                    </div>
                @endif
            @endif
        @endfor
    </div>
</div>
