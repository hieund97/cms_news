@if($productOnTop && $productOnTop->isNotEmpty())
    <div class="mb-2 bg-white border-product-hot">
        <div class="navigat cate44 col">
            <h2 class="h2-pro-popular">Sản phẩm nổi bật</h2>
        </div>
        <ul id="product_on_top" class="homeproduct item2020 homepromo owl-carousel owl-theme">
            @foreach ($productOnTop as $product)
                @include('front_end.partials.products.product_slider',['product'=>$product,'rel'=>''])
            @endforeach
        </ul>
    </div>
@endif