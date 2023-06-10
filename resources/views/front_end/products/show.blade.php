@extends('front_end.layouts.app')
@if(!empty($product->seo->schema))
@section('seo_schema')
    {!! $product->seo->schema !!}
@endsection
@endif
@section('breadcrumbs')
{{Breadcrumbs::view('breadcrumbs::json-ld', 'fe.product',$product)}}
@stop
@section('content')
    <section class="container pb-2">
        {{ Breadcrumbs::view('front_end.partials.breadcrumbs','fe.product',$product) }}
        <div>
            <h1 class="pb-2 line-height-1-2">{{ $product->name }}</h1>
        </div>
        <!-- Thông tin chi tiết  -->
        <div class="row">
            <div class="col-lg-5">
                <div class="border white-bg text-center">
                    <img
                        id="zoom"
                        class="img-fluid pro-img-detail img-main"
                        src="{{ (!empty($product->productMedias[0])) ? get_image_url($product->productMedias[0]->url, ''):asset(config('admin.image_not_found'))}}"
                    >
                </div>
                <div class="colorandpic mt-2">
                    <ul id="list-pro-img" class="tabscolor owl-carousel owl-theme">
                        @foreach ($product->productMedias as $item)
                            <li>
                                <div>
                                    <img
                                        class="onclick"
                                        alt="{{ $product->name.'_'.$loop->index }} "
                                        data-urlImage="{{ get_image_url($item->url, '') }}"
                                        src="{{ get_image_url($item->url, 'thumb') }}"
                                    >
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-lg-4 px-3 px-md-3 px-lg-0">
                <div class="border white-bg">
                    <div class="border-bottom mx-2 mb-2">
                        <div class="row pro-detail-price">
                            <div class="col col-md-12 col-sm-6">
                                <strong class="strong-price">
                                    @money($product->getRealPriceAttribute()) @if(!empty($product->salePercent()))
                                        | {{ $product->salePercent()}} @endif
                                </strong>

                            </div>
                            <div class="col col-md-12 col-sm-6">
                                @if($product->isSale())
                                    <span>
                                        @money($product->price)
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="border mx-2 mb-2">
                        <div class="row py-2 px-2">
                            <div class="col-md-6">
                                SKU : {{ $product->skus }}
                            </div>
                            <div class="col-md-6">
                                Mã sản phẩm kho: {{ $product->serial }}
                            </div>
                            <div class="col-md-6">
                                Kho : {{ __($product->labelStatus()) }}
                            </div>
                            <div class="col-md-6">
                                Bảo hành: {{ $product->warranty }}
                            </div>
                        </div>
                    </div>
                    @if(!empty($product->technical_specification))
                        <div class="border mx-2 mb-2 area-tech-specifications">
                            <strong>THÔNG SỐ KỸ THUẬT</strong>
                            <div class="m-1 body-content">
                                {!! $product->technical_specification !!}
                            </div>
                        </div>
                    @endif
                    <div class="d-flex align-items-center mb-2 mx-2">
                        <p class="mb-0 mr-1">Số lượng:</p>
                        <div class="detail-cart btn-group btn-group-sm border mr-1" role="group" aria-label="Basic example">
                            <button type="button" class="btn btn-default border-right" onclick="calcNumberProductToCart('minus')"><i class="fas fa-minus"></i></button>
                            <input class="btn btn-default max-width-40px" id="number-product-to-cart" type="text" min="1" value="1">
                            <button type="button" class="btn btn-default increment-item border-left" onclick="calcNumberProductToCart('plus')"><i class="fa fa-plus fa-1"></i></button>
                        </div>
                        <a href="#" class="btn btn-sm btn-default border-choose-type-payment-active" id="add-number-product-to-cart" data-id="{{$product->id}}"><i class="fas fa-cart-plus"></i>  Thêm vào giỏ hàng</a>
                    </div>

                    <div class="mx-2 mb-2">
                        <div class="area_order area_orderM">
                            @if($product->getRealPriceAttribute()==0)
                                <a
                                    target="_blank"
                                    rel="nofollow"
                                    href="{{ $mainSettings["buy_contact"] }}"
                                    class="buy_now"
                                    data-value="{{ $product->id }}"
                                ><b class="h3">Liên hệ</b>
                                </a>

                            @else
                                <a
                                    id="mua-ngay"
                                    href="javascript:void(0);"
                                    class="buy_now add-to-card"
                                    data-value="{{ $product->id }}"
                                ><b>Mua ngay</b>
                                    <span>Giao hàng tận nơi hoặc nhận tại cửa hàng</span>
                                </a>
                                <!--<div class="d-flex justify-content-between">
                                    <a
                                        id="tra-gop"
                                        class="buy_repay btn-installment-purchase"
                                        href="javascript:void(0);"
                                    ><b>Mua trả góp 0%</b>
                                        <span>Thủ tục đơn giản</span>
                                    </a>
                                    <a class="buy_repay btn-installment-purchase" href="javascript:void(0);"><b>Trả góp
                                                                                                                0% qua
                                                                                                                thẻ</b>
                                        <span>Visa, Master, JCB</span>
                                    </a>
                                </div> -->
                            @endif
                        </div>
                    </div>
                    @if($product->include_in_box)
                        <aside class="promotion_wrapper">
                            <b id="promotion_header">
                                <i class="fa fa-gift" aria-hidden="true"></i>
                                ƯU ĐÃI & QUÀ TẶNG</b>
                            <div class="khuyenmai-info">
                                <!-- CTKM chung -->
                                <div class="kmChung">
                                    <div class="pack-detail">
                                        @foreach ($product->include_in_box as $item)
                                            <p>{{ $item }}</p>
                                        @endforeach
                                    </div>
                                </div>

                            </div>
                        </aside>
                    @endif
                </div>
            </div>
            <div class="col-lg-3 d-none d-sm-block">
                <div class="border p-1 bg-white">
                    <div class="adr box box-delivery-policies">
                        <div class="header">
                            <p class="h4 proxy-title mb-0"><strong>CHÍNH SÁCH BÁN HÀNG</strong></p>
                        </div>
                        <div class="body">

                            <div class="adr list" id="delivery_policies_list">
                                @if(!empty($mainSettings['policy_sell_product']))
                                    <?php echo htmlspecialchars_decode($mainSettings['policy_sell_product']); ?>
                                @else
                                    <div class="item">
                                        <div class="icon">
                                            <i class="adr huge icon truck"></i>
                                        </div>
                                        <div class="text">Giao hàng toàn quốc, hỗ trợ thanh toán khi nhận hàng COD</div>
                                    </div>
                                    <div class="item ">
                                        <div class="icon">
                                            <i class="adr huge icon location2"></i>
                                        </div>
                                        <div class="text"><strong>FREE</strong> Ship Hà Nội &amp; HCM bán kính 10 Km
                                        </div>
                                    </div>
                                    <div class="item ">
                                        <div class="icon">
                                            <i class="adr huge icon box"></i>
                                        </div>
                                        <div class="text">Đổi trả hàng trong 7 ngày. Bảo hành 12 tháng.</div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="adr box box-delivery-policies">
                        <div class="header">
                            <p class="h4 proxy-title mb-0"><strong>CHÍNH SÁCH ĐỔI TRẢ</strong></p>
                        </div>
                        <div class="body">
                            <div class="adr list" id="delivery_policies_list">
                                @if(!empty($mainSettings['policy_exchange']))
                                    <?php echo htmlspecialchars_decode($mainSettings['policy_exchange']); ?>
                                @else
                                    <ul>
                                        <li class="text">Đổi trả theo nhu cầu khách hàng</li>
                                        <li class="text">Đổi trả theo yếu tố khách quan</li>
                                        <li class="text">Hàng giao bị bể vỡ, sai nội dung hoặc bị thiếu</li>
                                        <li class="text">Hàng giao bị lỗi ký thuật</li>
                                    </ul>
                                @endif
                            </div>
                        </div>
                    </div>
                    @if($product->banner)
                        <div  class="mb-2">
                            <img
                                class="w-100"
                                src="{{ get_image_url($product->banner,'default') }}"
                                alt="{{ $product->title }} banner"
                            >
                        </div>
                @endif
                <!--<img class="img-fluid" src="theme/front_end/images/demo/sp1.png">-->
                </div>
            </div>
        </div>
        <!-- Hết Thông tin chi tiết  -->

        <!-- Sản phẩm cho tương tự-->
        <div class="pt-2 bg-white mx-0 mx-0 mt-1">
            <nav>
                <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                @if(!$similarProducts->isEmpty())
                    <a
                        class="nav-item nav-link"
                        id="san-pham-tuong-tu-tab"
                        data-toggle="tab"
                        href="#san-pham-tuong-tu"
                        role="tab"
                        aria-controls="san-pham-tuong-tu"
                        aria-selected="false"
                    >Sản phẩm tương tự
                    </a>
                    @endif

                    @if(!$product->relates->isEmpty())
                        <a
                            class="nav-item nav-link"
                            id="san-pham-mua-kem-tab"
                            data-toggle="tab"
                            href="#san-pham-mua-kem"
                            role="tab"
                            aria-controls="san-pham-mua-kem"
                            aria-selected="true"
                        >Sản phẩm mua kèm
                        </a>
                    @endif
   
                    @if(!empty($recentlyViewed))
                        <a
                            class="nav-item nav-link"
                            id="san-pham-da-xem-tab"
                            data-toggle="tab"
                            href="#san-pham-da-xem"
                            role="tab"
                            aria-controls="san-pham-da-xem"
                            aria-selected="false"

                        >Sản phẩm đã xem
                        </a>
                    @endif
                </div>
            </nav>

            <div class="tab-content" id="nav-tabContent">
                <div
                    class="tab-pane fade"
                    id="san-pham-tuong-tu"
                    role="tabpanel"
                    aria-labelledby="san-pham-tuong-tu-tab"
                >
                    <ul class="product-list-detail border-blue homeproduct item2020 homepromo owl-carousel owl-theme">
                        @foreach ($similarProducts as $item)
                            @include('front_end.partials.products.product_slider',['product'=>$item, 'id'=>1 ,'rel'=>''])
                        @endforeach
                    </ul>
                </div>

                @if(!$product->relates->isEmpty())
                    <div
                        class="tab-pane fade show"
                        id="san-pham-mua-kem"
                        role="tabpanel"
                        aria-labelledby="san-pham-mua-kem-tab"
                    >
                        <ul class="product-list-detail border-blue homeproduct item2020 homepromo owl-carousel owl-theme">
                            @foreach ($product->relates as $item)
                                @include('front_end.partials.products.product_slider',['product'=>$item, 'id'=>0 ,'rel'=>'nofollow'])
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div
                    class="tab-pane fade"
                    id="san-pham-da-xem"
                    role="tabpanel"
                    aria-labelledby="san-pham-da-xem-tab"
                    data-product-history=""
                >

                    <ul class="product-list-detail border-blue homeproduct item2020 homepromo owl-carousel owl-theme mb-0">
                        @if(!empty($recentlyViewed))
                            @foreach ($recentlyViewed as $item)
                                @include('front_end.products.elements.recentlyViewed',['product'=>$item, 'id'=>2])
                            @endforeach
                        @endif
                    </ul>
                    <div class="d-flex flex-row-reverse mt-1 pb-1">
                        <button class="btn btn-secondary" id="recently-viewed">Xóa lịch sử đã xem</button>
                    </div>

                </div>

            </div>

        </div>
        <!-- Hết sản phẩm tương tự-->

        <!-- Content -->
        <div class="row py-2 mx-0 mx-0">
            <div class="col-12 col-md-9 pl-md-0 pl-lg-0 px-0 pr-md-3 pr-lg-3">
                <div class="row">
                    <div class="col-12  pt-0">
                        <div id="owl-detail" class="owl-custom owl-carousel owl-theme position-relative bg-white">
                            @foreach ($product->realImages as $item)
                                <div class="item">
                                    <img
                                        src="{{ get_image_url($item->url, 'slider_pro') }}"
                                        class="w-100 d-block"
                                        alt="{{ $product->name.' tính năng '. $loop->index }}"
                                    />
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @if($product->description)
                    <div class="w-100">
                        <div class="d-inline-block position-relative mt-0 mb-5 px-0 px-lg-0 px-md-3 py-1 bg-white w-100">
                            <div id="description_show_more"  class="overflow-hidden body-content" >
                                {!! $product->description !!}
                            </div>
                            <p class="show-more d-none">
                                <a id="xem-them-bai-viet" href="javascript:void(0)" class="readmore">Đọc thêm</a>
                            </p>

                        </div>
                    </div>
                @endif
                @if($product->videos->count()>0)
                    <div class="row bg-white mx-0 mb-2">
                        <div class="module video-related w-100">
                            <div class="left">
                                <p class="p-header">Các video đánh giá sản phẩm</p>
                            </div>
                            <div class="clear"></div>
                            <ul class="cols py-2 video-slider homeproduct item2020 homepromo owl-carousel owl-theme">
                                @foreach ($product->videos as $item)
                                    <li>
                                        <div
                                            class="img-section"
                                            data-toggle="modal"
                                            data-target="#exampleModal"
                                            data-id="{{ $item->video_id }}"
                                        >
                                            <a
                                                rel="nofollow"
                                                data-featherlight="iframe"
                                                data-featherlight-iframe-allowfullscreen="true"
                                                data-featherlight-iframe-width="500"
                                                data-featherlight-iframe-height="281"

                                            >
                                                <img
                                                    class="cpslazy loaded"
                                                    style="height: 155px"
                                                    data-src="https://img.youtube.com/vi/{{ $item->video_id }}/mqdefault.jpg"
                                                    data-ll-status="loaded"
                                                    src="https://img.youtube.com/vi/{{ $item->video_id }}/mqdefault.jpg"
                                                    alt="{{ $item->title }}"
                                                />
                                                <span>
                                                    <i class="fa fa-play"></i>
                                                </span>
                                            </a>
                                        </div>
                                        <div class="info-section">
                                            <h4>{{ $item->title }}</h4>
                                        </div>
                                    </li>

                                @endforeach
                            </ul>
                            <div class="clear"></div>
                        </div>
                    </div>
                @endif

                <div class="row py-2 bg-white mx-0 mb-2">
                    <div class="col-md-12 px-0">
                        <p class="text-color-blue text-uppercase h4 border-bottom">Đánh giá</p>
                        <div>
                            @include('front_end.products.elements.review',['product'=>$product])
                        </div>
                    </div>
                </div>
                @if($product->getReviewHasApproved->count()>0)
                    <div class="row py-2 bg-white mx-0 mb-5 position-relative">
                        <div class="col-md-12">
                            @include('front_end.products.elements.review-list',['reviews'=>$product->getReviewHasApproved])
                        </div>
                        <div class="position-absolute show-more-review-btn" style="">
                            <a
                                rel="nofollow"
                                href="{{route('fe.product.review',['slug'=>$product->slug,'id'=>$product->id])}}"
                                class="btn btn-light btn-outline-primary"
                            >Xem thêm đánh giá
                            </a>
                        </div>
                    </div>
                @endif

                <div class="row py-2 bg-white mx-0 mb-2">
                    <div class="col-md-12 px-0">
                        <p class="text-color-blue text-uppercase h4 border-bottom">Bình luận</p>
                        <div
                            class="fb-comments"
                            data-width="100%"
                            data-href="{{route('fe.product',['slug'=>$product->slug,'id'=>$product->id])}}"
                            data-width=""
                            data-numposts="5"
                        ></div>
                    </div>
                </div>

            </div>
            @if($product->posts->count() > 0)
                <div class="col-md-3 px-0 bg-white">
                    <div class="btn btn-default bg-blue d-flex text-nowrap text-white">
                        Bài viết liên quan
                    </div>
                    <div class="pt-2">
                        @foreach ($product->posts as $post)
                            <div class="col-md-12 border-bottom pb-1 mb-1">
                                <div class="row">
                                    <div class="col-6 pl-0 pr-1">
                                        <a
                                            href="{{ route('fe.post',["slug"=>$post->slug,'id'=>$post->id]) }}"
                                            class="w-100"
                                        >
                                            <img
                                                src="{{ get_image_url($post->thumbnail,'featured') }}"
                                                class="w-100 d-block"
                                                alt="{{ $post->title }}"
                                            >
                                        </a>
                                    </div>
                                    <div class="col-6 px-1">
                                        <h3 class="news-widget">
                                            <a
                                                href="{{ route('fe.post',["slug"=>$post->slug,'id'=>$post->id]) }}"
                                                class="text-decoration-none text-dark"
                                            >{{ $post->title }}</a>
                                        </h3>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
        <!-- Content -->
        @include('front_end.products.elements.modal')
    </section>
