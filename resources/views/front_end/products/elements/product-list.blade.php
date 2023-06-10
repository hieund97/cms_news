@foreach ($products as $product)
    <div class="col-md-3 col-6 px-0 ">
        <div class="m-1 border d-flex align-content-between h-98 ">
            @include('front_end.partials.products.product',["product"=>$product])
        </div>
    </div>
@endforeach    
