@extends('main')

@section('title')
    <title>Daftar | Wedding Marketplace</title>
@endsection

@section('body')
<div class="relative w-100 flex text-sm sm:text-base">
    {{-- LEFT --}}
    <div class="w-full sm:w-4/5 lg:w-2/5 max-h-screen overflow-y-auto flex items-center justify-center">
        <div class="w-full h-screen max-h-[1000px] py-5 sm:py-10 bg-white flex-auto flex flex-col items-center justify-between">
            <div class="w-full px-4 sm:px-0 sm:w-3/4 max-w-[400px] bg-white flex flex-col items-center justify-center">
                {{-- HEADING --}}
                <img class="w-[100px] aspect-square mb-4 rounded-full"
                    src="{{ asset('img/Logo.png') }}" alt="Wedding Marketplace Logo">
                <h2 class="font-great-vibes text-[2em] sm:text-[3em] text-pink">
                    Wedding Marketplace
                </h2>

                {{-- REGIS FORM --}}
                <div class="w-full mt-10 font-varela">
                    <form action="{{ route('daftar') }}" method="post" autocomplete="off">
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
                            @error('email')
                                <div class="text-sm text-red-600 flex items-center justify-start gap-2">
                                    <i class="fa-solid fa-circle-info"></i>
                                    <span>{{ $message }}</span>
                                </div>
                            @enderror
                        </div>

                        {{-- PASSWORD --}}
                        <div class="w-100 mb-4">
                            <div class="w-100 flex">
                                <div class="w-10 aspect-square p-2 bg-pink text-white flex items-center justify-center rounded-s">
                                    <i class="fa-solid fa-lock"></i>
                                </div>
                                <input class="w-100 p-2 flex-1 border-y-2 border-white focus:border-pink focus:outline-none"
                                    type="password" name="password" id="password" placeholder="password" onkeyup="validatePassword()" value="{{ old('password') }}" required>
                                <div class="w-10 aspect-square p-2 bg-pink text-white flex items-center justify-center rounded-e"></div>
                            </div>
                            @error('password')
                                <div class="text-sm text-red-600 flex items-center justify-start gap-2">
                                    <i class="fa-solid fa-circle-info"></i>
                                    <span>{{ $message }}</span>
                                </div>
                            @enderror
                        </div>

                        {{-- VALIDATE PASSWORD --}}
                        <div class="w-100 mb-8">
                            <div class="w-100 flex">
                                <div class="w-10 aspect-square p-2 bg-pink text-white flex items-center justify-center rounded-s">
                                    <i class="fa-solid fa-lock"></i>
                                </div>
                                <input class="w-100 p-2 flex-1 border-y-2 border-white focus:border-pink focus:outline-none"
                                    type="password" name="vPassword" id="vPassword" placeholder="validasi password" onkeyup="validatePassword()" value="{{ old('vPassword') }}" required>
                                <button class="w-10 aspect-square p-2 bg-pink hover:bg-pink-hover focus:bg-pink-hover active:bg-pink-active focus:outline-pink-hover focus:outline-offset-2 transition-colors text-white flex items-center justify-center rounded-e"
                                    type="button" id="toggle-password-btn" onclick="togglePassword()">
                                    <i class="fa-regular fa-eye"></i>
                                </button>
                            </div>
                            @error('vPassword')
                                <div class="text-sm text-red-600 flex items-center justify-start gap-2">
                                    <i class="fa-solid fa-circle-info"></i>
                                    <span>{{ $message }}</span>
                                </div>
                            @enderror
                        </div>

                        {{-- SUBMIT BUTTON --}}
                        <button class="w-full p-2 text-white font-semibold bg-pink hover:bg-pink-hover focus:bg-pink-hover active:bg-pink-active focus:outline-pink-hover focus:outline-offset-2 disabled:bg-gray-400 disabled:cursor-not-allowed transition-colors rounded"
                            id="btnSubmit" type="submit" disabled>Daftar</button>
                    </form>
                </div>

                {{-- REGIS WITH GOOGLE --}}
                <div class="w-full mt-4">
                    <a class="w-full block text-center p-2 text-gray-700 font-semibold bg-gray-200 hover:bg-gray-300 focus:bg-gray-300 active:bg-gray-400 focus:outline-gray-300 focus:outline-offset-2 transition-colors rounded"
                        href="{{ route('google_login') }}">
                        <i class="fa-brands fa-google text-red-500"></i>
                        Daftar dengan Akun Google
                    </a>
                </div>
            </div>

            {{-- FOOTER FOR LOGIN --}}
            <div>
                <span class="font-varela">
                    Sudah punya akun?
                    <a class="text-pink font-semibold hover:text-pink-hover focus:text-pink-hover focus:outline-pink-hover focus:outline-offset-2 transition-colors"
                        href="{{ route('ke_masuk') }}">
                        Masuk Sekarang
                    </a>
                </span>
            </div>
        </div>
    </div>

    {{-- RIGHT --}}
    <div class="hidden landscape:hidden sm:landscape:block w-1/5 sm:block lg:w-3/5 h-[100vh] bg-[url('/public/img/bg/b.jpg')] bg-right bg-no-repeat bg-cover flex-auto">
        <div class="w-100 h-[100vh] backdrop-brightness-75"></div>
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

        function validatePassword() {
            if ($('#password').val() === $('#vPassword').val() && $('#password').val() !== '' && $('#vPassword').val() !== '') {
                $('#btnSubmit').removeAttr('disabled');
            } else {
                $('#btnSubmit').attr('disabled', 'disabled');
            }
        }
</script>
@endsection
