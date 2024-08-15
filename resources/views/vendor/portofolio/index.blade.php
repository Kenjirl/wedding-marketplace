@extends('vendor.layout')

@section('title')
    <title>Portofolio | Wedding Marketplace</title>
@endsection

@section('h1', 'Portofolio')

@section('content')
    <div>
        <h2 class="w-full text-3xl">Terbaru</h2>
        <div class="py-2 flex items-start justify-start gap-2 overflow-x-auto">
            {{-- ADD NEW CARD --}}
            <a class="w-[200px] aspect-square m-2 flex items-center justify-center border-4 border-dashed outline-none border-pink rounded-xl text-pink bg-white hover:bg-pink hover:text-white focus:bg-pink focus:text-white active:bg-pink-active active:border-pink-active transition-colors"
                href="{{ route('vendor.portofolio.ke_tambah') }}">
                <i class="text-[2em] fa-solid fa-plus"></i>
            </a>

            @forelse ($latest_portofolio as $l_portofolio)
                {{-- CARD --}}
                <a class="rounded-lg outline-none bg-white hover:bg-slate-100 hover:shadow-lg focus:bg-slate-100 focus:shadow-lg transition-all"
                    href="{{ route('vendor.portofolio.ke_ubah', $l_portofolio->id) }}">
                    {{-- IMG --}}
                    <div class="relative w-full p-2 pb-0 flex items-end justify-center">
                        <img class="w-[200px] aspect-square object-cover object-center rounded-lg"
                            src="{{ asset($l_portofolio->foto[0]['url']) }}" alt="Gambar Portofolio">

                        <div class="absolute bottom-2 right-4 w-fit py-1 px-2 flex items-center justify-center gap-2 bg-pink text-white text-sm rounded">
                            <i class="{{ $l_portofolio->jenis->icon }}"></i>
                            <div class="w-[2px] h-[20px] bg-white rounded-full"></div>
                            <div>
                                {{ count($l_portofolio->foto) }} <i class="fa-regular fa-images"></i>
                            </div>
                        </div>
                    </div>

                    {{-- DETAIL --}}
                    <div class="w-full p-2">
                        <span class="max-w-[190px] font-semibold text-lg line-clamp-1">
                            {{ $l_portofolio->judul }}
                        </span>

                        <p class="text-xs">
                            {{ $l_portofolio->updated_at->format('Y-m-d') }}
                        </p>
                    </div>
                </a>
            @empty

            @endforelse
        </div>
    </div>

    <hr class="my-4">

    <div class="min-h-[80vh]" id="daftarPortofolio">
        <div class="w-full mb-2 flex items-center justify-between">
            <h2 class="w-full text-2xl">Portofolio Anda</h2>

            {{-- FILTER --}}
            <div class="w-full flex flex-wrap items-start justify-end gap-2">
                <a class="block w-fit px-2 py-1 border border-pink outline-pink {{ $jenis_id == null ? 'bg-pink text-white' : 'bg-white text-pink' }} text-sm font-semibold rounded active:bg-pink-active active:text-white transition-colors"
                    href="{{ route('vendor.portofolio.index') }}">
                    All
                </a>
                @forelse ($j_vendor as $jenis)
                    <a class="block w-fit px-2 py-1 border border-pink outline-pink {{ $jenis_id == $jenis->m_jenis_vendor_id ? 'bg-pink text-white' : 'bg-white text-pink' }} text-sm font-semibold rounded active:bg-pink-active active:text-white transition-colors"
                        href="{{ route('vendor.portofolio.index', ['jenis_id' => $jenis->m_jenis_vendor_id]) }}">
                        {{ $jenis->master->nama }}
                    </a>
                @empty
                @endforelse
            </div>
        </div>

        <div class="pb-8 grid grid-cols-4 gap-4 overflow-y-auto">
            @forelse ($portofolio as $pfolio)
                @php
                    $statusData = [
                        'ditolak' => ['bg-red-400', 'ditolak'],
                        'diterima' => ['bg-blue-500', 'diterima'],
                        'default' => ['bg-yellow-400', $pfolio->status]
                    ];

                    if ($pfolio->admin_id) {
                        $status = $statusData[$pfolio->status] ?? $statusData['default'];
                    } else {
                        $status = $statusData['default'];
                    }
                @endphp

                {{-- CARD --}}
                <a class="w-full p-2 rounded-lg outline-none bg-white hover:bg-slate-100 hover:shadow-lg focus:bg-slate-100 focus:shadow-lg transition-all"
                    href="{{ route('vendor.portofolio.ke_ubah', $pfolio->id) }}">
                    {{-- IMG --}}
                    <div class="relative w-full mb-2 flex items-end justify-center">
                        {{-- STATUS --}}
                        <div class="absolute top-2 right-2 w-fit px-2 py-1 rounded text-white font-semibold text-[.8em] {{ $status[0] }}">
                            {{ $status[1] }}
                        </div>

                        <img class="w-full aspect-square object-cover object-center rounded-lg"
                            src="{{ asset($pfolio->foto[0]['url']) }}" alt="Gambar Portofolio">

                        <div class="absolute bottom-2 right-2 w-fit py-1 px-2 flex items-center justify-center gap-2 bg-pink text-white text-sm rounded">
                            <i class="{{ $pfolio->jenis->icon }}"></i>
                            <div class="w-[2px] h-[20px] bg-white rounded-full"></div>
                            <div>
                                {{ count($pfolio->foto) }} <i class="fa-regular fa-images"></i>
                            </div>
                        </div>
                    </div>

                    {{-- DETAIL --}}
                    <div class="w-full">
                        <span class="text-2xl font-semibold line-clamp-2">
                            {{ $pfolio->judul }}
                        </span>

                        <div class="my-1 text-sm line-clamp-2">
                            {!! $pfolio->detail !!}
                        </div>
                    </div>
                </a>
            @empty
                Belum ada portofolio
            @endforelse
        </div>
    </div>
@endsection
