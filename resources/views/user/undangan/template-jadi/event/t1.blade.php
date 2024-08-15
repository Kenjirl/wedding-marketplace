<div class="w-full min-h-[50vh] flex items-center justify-center" style="background-color: #6EACDA; color: #ffffff;"
    id="event">
    <div class="w-full py-20 font-varela">
        <div class="w-[90%] p-8 mx-auto grid grid-cols-1 gap-10">
            @foreach ($wedding->w_detail as $detail)
                <div class="w-full max-w-[600px] mx-auto flex flex-col md:flex-row items-center justify-center">
                    <div class="w-full md:w-fit min-w-[120px] h-full flex flex-col items-center justify-center rounded-lg border"
                        style="background-color: #6EACDA;"
                        id="sdiv">
                        @php
                            $tanggal = \Carbon\Carbon::parse($detail->waktu)->format('d');
                            $bt = \Carbon\Carbon::parse($detail->waktu)->translatedFormat('F Y');
                        @endphp
                        <div class="text-5xl md:text-[5em] text-center font-great-vibes"
                            style="color: #ffffff;"
                            id="stext">
                            {{ $tanggal }}
                        </div>
                        <div class="font-semibold"
                            style="color: #ffffff;"
                            id="stext">
                            {{ $bt }}
                        </div>
                    </div>

                    <div class="w-full p-2">
                        <div class="text-[1.5em] mb-1 border-b-2 border-white">
                            {{ $detail->event->nama }}
                        </div>

                        <div class="mb-2 italic">
                            {{ \Carbon\Carbon::parse($detail->waktu)->format('H:i') }} s/d selesai
                        </div>

                        <div class="mb-2 font-semibold">
                            {{ $detail->lokasi }}
                        </div>

                        <div class="w-full flex items-center justify-start gap-2 text-base">
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
