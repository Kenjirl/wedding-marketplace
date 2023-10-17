@extends('main')

@section('title')
    <title>Pilih Peran | Wedding Marketplace</title>
@endsection

@section('body')
    <div class="w-full h-screen max-h-[1000px] py-5 sm:py-10 bg-white flex flex-col items-center justify-between">
        <div class="w-full px-4 sm:px-0 sm:w-3/4 max-w-[700px] bg-white flex flex-col items-center justify-center font-varela">
            {{-- HEADING --}}
            <img class="w-[100px] aspect-square rounded-full"
                src="{{ asset('img/Logo.png') }}" alt="Wedding Marketplace Logo">
            <h2 class="font-extrabold text-[1.5em] sm:text-[3em] text-pink">
                Pilih Peran Anda
            </h2>
            <span class="text-[.9em] text-center">
                Apa yang ingin anda cari pada marketplace ini?
            </span>

            {{-- ROLE FORM --}}
            <div class="w-full mb-5">
                {{-- FORM --}}
                <form action="{{ route('pilih_peran') }}" method="post">
                    @csrf
                    <input type="hidden" id="role" name="role" value="">

                    <div class="flex flex-wrap sm:flex-nowrap items-center justify-between gap-4 p-4">
                        {{-- BRIDES ROLE BTN --}}
                        <button class="w-full sm:h-[300px] p-2 flex-1/2 sm:flex-1 flex flex-col items-center justify-evenly gap-2 sm:gap-0 rounded-md border-pink border-2 outline-2 outline-offset-4 text-pink hover:bg-pink hover:text-white focus:bg-pink focus:text-white active:bg-pink-active active:border-pink-active active:text-white focus:outline-pink transition-all"
                            id="wedding-couple" type="button" onclick="selectRole('wedding-couple')">
                            <p class="font-semibold">Wedding</p>
                            <i class="fa-solid fa-dove text-[2em] sm:text-[5em]"></i>
                            <p class="font-semibold">Couple</p>
                        </button>

                        {{-- WEDDING ORGANIZER ROLE BTN --}}
                        <button class="w-full sm:h-[300px] p-2 flex-1 flex flex-col items-center justify-evenly gap-2 sm:gap-0 rounded-md border-pink border-2 outline-2 outline-offset-4 text-pink hover:bg-pink hover:text-white focus:bg-pink focus:text-white active:bg-pink-active active:border-pink-active active:text-white focus:outline-pink transition-all"
                            id="wedding-organizer" type="button" onclick="selectRole('wedding-organizer')">
                            <p class="font-semibold">Wedding</p>
                            <i class="fa-solid fa-building-user text-[2em] sm:text-[5em]"></i>
                            <p class="font-semibold">Organizer</p>
                        </button>

                        {{-- WEDDING PHOTOGRAPHER ROLE BTN --}}
                        <button class="w-full sm:h-[300px] p-2 flex-1 flex flex-col items-center justify-evenly gap-2 sm:gap-0 rounded-md border-pink border-2 outline-2 outline-offset-4 text-pink hover:bg-pink hover:text-white focus:bg-pink focus:text-white active:bg-pink-active active:border-pink-active active:text-white focus:outline-pink transition-all"
                            id="wedding-photographer" type="button" onclick="selectRole('wedding-photographer')">
                            <p class="font-semibold">Wedding</p>
                            <i class="fa-solid fa-camera-retro text-[2em] sm:text-[5em]"></i>
                            <p class="font-semibold">Photographer</p>
                        </button>
                    </div>

                    <div id="keterangan" class="px-4 mb-4 text-[.8em]"></div>

                    {{-- SUBMIT BTN --}}
                    <button class="w-full p-2 text-white font-semibold bg-pink hover:bg-pink-hover focus:bg-pink-hover active:bg-pink-active focus:outline-pink-hover focus:outline-offset-2 disabled:bg-gray-400 disabled:cursor-not-allowed transition-all rounded"
                        id="btnSubmit" type="submit" disabled>Konfirmasi</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
<script>
    function selectRole(role) {
        $("button:not(#btnSubmit)").removeClass("bg-pink text-white").addClass("text-pink");
        $('#' + role).addClass("bg-pink text-white");

        $('#role').val(role);
        $('#btnSubmit').prop('disabled', role === '');

        if (role === 'wedding-couple') {
            $('#keterangan').html(`
                Sebagai <b class="text-pink">Wedding Couple</b>,
                anda dapat mencari <b>Wedding Organizer</b> dan <b>Wedding Photographer</b>, membuat dan mengatur undangan, serta mengelola tamu undangan untuk pernikahan anda.
            `);
        } else if (role === 'wedding-organizer') {
            $('#keterangan').html(`
                Sebagai <b class="text-pink">Wedding Organizer</b>,
                anda dapat mengatur profil, menambahkan portofolio, dan menawarkan paket layanan kepada <b>Wedding Couple</b>.
            `);
        } else {
            $('#keterangan').html(`
                Sebagai <b class="text-pink">Wedding Photographer</b>,
                anda dapat mengatur profil, menambahkan portofolio, dan menawarkan paket layanan kepada <b>Wedding Couple</b>.
            `);
        }
    }
</script>
@endsection
