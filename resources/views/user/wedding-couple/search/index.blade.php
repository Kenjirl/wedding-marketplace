@extends('user.wedding-couple.layout')

@section('title')
    <title>Penyedia Layanan | Wedding Marketplace</title>
@endsection

@section('content')
    <div class="w-full p-8 grid grid-cols-4 gap-8">
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
                    <a class="focus:outline-pink block w-fit px-4 py-2 bg-pink text-white  hover:bg-pink-hover focus:bg-pink-hover active:bg-pink-active rounded-full transition-colors"
                        href="{{ route($service['route']) }}">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        Cari
                    </a>
                </div>
            </div>
        @endforeach
    </div>
@endsection
