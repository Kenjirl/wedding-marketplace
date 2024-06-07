@extends('main')

@section('title')
    <title>Pilih Peran | Wedding Marketplace</title>
@endsection

@section('body')
    <div class="w-full h-screen py-5 sm:py-10 bg-white flex flex-col items-center justify-between">
        <div class="w-full max-w-[1000px] mx-auto px-4 bg-white flex flex-col items-center justify-center font-varela">
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

                    <div class="w-full flex items-start justify-evenly gap-4 p-4">
                        {{-- BRIDE --}}
                        <div class="flex-1 w-full text-center">
                            <div class="w-full mb-4 text-center">
                                <h3 class="text-lg text-pink font-semibold">
                                    Sebagai Pasangan Pernikahan
                                </h3>
                            </div>
                            {{-- BRIDES ROLE BTN --}}
                            <button class="w-1/2 aspect-video p-2 rounded-md border-pink border-2 outline-2 outline-offset-4 text-pink hover:bg-pink hover:text-white focus:bg-pink focus:text-white active:bg-pink-active active:border-pink-active active:text-white focus:outline-pink transition-all"
                                id="wedding-couple" type="button" onclick="selectRole('wedding-couple')">
                                <i class="fa-solid fa-dove text-[3em]"></i>
                                <p class="font-semibold">Couple</p>
                            </button>
                        </div>

                        {{-- VENDOR --}}
                        <div class="flex-1 w-full">
                            <div class="w-full mb-4 text-center">
                                <h3 class="text-lg text-pink font-semibold">
                                    Sebagai Vendor Pernikahan
                                </h3>
                            </div>

                            <div class="w-full grid grid-cols-2 gap-4">
                                {{-- WEDDING ORGANIZER ROLE BTN --}}
                                <button class="w-full aspect-video p-2 rounded-md border-pink border-2 outline-2 outline-offset-4 text-pink hover:bg-pink hover:text-white focus:bg-pink focus:text-white active:bg-pink-active active:border-pink-active active:text-white focus:outline-pink transition-all"
                                    id="wedding-organizer" type="button" onclick="selectRole('wedding-organizer')">
                                    <i class="fa-solid fa-building-user text-[3em]"></i>
                                    <p class="font-semibold">Organizer</p>
                                </button>

                                {{-- WEDDING PHOTOGRAPHER ROLE BTN --}}
                                <button class="w-full aspect-video p-2 rounded-md border-pink border-2 outline-2 outline-offset-4 text-pink hover:bg-pink hover:text-white focus:bg-pink focus:text-white active:bg-pink-active active:border-pink-active active:text-white focus:outline-pink transition-all"
                                    id="wedding-photographer" type="button" onclick="selectRole('photographer')">
                                    <i class="fa-solid fa-camera-retro text-[3em]"></i>
                                    <p class="font-semibold">Photographer</p>
                                </button>

                                {{-- WEDDING PHOTOGRAPHER ROLE BTN --}}
                                <button class="w-full aspect-video p-2 rounded-md border-pink border-2 outline-2 outline-offset-4 text-pink hover:bg-pink hover:text-white focus:bg-pink focus:text-white active:bg-pink-active active:border-pink-active active:text-white focus:outline-pink transition-all"
                                    id="wedding-photographer" type="button" onclick="selectRole('catering')">
                                    <i class="fa-solid fa-utensils text-[3em]"></i>
                                    <p class="font-semibold">Catering</p>
                                </button>

                                {{-- WEDDING PHOTOGRAPHER ROLE BTN --}}
                                <button class="w-full aspect-video p-2 rounded-md border-pink border-2 outline-2 outline-offset-4 text-pink hover:bg-pink hover:text-white focus:bg-pink focus:text-white active:bg-pink-active active:border-pink-active active:text-white focus:outline-pink transition-all"
                                    id="wedding-photographer" type="button" onclick="selectRole('venue')">
                                    <i class="fa-solid fa-place-of-worship text-[3em]"></i>
                                    <p class="font-semibold">Venue</p>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div id="keterangan" class="w-2/3 px-4 mx-auto mb-4 text-[.8em] text-center"></div>

                    {{-- SUBMIT BTN --}}
                    <div class="w-full text-center">
                        <button class="w-full max-w-[400px] p-2 text-white font-semibold bg-pink hover:bg-pink-hover focus:bg-pink-hover active:bg-pink-active focus:outline-pink-hover focus:outline-offset-2 disabled:bg-gray-400 disabled:cursor-not-allowed transition-all rounded"
                            id="btnSubmit" type="submit" disabled>Konfirmasi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('child-js')
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
            }
            else if (role === 'wedding-organizer') {
                $('#keterangan').html(`
                    Sebagai <b class="text-pink">Wedding Organizer</b>,
                    anda dapat mengatur profil, menambahkan portofolio, dan menawarkan layanan untuk mengatur jalannya acara pernikahan kepada <b>Wedding Couple</b>.
                `);
            } else if (role === 'photographer') {
                $('#keterangan').html(`
                    Sebagai <b class="text-pink">Wedding Photographer</b>,
                    anda dapat mengatur profil, menambahkan portofolio, dan menawarkan layanan fotografi pernikahan profesional kepada <b>Wedding Couple</b>.
                `);
            } else if (role === 'catering') {
                $('#keterangan').html(`
                    Sebagai <b class="text-pink">Caterer</b>,
                    anda dapat mengatur profil, menambahkan portofolio, dan menawarkan paket menu makanan pernikahan kepada <b>Wedding Couple</b>.
                `);
            } else if (role === 'venue') {
                $('#keterangan').html(`
                    Sebagai <b class="text-pink">Venue Provider</b>,
                    anda dapat mengatur profil, menambahkan portofolio, dan menawarkan venue pernikahan kepada <b>Wedding Couple</b>.
                `);
            } else {
                $('#keterangan').html(`Silahkan pilih berdasasrkan pilihan yang tersedia.`);
            }
        }
    </script>
@endpush
