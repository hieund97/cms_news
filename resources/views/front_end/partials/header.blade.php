@auth
    <div class="container-fluid">
        <div class="row my-2 justify-content-center align-items-center">
            <div class="col-12">
                <div class="d-flex justify-content-center">
                    <a class="mx-2" href="{{ route('products.create') }}">{{ __('Product create') }} <a>
                            |
                            <a class="mx-2" href="{{ route('product_categories.index') }}">{{ __('product_categories.index') }}
                                <a>
                                    |
                                    <a class="mx-2" href="{{ route('posts.create') }}">{{ __('Post create') }} <a>
                                            |
                                            <a class="mx-2" href="{{ route('categories.index') }}">{{ __('categories.index') }}
                                                <a>
                </div>
            </div>
        </div>
    </div>
@endauth
<button class="btn btn-default d-none" id="btn-open-menu-bar-mobile">
    <i class="fas fa-bars"></i>
</button>
<div class="d-block" id="navbar-header-mobile">
    @if($mainMenus)
        <ul class="navbar-nav navbar-nav-list">
            @foreach($mainMenus as $menu)
                <li class="nav-item @if( $menu['child']) sub-menu-parent @endif">
                    <a
                        class="nav-link @if( $menu['child']) btn-open-submenu-mobile @endif"
                        href="{{ $menu['link'] }}"
                    >{{ $menu['label'] }}
                        @if( $menu['child'])
                            <i class="ml-2 fas fa-angle-right"></i>
                        @endif
                    </a>
                    @include('front_end.partials.sub-menu-mobile',["menu"=>$menu])
                </li>
            @endforeach
        </ul>
    @endif
