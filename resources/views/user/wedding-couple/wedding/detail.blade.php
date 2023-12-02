@extends('user.wedding-couple.layout')

@section('title')
    <title>Detail Pernikahan | Wedding Marketplace</title>
@endsection

@section('content')
    <div class="w-full max-w-[1200px] mx-auto">
        <div class="w-full">
            {{-- JUDUL --}}
            <div class="w-full p-4 flex items-center justify-start gap-8">
                <div class="w-fit aspect-square p-4 bg-pink rounded text-4xl text-white">
                    <i class="fa-solid fa-dove"></i>
                </div>

                <div class="flex-1 w-full text-3xl text-slate-600 font-semibold">
                    Pernikahan
                    <span class="text-blue-400">
                        Tn. {{ $wedding->groom }}
                    </span>
                    &
                    <span class="text-red-400">
                        Nn. {{ $wedding->bride }}
                    </span>
                </div>
            </div>

            {{-- EVENTS --}}
            <div class="w-full p-4 grid grid-cols-2 gap-4 border-t-2 border-slate-100">
                @foreach ($weddingEvents as $w_event)
                    {{-- EVENT --}}
                    <div class="flex-1 w-full">
                        <div class="w-full p-4 flex items-center justify-center gap-2 text-2xl border-b-2 border-pink font-semibold">
                            <span>
                                Tempat & Waktu {{ $w_event->event->nama }}
                            </span>
                            <div class="w-4 aspect-square flex items-center justify-end text-sm cursor-pointer"
                                data-tippy-content="{{ $w_event->event->keterangan }}">
                                <i class="fa-regular fa-circle-question"></i>
                            </div>
                        </div>

                        <div class="w-fit mx-auto p-4">
                            <table>
                                <tbody>
                                    <tr>
                                        <td class="pr-2 text-center">
                                            <i class="fa-solid fa-calendar-day text-3xl text-pink"></i>
                                        </td>
                                        <td>Tanggal</td>
                                        <td class="px-2 text-center">:</td>
                                        <td>
                                            {{ \Carbon\Carbon::parse($w_event->waktu)->format('Y-m-d') }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="pr-2 text-center">
                                            <i class="fa-regular fa-clock text-3xl text-pink"></i>
                                        </td>
                                        <td>Jam</td>
                                        <td class="px-2 text-center">:</td>
                                        <td>
                                            {{ \Carbon\Carbon::parse($w_event->waktu)->format('H:i') }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="pr-2 text-center">
                                            <i class="fa-solid fa-place-of-worship text-3xl text-pink"></i>
                                        </td>
                                        <td>Tempat</td>
                                        <td class="px-2 text-center">:</td>
                                        <td>
                                            {{ $w_event->lokasi }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="w-full p-4 flex items-start justify-between gap-2 border-t-2 border-slate-100">
            {{-- ORGANIZER --}}
            <div class="flex-1 w-full text-center">
                @if ($bookedOrganizer)
                    <div class="w-3/4 mx-auto p-4 rounded border-2 border-slate-100">
                        <div class="w-full pb-4 flex items-center justify-start gap-2 border-b-2 border-slate-100">
                            <div>
                                @if ($bookedOrganizer->plan->w_organizer->foto_profil)
                                    <img class="w-[50px] aspect-square object-cover object-center rounded-full border-2 border-pink"
                                        src="{{ asset($bookedOrganizer->plan->w_organizer->foto_profil) }}" alt="Foto Profil" id="fotoProfil">
                                @else
                                    <span class="w-[50px] aspect-square bg-pink rounded-full flex items-center justify-center text-[1.25em] font-bold text-white border-4 border-pink"
                                        id="fotoProfilText">
                                        {{ substr($bookedOrganizer->plan->w_organizer->nama_perusahaan, 0, 1) }}
                                    </span>
                                @endif
                            </div>

                            <div class="text-xl font-semibold">
                                {{ $bookedOrganizer->plan->w_organizer->nama_perusahaan }}
                            </div>
                        </div>

                        <div class="w-full mx-auto py-4 px-2">
                            <div class="w-full flex items-center justify-start gap-2">
                                <i class="fa-solid fa-gift text-3xl text-pink"></i>
                                <span>
                                    {{ $bookedOrganizer->plan->nama }}
                                </span>
                            </div>
                        </div>

                        <div class="w-full pt-4 flex items-center justify-between border-t-2 border-slate-100">
                            <div class="flex items-center justify-start gap-2 text-[.8em]">
                                @if ($bookedOrganizer->status == 'ditolak')
                                    <div class="w-fit aspect-square rounded-full text-red-500">
                                        <i class="fa-solid fa-circle-xmark"></i>
                                    </div>
                                @elseif ($bookedOrganizer->status == 'diterima')
                                    <div class="w-fit aspect-square rounded-full text-blue-500">
                                        <i class="fa-solid fa-circle-check"></i>
                                    </div>
                                @elseif ($bookedOrganizer->status == 'selesai')
                                    <div class="w-fit aspect-square rounded-full text-green-500">
                                        <i class="fa-solid fa-circle-check"></i>
                                    </div>
                                @else
                                    <div class="w-fit aspect-square rounded-full text-yellow-400">
                                        <i class="fa-solid fa-clock"></i>
                                    </div>
                                @endif
                                <span>
                                    {{ $bookedOrganizer->status }}
                                </span>
                            </div>

                            <div class="flex-1 w-full flex items-center justify-end gap-4">
                                {{-- @if ($bookedOrganizer->status == 'diproses' || $bookedOrganizer->status == 'ditolak') --}}
                                @if ($bookedOrganizer->status != 'selesai')
                                    <form action="{{ route('wedding-couple.pernikahan.hapus_wo', $bookedOrganizer->id) }}" method="post" id="hapusWOForm">
                                        @csrf
                                        <button class="w-fit px-4 py-2 rounded outline-none text-pink hover:bg-pink-hover hover:text-white focus:bg-pink-hover focus:text-white active:bg-pink-active transition-colors"
                                            type="button" id="hapusWOBtn">
                                            Batal
                                        </button>
                                    </form>
                                @endif

                                <a class="w-fit px-4 py-2 rounded outline-none bg-pink text-white hover:bg-pink-hover focus:bg-pink-hover active:bg-pink-active transition-colors"
                                    href="{{ route('wedding-couple.search.wo.ke_detail', $bookedOrganizer->plan->w_organizer->id) }}">
                                    Detail
                                </a>
                            </div>
                        </div>
                    </div>
                @else
                    <a class="w-fit px-4 py-2 bg-pink text-white outline-none hover:bg-pink-hover focus:bg-pink-hover active:bg-pink-active rounded-full transition-colors"
                        href="{{ route('wedding-couple.search.wo.index') }}">
                            <i class="fa-solid fa-magnifying-glass"></i>
                            Cari Wedding Organizer
                    </a>
                @endif
            </div>

            {{-- PHOTOGRAPHER --}}
            <div class="flex-1 w-full text-center">
                @forelse ($bookedPhotographers as $bp)
                    <div class="w-3/4 mx-auto mb-4 p-4 rounded border-2 border-slate-100">
                        <div class="w-full pb-4 flex items-center justify-start gap-2 border-b-2 border-slate-100">
                            <div>
                                @if ($bp->plan->w_photographer->foto_profil)
                                    <img class="w-[50px] aspect-square object-cover object-center rounded-full border-2 border-pink"
                                        src="{{ asset($bp->plan->w_photographer->foto_profil) }}" alt="Foto Profil" id="fotoProfil">
                                @else
                                    <span class="w-[50px] aspect-square bg-pink rounded-full flex items-center justify-center text-[1.25em] font-bold text-white border-4 border-pink"
                                        id="fotoProfilText">
                                        {{ substr($bp->plan->w_photographer->nama, 0, 1) }}
                                    </span>
                                @endif
                            </div>

                            <div class="text-xl font-semibold">
                                {{ $bp->plan->w_photographer->nama }}
                            </div>
                        </div>

                        <div class="w-full mx-auto py-4 px-2">
                            <div class="w-full flex items-center justify-start gap-2">
                                <i class="fa-solid fa-gift text-3xl text-pink"></i>
                                <span>
                                    {{ $bp->plan->nama }}
                                </span>
                            </div>
                        </div>

                        <div class="w-full pt-4 flex items-center justify-between border-t-2 border-slate-100">
                            <div class="flex items-center justify-start gap-2 text-[.8em]">
                                @if ($bp->status == 'ditolak')
                                    <div class="w-fit aspect-square rounded-full text-red-500">
                                        <i class="fa-solid fa-circle-xmark"></i>
                                    </div>
                                @elseif ($bp->status == 'diterima')
                                    <div class="w-fit aspect-square rounded-full text-blue-500">
                                        <i class="fa-solid fa-circle-check"></i>
                                    </div>
                                @elseif ($bp->status == 'selesai')
                                    <div class="w-fit aspect-square rounded-full text-green-500">
                                        <i class="fa-solid fa-circle-check"></i>
                                    </div>
                                @else
                                    <div class="w-fit aspect-square rounded-full text-yellow-400">
                                        <i class="fa-solid fa-clock"></i>
                                    </div>
                                @endif
                                <span>
                                    {{ $bp->status }}
                                </span>
                            </div>

                            <div class="flex-1 w-full flex items-center justify-end gap-4">
                                {{-- @if ($bp->status == 'diproses' || $bp->status == 'ditolak') --}}
                                @if ($bp->status != 'selesai')
                                    <form action="{{ route('wedding-couple.pernikahan.hapus_wp', $bp->id) }}" method="post" id="hapusWPForm-{{ $bp->id }}">
                                        @csrf
                                        <button class="w-fit px-4 py-2 rounded outline-none text-pink hover:bg-pink-hover hover:text-white focus:bg-pink-hover focus:text-white active:bg-pink-active transition-colors hapus-wp-btn"
                                            type="button" data-id="{{ $bp->id }}">
                                            Batal
                                        </button>
                                    </form>
                                @endif

                                <a class="w-fit px-4 py-2 rounded outline-none bg-pink text-white hover:bg-pink-hover focus:bg-pink-hover active:bg-pink-active transition-colors"
                                    href="{{ route('wedding-couple.search.wp.ke_detail', $bp->plan->w_photographer->id) }}">
                                    Detail
                                </a>
                            </div>
                        </div>
                    </div>
                @empty

                @endforelse

                <a class="w-fit px-4 py-2 bg-pink text-white outline-none hover:bg-pink-hover focus:bg-pink-hover active:bg-pink-active rounded-full transition-colors"
                    href="{{ route('wedding-couple.search.wp.index') }}">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        Cari Wedding Photographer
                </a>
            </div>
        </div>
    </div>
@endsection

@push('child-js')
    <script>
        $(document).ready(function() {
            // HAPUS PESANAN WO
            $('#hapusWOBtn').on('click', function() {
                if (confirm('Apakah Anda yakin ingin membatalkan pesanan organizer ini?')) {
                    $('#hapusWOForm').submit();
                }
            });

            // HAPUS PESANAN WP
            $('.hapus-wp-btn').click(function () {
                let form = $('#hapusWPForm-' + $(this).data('id'));
                if (confirm('Apakah Anda yakin ingin membatalkan pesanan photographer ini?')) {
                    form.submit();
                }
            });
        });
    </script>
@endpush
