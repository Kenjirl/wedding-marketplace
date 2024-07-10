@php
$currentUrl = Request::url();
@endphp

<a class="w-full p-2 rounded {{ Str::endsWith($currentUrl, '/admin') ? 'bg-pink text-white' : '' }} hover:bg-pink hover:text-white focus:outline-none focus:bg-pink focus:text-white active:bg-pink-active transition-colors"
    href="{{ route('admin.index') }}">
    <i class="fa-solid fa-house w-[30px] text-center"></i>
    Dashboard
</a>

<div class="w-full">
    <button class="w-full p-2 text-start rounded {{ Str::contains($currentUrl, 'master') ? 'bg-pink text-white' : '' }} hover:bg-pink hover:text-white focus:outline-none focus:bg-pink focus:text-white active:bg-pink-active transition-colors"
        type="button" id="masterMenuBtn"
        data-open="{{ Str::contains($currentUrl, 'pernikahan') ? 'true' : 'false' }}">
        <i class="fa-solid fa-database w-[30px] text-center"></i>
        Master Data
    </button>
    <div class="w-full mt-2 {{ Str::contains($currentUrl, 'master') ? 'grid' : 'hidden' }} p-2 grid-cols-1 gap-2 bg-slate-100 rounded-lg"
        id="masterMenuContainer">
        <a class="w-full p-2 rounded {{ Str::contains($currentUrl, '/event-pernikahan') ? 'bg-pink text-white' : '' }} hover:bg-pink hover:text-white focus:outline-none focus:bg-pink focus:text-white active:bg-pink-active transition-colors"
            href="{{ route('admin.event-pernikahan.index') }}">
            <i class="fa-solid fa-minus w-[30px] text-center"></i>
            Event Pernikahan
        </a>
        <a class="w-full p-2 rounded {{ Str::contains($currentUrl, '/jenis-vendor') ? 'bg-pink text-white' : '' }} hover:bg-pink hover:text-white focus:outline-none focus:bg-pink focus:text-white active:bg-pink-active transition-colors"
            href="{{ route('admin.jenis-vendor.index') }}">
            <i class="fa-solid fa-minus w-[30px] text-center"></i>
            Jenis Vendor
        </a>
    </div>
</div>

<a class="w-full p-2 rounded {{ Str::contains($currentUrl, '/portofolio') ? 'bg-pink text-white' : '' }} hover:bg-pink hover:text-white focus:outline-none focus:bg-pink focus:text-white active:bg-pink-active transition-colors"
    href="{{ route('admin.portofolio.index', 'pending') }}">
    <i class="fa-regular fa-file-lines w-[30px] text-center"></i>
    Portofolio
</a>
