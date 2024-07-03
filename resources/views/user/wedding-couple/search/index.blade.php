@extends('user.wedding-couple.layout')

@section('title')
    <title>Penyedia Layanan | Wedding Marketplace</title>
@endsection

@section('content')
    <div class="w-full max-w-[1200px] mx-auto mt-10 p-4 grid grid-cols-4 gap-4">
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
        @endforeach
    </div>
@endsection
