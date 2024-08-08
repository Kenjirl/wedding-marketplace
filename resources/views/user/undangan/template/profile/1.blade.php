<div class="w-full md:max-h-screen grid grid-cols-1 md:grid-cols-2 font-varela">
    <div class="relative w-full h-screen md:h-full">
        <img class="w-full h-screen md:max-h-screen object-cover brightness-50"
            src="{{
                $wedding->invitation ? asset($wedding->invitation->profile['foto_pria']) :
                asset('template/undangan/profile/groom.jpg')
                }}"
            alt="Groom">

        <div class="absolute bottom-0 left-0 w-full h-1/2 px-4 flex flex-col items-center justify-center text-center">
            <div class="text-[1.2em]">
                The Groom
            </div>

            <div class="text-[2.5em] lg:text-[4em] font-semibold font-great-vibes">
                {{ $wedding->p_lengkap }}
            </div>

            <div>
                Putra dari Ayah {{ $wedding->p_ayah }} & Ibu {{ $wedding->p_ibu }}
            </div>
        </div>
    </div>

    <div class="relative w-full h-screen md:h-full">
        <img class="w-full h-screen md:max-h-screen object-cover brightness-50"
            src="{{
                $wedding->invitation ? asset($wedding->invitation->profile['foto_wanita']) :
                asset('template/undangan/profile/bride.jpg')
                }}"
            alt="Bride">

        <div class="absolute bottom-0 left-0 w-full h-1/2 px-4 flex flex-col items-center justify-center text-center">
            <div class="text-[1.2em]">
                The Bride
            </div>

            <div class="text-[2.5em] lg:text-[4em] font-semibold font-great-vibes">
                {{ $wedding->w_lengkap }}
            </div>

            <div>
                Putri dari Ayah {{ $wedding->w_ayah }} & Ibu {{ $wedding->w_ibu }}
            </div>
        </div>
    </div>
</div>
