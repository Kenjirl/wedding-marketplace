@php
    $currentUrl = Request::url();
@endphp
<div class="relative w-full">
    @auth
    @if (!$wedding->invitation)
        <div class="absolute -top-14 w-full flex items-center justify-center gap-4">
            <button id="toggleConfirmButton" class="w-[40px] aspect-square flex items-center justify-center shadow-sm text-xl text-white bg-pink border border-pink rounded"
                type="button" title="Lihat Form Kehadiran" onclick="toggleVisibility('wishConfirm')">
                <i class="fa-solid fa-clipboard-question"></i>
            </button>
            <button id="toggleFormButton" class="w-[40px] aspect-square flex items-center justify-center shadow-sm text-xl text-pink bg-white border border-pink rounded"
                type="button" title="Lihat Form Komentar" onclick="toggleVisibility('wishForm')">
                <i class="fa-regular fa-keyboard"></i>
            </button>
            <button id="toggleListButton" class="w-[40px] aspect-square flex items-center justify-center shadow-sm text-xl text-pink bg-white border border-pink rounded"
                type="button" title="Lihat Daftar Komentar" onclick="toggleVisibility('wishList')">
                <i class="fa-regular fa-rectangle-list"></i>
            </button>
        </div>
    @endif
    @endauth

    <div class="w-full">
        <div class="w-full py-8 px-4 md:px-10 lg:px-20 max-w-[90%] lg:max-w-[75%] mx-auto shadow-lg sdiv
            {{ ($wedding->invitation && $tamu->respon != 'Belum Menjawab') ? 'hidden' : ''}}"
            style="background-color: {{ $wedding->invitation ? $wedding->invitation->wish['sdiv'] : '#ffffff'}}"
            id="wishConfirm">
            <div class="w-full mb-8 text-center">
                <span class="text-[2em] md:text-[4em] font-great-vibes font-semibold"
                    style="color: {{ $wedding->invitation ? $wedding->invitation->wish['stext'] : '#000000'}};"
                    id="stext">
                    RSVP
                </span>
                <p class="italic text-[.8em] md:text-base"
                    style="color: {{ $wedding->invitation ? $wedding->invitation->wish['stext'] : '#000000'}};"
                    id="stext">
                    Silahkan konfirmasi kehadiran Anda, dan berapa jumlah tamu yang akan datang <br> (terhitung termasuk Anda)
                </p>
            </div>
            <form action="{{ $wedding->invitation ? route('user.tamu.rsvp', $tamu->id) : '#' }}" method="POST">
                @csrf
                <div class="w-full mb-4 text-[.8em] md:text-base">
                    <label class="w-full"
                        for="konfirmasi"
                        style="color: {{ $wedding->invitation ? $wedding->invitation->wish['stext'] : '#000000'}};"
                        id="stext">Konfirmasi Kehadiran</label>
                    <select class="w-full p-2 rounded border text-black"
                        name="konfirmasi" id="konfirmasi">
                        <option value="tidak hadir" selected>Tidak Hadir</option>
                        <option value="hadir">Hadir</option>
                    </select>
                </div>

                <div class="w-full mb-4 text-[.8em] md:text-base hidden" id="jumlahTamuContainer">
                    <label class="w-full"
                        for="jumlah_tamu"
                        style="color: {{ $wedding->invitation ? $wedding->invitation->wish['stext'] : '#000000'}};"
                        id="stext">Jumlah Tamu</label>
                    <select class="w-full p-2 rounded border text-black"
                        name="jumlah_tamu" id="jumlah_tamu" hidden>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                    </select>
                </div>

                <button class="block w-fit px-4 py-2 mx-auto text-[.8em] md:text-base rounded font-semibold border shadow-sm"
                    type="{{ $wedding->invitation ? 'submit' : 'button' }}"
                    style="background-color: {{ $wedding->invitation ? $wedding->invitation->wish['div'] : '#ffffff'}}; color: {{ $wedding->invitation ? $wedding->invitation->wish['text'] : '#000000'}}"
                    id="div"
                    {{ !$wedding->invitation ? 'disabled' : '' }}>
                    Konfirmasi
                </button>
            </form>
        </div>

        <div class="w-full py-8 px-4 md:px-10 lg:px-20 max-w-[90%] lg:max-w-[75%] mx-auto shadow-lg sdiv
            {{ ($wedding->invitation && $tamu->respon != 'Belum Menjawab' && $tamu->pesan == null) ? '' : 'hidden'}}"
            style="background-color: {{ $wedding->invitation ? $wedding->invitation->wish['sdiv'] : '#ffffff'}}"
            id="wishForm">
            <div class="w-full mb-8 text-center">
                <span class="text-[2em] md:text-[4em] font-great-vibes font-semibold"
                    style="color: {{ $wedding->invitation ? $wedding->invitation->wish['stext'] : '#000000'}};"
                    id="stext">
                    Beri Ucapan Selamat
                </span>
                <p class="italic text-[.8em] md:text-base"
                    style="color: {{ $wedding->invitation ? $wedding->invitation->wish['stext'] : '#000000'}};"
                    id="stext">
                    Merupakan kehormatan dan kebahagiaan bagi kami, jika Anda berkenan hadir dan memberikan restu kepada kami
                </p>
            </div>
            <form action="{{ $wedding->invitation ? route('user.tamu.wish', $tamu->id) : '#' }}" method="POST">
                @csrf
                <textarea class="w-full mb-4 p-2 md:p-4 text-[.8em] md:text-base rounded border text-black resize-none"
                    name="wish" id="wish" rows="3" placeholder="tulis pesan dan doa untuk pasangan pengantin"></textarea>

                <button class="block w-fit px-4 py-2 mx-auto text-[.8em] md:text-base rounded font-semibold border shadow-sm"
                    style="background-color: {{ $wedding->invitation ? $wedding->invitation->wish['div'] : '#ffffff'}}; color: {{ $wedding->invitation ? $wedding->invitation->wish['text'] : '#000000'}}"
                    type="{{ $wedding->invitation ? 'submit' : 'button' }}" id="div"
                    {{ !$wedding->invitation ? 'disabled' : '' }}>
                    Kirim Pesan
                </button>
            </form>
        </div>

        <div class="w-full py-8 px-2 md:p-8 lg:px-20 max-w-[90%] lg:max-w-[75%] mx-auto shadow-lg sdiv
            {{ ($wedding->invitation && $tamu->pesan != null) ? '' : 'hidden'}}"
            style="background-color: {{ $wedding->invitation ? $wedding->invitation->wish['sdiv'] : '#ffffff'}}"
            id="wishList">
            <div class="w-full mb-8 text-center">
                <span class="text-[1.5em] md:text-[3em] lg:text-[4em] font-great-vibes font-semibold"
                    style="color: {{ $wedding->invitation ? $wedding->invitation->wish['stext'] : '#000000'}};"
                    id="stext">
                    Kumpulan Ucapan & Doa
                </span>
                <p class="italic text-[.8em] md:text-base"
                    style="color: {{ $wedding->invitation ? $wedding->invitation->wish['stext'] : '#000000'}};"
                    id="stext">
                    Terima kasih telah bergabung dan memberikan restu kepada kami
                </p>
            </div>
            <div class="min-h-[50vh] max-h-[50vh] p-2 overflow-y-auto">
                @if ($wedding->invitation)
                    @forelse ($wedding->guests as $tamu)
                        @if ($tamu->pesan != null)
                            <div class="w-full p-2 mb-4 last-of-type:mb-0 flex items-center justify-center rounded-xl shadow-md"
                                style="background-color: {{ $wedding->invitation ? $wedding->invitation->wish['div'] : '#ffffff'}}; color: {{ $wedding->invitation ? $wedding->invitation->wish['text'] : '#000000'}}"
                                id="div">
                                <div class="hidden w-1/5 md:flex flex-col items-center justify-center">
                                    <div class="text-xl font-bold font-great-vibes">
                                        WM
                                    </div>
                                    <div>
                                        INVITATIONS
                                    </div>
                                </div>

                                <div class="w-full md:w-4/5 p-2 md:border-l-2">
                                    <div class="w-full md:text-[1.2em] font-semibold">
                                        {{ $tamu->nama }}
                                    </div>
                                    <div class="w-full mb-2 text-[.8em] italic">
                                        {{ \Carbon\Carbon::parse($tamu->created_at)->translatedFormat('l, d F Y') }}
                                    </div>
                                    <div class="text-[.8em] md:text-sm">
                                        {{ $tamu->pesan }}
                                    </div>
                                </div>
                            </div>
                        @endif
                    @empty
                        <div class="text-black">Belum ada ucapan</div>
                    @endforelse
                @else
                    @for ($i = 0; $i < 10; $i++)
                        <div class="w-full p-2 mb-4 last-of-type:mb-0 flex items-center justify-center rounded-xl shadow-md" style="background-color: #ffffff;"
                            id="div">
                            <div class="w-1/5 flex flex-col items-center justify-center">
                                <div class="text-xl font-bold font-great-vibes">
                                    WM
                                </div>
                                <div>
                                    INVITATIONS
                                </div>
                            </div>

                            <div class="w-4/5 p-2 border-l-2">
                                <div class="w-full mb-1 text-[1.2em] font-semibold">
                                    Tamu Undangan
                                </div>
                                <div class="w-full mb-2 text-sm italic">
                                    Jumat, 22 Juni 2024 - 12.59
                                </div>
                                <div class="text-sm">
                                    {{ substr('
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam id dolor id nibh ultricies vehicula ut id elit. Integer posuere erat a ante venenatis dapibus posuere velit aliquet. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum.
                                    ', $i*20) }}
                                </div>
                            </div>
                        </div>
                    @endfor
                @endif
            </div>
        </div>
    </div>
</div>

@auth
    <script>
        $('#konfirmasi').on('change', function() {
            if ($(this).val() === 'hadir') {
                $('#jumlahTamuContainer').removeClass('hidden');
                $('#jumlah_tamu').removeAttr('hidden');
            } else {
                $('#jumlahTamuContainer').addClass('hidden');
                $('#jumlah_tamu').attr('hidden', true);
            }
        });

        function toggleVisibility(id) {
            const $confirm = $('#wishConfirm');
            const $form = $('#wishForm');
            const $list = $('#wishList');

            if (id === 'wishConfirm') {
                $confirm.removeClass('hidden');
                $form.addClass('hidden');
                $list.addClass('hidden');
            } else if (id === 'wishForm') {
                $form.removeClass('hidden');
                $confirm.addClass('hidden');
                $list.addClass('hidden');
            } else if (id === 'wishList') {
                $list.removeClass('hidden');
                $confirm.addClass('hidden');
                $form.addClass('hidden');
            }
        }

        $('#toggleConfirmButton').on('click', function() {
            toggleVisibility('wishConfirm');
            $(this).removeClass('text-pink bg-white').addClass('text-white bg-pink');
            $('#toggleFormButton').removeClass('text-white bg-pink').addClass('text-pink bg-white');
            $('#toggleListButton').removeClass('text-white bg-pink').addClass('text-pink bg-white');
        });

        $('#toggleFormButton').on('click', function() {
            toggleVisibility('wishForm');
            $(this).removeClass('text-pink bg-white').addClass('text-white bg-pink');
            $('#toggleConfirmButton').removeClass('text-white bg-pink').addClass('text-pink bg-white');
            $('#toggleListButton').removeClass('text-white bg-pink').addClass('text-pink bg-white');
        });

        $('#toggleListButton').on('click', function() {
            toggleVisibility('wishList');
            $(this).removeClass('text-pink bg-white').addClass('text-white bg-pink');
            $('#toggleConfirmButton').removeClass('text-white bg-pink').addClass('text-pink bg-white');
            $('#toggleFormButton').removeClass('text-white bg-pink').addClass('text-pink bg-white');
        });
    </script>
@endauth
