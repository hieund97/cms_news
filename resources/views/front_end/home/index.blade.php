@extends('front_end.layouts.app')
@if(!empty($mainSettings['seo_schema']))
@section('seo_schema')
{!! $mainSettings['seo_schema'] !!}
@endsection
@endif

@section('content')
<section id="card" class="container pb-2">
    <!-- Hero sliders  -->
    @if(!$sliders->isEmpty() || !$banners->isEmpty() )
    <div class="row pt-3">
        <div class="col-md-8 pr-3 pr-md-0 pr-lg-0 header-top pb-2">
            @include('front_end.home.elements.slider',["sliders"=>$sliders])
        </div>
        <div class="col-md-4 px-3 px-md-0 px-lg-0 header-top d-lg-block d-md-block d-none">
            @include('front_end.home.elements.banner',["banners"=>$banners])
        </div>
    </div>
    @endif
    <!-- Hết Hero sliders  -->
    <!-- Thương hiệu-->
    @if(!$brands->isEmpty())
    <div class=" py-2 trademark-slider item2020 homepromo owl-carousel owl-theme">
        @foreach ($brands as $item)
        <div class="p-1">
            <a href="{{ $item->link }}" @if($item->rel) rel="{{ $item->rel }}" @endif>
                <img class="img-fluid rounded img-thumbnail" src="{{ $item->thumbnail }}" alt="{{ $item->text }}">
            </a>
        </div>
        @endforeach
    </div>
    @endif
    <!-- Hết Thương hiệu -->

    <!-- Textlink -->
    @if(!$productTypes->isEmpty())
    <div class=" py-2 text-slider homeproduct item2020 homepromo owl-carousel owl-theme">
        @foreach ($productTypes as $item)
        <div class="px-1 ">
            <a href="{{ $item->link }}" @if($item->rel) rel="{{ $item->rel }}"
                @endif class="link-slider btn btn-default border d-flex justify-content-center align-items-center"
                style="height: 62px"
                >
                {!! $item->text !!}
            </a>
        </div>
        @endforeach
    </div>
    @endif
    <!-- Hết Textlink-->
    <!-- Sản phẩm khuyến mãi-->
    <div class="row py-2">
        <div class="col-md col-sm-12">
            <div class="btn btn-default bg-red d-flex text-nowrap justify-content-center text-white">
                SẢN PHẨM KHUYẾN MẠI HOT NHẤT
            </div>
        </div>
    </div>
    <div class="row py-2 bg-white view-group mx-0 mb-2">
        @foreach ($saleProducts as $saleProduct)
        <div class="col-md-3 col-6 px-0 ">
            <div class="m-1 border d-flex align-content-between flex-wrap h-98">
                @include('front_end.partials.products.product',["product"=>$saleProduct, "feature"=>false])
            </div>
        </div>
        @endforeach
    </div>
    <!-- Hết Sản phẩm khuyến mãi-->
    <!-- Sản phẩm cho danh mục-->
    @foreach ($categories as $item)
    @include('front_end.home.elements.category',['item'=>$item,"products"=>$products])
    @endforeach
    <!-- Hết phẩm cho danh mục-->
    <!-- Tin tức-->
    @include('front_end.home.elements.post',['posts'=>$posts,"expPosts"=>$expPosts])
    <!-- Hết tin tức-->
</section>
@endsection
@push('scripts')
<script>
    $( document ).ready(function() {
        $('.header-top').matchHeight();
        $('.text-slider').owlCarousel(
            {
                loop: true,
                //margin:1,
                nav: true,
                lazyLoad: true,
                dots: false,
                responsive: {
                    0: {
                        items: 2,
                        slideBy: 1
                    },
                    500: {
                        items: 3,
                        slideBy: 2
                    },
                    768: {
                        items: 4,
                        slideBy: 2
                    },
                    1000: {
                        items: 7,
                        slideBy: 2
                    }
                }
            }
        );

        $('.home-slider').owlCarousel({
                loop: true,
                //margin:10,
                nav: true,
                lazyLoad: true,
                dots: false,
                autoplay: true,
                autoplayTimeout: 3000,
                autoplayHoverPause: true,
                responsive: {
                    0: {
                        items: 2,
                        slideBy: 2
                    },
                    600: {
                        items: 3,
                        slideBy: 2
                    },
                    1000: {
                        items: 5,
                        slideBy: 2
                    }
                }
            });
            $('.trademark-slider').owlCarousel(
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
                        },
                        600: {
                            items: 3,
                            slideBy: 1
                        },
                        1000: {
                            items: 6,
                            slideBy: 1
                        }
                    }
                }
            );
    });
</script>
<script>
    $(document).ready(function () {
            // Popup
            var key = 'hadModal',
                hadModal = localStorage.getItem(key),
                expiredTime = 0
            if (hadModal) {
                expiredTime = Date.now() - (hadModal +  60 * 60 * 1000)
            }
            

            @if(!empty($mainSettings['is_popup']) && $mainSettings['is_popup']==1 && !empty($mainSettings['popup']))
            if (expiredTime >= 0) {
                @if(empty($mainSettings['popup_start']))
                 $('#notifyModalCenter').modal('show');
                @else 
                var popup_start = {{ $mainSettings['popup_start'] }};
                setTimeout(function () {
                    $('#notifyModalCenter').modal('show')

                }, popup_start)
                
                @endif
                @if(!empty($mainSettings['popup_time']))
                var popup_time = {{ $mainSettings['popup_time'] }};
                setTimeout(function () {
                    $('#notifyModalCenter').modal('hide')
                    localStorage.setItem(key, Date.now())

                }, popup_time)
                @endif
            }

            $('#notifyModalCenter').on('hidden.bs.modal', function () {
                localStorage.setItem(key, Date.now())
            })

            @endif
            // Hết popup


        })
        
        
</script>
@endpush
@push('footer')
@if(!empty($mainSettings['is_popup']) && $mainSettings['is_popup']==1 && !empty($mainSettings['popup']))
<!-- Modal -->
<div class="modal fade" id="notifyModalCenter" tabindex="-1" role="dialog" aria-labelledby="notifyModalCenterTitle"
    aria-hidden="true" data-time="2">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {!! $mainSettings['popup'] !!}
            </div>
        </div>
    </div>
</div>
<!-- End Modal -->
@endif
@endpush