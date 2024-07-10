@extends('user.search.detail.index')

@section('item')
    @if ($portofolio_detail)
        {{-- portofolio --}}
        <div class="w-full my-2">
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
                    <table>
                        <tbody>
                            <tr>
                                <td class="text-center align-top"><i class="fa-regular fa-calendar"></i></td>
                                <td class="align-top">Tanggal</td>
                                <td class="align-top px-2">:</td>
                                <td class="align-top">{{ $portofolio_detail->tanggal }}</td>
                            </tr>
                            <tr>
                                <td class="text-center align-top"><i class="fa-solid fa-info"></i></td>
                                <td class="align-top">Detail</td>
                                <td class="align-top px-2">:</td>
                                <td class="align-top">{!! $portofolio_detail->detail !!}</td>
                            </tr>
                            <tr>
                                <td class="text-center align-top"><i class="fa-solid fa-location-dot"></i></td>
                                <td class="align-top">Lokasi</td>
                                <td class="align-top px-2">:</td>
                                <td class="align-top">{{ $portofolio_detail->lokasi }}</td>
                            </tr>
                        </tbody>
                    </table>
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
                        <button class="min-w-[200px] max-w-[200px] rounded-lg outline-none bg-white shadow text-start hover:shadow-lg focus:shadow-lg active:shadow transition-all"
                            type="button" onclick="setPortofolioId({{ $portofolio->id }})">
                            <div class="w-full">
                                <div class="relative w-full">
                                    <img class="w-full rounded-lg aspect-video object-cover object-center"
                                        src="{{ asset($portofolio->foto[0]['url']) }}" alt="">

                                    <div class="absolute top-2 right-2 w-fit px-2 py-1 bg-pink text-white text-xs font-bold rounded">
                                        <i class="fa-regular fa-images"></i>
                                        {{ count($portofolio->foto) }}
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
                        </button>
                    @empty
                        <div class="w-full my-2">
                            Tidak ada portofolio lainnya
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        {{-- form ganti portofolio --}}
        <div class="hidden">
            <form action="{{ route('user.search.ke_detail', $vendor->id) }}" method="get" id="portofolioForm">
                @csrf
                <input type="text" name="portofolio_id" id="portofolio_id">
            </form>
        </div>
    @else
        <div class="w-full my-8 text-xl text-center">
            Tidak ada portofolio
        </div>
    @endif
@endsection
