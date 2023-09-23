@extends('main')

@section('title')
    <title>Wedding Couple | Wedding Marketplace</title>
@endsection

@section('body')
    <h2>Home Wedding Couple</h2>
    <form action="{{ route('keluar') }}" method="post">
        @csrf
        <button type="submit">Keluar</button>
    </form>
@endsection
