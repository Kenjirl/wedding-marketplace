@extends('vendor.layout')

@section('title')
    <title>Layanan | Wedding Marketplace</title>
@endsection

@section('h1', 'Layanan')

@section('content')
    {{-- TOMBOL --}}
    <div class="w-full flex items-center justify-between">
        <button class="w-[40px] aspect-square p-2 bg-pink text-white text-center rounded"
            type="button" id="infoBtn">
            <i class="fa-solid fa-circle-info"></i>
        </button>

        <a class="w-fit px-4 py-2 rounded text-white font-semibold bg-pink hover:bg-pink-hover focus:bg-pink-hover active:bg-pink-active focus:outline-pink-hover focus:outline-offset-2 transition-colors"
            href="{{ route('vendor.layanan.ke_tambah') }}">
            <i class="fa-solid fa-plus"></i>
            Tambah
        </a>
    </div>

    <hr class="my-4">

    {{-- DAFTAR PAKET LAYANAN --}}
    <div class="w-full flex items-stretch justify-normal flex-wrap gap-4">
        @forelse ($plans as $plan)
            <div class="w-full max-w-[20%] flex flex-col items-stretch justify-between rounded shadow">
                <div class="w-full">
                    <div class="w-full px-4 py-2 flex items-center justify-center gap-2 bg-slate-200 rounded-t">
                        <span class="text-lg line-clamp-1">
                            {{ $plan->nama }}
                        </span>
                    </div>

                    <div class="w-full flex items-center justify-between">
                        {{-- RATE --}}
                        <div class="w-fit px-2 py-1 bg-pink text-white text-sm rounded-b">
                            <i class="fa-solid fa-star"></i> {{ $plan->rate > 0 ? number_format($plan->rate, 1) : '-' }}
                        </div>

                        {{-- COUNT FOTO --}}
                        @if ($plan->jenis_layanan == 'produk')
                            <div class="w-fit px-2 py-1 bg-pink text-white text-sm rounded-b">
                                {{ count($plan->foto) }} <i class="fa-regular fa-images"></i>
                            </div>
                        @endif
                    </div>

                    <div class="w-full px-4 my-2 text-sm line-clamp-6"
                        id="detailPlan">
                        {!! $plan->detail !!}
                    </div>
                </div>

                <hr class="w-[90%] mx-auto my-4">

                <ul class="pl-8 list-disc text-sm">
                    <li>{{ $plan->jenis->nama }}</li>
                    <li>{{ $plan->jenis_layanan }}</li>
                </ul>

                <hr class="w-[90%] mx-auto my-4">

                <div>
                    <div class="w-full p-2 text-end">
                            {{ 'Rp ' . number_format($plan->harga, 0, ',', '.') . ',00-' }}
                    </div>

                    <div class="w-full flex items-center justify-end">
                        <a class="w-full p-2 rounded-b text-pink text-center text-sm font-semibold outline-none bg-white hover:bg-pink hover:text-white focus:bg-pink focus:text-white active:bg-pink-active transition-colors"
                            href="{{ route('vendor.layanan.ke_ubah', $plan->id) }}">
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
@endsection

@push('child-js')
    <script>
        $('document').ready(function () {
            $('#detailPlan ul').addClass('list-disc px-4');

            $('#infoBtn').on("click", function () {
                Swal.fire({
                    title: "Info",
                    icon: "info",
                    iconColor: "#F78CA2",
                    html: `
                        <p class="text-justify text-sm">
                            1. Jika ada paket layanan yang hilang, artinya admin telah menghapus Jenis Vendor yang berkaitan dengan paket tersebut <br>
                            2. Data transaksi Anda tetap aman dan masih bisa dicek <br>
                            3. Paket layanan yang dihapus masih terekam dalam catatan transaksi Anda
                        </p>
                    `,
                    showCloseButton: true,
                    confirmButtonColor: "#F78CA2",
                    confirmButtonText: "OK"
                }).then((result) => {
                    return;
                });
            });
        });
    </script>
@endpush
