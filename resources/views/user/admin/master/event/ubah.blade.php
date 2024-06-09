@extends('user.admin.layout')

@section('title')
    <title>Event Pernikahan | Wedding Marketplace</title>
@endsection

@section('h1', 'Event Pernikahan > Ubah')

@section('content')
    <form action="{{ route('admin.event-pernikahan.ubah', $event->id) }}" method="post">
        @csrf
        {{-- INPUT --}}
        <div class="w-1/2">
            {{-- KATEGORI --}}
            <div class="w-full mb-4">
                <div class="w-full">
                    <div class="w-full p-2 text-xs font-bold bg-pink @error('nama') bg-red-500 @enderror text-white flex items-center justify-start rounded-t">
                        Event
                    </div>
                    <input class="w-full p-2 flex-1 border-x-2 border-b-2 text-sm @error('nama') border-red-500 @enderror rounded-b focus:border-pink focus:outline-none"
                        type="text" name="nama" id="nama" placeholder="nama"
                        value="{{ old('nama', $event->nama) }}"
                        required>
                </div>

                <div class="mt-1 text-sm text-red-500 flex items-center justify-start gap-2">
                    @error('nama')
                        <i class="fa-solid fa-circle-info"></i>
                        <span>{{ $message }}</span>
                    @enderror
                </div>
            </div>

            {{-- JENIS --}}
            <div class="w-full mb-4">
                <div class="w-full">
                    <div class="w-full p-2 text-xs font-bold bg-pink @error('jenis') bg-red-500 @enderror text-white flex items-center justify-start rounded-t">
                        Jenis
                    </div>
                    <select class="w-full p-2 flex-1 border-x-2 border-b-2 text-sm @error('jenis') border-red-500 @enderror rounded-b focus:border-pink focus:outline-none"
                        name="jenis" id="jenis" required>
                        <option value="Buddha" {{ old('jenis') === 'Buddha' || $event->jenis === 'Buddha' ? 'selected' : '' }}>
                            Buddha
                        </option>
                        <option value="Hindu" {{ old('jenis') === 'Hindu' || $event->jenis === 'Hindu' ? 'selected' : '' }}>
                            Hindu
                        </option>
                        <option value="Islam" {{ old('jenis') === 'Islam' || $event->jenis === 'Islam' ? 'selected' : '' }}>
                            Islam
                        </option>
                        <option value="Katolik" {{ old('jenis') === 'Katolik' || $event->jenis === 'Katolik' ? 'selected' : '' }}>
                            Katolik
                        </option>
                        <option value="Khonghucu" {{ old('jenis') === 'Khonghucu' || $event->jenis === 'Khonghucu' ? 'selected' : '' }}>
                            Khonghucu
                        </option>
                        <option value="Protestan" {{ old('jenis') === 'Protestan' || $event->jenis === 'Protestan' ? 'selected' : '' }}>
                            Protestan
                        </option>
                    </select>
                </div>

                <div class="mt-1 text-sm text-red-500 flex items-center justify-start gap-2">
                    @error('jenis')
                        <i class="fa-solid fa-circle-info"></i>
                        <span>{{ $message }}</span>
                    @enderror
                </div>
            </div>

            {{-- KETERANGAN --}}
            <div class="w-full mb-4">
                <div class="w-full">
                    <div class="w-full p-2 text-xs font-bold bg-pink @error('keterangan') bg-red-500 @enderror text-white flex items-center justify-start rounded-t">
                        Keterangan
                    </div>
                    <textarea class="w-full p-2 flex-1 border-x-2 border-b-2 resize-none text-sm @error('keterangan') border-red-500 @enderror rounded-b focus:border-pink focus:outline-none"
                        name="keterangan" id="keterangan" rows="5" placeholder="masukkan keterangan event ini" required
                        >{{ old('keterangan', $event->keterangan) }}</textarea>
                </div>

                <div class="mt-1 text-sm text-red-500 flex items-center justify-start gap-2">
                    @error('keterangan')
                        <i class="fa-solid fa-circle-info"></i>
                        <span>{{ $message }}</span>
                    @enderror
                </div>
            </div>

            {{-- BUTTON --}}
            <div class="w-full flex items-center justify-between">
                <div class="w-full">
                    <span class="block w-fit p-2 bg-blue-500 text-white font-semibold rounded">
                        Terakhir diubah oleh : {{ $event->admin->nama }}
                        </span>
                </div>

                <div class="w-full flex items-center justify-end gap-4">
                    <a class="w-fit px-4 py-2 font-semibold outline-none text-pink bg-white hover:bg-pink hover:text-white focus:bg-pink focus:text-white active:bg-pink-active transition-colors rounded"
                        href="{{ route('admin.event-pernikahan.index') }}">
                        <i class="fa-solid fa-arrow-left-long"></i>
                        <span>Kembali</span>
                    </a>

                    <button class="w-fit px-4 py-2 rounded text-white font-semibold bg-pink hover:bg-pink-hover focus:bg-pink-hover active:bg-pink-active focus:outline-pink-hover focus:outline-offset-2 transition-colors"
                        type="submit">
                        <i class="fa-regular fa-floppy-disk"></i>
                        <span>Simpan</span>
                    </button>
                </div>
            </div>
        </div>
    </form>
@endsection
