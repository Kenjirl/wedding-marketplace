@extends('user.dashboard-layout')

@section('menu')
    @include('admin.menu')
@endsection

@section('tombol-profil')
    <span class="w-[40px] aspect-square bg-pink rounded-full flex items-center justify-center text-[1.25em] font-bold text-white">
        {{ substr(auth()->user()->name, 0, 1) }}
    </span>
@endsection

@section('profil')
    <a class="w-full p-2 bg-white hover:bg-pink hover:text-white outline-none focus:bg-pink focus:text-white active:bg-pink-active transition-colors"
        href="{{ route('admin.profil.index') }}">
        <i class="fa-regular fa-user"></i>
        Profil
    </a>
@endsection

@push('child-js')
    <script>
        $(document).ready(function () {
            $("#masterMenuBtn").on("click", function () {
                let isOpen = $(this).data("open");

                if (isOpen === "true") {
                    $(this).data("open", "false");
                    $("#masterMenuContainer").removeClass("grid").addClass("hidden");
                } else {
                    $(this).data("open", "true");
                    $("#masterMenuContainer").addClass("grid").removeClass("hidden");
                }
            });

            $("#portofolioMenuBtn").on("click", function () {
                let isOpen = $(this).data("open");

                if (isOpen === "true") {
                    $(this).data("open", "false");
                    $("#portofolioMenuContainer").removeClass("grid").addClass("hidden");
                } else {
                    $(this).data("open", "true");
                    $("#portofolioMenuContainer").addClass("grid").removeClass("hidden");
                }
            });
        });
    </script>
@endpush
