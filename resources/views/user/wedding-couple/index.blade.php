@extends('user.wedding-couple.layout')

@section('title')
    <title>Wedding Marketplace</title>
@endsection

@section('content')
    {{-- ITEM 1 --}}
    <div class="w-full p-4">
        <div class="w-full p-8 flex items-end justify-start bg-pink rounded-3xl">
            <div class="w-2/5 py-8">
                <div>
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
                        <a class="focus:outline-pink w-fit px-4 py-2 rounded-md  border border-white bg-white text-pink shadow hover:bg-pink hover:text-white focus:bg-pink focus:text-white active:bg-white active:text-pink transition-all"
                            href="{{ route('wedding-couple.pernikahan.index') }}">
                            <i class="fa-regular fa-envelope"></i>
                            Buat Undangan
                        </a>
                    @else
                        <a class="focus:outline-pink block w-fit px-4 py-2 rounded-md  border border-white bg-white text-pink shadow hover:bg-pink hover:text-white focus:bg-pink focus:text-white active:bg-white active:text-pink transition-all"
                            href="{{ route('ke_masuk') }}">
                            Bergabung Sekarang
                        </a>
                    @endif
                </div>

                <div class="mt-8">
                    <a class="focus:outline-pink w-fit p-2 text-white font-semibold  hover:underline focus:underline"
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
    <div class="w-full min-h-[80vh] flex items-center justify-start bg-[url('/public/img/bg/wave-bottom.svg')] bg-bottom bg-no-repeat bg-cover">
        <div class="flex-1 w-full flex items-center justify-center">
            <div class="w-fit bg-white rounded-full shadow-lg -rotate-6">
                <img class="w-[400px] aspect-square"
                    src="{{ asset('img/Logo.png') }}" alt="Logo">
            </div>
        </div>

        <div class="flex-1 w-full">
            <div class="w-2/3 mx-auto">
                <p class="relative text-3xl text-black text-center
                    before:content-['“'] before:absolute before:top-0 before:-left-14 before:text-[4em] before:text-pink
                    after:content-['”'] after:absolute after:-bottom-14 after:-right-14 after:text-[4em] after:text-pink
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
            <p class="text-white text-[2em] text-center">
                Penyedia Layanan yang dapat membantu mewujudkan pernikahan impianmu!
            </p>
        </div>
    </div>

    {{-- ITEM 4 --}}
    <div class="w-full min-h-[95vh] p-8 flex flex-col items-center justify-center bg-[url('/public/img/bg/wave-top.svg')] bg-top bg-no-repeat bg-cover"
        id="penyedia-layanan">
        <div class="w-full max-w-[900px] mt-[10em] grid grid-cols-2 gap-8">
            @php
                $services = [
                    [
                        'title' => 'Organizer',
                        'icon' => 'fa-building-user',
                        'route' => 'wedding-couple.search.wo.index'
                    ],
                    [
                        'title' => 'Fotografer',
                        'icon' => 'fa-camera-retro',
                        'route' => 'wedding-couple.search.wp.index'
                    ],
                    [
                        'title' => 'Caterer',
                        'icon' => 'fa-utensils',
                        'route' => 'wedding-couple.search.ct.index'
                    ],
                    [
                        'title' => 'Venue',
                        'icon' => 'fa-place-of-worship',
                        'route' => 'wedding-couple.search.v.index'
                    ]
                ];
            @endphp

            @foreach ($services as $service)
                <div class="w-full mx-auto p-8 flex flex-col items-center justify-between gap-8 rounded-md border-pink border-2 shadow hover:shadow-lg transition-shadow">
                    <div class="w-full flex flex-col items-center justify-start gap-8">
                        <p class="text-3xl font-semibold text-center">
                            {{ $service['title'] }}
                        </p>
                        <i class="fa-solid {{ $service['icon'] }} text-[5em] text-pink"></i>
                    </div>

                    <div class="w-full flex items-center justify-center">
                        @if (auth()->user() && auth()->user()->w_couple)
                            <a class="focus:outline-pink block w-fit px-4 py-2 bg-pink text-white  hover:bg-pink-hover focus:bg-pink-hover active:bg-pink-active rounded-full transition-colors"
                                href="{{ route($service['route']) }}">
                                <i class="fa-solid fa-magnifying-glass"></i>
                                Cari
                            </a>
                        @else
                            <a class="focus:outline-pink block w-fit px-4 py-2 bg-pink text-white  hover:bg-pink-hover focus:bg-pink-hover active:bg-pink-active rounded-full transition-colors"
                                href="{{ route('ke_masuk') }}">
                                <i class="fa-solid fa-magnifying-glass"></i>
                                Masuk untuk Mencari
                            </a>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
