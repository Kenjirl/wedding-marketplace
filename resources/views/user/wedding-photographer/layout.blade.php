@extends('user.dashboard-layout')

@section('title')
    @yield('title')
@endsection

@section('menu')
    @include('user.wedding-photographer.menu')
@endsection

@section('h1')
    @yield('h1')
@endsection

@section('profil')
    <a class="w-full p-2 bg-white hover:bg-pink hover:text-white focus:outline-none focus:bg-pink focus:text-white active:bg-pink-active transition-colors"
        href="{{ route('wedding-photographer.ke_profil') }}">
        <i class="fa-regular fa-user"></i>
        Profil
    </a>
@endsection

@section('content')
    <span>Wedding Photograper</span>
@endsection
