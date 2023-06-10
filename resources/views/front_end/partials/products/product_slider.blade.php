<li class="aticle-box px-1">
    <a
        href="{{ Route('fe.product',["slug"=>$product->slug,"id"=>$product->id]) }}"
        class="article-items "
        data-s="0"
        @if(!empty($rel))
        rel={{$rel}}
        @endif
    >
        <div>
            <div class="heightlabel d-flex justify-content-end">
                <label class="installment" style="{{!empty($product->salePercent())?'':' opacity: 0;'}}"><b>{{!empty($product->salePercent())?$product->salePercent():'0'}}</b></label>
            </div>
            <img
                width="210" height="210"
                class="lazyOwl"
                alt="{{ $product->name }}"
                src="{{ (!empty($product->productMedias[0])) ? get_image_url($product->productMedias[0]->url, 'default'):asset(config('admin.image_not_found')) }}"
            >
            <div class="description-content">
                @if(\Route::is('fe.product'))
                    <p class="text-dark font-size-14px px-2 overflow-hidden mb-0 product-slide-h3">{{ $product->name }}</p>
                @else
                    <h3>{{ $product->name }}</h3>
                @endif
                <div class="props px-2">
                    <p class="pro-status">{{ __($product->labelStatus()) }}</p>
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
            <strong>@money($product->getRealPriceAttribute())</strong>
            @if($product->isSale())
                <span class="price-fr">
                    @money($product->price)
                </span>
            @endif
        </div>
    </a>
</li>
