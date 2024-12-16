<div class="flex items-center justify-center" style="background-color: #6EACDA; color: #ffffff;"
    id="profile">
    <div class="w-full md:max-h-screen grid grid-cols-1 md:grid-cols-2 font-varela gap-8 md:gap-0">
        <div class="relative w-full md:h-full">
            <a class="cursor-zoom-in" data-fancybox="pfile"
                href="{{
                        $wedding->invitation ? asset($wedding->invitation->profile['foto_pria']) :
                        asset('template/undangan/profile/groom.jpg')
                        }}">
                <img class="w-[200px] h-[300px] mx-auto object-cover rounded-t-full"
                    src="{{
                        $wedding->invitation ? asset($wedding->invitation->profile['foto_pria']) :
                        asset('template/undangan/profile/groom.jpg')
                        }}"
                    alt="Groom">
            </a>

            <div class="w-full px-4 flex flex-col items-center justify-center text-center">
                <div class="text-[2.5em] lg:text-[4em] font-semibold font-great-vibes">
                    {{ $wedding->p_lengkap }}
                </div>

                <div>
                    Putra dari Ayah {{ $wedding->p_ayah }} & Ibu {{ $wedding->p_ibu }}
                </div>
            </div>
        </div>

        <div class="relative w-full md:h-full">
            <a class="cursor-zoom-in" data-fancybox="pfile"
                href="{{
                        $wedding->invitation ? asset($wedding->invitation->profile['foto_wanita']) :
                        asset('template/undangan/profile/bride.jpg')
                        }}">
                <img class="w-[200px] h-[300px] mx-auto object-cover rounded-t-full"
                    src="{{
                        $wedding->invitation ? asset($wedding->invitation->profile['foto_wanita']) :
                        asset('template/undangan/profile/bride.jpg')
                        }}"
                    alt="Bride">
            </a>

            <div class="w-full px-4 flex flex-col items-center justify-center text-center">
                <div class="text-[2.5em] lg:text-[4em] font-semibold font-great-vibes">
                    {{ $wedding->w_lengkap }}
                </div>

                <div>
                    Putri dari Ayah {{ $wedding->w_ayah }} & Ibu {{ $wedding->w_ibu }}
                </div>
            </div>
        </div>
    </div>
</div>
