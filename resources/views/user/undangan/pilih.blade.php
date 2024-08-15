@extends('user.layout')

@section('title')
    <title>Pilih Template Undangan | Wedding Marketplace</title>
@endsection

@section('content')
    <div class="w-full max-w-[1200px] mx-auto p-4">
        {{-- TITLE --}}
        <div class="w-full mb-4">
            <p class="w-full text-center text-3xl">
                Pilih Template Undangan Anda
            </p>
        </div>

        <div class="w-full p-8 grid grid-cols-4 gap-8">
            <a class="w-full aspect-square flex flex-col items-center justify-center border-2 border-dashed outline-none border-pink rounded-xl text-pink bg-white hover:bg-pink hover:text-white focus:bg-pink focus:text-white active:bg-pink-active active:border-pink-active transition-colors"
                href="{{ route('user.undangan.ke_tambah') }}?id={{ $wedding->id }}">
                <i class="text-[2em] fa-solid fa-plus"></i>
                <span>Buat Undangan Anda Sendiri</span>
            </a>

            @for ($i = 1;  $i<=$f_counts['header']; $i++)
                <a class="w-full aspect-square flex flex-col items-center justify-center border-2 border-dashed outline-none border-pink rounded-xl text-pink bg-white hover:bg-pink hover:text-white focus:bg-pink focus:text-white active:bg-pink-active active:border-pink-active transition-colors"
                    href="{{ route('user.undangan.ke_tambah_jadi') }}?id={{ $wedding->id }}&template=t{{ $i }}">
                    <span>Template {{ $i }}</span>
                </a>
            @endfor
        </div>
    </div>
@endsection
