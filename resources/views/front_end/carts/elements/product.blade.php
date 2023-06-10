<p class="text-color-cart-blue">Giỏ hàng</p>
<div class="bg-white">
    @foreach ($cartCollection as $item)
    <div class="px-2 py-2 border-bottom">
        <div class="">
            <p class="text-color-cart-blue font-weight-bold mb-1">{{ $loop->index + 1 }}. {{$item->name}} </p>
            <div class="row">
                <div class="col-md-4">
                    <div class="pl-lg-4 py-lg-2 px-md-3 py-4 px-4">
                        <img class="w-100" src="{{ $item->attributes['picture'] }}" alt="{{$item->name}}">
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="px-2 py-2 px-lg-4 py-lg-4">
                        <div class="border-bottom pb-3">
                            <!--<div class="d-flex justify-content-between">
                                <p class="text-gray mb-0">Độ dày</p>
                                <p class="text-color-blue mb-0">19cm</p>
                            </div> 
                            <div class="d-flex justify-content-between">
                                <p class="text-gray mb-0">Kích thước</p>
                                <p class="text-color-blue mb-0">160x200mm</p>
                            </div>-->
                            <div class="d-flex justify-content-between">
                                <p class="text-gray mb-0">Giá tiền </p>
                                <p class="text-color-blue mb-0">{{ $item->quantity  }} x @money($item->price)</p>
                            </div>
                        </div>
                        <div class="mt-2">
                            <div class="d-flex justify-content-between align-items-center">
                                <p class="text-gray mb-0">Số lượng</p>
                                <div
                                    class="detail-cart btn-group btn-group-lg border border-choose-type-payment-active rounded"
                                    role="group" aria-label="Basic example">
                                    <button type="button" class="btn btn-default" onclick="removeCart('{{ route('fe.cart.destroy', ['id' => $item->id]) }}')"><i class="fa fa-trash"></i></button>
                                    <input class="btn btn-default input-cart" data-id={{$item->id }} type="number" min="1" value="{{ $item->quantity  }}" />
                                    <button type="button" class="btn btn-default increment-item"><i class="fa fa-plus fa-1"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    @endforeach
    <div class=" px-2 py-2">
        <div class="d-flex justify-content-between">
            <p class="text-gray mb-0">Thành tiền </p>
            <p class="text-danger mb-0">@money(\Cart::getTotal())</p>
        </div>
    </div>
</div>