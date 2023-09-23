@extends('main')

@section('title')
    <title>WO | Wedding Marketplace</title>
@endsection

@section('body')
    <h2>Home Wedding Organizer</h2>
    <form action="{{ route('keluar') }}" method="post">
        @csrf
        <button type="submit">Keluar</button>
    </form>
@endsection
