<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    {{-- google analytics --}}
    @include('frontend.partials.tracking')

    {!! SEO::generate() !!}

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- favicon -->
    @if($site_global_settings->setting_site_favicon)
        <link rel="icon" type="icon" href="{{ Storage::disk('public')->url('setting/'. $site_global_settings->setting_site_favicon) }}" sizes="96x96"/>
    @else
        <link rel="icon" type="image/png" sizes="16x16" href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAABvUlEQVQ4jaWRO08bQRSFzzx2ZsM6EgV0rCBeJBBF5MqIBn4GBS4ifgFSlCpKE6VPGUVpKaKkSZ82UiJXjpTCKQBZRm4ABYKDvfPYiXZikFmvociVrq7mcc795g7+N8g0fa3bfAVgb7R83YrrL8rulRrUus0dAPuF7e1WXP9wr0Gt2+Quyw4JpXHh6ADAaiuum/FNWjTon5w8LxHnkQBo3EkQvnspRBT9hHNL1c3NstdNUNwi4GH4RA8GS8OLC/zqdMoMJihuCOY+veFW67ZVKjFKgXGO6tYWCJkY0y2KGwIuZYNLmXApEUiJzFr87vXupfD2i18+cqtU22qdWK1hlUJeCWODxfV1AYBNo/AETIgGu+4+MwMRRb5Sxt66LHs/hWLXE6z++MytMe1M60RUKpCVCjJjkPb7PtXl5fn8yspDQmmRogtgmbIgaHAhEiYEnLX+xKSpT5tXpWZPDzvfjQtQyNi4YJfTIHiGfNKE+M56OMxF/8Sj/HN2VA0fPfZ3CvGUU8bW8q8ilPov8wMcE49IZvtXTrEHUT7Q8VjmhNKvIGSDjigIIb1Bmp4bpdaun2GNPdbh/IJ2BTnw7S8st9MN3vDK3AAAAABJRU5ErkJggg=="/>
        <link rel="icon" type="image/png" sizes="32x32" href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAYAAABzenr0AAAERElEQVRYhcVXW2gcVRj+zmXS3aYm2zSNERkvjdFVYzoruAmIGqqIVKRUMIL1UfBW8UHEB0GsBhQ0iA/2QQ34IKhIS0EQhPTFBy0rpWtCGqh227CCl2TbkrhJdubMOXImM5vZsNk98+QPH+fs4ez/f//3n9vg/zaSNL5TLlAAzwF4AcDdABSA8wCOA5gq2nmVxF8iAk65wAB8BeCpbaZ8A+CZop2Xpj5pEgIAXm0RXNvTAF5J4tBYAadcyAC4BCDTZmoFwK1FO79i4jeJAq8bBNe2B8Brpk6NFHDKhX4oVQIhaUO/ywAGinZ+qd1EIwVErfZeguDaukLF2lpbBbJz0wNWKjUvfd+y0kk4YB3AvqKd/7PVJN7OS6VUeufawoLlex76sln0Dw2ZEkgBeBPA0VaTWiqQnpq4S0k5I4Vg0vehpMTggQNIdXebkvAADBbt/MJ2E1quAcb5W5QxRjlHAMbw9/y8aXBtFoBjrSZsSyDz9UdDlPNxHZiF0P3q4iLWrl5NQuJZp1zIJiZAOZ+gnJN69jES/1y4kIQAa6VCUwJ7v/s0Rzk/FA8ah1ZgtVJJQmLcKRdyxgTC7BuCMssCDaH7SxcvJiGg7V0jAjee/nKUMnZQL7gGEvo3Y2BhW1tZQXWp7UEXt8edcmG0LQHK2LF61iGJhjLEVLhy+fK/SRgAeL8lgVt+OjFGOX80ypaEmZMmSui+t7b2IYBvExB4yCkXHokPNJyElLG3FSEAIQhaKYOW+D6kbgnZbKWsgJBJADaAJ8PVbmITAKajefWTcPDc9w8r35+WOqiG7yOVyQTZ6jeW/u27LqQQ0MeyknJOSfm7cF3s3L27d1df3/0JlDhctPOnGgjcPvPDGSXliAqPXC1xZ29v/R86uA7mhwj6tVo0tnzD8HCaMmYZEpjVt7x+ugVr4M7zpx+jjI3U66uzDpXQpu+B4C4IW61CgM2xrqXSpRkfDIa4xwcbDxQY+u1HoqQ8K6XMRUEj8FQKOzo765k3KFCrNarhuqv9I2OMdXTsMFRBHyRZSig9RBjLxbOPEDj2vE0FoszD7BsgxM7FueKspywYYsBT1hFOKH0JKvaUD3eBBpUSYn09WIRbgzYrx+pff9zRLRlAjJ+aL2sCD0QE9PYK5A+/NtTGdgvGZDx7vRPiSkR9z7tubaV6hXf19BgSyHFCyMb+pRR1JSIV9G6ILcIGBbYph1AcUKabQR9EhJwlhIwGwSMCW4hQrUS1uiiF2NssqNrsX1O7ru/xlPHnxi86wQ8i+QNQGiBYiLrd6H8mPe8NubXuW8ph3eSUBDoglGWKSVq08yfrV2WMQIzMcULpi1KIL6QQnwfSNymHSmdm2f4n7vVgwRCTywOZE3WtnHLhQQDPA9DPXk8pdQ5KTf168+iZuGZ7Tn5yRLjuUb9W2y9cl/uSLij7vlUyODYclKy11QD8DOBj77aOUwDwH7uJthlu6cnpAAAAAElFTkSuQmCC"/>
        <link rel="icon" type="image/png" sizes="96x96" href="data:image/png;base64,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"/>
    @endif

    <!-- start preload font styles -->
    <link rel="preload" onload="this.rel='stylesheet'" href="{{ asset('frontend/vendor/fontawesome-free/css/all.min.css') }}" as="style">
    <link rel="preload" onload="this.rel='stylesheet'" href="{{ asset('frontend/fonts/icomoon/style.min.css') }}" as="style">
    <link rel="preload" onload="this.rel='stylesheet'" href="{{ asset('frontend/fonts/nanum-gothic/style.min.css') }}" as="style">
    <!-- end preload font styles -->

    <!-- Start Firefox does not support preload -->
    <link rel="stylesheet" href="{{ asset('frontend/vendor/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/fonts/icomoon/style.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/fonts/nanum-gothic/style.min.css') }}">
    <!-- End Firefox does not support preload -->

    <link rel="stylesheet" href="{{ asset('frontend/css/stylesheet.css') }}">


    <!-- custom colors -->
    @include('frontend.partials.customization-css')

    @if($site_global_settings->setting_site_header_enabled == \App\Setting::SITE_HEADER_ENABLED)
        {!! $site_global_settings->setting_site_header !!}
    @endif

    @yield('styles')

    @if(is_demo_mode())
        <style>
            #demo-purchase-box {
                max-width: 280px;
                width: auto;
                position: fixed;
                bottom: 25px;
                left: 40px;
                z-index: 5000;
            }
            #demo-purchase-content-box
            {
                background: #009688;
            }
        </style>
    @endif

    @if($site_global_settings->setting_site_maintenance_mode == \App\Setting::SITE_MAINTENANCE_MODE_ON)
        <style>
            #maintenance-mode-box {
                max-width: 280px;
                width: auto;
                position: fixed;
                bottom: 25px;
                right: 40px;
                z-index: 5000;
            }
        </style>
    @endif
