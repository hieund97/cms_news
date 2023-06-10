<!DOCTYPE html>
<html lang="vi">
<head>
    {!! meta()->toHtml() !!}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" href="{{asset('theme/favicon.ico')}}" />
    @stack('styles')
    <script>
        var csrf_token = '{{ csrf_token() }}'
    </script>
    <link
        rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk"
        crossorigin="anonymous"
    >
    <link rel="stylesheet" href="{{ asset('theme/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/front_end/css/main.css') }}" />
    <script
        src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"
    ></script>
    <!-- Bootstrap 4 -->
    <script type="text/javascript" src="{{ asset('theme/front_end/plugins/jquery.lazy/jquery.lazy.min.js') }}">
    </script>
    <script
        async
        defer
        crossorigin="anonymous"
        src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v9.0&appId=396875184759137&autoLogAppEvents=1"
        nonce="NweKZRYj"
    ></script>

    <script>
        $(function () {
            $('.lazy').Lazy()
        })
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })
    </script>

    @if(!empty($mainSettings['header']))
        {!! $mainSettings['header'] !!}
    @endif
    @yield('breadcrumbs')
    @yield('seo_schema')

</head>

<body>
    <div id="fb-root"></div>
    <div class="main-wrapper bg-white overflow-hidden">
        <div id="wrapper" style="">
            <div class="header-overlay"></div>
            @include('front_end.partials.header')
            @yield('content')
            @include('front_end.partials.footer')
            @include('front_end.partials.contact_fast')
            @stack('footer')
        </div>
    </div>

<!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">
    <link
        rel="stylesheet" type="text/css"
        href="{{ asset('theme/plugins/owl-carousel/css/owl.carousel.min.css') }}"
    />
    <link
        rel="stylesheet" type="text/css"
        href="{{ asset('theme/plugins/owl-carousel/css/owl.theme.default.min.css') }}"
    />
    <script type="text/javascript" src="{{ asset('theme/front_end/js/jquery.matchHeight-min.js') }}"></script>
    <script
        type="text/javascript"
        src="{{ asset('theme/front_end/plugins/inputmask/jquery.inputmask.bundle.min.js')}}"
    ></script>
    <script type="text/javascript" src="{{ asset('theme/plugins/owl-carousel/js/owl.carousel.min.js') }}">
    </script>
    <script src="{{ asset('theme/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- Toastr -->
    <script src="{{ asset('theme/plugins/toastr/toastr.min.js') }}"></script>
    <script src="{{ asset('theme/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    @include('partials.toast')
    @stack('scripts')

    @if(!empty($mainSettings['footer']))
        {!! $mainSettings['footer'] !!}
    @endif

</body>

</html>
