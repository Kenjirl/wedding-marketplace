<div class="w-full max-h-none md:max-h-screen font-varela">
    <div class="w-full md:max-h-[50vh] mb-4 md:mb-0 grid grid-cols-1 col md:grid-cols-2 lg:grid-cols-3">
        <div class="lg:col-span-2 w-full flex flex-col items-center justify-center text-center order-last md:order-none">
            <div class="text-md md:text-[1.2em]">
                The Groom
            </div>

            <div class="text-[1.25em] md:text-[2em] lg:text-[4em] font-semibold font-great-vibes">
                {{ $wedding->p_lengkap }}
            </div>

            <div class="px-2 text-sm lg:text-base">
                Putra dari Ayah {{ $wedding->p_ayah }} & Ibu {{ $wedding->p_ibu }}
            </div>
        </div>

        <a class="cursor-zoom-in" data-fancybox="profile"
            href="{{
                    $wedding->invitation ? asset($wedding->invitation->profile['foto_pria']) :
                    asset('template/undangan/profile/groom.jpg')
                    }}">
            <img class="w-full h-[50vh] object-cover order-first md:order-none"
                src="{{
                    $wedding->invitation ? asset($wedding->invitation->profile['foto_pria']) :
                    asset('template/undangan/profile/groom.jpg')
                    }}" alt="Groom">
        </a>
    </div>

    <div class="w-full md:max-h-[50vh] grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3">
        <a class="cursor-zoom-in" data-fancybox="profile"
            href="{{
                    $wedding->invitation ? asset($wedding->invitation->profile['foto_wanita']) :
                    asset('template/undangan/profile/bride.jpg')
                    }}">
            <img class="w-full h-[50vh] object-cover"
                src="{{
                    $wedding->invitation ? asset($wedding->invitation->profile['foto_wanita']) :
                    asset('template/undangan/profile/bride.jpg')
                    }}" alt="Bride">
        </a>

        <div class="lg:col-span-2 w-full flex flex-col items-center justify-center text-center">
            <div class="text-md md:text-[1.2em]">
                The Bride
            </div>

            <div class="text-[1.25em] md:text-[2em] lg:text-[4em] font-semibold font-great-vibes">
                {{ $wedding->w_lengkap }}
            </div>

            <div class="px-2 text-sm lg:text-base">
                Putri dari Ayah {{ $wedding->w_ayah }} & Ibu {{ $wedding->w_ibu }}
            </div>
        </div>
    </div>
</div>
