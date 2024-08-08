@extends('main')

@section('title')
    <title>Pilih Peran | Wedding Marketplace</title>
@endsection

@section('body')
    <div class="w-full h-screen py-5 sm:py-10 bg-white flex flex-col items-center justify-between">
        <div class="w-full max-w-[1000px] mx-auto px-4 bg-white flex flex-col items-center justify-center font-varela">
            {{-- HEADING --}}
            <img class="w-[100px] aspect-square rounded-full"
                src="{{ asset('img/Logo.png') }}" alt="Wedding Marketplace Logo">
            <h2 class="font-extrabold text-[1.5em] sm:text-[3em] text-pink">
                Pilih Peran Anda
            </h2>
            <span class="text-[.9em] text-center">
                Apa yang ingin anda cari pada marketplace ini?
            </span>

            {{-- ROLE FORM --}}
            <div class="w-full mb-5">
                {{-- FORM --}}
                <form action="{{ route('pilih_peran') }}" method="post">
                    @csrf
                    <input type="hidden" id="role" name="role" value="">

                    <div class="w-full flex items-start justify-center gap-4 p-4">
                        {{-- BRIDE --}}
                        <div class="flex-1 w-full text-center">
                            <div class="w-full mb-4 text-center">
                                <h3 class="text-lg text-pink font-semibold">
                                    Sebagai Pasangan Pernikahan
                                </h3>
                            </div>
                            {{-- BRIDES ROLE BTN --}}
                            <button class="w-[300px] aspect-video p-2 rounded-md border-pink border-2 outline-2 outline-offset-4 text-pink hover:bg-pink hover:text-white focus:bg-pink focus:text-white active:bg-pink-active active:border-pink-active active:text-white focus:outline-pink transition-all"
                                id="user" type="button" onclick="selectRole('user')">
                                <i class="fa-solid fa-dove text-[3em]"></i>
                                <p class="font-semibold">Pasangan Pernikahan</p>
                            </button>
                        </div>

                        {{-- VENDOR --}}
                        <div class="flex-1 w-full text-center">
                            <div class="w-full mb-4 text-center">
                                <h3 class="text-lg text-pink font-semibold">
                                    Sebagai Vendor Pernikahan
                                </h3>
                            </div>
                            {{-- VENDOR ROLE BTN --}}
                            <button class="w-[300px] aspect-video p-2 rounded-md border-pink border-2 outline-2 outline-offset-4 text-pink hover:bg-pink hover:text-white focus:bg-pink focus:text-white active:bg-pink-active active:border-pink-active active:text-white focus:outline-pink transition-all"
                                id="vendor" type="button" onclick="selectRole('vendor')">
                                <i class="fa-solid fa-user-tie text-[3em]"></i>
                                <p class="font-semibold">Vendor Pernikahan</p>
                            </button>
                        </div>
                    </div>

                    <div id="keterangan" class="w-2/3 px-4 mx-auto mb-4 text-[.8em] text-center"></div>

                    {{-- SUBMIT BTN --}}
                    <div class="w-full text-center">
                        <button class="w-full max-w-[400px] p-2 text-white font-semibold bg-pink hover:bg-pink-hover focus:bg-pink-hover active:bg-pink-active focus:outline-pink-hover focus:outline-offset-2 disabled:bg-gray-400 disabled:cursor-not-allowed transition-all rounded"
                            id="btnSubmit" type="submit" disabled>Konfirmasi</button>
                    </div>
                </form>

                <form class="w-full mx-auto" action="{{ route('keluar') }}" method="post" id="logoutForm">
                    @csrf
                    <div class="w-full mt-2 flex items-center justify-center">
                        <button class="w-[400px] mx-auto p-2 text-pink font-semibold border border-pink outline-pink hover:bg-pink hover:text-white focus:bg-pink focus-within:text-white active:bg-pink-active focus:outline-pink-hover focus:outline-offset-2 disabled:bg-gray-400 disabled:cursor-not-allowed transition-all rounded"
                            id="logoutBtn" type="button">Logout</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('child-js')
    <script>
        function selectRole(role) {
            $("button:not(#btnSubmit)").removeClass("bg-pink text-white").addClass("text-pink");
            $('#' + role).addClass("bg-pink text-white");

            $('#role').val(role);
            $('#btnSubmit').prop('disabled', role === '');

            if (role === 'user') {
                $('#keterangan').html(`
                    Sebagai <b class="text-pink">Pasangan Pernikahan</b>,
                    anda dapat mencari <b>Vendor Pernikahan</b>, membuat dan mengatur undangan, serta mengelola tamu undangan untuk pernikahan anda.
                `);
            } else {
                $('#keterangan').html(`
                    Sebagai <b class="text-pink">Vendor Pernikahan</b>,
                    anda dapat menambahkan portofolio dan menawarkan berbagai macam layanan yang ingin Anda tawarkan kepada <b>Pasangan Pernikahan</b>.
                `);
            }
        }

        $('#logoutBtn').on("click", function () {
            Swal.fire({
                title: "Yakin ingin keluar?",
                showCloseButton: true,
                confirmButtonColor: "#F78CA2",
                confirmButtonText: "Konfirmasi"
            }).then((result) => {
                if (result.isConfirmed) {
                    $("#logoutForm").submit();
                }
            });
        });
    </script>
@endpush
