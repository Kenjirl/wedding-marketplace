@php
$currentUrl = Request::url();
@endphp

<a class="w-fit p-4 rounded {{ Str::endsWith($currentUrl, '/wedding-couple') ? 'bg-pink text-white' : '' }} hover:bg-pink hover:text-white focus:outline-none focus:bg-pink focus:text-white active:bg-pink-active transition-colors"
    href="{{ route('wedding-couple.index') }}">
    Home
</a>

@if (auth()->user()->w_couple)
    <a class="w-fit p-4 rounded hover:bg-pink hover:text-white focus:outline-none focus:bg-pink focus:text-white active:bg-pink-active transition-colors"
        href="#">
        Pernikahan
    </a>
    <a class="w-fit p-4 rounded {{ Str::contains($currentUrl, '/wedding-organizer') ? 'bg-pink text-white' : '' }} hover:bg-pink hover:text-white focus:outline-none focus:bg-pink focus:text-white active:bg-pink-active transition-colors"
        href="#">
        Wedding Organizer
    </a>
    <a class="w-fit p-4 rounded {{ Str::contains($currentUrl, '/wedding-photographer') ? 'bg-pink text-white' : '' }} hover:bg-pink hover:text-white focus:outline-none focus:bg-pink focus:text-white active:bg-pink-active transition-colors"
        href="#">
        Wedding Photographer
    </a>
@endif
