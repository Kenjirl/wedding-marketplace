@php
$currentUrl = Request::url();
@endphp

@if (auth()->user() && auth()->user()->w_couple)
    <a class="w-fit py-1 border-b-2 {{ Str::endsWith($currentUrl, '/wedding-couple') ? 'border-pink text-pink' : 'border-transparent' }} hover:border-pink outline-pink outline-offset-4 focus:border-pink active:border-pink-active transition-colors"
        href="{{ route('wedding-couple.index') }}">
        Home
    </a>

    <a class="w-fit py-1 border-b-2 {{ Str::contains($currentUrl, '/pernikahan') ? 'border-pink text-pink' : 'border-transparent' }} hover:border-pink outline-pink outline-offset-4 focus:border-pink active:border-pink-active transition-colors"
        href="{{ route('wedding-couple.pernikahan.index') }}">
        Pernikahan
    </a>
    <a class="w-fit py-1 border-b-2 {{ Str::contains($currentUrl, '/wedding-organizer') ? 'border-pink text-pink' : 'border-transparent' }} hover:border-pink outline-pink outline-offset-4 focus:border-pink active:border-pink-active transition-colors"
        href="{{ route('wedding-couple.search.wo.index') }}">
        Organizer
    </a>
    <a class="w-fit py-1 border-b-2 {{ Str::contains($currentUrl, '/wedding-photographer') ? 'border-pink text-pink' : 'border-transparent' }} hover:border-pink outline-pink outline-offset-4 focus:border-pink active:border-pink-active transition-colors"
        href="{{ route('wedding-couple.search.wp.index') }}">
        Photographer
    </a>
@else
    <a class="w-fit py-1 border-b-2 border-pink text-pink hover:border-pink outline-pink outline-offset-4 focus:border-pink active:border-pink-active transition-colors"
        href="/">
        Home
    </a>
@endif
