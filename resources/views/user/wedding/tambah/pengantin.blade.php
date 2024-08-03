@extends('user.wedding.tambah.index')

@section('part')
    <form action="{{ route('user.pernikahan.tambah') }}" method="post" id="weddingForm">
        @csrf
        <div class="flex-1 w-full flex items-start justify-center gap-16">
            {{-- GROOM FAMILY --}}
            <div class="w-full">
                <div class="w-full mb-4">
                    <p class="w-full text-center text-lg font-semibold">
                        <i class="fa-solid fa-mars text-blue-500"></i>
                        Pengantin Pria
                    </p>
                </div>
                {{-- GROOM --}}
                <div class="w-full mb-4">
                    <div class="w-100">
                        <div class="w-full p-2 text-xs font-bold bg-pink @error('p_lengkap') bg-red-400 @enderror text-white flex items-center justify-start rounded-t">
                            Nama Lengkap
                        </div>
                        <input class="w-full p-2 flex-1 border-x-2 border-b-2 text-sm @error('p_lengkap') border-red-400 @enderror rounded-b focus:border-pink focus:outline-none"
                            type="text" name="p_lengkap" id="p_lengkap" placeholder="Nama Lengkap (tanpa gelar)"
                            required
                            value="{{ old('p_lengkap', '') }}">
                    </div>

                    <div class="mt-1 text-sm text-red-400 flex items-center justify-start gap-2">
                        @error('p_lengkap')
                            <i class="fa-solid fa-circle-info"></i>
                            <span>{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="w-full mb-4">
                    <div class="w-100">
                        <div class="w-full p-2 text-xs font-bold bg-pink @error('p_sapaan') bg-red-400 @enderror text-white flex items-center justify-start rounded-t">
                            Nama Sapaan
                        </div>
                        <input class="w-full p-2 flex-1 border-x-2 border-b-2 text-sm @error('p_sapaan') border-red-400 @enderror rounded-b focus:border-pink focus:outline-none"
                            type="text" name="p_sapaan" id="p_sapaan" placeholder="Nama Sapaan"
                            required
                            value="{{ old('p_sapaan', '') }}">
                    </div>

                    <div class="mt-1 text-sm text-red-400 flex items-center justify-start gap-2">
                        @error('p_sapaan')
                            <i class="fa-solid fa-circle-info"></i>
                            <span>{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                {{-- PARENT --}}
                <div class="w-full flex items-center justify-center gap-4">
                    <div class="w-full mb-4">
                        <div class="w-100">
                            <div class="w-full p-2 text-xs font-bold bg-pink @error('p_ayah') bg-red-400 @enderror text-white flex items-center justify-start rounded-t">
                                Nama Ayah
                            </div>
                            <input class="w-full p-2 flex-1 border-x-2 border-b-2 text-sm @error('p_ayah') border-red-400 @enderror rounded-b focus:border-pink focus:outline-none"
                                type="text" name="p_ayah" id="p_ayah" placeholder="Nama Ayah (tanpa gelar)"
                                required
                                value="{{ old('p_ayah', '') }}">
                        </div>

                        <div class="mt-1 text-sm text-red-400 flex items-center justify-start gap-2">
                            @error('p_ayah')
                                <i class="fa-solid fa-circle-info"></i>
                                <span>{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="w-full mb-4">
                        <div class="w-100">
                            <div class="w-full p-2 text-xs font-bold bg-pink @error('p_ibu') bg-red-400 @enderror text-white flex items-center justify-start rounded-t">
                                Nama Ibu
                            </div>
                            <input class="w-full p-2 flex-1 border-x-2 border-b-2 text-sm @error('p_ibu') border-red-400 @enderror rounded-b focus:border-pink focus:outline-none"
                                type="text" name="p_ibu" id="p_ibu" placeholder="Nama Ibu (tanpa gelar)"
                                required
                                value="{{ old('p_ibu', '') }}">
                        </div>

                        <div class="mt-1 text-sm text-red-400 flex items-center justify-start gap-2">
                            @error('p_ibu')
                                <i class="fa-solid fa-circle-info"></i>
                                <span>{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            {{-- BRIDE FAMILY --}}
            <div class="w-full">
                <div class="w-full mb-4">
                    <p class="w-full text-center text-lg font-semibold">
                        <i class="fa-solid fa-venus text-pink"></i>
                        Pengantin Wanita
                    </p>
                </div>
                {{-- BRIDE --}}
                <div class="w-full mb-4">
                    <div class="w-100">
                        <div class="w-full p-2 text-xs font-bold bg-pink @error('w_lengkap') bg-red-400 @enderror text-white flex items-center justify-start rounded-t">
                            Nama Lengkap
                        </div>
                        <input class="w-full p-2 flex-1 border-x-2 border-b-2 text-sm @error('w_lengkap') border-red-400 @enderror rounded-b focus:border-pink focus:outline-none"
                            type="text" name="w_lengkap" id="w_lengkap" placeholder="Nama Lengkap (tanpa gelar)"
                            required
                            value="{{ old('w_lengkap', '') }}">
                    </div>

                    <div class="mt-1 text-sm text-red-400 flex items-center justify-start gap-2">
                        @error('w_lengkap')
                            <i class="fa-solid fa-circle-info"></i>
                            <span>{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="w-full mb-4">
                    <div class="w-100">
                        <div class="w-full p-2 text-xs font-bold bg-pink @error('w_sapaan') bg-red-400 @enderror text-white flex items-center justify-start rounded-t">
                            Nama Sapaan
                        </div>
                        <input class="w-full p-2 flex-1 border-x-2 border-b-2 text-sm @error('w_sapaan') border-red-400 @enderror rounded-b focus:border-pink focus:outline-none"
                            type="text" name="w_sapaan" id="w_sapaan" placeholder="Nama Sapaan"
                            required
                            value="{{ old('w_sapaan', '') }}">
                    </div>

                    <div class="mt-1 text-sm text-red-400 flex items-center justify-start gap-2">
                        @error('w_sapaan')
                            <i class="fa-solid fa-circle-info"></i>
                            <span>{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                {{-- PARENT --}}
                <div class="w-full flex items-center justify-center gap-4">
                    <div class="w-full mb-4">
                        <div class="w-100">
                            <div class="w-full p-2 text-xs font-bold bg-pink @error('w_ayah') bg-red-400 @enderror text-white flex items-center justify-start rounded-t">
                                Nama Ayah
                            </div>
                            <input class="w-full p-2 flex-1 border-x-2 border-b-2 text-sm @error('w_ayah') border-red-400 @enderror rounded-b focus:border-pink focus:outline-none"
                                type="text" name="w_ayah" id="w_ayah" placeholder="Nama Ayah (tanpa gelar)"
                                required
                                value="{{ old('w_ayah', '') }}">
                        </div>

                        <div class="mt-1 text-sm text-red-400 flex items-center justify-start gap-2">
                            @error('w_ayah')
                                <i class="fa-solid fa-circle-info"></i>
                                <span>{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="w-full mb-4">
                        <div class="w-100">
                            <div class="w-full p-2 text-xs font-bold bg-pink @error('w_ibu') bg-red-400 @enderror text-white flex items-center justify-start rounded-t">
                                Nama Ibu
                            </div>
                            <input class="w-full p-2 flex-1 border-x-2 border-b-2 text-sm @error('w_ibu') border-red-400 @enderror rounded-b focus:border-pink focus:outline-none"
                                type="text" name="w_ibu" id="w_ibu" placeholder="Nama Ibu (tanpa gelar)"
                                required
                                value="{{ old('w_ibu', '') }}">
                        </div>

                        <div class="mt-1 text-sm text-red-400 flex items-center justify-start gap-2">
                            @error('w_ibu')
                                <i class="fa-solid fa-circle-info"></i>
                                <span>{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