@endsection
@include('front_end.partials.js.show_more')
@push('scripts')
    <script
        type="text/javascript"
        src="https://cdn.rawgit.com/igorlino/elevatezoom-plus/1.1.6/src/jquery.ez-plus.js"
    ></script>
    <script
        type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"
    ></script>

    <script>

        $(document).ready(function () {

            function zoomImage() {
                if (screen.width > 768) {
                    $('#zoom').ezPlus()
                }
            }

            zoomImage()
            $('.onclick').on('click', function (e) {
                var src = $(this).attr('data-urlImage')
                $('.img-main').attr('src', src)
                $('.zoomContainer').remove()
                zoomImage()

            })


            $('.img-section').on('click', function () {
                var video_id = $(this).attr('data-id')
                $('#video-iframe').attr('src', 'https://www.youtube.com/embed/' + video_id)

            })
            $('#nav-tab a:first-child ').tab('show') // Select first tab

            $('#recently-viewed').on('click', function () {
                $.removeCookie('{{ $cookieProduct }}');
                location.reload();
            })
            $('.product-list-detail').owlCarousel({
                loop: false,
                //margin: 10,
                nav: true,
                lazyLoad: true,
                dots: false,
                autoHeight: true,
                responsive: {
                    0: {
                        items: 2,
                        slideBy: 2
                    },
                    600: {
                        items: 3,
                        slideBy: 3
                    },
                    1000: {
                        items: 5,
                        slideBy: 4
                    }
                }
            })

            $('#list-pro-img').owlCarousel({
                loop: false,
                //margin: 10,
                nav: true,
                lazyLoad: true,
                dots: false,
                responsive: {
                    0: {
                        items: 4
                    },
                    600: {
                        items: 4
                    },
                    1000: {
                        items: 4
                    }
                }
            })

            $('#owl-detail').owlCarousel({
                loop: true,
                //margin: 10,
                nav: true,
                items: 1
            })

            $('.video-slider').owlCarousel(
                {
                    loop: false,
                    margin: 5,
                    nav: true,
                    lazyLoad: true,
                    dots: false,
                    responsive: {
                        0: {
                            items: 2,
                            slideBy: 1
                        },
                        600: {
                            items: 3,
                            slideBy: 1
                        },
                        1000: {
                            items: 3,
                            slideBy: 1
                        }
                    }
                }
            )

            // Add to cart
            $('.add-to-card').click(function (e) {
                e.preventDefault()
                let id = $(this).attr('data-value');
                let count = parseInt($("#number-product-to-cart").val());
                if(!isNaN(count)){
                    addToCart(id,count,true);
                }
            })
        })
        function addOneProductToCart(){
            var productId = {{ $product->id }};
            $.ajax({
                url: "{{ route('fe.cart.add') }}",
                type: 'POST',
                data: {productId: productId},
                success: function (data) {
                    $('.total-cart').html('(' + data + ')')
                    Toast.fire({
                        type: 'success',
                        title: '{{__('Add item to cart successfully')}}'
                    })
                    window.location.href = "{{route('fe.cart')}}"
                }
            })
        }
        $('.btn-installment-purchase').matchHeight();
        $("#number-product-to-cart").inputmask('integer',{min:1, max:100});
        function calcNumberProductToCart(type){
            let numberProduct = parseInt($('#number-product-to-cart').val());
            if(!isNaN(numberProduct)){
                if(type == 'minus' && numberProduct != 1){
                    numberProduct--;
                }else if(type == 'plus'){
                    numberProduct++;
                }
            }else{
                numberProduct = 1;
            }
            $('#number-product-to-cart').val(numberProduct);
        }
        function addToCart(productId,countItem,redirect){
            $.ajax({
                url: "{{ route('fe.cart.add') }}",
                type: 'POST',
                data: {
                    productId: productId,
                    countItem:countItem
                },
                success: function (data) {
                    $('.total-cart').html('(' + data + ')')
                    Toast.fire({
                        type: 'success',
                        title: '{{__('Add item to cart successfully')}}'
                    })
                    if(redirect){
                        window.location.href = "{{route('fe.cart')}}"
                    }
                }
            })
        }
        $("#add-number-product-to-cart").on('click',function(e){
            e.preventDefault();
            let id = $(this).attr('data-id');
            let count = parseInt($("#number-product-to-cart").val());
            if(!isNaN(count)){
                addToCart(id,count,false);
            }
        });
        $(document).on('change','#number-product-to-cart',function(e){
            let number = parseInt($(this).val());
            if(isNaN(number) || number == 0){
                $(this).val(1);
            }
        })
        // $('.description-content').matchHeight()
    </script>
@endpush