</div>
<header id="main-header">
    <div class="navbar-scroll-mobile position-fixed container-fluid mx-0 px-0 d-flex d-md-flex row d-lg-none">
        <div class="position-relative w-100" style="background-color: #fff">
            <div class="mx-0 py-2 row px-3 z-index-3">
                <div class="col-2 d-flex align-items-center justify-content-start pl-0">
                    <a href="{{ route('fe.home') }}" class="d-flex justify-content-start w-100">
                        <img
                            src="{{ asset('theme/front_end/images/logo-mobile.png') }}"
                            alt="Chungauto logo mobile scroll"
                            class=""
                            style="object-fit:fill;height: 37px;width: 40px"
                        >
                    </a>
                </div>
                <div class="d-flex align-items-center col-5 px-0 justify-content-center">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-phone-alt mr-2 header-color-red font-size-28px"></i>
                        <span class="content">
                            <p class="m-0 d-none d-md-block d-lg-block text-dark">Hotline:</p>
                            <a
                                href="tel:{{ $mainSettings["hotline"] }}"
                                class="text-decoration-none header-color-red font-weight-bold font-size-16px"
                            >{{ $mainSettings["hotline"] }}</a>
                        </span>
                    </div>
                </div>
                <div class="col-5 pr-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <a rel="nofollow" href="javascript:void(0)" class="d-table open-search-mobile-bar rounded">
                            <i class="fas fa-search text-gray-dark font-size-18px header-color-blue"></i>
                        </a>
                        <a
                            href="{{route('fe.cart')}}"
                            class="position-relative col-2 col-md-3 btn btn-default d-flex justify-content-center  justify-content-md-end align-items-center"
                        >
                            <i class=" fas fa-shopping-cart header-color-blue font-size-32px mr-2"></i>
                            <span class="position-absolute text-white total-cart" style="top: 12%; left: 10%">
                                @if(!\Cart::isEmpty())({{ \Cart::getTotalQuantity() }})@endif</span>
                        </a>
                        <button
                            id="open-menubar-mobile"
                            class=" col-2 col-md-3 btn btn-default d-flex justify-content-center justify-content-md-start align-items-center"
                        >
                            <i class="fas fa-bars font-size-32px  header-color-blue"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="position-absolute w-100 ne-z-index-1 search-menu-mobile-scroll px-3">
                <form
                    action="{{ route('fe.search.index') }}" method="GET"
                    class="box-main__form-search form-inline my-lg-0 py-1 position-relative" autocomplete="off"
                >
                    <div class="input-group w-100">
                        <input
                            class="form-control mr-sm-2 input-search border-radius-12px border-color-blue input-search-global"
                            name="q"
                            type="text"
                            placeholder="Bạn cần tìm gì..."
                            aria-label="Search"
                            value="{{ request('q') }}"
                        >
                        <button
                            class="btn btn-default my-sm-0 position-absolute icon-search border-left-color-blue rounded-0"
                            style="right: 0"
                            type="submit"
                        >
                            <i class="fas fa-search header-color-blue"></i>
                        </button>
                    </div>
                    <div
                        class="col-md-12 box-search-result search-autocomplete"
                        style="display: none; top: 46px !important;"
                    >
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="first-row d-flex align-content-center container-fluid text-light py-1 justify-content-center flex-column flex-lg-row flex-md-column">
        <div class="row w-100 mx-0 first-row-content-box container d-none d-md-none d-lg-flex">
            <div class="col-md-3 px-0 image-box h-100">
                <a href="{{ route('fe.home') }}" class="d-flex justify-content-center w-100">
                    <img
                        src="{{ asset('theme/front_end/images/logo-scroll.png') }}" alt="Chungauto logo pc"
                        class="h-100 w-100" style="object-fit:none;background:#000000"
                    >
                </a>
            </div>
            <div class="center col-md-6 col-sm-9 d-flex justify-content-between w-50 align-items-center">
                <a href="{{route('fe.cart')}}" class="btn btn-default btn-outline-light d-table cart-desktop d-flex">
                    <div class="d-table">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-shopping-cart mr-2"></i>
                            <p class="content m-0">

                                <strong class="text-danger total-cart">
                                    @if(!\Cart::isEmpty())({{ \Cart::getTotalQuantity() }})@endif</strong>

                                Giỏ hàng</p>
                        </div>
                    </div>
                </a>
                <div class="d-table">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-phone-alt mr-2" style="font-size: 24px"></i>
                        <span>
                            <p class="content m-0">Hotline:
                                <a
                                    href="tel:{{ $mainSettings["hotline"] }}"
                                    class="text-light text-decoration-none"
                                >{{ $mainSettings["hotline"] }}</a>
                            </p>
                        </span>
                    </div>
                </div>
                <div class="d-table ">
                    <a
                        href="{{ $mainSettings["shop_list_url"] }}"
                        class="text-light text-decoration-none d-flex align-items-center"
                    >
                        <i class="fas fa-map-marker-alt mr-2" style="font-size: 24px"></i>
                        Tìm cửa hàng
                    </a>
                </div>
            </div>
            @include('front_end.partials.social-icon')
        </div>
        <div class="w-100 mx-0 first-row-content-box d-flex d-md-flex d-lg-none d-xl-none align-items-center row">
            <div class=" col-2 col-md-3 d-flex justify-content-center justify-content-md-start align-items-center pl-0">
                <button id="open-menubar-mobile" class="btn btn-default btn-outline-light">
                    <i class="fas fa-bars font-size-32px  header-color-blue"></i>
                </button>
            </div>
            <div class="col-8 col-md-6 d-flex align-items-center justify-content-center">
                <a href="{{ route('fe.home') }}" class="d-flex justify-content-center">
                    <img
                        src="{{ asset('theme/front_end/images/logo.png') }}" alt="Chungauto logo mobile"
                        class="w-100" style="object-fit:cover"
                    >
                </a>
            </div>
            <a
                href="{{route('fe.cart')}}"
                class="position-relative btn-outline-light col-2 col-md-3 btn btn-default d-flex justify-content-center pr-0 justify-content-md-end align-items-center"
            >
                <i class="fas fa-shopping-cart header-color-blue font-size-32px"></i>
                <span class="position-absolute text-white total-cart" style="top: 12%; left: 50%">
                    @if(!\Cart::isEmpty())({{ \Cart::getTotalQuantity() }})@endif</span>
            </a>
        </div>
        <div class="d-block d-md-block d-lg-none position-relative search-top">
            <form
                action="{{ route('fe.search.index') }}" method="GET"
                class="box-main__form-search form-inline my-2 my-lg-0 py-1 " autocomplete="off"
            >
                <div class="input-group w-100">
                    <input
                        class="form-control mr-sm-2 input-search border-color-blue border-radius-12px input-search-global"
                        name="q"
                        type="text"
                        placeholder="Bạn cần tìm gì..."
                        aria-label="Search"
                        value="{{ request('q') }}"
                    >
                    <button
                        class="btn btn-default my-sm-0 position-absolute icon-search border-left-color-blue rounded-0"
                        style="right: 0"
                        type="submit"
                    >
                        <i class="fas fa-search header-color-blue"></i>
                    </button>
                </div>
                <div
                    class="search-bottum col-md-12 box-search-result search-autocomplete"
                    style="display: none; top: 50px !important;"
                >
                </div>
            </form>
        </div>
        <div class="d-flex row d-md-flex d-lg-none">
            <div class="d-flex align-items-center col-4">
                <i class="fas fa-phone-alt mr-2 header-color-red" style="font-size: 19px"></i>
                <span class="content">
                    <p class="m-0 d-none d-md-block d-lg-block text-dark">Hotline:</p>
                    <a
                        href="tel:{{ $mainSettings["hotline"] }}"
                        class="text-decoration-none font-size-12px header-color-red font-weight-bold"
                    >{{ $mainSettings["hotline"] }}</a>
                </span>
            </div>
            <div class="d-flex col-4 px-0 justify-content-center">
                <a
                    href="{{ $mainSettings["shop_list_url"] }}"
                    class="text-dark text-decoration-none d-flex align-items-center"
                >
                    <i class="fas fa-map-marker-alt mr-2 header-color-blue" style="font-size: 18px"></i>
                    <span class="font-size-12px header-color-blue font-weight-bold">Tìm cửa hàng</span>
                </a>
            </div>
            <div id="box-header-icon-social" class="d-flex align-items-center justify-content-between col-4">
                <a rel="nofollow" target="_blank" href="{{ $mainSettings["facebook_url"] }}">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a rel="nofollow" target="_blank" href="{{ $mainSettings["youtube_url"] }}">
                    <i class="fab fa-youtube"></i>
                </a>
                <a rel="nofollow" target="_blank" href="{{ $mainSettings["twitter_url"] }}">
                    <i class="fab fa-twitter"></i>
                </a>
                <a rel="nofollow" target="_blank" href="{{ $mainSettings["instagram_url"] }}">
                    <i class="fab fa-instagram"></i>
                </a>
            </div>
        </div>
    </div>
    <nav class="navbar navbar-expand-lg container-fluid navbar-header d-none d-sm-none d-md-none d-lg-flex d-xl-flex">
        <div class="container d-lg-flex d-md-flex justify-content-center">
            <div class="image-logo-mobile mt-3">
                <a href="{{ route('fe.home') }}">
                    <img
                        src="{{ asset('theme/front_end/images/logo.png') }}"
                        alt="Chungauto logo"
                        class=" h-100"
                    >
                </a>
            </div>
            <div class="collapse navbar-collapse " id="navbar-header-desktop">
                @if($mainMenus)
                    <ul class="navbar-nav mr-auto">
                        @foreach($mainMenus as $menu)
                            <li class="nav-item @if( $menu['child']) btn-dropdown position-relative @endif">
                                <a class="nav-link" href="{{ $menu['link'] }}">{{ $menu['label'] }} @if($menu['child'])
                                        <i class="fas fa-angle-right"></i>
                                    @endif</a>
                                @include('front_end.partials.sub-menu-pc',["menu"=>$menu])
                            </li>
                        @endforeach
                    </ul>
                @endif
                <div class="position-relative">
                    <form
                        action="{{ route('fe.search.index') }}" method="GET"
                        class="box-main__form-search form-inline my-2 my-lg-0 py-1" autocomplete="off"
                    >
                        <div class="input-group d-flex align-items-center">
                            <input
                                class="form-control mr-sm-2 input-search input-search-global" name="q" type="text"
                                placeholder="Bạn cần tìm gì..." aria-label="Search" value="{{ request('q') }}"
                            >
                            <button class="btn btn-default py-0 my-sm-0 position-absolute icon-search" type="submit">
                                <i class="fas fa-search text-gray-dark"></i>
                            </button>
                        </div>
                        <div
                            class="col-md-12 box-search-result search-autocomplete"
                            style="display: none;"
                        >
                        </div>
                    </form>
                </div>
            </div>
            <div class="w-100 search-box-mobile mt-3">
                <div class="position-relative">
                    <form
                        class="form-inline my-2 my-lg-0" action="{{ route('fe.search.index') }}" method="GET"
                        autocomplete="off"
                    >
                        <div class="input-group">
                            <input
                                class="form-control mr-sm-2 input-search w-100" type="search"
                                placeholder="Bạn cần tìm gì..." aria-label="Search" value="{{ request('q') }}" name="q"
                            >
                            <button class="btn btn-default my-sm-0 position-absolute icon-search" type="submit">
                                <i class="fas fa-search text-gray-dark"></i>
                            </button>
                        </div>

                    </form>
                </div>
            </div>
            <div class="sub-memu-2-mobile my-3 w-100">
                <div class="d-flex hot-line border-right col-6">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-phone-alt mr-2" style="font-size: 24px"></i>
                        <span class="content">
                            <p class="m-0 d-none d-md-block d-lg-block">Hotline:</p>
                            <a
                                href="tel:{{ $mainSettings["hotline"] }}"
                                class="text-dark text-decoration-none"
                            >{{ $mainSettings["hotline"] }}</a>
                        </span>
                    </div>
                </div>
                <div class="d-flex col-6">
                    <a
                        href="{{ $mainSettings["shop_list_url"] }}"
                        class="text-dark text-decoration-none d-flex align-items-center"
                    >
                        <i class="fas fa-map-marker-alt mr-2" style="font-size: 24px"></i>
                        Tìm cửa hàng
                    </a>
                </div>
            </div>
        </div>
    </nav>
