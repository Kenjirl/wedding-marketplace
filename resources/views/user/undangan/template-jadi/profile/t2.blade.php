<div class="md:py-10 flex items-center justify-center" style="background-color: #e9e6e1; color: #8c867f;"
    id="profile">
    <div class="w-full md:max-h-screen grid grid-cols-1 lg:grid-cols-2 font-varela gap-4">
        <div class="relative w-full px-2 lg:px-0 md:h-full flex flex-row-reverse items-center justify-center gap-4">
            <a class="cursor-zoom-in" data-fancybox="pfile"
                href="{{
                        $wedding->invitation ? asset($wedding->invitation->profile['foto_pria']) :
                        asset('template/undangan/profile/groom.jpg')
                        }}">
                <img class="w-[150px] md:w-[250px] h-[250px] md:h-[400px] object-cover rounded-full border-4 border-white drop-shadow-sm"
                    src="{{
                        $wedding->invitation ? asset($wedding->invitation->profile['foto_pria']) :
                        asset('template/undangan/profile/groom.jpg')
                        }}"
                    alt="Groom">
            </a>

            <div class="w-full flex flex-col items-end justify-center text-end">
                <div class="w-full text-xl md:text-3xl lg:text-6xl font-sacramento">
                    {{ $wedding->p_lengkap }}
                </div>

                <div class="text-sm md:text-base">
                    Putra dari Ayah {{ $wedding->p_ayah }} & Ibu {{ $wedding->p_ibu }}
                </div>
            </div>
        </div>

        <div class="relative w-full px-2 lg:px-0 md:h-full flex items-center justify-center gap-4">
            <a class="cursor-zoom-in" data-fancybox="pfile"
                href="{{
                        $wedding->invitation ? asset($wedding->invitation->profile['foto_wanita']) :
                        asset('template/undangan/profile/bride.jpg')
                        }}">
                <img class="w-[150px] md:w-[250px] h-[250px] md:h-[400px] object-cover rounded-full border-4 border-white drop-shadow-sm"
                    src="{{
                        $wedding->invitation ? asset($wedding->invitation->profile['foto_wanita']) :
                        asset('template/undangan/profile/bride.jpg')
                        }}"
                    alt="Bride">
            </a>

            <div class="w-full flex flex-col items-start justify-center text-start">
                <div class="w-full text-xl md:text-3xl lg:text-6xl font-sacramento">
                    {{ $wedding->w_lengkap }}
                </div>

                <div class="text-sm md:text-base">
                    Putri dari Ayah {{ $wedding->w_ayah }} & Ibu {{ $wedding->w_ibu }}
                </div>
            </div>
        </div>
    </div>
</div>
