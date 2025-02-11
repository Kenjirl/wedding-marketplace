@extends('main')

@section('body')
    <div class="w-full max-w-[1600px] mx-auto font-quicksand text-slate-600">
        {{-- NAVBAR --}}
        <div class="w-full px-4 py-2 flex items-center justify-between gap-4 bg-white shadow hover:shadow-md transition-shadow">
            {{-- MENU --}}
            <div class="w-1/3 flex items-center justify-start gap-4 text-sm">
                @include('user.menu')
            </div>

            {{-- LOGO --}}
            <div class="w-1/3 flex items-center justify-center">
                <img class="w-[50px] rounded-full"
                    src="{{ asset('img/Logo.png') }}" alt="Wedding Marketplace Logo">
            </div>

            {{-- TOMBOL PROFIL --}}
            <div class="relative w-1/3 flex items-center justify-end">
                @if (auth()->user() && auth()->user()->w_couple)
                    <button class="flex items-center justify-center gap-2 px-4 py-2 hover:bg-slate-200 outline-pink outline-offset-4 focus:bg-slate-200 active:bg-slate-400 transition-colors rounded-md"
                        type="button" onclick="openProfile()">
                        <span>{{ auth()->user()->name }}</span>

                        @if (auth()->user()->w_couple && auth()->user()->w_couple->foto_profil)
                            <img class="w-[30px] aspect-square object-cover object-center rounded-full"
                                src="{{ asset(auth()->user()->w_couple->foto_profil) }}" alt="Foto Profil">
                        @else
                            <span class="w-[30px] aspect-square bg-pink rounded-full flex items-center justify-center font-bold text-white">
                                {{ ucwords(substr(auth()->user()->name, 0, 1)) }}
                            </span>
                        @endif
                    </button>

                    <div class="absolute bottom-[calc(-5em+3px-2rem)] right-0 w-full max-w-[200px] bg-white border-4 border-slate-200 rounded hidden flex-col items-center justify-center animate__animated animate__flipInX z-50"
                        id="profileLayout">
                        <a class="w-full p-2 bg-white hover:bg-pink hover:text-white outline-pink outline-offset-4 focus:bg-pink focus:text-white active:bg-pink-active transition-colors"
                            href="{{ route('user.profil.index') }}">
                            <i class="fa-regular fa-user"></i>
                            Profil
                        </a>

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
                @else
                    @guest
                    <a class="w-fit px-4 py-2  outline-pink outline-offset-4 rounded hover:bg-pink hover:text-white focus:bg-pink focus:text-white active:bg-pink-active transition-colors"
                        href="{{ route('ke_masuk') }}">
                        Masuk
                    </a>
                    @endguest
                    @auth
                        <form action="{{ route('keluar') }}" method="post" id="logoutForm">
                            @csrf
                            <div class="w-fit flex items-center justify-center">
                                <button class="w-fit mx-auto px-2 py-1 text-pink font-semibold border border-pink outline-pink hover:bg-pink hover:text-white focus:bg-pink focus-within:text-white active:bg-pink-active focus:outline-pink-hover focus:outline-offset-2 disabled:bg-gray-400 disabled:cursor-not-allowed transition-all rounded"
                                    id="logoutBtn" type="button">Logout</button>
                            </div>
                        </form>
                    @endauth
                @endif
            </div>
        </div>

        {{-- CONTENT --}}
        <div class="w-full min-h-screen">
            @yield('content')
        </div>

        {{-- FOOTER --}}
        <div class="w-full bg-pink text-white">
            <div class="w-full mx-auto py-10">
                <div class="w-full mb-10 flex items-center justify-center gap-10">
                    <div class="w-full font-great-vibes text-5xl text-end">
                        Wedding
                    </div>
                    <div class="flex-shrink-0 w-fit">
                        <img class="w-[100px] aspect-square rounded-full bg-white"
                            src="{{ asset('img/Logo.png') }}" alt="Logo">
                    </div>
                    <div class="w-full font-great-vibes text-5xl text-start">
                        Marketplace
                    </div>
                </div>

                <div class="w-full flex items-center justify-center text-base">
                    <div class="w-full flex items-center justify-center gap-2">
                        <div class="w-[30px] aspect-square flex items-center justify-center bg-white rounded text-pink">
                            <i class="fa-brands fa-whatsapp"></i>
                        </div>
                        <div>
                            <a class="outline-white outline-offset-2 hover:underline"
                                href="https://wa.me/6281246007474" target="_blank" rel="noopener noreferrer">
                                (+62) 081246007474
                            </a>
                        </div>
                    </div>
                    <div class="w-full flex items-center justify-center gap-2">
                        <div class="w-[30px] aspect-square flex items-center justify-center bg-white rounded text-pink">
                            <i class="fa-regular fa-envelope"></i>
                        </div>
                        <div>
                            <a class="outline-white outline-offset-2 hover:underline"
                                href="mailto:taweddingmarketplace@gmail.com" target="_blank" rel="noopener noreferrer">
                                taweddingmarketplace@gmail.com
                            </a>
                        </div>
                    </div>
                    <div class="w-full flex items-center justify-center gap-2">
                        <div class="w-[30px] aspect-square flex items-center justify-center bg-white rounded text-pink">
                            <i class="fa-solid fa-location-dot"></i>
                        </div>
                        <div id="location_map"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="w-full">
            <div class="w-full max-w-[1200px] mx-auto py-2">
                <span class="text-xs">
                    @2023 Wedding Marketplace
                </span>
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

        $(document).ready(function() {
            let location_text = 'Jl. Puri Gading blok F2/no.5, Jimbaran, Badung, Bali';
            let location_tag = `
                <a class="outline-white outline-offset-2 hover:underline"
                    href="http://maps.google.com/maps?q=${encodeURIComponent(location_text)}" target="_blank">
                    ${location_text}
                </a>
            `;
            $('#location_map').html(location_tag);
        });
    </script>
@endpush
