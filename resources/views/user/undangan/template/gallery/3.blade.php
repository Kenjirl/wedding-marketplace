@php
    $photos = $wedding->invitation ? $wedding->invitation->c_gallery['photos'] : [];
@endphp

<div class="max-w-[1200px] py-10">
    <div class="text-[5em] text-center font-semibold font-great-vibes"
        style="color: {{ $wedding->invitation ? $wedding->invitation->c_gallery['stext'] : '#000000'}};"
        id="stext">
        Our Gallery
    </div>

    <div class="w-full p-4 grid grid-cols-3 gap-4">
        @for ($i = 0; $i < 6; $i++)
            @php
                $photo = array_shift($photos);
            @endphp
            <div>
                @if ($photos)
                    <a class="cursor-zoom-in" data-fancybox="gal"
                        href="{{ asset($photo) }}">
                        <img class="w-full aspect-video rounded-xl object-center object-cover shadow"
                            src="{{ asset($photo) }}" alt="">
                    </a>
                @else
                    <a class="cursor-zoom-in" data-fancybox="gal"
                        href="{{ asset('template/undangan/gallery/p_light.jpg') }}">
                        <img class="w-full aspect-video rounded-xl object-center object-cover shadow"
                            src="{{ asset('template/undangan/gallery/p_light.jpg') }}" alt="Template">
                    </a>
                @endif
            </div>
        @endfor
    </div>
</div>
