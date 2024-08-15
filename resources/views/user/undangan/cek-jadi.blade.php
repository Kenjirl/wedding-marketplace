@extends('main')

@section('title')
    <title>Cek Undangan | Wedding Marketplace</title>
@endsection

@section('body')
    <div class="w-full max-w-[1400px] max-h-screen mx-auto overflow-y-auto bg-white">
        @include('user.undangan.template-jadi.header.'.$wedding->invitation->header['template'])

        @if ($wedding->invitation->quote['template'] != 't0')
            @include('user.undangan.template-jadi.quote.'.$wedding->invitation->quote['template'])
        @endif

        @include('user.undangan.template-jadi.profile.'.$wedding->invitation->profile['template'])

        @include('user.undangan.template-jadi.event.'.$wedding->invitation->event['template'])

        @if ($wedding->invitation->gallery['template'] != 't0')
            @include('user.undangan.template-jadi.gallery.'.$wedding->invitation->gallery['template'])
        @endif

        @include('user.undangan.template-jadi.wish.'.$wedding->invitation->wish['template'])

        @include('user.undangan.template-jadi.footer.'.$wedding->invitation->footer['template'])
    </div>
@endsection

@push('child-js')
    @if ($wedding->invitation->gallery['template'] != 't0')
        <script>
            $(document).ready(function() {
                Fancybox.bind("[data-fancybox]");
            });
        </script>
    @endif
@endpush
