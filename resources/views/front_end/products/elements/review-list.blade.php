<div id="testimonial-list">

    @if(!empty($reviews))
        @foreach($reviews as $review)
            {{--            @php--}}
            {{--                dd($review->getDiscussionHasApproved());--}}
            {{--            @endphp--}}
            <div class="mb-4">
                <div>
                    <span class="font-weight-bold text-capitalize">{{$review->full_name}}</span>
                </div>
                <div class="mb-1">
                    <p class="">
                        <span class="rate-star-product-list mr-2">
                            @for($i = 1;$i<=5;$i++)
                                <i class="fas fa-star {{$i <= $review->rating?'selected':''}}"></i>
                            @endfor
                        </span>
                        <i style="white-space: pre-wrap;word-break: break-all">{!! $review->body !!}</i>
                    </p>
                </div>
                <div class="row">
                    @if(!empty($review->file))
                        @foreach($review->file as $file)
                            <div class="col-md-3">
                                <img class="w-100" src="{{$file}}" alt="{{$review->name.$loop->index}}">
                            </div>
                        @endforeach
                    @endif
                </div>
                <div class="mb-1">
                    <span>
                        <i class="fas fa-heart text-danger"></i>
                        Sẽ giới thiệu sản phẩm này cho bạn bè, người thân
                    </span>
                </div>
                <div>
                    <div class="discussion-form{{ $review->id }}">
                        <a
                            href="javascript:void(0)"
                            class="text-decoration-none"
                            onclick="showInputDiscussion({{ $review->id }});"
                        >Thảo luận
                        </a>
                    </div>

                    {{--<span>•</span>--}}
                    {{--<a href="#" class="text-decoration-none">--}}
                    {{--    <i class="fas fa-thumbs-up"></i>--}}
                    {{--    Hữu ích--}}
                    {{--</a>--}}
                </div>
                <div id="discussion{{ $review->id }}" style="display: none">
                    @if($review->getDiscussionHasApproved->count() > 0)
                        @include('front_end.products.elements.discussion-list', ['discussions' => $review->getDiscussionHasApproved])
                    @endif
                    <form
                        action=""
                        class="ml-4"
                        id="discussion-submit{{ $review->id }}"
                        data-id="{{ $review->id }}"
                        onsubmit="submitDiscussion(event)"
                    >
                        <input
                            type="hidden"
                            name="review_id"
                            value="{{ $review->id }}"
                            class="review_id{{ $review->id }}"
                        >
                        <div class="mt-3">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-12 mb-2 mb-lg-0 mb-md-0">
                                    <div>
                                        <textarea
                                            name="body"
                                            onkeydown="$('.count-text-body-review').html($(this).val().length)"
                                            id=""
                                            cols="30"
                                            rows="4"
                                            class="textarea-body rounded-top d-block w-100 h-auto px-1 py-1"
                                            placeholder="Nhập thảo luận về sản phẩm (tối thiểu 40 ký tự)"
                                            style=""
                                        ></textarea>
                                        <div
                                            class="file_img rounded-bottom d-flex justify-content-between px-2 py-2"
                                            style=""
                                        >
                                            <div>
                                                <span class="count-text-body-review">0</span>
                                                /
                                                <span>40</span>
                                            </div>
                                        </div>
                                        <small id="body_div_alert" class="text-danger"></small>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="row">
                                        <div class="col-lg-6 px-lg-1 pb-lg-1 mb-2 mb-lg-0 mb-md-0">
                                            <input
                                                type="text"
                                                class="form-control"
                                                name="full_name"
                                                placeholder="Họ tên"
                                            >
                                            <small id="full_name_div_alert" class="text-danger"></small>
                                        </div>
                                        <div class="col-lg-6 px-lg-1 pb-lg-1 mb-2 mb-lg-0 mb-md-0">
                                            <input
                                                type="text"
                                                class="form-control"
                                                name="phone_number"
                                                placeholder="Số điện thoại"
                                            >
                                            <small id="phone_number_div_alert" class="text-danger"></small>
                                        </div>
                                        <div class="col-lg-6 px-lg-1 pb-lg-1 mb-2 mb-lg-0 mb-md-0">
                                            <input type="text" class="form-control" name="email" placeholder="Email">
                                            <small id="email_div_alert" class="text-danger"></small>
                                        </div>
                                        <div class="col-lg-6 px-lg-1 pb-lg-1 mb-2 mb-lg-0 mb-md-0">
                                            <button
                                                type="submit"
                                                class="btn btn-primary btn-block text-uppercase font-size-16px"
                                            >Gửi thảo luận
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        @endforeach
        @if ($reviews instanceof \Illuminate\Pagination\LengthAwarePaginator )
            {{ $reviews->links() }}
        @endif
    @endif

</div>
@push('scripts')
    <script>
        function showInputDiscussion(reviewId) {
            $('#discussion' + reviewId).css('display', 'block')
            $('.discussion-form' + reviewId)
                .html('<a href="javascript:void(0)" class="text-decoration-none" onclick="hideInputDiscussion(' + reviewId + ');">Thảo luận</a>')
        }

        function hideInputDiscussion(reviewId) {
            $('#discussion' + reviewId).css('display', 'none')
            $('.discussion-form' + reviewId)
                .html('<a href="javascript:void(0)" class="text-decoration-none" onclick="showInputDiscussion(' + reviewId + ');">Thảo luận</a>')
        }

        function submitDiscussion(e) {
            e.preventDefault()
            var reviewId = e.target.dataset.id
            var formdata = new FormData($('#discussion-submit' + reviewId)[0])
            console.log(formdata)
            insertDataDiscussion(formdata, reviewId)

        }

        function resetFormDiscussion(reviewId) {
            $('#discussion' + reviewId).css('display', 'none')
            $('.review_id' + reviewId).val(reviewId)
            $('#discussion-submit' + reviewId + ' textarea[name="body"]').val('')
            $('#discussion-submit' + reviewId + ' input[name="full_name"]').val('')
            $('#discussion-submit' + reviewId + ' input[name="phone_number"]').val('')
            $('#discussion-submit' + reviewId + ' input[name="email"]').val('')
            $('.count-text-body-review').text('0')
        }

        function insertDataDiscussion(formdata, reviewId) {
            $.ajax({
                url: '{{route('submitDiscussion')}}',
                data: formdata,
                dataType: 'json',
                type: 'post',
                processData: false,
                contentType: false,
                success: function (data) {
                    if (data.success == 1) {
                        alert('Thảo luận của bạn sẽ được hệ thống kiểm duyệt. Xin cám ơn.')
                        resetFormDiscussion(reviewId)
                        $('.discussion-form' + reviewId)
                            .html('<a href="javascript:void(0)" class="text-decoration-none" onclick="showInputDiscussion(' + reviewId + ');">Thảo luận</a>')
                    }
                },
                error: function (err) {
                    if (err.status == 422) {
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
                    }
                }
            })
        }
    </script>
@endpush
