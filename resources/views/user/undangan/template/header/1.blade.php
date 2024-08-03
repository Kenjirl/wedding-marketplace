<div class="w-full grid grid-rows-3 text-center font-varela">
    <div class="self-end">
        <div class="md:text-xl">
            The Wedding of
        </div>
    </div>
    <div id="sdiv" class="flex items-center justify-center"
        style="background-color: {{ $wedding->invitation ? $wedding->invitation->header['sdiv'] : '#ffffff'}};">
        <div class="text-md text-[2em] md:text-[5em] lg:text-[7em] font-great-vibes font-extrabold"
            style="color: {{ $wedding->invitation ? $wedding->invitation->header['stext'] : '#000000'}};"
            id="stext">
            {{ $wedding->p_sapaan }} & {{ $wedding->w_sapaan }}
        </div>
    </div>
    <div class="mt-4 text-[.9em] md:text-base flex flex-col gap-8">
        <div>
            <div>
                Kepada Yth. <br> Bapak/Ibu/Saudara/i :
            </div>
            <div class="text-lg md:text-2xl font-semibold">
                {{ $wedding->invitation ? $tamu->nama : 'Tamu Undangan'}}
            </div>
        </div>
        <div>
            Anda diundang ke acara pernikahan kami
        </div>
    </div>
</div>
