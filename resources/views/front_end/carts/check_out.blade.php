@extends('front_end.layouts.app')
@section('content')
    <section id="checkout" class="containerd-flex flex-column">
        <div class="py-4">
            <a href="{{ route('fe.home') }}" class="text-decoration-none">
                <i class="fas fa-arrow-left"></i>
                Tiếp tục mua sắm
            </a>
        </div>
        <div class="row mb-3">
            <div class="col-md-12 col-lg-7 order-1 order-lg-1 ">
                <div class="bg-white px-2 py-2 px-lg-4 mb-4 h-100">
                    <div class="d-flex justify-content-center align-items-center pb-4 mt-5 flex-column border-bottom-dashed-dark" >
                        <div style="width: 45px;height: 45px" class="mb-3 bg-success rounded-circle d-flex justify-content-center align-items-center">
                            <i class="fas fa-check text-light fa-1x"></i>
                        </div>
                        <p class="font-weight-bold text-success mb-1">
                            Đặt hàng thành công
                        </p>
                        <p class=" mb-1">Mã đơn hàng : {{ $order->order_id }}</p>
                        <p class=" mb-1">Email xác nhận đơn hàng sẽ gửi đến bạn trong vài phút</p>
                    </div>
                    <div class="overflow-hidden">
                        <div class="row mt-4 border-bottom-dashed-dark pb-5">
                            <div class="col-md-6">
                                <p class="h5 pb-2 font-weight-bold text-uppercase border-bottom text-dark">
                                    Xác nhận thông tin
                                </p>
                                <div class="row">
                                    <div class="col-4">
                                        <p class="mb-1">Họ tên:</p>
                                    </div>
                                    <div class="col-8">
                                        <p class="mb-1">{{ $order->customer_name }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4">
                                        <p class="mb-1">Email:</p>
                                    </div>
                                    <div class="col-8">
                                        <p class="mb-1">{{ $order->customer_email }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4">
                                        <p class="mb-1">SĐT:</p>
                                    </div>
                                    <div class="col-8">
                                        <p class="mb-1">{{ $order->customer_mobile }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4">
                                        <p class="mb-1">Tỉnh/Thành:</p>
                                    </div>
                                    <div class="col-8">
                                        <p class="mb-1">{{ $order->address->provinceDetail->name }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4">
                                        <p class="mb-1">Quận/Huyện:</p>
                                    </div>
                                    <div class="col-8">
                                        <p class="mb-1">{{ $order->address->districtDetail->name }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4">
                                        <p class="mb-1">Xã/Phường:</p>
                                    </div>
                                    <div class="col-8">
                                        <p class="mb-1">{{ $order->address->wardDetail->name }}</p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-4">
                                        <p class="mb-1">Địa chỉ:</p>
                                    </div>
                                    <div class="col-8">
                                        <p class="mb-1">{{ $order->address->address}}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <p class="h5 pb-2 font-weight-bold text-uppercase border-bottom text-dark">
                                    Hình thức thanh toán
                                </p>
                                <p>{{ config('admin.payment_method')[$order->payment_method] }}</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-md-12 col-lg-5 order-2 order-lg-2">
                <div class="bg-white h-100">
                    <div class="px-4 py-2 border-bottom mb-5">
                        <div class="">
                            <p class="text-dark font-weight-bold mb-1 mt-3 pb-3 h5 border-bottom-dashed-dark text-uppercase text-center">
                                Chi tiết đơn hàng
                            </p>
                            @foreach ($order->orderProducts as $item)
                            <div class="overflow-hidden border-top-dashed-dark">
                                <p class="mb-1 text-dark font-weight-bold mt-2">{{ $loop->index + 1 }}. {{$item->product->name}}</p>
                                <div class="row">
                                    <div class="col-md-4 d-flex align-items-start">
                                        <div class="">
                                            <img class="w-100" src="{{ (!empty($item->product->productMedias[0])) ? get_image_url($item->product->productMedias[0]->url, 'default'):asset(config('admin.image_not_found')) }}" alt="{{$item->product->name}}">
                                        </div>
                                    </div>
                                    <div class="col-md-8 d-flex align-items-center">
                                        <div class="px-2 py-2 px-md-1 py-md-1 px-lg-1 py-lg-1 w-100">
                                            <div class="pb-3">

                                                <div class="d-flex justify-content-between">
                                                    <p class="text-gray mb-0">Giá tiền </p>
                                                    <p class="text-color-blue mb-0">{{ $item->amount }} x @money($item->price)</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="pt-5"></div>
                     <div class="border-top-dashed-dark border-bottom-dashed-dark">
                         <div class=" px-2 py-2">
                             <div class="d-flex justify-content-between">
                                 <p class="text-gray mb-1">Phí vận chuyển</p>
                                 <p class="text-success mb-1">Miễn phí</p>
                             </div>
                             <div class="d-flex justify-content-between">
                                 <p class="text-gray mb-0">Giá tạm tính</p>
                                 <p class="text-gr mb-0">@money($order->total_payment_price)</p>
                             </div>
                         </div>
                     </div>
                    <div class="pb-5 border-bottom-dashed-dark">
                        <div class=" px-2 py-2">
                            <div class="d-flex justify-content-between">
                                <p class="text-gray mb-1">Thành tiền</p>
                                <p class="text-danger mb-1">@money($order->total_payment_price)</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
@push('scripts')
    <script>
        $(document).on('click', '.choose-type-payment-cart-select', function () {
            $('.choose-type-payment-cart-select').children().removeClass('border-choose-type-payment-active')
            if (!$(this).children().hasClass('border-choose-type-payment-active')) {
                $(this).children().addClass('border-choose-type-payment-active')
            }
        })
    </script>
     @if(!empty($mainSettings['cart_successfull']))
        {!! $mainSettings['cart_successfull'] !!}
     @endif
@endpush
