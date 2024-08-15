<!doctype html>
<html class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- FAVICONS --}}
    @if(App::environment('local'))
    {{-- DEV WITH LOCAL --}}
    <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('img/icons/apple-icon-57x57.png') }}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('img/icons/apple-icon-60x60.png') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('img/icons/apple-icon-72x72.png') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('img/icons/apple-icon-76x76.png') }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('img/icons/apple-icon-114x114.png') }}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('img/icons/apple-icon-120x120.png') }}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('img/icons/apple-icon-144x144.png') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('img/icons/apple-icon-152x152.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('img/icons/apple-icon-180x180.png') }}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('img/icons/android-icon-192x192.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('img/icons/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('img/icons/favicon-96x96.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('img/icons/favicon-32x32.png') }}">
    <link rel="manifest" href="/manifest.json">
    <meta name="msapplication-TileColor" content="#F78CA2">
    <meta name="msapplication-TileImage" content="{{ asset('img/icons/ms-icon-144x144.png') }}">
    <meta name="theme-color" content="#F78CA2">

    @vite('resources/css/app.css')

    {{-- MAGNIFIC POPUP CSS --}}
    <link rel="stylesheet" href="{{ asset('css/magnific-popup.css') }}">

    @else
    {{-- PROD WITH NGROK --}}
    <link rel="apple-touch-icon" sizes="57x57" href="https://pro-malamute-vastly.ngrok-free.app/img/icons/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="https://pro-malamute-vastly.ngrok-free.app/img/icons/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="https://pro-malamute-vastly.ngrok-free.app/img/icons/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="https://pro-malamute-vastly.ngrok-free.app/img/icons/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="https://pro-malamute-vastly.ngrok-free.app/img/icons/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="https://pro-malamute-vastly.ngrok-free.app/img/icons/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="https://pro-malamute-vastly.ngrok-free.app/img/icons/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="https://pro-malamute-vastly.ngrok-free.app/img/icons/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="https://pro-malamute-vastly.ngrok-free.app/img/icons/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192" href="https://pro-malamute-vastly.ngrok-free.app/img/icons/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="https://pro-malamute-vastly.ngrok-free.app/img/icons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="https://pro-malamute-vastly.ngrok-free.app/img/icons/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="https://pro-malamute-vastly.ngrok-free.app/img/icons/favicon-32x32.png">
    <link rel="manifest" href="https://pro-malamute-vastly.ngrok-free.app/manifest.json">
    <meta name="msapplication-TileColor" content="#F78CA2">
    <meta name="msapplication-TileImage" content="https://pro-malamute-vastly.ngrok-free.app/img/icons/ms-icon-144x144.png">
    <meta name="theme-color" content="#F78CA2">

    <link rel="preload" as="style" href="https://pro-malamute-vastly.ngrok-free.app/build/assets/app-d88702ab.css" />
            <link rel="stylesheet" href="https://pro-malamute-vastly.ngrok-free.app/build/assets/app-d88702ab.css" />

    {{-- MAGNIFIC POPUP CSS --}}
    <link rel="stylesheet" href="https://pro-malamute-vastly.ngrok-free.app/css/magnific-popup.css">

    @endif

    {{-- MIDTRANS PAYMENT GATEWAY SANDBOX SNAP JS --}}
    <script type="text/javascript"
        src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('midtrans.client_key') }}"></script>

    {{-- LEAFLET CDN --}}
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
        crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
        crossorigin=""></script>

    {{-- FONT AWESOME ICON --}}
    <script src="https://kit.fontawesome.com/5b8fa639bb.js" crossorigin="anonymous"></script>

    {{-- ANIMATE CSS CDN --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

    {{-- TOASTR CSS --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"/>

    {{-- DATATABLES CSS --}}
    {{-- <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css"> --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.tailwindcss.css">

    {{-- SWEETALERT CSS CDN --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.0/dist/sweetalert2.min.css">

    {{-- INTERNATIONAL TEL INPUT CSS --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@18.2.1/build/css/intlTelInput.css">

    @yield('title')

    {{-- GOOGLE FONT --}}
    <link href="https://fonts.googleapis.com/css2?family=Monsieur+La+Doulaise&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Varela+Round&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Sacramento&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">

    {{-- JQUERY CDN --}}
    {{-- <script src="https://code.jquery.com/jquery-3.7.1.slim.min.js" integrity="sha256-kmHvs0B+OpCW5GVHUNjv9rOmY0IvSIRcf7zGUDTDQM8=" crossorigin="anonymous"></script> --}}
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    {{-- TOASTR CDN JS --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    {{-- DATATABLES CDN JS --}}
    {{-- <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script> --}}
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.tailwindcss.js"></script>

    {{-- SWEETALERT JS CDN --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.0/dist/sweetalert2.all.min.js"></script>

    {{-- TINYMCE JS FOR TEXTAREA EDITOR --}}
    <script src="https://cdn.tiny.cloud/1/5srmzqe0lwc149l1fawecd3dsl6ebehc3ohcc0n7u12k78m8/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
    tinymce.init({
        selector: 'textarea#input',
        // plugins: 'visualblocks wordcount',
        plugins: 'lists advlist visualblocks wordcount',
        // toolbar: 'undo redo | bold italic underline strikethrough | align lineheight | indent outdent',
        toolbar: 'undo redo | bold italic underline strikethrough | align lineheight | checklist numlist bullist indent outdent',
        menu: {
            format: { title: 'Format', items: 'bold italic underline strikethrough superscript subscript | removeformat' },
        },
        height : "300"
    });
    </script>

    {{-- FANCYBOX CDN --}}
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css"
    />

    {{-- APEXCHART JS CDN --}}
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
</head>
<body>
    @yield('body')

    {{-- TO GET CLASS FOR TAILWIND --}}
    <div class=" justify-self-start
        bg-red-400 text-red-400 border-red-400
        hover:bg-red-400 hover:text-red-400 hover:border-red-400
        focus:bg-red-400 focus:text-red-400 focus:border-red-400
    "></div>
    <div class="justify-self-end translate-y-[78x]
        bg-blue-400 text-blue-400 border-blue-400
        hover:bg-blue-400 hover:text-blue-400 hover:border-blue-400
        focus:bg-blue-400 focus:text-blue-400 focus:border-blue-400
    "></div>
    <div class=" translate-y-0
        bg-green-400 text-green-400 border-green-400
        hover:bg-green-400 hover:text-green-400 hover:border-green-400
        focus:bg-green-400 focus:text-green-400 focus:border-green-400
    "></div>
    <div class=" -translate-y-20
        bg-yellow-400 text-yellow-400 border-yellow-400
        hover:bg-yellow-400 hover:text-yellow-400 hover:border-yellow-400
        focus:bg-yellow-400 focus:text-yellow-400 focus:border-yellow-400
    "></div>

    {{-- TIPPY JS CDN --}}
    <script src="https://unpkg.com/popper.js@1"></script>
    <script src="https://unpkg.com/tippy.js@5"></script>
    <script>
        tippy('[data-tippy-content]');
    </script>

    {{-- DATA TABLE JS --}}
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable({});
        });
    </script>

    {{-- MAGNIFIC POPUP JS --}}
    @if(App::environment('local'))
    <script src="{{ asset('js/magnific-popup.js') }}"></script>
    @else
    <script src="https://pro-malamute-vastly.ngrok-free.app/js/magnific-popup.js"></script>
    @endif

    {{-- SCRIPT TOASTR --}}
    <script>
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-bottom-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }
    </script>

    @if(session()->has('sukses'))
        <script>
            toastr.success("{{ session('sukses') }}", "Sukses");
        </script>
    @endif

    @if(session()->has('gagal'))
        <script>
            toastr.error("{{ session('gagal') }}", "Gagal");
        </script>
    @endif

    {{-- FULL CALENDAR JS CDN --}}
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js"></script>

    {{-- CHART JS --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    @stack('child-js')
</body>
</html>
