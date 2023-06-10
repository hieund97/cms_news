<div id="testimonial">
    <div class="row">
        <div class="col-lg-8">
            <h3 class="mb-2 font-size-16px line-height-1-2">{{$product->reviews()->count()}} đánh
                                                                                             giá {{$product->name}}</h3>
        </div>
        <div class="col-lg-4">
            <form class="" onsubmit="return false;">
                <div class="d-flex align-items-center border rounded px-2">
                    <i class="fas fa-search pl-1"></i>
                    <input class="form-control border-0" type="text" placeholder="Tìm theo nội dung đánh giá">
                </div>
            </form>
        </div>
    </div>
    <div class="mb-3 box_btn_show_hide_form_review mt-3">
        <button class="btn btn-primary" onclick="showInputRating();">Gửi đánh giá của bạn</button>
    </div>
    <form style="display: none" action="" id="form_testimonial">
        <input type="hidden" name="rating" value="" class="rating_count">
        <input type="hidden" name="product_id" value="{{$product->id}}" class="product_id">
        <div class="d-flex align-content-lg-center align-items-md-center align-items-start flex-md-row flex-lg-row flex-column">
            <span class="mr-2">Chọn đánh giá của bạn</span>
            <div class="d-flex flex-row mt-3 mt-md-0 mt-lg-0">
                <span class="rate-star-product">
                    <i class="fas fa-star fa-2x" data-id="1" data-title="Không thích"></i>
                    <i class="fas fa-star fa-2x" data-id="2" data-title="Tạm được"></i>
                    <i class="fas fa-star fa-2x" data-id="3" data-title="Bình thường"></i>
                    <i class="fas fa-star fa-2x" data-id="4" data-title="Rất tốt"></i>
                    <i class="fas fa-star fa-2x" data-id="5" data-title="Tuyệt vời quá"></i>
                </span>
                <span class="rate-star-title" style="display: none">

                </span>
            </div>
        </div>
        <small id="rating_div_alert" class="text-danger"></small>
        <div class="mt-3">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-12 mb-2 mb-lg-0 mb-md-0">
                    <div>
                        <textarea
                            name="body"
                            onkeydown="$('.count-text-body-review').html($(this).val().length)"
                            id=""
                            cols="30"
                            rows="8"
                            class="textarea-body rounded-top d-block w-100 h-auto px-1 py-1"
                            placeholder="Nhập đánh giá về sản phẩm (tối thiểu 80 ký tự)"
                            style=""
                        ></textarea>
                        <div class="file_img rounded-bottom d-flex justify-content-between px-2 py-2" style="">
                            <div>
                                <input type="file" name="fileImg" class="d-none" id="imgInp">
                                <label class="" for="imgInp">
                                    <i class="fas fa-camera mr-2"></i>
                                    Đính kèm ảnh
                                </label>
                            </div>
                            <div>
                                <span class="count-text-body-review">0</span>
                                /
                                <span>80</span>
                            </div>
                        </div>
                        <small id="body_div_alert" class="text-danger"></small>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="row">
                        <div class="col-lg-12 px-lg-1 pb-lg-1 mb-1 mb-lg-0 mb-md-0">
                            <input type="text" class="form-control" name="full_name" placeholder="Họ tên">
                            <small id="full_name_div_alert" class="text-danger"></small>
                        </div>
                        <div class="col-lg-6 px-lg-1 pb-lg-1 mb-1 mb-lg-0 mb-md-0">
                            <input type="text" class="form-control" name="phone_number" placeholder="Số điện thoại">
                            <small id="phone_number_div_alert" class="text-danger"></small>
                        </div>
                        <div class="col-lg-6 px-lg-1 pb-lg-1 mb-1 mb-lg-0 mb-md-0">
                            <input type="text" class="form-control" name="email" placeholder="Email">
                            <small id="email_div_alert" class="text-danger"></small>
                        </div>
                        <div class="col-lg-12 px-lg-1 pb-lg-1 mb-1 mb-lg-0 mb-md-0">
                            <div>
                                {!! app('captcha')->display($attributes = [ 'data-type' => 'audio'], $options = ['lang'=> 'vi']) !!}

                            </div>
                            <small id="captcha_div_alert" class="text-danger"></small>

                        </div>
                        <div class="col-lg-6 px-lg-1 pb-lg-1 mb-1 mb-lg-0 mb-md-0">
                            <button type="submit" id="btn-review" class="btn btn-primary btn-block text-uppercase">Gửi
                                                                                                                   đánh
                                                                                                                   giá
                            </button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div>
            <div class="row mt-4" id="image_review_render">

            </div>
        </div>
    </form>
