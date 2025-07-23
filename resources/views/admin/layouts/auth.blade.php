<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <link rel="icon" href="{{ asset('img/favicon.svg') }}" type="image/svg+xml">
    <link rel="icon" href="{{ asset('img/favicon.png') }}" type="image/png">

    <!-- Title -->
    <title>Gelios</title>

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('img/favicon.svg') }}" type="image/svg+xml">
    <link rel="icon" href="{{ asset('img/favicon.png') }}" type="image/png">

    <!-- Master Stylesheet [If you remove this CSS file, your file will be broken undoubtedly.] -->
    <link rel="stylesheet" href="{{ asset('admin_src/style.css') }}">

</head>

<body class="login-area">

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

@yield('content')

<!-- ======================================
********* Page Wrapper Area End ***********
======================================= -->

<!-- Must needed plugins to the run this Template -->
<script src="{{ asset('admin_src/js/jquery.min.js') }}"></script>
<script src="{{ asset('admin_src/js/popper.min.js') }}"></script>
<script src="{{ asset('admin_src/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('admin_src/js/bundle.js') }}"></script>

<!-- Active JS -->
<script src="{{ asset('admin_src/js/default-assets/active.js') }}"></script>

</body>

</html>
