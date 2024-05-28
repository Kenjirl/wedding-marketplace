@extends('user.wedding-couple.layout')

@section('title')
    <title>Pernikahan | Wedding Marketplace</title>
@endsection

@section('content')
    <div class="w-full max-w-[1200px] mx-auto p-4">
        {{-- TITLE --}}
        <div class="w-full mb-4">
            <p class="w-full text-center text-3xl">
                Pernikahan Anda
            </p>
        </div>

        <div class="w-full p-8 grid grid-cols-5 gap-8">
            <a class="w-full min-h-[calc(244px-8px)] flex flex-col items-center justify-center border-4 border-dashed outline-none border-pink rounded-xl text-pink bg-white hover:bg-pink hover:text-white focus:bg-pink focus:text-white active:bg-pink-active active:border-pink-active transition-colors"
                href="{{ route('wedding-couple.pernikahan.ke_tambah') }}">
                <i class="text-[2em] fa-solid fa-plus"></i>
                <span>Buat Pernikahan Anda</span>
            </a>

            @forelse ($weddings as $wedding)
                <div class="w-full flex flex-col items-center justify-end gap-2 shadow rounded-lg border-2 border-slate-100 bg-white hover:shadow-lg transition-shadow">
                    <div class="w-full h-full p-4 flex flex-col items-center justify-center">
                        <p class="text-center text-blue-500">
                            {{ 'Tn. ' . $wedding->p_sapaan }}
                        </p>

                        <p class="text-xl font-semibold">
                            &
                        </p>

                        <p class="text-center text-red-500">
                            {{ 'Nn. ' . $wedding->w_sapaan }}
                        </p>
                    </div>

                    <div class="w-full p-2 flex flex-col items-center justify-start gap-2 border-t-2 border-slate-100">
                        <a class="w-full px-4 py-2 rounded outline-none text-sm text-center text-pink hover:bg-pink-hover hover:text-white focus:bg-pink-hover focus:text-white active:bg-pink-active transition-colors"
                            href="#">
                            Buat Undangan
                        </a>

                        <a class="w-full px-4 py-2 rounded outline-none text-sm text-center bg-pink text-white hover:bg-pink-hover focus:bg-pink-hover active:bg-pink-active transition-colors"
                            href="{{ route('wedding-couple.pernikahan.ke_detail', $wedding->id) }}">
                            Detail
                        </a>
                    </div>
                </div>
            @empty

            @endforelse
        </div>
    </div>
@endsection
