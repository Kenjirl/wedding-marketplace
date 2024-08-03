@extends('user.layout')

@section('title')
    <title>Buat Pernikahan | Wedding Marketplace</title>
@endsection

@php
    $currentUrl = Request::url();
@endphp

@section('content')
    <div class="w-full max-w-[1200px] mx-auto">
        {{-- BUTTONS --}}
        <div class="w-full mt-4 flex items-start justify-between">
            <a class="block w-fit px-4 py-2 font-semibold outline-none text-pink bg-white hover:bg-pink hover:text-white focus:bg-pink focus:text-white active:bg-pink-active transition-colors rounded"
                href="{{ route('user.pernikahan.index') }}">
                <i class="fa-solid fa-arrow-left-long"></i>
                <span>Kembali</span>
            </a>

            <button class="w-fit px-4 py-2 rounded text-white font-semibold bg-pink hover:bg-pink-hover focus:bg-pink-hover active:bg-pink-active focus:outline-pink-hover focus:outline-offset-2 disabled:bg-slate-400 disabled:text-white transition-colors"
                type="button" id="submitWeddingBtn"
                {{ Str::contains($currentUrl, '/acara') ? 'disabled' : '' }}>
                <i class="fa-regular fa-floppy-disk"></i>
                <span>Simpan</span>
            </button>
        </div>

        <hr class="my-2">

        @yield('part')

        {{-- ERRORS --}}
        <div class="flex-1 w-full">
            @if($errors->any())
                <div class="w-fit px-4 py-2 bg-red-400 rounded-t text-white">
                    Terdapat Kesalahan!
                </div>
                <div class="w-full px-6 py-2 border-2 border-red-400">
                    <ol class="list-disc text-sm">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ol>
                </div>
            @endif
        </div>
    </div>
@endsection

@push('child-js')
    <script>
        $(document).ready(function () {
            $('#submitWeddingBtn').on('click', function () {
                $('#weddingForm').submit();
            });

            $('#weddingForm').on('submit', function (e) {
                e.preventDefault();
                const form = document.getElementById('weddingForm');

                if (form.checkValidity()) {
                    Swal.fire({
                        title: 'Yakin ingin membuat pernikahan ini?',
                        text: "Pastikan bahwa data yang anda masukan sudah sesuai",
                        icon: "warning",
                        iconColor: "#F78CA2",
                        showCloseButton: true,
                        confirmButtonColor: "#F78CA2",
                        confirmButtonText: "Konfirmasi"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            this.submit();
                        }
                    });
                } else {
                    form.reportValidity();
                }
            });
        });
    </script>
@endpush
