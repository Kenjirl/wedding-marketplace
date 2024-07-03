<div class="w-full grid grid-flow-row gap-2 text-center font-varela">
    <div class="self-end">
        <div class="text-xl">
            The Wedding of
        </div>
    </div>

    <div class="self-center" id="sdiv"
        style="background-color: {{ $wedding->invitation ? $wedding->invitation->c_header['sdiv'] : '#ffffff'}}; color: {{ $wedding->invitation ? $wedding->invitation->c_header['text'] : '#000000'}};">
        <div class="w-full p-5">
            <div class="w-[200px] aspect-square mx-auto flex items-center justify-center rounded-full font-great-vibes text-[4em] shadow-lg"
                id="div"
                style="background-color: {{ $wedding->invitation ? $wedding->invitation->c_header['div'] : '#ffffff'}};">
                <div class="pb-4">{{ substr($wedding->p_sapaan, 0, 1) }}</div>
                <div class="pt-4 pr-4">{{ substr($wedding->w_sapaan, 0, 1) }}</div>
            </div>
            <div class="text-[5em] font-semibold font-great-vibes"
                style="color: {{ $wedding->invitation ? $wedding->invitation->c_header['stext'] : '#000000'}};"
                id="stext">
                {{ $wedding->p_sapaan }} & {{ $wedding->w_sapaan }}
            </div>
        </div>
    </div>

    <div class="flex flex-col gap-8">
        <div>
            <div>
                Kepada Yth. <br> Bapak/Ibu/Saudara/i :
            </div>
            <div class="text-2xl font-semibold">
                {{ $wedding->invitation ? $tamu->nama : 'Tamu Undangan'}}
            </div>
        </div>
        <div>
            Anda diundang ke acara pernikahan kami
        </div>
    </div>
</div>
