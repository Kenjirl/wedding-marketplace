<div class="w-full max-h-screen font-varela">
    <div class="w-full max-h-[50vh] grid grid-cols-3">
        <div class="col-span-2 w-full flex flex-col items-center justify-center text-center">
            <div class="text-[1.2em]">
                The Groom
            </div>

            <div class="text-[4em] font-semibold font-great-vibes">
                {{ $wedding->p_lengkap }}
            </div>

            <div>
                Putra dari Ayah {{ $wedding->p_ayah }} & Ibu {{ $wedding->p_ibu }}
            </div>
        </div>

        <img class="w-full h-[50vh] object-cover"
            src="{{ asset('template/undangan/profile/groom.jpg') }}" alt="Groom">
    </div>

    <div class="w-full max-h-[50vh] grid grid-cols-3">
        <img class="w-full h-[50vh] object-cover"
            src="{{ asset('template/undangan/profile/bride.jpg') }}" alt="Bride">

        <div class="col-span-2 w-full flex flex-col items-center justify-center text-center">
            <div class="text-[1.2em]">
                The Bride
            </div>

            <div class="text-[4em] font-semibold font-great-vibes">
                {{ $wedding->w_lengkap }}
            </div>

            <div>
                Putri dari Ayah {{ $wedding->w_ayah }} & Ibu {{ $wedding->w_ibu }}
            </div>
        </div>
    </div>
</div>
