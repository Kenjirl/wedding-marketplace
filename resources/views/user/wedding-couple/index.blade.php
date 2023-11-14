@extends('user.wedding-couple.layout')

@section('title')
    <title>Dashboard | Wedding Marketplace</title>
@endsection

@section('h1', 'Dashboard')

@section('content')
    {{-- ITEM 1 --}}
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
                <a class="w-fit px-4 py-2 rounded-lg border-2 border-white outline-pink bg-white text-pink active:bg-pink active:text-white transition-colors"
                    href="#">
                    <i class="fa-regular fa-envelope"></i>
                    Buat Undangan
                </a>
            </div>

            <div class="mt-8">
                <a class="w-fit px-4 py-2 text-white font-semibold"
                    href="#detail-layanan">
                    Detail Layanan
                    <i class="fa-solid fa-arrow-down"></i>
                </a>
            </div>
        </div>

        <div class="relative w-3/5 bg-slate-50">
            <div class="absolute left-[15%] -bottom-10 w-fit max-w-[300px] h-[600px] shadow-2xl shadow-black/50 rounded-3xl overflow-hidden -rotate-3 z-20">
                <img class="w-full h-full object-cover object-center"
                    src="{{ asset('img/items/8.jpg') }}" alt="">
            </div>

            <div class="absolute left-[48%] -bottom-20 w-fit max-w-[300px] h-[600px] shadow-2xl shadow-black/50 rounded-3xl overflow-hidden rotate-2 z-10">
                <img class="w-full h-full object-cover"
                    src="{{ asset('img/items/2.jpg') }}" alt="">
            </div>
        </div>


    </div>

    {{-- ITEM 2 --}}

    {{-- ITEM 3 --}}
@endsection
