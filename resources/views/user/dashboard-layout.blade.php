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

        <div class="w-100 flex-1 rounded-lg bg-white">

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
                    <button class="flex items-center justify-center gap-4 px-4 py-2 hover:bg-slate-200 focus:outline-none focus:bg-slate-200 active:bg-slate-400 transition-colors rounded-md"
                        type="button" onclick="openProfile()">
                        @if (auth()->user()->name)
                            <span>{{ auth()->user()->name }}</span>
                        @else
                            <span>User</span>
                        @endif

                        @if (auth()->user()->w_photographer)
                            @if (auth()->user()->w_photographer->foto_profil)
                                <img class="w-[40px] aspect-square object-cover object-center rounded-full"
                                    src="{{ asset('img/Foto Profil.jpg') }}" alt="">
                            @elseif(!auth()->user()->name)
                                <span class="w-[40px] aspect-square bg-pink rounded-full flex items-center justify-center text-[1.25em] font-bold text-white">
                                    U
                                </span>
                            @else
                                <span class="w-[40px] aspect-square bg-pink rounded-full flex items-center justify-center text-[1.25em] font-bold text-white">
                                    {{ substr(auth()->user()->name, 0, 1) }}
                                </span>
                            @endif
                        @elseif(!auth()->user()->name)
                            <span class="w-[40px] aspect-square bg-pink rounded-full flex items-center justify-center text-[1.25em] font-bold text-white">
                                U
                            </span>
                        @else
                            <span class="w-[40px] aspect-square bg-pink rounded-full flex items-center justify-center text-[1.25em] font-bold text-white">
                                {{ substr(auth()->user()->name, 0, 1) }}
                            </span>
                        @endif
                    </button>

                    <div class="absolute bottom-[calc(-5em+3px-2rem)] right-0 w-full bg-white border-4 border-slate-200 rounded hidden flex-col items-center justify-center animate__animated animate__flipInX z-50"
                        id="profileLayout">
                        @yield('profil')

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

            <div class=" max-h-[calc(100vh-14%)] p-4 bg-white rounded-lg overflow-y-auto">
                @yield('content')
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        function openProfile() {
            const profileLayout = document.getElementById('profileLayout');

            if (profileLayout.classList.contains("hidden")) {
                profileLayout.classList.remove("hidden");
                profileLayout.classList.add("flex");
            } else {
                profileLayout.classList.remove("flex");
                profileLayout.classList.add("hidden");
            }
        }
    </script>
@endsection
