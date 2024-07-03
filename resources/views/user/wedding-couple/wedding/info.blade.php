<div class="w-full flex items-start justify-center">
    <div class="flex-1 w-full">
        {{-- EVENTS --}}
        <div class="w-full max-h-[600px] p-4 overflow-y-auto">
            @foreach ($weddingEvents as $w_event)
                {{-- EVENT --}}
                <div class="w-full mb-4 flex items-center justify-center gap-4">
                    {{-- NUMBER --}}
                    <div class="w-[50px] aspect-square flex items-center justify-center text-2xl italic bg-pink text-white font-semibold rounded">
                        {{ $loop->iteration }}
                    </div>

                    {{-- RIGHT --}}
                    <div class="flex-1 w-full">
                        {{-- TOP --}}
                        <div class="w-full flex">
                            <div class="flex-1 w-full text-lg font-semibold">
                                {{ $w_event->event->nama }}
                            </div>

                            <div class="w-4 aspect-square flex items-center justify-end text-sm cursor-pointer"
                                data-tippy-content="{{ $w_event->event->keterangan }}">
                                <i class="fa-regular fa-circle-question"></i>
                            </div>
                        </div>

                        <div class="w-full h-[2px] my-1 bg-pink"></div>

                        {{-- BOTTOM --}}
                        <div class="w-full text-sm text-gray-400 italic">
                            <div>
                                Pada {{ \Carbon\Carbon::parse($w_event->waktu)->format('d/m/Y') }}
                                pukul {{ \Carbon\Carbon::parse($w_event->waktu)->format('H:i') }}
                            </div>
                            <div>
                                {{ $w_event->lokasi }}
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="flex-1 w-full">
        <div class="w-3/4 mx-auto">
        {{-- FILTER BUTTON --}}
        <div class="p-4 flex items-center justify-start gap-2 border-b-2 border-pink overflow-x-auto">
            @php
                $buttons = [
                    ['icon' => 'fa-building', 'div_id' => 'include-wo', 'title' => 'organizer'],
                    ['icon' => 'fa-camera-retro', 'div_id' => 'include-wp', 'title' => 'fotografer'],
                    ['icon' => 'fa-utensils', 'div_id' => 'include-ct', 'title' => 'catering'],
                    ['icon' => 'fa-place-of-worship', 'div_id' => 'include-v', 'title' => 'venue'],
                ];
            @endphp
            <button class="w-[40px] aspect-square flex items-center justify-center rounded shadow bg-pink text-white
                outline-pink outline-offset-4
                hover:bg-pink hover:text-white
                focus:bg-pink focus:text-white
                active:bg-pink-active active:text-white
                transition-colors"
                id="filter-btn" title="hapus filter">
                <i class="fa-solid fa-filter"></i>
            </button>
            @foreach ($buttons as $index => $button)
                <button class="w-[40px] aspect-square flex items-center justify-center rounded shadow text-pink
                    outline-pink outline-offset-4
                    hover:bg-pink hover:text-white
                    focus:bg-pink focus:text-white
                    active:bg-pink-active active:text-white
                    transition-colors"
                    {{-- data-tippy-content="{{ $button['title'] }}" --}}
                    data-target="{{ $button['div_id'] }}" title="{{ $button['title'] }}">
                    <i class="fa-solid {{ $button['icon'] }}"></i>
                </button>
            @endforeach
        </div>

        {{-- VENDORS --}}
        <div class="mb-4 max-h-[600px] p-4 grid grid-cols-1 gap-4 overflow-y-auto">
            @include('user.wedding-couple.wedding.detail.wo')

            @include('user.wedding-couple.wedding.detail.wp')

            @include('user.wedding-couple.wedding.detail.ct')

            @include('user.wedding-couple.wedding.detail.v')
        </div>

        @if ($today->lt($eventDate))
            <div class="w-full p-2">
                <a class="block w-fit mx-auto px-4 py-2 text-sm bg-pink text-white outline-pink outline-offset-4 hover:bg-pink-hover focus:bg-pink-hover active:bg-pink-active rounded-full transition-colors"
                    href="{{ route('wedding-couple.search.index') }}">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        Cari Vendor
                </a>
            </div>
        @else
            <div class="w-full p-2 text-center text-slate-300 italic text-sm">
                pemesanan hanya dapat dilakukan sebelum tanggal acara dimulai
            </div>
        @endif
    </div>
    </div>
</div>
