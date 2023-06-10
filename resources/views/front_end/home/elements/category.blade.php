
@php
    $childCats = $item->homeTextLinks->take(5);
    $listProduct = [];
    foreach ($products as $product) {
        if($product->root_product_category_id==$item->id) {
            $listProduct[] = $product;
        }
    }
    $firstProduct = [];
    if(!empty($listProduct[0])){
        if($listProduct[0]->pin_to_top){
            $firstProduct = $listProduct[0];
            unset($listProduct[0]);
        }
    }
@endphp
@if($listProduct || $firstProduct )
<div class="pt-2 mt-0 bg-white mx-0 mx-0">
    <div class="navigat cate44 col pl-0">
        <a class="box-home" href="{{ route('fe.product.category',["slug"=>$item->slug,'id'=>$item->id]) }}"><h2>{{ $item->title }}</h2></a>
        <div class="viewallcat text-lg-right text-right">
            @foreach ($childCats as $textLink)
            <a href="{{ $textLink->link }}" @if(!empty($textLink->rel)) rel="{{ $textLink->rel }}" @endif>{{ $textLink->text }}</a>
            @endforeach

        </div>
    </div>
    <div class="d-lg-none d-md-none d-block px-0 border">
        @include('front_end.partials.products.product',["product"=>$firstProduct, "feature"=>true])
    </div>
    <ul class="category-slider homeproduct item2020 homepromo owl-carousel owl-theme">
        @if($firstProduct)
        <li class="feature aticle-box px-1">
            <a href="{{ Route('fe.product',["slug"=>$firstProduct->slug,"id"=>$firstProduct->id]) }}" class="article-items ">
                <div>
                    <div class="heightlabel d-flex">
                        <label class="installment" style="{{!empty($firstProduct->salePercent())?'':' opacity: 0;'}}"><b>{{!empty($firstProduct->salePercent())?$firstProduct->salePercent():'0'}}</b></label>
                    </div>
                    <div style="height: 210px;display: table">
                        <img width="430" height="210"
                             alt="{{ $firstProduct->name }}"
                             src="{{ (!empty($firstProduct->feature_img)) ? get_image_url($firstProduct->feature_img, ''):'/preview-icon720x333.png' }}">
                    </div>
                    <div class="description-content">
                        <h3>{{ $firstProduct->name }}</h3>
                        <div class="props px-2">
                            <p class="pro-status">{{ __($firstProduct->labelStatus()) }}</p>
                            <p class="pro-status">{{ $firstProduct->status_note }}</p>
                            @if($firstProduct->include_in_box)
                                <p class="pro-status">
                                    <span>Quà tặng: Có</span>
                                </p>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="price pro-price">
                    <strong>@money($firstProduct->getRealPriceAttribute())</strong>
                    @if($firstProduct->isSale())
                        <span class="price-fr">
                            @money($firstProduct->price)
                        </span>
                    @endif
                </div>
                <div class="clr"></div>
            </a>
        </li>
        <li class="feature empty-item">
        </li>
        @endif
        @foreach ($listProduct as $product)
            @include('front_end.partials.products.product_slider',['product'=>$product,'rel'=>''])
        @endforeach
    </ul>
</div>
@endif
@push('scripts')
<script>
    $(document).ready(function () {

        if(screen.width < 768 && $('.feature').length > 0) {
            $('.feature').remove()
        }
        $('.category-slider').owlCarousel({
            nav:true,
            lazyLoad:true,
            dots:false,
            responsive:{
                0:{
                    items:2,
                    slideBy:2,
                },
                600:{
                    items:3,
                    slideBy:2,
                },
                1000:{
                    items:5,
                    slideBy:2,
                }
            },
            navText : ['<i class="fa fa-chevron-left" aria-hidden="true"></i>','<i class="fa fa-chevron-right" aria-hidden="true"></i>']
        })
    })
    $('.description-content').matchHeight()
</script>
    @endpush
