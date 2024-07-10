@extends('user.dashboard-layout')

@section('menu')
    @include('super-admin.menu')
@endsection

@section('tombol-profil')
    <span class="w-[40px] aspect-square bg-pink rounded-full flex items-center justify-center text-[1.25em] font-bold text-white">
        {{ substr(auth()->user()->name, 0, 1) }}
    </span>
@endsection

@section('profil')
    <button class="w-full p-2 bg-white text-slate-400 text-start cursor-not-allowed"
        type="button" disabled>
        <i class="fa-regular fa-user"></i>
        Profil
    </button>
@endsection
