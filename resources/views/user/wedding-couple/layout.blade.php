@extends('user.dashboard-layout')

@section('title')
    @yield('title')
@endsection

@section('menu')
    @include('user.wedding-couple.menu')
@endsection

@section('h1')
    @yield('h1')
@endsection

@section('tombol-profil')
    @if (auth()->user()->w_couple && auth()->user()->w_couple->foto_profil)
        <img class="w-[40px] aspect-square object-cover object-center rounded-full"
            src="{{ asset(auth()->user()->w_couple->foto_profil) }}" alt="Foto Profil">
    @else
        <span class="w-[40px] aspect-square bg-pink rounded-full flex items-center justify-center text-[1.25em] font-bold text-white">
            {{ substr(auth()->user()->name, 0, 1) }}
        </span>
    @endif
@endsection

@section('profil')
    <a class="w-full p-2 bg-white hover:bg-pink hover:text-white focus:outline-none focus:bg-pink focus:text-white active:bg-pink-active transition-colors"
        href="{{ route('wedding-couple.ke_profil') }}">
        <i class="fa-regular fa-user"></i>
        Profil
    </a>
@endsection

@section('content')
    <span>Wedding Couple</span>
@endsection
