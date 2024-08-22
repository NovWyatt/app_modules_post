<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Untree.co">
    <link rel="shortcut icon" href="blog/favicon.png">

    <meta name="description" content="" />
    <meta name="keywords" content="bootstrap, bootstrap5" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@400;600;700&display=swap" rel="stylesheet">


    <link rel="stylesheet" href="blog/fonts/icomoon/style.css">
    <link rel="stylesheet" href="blog/fonts/flaticon/font/flaticon.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">

    <link rel="stylesheet" href="blog/css/tiny-slider.css">
    <link rel="stylesheet" href="blog/css/aos.css">
    <link rel="stylesheet" href="blog/css/glightbox.min.css">
    <link rel="stylesheet" href="blog/css/style.css">

    <link rel="stylesheet" href="blog/css/flatpickr.min.css">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

<body>
    @include('spinner.mobile')
    @include('componer.header')
    @yield('content')
    @include('componer.footer')
    @include('spinner.loadblog')

    <script src="blog/js/bootstrap.bundle.min.js"></script>
    <script src="blog/js/tiny-slider.js"></script>

    <script src="blog/js/flatpickr.min.js"></script>


    <script src="blog/js/aos.js"></script>
    <script src="blog/js/glightbox.min.js"></script>
    <script src="blog/js/navbar.js"></script>
    <script src="blog/js/counter.js"></script>
    <script src="blog/js/custom.js"></script>
</body>

</html>
