@extends('main')

@section('title')
    <title>Lupa Password | Wedding Marketplace</title>
@endsection

@section('body')
    <div class="w-full h-[100vh] max-h-[1000px] py-5 sm:py-10 bg-white flex flex-col items-center justify-between">
        <div class="w-full px-4 sm:px-0 sm:w-3/4 max-w-[400px] bg-white flex flex-col items-center justify-center">
            {{-- HEADING --}}
            <img class="w-[100px] aspect-square mb-4 rounded-full"
                src="{{ asset('img/Logo.png') }}" alt="Wedding Marketplace Logo">
            <h2 class="font-great-vibes text-[2em] sm:text-[3em] text-pink">
                Wedding Marketplace
            </h2>

            {{-- LOGIN FORM --}}
            <div class="w-full mt-10 font-varela">
                {{-- MESSAGE --}}
                <div class="w-100 mb-4">
                    <div class="w-100 flex">
                        <div class="w-10 aspect-square p-2 bg-blue-400 text-white flex items-center justify-center rounded-s">
                            <i class="fa-solid fa-info-circle"></i>
                        </div>
                        <div class="w-100 p-2 flex-1 border-y-2 border-blue-400 text-sm">
                            Pesan verifikasi untuk mengganti password akan dikirimkan pada alamat email yang anda cantumkan di bawah ini.
                        </div>
                        <div class="w-10 aspect-square p-2 bg-blue-400 text-white flex items-center justify-center rounded-e"></div>
                    </div>
                </div>

                {{-- FORM --}}
                <form action="{{ route('lupa_password') }}" method="post">
                    @csrf
                    {{-- EMAIL --}}
                    <div class="w-100 mb-4">
                        <div class="w-100 flex">
                            <div class="w-10 aspect-square p-2 bg-pink text-white flex items-center justify-center rounded-s">
                                <i class="fa-solid fa-at"></i>
                            </div>
                            <input class="w-100 p-2 flex-1 border-y-2 border-white focus:border-pink outline-none"
                                type="email" name="email" id="email" placeholder="email@gmail.com" value="{{ old('email') }}" required autofocus>
                            <div class="w-10 aspect-square p-2 bg-pink text-white flex items-center justify-center rounded-e"></div>
                        </div>
                        @if (session()->has('gagal'))
                            <div class="text-sm text-red-600 flex items-center justify-start gap-2">
                                <i class="fa-solid fa-circle-info"></i>
                                <span>{{ session('gagal') }}</span>
                            </div>
                        @endif
                    </div>

                    {{-- LOGIN BTN --}}
                    <button class="w-full p-2 text-white font-semibold bg-pink hover:bg-pink-hover focus:bg-pink-hover active:bg-pink-active outline-pink-hover outline-offset-4 transition-colors rounded"
                        type="submit">Kirim Email</button>
                </form>
            </div>
        </div>
    </div>
@endsection
