@extends('user.catering.layout')

@section('title')
    <title>Layanan | Wedding Marketplace</title>
@endsection

@section('h1', 'Layanan')

@section('content')
    <div class="w-full p-2">
        <div class="w-full mb-8">
            <a class="w-fit px-4 py-2 rounded text-white font-semibold bg-pink hover:bg-pink-hover focus:bg-pink-hover active:bg-pink-active focus:outline-pink-hover focus:outline-offset-2 transition-colors"
                href="{{ route('catering.layanan.ke_tambah') }}">
                <i class="fa-solid fa-plus"></i>
                Tambah
            </a>
        </div>

        <div class="w-full flex items-stretch justify-normal flex-wrap gap-4">
            @forelse ($plans as $plan)
                <div class="w-full max-w-[20%] flex flex-col items-stretch justify-between rounded shadow">
                    <div class="w-full">
                        <div class="w-full px-4 py-2 flex items-center justify-start gap-2 bg-slate-200 rounded-t">
                            <i class="fa-solid fa-gift"></i>
                            <span class="text-lg line-clamp-1">
                                {{ $plan->nama }}
                            </span>
                        </div>

                        <div class="relative w-full p-2">
                            <img class="w-full aspect-video rounded-lg object-cover"
                                src="{{ asset($plan->foto[0]['url']) }}" alt="Plan {{ $loop->iteration }}">

                            {{-- RATE --}}
                            <div class="absolute top-4 right-4 w-fit px-2 py-1 bg-pink text-white text-sm rounded">
                                <i class="fa-solid fa-star"></i> {{ $plan->rate > 0 ? number_format($plan->rate, 1) : '-' }}
                            </div>

                            {{-- COUNT FOTO --}}
                            <div class="absolute bottom-4 right-4 w-fit px-2 py-1 bg-pink text-white text-sm rounded">
                                {{ count($plan->foto) }} <i class="fa-regular fa-images"></i>
                            </div>
                        </div>

                        <div class="w-full px-4 my-2 text-sm line-clamp-3"
                            id="detailPlan">
                            {!! $plan->detail !!}
                        </div>
                    </div>

                    <div>
                        <div class="w-full p-2 text-end">
                                {{ 'Rp ' . number_format($plan->harga, 0, ',', '.') . ',00-' }}
                        </div>

                        <div class="w-full flex items-center justify-end">
                            <a class="w-full p-2 rounded-b text-pink text-center text-sm font-semibold outline-none bg-white hover:bg-pink hover:text-white focus:bg-pink focus:text-white active:bg-pink-active transition-colors"
                                href="{{ route('catering.layanan.ke_ubah', $plan->id) }}">
                                Detail
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div>
                    Belum ada paket layanan
                </div>
            @endforelse
        </div>
    </div>
@endsection

@push('child-js')
    <script>
        $('document').ready(function () {
            $('#detailPlan ul').addClass('list-disc px-4');
        });
    </script>
@endpush
