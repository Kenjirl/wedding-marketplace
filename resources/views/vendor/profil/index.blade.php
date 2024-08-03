@extends('vendor.layout')

@section('title')
    <title>Profil | Wedding Marketplace</title>
@endsection

@section('h1', 'Profil')

@section('content')
    {{-- DATA DIRI --}}
    <div class="w-full flex gap-8">
        <div class="w-fit">
            <div class="flex flex-col items-center justify-start gap-4 mb-4">
                @if (auth()->user()->w_vendor && auth()->user()->w_vendor->foto_profil)
                    <img class="w-[200px] aspect-square object-cover object-center rounded-full border-4 border-pink"
                        src="{{ asset(auth()->user()->w_vendor->foto_profil) }}" alt="Foto Profil" id="fotoProfil">
                @else
                    <span class="w-[200px] aspect-square bg-pink rounded-full flex items-center justify-center text-[5em] font-bold text-white border-4 border-pink"
                        id="fotoProfilText">
                        {{ substr(auth()->user()->name, 0, 1) }}
                    </span>
                @endif

                @if (auth()->user()->w_vendor)
                    <a class="w-full py-2 font-semibold outline-none text-center text-pink bg-white hover:bg-pink hover:text-white focus:bg-pink focus:text-white active:bg-pink-active transition-colors rounded"
                        href="{{ route('vendor.profil.ke_ubah_foto') }}" id="gantiFotoBtn">
                        <i class="fa-regular fa-image"></i>
                        <span>Ganti Foto</span>
                    </a>
                @endif
            </div>
        </div>

        <div class="w-full flex-1">
            {{-- ATAS --}}
            <div class="w-full flex items-start justify-between gap-8">
                {{-- KIRI --}}
                <div class="flex-1">
                    {{-- NAMA PEMILIK --}}
                    <div class="w-full mb-4">
                        <div class="w-full p-2 text-xs font-bold bg-pink text-white flex items-center justify-start rounded-t">
                            <i class="fa-solid fa-building-user"></i>
                            <span class="ml-2">
                                Nama
                            </span>
                        </div>
                        <input class="w-full p-2 flex-1 border-x-2 border-b-2 text-sm rounded-b focus:border-pink focus:outline-none"
                            type="text" name="nama" id="nama" placeholder="Budi Pekerti"
                            value="{{ auth()->user()->w_vendor ? auth()->user()->w_vendor->nama : 'Belum Terdata'  }}"
                            disabled>
                    </div>

                    {{-- TELEPON --}}
                    <div class="w-full mb-4">
                        <div class="w-full p-2 text-xs font-bold bg-pink text-white flex items-center justify-start rounded-t">
                            <i class="fa-solid fa-phone"></i>
                            <span class="ml-2">
                                Telepon
                            </span>
                        </div>
                        <input class="w-full p-2 flex-1 border-x-2 border-b-2 text-sm rounded-b focus:border-pink focus:outline-none"
                            type="number" name="no_telp" id="no_telp" placeholder="081234567890" min="0"
                            value="{{ auth()->user()->w_vendor ? auth()->user()->w_vendor->no_telp : '0800000000'  }}"
                            disabled>
                    </div>

                    {{-- EMAIL --}}
                    <div class="w-full mb-4">
                        <div class="w-full p-2 text-xs font-bold bg-pink text-white flex items-center justify-start rounded-t">
                            <i class="fa-solid fa-at"></i>
                            <span class="ml-2">
                                Email
                            </span>
                        </div>
                        <input class="w-full p-2 flex-1 border-x-2 border-b-2 text-sm rounded-b focus:border-pink focus:outline-none"
                            type="email" name="email" id="email" placeholder="email@gmai.com" value="{{ auth()->user()->email }}" disabled>
                    </div>
                </div>

                {{-- KANAN --}}
                <div class="flex-1">
                    {{-- BASIS OPERASI --}}
                    <div class="w-full mb-4">
                        <div class="w-full p-2 text-xs font-bold bg-pink text-white flex items-center justify-start rounded-t">
                            <i class="fa-regular fa-circle-dot"></i>
                            <span class="ml-2">
                                Basis Operasi
                            </span>
                        </div>
                        <input class="w-full p-2 flex-1 border-x-2 border-b-2 text-sm rounded-b focus:border-pink focus:outline-none"
                            type="text" name="basis_operasi" id="basis_operasi" placeholder="Dalam/Luar Kota"
                            value="{{ auth()->user()->w_vendor ? auth()->user()->w_vendor->basis_operasi : 'Belum Terdata'  }}"
                            disabled>
                    </div>

                    @if (auth()->user()->w_vendor && auth()->user()->w_vendor->basis_operasi == 'Hanya di Dalam Kota')
                        {{-- KOTA OPERASI --}}
                        <div class="w-full mb-4">
                            <div class="w-full p-2 text-xs font-bold bg-pink text-white flex items-center justify-start rounded-t">
                                <i class="fa-solid fa-location-crosshairs"></i>
                                <span class="ml-2">
                                    Kota Operasi
                                </span>
                            </div>
                            <input class="w-full p-2 flex-1 border-x-2 border-b-2 text-sm rounded-b focus:border-pink focus:outline-none"
                                type="text" name="kota_operasi" id="kota_operasi" placeholder="Badung"
                                value="{{ auth()->user()->w_vendor ? auth()->user()->w_vendor->kota_operasi : 'Belum Terdata'  }}"
                                disabled>
                        </div>
                    @endif
                </div>
            </div>

            {{-- ALAMAT --}}
            <div class="w-full">
                <div class="w-full p-2 text-xs font-bold bg-pink text-white flex items-center justify-start rounded-t">
                    <i class="fa-solid fa-location-dot"></i>
                    <span class="ml-2">
                        Alamat
                    </span>
                </div>
                <div class="w-full p-2 flex-1 border-x-2 border-b-2 text-sm rounded-b">
                    {{ auth()->user()->w_vendor ? auth()->user()->w_vendor->alamat : 'Belum Terdata'  }}
                </div>
            </div>

            {{-- BUTTON --}}
            <div class="w-full mt-4 flex items-center justify-end gap-4">
                <a class="w-fit px-4 py-2 font-semibold outline-none text-pink bg-white hover:bg-pink hover:text-white focus:bg-pink focus:text-white active:bg-pink-active transition-colors rounded"
                    href="{{ route('vendor.profil.ke_ubah_password') }}">
                    <i class="fa-solid fa-lock"></i>
                    <span>Ubah Password</span>
                </a>

                <a class="w-fit px-4 py-2 rounded text-white font-semibold bg-pink hover:bg-pink-hover focus:bg-pink-hover active:bg-pink-active focus:outline-pink-hover focus:outline-offset-2 transition-colors"
                    href="{{ route('vendor.profil.ke_ubah') }}">
                    <i class="fa-regular fa-pen-to-square"></i>
                    <span>Ubah Profil</span>
                </a>
            </div>
        </div>
    </div>

    @if (auth()->user()->w_vendor)
        <hr class="my-4">

        <div class="w-full flex items-start justify-center gap-4"
            id="jenisVendor">
            <div class="w-full rounded-lg border shadow">
                <div class="w-full py-2 px-4 flex items-center justify-between border-b">
                    <div class="font-semibold">
                        Jenis Vendor Anda
                    </div>

                    <button class="w-[30px] aspect-square bg-pink text-white text-center rounded"
                        type="button" id="infoBtn">
                        <i class="fa-solid fa-circle-info"></i>
                    </button>
                </div>

                <div class="w-full min-h-[300px] p-4">
                    @forelse ($j_vendors as $j_vendor)
                        <div class="w-full mb-2 flex items-center justify-between">
                            <div class="w-full flex items-center justify-start gap-2">
                                <div class="w-[30px] aspect-square flex items-center justify-center bg-pink text-white font-semibold rounded">
                                    {{ $loop->iteration }}
                                </div>

                                <div>
                                    {{ $j_vendor->master->nama }}
                                </div>
                            </div>

                            <div>
                                <form class="hapusJenisVendorForm" action="{{ route('vendor.profil.hapus-jenis', $j_vendor->id) }}" method="post">
                                    @csrf
                                    <button class="w-[30px] aspect-square flex items-center justify-center rounded text-white font-semibold bg-pink hover:bg-pink-hover focus:bg-pink-hover active:bg-pink-active focus:outline-pink-hover focus:outline-offset-2 transition-colors"
                                        type="submit">
                                        <i class="fa-solid fa-xmark"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @empty
                        Anda belum memilih jenis vendor
                    @endforelse
                </div>
            </div>

            <div class="w-full rounded-lg border shadow">
                <div class="w-full py-2 px-4 font-semibold border-b">
                    <div class="min-h-[30px] flex items-center justify-start">
                        Daftar Jenis Vendor
                    </div>
                </div>

                <div class="w-full min-h-[300px] p-4 flex flex-col items-center justify-center">
                    @if ($m_j_vendors->isNotEmpty())
                        <form class="w-full" action="{{ route('vendor.profil.tambah-jenis') }}" method="post">
                            @csrf
                            <div class="w-full mb-8">
                                <select class="w-full p-2 rounded outline-pink border border-pink"
                                    name="j_vendor" id="j_vendor">
                                    @foreach ($m_j_vendors as $m_jenis)
                                        <option value="{{ $m_jenis->id }}">{{ $m_jenis->nama }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="w-full text-center">
                                <button class="w-fit mx-auto px-4 py-2 rounded text-white font-semibold bg-pink hover:bg-pink-hover focus:bg-pink-hover active:bg-pink-active focus:outline-pink-hover focus:outline-offset-2 transition-colors"
                                    type="submit">
                                    Tambahkan Jenis Vendor
                                </button>
                            </div>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    @endif
@endsection

@push('child-js')
    <script>
        $('.hapusJenisVendorForm').each(function() {
            $(this).on('submit', function (e) {
                e.preventDefault();
                let form = this;

                Swal.fire({
                    title: 'Hapus Jenis Vendor ini?',
                    icon: "warning",
                    iconColor: "#F78CA2",
                    html: `
                        <p class="text-justify text-sm">
                            1. Semua data terkait jenis vendor Anda ini akan ikut dihapus <br>
                            2. Portofolio dan paket layanan yang Anda buat dengan jenis vendor ini akan dihapus dan tidak dapat digunakan lagi <br>
                            3. Anda masih bisa mengecek rekaman informasi mengenai jenis vendor ini, namun tidak dapat menggunakannya kembali <br>
                        </p>
                    `,
                    showCloseButton: true,
                    confirmButtonColor: "#F78CA2",
                    confirmButtonText: "Konfirmasi"
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });

        $('#infoBtn').on("click", function () {
            Swal.fire({
                title: "Info",
                icon: "info",
                iconColor: "#F78CA2",
                html: `
                    <p class="text-justify text-sm">
                        1. Silahkan tambahkan jenis vendor yang Anda inginkan <br>
                        2. Portofolio dan paket layanan yang akan Anda buat berkaitan dengan jenis vendor ini <br>
                        3. Jika Anda menghapus jenis vendor, portofolio dan paket layanan dengan jenis vendor yang dihapus akan ikut terhapus <br>
                        4. Jika Anda mengembalikan jenis vendor yang dihapus, maka akan mengembalikan juga portofolio dan paket layanan yang telah dihapus <br>
                    </p>
                `,
                showCloseButton: true,
                confirmButtonColor: "#F78CA2",
                confirmButtonText: "OK"
            });
        });
    </script>
@endpush
