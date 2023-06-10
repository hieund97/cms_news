@extends('front_end.layouts.app')
@if(!empty($category->seo->schema))
@section('seo_schema')
    {!! $category->seo->schema !!}
@endsection
@endif
@section('breadcrumbs')
    {{Breadcrumbs::view('breadcrumbs::json-ld', 'fe.product.category', $category)}}
@stop

@section('content')
    <section class="container pb-2">
        {{ Breadcrumbs::render('fe.product.category',$category) }}
        <div class="">
            <h1>{{ $category->title }}</h1>
        </div>
        <!-- Hero sliders  -->
        <div class="row">
            <div class="col-md-8 pr-3 pr-md-0 pr-lg-0 header-top pb-2">
                @include('front_end.products.elements.slider',["sliders"=>$sliders])
            </div>
            <div class="col-md-4 px-3 px-md-0 px-lg-0 header-top d-lg-block d-md-block d-none">
                @include('front_end.products.elements.banner',["banners"=>$banners])
            </div>
        </div>
        <!-- Hết Hero sliders  -->
        <!-- Thương hiệu-->
        @include('front_end.products.elements.brand',['brands'=>$brands])
    <!-- Hết Thương hiệu -->

        <!-- Textlink -->
        @include('front_end.products.elements.product_type',['productTypes'=>$productTypes])

    <!-- Hết Textlink-->

        <!-- Filter -->
        @include('front_end.products.elements.filter')
    <!-- Hết Filter -->
        <!-- Sản phẩm nổi bật-->
        @include('front_end.products.elements.hot-product-category',['productOnTop'=>$productOnTop])


    <!-- Hết phẩm nổi bật-->
        <!-- Sản phẩm cho danh mục-->
        <div class="row bg-white view-group mx-0 mb-2" id="list-product-category">

        </div>
        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-center mt-3">
                    <a
                        href="javascript:void(0)"
                        class="btn-show-more-list-news rounded text-decoration-none font-weight-bold h4 btn-load-more-product"
                    >
                        Xem thêm
                    </a>
                </div>
            </div>
        </div>
        <!-- Hết Sản phẩm cho danh mục-->

        <!-- Content danh mục -->
        @if($category->description)
            <div class="d-inline-block position-relative bg-white mt-4 mb-5 px-3 py-3 border-top-danger border-bottom-danger third-list-content w-100">
                <div id="description_show_more" class="mt-4 font-weight-normal overflow-hidden">
                    {!! $category->description !!}
                </div>
                <p class="show-more d-none">
                    <a rel="nofollow" id="xem-them-bai-viet" href="javascript:void(0)" class="readmore">Đọc thêm</a>
                </p>
            </div>
    @endif
    <!-- Hết Content danh mục -->

        <!-- Tin tức-->
    @include('front_end.products.elements.post',['posts'=>$posts])
    <!-- Hết tin tức-->
    </section>
@endsection
@push('scripts')
    @include('front_end.partials.js.show_more')
    @include('front_end.partials.script-product-category',['url'=>route('fe.product.get',['id'=>$category->id]),'type'=>null])
    <script>
        $( document ).ready(function() {
        $('#product_on_top').owlCarousel({
            loop: false,
            nav: true,
            lazyLoad: true,
            dots: false,
            responsive: {
                0: {
                    items: 2,
                },
                600: {
                    items: 3
                },
                1000: {
                    items: 4
                }
            }
        });

        $('.trademark-category-slider').owlCarousel(
            {
                //loop: true,
                margin: 1,
                nav: true,
                lazyLoad: true,
                dots: false,
                responsive: {
                    0: {
                        items: 3,
                        slideBy: 1
                    },
                    768: {
                        items: 5,
                        slideBy: 1
                    },
                    1000: {
                        items: 8,
                        slideBy: 1
                    }
                }
            }
        )
        $('.text-slider').owlCarousel(
            {
                //loop: true,
                //margin:1,
                nav: true,
                lazyLoad: true,
                dots: false,
                responsive: {
                    0: {
                        items: 3,
                        slideBy: 1
                    },
                    768: {
                        items: 5,
                        slideBy: 1
                    },
                    1000: {
                        items: 8,
                        slideBy: 1
                    }
                }
            }
        )

        $('#price-slide').owlCarousel(
            {
                loop: false,
                //margin:1,
                nav: true,
                lazyLoad: true,
                dots: false,
                responsive: {
                    0: {
                        items: 3,
                        slideBy: 1
                    }
                }
            }
        )
        $('.header-top').matchHeight();
        $('.description-content').matchHeight();

    });
    </script>

@endpush
