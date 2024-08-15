<div class="w-full min-h-[50vh] flex items-center justify-center" style="background-color: #e9e6e1; color: #8c867f;"
    id="event">
    <div class="w-full py-20 font-varela">
        <div class="w-[90%] p-8 mx-auto grid grid-cols-1 gap-10">
            @foreach ($wedding->w_detail as $detail)
                <div class="w-full max-w-[400px] aspect-square mx-auto flex flex-col items-center justify-center rounded-full border-4 border-white drop-shadow-sm text-center">
                    <div class="w-fit">
                        @php
                            $tanggal = \Carbon\Carbon::parse($detail->waktu)->format('d');
                            $bt = \Carbon\Carbon::parse($detail->waktu)->translatedFormat('F Y');
                        @endphp
                        <div class="text-3xl md:text-7xl text-center font-sacramento">
                            {{ $tanggal }}
                        </div>
                        <div class="font-semibold">
                            {{ $bt }}
                        </div>
                    </div>

                    <div class="w-full text-sm md:text-base">
                        <div class="text-3xl md:text-4xl lg:text-5xl font-sacramento drop-shadow-sm">
                            {{ $detail->event->nama }}
                        </div>

                        <div class="mb-2 italic">
                            {{ \Carbon\Carbon::parse($detail->waktu)->format('H:i') }} s/d selesai
                        </div>

                        <div class="mb-2 font-semibold">
                            {{ $detail->lokasi }}
                        </div>

                        <div class="w-full flex items-center justify-center gap-2 text-base">
                            <a class="w-[40px] aspect-square flex items-center justify-center border rounded"
                                target="_blank" title="Google Map"
                                href="https://www.google.com/maps/search/?api=1&query={{ $detail->lokasi }}">
                                <i class="fa-solid fa-map-location"></i>
                            </a>

                            @php
                                $text  = $detail->event->nama . ' ' . $wedding->p_sapaan . ' dan ' . $wedding->w_sapaan;
                                $dets  = 'Acara ' . $detail->event->nama . ' ' . $wedding->p_lengkap . ' dan ' . $wedding->w_lengkap;
                                $dates = Carbon\Carbon::parse($detail->waktu)->format('Ymd\THis');
                                $loc   = $detail->lokasi . ' (' . $detail->koordinat['lat'] . ', ' . $detail->koordinat['lng'] . ')';
                            @endphp
                            <a class="w-[40px] aspect-square flex items-center justify-center border rounded"
                                target="_blank" title="Google Calendar"
                                href="https://calendar.google.com/calendar/render?action=TEMPLATE&text={{ $text }}&details={{ $dets }}&dates={{ $dates }}/{{ $dates }}&location={{ $loc }}">
                                <i class="fa-regular fa-calendar"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
