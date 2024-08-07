@extends('user.layout')

@section('title')
    <title>Ubah Foto Profil | Wedding Marketplace</title>
@endsection

@section('content')
    <div class="max-w-[1000px] mx-auto mt-4">
        {{-- H1 --}}
        <div class="mb-8">
            <h1 class="text-[2em] font-bold">
                Profil > Ubah Foto Profil
            </h1>
        </div>

        {{-- FORM GANTI FOTO --}}
        <form action="{{ route('user.profil.ubah_foto') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="w-full p-4 flex item-center justify-evenly">
                {{-- KIRI --}}
                <div class="relative w-fit p-4">
                    @if (auth()->user()->w_couple && auth()->user()->w_couple->foto_profil)
                        <img class="w-[400px] aspect-square mb-4 object-cover object-center rounded-full border-4 border-pink"
                            src="{{ asset(auth()->user()->w_couple->foto_profil) }}" alt="Foto Profil" id="fotoProfil">
                    @else
                        <span class="w-[400px] aspect-square bg-pink rounded-full flex items-center justify-center text-[5em] font-bold text-white border-4 border-pink"
                            id="fotoProfilText">
                            {{ substr(auth()->user()->name, 0, 1) }}
                        </span>
                    @endif

                    <button class="absolute top-[50px] right-[50px] w-[50px] aspect-square outline-none bg-pink hover:bg-pink-hover focus:bg-pink-hover active:bg-pink-active transition-colors rounded-full"
                        type="button" id="editBtn">
                        <span class="text-3em text-white">
                            <i class="fa-solid fa-pen"></i>
                        </span>
                    </button>
                </div>

                {{-- PANAH --}}
                <div class="hidden items-center justify-center"
                    id="panahContainer">
                    <span class="text-[5em] text-pink">
                        <i class="fa-solid fa-arrow-right-long"></i>
                    </span>
                </div>

                {{-- KANAN --}}
                <div class="w-fit hidden p-4"
                    id="kananContainer">
                    <img class="w-[400px] aspect-square mb-4 object-cover object-center rounded-full border-4 border-pink"
                        src="" alt="Foto Profil Baru" id="fotoProfilBaru">

                    <input class="hidden" type="file" name="foto_profil" id="foto_profil" accept="image/*" required>
                </div>
            </div>

            <div class="w-100 mt-8 flex items-center justify-end gap-4">
                <a class="w-fit px-4 py-2 font-semibold outline-none text-pink bg-white hover:bg-pink hover:text-white focus:bg-pink focus:text-white active:bg-pink-active transition-colors rounded"
                    href="{{ route('user.profil.index') }}">
                    <i class="fa-solid fa-arrow-left-long"></i>
                    <span>Kembali</span>
                </a>

                <button class="w-fit px-4 py-2 text-white font-semibold bg-pink hover:bg-pink-hover focus:bg-pink-hover active:bg-pink-active focus:outline-pink-hover focus:outline-offset-2 transition-colors rounded"
                    type="submit" id="btnSubmit">
                    <i class="fa-solid fa-upload"></i>
                    <span>Unggah Foto Profil</span>
                </button>
            </div>
        </form>
    </div>
@endsection

@push('child-js')
    <script>
        $("#editBtn").on("click", function () {
            $("#foto_profil").click();
        });

        $("#foto_profil").on("change", function () {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();

                reader.onload = function (e) {
                    $("#fotoProfilBaru").attr("src", e.target.result);
                };

                reader.readAsDataURL(file);

                $('#panahContainer').removeClass('hidden').addClass('flex');
                $('#kananContainer').removeClass('hidden');
            }
        });
    </script>
@endpush
