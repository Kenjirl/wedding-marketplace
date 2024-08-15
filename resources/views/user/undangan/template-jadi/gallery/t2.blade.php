@php
    $photos = $wedding->invitation ? $wedding->invitation->gallery['photos'] : [];
@endphp

<div class="min-h-[50vh] flex items-center justify-center" style="background-color: #e9e6e1; color: #8c867f;"
    id="gallery">
    <div class="max-w-[900px] py-20">
        <div class="w-fit px-4 md:mb-2 text-[2em] md:text-[3em] lg:text-[4em] text-center rounded-b font-sacramento border-b-4 border-white">
            Our Gallery
        </div>

        <div class="w-full p-4 grid grid-cols-5 gap-4">
            @for ($i = 0; $i < 10; $i++)
                @if ($i == 3)
                    <div class="w-full h-full flex items-center justify-center text-[1em] md:text-[4em] lg:text-6xl border-4 border-white drop-shadow-sm font-sacramento font-semibold rounded-xl shadow-sm">
                        <p class="drop-shadow-sm">
                            {{ substr($wedding->p_sapaan, 0, 1) }}
                        </p>
                    </div>
                @elseif ($i == 4 || $i == 5)
                    <div></div>
                @elseif ($i == 6)
                    <div class="w-full h-full flex items-center justify-center text-[1em] md:text-[4em] lg:text-6xl border-4 border-white drop-shadow-sm font-sacramento font-semibold rounded-xl shadow-sm">
                        <p class="drop-shadow-sm">
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
</div>
