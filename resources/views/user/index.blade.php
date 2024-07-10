@extends('user.layout')

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
                            href="{{ route('user.pernikahan.index') }}">
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
                        @if(App::environment('local'))
                        src="{{ asset('img/items/8.jpg') }}"
                        @else
                        src="https://pro-malamute-vastly.ngrok-free.app/img/items/8.jpg"
                        @endif
                        alt="Item 1">
                </div>

                <div class="absolute left-[48%] -bottom-20 w-fit max-w-[300px] h-[600px] shadow-2xl shadow-black/50 rounded-3xl overflow-hidden rotate-2 z-10">
                    <img class="w-full h-full object-cover"
                        @if(App::environment('local'))
                        src="{{ asset('img/items/2.jpg') }}"
                        @else
                        src="https://pro-malamute-vastly.ngrok-free.app/img/items/2.jpg"
                        @endif
                        alt="Item 2">
                </div>
            </div>

        </div>
    </div>

    {{-- ITEM 2 --}}
    <div class="w-full min-h-[80vh] flex items-center justify-start bg-[url('/public/img/bg/wave-bottom.svg')] bg-bottom bg-no-repeat bg-cover">
        <div class="flex-1 w-full flex items-center justify-center">
            <div class="w-fit bg-white rounded-full shadow-lg -rotate-6">
                <img class="w-[400px] aspect-square"
                    @if(App::environment('local'))
                    src="{{ asset('img/Logo.png') }}"
                    @else
                    src="https://pro-malamute-vastly.ngrok-free.app/img/Logo.png"
                    @endif
                    alt="Logo">
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
        <div class="w-full max-w-[1200px] mt-[5em] grid grid-cols-4 gap-8">
            {{-- @php
                $services = [
                    [
                        'title' => 'Organizer',
                        'icon' => 'fa-building-user',
                        'route' => 'user.search.wo.index'
                    ],
                    [
                        'title' => 'Fotografer',
                        'icon' => 'fa-camera-retro',
                        'route' => 'user.search.wp.index'
                    ],
                    [
                        'title' => 'Caterer',
                        'icon' => 'fa-utensils',
                        'route' => 'user.search.ct.index'
                    ],
                    [
                        'title' => 'Venue',
                        'icon' => 'fa-place-of-worship',
                        'route' => 'user.search.v.index'
                    ]
                ];
            @endphp

            @foreach ($services as $service)
                @php
                    $route = (auth()->user() && auth()->user()->w_couple) ? $service['route'] : 'ke_masuk';
                @endphp
                <a class="w-full mx-auto p-4 flex flex-col items-center justify-between gap-8 rounded-md border outline-pink shadow hover:shadow-lg transition-shadow"
                    href="{{ route($route) }}">
                    <div class="w-full flex flex-col items-center justify-start gap-4">
                        <i class="fa-solid {{ $service['icon'] }} text-[5em] text-pink"></i>
                        <p class="text-xl font-semibold text-center">
                            {{ $service['title'] }}
                        </p>
                    </div>
                </a>
            @endforeach --}}
        </div>
    </div>
@endsection
