@extends('user.search.detail.index')

@section('item')
    @if (!$plans->isEmpty())
        {{-- FILTER --}}
        <div class="w-full mt-2 pb-1 flex items-center justify-start gap-2 overflow-x-auto">
            <a class="w-[40px] aspect-square flex items-center justify-center text-sm font-semibold border border-pink {{ $filterJenisVendor == '' ? 'bg-pink text-white' : 'bg-white text-pink' }} rounded"
            href="{{ route('user.search.ke_detail', $vendor->id) }}?tab=layanan">
                All
            </a>
            @foreach ($j_vendor as $jenis)
                <a class="w-[40px] aspect-square flex items-center justify-center gap-2 flex-nowrap text-sm border border-pink
                    {{ $filterJenisVendor == $jenis->master->id ? 'bg-pink text-white' : 'bg-white text-pink' }} rounded"
                    href="{{ route('user.search.ke_detail', $vendor->id) }}??tab=layanan&jenis_vendor={{ $jenis->master->id }}">
                    <i class="{{ $jenis->master->icon }}"></i>
                </a>
            @endforeach
        </div>

        <hr class="mt-1 mb-2">

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
                                    <img class="w-full aspect-video object-cover object-center rounded-lg"
                                        src="{{ asset('template/layanan/1.jpg') }}" alt="">
                                    {{-- <span class="w-full aspect-video bg-slate-300 flex items-center justify-center text-[2em] font-bold text-white rounded-lg">
                                        <i class="fa-regular fa-image"></i>
                                    </span> --}}
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

                                {{-- JENIS PAKET LAYANAN --}}
                            <div class="w-full mb-2">
                                <div class="w-fit px-2 py-1 text-xs border border-pink rounded">
                                    <i class="fa-solid fa-hashtag text-pink"></i>
                                    <span>
                                        {{ $plan->jenis_layanan }}
                                    </span>
                                </div>
                            </div>

                            {{-- JENIS VENDOR --}}
                            <div class="w-full mb-2">
                                <div class="w-fit px-2 py-1 text-xs border border-pink rounded">
                                    <i class="{{ $plan->jenis->icon }} text-pink"></i>
                                    <span>
                                        {{ $plan->jenis->nama }}
                                    </span>
                                </div>
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
