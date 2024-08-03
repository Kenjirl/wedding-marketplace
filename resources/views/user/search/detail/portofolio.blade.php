@extends('user.search.detail.index')

@section('item')
    @if ($portofolio_detail)
        {{-- FILTER --}}
        <div class="w-full mt-2 pb-1 flex items-center justify-start gap-2 overflow-x-auto">
            <a class="w-[40px] aspect-square flex items-center justify-center text-sm font-semibold border border-pink {{ $filterJenisVendor == '' ? 'bg-pink text-white' : 'bg-white text-pink' }} rounded"
            href="{{ route('user.search.ke_detail', $vendor->id) }}">
                All
            </a>
            @foreach ($j_vendor as $jenis)
                <a class="w-[40px] aspect-square flex items-center justify-center gap-2 flex-nowrap text-sm border border-pink
                    {{ $filterJenisVendor == $jenis->master->id ? 'bg-pink text-white' : 'bg-white text-pink' }} rounded"
                    href="{{ route('user.search.ke_detail', $vendor->id) }}?jenis_vendor={{ $jenis->master->id }}">
                    <i class="{{ $jenis->master->icon }}"></i>
                </a>
            @endforeach
        </div>

        <hr class="mt-1 mb-2">

        {{-- portofolio --}}
        <div class="w-full">
            {{-- detail portofolio --}}
            <div class="w-full mb-4 flex items-start justify-between">
                {{-- detail foto portofolio --}}
                <div class="flex-1 w-full p-2 bg-slate-100 rounded-lg">
                    {{-- foto besar --}}
                    <div class="w-full aspect-[3/2] flex items-center justify-center" id="foto_besar">
                        @foreach ($portofolio_detail->foto as $index => $foto)
                            <a class="{{ $loop->index == 0 ? '' : 'hidden' }} bg-white"
                                href="{{ asset($foto['url']) }}" data-fancybox="gallery" id="zoom-photo-{{ $loop->index }}">
                                <img class="w-full h-[400px] object-contain rounded-md bg-white"
                                    src="{{ asset($foto['url']) }}" alt="Foto portofolio {{ $loop->iteration }}">
                            </a>
                        @endforeach
                    </div>

                    {{-- foto kecil --}}
                    <div class="w-full mt-2 flex items-start justify-center gap-2 overflow-x-auto">
                        @foreach ($portofolio_detail->foto as $index => $foto)
                            <button class="w-[50px] p-1 flex items-center justify-center rounded outline-none bg-white hover:bg-slate-500 focus:bg-slate-500 active:bg-slate-300 transition-colors foto-kecil"
                                type="button" data-index="{{ $loop->index }}">
                                <img class="w-full aspect-square object-contain" src="{{ asset($foto['url']) }}" alt="Foto portofolio {{ $loop->iteration }}">
                            </button>
                        @endforeach
                    </div>
                </div>

                {{-- detail portofolio --}}
                <div class="flex-1 w-full p-4">
                    <h2 class="text-2xl font-semibold">
                        {{ $portofolio_detail->judul }}
                    </h2>

                    <div class="w-fit my-2 px-2 py-1 text-xs border border-pink rounded">
                        <i class="{{ $portofolio_detail->jenis->icon }} text-pink"></i>
                        <span>
                            {{ $portofolio_detail->jenis->nama }}
                        </span>
                    </div>

                    <div class="w-full mb-1 text-sm italic text-slate-400">
                        {{ \Carbon\Carbon::parse($portofolio_detail->tanggal)->translatedFormat('l, d F Y') }}
                    </div>

                    <div class="w-full mb-1 text-sm italic text-slate-400">
                        @php
                            $portfolAddr = 'https://www.google.com/maps/search/?api=1&query=' . urlencode($portofolio_detail->lokasi);
                            if (!is_null($portofolio_detail->koordinat['lat']) && !is_null($portofolio_detail->koordinat['lng'])) {
                                $portfolCoor = 'https://www.google.com/maps?q=' . $portofolio_detail->koordinat['lat'] . ',' . $portofolio_detail->koordinat['lng'];
                            } else {
                                $portfolCoor = $portfolAddr;
                            }
                        @endphp
                        <a href="{{ $portfolAddr }}" target="_blank">
                            {{ $portofolio_detail->lokasi }}
                        </a>
                        <a class="ml-2" href="{{ $portfolCoor }}" target="_blank">
                            <i class="fa-solid fa-square-arrow-up-right"></i>
                        </a>
                    </div>

                    <div>
                        {!! $portofolio_detail->detail !!}
                    </div>
                </div>
            </div>

            {{-- list portofolio --}}
            <div class="w-full max-w-3/4 pb-0">
                <div class="w-full">
                    <i class="fa-solid fa-grip"></i>
                    <span class="font-semibold">
                        Portofolio Lainnya
                    </span>
                </div>

                <div class="w-full py-2 flex flex-nowrap items-start justify-start gap-4 overflow-x-auto">
                    {{-- item portofolio --}}
                    @forelse ($portofolios as $portofolio)
                        <a class="block min-w-[200px] max-w-[200px] rounded-lg outline-none bg-white shadow text-start hover:shadow-lg focus:shadow-lg active:shadow transition-all"
                            href="{{ route('user.search.ke_detail', $portofolio->w_vendor->id) }}?portofolio_id={{ $portofolio->id }}&jenis_vendor={{ $filterJenisVendor }}">
                            <div class="w-full">
                                <div class="relative w-full">
                                    <img class="w-full rounded-lg aspect-video object-cover object-center"
                                        src="{{ asset($portofolio->foto[0]['url']) }}" alt="">

                                    <div class="absolute top-2 right-2 w-fit px-2 py-1 bg-pink text-white text-xs font-bold rounded">
                                        <i class="fa-regular fa-images"></i>
                                        {{ count($portofolio->foto) }}
                                    </div>

                                    <div class="absolute bottom-2 right-2 w-fit px-2 py-1 text-xs bg-pink text-white font-semibold rounded">
                                        <i class="{{ $portofolio->jenis->icon }}"></i>
                                    </div>
                                </div>

                                <div class="w-full p-1">
                                    <div class="mb-1">
                                        <span class="font-semibold line-clamp-1">{{ $portofolio->judul }}</span>
                                    </div>

                                    <div class="text-xs">
                                        <span>{{ Carbon\Carbon::parse($portofolio->tanggal)->format('d/m/Y') }}</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @empty
                        <div class="w-full my-2">
                            Tidak ada portofolio lainnya
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    @else
        <div class="w-full my-8 text-xl text-center">
            Tidak ada portofolio
        </div>
    @endif
@endsection
