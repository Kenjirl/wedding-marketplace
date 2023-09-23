@extends('main')

@section('title')
    <title>WP | Wedding Marketplace</title>
@endsection

@section('body')
    <h2>Home Wedding Photographer</h2>
    <form action="{{ route('keluar') }}" method="post">
        @csrf
        <button type="submit">Keluar</button>
    </form>
@endsection
