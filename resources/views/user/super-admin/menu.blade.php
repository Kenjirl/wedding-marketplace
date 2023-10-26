@php
$currentUrl = Request::url();
@endphp

<a class="w-full p-2 rounded {{ Str::endsWith($currentUrl, '/super-admin') ? 'bg-pink text-white' : '' }} hover:bg-pink hover:text-white focus:outline-none focus:bg-pink focus:text-white active:bg-pink-active transition-colors"
    href="{{ route('super-admin.index') }}">
    <i class="fa-solid fa-house"></i>
    Dashboard
</a>
<a class="w-full p-2 rounded {{ Str::contains($currentUrl, '/daftar-admin') ? 'bg-pink text-white' : '' }} hover:bg-pink hover:text-white focus:outline-none focus:bg-pink focus:text-white active:bg-pink-active transition-colors"
    href="{{ route('super-admin.daftar-admin.ke_daftar') }}">
    <i class="fa-solid fa-users"></i>
    Daftar Admin
</a>
