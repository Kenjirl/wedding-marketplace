@php
$currentUrl = Request::url();
@endphp

@if (auth()->user() && auth()->user()->w_couple)
    <a class="w-fit p-4 rounded {{ Str::endsWith($currentUrl, '/wedding-couple') ? 'bg-pink text-white' : '' }} hover:bg-pink hover:text-white focus:outline-none focus:bg-pink focus:text-white active:bg-pink-active transition-colors"
        href="{{ route('wedding-couple.index') }}">
        Home
    </a>

    <a class="w-fit p-4 rounded {{ Str::contains($currentUrl, '/pernikahan') ? 'bg-pink text-white' : '' }} hover:bg-pink hover:text-white focus:outline-none focus:bg-pink focus:text-white active:bg-pink-active transition-colors"
        href="{{ route('wedding-couple.pernikahan.index') }}">
        Pernikahan
    </a>
    <a class="w-fit p-4 rounded {{ Str::contains($currentUrl, '/wedding-organizer') ? 'bg-pink text-white' : '' }} hover:bg-pink hover:text-white focus:outline-none focus:bg-pink focus:text-white active:bg-pink-active transition-colors"
        href="{{ route('wedding-couple.search.wo.index') }}">
        Organizer
    </a>
    <a class="w-fit p-4 rounded {{ Str::contains($currentUrl, '/wedding-photographer') ? 'bg-pink text-white' : '' }} hover:bg-pink hover:text-white focus:outline-none focus:bg-pink focus:text-white active:bg-pink-active transition-colors"
        href="{{ route('wedding-couple.search.wp.index') }}">
        Photographer
    </a>
@else
    <a class="w-fit p-4 rounded bg-pink text-white hover:bg-pink hover:text-white focus:outline-none focus:bg-pink focus:text-white active:bg-pink-active transition-colors"
        href="/">
        Home
    </a>
@endif
