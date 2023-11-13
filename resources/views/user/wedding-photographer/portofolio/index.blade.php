@extends('user.wedding-photographer.layout')

@section('title')
    <title>Portofolio | Wedding Marketplace</title>
@endsection

@section('h1', 'Portofolio')

@section('content')
    <div class="mb-8">
        <h2 class="w-full mb-4 text-[2em]">Terbaru</h2>
        <div class="flex items-center justify-start gap-4 overflow-x-auto">
            {{-- ADD NEW CARD --}}
            <a class="w-[calc(200px-8px)] h-[calc(244px-8px)] flex items-center justify-center border-4 border-dashed outline-none border-pink rounded-xl text-pink bg-white hover:bg-pink hover:text-white focus:bg-pink focus:text-white active:bg-pink-active transition-colors"
                href="{{ route('wedding-photographer.portofolio.ke_tambah') }}">
                <i class="text-[2em] fa-solid fa-plus"></i>
            </a>

            @forelse ($latest_portofolio as $l_portofolio)
                {{-- CARD --}}
                <a class="w-[200px] rounded-xl outline-none bg-white shadow hover:bg-slate-100 hover:shadow-lg focus:bg-slate-100 focus:shadow-lg transition-all"
                    href="{{ route('wedding-photographer.portofolio.ke_ubah', $l_portofolio->id) }}">
                    {{-- IMG --}}
                    <div class="w-full pt-4 px-4 flex items-end justify-center rounded-t-xl">
                        <img class="w-[200px] aspect-square object-cover object-center rounded-t-lg"
                            src="{{ asset($l_portofolio->photo->first()->url) }}" alt="Gambar Portofolio">
                    </div>

                    {{-- DETAIL --}}
                    <div class="w-full p-2">
                        <span class="font-semibold text-lg line-clamp-1">
                            {{ $l_portofolio->judul }}
                        </span>

                        <p class="text-sm">
                            Terakhir diubah : {{ $l_portofolio->updated_at->format('Y-m-d') }}
                        </p>
                    </div>
                </a>
            @empty

            @endforelse
        </div>
    </div>

    <div class="mb-8">
        <h2 class="w-full mb-4 text-[2em]">Portofolio Anda</h2>
        <div class="py-4 grid grid-cols-4 gap-8 overflow-y-auto">
            @forelse ($portofolio as $pfolio)
                {{-- CARD --}}
                <a class="w-full rounded-xl outline-none bg-white shadow hover:bg-slate-100 hover:shadow-lg focus:bg-slate-100 focus:shadow-lg transition-all"
                    href="{{ route('wedding-photographer.portofolio.ke_ubah', $pfolio->id) }}">
                    {{-- IMG --}}
                    <div class="w-full pt-4 px-4 flex items-end justify-center rounded-t-xl">
                        <img class="w-[200px] aspect-square object-cover object-center rounded-t-lg"
                            src="{{ asset($pfolio->photo->first()->url) }}" alt="Gambar Portofolio">
                    </div>

                    {{-- DETAIL --}}
                    <div class="w-full p-4">
                        <span class="text-2xl font-semibold line-clamp-2">
                            {{ $pfolio->judul }}
                        </span>

                        <div class="my-2 text-sm line-clamp-2">
                            {!! $pfolio->detail !!}
                        </div>

                        <div class="flex items-center justify-start gap-2 text-[.8em]">
                            @if ($l_portofolio->admin_id && $l_portofolio->status == 'ditolak')
                                <div class="w-fit aspect-square rounded-full text-red-500">
                                    <i class="fa-solid fa-circle-xmark"></i>
                                </div>
                            @elseif ($l_portofolio->admin_id && $l_portofolio->status == 'diterima')
                                <div class="w-fit aspect-square rounded-full text-blue-500">
                                    <i class="fa-solid fa-circle-check"></i>
                                </div>
                            @else
                                <div class="w-fit aspect-square rounded-full text-yellow-400">
                                    <i class="fa-solid fa-clock"></i>
                                </div>
                            @endif
                            <span>
                                {{ $l_portofolio->status }}
                            </span>
                        </div>
                    </div>
                </a>
            @empty
                Belum ada portofolio
            @endforelse
        </div>
    </div>
@endsection
