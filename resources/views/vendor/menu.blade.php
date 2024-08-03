@php
$currentUrl = Request::url();
@endphp

<a class="w-full p-2 rounded {{ Str::endsWith($currentUrl, '/vendor') ? 'bg-pink text-white' : '' }} hover:bg-pink hover:text-white focus:outline-none focus:bg-pink focus:text-white active:bg-pink-active transition-colors"
    href="{{ route('vendor.index') }}">
    <i class="w-[30px] text-center fa-solid fa-house"></i>
    Dashboard
</a>

@if (auth()->user()->w_vendor && auth()->user()->w_vendor->jenis->isNotEmpty())
    <a class="w-full p-2 rounded hover:bg-pink hover:text-white focus:outline-none focus:bg-pink focus:text-white active:bg-pink-active transition-colors
        {{ Str::contains($currentUrl, '/portofolio') ? 'bg-pink text-white' : '' }}"
        href="{{ route('vendor.portofolio.index') }}">
        <i class="w-[30px] text-center fa-solid fa-grip"></i>
        Portofolio
    </a>
    <a class="w-full p-2 rounded hover:bg-pink hover:text-white focus:outline-none focus:bg-pink focus:text-white active:bg-pink-active transition-colors
        {{ Str::contains($currentUrl, '/layanan') ? 'bg-pink text-white' : '' }}"
        href="{{ route('vendor.layanan.index') }}">
        <i class="w-[30px] text-center fa-solid fa-gift"></i>
        Layanan
    </a>
    <a class="w-full p-2 rounded hover:bg-pink hover:text-white focus:outline-none focus:bg-pink focus:text-white active:bg-pink-active transition-colors
        {{ Str::contains($currentUrl, '/pesanan') ? 'bg-pink text-white' : '' }}"
        href="{{ route('vendor.pesanan.index') }}">
        <i class="w-[30px] text-center fa-solid fa-grip-vertical"></i>
        Pesanan
    </a>
    <a class="w-full p-2 rounded hover:bg-pink hover:text-white focus:outline-none focus:bg-pink focus:text-white active:bg-pink-active transition-colors
        {{ Str::contains($currentUrl, '/jadwal') ? 'bg-pink text-white' : '' }}"
        href="{{ route('vendor.jadwal.index') }}">
        <i class="w-[30px] text-center fa-regular fa-calendar"></i>
        Jadwal
    </a>
    <a class="w-full p-2 rounded hover:bg-pink hover:text-white focus:outline-none focus:bg-pink focus:text-white active:bg-pink-active transition-colors
        {{ Str::contains($currentUrl, '/pendapatan') ? 'bg-pink text-white' : '' }}"
        href="{{ route('vendor.pendapatan.index') }}">
        <i class="w-[30px] text-center fa-solid fa-dollar-sign"></i>
        Pendapatan
    </a>
    <a class="w-full p-2 rounded hover:bg-pink hover:text-white focus:outline-none focus:bg-pink focus:text-white active:bg-pink-active transition-colors
        {{ Str::contains($currentUrl, '/ulasan') ? 'bg-pink text-white' : '' }}"
        href="{{ route('vendor.ulasan.index') }}">
        <i class="w-[30px] text-center fa-regular fa-comment"></i>
        Ulasan
    </a>
@endif
