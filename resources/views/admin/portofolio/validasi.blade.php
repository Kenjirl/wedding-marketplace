@extends('admin.layout')

@section('title')
    <title>Validasi Portofolio | Wedding Marketplace</title>
@endsection

@section('h1', 'Portofolio > Validasi Portofolio')

@section('content')
    {{-- BUTTON --}}
    <div class="w-full flex items-center justify-between">
        <div class="w-1/3">
            <a class="w-fit px-4 py-2 block font-semibold outline-none text-pink bg-white hover:bg-pink hover:text-white focus:bg-pink focus:text-white active:bg-pink-active transition-colors rounded"
                href="{{ route('admin.portofolio.index', $portofolio->status) }}">
                <i class="fa-solid fa-arrow-left-long"></i>
                <span>Kembali</span>
            </a>
        </div>

        <div class="w-1/3 flex items-center justify-center">
            <button class="w-[40px] aspect-square p-2 bg-pink text-white text-center rounded"
                type="button" id="infoBtn">
                <i class="fa-solid fa-circle-info"></i>
            </button>
        </div>

        <div class="w-1/3 flex items-center justify-end gap-4">
            <button class="w-fit px-4 py-2 font-semibold outline-none text-red-400 bg-white hover:bg-red-400 hover:text-white focus:bg-red-400 focus:text-white active:bg-red-200 transition-colors rounded"
                id="rejectBtn" type="button" onclick="kirim('ditolak', 'Tolak')">
                <i class="fa-solid fa-ban"></i>
                <span>Tolak</span>
            </button>

            <button class="w-fit px-4 py-2 font-semibold outline-none text-blue-400 bg-white hover:bg-blue-400 hover:text-white focus:bg-blue-400 focus:text-white active:bg-blue-200 transition-colors rounded"
                id="acceptBtn" type="button" onclick="kirim('diterima', 'Terima')">
                <i class="fa-regular fa-circle-check"></i>
                <span>Terima</span>
            </button>
        </div>
    </div>

    <hr class="my-4">

    <form action="{{ route('admin.portofolio.validasi', $portofolio->id) }}" method="post" id="validasiForm">
        @csrf
        <div class="w-full flex items-start justify-between gap-4">
            {{-- KIRI --}}
            <div class="w-2/5">
                {{-- JUDUL --}}
                <div class="w-full">
                    <p class="text-xl font-semibold">
                        {{ $portofolio->judul }}
                    </p>
                </div>

                <div class="w-full px-4 py-2 text-sm text-slate-400 italic">
                    <table>
                        <tbody>
                            <tr class="align-top">
                                <td>Oleh</td>
                                <td class="px-2">:</td>
                                <td>{{ $portofolio->w_vendor->nama }}</td>
                            </tr>
                            <tr class="align-top">
                                <td>Tanggal</td>
                                <td class="px-2">:</td>
                                <td>{{ $portofolio->tanggal }}</td>
                            </tr>
                            <tr class="align-top">
                                <td>Lokasi</td>
                                <td class="px-2">:</td>
                                <td>{{ $portofolio->lokasi }}</td>
                            </tr>
                            <tr class="align-top">
                                <td>Detail</td>
                                <td class="px-2">:</td>
                                <td>
                                    <div>
                                        {!! $portofolio->detail !!}
                                    </div>
                                </td>
                            </tr>
                            @if ($portofolio->admin)
                                <tr class="align-top">
                                    <td class="whitespace-nowrap">{{ ucwords($portofolio->status) }} oleh</td>
                                    <td class="px-2">:</td>
                                    <td>{{ $portofolio->admin->nama }}</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>

                {{-- STATUS --}}
                <div class="hidden w-full mb-4">
                    <div class="w-full">
                        <div class="w-full">
                            <input type="text" name="status" id="status" value="">
                        </div>
                    </div>
                </div>
            </div>

            {{-- KANAN --}}
            <div class="w-3/5">
                {{-- GALERI --}}
                <div class="w-full rounded shadow">
                    <div class="p-2 rounded-t font-semibold bg-slate-100">
                        Galeri
                    </div>

                    <div class="w-full grid grid-cols-3 p-2 gap-2"
                        id="image-preview">
                        @foreach ($portofolio->foto as $index => $foto)
                            <div class="relative flex items-center justify-center rounded bg-slate-100">
                                <a href="{{ asset($foto['url']) }}" data-fancybox="gallery">
                                    <img class="w-full aspect-square object-cover rounded"
                                        src="{{ asset($foto['url']) }}" alt="Foto Portofolio">
                                </a>

                                <input class="absolute top-0 right-0 w-6 aspect-square cursor-pointer"
                                    type="checkbox" name="rejected[]" value="{{ $index }}" {{ $foto['rejected'] ? 'checked' : '' }}>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@push('child-js')
    <script>
        function kirim(status, text) {
            Swal.fire({
                title: `${text} portofolio ini?`,
                icon: "warning",
                iconColor: "#F78CA2",
                showCloseButton: true,
                confirmButtonColor: "#F78CA2",
                confirmButtonText: "Konfirmasi"
            }).then((result) => {
                if (result.isConfirmed) {
                    $("#status").val(status);
                    const validasiForm = document.getElementById('validasiForm');
                    validasiForm.submit();
                }
            });
        }

        $(document).ready(function() {
            $('ul').addClass('list-disc pl-8');

            Fancybox.bind("[data-fancybox]");

            $('#infoBtn').on("click", function () {
                Swal.fire({
                    title: "Info",
                    icon: "info",
                    iconColor: "#F78CA2",
                    html: `
                        <p class="text-justify text-sm">
                            1. Jika terdapat gambar yang mengandung SARA, harap mencentang gambar tersebut sebelum menolak
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
