@php
$currentUrl = Request::url();
@endphp

<a class="w-full p-2 rounded {{ Str::endsWith($currentUrl, '/wedding-couple') ? 'bg-pink text-white' : '' }} hover:bg-pink hover:text-white focus:outline-none focus:bg-pink focus:text-white active:bg-pink-active transition-colors"
    href="{{ route('wedding-couple.index') }}">
    <i class="fa-solid fa-house"></i>
    Dashboard
</a>

@if (auth()->user()->w_couple)
    <a class="w-full p-2 rounded hover:bg-pink hover:text-white focus:outline-none focus:bg-pink focus:text-white active:bg-pink-active transition-colors"
        href="#">
        <i class="fa-solid fa-dove"></i>
        Pernikahan
    </a>
    <a class="w-full p-2 rounded {{ Str::contains($currentUrl, '/wedding-organizer') ? 'bg-pink text-white' : '' }} hover:bg-pink hover:text-white focus:outline-none focus:bg-pink focus:text-white active:bg-pink-active transition-colors"
        href="#">
        <i class="fa-regular fa-building"></i>
        Wedding Organizer
    </a>
    <a class="w-full p-2 rounded {{ Str::contains($currentUrl, '/wedding-photographer') ? 'bg-pink text-white' : '' }} hover:bg-pink hover:text-white focus:outline-none focus:bg-pink focus:text-white active:bg-pink-active transition-colors"
        href="#">
        <i class="fa-solid fa-camera-retro"></i>
        Wedding Photographer
    </a>
@endif
