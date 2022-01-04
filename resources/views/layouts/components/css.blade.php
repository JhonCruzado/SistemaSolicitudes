    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('rs/vendors/css/vendors.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('rs/vendors/css/extensions/toastr.min.css') }}">
    <!-- END: Vendor CSS-->

    @stack('styles')
    
    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('rs/css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('rs/css/bootstrap-extended.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('rs/css/colors.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('rs/css/components.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('rs/css/principal.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('rs/css/themes/bordered-layout.css') }}">

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('rs/css/core/menu/menu-types/vertical-menu.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('rs/css/plugins/extensions/ext-component-toastr.css') }}">
    <!-- END: Page CSS-->

    <link rel="stylesheet" type="text/css" href="{{ asset('css/styles.css') }}">

    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">

    @auth
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        {{-- Icon fonts --}}
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
            integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    @endauth
    @guest
        <link rel="stylesheet" type="text/css" href="{{ asset('rs/css/pages/page-auth.css') }}">
    @endguest
