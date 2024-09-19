<!doctype html>
<html lang="ua">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="app-url" content="{{ env('APP_URL') }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Title -->
    <title>Gelios</title>

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('img/favicon.png') }}">

<!-- Master Stylesheet [If you remove this CSS file, your file will be broken undoubtedly.] -->
    @stack('head')

    <link rel="stylesheet" href="{{ asset('admin_src/style.css') }}">
    <meta name="robots" content="noindex, nofollow">
    @livewireStyles
</head>

<body>
<!-- Preloader Start -->
<div id="preloader">
    <div class="preload-content">
        <div id="hasro-load"></div>
    </div>
</div>
<!-- Preloader End -->

<!-- ======================================
******* Page Wrapper Area Start **********
======================================= -->
<div class="ecaps-page-wrapper">
    @include('admin.parts.sidebar')

    <div class="ecaps-page-content">
        @include('admin.parts.header')

        <div class="main-content">
            @yield('content')
        </div>
    </div>
</div>

<!-- ======================================
********* Page Wrapper Area End ***********
======================================= -->

<!-- Must needed plugins to the run this Template -->
<script src="{{ asset('admin_src/js/jquery.min.js') }}"></script>
<script src="{{ asset('admin_src/js/popper.min.js') }}"></script>
<script src="{{ asset('admin_src/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('admin_src/js/bundle.js') }}"></script>
<script src="{{ asset('admin_src/js/default-assets/setting.js') }}"></script>
<script src="{{ asset('admin_src/js/default-assets/fullscreen.js') }}"></script>

<!-- Active JS -->
<script src="{{ asset('admin_src/js/default-assets/active.js') }}"></script>


<script src="{{ asset('admin_src/js/default-assets/modal-classes.js') }}"></script>
<script src="{{ asset('admin_src/js/default-assets/modaleffects.js') }}"></script>

<!-- custom JS -->


@stack('scripts')
@livewireScripts
<script src="https://cdn.jsdelivr.net/gh/livewire/sortable@v1.x.x/dist/livewire-sortable.js"></script>
</body>

</html>
