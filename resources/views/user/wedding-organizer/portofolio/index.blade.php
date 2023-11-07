@extends('user.wedding-organizer.layout')

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
                href="{{ route('wedding-organizer.portofolio.ke_tambah') }}">
                <i class="text-[2em] fa-solid fa-plus"></i>
            </a>

            @forelse ($latest_portofolio as $l_portofolio)
                {{-- CARD --}}
                <a class="w-[200px] rounded-xl outline-none hover:bg-slate-100 focus:bg-slate-100 transition-colors"
                    href="{{ route('wedding-organizer.portofolio.ke_ubah', $l_portofolio->id) }}">
                    {{-- IMG --}}
                    <div class="w-full pt-4 px-4 flex items-end justify-center bg-slate-100 rounded-t-xl">
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
        <div class="grid grid-cols-4 gap-8 overflow-y-auto">
            @forelse ($portofolio as $pfolio)
                {{-- CARD --}}
                <a class="w-full rounded-xl outline-none hover:bg-slate-100 focus:bg-slate-100 transition-colors"
                    href="{{ route('wedding-organizer.portofolio.ke_ubah', $pfolio->id) }}">
                    {{-- IMG --}}
                    <div class="w-full pt-4 px-4 flex items-end justify-center bg-slate-100 rounded-t-xl">
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

                        <div class="text-[.8em]">
                            @if ($l_portofolio->admin_id && $l_portofolio->status == 'ditolak')
                                <span class="bg-red-100 border border-red-500 px-1">
                            @elseif ($l_portofolio->admin_id && $l_portofolio->status == 'diterima')
                                <span class="bg-blue-100 border border-blue-500 px-1">
                            @else
                                <span class="bg-yellow-100 border border-yellow-500 px-1">
                            @endif
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
