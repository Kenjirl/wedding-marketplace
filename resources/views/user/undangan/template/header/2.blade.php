<div class="w-full grid grid-rows-3 gap-4 text-start font-varela">
    <div class="px-10 self-end">
        <div class="text-xl">
            The Wedding of
        </div>
    </div>
    <div class="self-center px-10" id="sdiv"
        style="background-color: {{ $wedding->invitation ? $wedding->invitation->header['sdiv'] : '#ffffff'}};">
        <div class="text-md lg:text-[5em] font-great-vibes font-extrabold"
            style="color: {{ $wedding->invitation ? $wedding->invitation->header['stext'] : '#000000'}};"
            id="stext">
            {{ $wedding->p_sapaan }} & {{ $wedding->w_sapaan }}
        </div>
    </div>
    <div class="px-10 flex flex-col gap-8">
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
