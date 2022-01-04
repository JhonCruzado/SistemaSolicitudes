<!-- BEGIN: Vendor JS-->
<script src="{{ asset('rs/vendors/js/vendors.min.js') }}"></script>
<!-- BEGIN Vendor JS-->

@auth
    <script src="{{ asset('rs/vendors/js/extensions/toastr.min.js') }}"></script>
    <script src="{{ asset('rs/js/scripts/extensions/ext-component-toastr.js') }}"></script>
@endauth

<!-- BEGIN: Theme JS-->
<script src="{{ asset('rs/js/core/app-menu.js') }}"></script>
<script src="{{ asset('rs/js/core/app.js') }}"></script>
<!-- END: Theme JS-->

@stack('scripts')

<script>
    $(window).on('load', function() {
        if (feather) {
            feather.replace({
                width: 14,
                height: 14
            });
        }
    })
</script>
