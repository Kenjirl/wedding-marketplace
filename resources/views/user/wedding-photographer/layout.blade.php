@extends('user.dashboard-layout')

@section('menu')
    @include('user.wedding-photographer.menu')
@endsection

@section('tombol-profil')
    @if (auth()->user()->w_photographer && auth()->user()->w_photographer->foto_profil)
        <img class="w-[40px] aspect-square object-cover object-center rounded-full"
            src="{{ asset(auth()->user()->w_photographer->foto_profil) }}" alt="Foto Profil">
    @else
        <span class="w-[40px] aspect-square bg-pink rounded-full flex items-center justify-center text-[1.25em] font-bold text-white">
            {{ substr(auth()->user()->name, 0, 1) }}
        </span>
    @endif
@endsection

@section('profil')
    <a class="w-full p-2 bg-white hover:bg-pink hover:text-white focus:outline-none focus:bg-pink focus:text-white active:bg-pink-active transition-colors"
        href="{{ route('wedding-photographer.profil.index') }}">
        <i class="fa-regular fa-user"></i>
        Profil
    </a>
@endsection
