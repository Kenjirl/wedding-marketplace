@php
    $photos = $wedding->invitation ? $wedding->invitation->gallery['photos'] : [];
@endphp

<div class="max-w-[900px] py-20">
    <div class="md:mb-2 text-[2em] md:text-[3em] lg:text-[4em] text-center font-semibold font-great-vibes"
        style="color: {{ $wedding->invitation ? $wedding->invitation->gallery['stext'] : '#000000'}};"
        id="stext">
        Our Gallery
    </div>

    <div class="w-full p-4 grid grid-cols-4">
        @php
            $pattern = [
                [1, 0, 1, 0],
                [0, 1, 0, 1],
                [1, 0, 1, 0],
            ];
        @endphp
        @foreach ($pattern as $row)
            @foreach ($row as $cell)
                @if ($cell === 1)
                    @php
                        $photo = array_shift($photos);
                    @endphp
                    <div>
                        @if ($photos)
                            <a class="cursor-zoom-in" data-fancybox="gal"
                                href="{{ asset($photo) }}">
                                <img class="w-full aspect-square rounded-xl object-center object-cover shadow"
                                    src="{{ asset($photo) }}" alt="">
                            </a>
                        @else
                            <a class="cursor-zoom-in" data-fancybox="gal"
                                href="{{ asset('template/undangan/gallery/p_light.jpg') }}">
                                <img class="w-full aspect-square rounded-xl object-center object-cover shadow"
                                    src="{{ asset('template/undangan/gallery/p_light.jpg') }}" alt="Template">
                            </a>
                        @endif
                    </div>
                @else
                    <div></div>
                @endif
            @endforeach
        @endforeach
    </div>
</div>
