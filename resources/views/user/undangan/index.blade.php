@extends('main')

@section('title')
    <title>Undangan {{ $wedding->p_sapaan . ' & ' . $wedding->w_sapaan }} | Wedding Marketplace</title>
@endsection

@section('body')
    <div class="w-full max-w-[1200px] max-h-screen mx-auto overflow-y-auto bg-white">
        <div class="min-h-screen flex items-center justify-center"
            style="background-color: {{ $wedding->invitation->c_header['div'] }}; color: {{ $wedding->invitation->c_header['text'] }};"
            id="header">
            @include('user.undangan.template.header.'.$wedding->invitation->t_header)
        </div>

        @if ($wedding->invitation->t_quote != 0)
            <div class="w-full flex items-center justify-center"
                style="background-color: {{ $wedding->invitation->c_quote['div'] }}; color: {{ $wedding->invitation->c_quote['text'] }};"
                id="quote">
                @include('user.undangan.template.quote.'.$wedding->invitation->t_quote)
            </div>
        @endif

        <div class="flex items-center justify-center"
            style="background-color: {{ $wedding->invitation->c_profile['div'] }}; color: {{ $wedding->invitation->c_profile['text'] }};"
            id="profile">
            @include('user.undangan.template.profile.'.$wedding->invitation->t_profile)
        </div>

        <div class="min-h-[50vh] flex items-center justify-center"
            style="background-color: {{ $wedding->invitation->c_event['div'] }}; color: {{ $wedding->invitation->c_event['text'] }};"
            id="event">
            @include('user.undangan.template.event.'.$wedding->invitation->t_event)
        </div>

        @if ($wedding->invitation->t_gallery != 0)
            <div class="min-h-[50vh] flex items-center justify-center"
                style="background-color: {{ $wedding->invitation->c_gallery['div'] }}; color: {{ $wedding->invitation->c_gallery['text'] }};"
                id="gallery">
                @include('user.undangan.template.gallery.'.$wedding->invitation->t_gallery)
            </div>
        @endif

        <div class="min-h-screen flex items-center justify-center"
            style="background-color: {{ $wedding->invitation->c_wish['div'] }}; color: {{ $wedding->invitation->c_wish['text'] }};"
            id="wish">
            @include('user.undangan.template.wish.'.$wedding->invitation->t_wish)
        </div>

        <div class="min-h-screen flex items-center justify-center"
            style="background-color: {{ $wedding->invitation->c_footer['div'] }}; color: {{ $wedding->invitation->c_footer['text'] }};"
            id="footer">
            @include('user.undangan.template.footer.'.$wedding->invitation->t_footer)
        </div>
    </div>
@endsection

@push('child-js')
    @if ($wedding->invitation->t_gallery != 0)
        <script>
            $(document).ready(function() {
                Fancybox.bind("[data-fancybox]");
            });
        </script>
    @endif
@endpush
