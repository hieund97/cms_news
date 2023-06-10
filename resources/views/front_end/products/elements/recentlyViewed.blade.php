
<li class="aticle-box px-1">
    <a
        href="{{ Route('fe.product',["slug"=>$product->slug,"id"=>$product->id]) }}"
        class="article-items "
        data-s="0"
    >
        <div>
            <div class="heightlabel d-flex justify-content-end">
                <label class="installment " style="{{!empty($product->sale_percent)?'':' opacity: 0;'}}"><b>{{ !empty($product->sale_percent)?$product->sale_percent:0 }}</b></label>
            </div>

            <img
                width="210" height="210"
                class="lazyOwl"
                alt="{{ $product->name }}"
                src="{{ (!empty($product->productMedias)) ? $product->productMedias:asset(config('admin.image_not_found')) }}"
            >
            <div class="description-content">
                @if(\Route::is('fe.product'))
                    <p class="text-dark font-size-14px px-2 overflow-hidden mb-0 product-slide-h3">{{ $product->name }}</p>
                @else
                    <h3>{{ $product->name }}</h3>
                @endif
                <div class="props px-2">
                    <p class="pro-status">{{ __($product->label_status) }}</p>
                    <p class="pro-status">{{ $product->status_note }}</p>
                    @if($product->include_in_box)
                        <p class="pro-status">
                            <span>Quà tặng: Có</span>
                        </p>
                    @endif
                </div>
            </div>
        </div>

        <div class="price pro-price">
            <strong>@money($product->real_price)</strong>
            @if($product->is_sale)
                <span class="price-fr">
                    @money($product->price)
                </span>
            @endif
        </div>
    </a>
</li>
