@extends('user.wedding-couple.layout')

@section('title')
    <title>{{ $photographer->nama }} | Wedding Marketplace</title>
@endsection

@section('content')
    <div class="w-full">
        {{-- container a --}}
        <div class="w-full px-8 py-4 flex items-start justify-start gap-8">
            {{-- container kiri --}}
            <div class="w-1/2">
                {{-- data photographer --}}
                <div class="w-full mb-4 flex items-start justify-start gap-4">
                    {{-- foto --}}
                    <div class="w-[250px]">
                        @if ($photographer->foto_profil)
                            <img class="w-full aspect-square object-cover object-center rounded-full"
                                src="{{ asset($photographer->foto_profil) }}" alt="">
                        @else
                            <span class="w-full aspect-square bg-pink flex items-center justify-center text-[5em] font-bold text-white rounded-full">
                                {{ substr($photographer->nama, 0, 1) }}
                            </span>
                        @endif
                    </div>

                    {{-- data lengkap --}}
                    <div class="w-full">
                        <table>
                            <tbody class="text-sm">
                                <tr> {{-- Owner --}}
                                    <td class="text-center align-top"><i class="fa-solid fa-user-tie"></i></td>
                                    <td class="align-top">Nama</td>
                                    <td class="align-top">:</td>
                                    <td class="align-top" id="namaFotografer">{{ $photographer->nama }}</td>
                                </tr>
                                <tr> {{-- Telepon --}}
                                    <td class="text-center align-top"><i class="fa-solid fa-phone"></i></td>
                                    <td class="align-top">Telepon</td>
                                    <td class="align-top">:</td>
                                    <td class="align-top">{{ $photographer->no_telp }}</td>
                                </tr>
                                <tr> {{-- Alamat --}}
                                    <td class="text-center align-top"><i class="fa-solid fa-location-dot"></i></td>
                                    <td class="align-top">Alamat</td>
                                    <td class="align-top">:</td>
                                    <td class="align-top">{{ $photographer->alamat }}</td>
                                </tr>
                                <tr> {{-- Basis Operasi --}}
                                    <td class="text-center align-top"><i class="fa-regular fa-circle-dot"></i></td>
                                    <td class="align-top whitespace-nowrap">Basis Operasi</td>
                                    <td class="align-top">:</td>
                                    <td class="align-top">{{ $photographer->basis_operasi }}</td>
                                </tr>
                                @if ($photographer->basis_operasi == 'Hanya di Dalam Kota')
                                    <tr> {{-- Kota Operasi --}}
                                        <td class="text-center align-top"><i class="fa-solid fa-location-crosshairs"></i></td>
                                        <td class="align-top whitespace-nowrap">Kota Operasi</td>
                                        <td class="align-top">:</td>
                                        <td class="align-top">{{ $photographer->kota_operasi }}</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- list portofolio --}}
                <div class="w-full p-4">
                    <div class="w-full">
                        <i class="fa-solid fa-grip"></i>
                        <span class="font-semibold">
                            Portofolio
                        </span>
                    </div>

                    <div class="w-full py-4 flex flex-nowrap items-start justify-start gap-4 overflow-x-auto">
                        {{-- item portofolio --}}
                        @forelse ($portofolios as $portofolio)
                            <button class="w-[200px] min-w-[200px] rounded-lg outline-none shadow text-start hover:shadow-lg focus:shadow-lg active:shadow transition-all"
                                type="button" onclick="setPortofolioId({{ $portofolio->id }})">
                                <div class="w-full">
                                    <div class="w-full">
                                        <img class="w-full rounded-t-lg aspect-video object-cover object-center"
                                            src="{{ asset($portofolio->photo->first()->url) }}" alt="">
                                    </div>

                                    <div class="w-full p-2">
                                        <div>
                                            <span class="line-clamp-1">{{ $portofolio->judul }}</span>
                                        </div>

                                        <div class="text-sm">
                                            <span>{{ $portofolio->tanggal }}</span>
                                        </div>
                                    </div>
                                </div>
                            </button>
                        @empty
                            <div class="w-full">
                                <span>
                                    Tidak ada portofolio
                                </span>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

            {{-- container kanan --}}
            @if ($portofolio_detail)
                <div class="w-1/2 bg-slate-100 rounded-lg">
                    {{-- detail foto portofolio --}}
                    <div class="w-full p-2">
                        {{-- foto besar --}}
                        <div class="w-full aspect-video flex items-center justify-center"
                            id="foto_besar">
                            <img class="w-full max-h-[400px] object-contain rounded-md bg-white"
                                src="{{ asset($portofolio_detail->photo->first()->url) }}" alt="">
                        </div>

                        {{-- foto kecil --}}
                        <div class="w-full mt-2 flex items-start justify-center gap-2 overflow-y-auto">
                            @foreach ($portofolio_detail->photo as $foto)
                                <button class="w-[50px] p-1 flex items-center justify-center rounded outline-none bg-white hover:bg-slate-500 focus:bg-slate-500 active:bg-slate-300 transition-colors foto-kecil"
                                    type="button">
                                    <img class="w-full aspect-square object-contain"
                                        src="{{ asset($foto->url) }}" alt="">
                                </button>
                            @endforeach
                        </div>
                    </div>

                    {{-- detail portofolio --}}
                    <div class="w-full px-4 pb-4">
                        <h2 class="text-2xl font-semibold">
                            {{ $portofolio_detail->judul }}
                        </h2>
                        <table>
                            <tbody>
                                <tr>
                                    <td class="text-center align-top"><i class="fa-regular fa-calendar"></i></td>
                                    <td class="align-top">Tanggal</td>
                                    <td class="align-top">:</td>
                                    <td class="align-top">{{ $portofolio_detail->tanggal }}</td>
                                </tr>
                                <tr>
                                    <td class="text-center align-top"><i class="fa-solid fa-info"></i></td>
                                    <td class="align-top">Detail</td>
                                    <td class="align-top">:</td>
                                    <td class="align-top">{!! $portofolio_detail->detail !!}</td>
                                </tr>
                                <tr>
                                    <td class="text-center align-top"><i class="fa-solid fa-location-dot"></i></td>
                                    <td class="align-top">Lokasi</td>
                                    <td class="align-top">:</td>
                                    <td class="align-top">{{ $portofolio_detail->lokasi }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        </div>

        <div class="hidden">
            <form action="{{ route('wedding-couple.search.wo.ke_detail', $photographer->id) }}" method="get" id="portofolioForm">
                @csrf
                <input type="text" name="portofolio_id" id="portofolio_id">
            </form>
        </div>

        {{-- container b --}}
        <div class="w-full p-8 flex items-start justify-start gap-8 border-t-4 border-slate-100">
            {{-- list paket layanan kiri --}}
            <div class="w-2/3 grid grid-cols-4 gap-4">
                @forelse ($plans as $plan)
                    <button class="w-full p-4 rounded text-start outline-none bg-white border-2 border-slate-100 shadow hover:shadow-lg hover:-translate-y-2 focus:shadow-lg focus:-translate-y-2 active:shadow active:translate-y-0 transition-all paket-layanan-button"
                        type="button" data-plan-id="{{ $plan->id }}" id="planBtn-{{ $plan->id }}">
                        <div class="w-full mb-4 flex items-center justify-start gap-2">
                            <i class="fa-solid fa-gift text-3xl text-pink"></i>
                            <span class="flex-1 w-full line-clamp-1 text-lg">
                                {{ $plan->nama }}
                            </span>
                        </div>

                        <div class="w-full text-end">
                            <i class="fa-solid fa-rupiah-sign"></i>
                            {{ number_format($plan->harga, 0, ',', '.') }}
                        </div>
                    </button>
                @empty
                    Tidak ada paket layanan
                @endforelse
            </div>

            {{-- detail paket layanan kanan --}}
            @if (!$plans->isEmpty())
                <div class="w-1/3 shadow rounded-lg border-2 border-slate-100">
                    @forelse ($plans as $plan)
                        <div class="w-full px-4 pt-2 mb-4 hidden detail-layanan"
                            id="detailLayanan-{{ $plan->id }}">
                            {{-- nama --}}
                            <div class="w-full">
                                <span class="text-4xl font-semibold">
                                    {{ $plan->nama }}
                                </span>
                            </div>

                            {{-- fitur --}}
                            <div class="w-full p-4">
                                <ul class="list-disc">
                                    @forelse ($plan->fitur as $fitur)
                                        <li>{{ $fitur->isi }}</li>
                                    @empty
                                        <li>Tidak ada fitur</li>
                                    @endforelse
                                </ul>
                            </div>

                            {{-- harga --}}
                            <div class="w-full flex items-start justify-end gap-2">
                                <i class="fa-solid fa-rupiah-sign text-2xl"></i>
                                <span class="text-xl">
                                    {{ number_format($plan->harga, 0, ',', '.') }}
                                </span>
                            </div>
                        </div>
                    @empty

                    @endforelse

                    {{-- form booking --}}
                    <div class="w-full px-4 py-2 border-t-2 border-slate-100">
                        <form action="{{ route('wedding-couple.search.wp.pesan') }}" method="post" id="bookingForm">
                            @csrf
                            <input class="hidden" type="text" name="plan_id" id="plan_id" value="{{ old('plan_id', '') }}">

                            <div class="w-full flex flex-col items-end justify-start gap-4">
                                @if (!$weddings->isEmpty())
                                    {{-- PERNIKAHAN --}}
                                    <div class="w-full mb-4">
                                        <div class="w-full flex">
                                            <div class="w-10 aspect-square p-2 bg-pink text-white text-sm flex items-center justify-center rounded-s">
                                                <i class="fa-solid fa-dove"></i>
                                            </div>
                                            <select class="w-full p-2 text-sm appearance-none outline-none text-slate-500 border-2 border-s-0 focus:border-pink rounded-e"
                                                name="wedding_id" id="wedding_id">
                                                <option value="" selected>
                                                    Pilih Pernikahan
                                                </option>

                                                @foreach ($weddings as $wedding)
                                                    @if ($wedding->w_p_booking->isEmpty())
                                                        <option value="{{ $wedding->id }}" {{ old('wedding_id') == $wedding->id ? 'selected' : '' }}>
                                                            {{ 'Tn. ' . $wedding->groom . ' & Ny. ' . $wedding->bride }}
                                                        </option>
                                                    @else
                                                        @foreach ($wedding->w_p_booking as $wpb)
                                                            @if ($wpb->plan->w_photographer_id !== $photographer->id)
                                                                <option value="{{ $wedding->id }}" {{ old('wedding_id') == $wedding->id ? 'selected' : '' }}>
                                                                    {{ 'Tn. ' . $wedding->groom . ' & Ny. ' . $wedding->bride }}
                                                                </option>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mt-1 text-sm text-red-500 flex items-center justify-start gap-2">
                                            @error('wedding_id')
                                                <i class="fa-solid fa-circle-info"></i>
                                                <span>{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- TANGGAL --}}
                                    <div class="w-full mb-4">
                                        <div class="w-full flex">
                                            <div class="w-10 aspect-square p-2 bg-pink text-white text-sm flex items-center justify-center rounded-s">
                                                <i class="fa-regular fa-calendar"></i>
                                            </div>
                                            <input class="w-full p-2 flex-1 text-sm border-y-2 border-e-2 rounded-e focus:border-pink focus:outline-none"
                                                type="date" name="tanggal" id="tanggal" placeholder="tanggal"
                                                required
                                                value="{{ old('tanggal') }}">
                                        </div>
                                        <div class="mt-1 text-sm text-red-500 flex items-center justify-start gap-2">
                                            @error('tanggal')
                                                <i class="fa-solid fa-circle-info"></i>
                                                <span>{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- Button Submit --}}
                                    <button class="w-fit px-4 py-2 rounded outline-none bg-pink text-white hover:bg-pink-hover focus:bg-pink-hover active:bg-pink-active transition-colors"
                                        type="button" id="bookingBtn">
                                        Pesan
                                    </button>
                                @else
                                    <a class="w-fit px-4 py-2 rounded outline-none text-pink hover:bg-pink hover:text-white focus:bg-pink focus:text-white active:bg-pink-active transition-colors"
                                        href="{{ route('wedding-couple.pernikahan.ke_tambah') }}">
                                        <i class="fa-regular fa-envelope"></i>
                                        Buat Pernikahan untuk memesan
                                    </a>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection

