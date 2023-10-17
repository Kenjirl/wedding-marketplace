@extends('user.wedding-photographer.layout')

@section('title')
    <title>Ubah Profil | Wedding Marketplace</title>
@endsection

@section('h1', 'Profil > Ubah Profil')

@section('content')
    <div class="px-4 pb-4">
        <ol class="list-decimal text-sm">
            <li>Silahkan isi data diri Anda</li>
            <li>Harap memilih data sesuai dengan pilihan yang sudah disediakan</li>
            <li>Harap untuk tidak menggunakan tanda baca apapun kecuali pada Nama Pengguna</li>
        </ol>
    </div>

    <div class="w-100 flex-1">
        <form action="{{ route('wedding-photographer.ubah_profil') }}" method="post" autocomplete="off">
            @csrf
            {{-- ATAS --}}
            <div class="w-100 flex items-start justify-between gap-8">
                {{-- KIRI --}}
                <div class="w-[50%]" id="formKiri">
                    {{-- NAMA --}}
                    <div class="w-100 mb-4">
                        <div class="w-100">
                            <div class="w-full p-2 text-xs font-bold bg-pink @error('nama') bg-red-500 @enderror text-white flex items-center justify-start rounded-t">
                                Nama
                            </div>
                            <input class="w-full p-2 flex-1 border-x-2 border-b-2 @error('nama') border-red-500 @enderror rounded-b focus:border-pink focus:outline-none"
                                type="text" name="nama" id="nama" placeholder="Budi Pekerti"
                                required
                                value="{{ old('nama', auth()->user()->w_photographer ? auth()->user()->w_photographer->nama : '') }}">
                        </div>

                        <div class="h-4 mt-1 text-sm text-red-500 flex items-center justify-start gap-2">
                            @error('nama')
                                <i class="fa-solid fa-circle-info"></i>
                                <span>{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    {{-- NAMA PENGGUNA --}}
                    <div class="w-100 mb-4">
                        <div class="w-100">
                            <div class="w-full p-2 text-xs font-bold bg-pink @error('username') bg-red-500 @enderror text-white flex items-center justify-start rounded-t">
                                Nama Pengguna
                            </div>
                            <input class="w-full p-2 flex-1 border-x-2 border-b-2 @error('username') border-red-500 @enderror rounded-b focus:border-pink focus:outline-none"
                                type="text" name="username" id="username" placeholder="Budi123"
                                required
                                value="{{ old('username', auth()->user()->name) }}">
                        </div>

                        <div class="h-4 mt-1 text-sm text-red-500 flex items-center justify-start gap-2">
                            @error('username')
                                <i class="fa-solid fa-circle-info"></i>
                                <span>{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    {{-- TELEPON --}}
                    <div class="w-100 mb-4">
                        <div class="w-100">
                            <div class="w-full p-2 text-xs font-bold bg-pink @error('no_telp') bg-red-500 @enderror text-white flex items-center justify-start rounded-t">
                                Telepon
                            </div>
                            <input class="w-full p-2 flex-1 border-x-2 border-b-2 @error('no_telp') border-red-500 @enderror rounded-b focus:border-pink focus:outline-none"
                                type="number" name="no_telp" id="no_telp" placeholder="081234567890"
                                required
                                value="{{ old('no_telp', auth()->user()->w_photographer ? auth()->user()->w_photographer->no_telp : '') }}">
                        </div>

                        <div class="h-4 mt-1 text-sm text-red-500 flex items-center justify-start gap-2">
                            @error('no_telp')
                                <i class="fa-solid fa-circle-info"></i>
                                <span>{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    {{-- STATUS --}}
                    <div class="relative w-100 mb-4">
                        <div class="w-100">
                            <div class="w-full p-2 text-xs font-bold bg-pink @error('status') bg-red-500 @enderror text-white flex items-center justify-start rounded-t">
                                Status
                            </div>
                            <input class="w-full p-2 flex-1 border-x-2 border-b-2 @error('status') border-red-500 @enderror rounded-b focus:border-pink focus:outline-none"
                                type="text" name="status" id="status" placeholder="Individu/Organisasi" onkeyup="changeStatusOptions()" onfocus="showStatusOptions()"
                                required
                                value="{{ old('status', auth()->user()->w_photographer ? auth()->user()->w_photographer->status : '') }}">

                            <div class="absolute w-full p-1 gap-1 rounded bg-slate-200 hidden flex-col items-start justify-start z-10"
                                id="statusOptions">
                                <button class="w-full text-start outline-none rounded-sm px-2 bg-white hover:bg-slate-300 focus:bg-slate-300 active:bg-slate-400 transition-colors"
                                    type="button" data-value="Individu" onclick="selectStatus(this)">
                                    Individu
                                </button>
                                <button class="w-full text-start outline-none rounded-sm px-2 bg-white hover:bg-slate-300 focus:bg-slate-300 active:bg-slate-400 transition-colors"
                                    type="button" data-value="Organisasi" onclick="selectStatus(this)">
                                    Organisasi
                                </button>
                            </div>
                        </div>

                        <div class="h-4 mt-1 text-sm text-red-500 flex items-center justify-start gap-2">
                            @error('status')
                                <i class="fa-solid fa-circle-info"></i>
                                <span>{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    {{-- GENDER --}}
                    <div class="relative hidden w-100 mb-4" id="genderContainer">
                        <div class="w-100">
                            <div class="w-full p-2 text-xs font-bold bg-pink @error('gender') bg-red-500 @enderror text-white flex items-center justify-start rounded-t">
                                Gender
                            </div>
                            <input class="w-full p-2 flex-1 border-x-2 border-b-2 @error('gender') border-red-500 @enderror rounded-b focus:border-pink focus:outline-none"
                                type="text" name="gender" id="gender" placeholder="Pria/Wanita" onkeyup="changeGenderOptions()" onfocus="showGenderOptions()"
                                disabled
                                value="{{ old('gender', auth()->user()->w_photographer ? auth()->user()->w_photographer->gender : '') }}">

                            <div class="absolute w-full p-1 gap-1 rounded bg-slate-200 hidden flex-col items-start justify-start z-10"
                                id="genderOptions">
                                <button class="w-full text-start outline-none rounded-sm px-2 bg-white hover:bg-slate-300 focus:bg-slate-300 active:bg-slate-400 transition-colors"
                                    type="button" data-value="Pria" onclick="selectGender(this)">
                                    Pria
                                </button>
                                <button class="w-full text-start outline-none rounded-sm px-2 bg-white hover:bg-slate-300 focus:bg-slate-300 active:bg-slate-400 transition-colors"
                                    type="button" data-value="Wanita" onclick="selectGender(this)">
                                    Wanita
                                </button>
                            </div>
                        </div>

                        <div class="h-4 mt-1 text-sm text-red-500 flex items-center justify-start gap-2">
                            @error('gender')
                                <i class="fa-solid fa-circle-info"></i>
                                <span>{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    {{-- BASIS OPERASI --}}
                    <div class="relative w-100 mb-4">
                        <div class="w-100">
                            <div class="w-full p-2 text-xs font-bold bg-pink @error('basis_operasi') bg-red-500 @enderror text-white flex items-center justify-start rounded-t">
                                Basis Operasi
                            </div>
                            <input class="w-full p-2 flex-1 border-x-2 border-b-2 @error('basis_operasi') border-red-500 @enderror rounded-b focus:border-pink focus:outline-none"
                                type="text" name="basis_operasi" id="basis_operasi" placeholder="Dalam/Luar Kota" onkeyup="changeBasisOperasiOptions()" onfocus="showBasisOperasiOptions()"
                                required
                                value="{{ old('basis_operasi', auth()->user()->w_photographer ? auth()->user()->w_photographer->basis_operasi : '') }}">

                            <div class="absolute w-full p-1 gap-1 rounded bg-slate-200 hidden flex-col items-start justify-start z-10"
                                id="basisOperasiOptions">
                                <button class="w-full text-start outline-none rounded-sm px-2 bg-white hover:bg-slate-300 focus:bg-slate-300 active:bg-slate-400 transition-colors"
                                    type="button" data-value="Hanya di Dalam Kota" onclick="selectBasisOperasi(this)">
                                    Hanya di Dalam Kota
                                </button>
                                <button class="w-full text-start outline-none rounded-sm px-2 bg-white hover:bg-slate-300 focus:bg-slate-300 active:bg-slate-400 transition-colors"
                                    type="button" data-value="Bisa ke Luar Kota" onclick="selectBasisOperasi(this)">
                                    Bisa ke Luar Kota
                                </button>
                            </div>
                        </div>

                        <div class="h-4 mt-1 text-sm text-red-500 flex items-center justify-start gap-2">
                            @error('basis_operasi')
                                <i class="fa-solid fa-circle-info"></i>
                                <span>{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    {{-- KOTA OPERASI --}}
                    <div class="relative w-100 mb-4 hidden" id="kotaOperasiContainer">
                        <div class="w-100">
                            <div class="w-full p-2 text-xs font-bold bg-pink @error('kota_operasi') bg-red-500 @enderror text-white flex items-center justify-start rounded-t">
                                Kota Operasi
                            </div>
                            <input class="w-full p-2 flex-1 border-x-2 border-b-2 @error('kota_operasi') border-red-500 @enderror rounded-b focus:border-pink focus:outline-none"
                                type="text" name="kota_operasi" id="kota_operasi" placeholder="Badung"
                                disabled
                                value="{{ old('kota_operasi', auth()->user()->w_photographer ? auth()->user()->w_photographer->kota_operasi : '') }}">
                        </div>

                        <div class="h-4 mt-1 text-sm text-red-500 flex items-center justify-start gap-2">
                            @error('kota_operasi')
                                <i class="fa-solid fa-circle-info"></i>
                                <span>{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- KANAN --}}
                <div class="hidden flex-1" id="formKanan">
                    {{-- PROVINSI --}}
                    <div class="relative w-100 mb-4">
                        <div class="w-100">
                            <div class="w-full p-2 text-xs font-bold bg-pink @error('provinsi') bg-red-500 @enderror text-white flex items-center justify-start rounded-t">
                                Provinsi
                            </div>
                            <input class="w-full p-2 flex-1 border-x-2 border-b-2 @error('provinsi') border-red-500 @enderror rounded-b focus:border-pink focus:outline-none"
                                type="text" name="provinsi" id="provinsi" placeholder="Bali"
                                disabled
                                value="{{ old('provinsi', $provinsi) }}">
                        </div>

                        <div class="h-4 mt-1 text-sm text-red-500 flex items-center justify-start gap-2">
                            @error('provinsi')
                                <i class="fa-solid fa-circle-info"></i>
                                <span>{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    {{-- KOTA --}}
                    <div class="relative w-100 mb-4">
                        <div class="w-100">
                            <div class="w-full p-2 text-xs font-bold bg-pink @error('kota') bg-red-500 @enderror text-white flex items-center justify-start rounded-t">
                                Kota/Kabupaten
                            </div>
                            <input class="w-full p-2 flex-1 border-x-2 border-b-2 @error('kota') border-red-500 @enderror rounded-b focus:border-pink focus:outline-none"
                                type="text" name="kota" id="kota" placeholder="Badung"
                                disabled
                                value="{{ old('kota', $kota) }}">
                        </div>

                        <div class="h-4 mt-1 text-sm text-red-500 flex items-center justify-start gap-2">
                            @error('kota')
                                <i class="fa-solid fa-circle-info"></i>
                                <span>{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    {{-- KECAMATAN --}}
                    <div class="relative w-100 mb-4">
                        <div class="w-100">
                            <div class="w-full p-2 text-xs font-bold bg-pink @error('kecamatan') bg-red-500 @enderror text-white flex items-center justify-start rounded-t">
                                Kecamatan
                            </div>
                            <input class="w-full p-2 flex-1 border-x-2 border-b-2 @error('kecamatan') border-red-500 @enderror rounded-b focus:border-pink focus:outline-none"
                                type="text" name="kecamatan" id="kecamatan" placeholder="Kuta Selatan"
                                value="{{ old('kecamatan', $kecamatan) }}">
                        </div>

                        <div class="h-4 mt-1 text-sm text-red-500 flex items-center justify-start gap-2">
                            @error('kecamatan')
                                <i class="fa-solid fa-circle-info"></i>
                                <span>{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    {{-- KELURAHAN --}}
                    <div class="relative w-100 mb-4">
                        <div class="w-100">
                            <div class="w-full p-2 text-xs font-bold bg-pink @error('kelurahan') bg-red-500 @enderror text-white flex items-center justify-start rounded-t">
                                Kelurahan
                            </div>
                            <input class="w-full p-2 flex-1 border-x-2 border-b-2 @error('kelurahan') border-red-500 @enderror rounded-b focus:border-pink focus:outline-none"
                                type="text" name="kelurahan" id="kelurahan" placeholder="Jimbaran"
                                disabled
                                value="{{ old('kelurahan', $kelurahan) }}">
                        </div>

                        <div class="h-4 mt-1 text-sm text-red-500 flex items-center justify-start gap-2">
                            @error('kelurahan')
                                <i class="fa-solid fa-circle-info"></i>
                                <span>{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    {{-- ALAMAT --}}
                    <div class="relative w-100 mb-4">
                        <div class="w-100">
                            <div class="w-full p-2 text-xs font-bold bg-pink @error('alamat_detail') bg-red-500 @enderror text-white flex items-center justify-start rounded-t">
                                Alamat Detail
                            </div>
                            <input class="w-full p-2 flex-1 border-x-2 border-b-2 @error('alamat_detail') border-red-500 @enderror rounded-b focus:border-pink focus:outline-none"
                                type="text" name="alamat_detail" id="alamat_detail" placeholder="Jl. Besar no. 1"
                                disabled
                                value="{{ old('alamat_detail', $alamat_detail) }}">
                        </div>

                        <div class="h-4 mt-1 text-sm text-red-500 flex items-center justify-start gap-2">
                            @error('alamat_detail')
                                <i class="fa-solid fa-circle-info"></i>
                                <span>{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            {{-- BUTTON --}}
            <div class="w-100 mt-4 flex items-center justify-end gap-4">
                <a class="w-fit p-2 font-semibold outline-none text-pink bg-white hover:bg-pink hover:text-white focus:bg-pink focus:text-white active:bg-pink-active transition-colors rounded"
                    href="{{ route('wedding-photographer.ke_profil') }}">
                    <i class="fa-solid fa-arrow-left-long"></i>
                    <span>Kembali</span>
                </a>

                <button class="w-fit px-4 py-2 rounded text-white font-semibold bg-pink hover:bg-pink-hover focus:bg-pink-hover active:bg-pink-active focus:outline-pink-hover focus:outline-offset-2 transition-colors"
                    type="submit">
                    <i class="fa-regular fa-floppy-disk"></i>
                    <span>Simpan</span>
                </button>
            </div>
        </form>
    </div>

    {{-- GENDER SCRIPT --}}
    <script>
        function showGenderOptions() {
            $('#genderOptions').removeClass('hidden').addClass('flex');
        }

        function hideGenderOptions() {
            $("#genderOptions").removeClass("flex").addClass("hidden");
        }

        function changeGenderOptions() {
            const filterValue = $("#gender").val().toLowerCase();
            $("#genderOptions button").each(function() {
                const buttonFilter = $(this).data('value').toLowerCase();
                if (buttonFilter.includes(filterValue)) {
                    $(this).removeClass('hidden');
                } else {
                    $(this).addClass('hidden');
                }
            });
        }

        function selectGender(button) {
            const dataValue = button.getAttribute('data-value');
            $('#gender').val(dataValue);
            hideGenderOptions();
        }
    </script>

    {{-- BASIS OPERASI SCRIPT --}}
    <script>
        function showBasisOperasiOptions() {
            $("#basisOperasiOptions").removeClass("hidden").addClass("flex");
        }

        function hideBasisOperasiOptions() {
            $("#basisOperasiOptions").removeClass("flex").addClass("hidden");

        }

        function changeBasisOperasiOptions() {
            const filterValue = $('#basis_operasi').val().toLowerCase();
            $('#basisOperasiOptions button').each(function() {
                const buttonFilter = $(this).data('value').toLowerCase();
                if (buttonFilter.includes(filterValue)) {
                    $(this).removeClass('hidden');
                } else {
                    $(this).addClass('hidden');
                }
            });
        }

        function selectBasisOperasi(button) {
            const dataValue = button.getAttribute('data-value');

            $('#basis_operasi').val(dataValue);
            hideBasisOperasiOptions();

            if (dataValue === 'Hanya di Dalam Kota') {
                $('#kota_operasi').prop({ disabled: false, required: true });
                $('#kotaOperasiContainer').removeClass('hidden');
            } else {
                $('#kota_operasi').prop({ disabled: true, required: false });
                $('#kotaOperasiContainer').addClass('hidden');
            }
        }
    </script>

    {{-- STATUS SCRIPT --}}
    <script>
        function showStatusOptions() {
            $("#statusOptions").removeClass("hidden").addClass("flex");

        }

        function hideStatusOptions() {
            $("#statusOptions").removeClass("flex").addClass("hidden");

        }

        function changeStatusOptions() {
            const filterValue = $('#status').val().toLowerCase();
            $('#statusOptions button').each(function() {
                const buttonFilter = $(this).data('value').toLowerCase();
                if (buttonFilter.includes(filterValue)) {
                    $(this).removeClass('hidden');
                } else {
                    $(this).addClass('hidden');
                }
            });
        }

        function selectStatus(button) {
            const dataValue = button.getAttribute('data-value');

            const formKiri = $('#formKiri');
            const formKanan = $('#formKanan');

            const genderInput = $('#gender');
            const genderContainer = $('#genderContainer');

            const provinsiInput = $('#provinsi');
            const kotaInput = $('#kota');
            const kecamatanInput = $('#kecamatan');
            const kelurahanInput = $('#kelurahan');
            const alamatDetailInput = $('#alamat_detail');

            $('#status').val(dataValue);
            hideStatusOptions();

            if (dataValue === 'Organisasi') {
                $('#provinsi').prop({ required: true, disabled: false });
                $('#kota').prop({ required: true, disabled: false });
                $('#kecamatan').prop({ required: true, disabled: false });
                $('#kelurahan').prop({ required: true, disabled: false });
                $('#alamat_detail').prop({ required: true, disabled: false });

                $('#formKiri').removeClass('w-[50%]').addClass('flex-1');
                $('#formKanan').removeClass('hidden');

                $('#gender').prop({ disabled: true, required: false });
                $('#genderContainer').addClass('hidden');
            } else {
                $('#provinsi').prop({ required: false, disabled: true });
                $('#kota').prop({ required: false, disabled: true });
                $('#kecamatan').prop({ required: false, disabled: true });
                $('#kelurahan').prop({ required: false, disabled: true });
                $('#alamat_detail').prop({ required: false, disabled: true });

                $('#formKiri').removeClass('flex-1').addClass('w-[50%]');
                $('#formKanan').addClass('hidden');

                $('#gender').prop({ disabled: false, required: true });
                $('#genderContainer').removeClass('hidden');
            }
        }
    </script>

    <script>
        window.onload = function() {
            // STATUS
            if ($('#status').val() === 'Individu') {
                $('#provinsi').prop({ required: false, disabled: true });
                $('#kota').prop({ required: false, disabled: true });
                $('#kecamatan').prop({ required: false, disabled: true });
                $('#kelurahan').prop({ required: false, disabled: true });
                $('#alamat_detail').prop({ required: false, disabled: true });

                $('#formKiri').removeClass('flex-1').addClass('w-[50%]');
                $('#formKanan').addClass('hidden');

                $('#gender').prop({ disabled: false, required: true });
                $('#genderContainer').removeClass('hidden');
                console.log('Individu');
            } else if ($('#status').val() === 'Organisasi') {
                $('#provinsi').prop({ required: true, disabled: false });
                $('#kota').prop({ required: true, disabled: false });
                $('#kecamatan').prop({ required: true, disabled: false });
                $('#kelurahan').prop({ required: true, disabled: false });
                $('#alamat_detail').prop({ required: true, disabled: false });

                $('#formKiri').removeClass('w-[50%]').addClass('flex-1');
                $('#formKanan').removeClass('hidden');

                $('#gender').prop({ disabled: true, required: false });
                $('#genderContainer').addClass('hidden');
                console.log('Not Individu');
            }

            // BASIS OPERASI
            if ($('#basis_operasi').val() === 'Hanya di Dalam Kota') {
                $('#kota_operasi').prop({ disabled: false, required: true });
                $('#kotaOperasiContainer').removeClass('hidden');
            } else {
                $('#kota_operasi').prop({ disabled: true, required: false });
                $('#kotaOperasiContainer').addClass('hidden');
            }

        }

        document.addEventListener('click', function(event) {
            const genderOptions = document.getElementById('genderOptions');
            const basisOperasiOptions = document.getElementById('basisOperasiOptions');
            const statusOptions = document.getElementById('statusOptions');

            const genderInput = document.getElementById('gender');
            const basisOperasiInput = document.getElementById('basis_operasi');
            const statusInput = document.getElementById('status');

            if (!genderOptions.classList.contains('hidden') && event.target !== genderOptions && !genderOptions.contains(event.target) && event.target !== genderInput) {
                hideGenderOptions();
            }
            if (!basisOperasiOptions.classList.contains('hidden') && event.target!== basisOperasiOptions && !basisOperasiOptions.contains(event.target) && event.target!== basisOperasiInput) {
                hideBasisOperasiOptions();
            }
            if (!statusOptions.classList.contains('hidden') && event.target!== statusOptions && !statusOptions.contains(event.target) && event.target!== statusInput) {
                hideStatusOptions();
            }
        });
    </script>
@endsection
