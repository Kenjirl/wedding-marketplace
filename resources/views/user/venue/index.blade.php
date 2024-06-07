@extends('user.venue.layout')

@section('title')
    <title>Dashboard | Wedding Marketplace</title>
@endsection

@section('h1', 'Dashboard')

@section('content')
    @if (!auth()->user()->w_vendor)
        <div class="w-full h-[60vh] flex flex-col items-center justify-center gap-8">
            <span class="text-lg">Silahkan lengkapi profil kamu terlebih dahulu</span>
            <a class="w-fit px-4 py-2 rounded text-white font-semibold bg-pink hover:bg-pink-hover outline-pink outline-offset-4 focus:bg-pink-hover active:bg-pink-active transition-colors"
                href="{{ route('venue.profil.index') }}">
                <i class="fa-regular fa-user"></i>
                Lengkapi Profil
            </a>
        </div>
    @else
        <span>Venue</span>
    @endif
@endsection
