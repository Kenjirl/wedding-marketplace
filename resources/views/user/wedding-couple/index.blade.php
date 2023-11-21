@extends('user.wedding-couple.layout')

@section('title')
    <title>Wedding Marketplace</title>
@endsection

@section('content')
    {{-- ITEM 1 --}}
    <div class="w-full p-4">
        <div class="w-full p-8 flex items-end justify-start bg-pink rounded-3xl">
            <div class="w-2/5">
                <div class="mt-16">
                    <h1 class="text-7xl text-white font-semibold">
                        Wujudkan Pernikahan Impianmu
                    </h1>
                </div>

                <div class="mt-8 mb-16">
                    <span class="text-lg text-white">
                        Wujudkan pernikahan impianmu dengan <b>Wedding Marketplace</b>.
                        Desain undangan sesuai keinginan sendiri, temukan organizer, dan pilih fotografer untuk momen berharga hidupmu
                    </span>
                </div>

                <div class="my-16">
                    @if (auth()->user() && auth()->user()->w_couple)
                        <a class="w-fit px-4 py-2 rounded-lg border-2 border-white outline-pink bg-white text-pink active:bg-pink active:text-white transition-colors"
                            href="#">
                            <i class="fa-regular fa-envelope"></i>
                            Buat Undangan
                        </a>
                    @else
                        <a class="w-fit px-4 py-2 rounded-lg border-2 border-white outline-pink bg-white text-pink active:bg-pink active:text-white transition-colors"
                            href="{{ route('ke_masuk') }}">
                            Bergabung Sekarang
                        </a>
                    @endif
                </div>

                <div class="mt-8">
                    <a class="w-fit px-4 py-2 text-white font-semibold"
                        href="#penyedia-layanan">
                        Temukan Penyedia Layanan
                        <i class="fa-solid fa-arrow-down"></i>
                    </a>
                </div>
            </div>

            <div class="relative w-3/5 bg-slate-50">
                <div class="absolute left-[15%] -bottom-10 w-fit max-w-[300px] h-[600px] shadow-2xl shadow-black/50 rounded-3xl overflow-hidden -rotate-3 z-20">
                    <img class="w-full h-full object-cover object-center"
                        src="{{ asset('img/items/8.jpg') }}" alt="Item 1">
                </div>

                <div class="absolute left-[48%] -bottom-20 w-fit max-w-[300px] h-[600px] shadow-2xl shadow-black/50 rounded-3xl overflow-hidden rotate-2 z-10">
                    <img class="w-full h-full object-cover"
                        src="{{ asset('img/items/2.jpg') }}" alt="Item 2">
                </div>
            </div>

        </div>
    </div>

    {{-- ITEM 2 --}}
    <div class="w-full flex items-center justify-start bg-[url('/public/img/bg/wave-bottom.svg')] bg-bottom bg-no-repeat bg-cover">
        <div class="flex-1 w-full min-h-screen flex items-center justify-center">
            <div class="w-fit bg-white rounded-full shadow-lg -rotate-6">
                <img class="w-[500px] aspect-square"
                    src="{{ asset('img/Logo.png') }}" alt="Logo">
            </div>
        </div>

        <div class="flex-1 w-full">
            <div class="w-2/3 mx-auto">
                <p class="relative text-4xl text-black text-center
                    before:content-['“'] before:absolute before:top-0 before:-left-24 before:text-[6em] before:text-pink
                    after:content-['”'] after:absolute after:-bottom-24 after:-right-24 after:text-[6em] after:text-pink
                ">
                    <b class="text-pink">Pernikahan</b>
                    adalah kanvas indah di mana impian menjadi kenyataan, dan cinta melukis warna-warni kebahagiaan abadi yang tak terlupakan
                </p>
            </div>
        </div>
    </div>

    {{-- ITEM 3 --}}
    <div class="w-full bg-pink">
        <div class="w-2/3 mx-auto">
            <p class="text-white text-center">
                Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quaerat animi similique sunt ullam esse corporis molestias illo asperiores, modi explicabo quibusdam voluptatibus vero nisi quisquam iusto harum natus laborum doloremque facere doloribus! Perspiciatis qui voluptates amet, ullam animi quo inventore nisi libero adipisci voluptatem eaque veritatis odit? Cum, autem exercitationem.
            </p>
        </div>
    </div>

    {{-- ITEM 4 --}}
    <div class="w-full min-h-[95vh] mb-20 p-8 flex flex-col items-center justify-end bg-[url('/public/img/bg/wave-top.svg')] bg-top bg-no-repeat bg-cover"
        id="penyedia-layanan">
        <div class="w-full my-8">
            <p class="text-center text-2xl">
                Penyedia Layanan yang dapat membantu mewujudkan pernikahan impianmu!
            </p>
        </div>

        <div class="w-full flex items-center justify-center gap-8">
            <div class="flex-1 w-full flex items-center justify-center">
                <div class="w-2/3 p-4 flex flex-col items-center justify-evenly gap-8 rounded-md border-pink border-2 shadow hover:shadow-lg transition-shadow">
                    <p class="text-3xl font-semibold">
                        Wedding Organizer
                    </p>
                    <i class="fa-solid fa-building-user text-[10em] text-pink"></i>
                    <p class="text-center font-semibold">
                        Temukan Organizer yang dapat mewujudkan setiap detail impian pernikahanmu, menciptakan momen istimewa yang abadi dan tak terlupakan
                    </p>
                    @if (auth()->user() && auth()->user()->w_couple)
                        <a class="w-fit px-4 py-2 bg-pink text-white outline-none hover:bg-pink-hover focus:bg-pink-hover active:bg-pink-active rounded-full transition-colors"
                            href="{{ route('wedding-couple.search.wo.index') }}">
                            <i class="fa-solid fa-magnifying-glass"></i>
                            Cari
                        </a>
                    @else
                        <a class="w-fit px-4 py-2 bg-pink text-white outline-none hover:bg-pink-hover focus:bg-pink-hover active:bg-pink-active rounded-full transition-colors"
                            href="{{ route('ke_masuk') }}">
                            <i class="fa-solid fa-magnifying-glass"></i>
                            Masuk untuk Mencari
                        </a>
                    @endif
                </div>
            </div>

            <div class="flex-1 w-full flex items-center justify-center">
                <div class="w-2/3 p-4 flex flex-col items-center justify-evenly gap-8 rounded-md border-pink border-2 shadow hover:shadow-lg transition-shadow">
                    <p class="text-3xl font-semibold">
                        Wedding Photographer
                    </p>
                    <i class="fa-solid fa-camera-retro text-[10em] text-pink"></i>
                    <p class="text-center font-semibold">
                        Temukan Fotografer yang dapat menangkap kisah cinta dalam setiap bidikan, mengabadikan keindahan pernikahanmu menjadi kenangan abadi yang tiada tara
                    </p>
                    @if (auth()->user() && auth()->user()->w_couple)
                        <a class="w-fit px-4 py-2 bg-pink text-white outline-none hover:bg-pink-hover focus:bg-pink-hover active:bg-pink-active rounded-full transition-colors"
                            href="{{ route('wedding-couple.search.wp.index') }}">
                            <i class="fa-solid fa-magnifying-glass"></i>
                            Cari
                        </a>
                    @else
                        <a class="w-fit px-4 py-2 bg-pink text-white outline-none hover:bg-pink-hover focus:bg-pink-hover active:bg-pink-active rounded-full transition-colors"
                            href="{{ route('ke_masuk') }}">
                            <i class="fa-solid fa-magnifying-glass"></i>
                            Masuk untuk Mencari
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