</head>
<body>

@if(is_demo_mode())
    <div id="demo-purchase-box">
        <div class="row mb-1">
            <div class="col-12 pl-0">
                <a id="demo-purchase-close" class="btn btn-warning text-white rounded" data-toggle="collapse" href="#demo-purchase-content" role="button" aria-expanded="false" aria-controls="collapseExample">
                    <i class="fas fa-chevron-down"></i>
                </a>
            </div>
        </div>
        <div class="row collapse" id="demo-purchase-content">
            <div class="col-12 pt-3 pb-3 rounded" id="demo-purchase-content-box">
                <p class="text-white">
                    {{ __('demo.purchase-desc') }}
                </p>
                <a class="btn btn-warning btn-sm text-white rounded" href="https://codecanyon.net/item/directory-hub-listing-classified-platform/26890239" target="_blank">
                    <i class="fas fa-shopping-cart"></i>
                    {{ __('demo.purchase-button') }}
                </a>
            </div>
        </div>
    </div>
@endif

@if($site_global_settings->setting_site_maintenance_mode == \App\Setting::SITE_MAINTENANCE_MODE_ON)
    <div id="maintenance-mode-box">
        <div class="row mb-1">
            <div class="col-12 pl-0">
                <a id="maintenance-mode-close" class="btn btn-warning text-white rounded" data-toggle="collapse" href="#maintenance-mode-content" role="button" aria-expanded="false" aria-controls="collapseExample">
                    <i class="fas fa-wrench"></i>
                </a>
            </div>
        </div>
        <div class="row collapse" id="maintenance-mode-content">
            <div class="col-12 pt-3 pb-3 rounded bg-warning" id="maintenance-mode-content-box">
                <p class="text-white">
                    <strong>
                        <i class="fas fa-exclamation-circle"></i>
                        {{ __('maintenance_mode.maintenance-mode-warning-title') }}
                    </strong>
                </p>
                <p class="text-white">
                    {{ __('maintenance_mode.maintenance-mode-warning') }}
                </p>
            </div>
        </div>
    </div>
