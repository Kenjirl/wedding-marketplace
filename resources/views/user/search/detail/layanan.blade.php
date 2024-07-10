@extends('user.search.detail.index')

@section('item')
    @if (!$plans->isEmpty())
        <div class="w-full">
            {{-- list paket layanan bawah --}}
            <div class="w-full mt-2 py-4 px-2 grid grid-cols-4 gap-4 overflow-x-auto">
                @foreach ($plans as $plan)
                    <a class="w-full rounded-lg outline-none hover:shadow-lg hover:-translate-y-2 focus:shadow-lg focus:-translate-y-2 transition-all"
                        href="{{ route('user.search.ke_detail', $plan->w_vendor->id) }}?tab=booking&id_layanan={{ $plan->id }}">
                        <div class="w-full">
                            {{-- GAMBAR --}}
                            <div class="w-full p-2 pb-0">
                                @if ($plan->jenis_layanan == 'produk')
                                    <img class="w-full aspect-video object-cover object-center rounded-lg"
                                        src="{{ asset($plan->foto[0]['url']) }}" alt="">
                                @else
                                    <span class="w-full aspect-video bg-slate-300 flex items-center justify-center text-[2em] font-bold text-white rounded-lg">
                                        <i class="fa-regular fa-image"></i>
                                    </span>
                                @endif
                            </div>

                            <div class="w-full p-2 pt-0">
                                {{-- NAMA PLAN --}}
                                <div>
                                    <span class="text-xl font-semibold line-clamp-1">
                                        {{ $plan->nama }}
                                    </span>
                                </div>

                                {{-- HARGA --}}
                                <div class="my-2">
                                    <p class="line-clamp-1 text-end">
                                        {{ 'Rp ' . number_format($plan->harga, 0, ',', '.') }}
                                    </p>
                                </div>

                                <hr class="my-2">

                                {{-- rate --}}
                                <div class="w-full text-end text-sm">
                                    <p class="mb-2">
                                        @if ($plan->count > 0)
                                            {{ $plan->count }} dipesan |
                                        @endif
                                        <i class="fa-solid fa-star text-pink"></i>
                                        {{ $plan->rate > 0 ? number_format($plan->rate, 1, ',') : '-' }}/5
                                    </p>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    @else
        <div class="w-full my-8 text-xl text-center">
            Tidak ada paket layanan
        </div>
    @endif
@endsection
