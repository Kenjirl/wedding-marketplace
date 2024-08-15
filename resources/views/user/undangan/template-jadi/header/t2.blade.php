<div class="w-full min-h-screen flex items-center justify-center" style="background-color: #e9e6e1; color: #8c867f;"
    id="header">
    <div class="w-full grid grid-rows-3 text-center font-varela">
        <div class="self-end">
            <div class="w-fit mx-auto px-4 md:text-xl font-semibold border-b-4 border-white rounded-sm drop-shadow-sm">
                HAPPY WEDDING
            </div>
        </div>
        <div class="flex items-center justify-center">
            <div class="text-md text-[2em] md:text-[5em] lg:text-8xl drop-shadow shadow-white font-sacramento capitalize">
                {{ $wedding->p_sapaan }} & {{ $wedding->w_sapaan }}
            </div>
        </div>
        <div class="w-fit mx-auto p-2 md:p-8 bg-white rounded-lg text-[.9em] md:text-base flex flex-col gap-2 md:gap-8">
            <div>
                <div>
                    Kepada Yth. <br> Bapak/Ibu/Saudara/i :
                </div>
                <div class="text-lg md:text-3xl font-semibold font-sacramento">
                    {{ $wedding->invitation ? $tamu->nama : 'Tamu Undangan'}}
                </div>
            </div>
            <div>
                Anda diundang ke acara pernikahan kami
            </div>
        </div>
    </div>
</div>