@push('child-js')
    <script>
        // Ganti Portofolio
        function setPortofolioId(portofolioId) {
            $('#portofolio_id').val(portofolioId);
            $('#portofolioForm').submit();
        }

        $(document).ready(function() {
            // Ganti Foto Portofolio
            $('.foto-kecil').on('click', function() {
                let photoUrl = $(this).find('img').attr('src');

                $('#foto_besar img').attr('src', photoUrl);

                $('.foto-kecil').removeClass('bg-slate-500').addClass('bg-white');
                $(this).removeClass('bg-white').addClass('bg-slate-500');
            });

            // Ganti Paket Layanan
            $('.paket-layanan-button').on('click', function() {
                let planId = $(this).data('plan-id');

                $('.paket-layanan-button').removeClass('border-pink').addClass('border-slate-100');
                $(this).removeClass('border-slate-100').addClass('border-pink');

                $('.detail-layanan').addClass('hidden');

                $('#detailLayanan-' + planId).removeClass('hidden');

                $('#plan_id').val(planId);
            });

            // PILIH PAKET LAYANAN KETIKA HALAMAN DI-LOAD
            // JIKA ADA NILAI OLD PADA PLAN ID
            if ($('#plan_id').val()) {
                // KLIK BUTTON DENGAN ID YANG SESUAI
                let btnId = $('#plan_id').val();
                $(`#planBtn-${btnId}`).click();
            } else {
                // KLIK BUTTON PERTAMA
                $('.paket-layanan-button:first').click();
            }

            $('#bookingBtn').on('click', function() {
                let fotografer = $('#namaFotografer').text();
                let plan       = $(`#planBtn-${$('#plan_id').val()} span`).text();
                let wedding    = "Anda belum memilih pernikahan!";
                let tanggal    = "Anda belum memilih tanggal!";

                if ($('#wedding_id').val() != '') {
                    wedding = `Pernikahan ${$(`#wedding_id option[value='${$('#wedding_id').val()}']`).text()}`;
                }

                if ($('#tanggal').val() != '') {
                    tanggal = $('#tanggal').val();
                }

                Swal.fire({
                    title: "Yakin ingin melakukan pemesanan?",
                    icon: "info",
                    iconColor: "#F78CA2",
                    html: `
                        <table>
                            <tbody>
                                <tr>
                                    <td class="text-start align-top whitespace-nowrap">
                                        Nama
                                    </td>
                                    <td class="align-top"> : </td>
                                    <td class="text-start align-top">
                                        ${fotografer}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-start align-top whitespace-nowrap">
                                        Paket
                                    </td>
                                    <td class="align-top"> : </td>
                                    <td class="text-start align-top">
                                        ${plan}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-start align-top whitespace-nowrap">
                                        Untuk
                                    </td>
                                    <td class="align-top"> : </td>
                                    <td class="text-start align-top">
                                        ${wedding}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-start align-top whitespace-nowrap">
                                        Pada
                                    </td>
                                    <td class="align-top"> : </td>
                                    <td class="text-start align-top">
                                        ${tanggal}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    `,
                    showCloseButton: true,
                    confirmButtonColor: "#F78CA2",
                    confirmButtonText: "Konfirmasi"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#bookingForm').submit();
                    }
                });
            });
        });
    </script>
@endpush