</header>
@push('scripts')
    <script>
        $(document).ready(function () {
            $(document).on('click', '.open-search-mobile-bar', function (e) {
                e.preventDefault()
                $('.search-menu-mobile-scroll').toggleClass('active')
            })
            $(document).on('click', '#open-menubar-mobile,#btn-open-menu-bar-mobile', function (e) {
                e.preventDefault()
                var scroll = $(window).scrollTop()
                if (scroll > 10) {
                    $('html, body').animate({ scrollTop: 0 }, 'slow')
                }
                $('#wrapper').toggleClass('transform-toggle-navbar').attr('data-abc').html('a')
            })

            $(document).on('click', '#main-header, section , footer', function (e) {
                if ($('#wrapper').hasClass('transform-toggle-navbar')) {
                    $('#wrapper').removeClass('transform-toggle-navbar')
                }
            })
            $(document).on('click', '.btn-open-submenu-mobile', function (e) {
                e.preventDefault()
                $(this).next().toggleClass('d-block')
                $(this).next().toggleClass('open-submenu')
            })
            $(document).on('click', '.btn-clone-submenu-mobile', function (e) {
                e.preventDefault()
                $(this).parent().toggleClass('d-block')
                $(this).parent().toggleClass('open-submenu')
            })
            $('#navbar-header-desktop .btn-dropdown,#navbar-header-desktop .dropdown').hover(
                function () {
                    $('>.dropdown-menu', this).stop(true, true).fadeIn('fast')
                    $(this).addClass('open')
                },
                function () {
                    $('>.dropdown-menu', this).stop(true, true).fadeOut('fast')
                    $(this).removeClass('open')
                })
        })
    </script>
    <script defer="">
        var searchRequest = null
        $(document).ready(function () {
            var minlength = 3
            $('.input-search-global').keyup(function () {
                var that = this,
                    value = $(this).val()

                if (value.length >= minlength) {
                    if (searchRequest != null) {
                        searchRequest.abort()
                    }
                    searchRequest = $.ajax({
                        type: 'GET',
                        url: "{{ route('fe.search.suggest') }}",
                        data: {
                            'q': value,
                        },
                        dataType: 'text',
                        success: function (msg) {
                            //we need to check if the value is the same
                            if (value == $(that).val()) {
                                //jQuery('.search-autocomplete').html(msg)
                                //jQuery('.search-autocomplete').show();
                                console.log($(that))
                                $(that).parent().next().show().html(msg)
                            }
                        },
                    })
                }
            })

            $('.input-search-global').on('focus', function () {
                $('.header-overlay').addClass('active')
                $('.search-top').addClass('z-index-31');
                $('.search-autocomplete').show()
            });
            $('.header-overlay').on('click',function () {
                $('.header-overlay').removeClass('active')
                $('.search-autocomplete').hide()
                $('.search-top').removeClass('z-index-31')
                $('.search-autocomplete').hide()
            });
            $('.input-search-global').on('input', function () {
                if (this.value === '') {
                    $('.search-autocomplete').hide()
                } else {
                    $('.search-autocomplete').show()
                }
            })

        })
        $(document).ready(function () {
            $(window).scroll(function () {
                var y = $(this).scrollTop()
                if (y > 148) {
                    $('.navbar-header').addClass('active-fixed-header')
                } else {
                    $('.navbar-header').removeClass('active-fixed-header')
                }
                let headerHeight = $('#main-header .first-row').height()
                if (y > headerHeight) {
                    $('.navbar-scroll-mobile').addClass('active')
                } else {
                    $('.search-menu-mobile-scroll').removeClass('active')
                    $('.navbar-scroll-mobile').removeClass('active')
                }
            })
        })
    </script>
@endpush
