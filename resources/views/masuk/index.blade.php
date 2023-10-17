@extends('main')

@section('title')
    <title>Masuk | Wedding Marketplace</title>
@endsection

@section('body')
<div class="relative w-100 flex text-sm sm:text-base">
    {{-- LEFT --}}
    <div class="hidden landscape:hidden sm:landscape:block w-1/5 sm:block lg:w-3/5 h-[100vh] bg-[url('/public/img/bg/c.jpg')] bg-center bg-no-repeat bg-cover flex-auto">
        <div class="w-100 h-[100vh] backdrop-brightness-75"></div>
    </div>

    {{-- RIGHT --}}
    <div class="w-full sm:w-4/5 lg:w-2/5 flex items-center justify-center">
        <div class="w-full h-[100vh] max-h-[1000px] py-5 sm:py-10 bg-white flex-auto flex flex-col items-center justify-between">
            <div class="w-full px-4 sm:px-0 sm:w-3/4 max-w-[400px] bg-white flex flex-col items-center justify-center">
                {{-- HEADING --}}
                <img class="w-[100px] aspect-square mb-4 rounded-full"
                    src="{{ asset('img/Logo.png') }}" alt="Wedding Marketplace Logo">
                <h2 class="font-great-vibes text-[2em] sm:text-[3em] text-pink">
                    Wedding Marketplace
                </h2>

                {{-- LOGIN FORM --}}
                <div class="w-full mt-10 font-varela">
                    {{-- ALERT --}}
                    @if (session()->has('sukses'))
                        <div class="w-100 mb-4" id="alertBoard">
                            <div class="w-100 flex">
                                <div class="w-10 aspect-square p-2 bg-blue-400 text-white flex items-center justify-center rounded-s">
                                    <i class="fa-solid fa-info-circle"></i>
                                </div>
                                <div class="w-100 p-2 flex-1 border-y-2 border-blue-400 text-sm">
                                    {{ session('sukses') }}
                                </div>
                                <button class="w-10 aspect-square p-2 bg-blue-400 hover:bg-blue-200 focus:bg-blue-200 active:bg-blue-300 focus:outline-blue-200 focus:outline-offset-2 transition-colors text-white flex items-center justify-center rounded-e"
                                    type="button" id="toggle-password-btn" onclick="toggleAlert()">
                                    <i class="fa-regular fa-circle-xmark"></i>
                                </button>
                            </div>
                        </div>
                    @endif
                    @if (session()->has('gagal'))
                        <div class="w-100 mb-4" id="alertBoard">
                            <div class="w-100 flex">
                                <div class="w-10 aspect-square p-2 bg-red-500 text-white flex items-center justify-center rounded-s">
                                    <i class="fa-solid fa-info-circle"></i>
                                </div>
                                <div class="w-100 p-2 flex-1 border-y-2 border-red-500 text-sm">
                                    {{ session('gagal') }}
                                </div>
                                <button class="w-10 aspect-square p-2 bg-red-500 hover:bg-red-300 focus:bg-red-300 active:bg-red-400 focus:outline-red-300 focus:outline-offset-2 transition-colors text-white flex items-center justify-center rounded-e"
                                    type="button" id="toggle-password-btn" onclick="toggleAlert()">
                                    <i class="fa-regular fa-circle-xmark"></i>
                                </button>
                            </div>
                        </div>
                    @endif

                    {{-- FORM --}}
                    <form action="{{ route('masuk') }}" method="post" autocomplete="off">
                        @csrf
                        {{-- EMAIL --}}
                        <div class="w-100 mb-4">
                            <div class="w-100 flex">
                                <div class="w-10 aspect-square p-2 bg-pink text-white flex items-center justify-center rounded-s">
                                    <i class="fa-solid fa-at"></i>
                                </div>
                                <input class="w-100 p-2 flex-1 border-y-2 border-white focus:border-pink focus:outline-none"
                                    type="email" name="email" id="email" placeholder="email@gmail.com" value="{{ old('email') }}" required autofocus>
                                <div class="w-10 aspect-square p-2 bg-pink text-white flex items-center justify-center rounded-e"></div>
                            </div>
                        </div>

                        {{-- PASSWORD --}}
                        <div class="w-100 mb-8">
                            <div class="w-100 flex">
                                <div class="w-10 aspect-square p-2 bg-pink text-white flex items-center justify-center rounded-s">
                                    <i class="fa-solid fa-lock"></i>
                                </div>
                                <input class="w-100 p-2 flex-1 border-y-2 border-white focus:border-pink focus:outline-none"
                                    type="password" name="password" id="password" placeholder="password" value="{{ old('password') }}" required>
                                <button class="w-10 aspect-square p-2 bg-pink hover:bg-pink-hover focus:bg-pink-hover active:bg-pink-active focus:outline-pink-hover focus:outline-offset-2 transition-colors text-white flex items-center justify-center rounded-e"
                                    type="button" id="toggle-password-btn" onclick="togglePassword()">
                                    <i class="fa-regular fa-eye"></i>
                                </button>
                            </div>
                            <div class="flex justify-between items-end mt-2">
                                <div class="flex-1">
                                    <span class="text-sm flex items-center justify-start">
                                        <input class="cursor-pointer"
                                            type="checkbox" name="remember" id="remember" value="remember">
                                        <label class="cursor-pointer pl-2" for="remember">Ingat akun saya</label>
                                    </span>
                                </div>

                                <div class="flex-1 text-end">
                                    <a class="text-pink font-semibold text-sm hover:text-pink-hover focus:text-pink-hover focus:outline-pink-hover focus:outline-offset-2 transition-colors"
                                        href="{{ route('ke_lupa_password') }}">
                                        Lupa password?
                                    </a>
                                </div>
                            </div>
                        </div>

                        {{-- LOGIN BTN --}}
                        <button class="w-full p-2 text-white font-semibold bg-pink hover:bg-pink-hover focus:bg-pink-hover active:bg-pink-active focus:outline-pink-hover focus:outline-offset-2 transition-colors rounded"
                            type="submit">Masuk</button>
                    </form>
                </div>

                {{-- LOGIN WITH GOOGLE --}}
                <div class="w-full mt-4">
                    <a class="w-full block text-center p-2 text-gray-700 font-semibold bg-gray-200 hover:bg-gray-300 focus:bg-gray-300 active:bg-gray-400 focus:outline-gray-300 focus:outline-offset-2 transition-colors rounded"
                        href="{{ route('google_login') }}">
                        <i class="fa-brands fa-google text-red-500"></i>
                        Masuk dengan Akun Google
                    </a>
                </div>
            </div>

            {{-- TO REGIST --}}
            <div>
                <span class="font-varela">
                    Belum punya akun?
                    <a class="text-pink font-semibold hover:text-pink-hover focus:text-pink-hover focus:outline-pink-hover focus:outline-offset-2 transition-colors"
                        href="{{ route('ke_daftar') }}">
                        Daftar Sekarang
                    </a>
                </span>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    function togglePassword() {
        if ($('#password').attr('type') === 'password') {
            $('#password').attr('type', 'text');
            $('#vPassword').attr('type', 'text');
            $('#toggle-password-btn').html('<i class="fa-regular fa-eye-slash"></i>');
        } else {
            $('#password').attr('type', 'password');
            $('#vPassword').attr('type', 'password');
            $('#toggle-password-btn').html('<i class="fa-regular fa-eye"></i>');
        }
    }

    function toggleAlert() {
        $('#alertBoard').addClass('hidden');
    }
</script>
@endsection
