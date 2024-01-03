<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="ENG : Mohamed Nagy">
    <link rel="icon" href="{{ asset('./assets/images/logo.png') }}">
    
    <title>@yield('title') | برنامج الفواتير</title>

    @include('layouts.head-css')

</head>

<body class="vertical  light rtl ">
    <div class="wrapper">

        @include('layouts.nav')

        @include('layouts.sidbar')

        @include('layouts.mainBody')

        @yield('content')

        @include('layouts.modelNati')

    </div> <!-- .wrapper -->

    @include('layouts.footer-js')

</body>

</html>
