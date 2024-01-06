@extends('user.wedding-couple.layout')

@section('title')
    <title>{{ $organizer->nama_perusahaan }} | Wedding Marketplace</title>
@endsection

@section('content')
    <div class="relative w-full p-8 flex items-start justify-center gap-4">
        {{-- container kiri --}}
        <div class="sticky top-8 w-1/3 mx-auto">
            {{-- data organizer --}}
            <div class="w-full">
                {{-- foto --}}
                <div class="w-full">
                    @if ($organizer->foto_profil)
                        <img class="w-full aspect-video object-cover object-center rounded-t-lg"
                            src="{{ asset($organizer->foto_profil) }}" alt="">
                    @else
                        <span class="w-full aspect-video bg-pink flex items-center justify-center text-[5em] font-bold text-white rounded-t-lg">
                            {{ substr($organizer->nama_perusahaan, 0, 1) }}
                        </span>
                    @endif
                </div>

                {{-- data lengkap --}}
                <div class="w-full p-2 text-sm">
                    <div class="w-full mb-2"> {{-- Pemilik --}}
                        <div class="w-full flex items-center justify-start gap-2">
                            <i class="fa-solid fa-user-tie text-pink"></i>
                            <p>Pemilik</p>
                        </div>
                        <div class="w-full px-6" id="namaOrganizer">
                            {{ $organizer->nama_pemilik }}
                        </div>
                    </div>
                    <div class="w-full mb-2"> {{-- Perusahaan --}}
                        <div class="w-full flex items-center justify-start gap-2">
                            <i class="fa-solid fa-building text-pink"></i>
                            <p>Perusahaan</p>
                        </div>
                        <div class="w-full px-6">
                            {{ $organizer->nama_perusahaan }}
                        </div>
                    </div>
                    <div class="w-full mb-2"> {{-- Telepon --}}
                        <div class="w-full flex items-center justify-start gap-2">
                            <i class="fa-solid fa-phone text-pink"></i>
                            <p>Telepon</p>
                        </div>
                        <div class="w-full px-6">
                            {{ $organizer->no_telp }}
                        </div>
                    </div>
                    <div class="w-full mb-2"> {{-- Alamat --}}
                        <div class="w-full flex items-center justify-start gap-2">
                            <i class="fa-solid fa-location-dot text-pink"></i>
                            <p>Alamat</p>
                        </div>
                        <div class="w-full px-6">
                            {{ $organizer->alamat }}
                        </div>
                    </div>
                    <div class="w-full mb-2"> {{-- Basis Operasi --}}
                        <div class="w-full flex items-center justify-start gap-2">
                            <i class="fa-solid fa-circle-dot text-pink"></i>
                            <p>Basis Operasi</p>
                        </div>
                        <div class="w-full px-6">
                            {{ $organizer->basis_operasi }}
                        </div>
                    </div>
                    @if ($organizer->basis_operasi == 'Hanya di Dalam Kota')
                        <div class="w-full mb-2"> {{-- Kota Operasi --}}
                            <div class="w-full flex items-center justify-start gap-2">
                                <i class="fa-solid fa-location-crosshairs text-pink"></i>
                                <p>Kota Operasi</p>
                            </div>
                            <div class="w-full px-6">
                                {{ $organizer->kota_operasi }}
                            </div>
                        </div>
                    @endif
                    <div class="w-full mb-2"> {{-- Kategori --}}
                        <div class="w-full flex items-center justify-start gap-2">
                            <i class="fa-solid fa-hashtag text-pink"></i>
                            <p>Kategori</p>
                        </div>
                        <div class="w-full px-6 py-2">
                            @forelse ($categories as $kategori)
                                <span class="w-fit mr-1 px-2 py-1 text-xs border border-pink rounded-full whitespace-nowrap">
                                    {{ $kategori->nama }}
                                </span>
                            @empty
                                Tidak ada kategori
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- container kanan --}}
        <div class="w-full">
            {{-- container portofolio --}}
            <div class="w-full mx-auto mb-8 flex items-start justify-start gap-8">
                @if ($portofolio_detail)
                    {{-- portofolio --}}
                    <div class="w-full">
                        {{-- detail portofolio --}}
                        <div class="w-full bg-slate-100 rounded-lg">
                            <div class="w-full pt-2 text-center text-xl">
                                <span>
                                    Portofolio
                                </span>
                            </div>

                            {{-- detail foto portofolio --}}
                            <div class="w-full p-2">
                                {{-- foto besar --}}
                                <div class="w-full aspect-video max-h-[400px] flex items-center justify-center"
                                    id="foto_besar">
                                    <img class="w-full max-h-full object-contain rounded-md bg-white"
                                        src="{{ asset($portofolio_detail->photo->first()->url) }}" alt="">
                                </div>

                                {{-- foto kecil --}}
                                <div class="w-full mt-2 flex items-start justify-center gap-2 overflow-x-auto">
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
                        <div class="w-full p-4 pb-0">
                            <div class="w-full">
                                <i class="fa-solid fa-grip"></i>
                                <span class="font-semibold">
                                    Portofolio Lainnya
                                </span>
                            </div>

                            <div class="w-full py-4 flex flex-nowrap items-start justify-start gap-4 overflow-x-auto">
                                {{-- item portofolio --}}
                                @forelse ($portofolios as $portofolio)
                                    <button class="w-[200px] min-w-[200px] rounded-lg outline-none bg-white shadow text-start hover:shadow-lg focus:shadow-lg active:shadow transition-all"
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

                                @endforelse
                            </div>
                        </div>
                    </div>
                @else
                    <div class="w-full">
                        Tidak ada portofolio
                    </div>
                @endif
            </div>

            {{-- form ganti portofolio --}}
            <div class="hidden">
                <form action="{{ route('wedding-couple.search.wo.ke_detail', $organizer->id) }}" method="get" id="portofolioForm">
                    @csrf
                    <input type="text" name="portofolio_id" id="portofolio_id">
                </form>
            </div>

            {{-- container paket layanan --}}
            <div class="w-full border-t-4 border-slate-100">
                @if (!$plans->isEmpty())
                    <div class="w-full my-8">
                        <p class="w-full text-center text-2xl">
                            Paket Layanan
                        </p>
                    </div>

                    <div class="w-full flex items-start justify-start gap-4">
                        {{-- list paket layanan kiri --}}
                        <div class="w-1/2 grid grid-cols-2 gap-2">
                            @foreach ($plans as $plan)
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
                            @endforeach
                        </div>

                        {{-- detail paket layanan kanan --}}
                        <div class="w-1/2 shadow rounded-lg border-2 border-slate-100">
                            @foreach ($plans as $plan)
                                <div class="w-full px-4 pt-2 mb-4 hidden detail-layanan"
                                    id="detailLayanan-{{  $plan->id  }}">
                                    {{-- nama --}}
                                    <div class="w-full">
                                        <span class="text-4xl font-semibold"
                                            id="namaPlan">
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
                            @endforeach

                            {{-- form booking --}}
                            <div class="w-full px-4 py-2 border-t-2 border-slate-100">
                                <form action="{{ route('wedding-couple.search.wo.pesan') }}" method="post" id="bookingForm">
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
                                                            @if (!$wedding->w_o_booking)
                                                                <option value="{{ $wedding->id }}" {{ old('wedding_id') == $wedding->id ? 'selected' : '' }}>
                                                                    {{ 'Tn. ' . $wedding->groom . ' & Ny. ' . $wedding->bride }}
                                                                </option>
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
                    </div>
                @else
                    <div class="w-full mt-8">
                        Tidak ada paket layanan
                    </div>
                @endif
            </div>
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
                let organizer = $('#namaOrganizer').text();
                let plan      = $(`#planBtn-${$('#plan_id').val()} span`).text();
                let wedding   = "Anda belum memilih pernikahan!";
                let tanggal   = "Anda belum memilih tanggal!";

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
                                        ${organizer}
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
