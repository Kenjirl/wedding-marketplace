@php
$currentUrl = Request::url();
@endphp

@if (auth()->user() && auth()->user()->w_couple)
    <a class="w-[30px] aspect-square flex items-center justify-center border border-pink rounded {{ Str::endsWith($currentUrl, '/wedding-couple') ? 'bg-pink text-white' : 'text-pink' }} hover:bg-pink hover:text-white outline-pink focus:bg-pink focus:text-white active:bg-pink-active transition-colors"
        href="{{ route('wedding-couple.index') }}">
        <i class="fa-solid fa-house"></i>
    </a>

    <a class="w-fit py-1 border-b-2 {{ Str::contains($currentUrl, '/pernikahan') ? 'border-pink text-pink' : 'border-transparent' }} hover:border-pink outline-pink focus:border-pink active:border-pink-active transition-colors"
        href="{{ route('wedding-couple.pernikahan.index') }}">
        Pernikahan
    </a>
    <a class="w-fit py-1 border-b-2 {{ Str::contains($currentUrl, '/search') ? 'border-pink text-pink' : 'border-transparent' }} hover:border-pink outline-pink focus:border-pink active:border-pink-active transition-colors"
        href="{{ route('wedding-couple.search.index') }}">
        Layanan
    </a>
@else
    <a class="w-[30px] aspect-square flex items-center justify-center border border-pink rounded bg-pink text-white hover:bg-pink hover:text-white outline-pink focus:bg-pink focus:text-white active:bg-pink-active transition-colors"
        href="/">
        <i class="fa-solid fa-house"></i>
    </a>
@endif
