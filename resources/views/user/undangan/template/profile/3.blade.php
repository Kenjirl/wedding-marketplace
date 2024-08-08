<div class="w-full max-h-screen font-varela">
    <div class="w-full max-h-[50vh] grid grid-cols-2">
        <div class=" w-full flex flex-col items-center justify-center text-center">
            <div class="text-[1.2em]">
                The Groom
            </div>

            <div class="text-[3em] font-semibold font-great-vibes">
                {{ $wedding->p_lengkap }}
            </div>

            <div>
                Putra dari Ayah {{ $wedding->p_ayah }} & Ibu {{ $wedding->p_ibu }}
            </div>
        </div>

        <img class="w-full max-h-[50vh] object-cover brightness-50"
            src="{{
                $wedding->invitation ? asset($wedding->invitation->profile['foto_pria']) :
                asset('template/undangan/profile/groom.jpg')
                }}" alt="Groom">
    </div>

    <div class="w-full max-h-[50vh] grid grid-cols-2">
        <img class="w-full max-h-[50vh] object-cover brightness-50"
            src="{{
                $wedding->invitation ? asset($wedding->invitation->profile['foto_wanita']) :
                asset('template/undangan/profile/bride.jpg')
                }}" alt="Bride">

        <div class=" w-full flex flex-col items-center justify-center text-center">
            <div class="text-[1.2em]">
                The Bride
            </div>

            <div class="text-[3em] font-semibold font-great-vibes">
                {{ $wedding->w_lengkap }}
            </div>

            <div>
                Putri dari Ayah {{ $wedding->w_ayah }} & Ibu {{ $wedding->w_ibu }}
            </div>
        </div>
    </div>
</div>
