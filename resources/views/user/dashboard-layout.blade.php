@extends('main')

@section('body')
    <div class="w-100 h-screen overflow-y-hidden p-4 bg-slate-900 flex gap-4">
        <div class="h-[calc(100vh-32px)] bg-red-500 rounded-lg p-4">
            <div class="w-full flex items-center justify-center pb-4">
                <img class="w-[100px] aspect-square rounded-full bg-slate-50"
                    src="{{ asset('img/Logo.png') }}" alt="Wedding Marketplace Logo">
            </div>

            <div class="w-[250px] flex flex-col items-start justify-center gap-4">
                @yield('sidebar')

                <form class="w-full" action="{{ route('keluar') }}" method="post">
                    @csrf
                    <button class="w-full bg-slate-50 p-2 rounded text-start"
                        type="submit">
                        <i class="fa-solid fa-house"></i>
                        Keluar
                    </button>
                </form>
            </div>
        </div>

        <div class="w-100 bg-blue-700 flex-1 rounded-lg p-4">
            <div class="relative w-full bg-slate-50 p-2 flex items-center justify-end">
                <button class="flex items-center justify-center gap-4 px-4"
                    type="button" onclick="openProfile()">
                    @if (auth()->user()->name)
                        <span>{{ auth()->user()->name }}</span>
                    @else
                        <span>User</span>
                    @endif

                    @if (auth()->user()->profile)
                        <img class="w-[40px] aspect-square rounded-full"
                            src="{{ asset('img/Logo.png') }}" alt="">
                    @elseif(!auth()->user()->name)
                        <span class="w-[40px] aspect-square bg-slate-500 rounded-full flex items-center justify-center text-[1.25em]">
                            U
                        </span>
                    @else
                        <span class="w-[40px] aspect-square bg-slate-500 rounded-full flex items-center justify-center text-[1.25em]">
                            {{ substr(auth()->user()->name, 0, 1) }}
                        </span>
                    @endif
                </button>

                <div class="absolute bottom-[-5em] right-0 w-[150px] bg-slate-300 p-2 rounded hidden flex-col items-center justify-center"
                    id="profileLayout">
                    <a class="w-full"
                        href="#">
                        <i class="fa-solid fa-house"></i>
                        Dashboard
                    </a>

                    <div class="w-full h-[2px] bg-white my-1"></div>

                    <form class="w-full" action="{{ route('keluar') }}" method="post">
                        @csrf
                        <button class="w-full text-start"
                            type="submit">
                            <i class="fa-solid fa-house"></i>
                            Keluar
                        </button>
                    </form>
                </div>
            </div>

            <div class="mt-4">
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
