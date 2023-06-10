@extends('front_end.layouts.app')
@section('content')
    <section id="card" class="container d-flex flex-column">
        <div class="py-4">
            <a href="{{ url()->previous() }}" class="text-decoration-none">
                <i class="fas fa-arrow-left"></i>
                Tiếp tục mua sắm
            </a>
        </div>
        <form action="{{ route('fe.cart.save') }}" method="POST" autocomplete="off" >
            @php
                $provinceId = old('address.province') ? old('address.province'):'';
                $districtId = old('address.district') ? old('address.district'):'';
                $wardId     = old('address.ward')     ? old('address.ward'):'';
                $paymentMethod = old('payment_method')     ? old('payment_method'):'cod';
            @endphp
            <div class="row mb-3">
                <div class="col-md-12 col-lg-7 order-2 order-lg-1 ">

                    @csrf
                        <div class="bg-white px-2 py-2 mb-4">
                            <p class="h5 text-uppercase font-weight-bold text-color-cart-blue d-flex align-items-center pt-3 pb-1 ml-1">
                                <span
                                    class="payment-main-title bg-color-blue d-flex align-items-center justify-content-center mr-2 text-light ">1</span>
                                HÌNH THỨC THANH TOÁN
                            </p>
                            <div class="d-flex flex-column py-sm-1 px-lg-5 py-lg-4">
                                @foreach (config('admin.payment_method') as $key=>$value)
                                    <div class="choose-type-payment-cart-select">
                                        <label class="container-a mb-0 border @if($paymentMethod==$key) border-choose-type-payment-active @endif rounded py-3 mb-2">
                                            <p class="mb-0 font-size-16px" >{{ $value }}</p>
                                            <input type="radio" value="{{ $key }}" @if($paymentMethod==$key) checked="checked" @endif name="payment_method">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="bg-white px-2 py-2 mb-4">
                            <p class="h5 font-weight-bold text-uppercase text-color-cart-blue d-flex align-items-center pt-3 pb-1 ml-1">
                                <span
                                    class="payment-main-title bg-color-blue d-flex align-items-center justify-content-center mr-2 text-light ">2</span>
                                THÔNG TIN KHÁCH HÀNG
                            </p>
                            <div class="d-flex flex-column py-sm-1 px-lg-5 py-lg-4">
                                <div class="form-group">
                                    <label for="">Họ tên *</label>
                                    <input required value="{{ old('customer_name') }}" type="text" class="form-control @error('customer_name') is-invalid @enderror" name="customer_name" placeholder="Họ tên *">
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Email *</label>
                                            <input required value="{{ old('customer_email') }}" autocomplete="off" type="text" class="form-control" name="customer_email" placeholder="Email *">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Số điện thoại *</label>
                                            <input required value="{{ old('customer_mobile') }}" autocomplete="off" type="text" class="form-control" name="customer_mobile" placeholder="Số điện thoại *">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <p class="h5 font-weight-bold text-uppercase text-color-cart-blue d-flex align-items-center pt-3 pb-1 ml-1">
                                <span
                                    class="payment-main-title bg-color-blue d-flex align-items-center justify-content-center mr-2 text-light ">3</span>
                                ĐỊA CHỈ NHẬN HÀNG
                            </p>
                            <div class="d-flex flex-column py-sm-1 px-lg-5 py-lg-4">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Chọn tỉnh/thành phố</label>
                                            <select required name="address[province]" id="province_id" class="form-control">
                                                @include('partials.forms.province',['provinceId'=>$provinceId])
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Chọn quận/huyện</label>
                                            <select name="address[district]" id="district_id" class="form-control">
                                                @include('partials.forms.district',['provinceId'=>$provinceId,'districtId'=>$districtId])
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Chọn phường/xã</label>
                                            <select name="address[ward]" id="ward_id" class="form-control">
                                                @include('partials.forms.ward',['districtId'=>$districtId,'ward_id'=>$wardId])
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Địa chỉ cụ thể *</label>
                                            <input value="{{ old('address.address') }}" required type="text" class="address form-control" name="address[address]" placeholder="Địa chỉ *">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Ghi chú</label>
                                            <textarea name="customer_note" cols="20" class="form-control" rows="7"
                                                    placeholder="Ghi chú">{{ old('customer_note') }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <input type="hidden" name="address[country]" value="Việt Nam">
                                        <button class="btn btn-danger btn-block">Hoàn tất mua sắm</button>

                                        <span class="error invalid-feedback" style="display: block" role="alert">
                                            @if($errors->any())
                                                {!! implode('', $errors->all('<p>:message</p>')) !!}
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                </div>
                <div class="col-md-12 col-lg-5 order-1 order-lg-2 mb-3" id="main-cart">
                    @include('front_end.carts.elements.product',["cartCollection"=>$cartCollection])
                </div>
            </div>
        </form>
    </section>
@endsection
@push('scripts')
    @include('front_end.carts.elements.remove')
    @include('partials.js.locations')
    <script>
        $(document).on('click', '.choose-type-payment-cart-select', function () {
            $('.choose-type-payment-cart-select').children().removeClass('border-choose-type-payment-active')
            if (!$(this).children().hasClass('border-choose-type-payment-active')) {
                $(this).children().addClass('border-choose-type-payment-active')
            };
        });

        $(document).on('click', '.increment-item', function (e) {
            var parent = $( this ).parent().closest('.detail-cart');
            var input  = parent.find(".input-cart");
            input.val( function(i, oldval) {
                return parseInt( oldval, 10) + 1;
            });
            input.trigger( "change" );
        });

        $(document).on('change', '.input-cart', function (e) {
           e.preventDefault();
           var ele = $(this);
            $.ajax({
               url: "{{ route('fe.cart.update') }}",
               method: "put",
               data: {
                    productId: ele.attr("data-id"),
                    quantity: ele.val(),
                },
               success: function (response) {
                  $('#main-cart').html(response);
               }
            });
        });

    </script>
@endpush
