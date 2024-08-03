<div class="w-full py-20 font-varela">
    <div class="w-full p-8 max-w-[400px] mx-auto grid grid-cols-1 gap-10">
        @foreach ($wedding->w_detail as $detail)
            <div class="w-full">
                <div class="text-[4em] text-center font-great-vibes"
                    style="color: {{ $wedding->invitation ? $wedding->invitation->event['stext'] : '#000000'}};"
                    id="stext">
                    {{ \Carbon\Carbon::parse($detail->waktu)->format('d/m/Y') }}
                </div>

                <div class="text-[1.75em] text-center">
                    {{ $detail->event->nama }}
                </div>

                <div class="mb-2 text-center italic">
                    {{ \Carbon\Carbon::parse($detail->waktu)->format('H:i') }} s/d selesai
                </div>

                <div class="mb-4 text-center font-semibold">
                    {{ $detail->lokasi }}
                </div>

                <div class="w-full flex items-center justify-center gap-4 text-base">
                    <a class="w-[40px] aspect-square flex items-center justify-center border rounded"
                        target="_blank" title="Google Map"
                        href="https://www.google.com/maps/search/?api=1&query={{ $detail->lokasi }}">
                        <i class="fa-solid fa-map-location"></i>
                    </a>

                    @php
                        $text  = $detail->event->nama . ' ' . $wedding->p_sapaan . ' dan ' . $wedding->w_sapaan;
                        $dets  = 'Acara ' . $detail->event->nama . ' ' . $wedding->p_lengkap . ' dan ' . $wedding->w_lengkap;
                        $dates = Carbon\Carbon::parse($detail->waktu)->format('Ymd\THis');
                        $loc   = $detail->lokasi;
                    @endphp
                    <a class="w-[40px] aspect-square flex items-center justify-center border rounded"
                        target="_blank" title="Google Calendar"
                        href="https://calendar.google.com/calendar/render?action=TEMPLATE&text={{ $text }}&details={{ $dets }}&dates={{ $dates }}/{{ $dates }}&location={{ $loc }}">
                        <i class="fa-regular fa-calendar"></i>
                    </a>
                </div>
            </div>
        @endforeach
    </div>
</div>
