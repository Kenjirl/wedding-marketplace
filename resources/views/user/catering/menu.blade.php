@php
$currentUrl = Request::url();
@endphp

<a class="w-full p-2 rounded {{ Str::endsWith($currentUrl, '/catering') ? 'bg-pink text-white' : '' }} hover:bg-pink hover:text-white focus:outline-none focus:bg-pink focus:text-white active:bg-pink-active transition-colors"
    href="{{ route('catering.index') }}">
    <i class="fa-solid fa-house"></i>
    Dashboard
</a>

@if (auth()->user()->w_vendor)
    <a class="w-full p-2 rounded hover:bg-pink hover:text-white focus:outline-none focus:bg-pink focus:text-white active:bg-pink-active transition-colors
        {{ Str::contains($currentUrl, '/portofolio') ? 'bg-pink text-white' : '' }}"
        href="{{ route('catering.portofolio.index') }}">
        <i class="fa-solid fa-grip"></i>
        Portofolio
    </a>
    <a class="w-full p-2 rounded hover:bg-pink hover:text-white focus:outline-none focus:bg-pink focus:text-white active:bg-pink-active transition-colors
        {{ Str::contains($currentUrl, '/layanan') ? 'bg-pink text-white' : '' }}"
        href="{{ route('catering.layanan.index') }}">
        <i class="fa-solid fa-gift"></i>
        Layanan
    </a>
    <a class="w-full p-2 rounded hover:bg-pink hover:text-white focus:outline-none focus:bg-pink focus:text-white active:bg-pink-active transition-colors
        {{ Str::contains($currentUrl, '/pesanan') ? 'bg-pink text-white' : '' }}"
        href="{{ route('catering.pesanan.index') }}">
        <i class="fa-solid fa-grip-vertical"></i>
        Pesanan
    </a>
    <a class="w-full p-2 rounded hover:bg-pink hover:text-white focus:outline-none focus:bg-pink focus:text-white active:bg-pink-active transition-colors
        {{ Str::contains($currentUrl, '/jadwal') ? 'bg-pink text-white' : '' }}"
        href="{{ route('catering.jadwal.index') }}">
        <i class="fa-regular fa-calendar"></i>
        Jadwal
    </a>
    <a class="w-full p-2 rounded hover:bg-pink hover:text-white focus:outline-none focus:bg-pink focus:text-white active:bg-pink-active transition-colors
        {{ Str::contains($currentUrl, '/ulasan') ? 'bg-pink text-white' : '' }}"
        href="{{ route('catering.ulasan.index') }}">
        <i class="fa-regular fa-comment"></i>
        Ulasan
    </a>
@endif
