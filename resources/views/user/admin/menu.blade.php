@php
$currentUrl = Request::url();
@endphp

<a class="w-full p-2 rounded {{ Str::endsWith($currentUrl, '/admin') ? 'bg-pink text-white' : '' }} hover:bg-pink hover:text-white focus:outline-none focus:bg-pink focus:text-white active:bg-pink-active transition-colors"
    href="{{ route('admin.index') }}">
    <i class="fa-solid fa-house w-[20px] text-center"></i>
    Dashboard
</a>

<div class="w-full">
    <button class="w-full p-2 text-start rounded {{ Str::contains($currentUrl, 'pernikahan') ? 'bg-pink text-white' : '' }} hover:bg-pink hover:text-white focus:outline-none focus:bg-pink focus:text-white active:bg-pink-active transition-colors"
        type="button" id="masterMenuBtn"
        data-open="{{ Str::contains($currentUrl, 'pernikahan') ? 'true' : 'false' }}">
        <i class="fa-solid fa-database w-[20px] text-center"></i>
        Master Data
    </button>
    <div class="w-full mt-2 {{ Str::contains($currentUrl, 'pernikahan') ? 'grid' : 'hidden' }} p-2 grid-cols-1 gap-2 bg-slate-100 rounded-lg"
        id="masterMenuContainer">
        <a class="w-full p-2 rounded {{ Str::contains($currentUrl, '/event-pernikahan') ? 'bg-pink text-white' : '' }} hover:bg-pink hover:text-white focus:outline-none focus:bg-pink focus:text-white active:bg-pink-active transition-colors"
            href="{{ route('admin.event-pernikahan.index') }}">
            <i class="fa-solid fa-minus w-[20px] text-center"></i>
            Event Pernikahan
        </a>
    </div>
</div>

@php
    $vendors = [
        'wedding-organizer' => ['name' => 'Organizer', 'icon' => 'fa-regular fa-building'],
        'photographer' => ['name' => 'Photographer', 'icon' => 'fa-solid fa-camera-retro'],
        'catering' => ['name' => 'Catering', 'icon' => 'fa-solid fa-utensils'],
        'venue' => ['name' => 'Venue', 'icon' => 'fa-solid fa-place-of-worship']
    ];
@endphp
<div class="w-full">
    <button class="w-full p-2 text-start rounded {{ Str::contains($currentUrl, 'portofolio') ? 'bg-pink text-white' : '' }} hover:bg-pink hover:text-white focus:outline-none focus:bg-pink focus:text-white active:bg-pink-active transition-colors"
        type="button" id="portofolioMenuBtn"
        data-open="{{ Str::contains($currentUrl, 'portofolio') ? 'true' : 'false' }}">
        <i class="fa-regular fa-file-lines w-[20px] text-center"></i>
        Portofolio
    </button>
    <div class="w-full mt-2 {{ Str::contains($currentUrl, 'portofolio') ? 'grid' : 'hidden' }} p-2 grid-cols-1 gap-2 bg-slate-100 rounded-lg"
        id="portofolioMenuContainer">
        @foreach($vendors as $vendor => $data)
            <a class="w-full p-2 rounded {{ Str::contains($currentUrl, "/portofolio/{$vendor}") ? 'bg-pink text-white' : '' }} hover:bg-pink hover:text-white focus:outline-none focus:bg-pink focus:text-white active:bg-pink-active transition-colors"
                href="{{ route('admin.portofolio.index', ['vendor' => $vendor, 'tab' => 'pending']) }}">
                <i class="{{ $data['icon'] }} w-[20px] text-center"></i>
                {{ $data['name'] }}
            </a>
        @endforeach
    </div>
</div>
