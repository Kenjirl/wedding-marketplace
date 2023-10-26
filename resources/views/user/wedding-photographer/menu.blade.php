@php
$currentUrl = Request::url();
@endphp

<a class="w-full p-2 rounded hover:bg-pink hover:text-white focus:outline-none focus:bg-pink focus:text-white active:bg-pink-active transition-colors
    {{ Str::endsWith($currentUrl, '/wedding-photographer') ? 'bg-pink text-white' : '' }}"
    href="{{ route('wedding-photographer.index') }}">
    <i class="fa-solid fa-house"></i>
    Dashboard
</a>

@if (auth()->user()->w_photographer)
    <a class="w-full p-2 rounded hover:bg-pink hover:text-white focus:outline-none focus:bg-pink focus:text-white active:bg-pink-active transition-colors
        {{ Str::contains($currentUrl, '/portofolio') ? 'bg-pink text-white' : '' }}"
        href="{{ route('wedding-photographer.portofolio.index') }}">
        <i class="fa-solid fa-grip"></i>
        Portofolio
    </a>
    <a class="w-full p-2 rounded hover:bg-pink hover:text-white focus:outline-none focus:bg-pink focus:text-white active:bg-pink-active transition-colors"
        href="#">
        <i class="fa-solid fa-gift"></i>
        Layanan
    </a>
    <a class="w-full p-2 rounded hover:bg-pink hover:text-white focus:outline-none focus:bg-pink focus:text-white active:bg-pink-active transition-colors"
        href="#">
        <i class="fa-regular fa-calendar"></i>
        Jadwal
    </a>
    <a class="w-full p-2 rounded hover:bg-pink hover:text-white focus:outline-none focus:bg-pink focus:text-white active:bg-pink-active transition-colors"
        href="#">
        <i class="fa-regular fa-comment"></i>
        Ulasan
    </a>
@endif
