<div class="w-full py-20 font-varela">
    <div class="w-[90%] mx-auto shadow-lg" id="sdiv"
        style="background-color: {{ $wedding->invitation ? $wedding->invitation->c_event['sdiv'] : '#ffffff'}};">
        <div class="w-full p-4 text-center text-[2em] md:text-[3em] lg:text-[4em] font-semibold font-great-vibes"
            style="color: {{ $wedding->invitation ? $wedding->invitation->c_event['stext'] : '#000000'}};"
            id="stext">
            The Wedding Day
        </div>

        <div class="w-full p-2 pb-8 md:p-8 grid grid-cols-1 md:grid-cols-2 gap-8 md:gap-16">
            @php
                $length = count($wedding->w_detail) % 2;
            @endphp
            @foreach ($wedding->w_detail as $detail)
                <div class="{{ $length != 0 ? 'md:last:col-span-2 md:last:w-[50%]' : '' }} w-full mx-auto">
                    <div class="mb-2 text-[1.2em] lg:text-[2em] text-center border-b">
                        {{ $detail->event->nama }}
                    </div>

                    <div class="lg:p-2 grid grid-cols-1 md:gap-2 text-[.8em] md:text-[.9em] lg:text-base">
                        <div class="flex items-center justify-start gap-2">
                            <div class="w-[30px] aspect-square flex items-center justify-center">
                                <i class="fa-regular fa-calendar"></i>
                            </div>
                            {{ \Carbon\Carbon::parse($detail->waktu)->translatedFormat('l, d F Y') }}
                        </div>
                        <div class="flex items-center justify-start gap-2">
                            <div class="w-[30px] aspect-square flex items-center justify-center">
                                <i class="fa-regular fa-clock"></i>
                            </div>
                            {{ \Carbon\Carbon::parse($detail->waktu)->format('H:i') }}
                        </div>
                        <div class="flex items-center justify-start gap-2 font-semibold">
                            <div class="w-[30px] aspect-square flex items-center justify-center">
                                <i class="fa-solid fa-location-dot"></i>
                            </div>
                            {{ $detail->lokasi }}
                        </div>

                        <div class="w-full mt-2 grid grid-cols-1 gap-2 md:gap-4 text-[.9em] lg:text-base">
                            <a class="w-fit block px-2 py-1 md:px-4 md:py-2 mx-auto rounded border"
                                target="_blank"
                                href="https://www.google.com/maps/search/?api=1&query={{ $detail->lokasi }}">
                                <i class="fa-solid fa-map-location"></i>
                                Buka di Map
                            </a>

                            @php
                                $text  = $detail->event->nama . ' ' . $wedding->p_sapaan . ' dan ' . $wedding->w_sapaan;
                                $dets  = 'Acara ' . $detail->event->nama . ' ' . $wedding->p_lengkap . ' dan ' . $wedding->w_lengkap;
                                $dates = Carbon\Carbon::parse($detail->waktu)->format('Ymd\THis');
                                $loc   = $detail->lokasi;
                            @endphp
                            <a class="w-fit block px-2 py-1 md:px-4 md:py-2 mx-auto rounded border"
                                target="_blank"
                                href="https://calendar.google.com/calendar/render?action=TEMPLATE&text={{ $text }}&details={{ $dets }}&dates={{ $dates }}/{{ $dates }}&location={{ $loc }}">
                                <i class="fa-regular fa-calendar"></i>
                                Tambah ke Calendar
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
