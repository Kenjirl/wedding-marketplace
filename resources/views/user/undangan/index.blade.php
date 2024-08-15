@extends('main')

@section('title')
    <title>Undangan {{ $wedding->p_sapaan . ' & ' . $wedding->w_sapaan }} | Wedding Marketplace</title>
@endsection

@section('body')
    <div class="w-full max-w-[1400px] max-h-screen mx-auto overflow-y-auto bg-white">
        <div class="min-h-screen flex items-center justify-center"
            style="background-color: {{ $wedding->invitation->header['div'] }}; color: {{ $wedding->invitation->header['text'] }};"
            id="header">
            @include('user.undangan.template.header.'.$wedding->invitation->header['template'])
        </div>

        @if ($wedding->invitation->quote['template'] != 0)
            <div class="w-full flex items-center justify-center"
                style="background-color: {{ $wedding->invitation->quote['div'] }}; color: {{ $wedding->invitation->quote['text'] }};"
                id="quote">
                @include('user.undangan.template.quote.'.$wedding->invitation->quote['template'])
            </div>
        @endif

        <div class="flex items-center justify-center"
            style="background-color: {{ $wedding->invitation->profile['div'] }}; color: {{ $wedding->invitation->profile['text'] }};"
            id="profile">
            @include('user.undangan.template.profile.'.$wedding->invitation->profile['template'])
        </div>

        <div class="min-h-[50vh] flex items-center justify-center"
            style="background-color: {{ $wedding->invitation->event['div'] }}; color: {{ $wedding->invitation->event['text'] }};"
            id="event">
            @include('user.undangan.template.event.'.$wedding->invitation->event['template'])
        </div>

        @if ($wedding->invitation->gallery['template'] != 0)
            <div class="min-h-[50vh] flex items-center justify-center"
                style="background-color: {{ $wedding->invitation->gallery['div'] }}; color: {{ $wedding->invitation->gallery['text'] }};"
                id="gallery">
                @include('user.undangan.template.gallery.'.$wedding->invitation->gallery['template'])
            </div>
        @endif

        <div class="min-h-screen flex items-center justify-center"
            style="background-color: {{ $wedding->invitation->wish['div'] }}; color: {{ $wedding->invitation->wish['text'] }};"
            id="wish">
            @include('user.undangan.template.wish.'.$wedding->invitation->wish['template'])
        </div>

        @if ($wedding->invitation->info['template'] != 0)
            <div class="min-h-[50vh] flex items-center justify-center"
                style="background-color: {{ $wedding->invitation->info['div'] }}; color: {{ $wedding->invitation->info['text'] }};"
                id="info">
                @include('user.undangan.template.info.'.$wedding->invitation->info['template'])
            </div>
        @endif

        <div class="min-h-screen flex items-center justify-center"
            style="background-color: {{ $wedding->invitation->footer['div'] }}; color: {{ $wedding->invitation->footer['text'] }};"
            id="footer">
            @include('user.undangan.template.footer.'.$wedding->invitation->footer['template'])
        </div>
    </div>
@endsection

@push('child-js')
    @if ($wedding->invitation->gallery['template'] != 0)
        <script>
            $(document).ready(function() {
                Fancybox.bind("[data-fancybox]");
            });
        </script>
    @endif
@endpush
