@extends('front_end.layouts.app')
@push('styles')
    <style>
        #news-page-detail .height-lg-120px {
            height: 120px
        }
    </style>
@endpush
@if(!empty($post->seo->schema))
@section('seo_schema')
    {!! $post->seo->schema !!}
@endsection
@endif

@section('breadcrumbs')
    {{Breadcrumbs::view('breadcrumbs::json-ld', 'fe.post', $post)}}
@stop

@section('content')
    <section id="news-page-detail" class="container">
        {{ Breadcrumbs::view('front_end.partials.breadcrumbs','fe.post',$post) }}
        <h1 class="h2 font-weight-bold mb-0">{{$post->title}}</h1>
        <div class="mb-2">
            <small class="">Tác giả :{{$post->author}} | Xuất bản
                : {{\Carbon\Carbon::parse($post->created_at)->format('d/m/Y')}}</small>
        </div>
        <div class="d-flex mb-2">
            @if(!$tags->isEmpty())
                @foreach($tags as $tag)
                    <a
                        href="{{route('fe.post.tag',['slug'=>$tag->slug,'id'=>$tag->id])}}"
                        class="rounded mr-2 text-decoration-none d-inline-block px-3 text-color-blue border-color-blue-new"
                    >{{$tag->title}}</a>
                @endforeach
            @endif

        </div>
        <div class="my-3">
            <div
                class="fb-like"
                data-href="{{url()->current()}}"
                data-width=""
                data-layout="button_count"
                data-action="like"
                data-size="small"
                data-share="true"
            ></div>
        </div>
        <div class="bg-white overflow-hidden mb-3">
            <div class="row">
                <div class="col-lg-9">
                    <div class="overflow-hidden mx-2 body-content" id="post-detail-content">
                        {!!$post->content!!}
                    </div>
                    @if($productRelateds->isNotEmpty())
                    <div class="mx-2 border-top mt-2">
                        <div class="bg-color-blue py-3 d-flex justify-content-between rounded">
                            <p class="text-light mb-0 text-uppercase h6 ml-2 font-weight-bold">Sản phẩm liên quan</p>
                        </div>
                        <div class="row mt-2 mx-0 d-flex w-100" id="show_list_item_detail">
                           @foreach($productRelateds as $key => $item)
                           <div class="col-lg-3 col-md-3 px-lg-1 px-md-1 px-0 show-item-detail" @if($key>7) style="display:none" @endif >
                                <div class="border mb-1 rounded">
                                    <div class="border rounded">
                                        <a href="{{$item->link}}" @if($item->rel) rel={{ $item->rel }} @endif @if($item->target) target={{ $item->target }} @endif  class="d-block">
                                            <img
                                                class="w-100"
                                                alt="{{$item->title}}"
                                                src="{{get_image_url($item->image,'default')}}"
                                            >
                                        </a>
                                    </div>

                                    <div class="description-content pt-1 post-product-related">
                                        <a href="{{$item->link}}" @if($item->rel) rel={{ $item->rel }} @endif @if($item->target) target={{ $item->target }} @endif class="w-100 d-block font-size-14px px-2 overflow-hidden mb-0 text-color-blue text-decoration-none">{{$item->title}}</a>
                                    </div>
                                    <div class="d-flex justify-content-center mt-3 mb-1">
                                        <a href="{{$item->link}}" @if($item->rel) rel={{ $item->rel }} @endif @if($item->target) target={{ $item->target }} @endif class="btn text-white bg-color-blue border-radius-20px font-size-13px ">Xem tiếp</a>
                                    </div>
                                </div>
                            </div>
                           @endforeach
                        </div>
                        @if($productRelateds->count()>8)
                        <button id="show_more_items" class="btn mt-4 btn-block text-color-blue border-color-blue-new bg-white border-radius-12px text-uppercase py-2 h6 font-weight-bold">Xem thêm</button>
                        @endif
                    </div>
                    @endif

                    @if(!empty($randomPosts->count()>0))
                        <div class="mx-2 border-top show-more">
                            <p class="text-color-blue text-uppercase h3 mt-3">Xem thêm</p>
                            <div class="px-2 py-2 border">
                                <div id="other_posts" class="owl-carousel owl-theme position-relative">
                                    @foreach($randomPosts as $post)
                                        <div class="item">
                                            <div>
                                                <div>
                                                    <a
                                                        href="{{route('fe.post',['slug'=>$post->slug,'id'=>$post->id])}}"
                                                        class="d-flex w-100 height-lg-120px"
                                                        style=""
                                                    >
                                                        <img
                                                            class="w-100"
                                                            src="{{get_image_url($post->thumbnail,'featured')}}"
                                                            alt=""
                                                        >
                                                    </a>
                                                </div>
                                                <div class="mt-3">
                                                    <a href="{{route('fe.post',['slug'=>$post->slug,'id'=>$post->id])}}" class="mb-1 mt-3 text-decoration-none text-dark">
                                                        {{\Str::limit($post->title, 200)}}
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="mx-2 my-3">
                        <p class="text-color-blue text-uppercase h3 border-bottom">Bình luận</p>
                        <div>
                            <div
                                class="fb-comments"
                                data-width="100%"
                                data-href="{{route('fe.post',['slug'=>$post->slug,'id'=>$post->id])}}"
                                data-width=""
                                data-numposts="5"
                            ></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    @if($post->banner)
                        <div class="mb-2">
                            <img
                                class="w-100"
                                src="{{ get_image_url($post->banner,'default') }}"
                                alt="{{ $post->title }} banner"
                            >
                        </div>
                    @endif
                    @if($sameCategoryPosts->count()>0)
                        <div class="mt-md-4 mt-lg-0">
                            <p class="mb-1 h6 text-uppercase bg-color-blue text-light px-2 py-1">Cùng chủ đề</p>
                            @foreach($sameCategoryPosts as $post)
                                <div class=" border-bottom">
                                    <div class="row overflow-hidden my-3">
                                        <div class="col-lg-5 col-sm-6 col-6">
                                            <a href="{{route('fe.post',['slug'=>$post->slug,'id'=>$post->id])}}">
                                                <img class="w-100" src="{{ get_image_url($post->thumbnail,'featured') }}" alt="{{$post->title}}">
                                            </a>
                                        </div>
                                        <div class="col-lg-7 pl-lg-0 col-sm-6 col-6">
                                            <a
                                                href="{{route('fe.post',['slug'=>$post->slug,'id'=>$post->id])}}"
                                                class="text-decoration-none mb-1 text-dark"
                                            >
                                                <small class="news-detail-widget">{{$post->title}}</small>
                                            <!--<h3 class="h6 d-lg-none d-md-none d-block">{{$post->title}}</h3>-->
                                            </a>
                                        </div>
                                    </div>

                                </div>
                            @endforeach
                        </div>
                    @endif
                    <div class="mt-md-4 mt-lg-0">
                        <p class="mb-1 h6 font-weight-bold text-uppercase bg-color-blue text-light px-2 py-1">Mới & nóng</p>
                        @foreach($newPosts as $post)
                            <div class="border-bottom">
                                <div class="row overflow-hidden my-3">
                                    <div class="col-lg-5 col-sm-6 col-6">
                                        <a rel="nofollow" href="{{route('fe.post',['slug'=>$post->slug,'id'=>$post->id])}}">
                                            <img class="w-100" src="{{ get_image_url($post->thumbnail,'featured') }}" alt="{{$post->title}}">
                                        </a>
                                    </div>
                                    <div class="col-lg-7 pl-lg-0 col-sm-6 col-6">
                                        <a rel="nofollow"
                                            href="{{route('fe.post',['slug'=>$post->slug,'id'=>$post->id])}}"
                                            class="text-decoration-none mb-1 text-dark"
                                        >
                                            <small class="news-detail-widget">{{$post->title}}</small>
                                        </a>
                                    </div>
                                </div>

                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        $('#other_posts').owlCarousel({
            loop: true,
            margin: 10,
            nav: true,
            dots: false,
            navText: ['<i class="fas fa-chevron-left"></i>', '<i class="fas fa-chevron-right"></i>'],
            responsive: {
                0: {
                    items: 2,
                },
                600: {
                    items: 3,
                },
                1000: {
                    items: 4,
                },
            },
        });
        var size_total = $('#show_list_item_detail .show-item-detail').length;
        var each_show = 2;
        $(document).on('click', '#show_more_items', function (e) {
            each_show= (each_show+8 <= size_total) ? each_show+8 : size_total;
            $('#show_list_item_detail .show-item-detail:lt('+each_show+')').show();
            var countHidden = $('#show_list_item_detail .show-item-detail > :hidden').length;
            if(countHidden == 0 ) {
                $('#show_more_items').hide();
            }
        });
    </script>
@endpush