@endif

<div class="site-wrap">

    {{-- nav bar --}}
    @include('frontend.partials.nav_old')

    {{-- main content --}}
    @yield('content')

    {{-- footer --}}
    @include('frontend.partials.footer_old')
</div>

<script async src="{{ asset('frontend/vendor/pace/pace.min.js') }}"></script>

<script src="{{ asset('frontend/js/jquery-3.5.1.min.js') }}"></script>
<script src="{{ asset('frontend/js/jquery-migrate-3.0.1.min.js') }}"></script>
<script src="{{ asset('frontend/js/popper.min.js') }}"></script>
<script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>

<script src="{{ asset('frontend/vendor/rateyo/jquery.rateyo.min.js') }}"></script>

<script src="{{ asset('frontend/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('frontend/js/jquery.stellar.min.js') }}"></script>

<script src="{{ asset('frontend/js/main.js') }}"></script>

@if(is_demo_mode() || $site_global_settings->setting_site_maintenance_mode == \App\Setting::SITE_MAINTENANCE_MODE_ON)
<script src="{{ asset('frontend/vendor/js-cookie/js.cookie.js') }}"></script>
@endif

<script>

    jQuery.event.special.touchstart = {
        setup: function( _, ns, handle ){
            this.addEventListener("touchstart", handle, { passive: true });
        }
    };

    $(document).ready(function(){

        "use strict";

        @if(is_demo_mode())

        if(Cookies.get('demo_box_show') == undefined)
        {
            console.log("initial set true");
            Cookies.set('demo_box_show', true);
        }

        if(Cookies.get('demo_box_show') == "true")
        {
            console.log(Cookies.get('demo_box_show'));
            console.log("show box");
            $("#demo-purchase-content").collapse('show');
        }

        $('#demo-purchase-close').on('click', function(){

            if($("#demo-purchase-content").is(":visible"))
            {
                console.log("set to false");
                Cookies.set('demo_box_show', false);
            }
            if($("#demo-purchase-content").is(":hidden"))
            {
                console.log("set to true");
                Cookies.set('demo_box_show', true);
                console.log(Cookies.get('demo_box_show'));

            }
        });

        @endif

        @if($site_global_settings->setting_site_maintenance_mode == \App\Setting::SITE_MAINTENANCE_MODE_ON)

        if(Cookies.get('maintenance_mode_box_show') == undefined)
        {
            console.log("initial set true");
            Cookies.set('maintenance_mode_box_show', true);
        }

        if(Cookies.get('maintenance_mode_box_show') == "true")
        {
            console.log(Cookies.get('maintenance_mode_box_show'));
            console.log("show box");
            $("#maintenance-mode-content").collapse('show');
        }

        $('#maintenance-mode-close').on('click', function(){

            if($("#maintenance-mode-content").is(":visible"))
            {
                console.log("set to false");
                Cookies.set('maintenance_mode_box_show', false);
            }
            if($("#maintenance-mode-content").is(":hidden"))
            {
                console.log("set to true");
                Cookies.set('maintenance_mode_box_show', true);
                console.log(Cookies.get('maintenance_mode_box_show'));

            }
        });

        @endif
    });
</script>

@yield('scripts')

@if($site_global_settings->setting_site_footer_enabled == \App\Setting::SITE_FOOTER_ENABLED)
    {!! $site_global_settings->setting_site_footer !!}
@endif

</body>
</html>


