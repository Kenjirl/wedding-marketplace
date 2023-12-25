@extends('main')

@section('body')
    <div class="w-100 h-screen overflow-y-hidden p-4 flex gap-4 font-quicksand bg-slate-200 text-slate-600">
        {{-- SIDEBAR --}}
        <div class="h-[calc(100vh-32px)] rounded-lg p-4 bg-white">
            {{-- LOGO --}}
            <div class="w-full flex items-center justify-center pb-4">
                <img class="w-[100px] aspect-square rounded-full"
                    src="{{ asset('img/Logo.png') }}" alt="Wedding Marketplace Logo">
            </div>

            {{-- MENU --}}
            <div class="w-[250px] flex flex-col items-start justify-center gap-4">
                @yield('menu')
            </div>
        </div>

        <div class="relative w-100 flex-1 rounded-lg bg-white">

            {{-- HEADER --}}
            <div class="w-full p-2 flex items-center justify-between border-b-4 border-b-slate-200">
                {{-- JUDUL --}}
                <div class="px-4">
                    <h1 class="text-[2em] font-bold">
                        @yield('h1')
                    </h1>
                </div>

                {{-- TOMBOL PROFIL --}}
                <div class="relative w-fit">
                    <button class="flex items-center justify-center gap-4 px-4 py-2 hover:bg-slate-200 outline-pink outline-offset-4 focus:bg-slate-200 active:bg-slate-400 transition-colors rounded-md"
                        type="button" onclick="openProfile()">
                        <span>{{ auth()->user()->name }}</span>

                        @yield('tombol-profil')
                    </button>

                    <div class="absolute bottom-[calc(-5em+3px-2rem)] right-0 w-[200px] bg-white border-4 border-slate-200 rounded hidden flex-col items-center justify-center animate__animated animate__flipInX z-50"
                        id="profileLayout">
                        @yield('profil')

                        <div class="w-full h-[2px] bg-slate-200"></div>

                        <form class="w-full" action="{{ route('keluar') }}" method="post" id="logoutForm">
                            @csrf
                            <button class="w-full text-start p-2 hover:bg-pink hover:text-white outline-pink outline-offset-4 focus:bg-pink focus:text-white active:bg-pink-active transition-colors"
                                type="button" id="logoutBtn">
                                <i class="fa-solid fa-arrow-right-from-bracket"></i>
                                Keluar
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="max-h-[calc(100vh-14%)] p-4 bg-white rounded-lg overflow-y-auto">
                @yield('content')
            </div>
        </div>
    </div>
@endsection

@push('child-js')
    <script>
        function openProfile() {
            if ($('#profileLayout').hasClass("hidden")) {
                $('#profileLayout').removeClass("hidden").addClass("flex");
            } else {
                $('#profileLayout').removeClass("flex").addClass("hidden");
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
