<!DOCTYPE html>
<html class="loading bordered-layout" lang="en" data-textdirection="ltr">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta name="author" content="team coders">
    <title>Comercial El Valle</title>
    <link rel="apple-touch-icon" href="{{ asset('rs/images/ico/apple-icon-120.png') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/logo1.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600"
        rel="stylesheet">
    @include('layouts.components.css')
    @livewireStyles
</head>

<body class="vertical-layout vertical-menu-modern  navbar-floating footer-static  " data-open="click"
    data-menu="vertical-menu-modern" data-col="">

    @include('layouts.components.navbar')
    @include('layouts.components.sidebar')

    <div class="app-content content ecommerce-application">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            @if(isset($slot))
                {{ $slot }}
            @endif
            @yield('reportes')
        </div>
    </div>

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    @include('layouts.components.js')
    @livewireScripts

    @stack('js')
</body>

</html>
