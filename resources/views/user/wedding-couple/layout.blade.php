@extends('main')

@section('body')
    <div class="w-full font-quicksand text-slate-600">
        {{-- NAVBAR --}}
        <div class="w-full px-4 py-2 flex items-center justify-between gap-4 bg-white shadow hover:shadow-md transition-shadow">
            {{-- LOGO --}}
            <div class="w-fit flex items-center justify-center">
                <img class="w-[50px] aspect-square rounded-full"
                    src="{{ asset('img/Logo.png') }}" alt="Wedding Marketplace Logo">
            </div>

            {{-- MENU --}}
            <div class="flex-1 w-full flex items-center justify-start gap-4 text-sm">
                @include('user.wedding-couple.menu')
            </div>

            {{-- TOMBOL PROFIL --}}
            <div class="relative w-fit">
                <button class="flex items-center justify-center gap-4 px-4 py-2 hover:bg-slate-200 focus:outline-none focus:bg-slate-200 active:bg-slate-400 transition-colors rounded-md"
                    type="button" onclick="openProfile()">
                    <span>{{ auth()->user()->name }}</span>

                    @if (auth()->user()->w_couple && auth()->user()->w_couple->foto_profil)
                        <img class="w-[40px] aspect-square object-cover object-center rounded-full"
                            src="{{ asset(auth()->user()->w_couple->foto_profil) }}" alt="Foto Profil">
                    @else
                        <span class="w-[40px] aspect-square bg-pink rounded-full flex items-center justify-center text-[1.25em] font-bold text-white">
                            {{ substr(auth()->user()->name, 0, 1) }}
                        </span>
                    @endif
                </button>

                <div class="absolute bottom-[calc(-5em+3px-2rem)] right-0 w-full bg-white border-4 border-slate-200 rounded hidden flex-col items-center justify-center animate__animated animate__flipInX z-50"
                    id="profileLayout">
                    <a class="w-full p-2 bg-white hover:bg-pink hover:text-white focus:outline-none focus:bg-pink focus:text-white active:bg-pink-active transition-colors"
                        href="{{ route('wedding-couple.profil.index') }}">
                        <i class="fa-regular fa-user"></i>
                        Profil
                    </a>

                    <div class="w-full h-[2px] bg-slate-200"></div>

                    <form class="w-full" action="{{ route('keluar') }}" method="post">
                        @csrf
                        <button class="w-full text-start p-2 hover:bg-pink hover:text-white focus:outline-none focus:bg-pink focus:text-white active:bg-pink-active transition-colors"
                            type="submit">
                            <i class="fa-solid fa-arrow-right-from-bracket"></i>
                            Keluar
                        </button>
                    </form>
                </div>
            </div>
        </div>

        {{-- CONTENT --}}
        <div class="w-full min-h-screen p-4">
            @yield('content')
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
    </script>
@endpush
