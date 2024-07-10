@extends('vendor.layout')

@section('title')
    <title>Dashboard | Wedding Marketplace</title>
@endsection

@section('h1', 'Dashboard')

@section('content')
    @if (!auth()->user()->w_vendor || auth()->user()->w_vendor->jenis->isEmpty())
        <div class="w-full h-[60vh] flex flex-col items-center justify-center gap-8">
            @if (auth()->user()->w_vendor->jenis->isNotEmpty())
                <span class="text-lg">Silahkan lengkapi profil kamu terlebih dahulu</span>
            @else
                <span class="text-lg">Silahkan pilih minimal 1 jenis vendor</span>
            @endif
            <a class="w-fit px-4 py-2 rounded text-white font-semibold bg-pink hover:bg-pink-hover outline-pink outline-offset-4 focus:bg-pink-hover active:bg-pink-active transition-colors"
                href="{{ route('vendor.profil.index') }}">
                <i class="fa-regular fa-user"></i>
                Lengkapi Profil
            </a>
        </div>
    @else
        <span>Wedding Organizer</span>
    @endif
@endsection
