@php
$currentUrl = Request::url();
@endphp

<a class="w-full p-2 rounded {{ Str::endsWith($currentUrl, '/admin') ? 'bg-pink text-white' : '' }} hover:bg-pink hover:text-white focus:outline-none focus:bg-pink focus:text-white active:bg-pink-active transition-colors"
    href="{{ route('admin.index') }}">
    <i class="fa-solid fa-house"></i>
    Dashboard
</a>
<a class="w-full p-2 rounded {{ Str::contains($currentUrl, '/kategori-pernikahan') ? 'bg-pink text-white' : '' }} hover:bg-pink hover:text-white focus:outline-none focus:bg-pink focus:text-white active:bg-pink-active transition-colors"
    href="{{ route('admin.kategori-pernikahan.index') }}">
    <i class="fa-solid fa-table-list"></i>
    Kategori Pernikahan
</a>
<a class="w-full p-2 rounded {{ Str::contains($currentUrl, '/wedding-couple') ? 'bg-pink text-white' : '' }} hover:bg-pink hover:text-white focus:outline-none focus:bg-pink focus:text-white active:bg-pink-active transition-colors"
    href="#">
    <i class="fa-solid fa-dove"></i>
    Wedding Couple
</a>
<a class="w-full p-2 rounded {{ Str::contains($currentUrl, '/wedding-organizer') ? 'bg-pink text-white' : '' }} hover:bg-pink hover:text-white focus:outline-none focus:bg-pink focus:text-white active:bg-pink-active transition-colors"
    href="{{ route('admin.wo.portofolio.index') }}">
    <i class="fa-regular fa-building"></i>
    Wedding Organizer
</a>
<a class="w-full p-2 rounded {{ Str::contains($currentUrl, '/wedding-photographer') ? 'bg-pink text-white' : '' }} hover:bg-pink hover:text-white focus:outline-none focus:bg-pink focus:text-white active:bg-pink-active transition-colors"
    href="{{ route('admin.wp.portofolio.index') }}">
    <i class="fa-solid fa-camera-retro"></i>
    Wedding Photographer
</a>
