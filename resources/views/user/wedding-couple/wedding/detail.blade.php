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
                        Ny. {{ $wedding->bride }}
                    </span>
                </div>
            </div>

            <div class="w-full p-4 flex items-start justify-between gap-4 border-t-2 border-slate-100">
                {{-- PEMBERKATAN --}}
                <div class="flex-1 w-full">
                    <div class="w-full p-4 text-center text-2xl border-b-2 border-pink font-semibold">
                        Tempat & Waktu Pemberkatan
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
                                        {{ \Carbon\Carbon::parse($wedding->waktu_pemberkatan)->format('Y-m-d') }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="pr-2 text-center">
                                        <i class="fa-regular fa-clock text-3xl text-pink"></i>
                                    </td>
                                    <td>Jam</td>
                                    <td class="px-2 text-center">:</td>
                                    <td>
                                        {{ \Carbon\Carbon::parse($wedding->waktu_pemberkatan)->format('H:i') }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="pr-2 text-center">
                                        <i class="fa-solid fa-place-of-worship text-3xl text-pink"></i>
                                    </td>
                                    <td>Tempat</td>
                                    <td class="px-2 text-center">:</td>
                                    <td>
                                        {{ $wedding->lokasi_pemberkatan }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- PERAYAAN --}}
                <div class="flex-1 w-full">
                    <div class="w-full p-4 text-center text-2xl border-b-2 border-pink font-semibold">
                        Tempat & Waktu Perayaan
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
                                        {{ \Carbon\Carbon::parse($wedding->waktu_perayaan)->format('Y-m-d') }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="pr-2 text-center">
                                        <i class="fa-regular fa-clock text-3xl text-pink"></i>
                                    </td>
                                    <td>Jam</td>
                                    <td class="px-2 text-center">:</td>
                                    <td>
                                        {{ \Carbon\Carbon::parse($wedding->waktu_perayaan)->format('H:i') }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="pr-2 text-center">
                                        <i class="fa-solid fa-place-of-worship text-3xl text-pink"></i>
                                    </td>
                                    <td>Tempat</td>
                                    <td class="px-2 text-center">:</td>
                                    <td>
                                        {{ $wedding->lokasi_perayaan }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>

        <div class="w-full p-4 flex items-start justify-between gap-2 border-t-2 border-slate-100">
            {{-- ORGANIZER --}}
            <div class="flex-1 w-full text-center">
                @if ($wedding->w_o_booking)
                    <div class="w-3/4 mx-auto p-4 rounded border-2 border-slate-100">
                        <div class="w-full pb-4 flex items-center justify-start gap-2 border-b-2 border-slate-100">
                            <div>
                                @if ($wedding->w_o_booking->plan->w_organizer->foto_profil)
                                    <img class="w-[50px] aspect-square object-cover object-center rounded-full border-2 border-pink"
                                        src="{{ asset($wedding->w_o_booking->plan->w_organizer->foto_profil) }}" alt="Foto Profil" id="fotoProfil">
                                @else
                                    <span class="w-[50px] aspect-square bg-pink rounded-full flex items-center justify-center text-[1.25em] font-bold text-white border-4 border-pink"
                                        id="fotoProfilText">
                                        {{ substr($wedding->w_o_booking->plan->w_organizer->nama_perusahaan, 0, 1) }}
                                    </span>
                                @endif
                            </div>

                            <div class="text-xl font-semibold">
                                {{ $wedding->w_o_booking->plan->w_organizer->nama_perusahaan }}
                            </div>
                        </div>

                        <div class="w-full mx-auto py-4 px-2">
                            <div class="w-full flex items-center justify-start gap-2">
                                <i class="fa-solid fa-gift text-3xl text-pink"></i>
                                <span>
                                    {{ $wedding->w_o_booking->plan->nama }}
                                </span>
                            </div>
                        </div>

                        <div class="w-full pt-4 flex items-center justify-end gap-4 border-t-2 border-slate-100">
                            @if ($wedding->w_o_booking->status == 'diproses' || $wedding->w_o_booking->status == 'ditolak')
                                <form action="{{ route('wedding-couple.pernikahan.hapus_wo', $wedding->w_o_booking->id) }}" method="post" id="hapusWOForm">
                                    @csrf
                                    <button class="w-fit px-4 py-2 rounded outline-none text-pink hover:bg-pink-hover hover:text-white focus:bg-pink-hover focus:text-white active:bg-pink-active transition-colors"
                                        type="button" id="hapusWOBtn">
                                        Hapus Pesanan
                                    </button>
                                </form>
                            @endif

                            <a class="w-fit px-4 py-2 rounded outline-none bg-pink text-white hover:bg-pink-hover focus:bg-pink-hover active:bg-pink-active transition-colors"
                                href="{{ route('wedding-couple.search.wo.ke_detail', $wedding->w_o_booking->plan->w_organizer->id) }}">
                                Lihat Detail
                            </a>
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
                @forelse ($wedding->w_p_booking as $wpb)
                    <div class="w-3/4 mx-auto mb-4 p-4 rounded border-2 border-slate-100">
                        <div class="w-full pb-4 flex items-center justify-start gap-2 border-b-2 border-slate-100">
                            <div>
                                @if ($wpb->plan->w_photographer->foto_profil)
                                    <img class="w-[50px] aspect-square object-cover object-center rounded-full border-2 border-pink"
                                        src="{{ asset($wpb->plan->w_photographer->foto_profil) }}" alt="Foto Profil" id="fotoProfil">
                                @else
                                    <span class="w-[50px] aspect-square bg-pink rounded-full flex items-center justify-center text-[1.25em] font-bold text-white border-4 border-pink"
                                        id="fotoProfilText">
                                        {{ substr($wpb->plan->w_photographer->nama, 0, 1) }}
                                    </span>
                                @endif
                            </div>

                            <div class="text-xl font-semibold">
                                {{ $wpb->plan->w_photographer->nama }}
                            </div>
                        </div>

                        <div class="w-full mx-auto py-4 px-2">
                            <div class="w-full flex items-center justify-start gap-2">
                                <i class="fa-solid fa-gift text-3xl text-pink"></i>
                                <span>
                                    {{ $wpb->plan->nama }}
                                </span>
                            </div>
                        </div>

                        <div class="w-full pt-4 flex items-center justify-end gap-4 border-t-2 border-slate-100">
                            @if ($wpb->status == 'diproses' || $wpb->status == 'ditolak')
                                <form action="{{ route('wedding-couple.pernikahan.hapus_wp', $wpb->id) }}" method="post" id="hapusWPForm-{{ $wpb->id }}">
                                    @csrf
                                    <button class="w-fit px-4 py-2 rounded outline-none text-pink hover:bg-pink-hover hover:text-white focus:bg-pink-hover focus:text-white active:bg-pink-active transition-colors hapus-wp-btn"
                                        type="button" data-id="{{ $wpb->id }}">
                                        Hapus Pesanan
                                    </button>
                                </form>
                            @endif

                            <a class="w-fit px-4 py-2 rounded outline-none bg-pink text-white hover:bg-pink-hover focus:bg-pink-hover active:bg-pink-active transition-colors"
                                href="{{ route('wedding-couple.search.wp.ke_detail', $wpb->plan->w_photographer->id) }}">
                                Lihat Detail
                            </a>
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