</div>
@push('scripts')
    <script>
        function showInputRating() {
            $('#form_testimonial').css('display', 'block')
            $('.box_btn_show_hide_form_review')
                .html('<button class="btn btn-dfault btn-outline-dark" onclick="hideInputRating();">Đóng lại</button>')
        }

        function hideInputRating() {
            $('#form_testimonial').css('display', 'none')
            $('.box_btn_show_hide_form_review')
                .html('<button class="btn btn-primary" onclick="showInputRating();">Gửi đánh giá của bạn</button>')
        }

        $('#form_testimonial').on('submit', function (e) {
            e.preventDefault()
            var formdata = new FormData($(this)[0])
            insertdata(formdata)
        })

        function resetFormTestimonial() {
            $('#form_testimonial').css('display', 'none')
            $('.rating_count').val('')
            $('.rate-star-product i').removeClass('hover').removeClass('selected')
            $('.rate-star-title').css('display', 'none').text('')
            $('#form_testimonial textarea[name="body"]').val('')
            $('#form_testimonial input[name="full_name"]').val('')
            $('#form_testimonial input[name="phone_number"]').val('')
            $('#form_testimonial input[name="email"]').val('')
            $('.count-text-body-review').text('0')
            $('#image_review_render').html('')
        }

        function insertdata(formdata) {
            $.ajax({
                url: '{{route('submitRatingComment')}}',
                data: formdata,
                dataType: 'json',
                type: 'post',
                processData: false,
                contentType: false,
                success: function (data) {
                    if (data.success == 1) {
                        alert('Đánh giá của bạn sẽ được hệ thống kiểm duyệt. Xin cám ơn.')
                        resetFormTestimonial()
                        $('.box_btn_show_hide_form_review')
                            .html('<button class="btn btn-primary" onclick="showInputRating();">Gửi đánh giá của bạn</button>')
                    }
                },
                error: function (err) {
                    //$('#btn-review').prop('disabled', true)
                    if (err.status == 422) {
                        if ('rating' in err.responseJSON.errors) {
                            $('#rating_div_alert').text(err.responseJSON.errors.rating[0])
                        } else {
                            $('#rating_div_alert').text('')
                        }
                        if ('phone_number' in err.responseJSON.errors) {
                            $('#phone_number_div_alert').text(err.responseJSON.errors.phone_number[0])
                        } else {
                            $('#phone_number_div_alert').text('')
                        }
                        if ('email' in err.responseJSON.errors) {
                            $('#email_div_alert').text(err.responseJSON.errors.email[0])
                        } else {
                            $('#email_div_alert').text('')
                        }
                        if ('body' in err.responseJSON.errors) {
                            $('#body_div_alert').text(err.responseJSON.errors.body[0])
                        } else {
                            $('#body_div_alert').text('')
                        }
                        if ('full_name' in err.responseJSON.errors) {
                            $('#full_name_div_alert').text(err.responseJSON.errors.full_name[0])
                        } else {
                            $('#full_name_div_alert').text('')
                        }
                        if ('g-recaptcha-response' in err.responseJSON.errors) {
                            $('#captcha_div_alert').text('Vui lòng đánh dấu vào recaptcha.')
                        } else {
                            $('#captcha_div_alert').text('')
                        }
                    }
                }
            })
        }
    </script>
    <script>
        let starId
        $('.rate-star-product i').bind('mouseover', function (e) {
            e.preventDefault()
            let title = $(this).attr('data-title')
            $(this).nextAll().removeClass('hover').removeClass('selected')
            $(this).prevAll().addClass('hover').removeClass('selected')
            $(this).addClass('hover')
            $('.rate-star-title').text(title).css('display', 'block')
        }).bind('mouseleave', function (e) {
            checkRateSelectedWhenLeave()
        })

        function checkRateSelectedWhenLeave() {
            $('.rate-star-product i').removeClass('selected').removeClass('hover')
            var elementRate = $('.rate-star-product i[data-id="' + starId + '"]')
            let title = elementRate.attr('data-title')
            elementRate.addClass('selected')
            elementRate.prevAll().addClass('selected')
            if (title) {
                $('.rate-star-title').text(title)
            } else {
                $('.rate-star-title').css('display', 'none')
            }
        }

        $(document).on('click', '.rate-star-product i', function (e) {
            starId = $(this).attr('data-id')
            $('.rate-star-product i').removeClass('selected')
            $(this).addClass('selected')
            $(this).prevAll().addClass('selected')
            $('#form_testimonial input[name="rating"]').val(starId)
        })
        $('#form_testimonial input[name="phone_number"]').inputmask('Regex', {regex: '^[0-9]{1,10}(\\.\\d{1,2})?$'})

        $('#imgInp').change(function () {
            readURL(this)
        })

        function readURL(input) {
            html = ''
            if (input.files && input.files[0]) {
                var file = input.files[0]
                var formData = new FormData()
                formData.append('formData', file)
                $.ajax({
                    url: '{{route('postRatingImage')}}',  //Server script to process data
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    //Ajax events
                    success: function (data) {
                        html += '<div class="col-lg-3">'
                        html += '<div class="position-relative">'
                        html += '<span onclick="$(this).parent().parent().remove();" class="btn_remove_img position-absolute rounded rounded-circle bg-dark d-flex justify-content-center align-items-center" style="">'
                        html += '<i class="fas fa-times text-light"></i>'
                        html += '</span>'
                        html += '<img class="w-100" src="' + data.url + '" alt="">'
                        html += '</div>'
                        html += '<input type="hidden" value="' + data.url + '" name="file[]">'
                        html += '</div>'
                        $('#image_review_render').append(html)
                    }
                })
            }
        }
    </script>
@endpush
