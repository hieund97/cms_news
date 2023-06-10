@if($product)
    <a class="pro-thumbnail py-1" href="{{ Route('fe.product',["slug"=>$product->slug,"id"=>$product->id]) }}">
        <div class="heightlabel" style="height: 18px">
            <label class="installment mr-1 mb-1" style="height: 100%">
                <b>{{ $product->salePercent() }}</b>
            </label>
        </div>
        <div class="img-event px-1 fix-height-img">
            @if(!empty($feature))
                <img
                    class="img-fluid"
                    alt="{{ $product->name }}"
                    src="{{ (!empty($product->feature_img)) ? get_image_url($product->feature_img, ''):'/preview-icon720x333.png' }}"
                >
            @else
                <img
                    class="img-fluid"
                    src="{{ (!empty($product->productMedias[0])) ? get_image_url($product->productMedias[0]->url, 'default'):asset(config('admin.image_not_found')) }}"
                    alt="{{ $product->name }}"
                />
            @endif
        </div>
        <div class="fix-height caption card-body px-2">
            <h3 class="pro-name">
                {{ $product->name }}
            </h3>
            <p class="pro-status">
                <span>{{ __($product->labelStatus()) }}</span>
            </p>
            <p class="pro-status">
                <span>{{ $product->status_note }}</span>
            </p>
            @if($product->include_in_box)
                <p class="pro-status">
                    <span>Quà tặng: Có</span>
                </p>
            @endif
        </div>
        <div class="row pro-price p-2 price-bt">
            <div class="col col-xs-6 col-md-6">
                <strong class="text-nowrap">
                    @money($product->getRealPriceAttribute())
                </strong>
            </div>
            <div class="col col-xs-6 col-md-6 text-lg-right pr-0">
                @if($product->isSale())
                    <span>
                        @money($product->price)
                    </span>
                @endif
            </div>
        </div>
    </a>
@endif

