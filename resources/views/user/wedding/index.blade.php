@extends('user.layout')

@section('title')
    <title>Pernikahan | Wedding Marketplace</title>
@endsection

@php
    $today = \Carbon\Carbon::today();
@endphp

@section('content')
    <div class="w-full max-w-[1200px] mx-auto p-4">
        {{-- TITLE --}}
        <div class="w-full mb-4">
            <p class="w-full text-center text-3xl">
                Pernikahan Anda
            </p>
        </div>

        <div class="w-full p-8 grid grid-cols-3 gap-8">
            <a class="w-full min-h-[100px] flex flex-col items-center justify-center border-4 border-dashed outline-none border-pink rounded-xl text-pink bg-white hover:bg-pink hover:text-white focus:bg-pink focus:text-white active:bg-pink-active active:border-pink-active transition-colors"
                href="{{ route('user.pernikahan.ke_tambah') }}">
                <i class="text-[2em] fa-solid fa-plus"></i>
                <span>Buat Pernikahan Anda</span>
            </a>

            @forelse ($weddings as $wedding)
                <div class="w-full shadow rounded-lg border-2 border-slate-100 bg-white hover:shadow-lg transition-shadow">
                    <div class="w-full p-2 flex items-center justify-center font-bold">
                        <p class="w-full text-center text-blue-500 line-clamp-1">
                            {{ $wedding->p_sapaan }}
                        </p>

                        <p class="px-4 text-xl text-pink font-semibold">
                            <i class="fa-solid fa-dove"></i>
                        </p>

                        <p class="w-full text-center text-red-500 line-clamp-1">
                            {{ $wedding->w_sapaan }}
                        </p>
                    </div>

                    <div class="w-full min-h-[125px] p-2 border-y-2 border-slate-100 text-sm">
                        @if ($wedding->w_detail->isNotEmpty())
                            <div class="w-full flex items-center justify-start gap-2">
                                <i class="fa-regular fa-calendar text-pink"></i>
                                <p class="italic text-gray-400">
                                    {{ $wedding->duration }}
                                </p>
                            </div>

                            <div class="w-full p-2">
                                @forelse ($wedding->w_detail as $detail)
                                    <div class="w-full mb-2 last-of-type:mb-0 flex items-center justify-start gap-2">
                                        <div class="w-[25px] aspect-square flex items-center justify-center rounded-sm bg-pink text-white">
                                            {{ $loop->iteration }}
                                        </div>

                                        <div class="line-clamp-1">
                                            {{ $detail->event->nama }}
                                        </div>
                                    </div>
                                    @if ($loop->iteration == 2)
                                        @break
                                    @endif
                                @empty

                                @endforelse
                            </div>
                        @else
                            <div class="w-full h-[100px] italic text-gray-400">
                                Belum ada acara
                            </div>
                        @endif
                    </div>

                    <div class="w-full p-2 grid grid-cols-2 gap-2">
                        @if ($wedding->status == 'selesai' || $wedding->w_detail->isNotEmpty())
                            <a class="w-full px-4 py-2 col-span-2 rounded outline-none text-sm text-center bg-pink text-white hover:bg-pink-hover focus:bg-pink-hover active:bg-pink-active transition-colors"
                                href="{{ route('user.pernikahan.ke_detail', $wedding->id) }}">
                                Detail
                            </a>
                        @else
                            <a class="w-full px-4 py-2 col-span-2 rounded outline-none text-sm text-center bg-pink text-white hover:bg-pink-hover focus:bg-pink-hover active:bg-pink-active transition-colors"
                                href="{{ route('user.pernikahan.ke_acara', $wedding->id) }}">
                                Lengkapi Pernikahan
                            </a>
                        @endif

                        @if (!$wedding->invitation)
                            <a class="w-full px-4 py-2 rounded outline-none text-sm text-center hover:bg-pink-hover hover:text-white focus:bg-pink-hover focus:text-white active:bg-pink-active transition-colors
                                {{ $today->gte($wedding->limit) || $wedding->status == 'belum selesai' ? 'text-white bg-slate-300 pointer-events-none hover:cursor-not-allowed' : 'text-pink' }}
                                "
                                href="{{ route('user.undangan.ke_pilih', ['id'=>$wedding->id]) }}">
                                Buat Undangan
                            </a>
                        @else
                            <a class="w-full px-4 py-2 rounded outline-none text-sm text-center text-pink hover:bg-pink-hover hover:text-white focus:bg-pink-hover focus:text-white active:bg-pink-active transition-colors"
                                href="{{ route('user.undangan.cek', ['id'=>$wedding->id]) }}" target="_blank">
                                Lihat Undangan
                            </a>
                        @endif

                        <a class="w-full px-4 py-2 rounded outline-none text-sm text-center text-pink hover:bg-pink-hover hover:text-white focus:bg-pink-hover focus:text-white active:bg-pink-active transition-colors
                            {{ (!$wedding->invitation || $wedding->invitation->status != 'selesai') ? 'text-white bg-slate-300 pointer-events-none hover:cursor-not-allowed' : 'text-pink' }}
                            "
                            href="{{ route('user.pernikahan.ke_detail', ['id'=>$wedding->id, 'tab' => 'tamu-undangan']) }}">
                            Tamu Undangan
                        </a>
                    </div>
                </div>
            @empty

            @endforelse
        </div>
    </div>
@endsection
