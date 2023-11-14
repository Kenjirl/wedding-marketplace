@extends('user.wedding-couple.layout')

@section('title')
    <title>Ubah Password | Wedding Marketplace</title>
@endsection

@section('content')
    <div class="max-w-[600px] mx-auto">
        {{-- H1 --}}
        <div class="mb-4">
            <h1 class="text-[2em] font-bold">
                Profil > Ubah Password
            </h1>
        </div>

        {{-- FORM GANTI PASSWORD --}}
        <div class="w-full">
            <form class="m-0" action="{{ route('wedding-couple.profil.ubah_password') }}" method="post">
                @csrf
                {{-- PASSWORD --}}
                <div class="w-100 mb-4">
                    <div class="w-100 flex">
                        <div class="w-10 aspect-square p-2 bg-pink text-white flex items-center justify-center rounded-s">
                            <i class="fa-solid fa-lock"></i>
                        </div>
                        <input class="w-100 p-2 flex-1 border-y-2 border-white focus:border-pink focus:outline-none"
                            type="password" name="password" id="password" placeholder="password" minlength="6" onkeyup="validatePassword()" value="{{ old('password') }}" required>
                        <div class="w-10 aspect-square p-2 bg-pink text-white flex items-center justify-center rounded-e"></div>
                    </div>
                    <div class="h-4 mt-1 text-sm text-red-500 flex items-center justify-start gap-2">
                        @error('password')
                            <i class="fa-solid fa-circle-info"></i>
                            <span>{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                {{-- VALIDATE PASSWORD --}}
                <div class="w-100 mb-8">
                    <div class="w-100 flex">
                        <div class="w-10 aspect-square p-2 bg-pink text-white flex items-center justify-center rounded-s">
                            <i class="fa-solid fa-lock"></i>
                        </div>
                        <input class="w-100 p-2 flex-1 border-y-2 border-white focus:border-pink focus:outline-none"
                            type="password" name="vPassword" id="vPassword" placeholder="validasi password" minlength="6" onkeyup="validatePassword()" value="{{ old('vPassword') }}" required>
                        <button class="w-10 aspect-square p-2 bg-pink hover:bg-pink-hover focus:bg-pink-hover active:bg-pink-active focus:outline-pink-hover focus:outline-offset-2 transition-colors text-white flex items-center justify-center rounded-e"
                            type="button" id="toggle-password-btn" onclick="togglePassword()">
                            <i class="fa-regular fa-eye"></i>
                        </button>
                    </div>
                    <div class="h-4 mt-1 text-sm text-red-500 flex items-center justify-start gap-2">
                        @error('vPassword')
                            <i class="fa-solid fa-circle-info"></i>
                            <span>{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                {{-- SUBMIT BUTTON --}}
                <div class="w-100 flex items-center justify-end gap-4">
                    <a class="w-fit p-2 font-semibold outline-none text-pink bg-white hover:bg-pink hover:text-white focus:bg-pink focus:text-white active:bg-pink-active transition-colors rounded"
                        href="{{ route('wedding-couple.profil.index') }}">
                        <i class="fa-solid fa-arrow-left-long"></i>
                        <span>Kembali</span>
                    </a>

                    <button class="w-fit p-2 text-white font-semibold bg-pink hover:bg-pink-hover focus:bg-pink-hover active:bg-pink-active focus:outline-pink-hover focus:outline-offset-2 disabled:bg-gray-400 disabled:cursor-not-allowed transition-colors rounded"
                        type="submit" id="btnSubmit" disabled>
                        <i class="fa-regular fa-floppy-disk"></i>
                        <span>Simpan</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('child-js')
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
@endpush
